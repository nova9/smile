<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/requester/dashboard', \App\Livewire\Requester\Dashboard\Index::class);
    Route::get('/requester/dashboard/events', \App\Livewire\Requester\Dashboard\Events::class);
});
