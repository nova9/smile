<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Welcome::class);
Route::get('/signup', \App\Livewire\Signup::class);
Route::get('/login', \App\Livewire\Login::class);
