<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function() {
    return view('home');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/adminsettings', function () {
    return view('adminsettings'); 
})->name('adminsettings');

Route::get('/settings', function () {
    return view('settings'); 
})->name('settings');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')
->middleware('auth');

Route::get('/settings', function () {
    return view('settings'); 
})->name('settings');

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
    return view('summary'); 
})->name('summary');

Route::get('/transcript', function () {
    return view('transcript'); 
})->name('transcript');
