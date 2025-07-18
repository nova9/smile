<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', \App\Livewire\Volunteer\Dashboard\Index::class);
        Route::get('/events', \App\Livewire\Volunteer\Dashboard\Events::class);
        Route::get('/profile', \App\Livewire\Volunteer\Dashboard\Profile::class);
        Route::get('/leaderboard', \App\Livewire\Volunteer\Dashboard\Leaderboard::class);

        Route::get('/events', \App\Livewire\Volunteer\Dashboard\Eventz\Index::class);
        Route::get('/events/{id}', \App\Livewire\Volunteer\Dashboard\Eventz\Show::class);

        Route::get('/feedback', \App\Livewire\Volunteer\Dashboard\Feedback::class);
        Route::get('/community', \App\Livewire\Volunteer\Dashboard\Community::class);
        Route::get('/activities', \App\Livewire\Volunteer\Dashboard\Activities::class);
    });
});
