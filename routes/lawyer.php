<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Lawyer\Dashboard\Index as DashboardIndex;
use App\Livewire\Lawyer\Dashboard\LegalReviews;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardIndex::class)->name('lawyer.dashboard');
    Route::get('/dashboard/profile', \App\Livewire\Lawyer\Dashboard\Profile::class)->name('lawyer.profile');
});
