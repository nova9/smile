<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Welcome::class)->name('home');
Route::get('/signup/volunteer', \App\Livewire\SignupVolunteer::class);
Route::get('/signup/requester', \App\Livewire\SignupRequester::class);
Route::post('/signup/requester', [\App\Http\Controllers\AuthController::class, 'requestorSignup']);
Route::get('/login', \App\Livewire\Login::class);
