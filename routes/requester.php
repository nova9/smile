<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Livewire\Requester\Dashboard\Index::class);
    Route::get('/dashboard/events', \App\Livewire\Requester\Dashboard\Events::class);
});
