<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Livewire\Volunteer\Dashboard\Index::class);
    Route::get('/dashboard/events', \App\Livewire\Volunteer\Dashboard\Events::class);
    Route::get('/dashboard/profile', \App\Livewire\Volunteer\Dashboard\Profile::class);
    Route::get('/dashboard/opportunities', \App\Livewire\Volunteer\Dashboard\Opportunities::class);
    Route::get('/dashboard/feedback', \App\Livewire\Volunteer\Dashboard\Feedback::class);
    Route::get('/dashboard/community', \App\Livewire\Volunteer\Dashboard\Community::class);
    Route::get('/dashboard/activities', \App\Livewire\Volunteer\Dashboard\Activities::class);
});
