<?php

namespace App\Http\Controllers;

use App\Models\Transcription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpeechToTextController extends Controller
{
    // Show the upload form and transcription history
    public function showUploadForm()
    {
        $transcriptions = Transcription::where('user_id', auth()->id())->latest()->get();
        return view('user.dashboard', compact('transcriptions'));
    }

    // Process the uploaded audio file
    public function processUpload(Request $request)
    {
        set_time_limit(300);

        $request->validate([
            'audio' => 'required|mimes:ogg,wav,mp3|max:20480',
        ]);

        // Store the uploaded file with its original name
        $file = $request->file('audio');
        $originalName = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $originalName);

        $audioPath = storage_path('app/' . $path);
        $transcriptionScript = base_path('scripts/transcription.py');
        $summaryScript = base_path('scripts/summary.py');

        try {
            // Run the transcription and summary scripts
            $transcription = shell_exec("python $transcriptionScript " . escapeshellarg($audioPath));
            $summary = shell_exec("python $summaryScript " . escapeshellarg(trim($transcription)));

            if (!$transcription || !$summary) {
                throw new \Exception("Error processing the file.");
            }

            // Save transcription and summary to the database
            Transcription::create([
                'user_id' => auth()->id(), // Save the currently logged-in user's ID
                'audio_file_path' => $path,
                'original_file_name' => $originalName,
                'transcription' => trim($transcription),
                'summary' => trim($summary),
            ]);

            return view('user.transcript', [
                'transcription' => trim($transcription),
                'summary' => trim($summary),
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Show a specific transcription and its summary
    public function showTranscription($id)
    {
        $transcription = Transcription::findOrFail($id);

        return view('user.transcript', [
            'transcription' => $transcription->transcription,
            'summary' => $transcription->summary,
        ]);
    }

    // Update the transcription and summary
    public function updateResult(Request $request, $id)
    {
        $request->validate([
            'transcription' => 'required|string',
            'summary' => 'required|string',
        ]);

        $record = Transcription::findOrFail($id);
        $record->update([
            'transcription' => $request->input('transcription'),
            'summary' => $request->input('summary'),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Transcription and summary updated successfully!');
    }

    // Delete a transcription
    public function deleteTranscription($id)
    {
        $transcription = Transcription::findOrFail($id);

        // Optionally delete the uploaded audio file
        Storage::delete($transcription->audio_file_path);

        $transcription->delete();

        return redirect()->route('user.dashboard')->with('success', 'Transcription deleted successfully!');
    }

    // Save the transcription and summary manually
    public function saveResult(Request $request)
    {
        $request->validate([
            'transcription' => 'required|string',
            'summary' => 'required|string',
        ]);

        Transcription::create([
            'audio_file_path' => 'path_to_audio', // Placeholder; replace with actual path if needed
            'transcription' => $request->input('transcription'),
            'summary' => $request->input('summary'),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Transcription and summary saved!');
    }
}
