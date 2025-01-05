<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transcription;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class TranscriptController extends Controller
{
    /**
     * Process the uploaded audio file.
     */
    public function processAudio(Request $request)
{
    $request->validate([
        'audio' => 'required|mimes:mp3,wav|max:15000', // Limit to 15MB
    ]);

    // Step 1: File Upload
    $audio = $request->file('audio');
    $originalFileName = $audio->getClientOriginalName();
    $uniqueFileName = uniqid() . '_' . $originalFileName; // Unique name for storage

    $filePath = $audio->storeAs('uploads', $uniqueFileName, 'local');
    $fullPath = storage_path('app/' . $filePath);

    // Step 2: Execute Diarization Script
    $pythonPath = env('PYTHON_PATH', 'python');
    $pythonScript = base_path('app/python_scripts/diarization.py');
    $huggingfaceToken = env('HUGGINGFACE_TOKEN');

    $command = sprintf(
        '%s %s "%s" "%s"',
        escapeshellarg($pythonPath),
        escapeshellarg($pythonScript),
        escapeshellarg($fullPath),
        escapeshellarg($huggingfaceToken)
    );

    \Log::info("Executing Python Command: $command");

    exec($command, $output, $returnCode);

    \Log::info('Python Script Output: ' . implode("\n", $output));
    \Log::info("Return Code: $returnCode");

    if ($returnCode !== 0) {
        return back()->withErrors(['error' => 'Audio processing failed.']);
    }

    // Step 3: Parse Diarization Output
    $decodedOutput = json_decode(implode('', $output), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return back()->withErrors(['error' => 'Invalid JSON response from Python script.']);
    }

    if ($decodedOutput['status'] !== 'success') {
        return back()->withErrors(['error' => $decodedOutput['message']]);
    }

    // Step 4: Combine Transcription Text for Summarization
    $transcriptionText = implode(' ', array_column($decodedOutput['results'], 'text'));

    // Debugging Log for Summarization
    \Log::info("Starting Summarization with Text: " . substr($transcriptionText, 0, 100) . "...");

    // Step 5: Call Summarization Script
    $summary = $this->callSummarizationScript($transcriptionText);

    \Log::info("Summarization Completed: $summary");

    // Step 6: Save Transcription and Summary to Database
    $transcription = Transcription::create([
        'user_id' => auth()->id(),
        'file_name' => $originalFileName,
        'stored_file_name' => $uniqueFileName,
        'transcription' => json_encode($decodedOutput['results']),
        'summary' => $summary, // Save the summary
    ]);

    // Step 7: Redirect to Transcript View
    return redirect()->route('user.transcript', ['id' => $transcription->id]);
}







    /**
     * View a specific transcription.
     */
    public function viewTranscript($id)
{
    $transcription = Transcription::findOrFail($id);

    if (is_string($transcription->transcription)) {
        $transcripts = json_decode($transcription->transcription, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Transcription data is not a valid JSON string.');
        }
    } elseif (is_array($transcription->transcription)) {
        $transcripts = $transcription->transcription;
    } else {
        throw new \Exception('Invalid transcription data format.');
    }

    return view('user.transcript', [
        'transcripts' => $transcripts,
        'file_name' => $transcription->file_name,
        'created_at' => $transcription->created_at->format('M j \a\t h:i A'),
        'transcription_id' => $transcription->id,
        'summary' => $transcription->summary, // Pass summary to the transcript view
    ]);
}


    

    /**
     * Edit a specific transcription.
     */
    public function editTranscript($id)
{
    $transcription = Transcription::findOrFail($id);

    // Decode transcription data
    if (is_string($transcription->transcription)) {
        $transcripts = json_decode($transcription->transcription, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON format in transcription.');
        }
    } elseif (is_array($transcription->transcription)) {
        $transcripts = $transcription->transcription;
    } else {
        throw new \Exception('Invalid transcription data format.');
    }

    return view('user.edit_transcript', [
        'transcripts' => $transcripts,
        'file_name' => $transcription->file_name,
        'transcription_id' => $transcription->id,
    ]);
}


    /**
     * Update a specific transcription.
     */
    public function updateTranscript(Request $request, $id)
{
    $request->validate([
        'file_name' => 'required|string|max:255', // Validate file name
        'transcripts' => 'required|array', // Ensure 'transcripts' is an array
    ]);

    $transcription = Transcription::findOrFail($id);

    // Update file name
    $transcription->file_name = $request->file_name;

    // Save updated transcription
    $transcription->transcription = json_encode($request->transcripts);
    $transcription->updated_at = now(); // Update the timestamp
    $transcription->save();

    return redirect()->route('user.transcript', ['id' => $id])
        ->with('status', 'Transcript and file name updated successfully.');
}

public function downloadTranscript($id)
{
    $transcription = Transcription::findOrFail($id);

    // Decode transcription data
    if (is_string($transcription->transcription)) {
        $transcripts = json_decode($transcription->transcription, true);
    } else {
        $transcripts = $transcription->transcription;
    }

    // Sanitize the file name
    $safeFileName = preg_replace('/[\/\\\\]/', '_', $transcription->file_name);

    $data = [
        'file_name' => $transcription->file_name,
        'created_at' => $transcription->created_at->format('M j, Y'),
        'transcripts' => $transcripts,
    ];

    $pdf = \PDF::loadView('pdf.transcript', $data);
    return $pdf->download($safeFileName . '_transcript.pdf');
}


public function destroy($id)
{
    $transcription = Transcription::find($id);

    if (!$transcription) {
        return redirect()->back()->with('error', 'Transcription not found.');
    }

    // Delete the transcription file from storage
    Storage::delete('uploads/' . $transcription->file_name);

    // Delete the transcription record from the database
    $transcription->delete();

    return redirect()->route('user.dashboard')->with('success', 'Transcription deleted successfully.');
}


private function callSummarizationScript($text)
{
    // Paths to Python executable and script
    $pythonPath = env('PYTHON_PATH', 'python'); // Fallback to 'python' if not defined in .env
    $summaryScript = base_path('app/python_scripts/summary.py');

    // Escape and sanitize text for safe execution in the shell
    $escapedText = escapeshellarg($text);

    // Build the command
    $command = "$pythonPath $summaryScript $escapedText";

    // Log the command for debugging
    \Log::info("Executing Summary Script: $command");

    // Set a timeout for the process to avoid indefinite hangs
    $startTime = microtime(true);
    exec($command . ' 2>&1', $output, $returnCode);
    $executionTime = microtime(true) - $startTime;

    // Log output and timing for debugging
    \Log::info("Summary Script Execution Time: {$executionTime}s");
    \Log::info("Summary Script Output: " . implode("\n", $output));
    \Log::info("Return Code: $returnCode");

    // Check if the script failed
    if ($returnCode !== 0) {
        \Log::error("Summarization script failed with return code: $returnCode");
        throw new \Exception("Summarization script failed. See logs for details.");
    }

    // Parse the JSON output
    $result = json_decode(implode('', $output), true);

    // Validate the JSON output
    if (json_last_error() !== JSON_ERROR_NONE || empty($result['summary'])) {
        $error = json_last_error_msg() ?: 'Unknown error in summarization script output.';
        \Log::error("JSON Parsing Error: $error");
        throw new \Exception("Error parsing summarization script output: $error");
    }

    // Return the summary
    return $result['summary'];
}






public function viewSummary($id)
{
    $transcription = Transcription::findOrFail($id);

    return view('user.summary', [
        'summary' => $transcription->summary,
        'file_name' => $transcription->file_name,
        'created_at' => $transcription->created_at->format('M j \a\t h:i A'),
        'transcription_id' => $transcription->id,
    ]);
}

public function updateSummary(Request $request, $id)
{
    $request->validate([
        'summary' => 'required|string|max:5000',
    ]);

    $transcription = Transcription::findOrFail($id);
    $transcription->summary = $request->input('summary');
    $transcription->save();

    return redirect()->route('user.summary', ['id' => $id])->with('success', 'Summary updated successfully!');
}

}
