<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Livewire\Lawyer\Dashboard\Index::class);
});
