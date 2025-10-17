<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:volunteer'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', \App\Livewire\Volunteer\Dashboard\Index::class);
        Route::get('/events', \App\Livewire\Volunteer\Dashboard\Eventz\Index::class);
        Route::get('/profile', \App\Livewire\Volunteer\Dashboard\Profile::class);
        Route::get('/leaderboard', \App\Livewire\Volunteer\Dashboard\Leaderboard::class);

        Route::get('/events', \App\Livewire\Volunteer\Dashboard\Eventz\Index::class);
        Route::get('/events/{id}', \App\Livewire\Volunteer\Dashboard\Eventz\Show::class);

        Route::get('/my-events', \App\Livewire\Volunteer\Dashboard\MyEvents\Index::class);
        Route::get('/my-events/{id}', \App\Livewire\Volunteer\Dashboard\MyEvents\Show::class);

        Route::get('/feedback', \App\Livewire\Volunteer\Dashboard\Feedback::class)->name('volunteer.feedback');
        Route::get('/community/{id}', \App\Livewire\Volunteer\Dashboard\Community::class)->name('community.space');
        Route::get('/achievements', \App\Livewire\Volunteer\Dashboard\Achievements::class);
        Route::get('/certificate/{id}', \App\Livewire\Volunteer\Dashboard\Certificate::class)->name('volunteer.certificate.show');
        Route::get('/reviews', \App\Livewire\Volunteer\Dashboard\Reviews::class)->name('volunteer.reviews');
    });
});
