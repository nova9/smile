<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Welcome::class)->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::get('/requester/dashboard', \App\Livewire\Dashboards\Requester::class);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});


Route::middleware('guest')->group(function () {
    Route::get('/signup/volunteer', \App\Livewire\SignupVolunteer::class);
    Route::get('/signup/requester', \App\Livewire\SignupRequester::class);
    Route::post('/signup/requester', [\App\Http\Controllers\AuthController::class, 'requestorSignup']);
    Route::get('/login', \App\Livewire\Login::class);
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
});
