<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:requester'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', \App\Livewire\Requester\Dashboard\Index::class);
        Route ::get('/profile', \App\Livewire\Requester\Dashboard\Profile::class);
        Route::get('/my-events', \App\Livewire\Requester\Dashboard\MyEvents\Index::class);
        Route::get('/my-events/create', \App\Livewire\Requester\Dashboard\MyEvents\Create::class);
        Route::get('/my-events/{id}', \App\Livewire\Requester\Dashboard\MyEvents\Show::class)->name('requester.event.show');
        Route::get('/my-events/{id}/edit', \App\Livewire\Requester\Dashboard\MyEvents\Edit::class)->name('requester.event.edit');
    });
});
