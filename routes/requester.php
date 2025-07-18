<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Requester\Dashboard\Index;
use App\Livewire\Requester\Dashboard\Events;
use App\Livewire\Requester\Dashboard\NewRequest;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Index::class);
    Route::get('/dashboard/events', Events::class);
});

Route::middleware(['auth', 'role:requester'])->group(function () {
    Route::get('/events', Events::class)->name('requester.events');
    Route::get('/dashboard/new-request', NewRequest::class)->name('requester.create-event');
});
