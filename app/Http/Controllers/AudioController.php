<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Transcription;

class AudioController extends Controller
{
    public function processUploadedAudio(Request $request)
    {
        set_time_limit(300);

        // Validate the uploaded file
        $request->validate([
            'audio' => 'required|file|mimes:wav,mp3|max:15360', // Max file size 15MB
        ]);

        // Get the uploaded file
        $audioFile = $request->file('audio');

        // Preserve the original filename
        $originalFileName = $audioFile->getClientOriginalName();

        // Generate a unique name to avoid overwriting files
        $uniqueFileName = time() . '_' . $originalFileName;

        // Store the file in the 'uploads' directory
        $path = $audioFile->storeAs('uploads', $uniqueFileName);

        // Get the full storage path
        $audioPath = storage_path('app/' . $path);

        // Define paths and credentials
        $diarizationScript = base_path('app/python_scripts/diarization.py');
        $summaryScript = base_path('app/python_scripts/summary.py');
        $huggingFaceToken = env('HUGGINGFACE_TOKEN');
        $pythonPath = env('PYTHON_PATH');

        // Step 1: Run diarization.py
        $diarizationCommand = "\"$pythonPath\" \"$diarizationScript\" \"$audioPath\" \"$huggingFaceToken\"";
        \Log::info("Executing Python Command: $diarizationCommand");

        exec($diarizationCommand, $diarizationOutput, $diarizationReturnCode);
        \Log::info("Diarization Script Output: " . implode("\n", $diarizationOutput));
        \Log::info("Diarization Return Code: $diarizationReturnCode");

        if ($diarizationReturnCode !== 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Diarization script execution failed. Check logs for details.',
            ], 500);
        }

        // Decode the diarization output
        try {
            $diarizationResult = json_decode(implode("", $diarizationOutput), true);

            if (!isset($diarizationResult['status']) || $diarizationResult['status'] !== 'success') {
                throw new \Exception("Diarization script error: " . ($diarizationResult['message'] ?? 'Unknown error'));
            }

            // Combine all transcriptions into a single text for summarization
            $transcriptionText = collect($diarizationResult['results'])->pluck('text')->implode(' ');

        } catch (\Exception $e) {
            \Log::error("Error decoding diarization output: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }

        // Step 2: Run summary.py
        $summaryCommand = "\"$pythonPath\" \"$summaryScript\" " . escapeshellarg($transcriptionText);
        \Log::info("Executing Python Command: $summaryCommand");

        exec($summaryCommand, $summaryOutput, $summaryReturnCode);
        \Log::info("Summary Script Output: " . implode("\n", $summaryOutput));
        \Log::info("Summary Return Code: $summaryReturnCode");

        if ($summaryReturnCode !== 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Summary script execution failed. Check logs for details.',
            ], 500);
        }

        // Decode the summary output
        try {
            $summaryResult = json_decode(implode("", $summaryOutput), true);

            if (!isset($summaryResult['summary'])) {
                throw new \Exception("Summary script error: " . ($summaryResult['error'] ?? 'Unknown error'));
            }

            $summaryText = $summaryResult['summary'];
        } catch (\Exception $e) {
            \Log::error("Error decoding summary output: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }

        // Step 3: Save both the diarization and summary results to the database
        $transcription = Transcription::create([
            'user_id' => auth()->id(),
            'file_name' => $uniqueFileName, // Save the original filename with a unique prefix
            'transcription' => $diarizationResult['results'], // Save diarization results
            'summary' => $summaryText, // Save summary text
        ]);

        // Step 4: Return the combined results
        return response()->json([
            'status' => 'success',
            'message' => 'File processed successfully!',
            'transcription_id' => $transcription->id,
            'diarization' => $diarizationResult['results'],
            'summary' => $summaryText,
        ]);
    }
}
