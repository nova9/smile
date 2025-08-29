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
        Route::get('/my-events/{id}/certificates/{volunteerid}', \App\Livewire\Requester\Dashboard\Certificates\Certificate::class)->name('certificate.show');
        Route::get('/issued-certificates', \App\Livewire\Requester\Dashboard\Certificates\IssuedCertificates::class);

    });
});
// action="{{ route('certificates.issue', ['volunteer' => $volunteer->id, 'event' => $event->id]) }}"
// livewire.requester.dashboard.certificate