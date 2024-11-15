<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('home');
})->name('home');


Route::get('/login', function () {
    return view('login'); 
})->name('login');

Route::get('/signup', function () {
    return view('signup'); 
})->name('signup');

Route::get('/dashboard', function () {
    return view('dashboard'); // 
});


Route::get('/verify', function () {
    return view('auth.verify'); 
})->name('verify.code');

Route::get('/set-password', function () {
    return view('auth.set-password'); 
})->name('set-password');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password'); 
})->name('forgot-password');


Route::get('/recording', function () {
    return view('recording'); 
})->name('recording');


Route::get('/summary', function () {
    return view('summary'); 
})->name('summary');

Route::get('/transcript', function () {
    return view('transcript'); 
})->name('transcript');