<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Livewire\Volunteer\Dashboard\Index::class);
    Route::get('/dashboard/events', \App\Livewire\Volunteer\Dashboard\Events::class);
    Route::get('/dashboard/profile', \App\Livewire\Volunteer\Dashboard\Profile::class);
});
