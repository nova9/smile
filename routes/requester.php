<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Requester\Dashboard\Index;
use App\Livewire\Requester\Dashboard\Events;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Index::class);
});

Route::middleware(['auth', 'role:requester'])->group(function () {
    Route::get('/events', Events::class)->name('requester.events');
});

Route::get('/create-event', function () {
    return 'Create Event Page Placeholder';
})->name('requester.create-event');

Route::get('/applicants', function () {
    return 'Applicants placeholder page';
})->name('requester.applicants');

Route::get('/feedback', function () {
    return 'Feedback placeholder';
})->name('requester.feedback');

Route::get('/profile', function () {
    return 'Profile page placeholder';
})->name('requester.profile');

