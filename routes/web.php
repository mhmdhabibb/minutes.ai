<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AIModelController;
use App\Http\Controllers\AudioController;

// User Routes
Route::get('/', fn() => view('user.home'))->name('user.home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/user/update-profile', [UserController::class, 'updateProfile'])->name('user.update_profile');
});


Route::get('/user/settings', fn() => view('user.settings'))->name('user.settings');
Route::get('/verify', fn() => view('auth.verify'))->name('verify.code');
Route::get('/set-password', fn() => view('auth.set-password'))->name('set-password');
Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('forgot-password');
Route::get('/transcript/{id}/summary', [TranscriptController::class, 'viewSummary'])->name('user.summary');
Route::get('/summary/{id}/download', [TranscriptController::class, 'downloadSummary'])->name('user.summary.download');
Route::put('/transcription/{id}/summary', [TranscriptController::class, 'updateSummary'])->name('user.update_summary');

Route::post('/process-audio', [TranscriptController::class, 'processAudio'])->name('process.audio');
Route::get('/transcript/{id}', [App\Http\Controllers\TranscriptController::class, 'viewTranscript'])->name('user.transcript');
Route::post('/upload-audio', [AudioController::class, 'processUploadedAudio'])->name('upload.audio');

Route::get('/edit-transcript/{id}', [TranscriptController::class, 'editTranscript'])->name('user.edit_transcript');
Route::put('/update-transcript/{id}', [TranscriptController::class, 'updateTranscript'])->name('user.update_transcript');
Route::get('/transcript/{id}/download', [TranscriptController::class, 'downloadTranscript'])->name('user.download_transcript');
Route::delete('/transcripts/{id}', [TranscriptController::class, 'destroy'])->name('user.delete_transcript');



Route::get('/test-python', function () {
    // Increase maximum execution time for this route
    set_time_limit(300); // Allows the script to run for up to 5 minutes

    // Define the correct paths
    $scriptPath = base_path('app/python_scripts/diarization.py'); // Correct absolute path
    $audioPath = storage_path('app/uploads/6776b81b7fc8c_Play.ht - Hey guys, have you finalized where we’re....wav'); // Correct absolute path
    $huggingFaceToken = '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'; // Your Hugging Face token
    $pythonPath = env('PYTHON_PATH'); // Path to Python executable

    // Debugging: Log each variable for clarity
    \Log::info("Script Path: $scriptPath");
    \Log::info("Audio Path: $audioPath");
    \Log::info("Python Path: $pythonPath");

    // Construct the command
    $command = "\"$pythonPath\" \"$scriptPath\" \"$audioPath\" \"$huggingFaceToken\"";

    // Log the constructed command
    \Log::info("Executing command: $command");

    // Execute the command
    exec($command, $output, $returnCode);

    return response()->json([
        'output' => $output,
        'return_code' => $returnCode,
    ]);
});


// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'adminLogin']);
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
        Route::get('/settings', fn() => view('admin.settings'))->name('admin.settings');
        Route::post('/update-profile', [AdminController::class, 'updateProfile'])->name('admin.update_profile');
        Route::patch('/settings/password', [AuthController::class, 'updatePassword'])->name('admin.settings.update_password');

        Route::prefix('models')->group(function () {
            Route::get('/', [AIModelController::class, 'index'])->name('admin.models.index');
            Route::post('/', [AIModelController::class, 'store'])->name('admin.models.store');
            Route::post('/{id}/activate', [AIModelController::class, 'activate'])->name('admin.models.activate');
            Route::delete('/{id}', [AIModelController::class, 'destroy'])->name('admin.models.destroy');
        });
    });
});
