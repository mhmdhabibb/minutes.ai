<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpeechToTextController extends Controller
{
    public function showUploadForm()
    {
        return view('speech.upload');
    }

    public function processUpload(Request $request)
    {
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

            return view('speech.result', [
                'transcription' => trim($transcription),
                'summary' => trim($summary),
            ]);
        } catch (\Exception $e) {
            // Handle errors gracefully
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
