<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleAIController;
use App\Http\Controllers\SpeechToTextController;
use App\Http\Controllers\AIModelController;


// Routes User

Route::get('/', function() {
    return view('user.home');
})->name('user.home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/user/settings', function () {
    return view('user.settings'); 
})->name('user.settings');

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard')
->middleware('auth');

Route::get('/verify', function () {
    return view('auth.verify'); 
})->name('verify.code');

Route::get('/set-password', function () {
    return view('auth.set-password'); 
})->name('set-password');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password'); 
})->name('forgot-password');

Route::get('/summary', function () {
    return view('user.summary'); 
})->name('user.summary');

Route::get('/transcript', function () {
    return view('user.transcript'); 
})->name('user.transcript');


// Routes Admin

Route::get('admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'adminLogin']);
Route::post('admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
Route::group(['middleware' => 'admin'], function () {
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/settings', function () {
        return view('admin.settings'); 
    })->name('admin.settings');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('/models', [AIModelController::class, 'index'])->name('admin.models.index');
        Route::post('/models', [AIModelController::class, 'store'])->name('admin.models.store');
        Route::post('/models/{id}/activate', [AIModelController::class, 'activate'])->name('admin.models.activate');
        Route::delete('/models/{id}', [AIModelController::class, 'destroy'])->name('admin.models.destroy');
    });
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/settings', [AuthController::class, 'index'])->name('admin.settings');
    
    Route::patch('/settings/profile', [AuthController::class, 'updateProfile'])
        ->name('admin.settings.update_profile');
    
    Route::patch('/settings/profile-picture', [AuthController::class, 'updateProfilePicture'])
        ->name('admin.settings.update_profile_picture');
    
    Route::patch('/settings/password', [AuthController::class, 'updatePassword'])
        ->name('admin.settings.update_password');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); 
})->name('admin.dashboard');

Route::resource('modules', ModuleAIController::class);

// Speech to text and Summarize

Route::get('/upload-audio', [SpeechToTextController::class, 'showUploadForm']);
Route::post('/process-audio', [SpeechToTextController::class, 'processUpload']);
Route::post('/update-result', [SpeechToTextController::class, 'updateResult'])->name('update-result');


