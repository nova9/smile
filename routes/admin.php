<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\Dashboard\Index::class);
    Route::get('/dashboard/volunteer-management', \App\Livewire\Admin\Dashboard\VolunteerManagement::class);
    Route::get('/dashboard/organization-management', \App\Livewire\Admin\Dashboard\OrganizationManagement::class);
    Route::get('/dashboard/organization-details/{id}', \App\Livewire\Admin\Dashboard\OrganizationDetails::class);
    Route::get('/dashboard/volunteer-details/{id}', \App\Livewire\Admin\Dashboard\VolunteerDetails::class);

    Route::get('/dashboard/dispute-handling', \App\Livewire\Admin\Dashboard\DisputeHandling::class);

    Route::get('/dashboard/analytics', \App\Livewire\Admin\Dashboard\Analytics::class);
    Route::get('/dashboard/profile', \App\Livewire\Admin\Dashboard\Profile::class);

});
