<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:requester'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', \App\Livewire\Requester\Dashboard\Index::class);
        Route::get('/my-events', \App\Livewire\Requester\Dashboard\MyEvents\Index::class);
        Route::get('/my-events/create', \App\Livewire\Requester\Dashboard\MyEvents\Create::class);
    });
});
