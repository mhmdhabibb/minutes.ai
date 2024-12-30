<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpeechToTextController extends Controller
{
    // Show the upload form
    public function showUploadForm()
    {
        return view('user.dashboard');
    }

    // Process the uploaded audio
    public function processUpload(Request $request)
    {
        // Set the maximum execution time for this script to 300 seconds (5 minutes)
        set_time_limit(300);

        $request->validate([
            'audio' => 'required|mimes:ogg,wav,mp3|max:20480', // Validate file type and size
        ]);

        // Store the uploaded file
        $path = $request->file('audio')->store('uploads');

        // Call the Python script
        $audioPath = storage_path('app/' . $path);
        $pythonScript = base_path('scripts/speechtotext.py'); // Path to the Python script

        try {
            $output = shell_exec("python $pythonScript $audioPath");

            if (!$output) {
                throw new \Exception("Error in processing the audio file. No output received from the script.");
            }

            // Parse the transcription and summary from the Python script output
            $lines = explode("\n", $output);
            $transcription = '';
            $summary = '';
            $isSummary = false;

            foreach ($lines as $line) {
                if (trim($line) === "SUMMARY:") {
                    $isSummary = true;
                    continue;
                }
                if ($isSummary) {
                    $summary .= $line . "\n";
                } else {
                    $transcription .= $line . "\n";
                }
            }

            return view('user.transcript', [
                'transcription' => trim($transcription),
                'summary' => trim($summary),
            ]);
        } catch (\Exception $e) {
            // Handle errors gracefully
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Update the transcription and summary result
    public function updateResult(Request $request)
    {
        $request->validate([
            'transcription' => 'required|string',
            'summary' => 'required|string',
        ]);

        // Retrieve the updated transcription and summary from the request
        $transcription = $request->input('transcription');
        $summary = $request->input('summary');

        // Save or process the updated transcription and summary
        // Example: Store them back in a session or a database if required

        return redirect()->back()->with([
            'success' => 'Transcription and summary updated successfully!',
            'transcription' => $transcription,
            'summary' => $summary,
        ]);
    }
}
