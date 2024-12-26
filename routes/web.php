<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Routes User
Route::get('/', function() {
    return view('user.home');
})->name('user.home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/user/settings', function () {
        return view('user.settings'); 
    })->name('user.settings');

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

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
});

// Routes Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/settings', function () {
        return view('admin.settings'); 
    })->name('admin.settings');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');
});
