<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('home');
})->name('home');


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

