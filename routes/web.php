<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Welcome::class)->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});


Route::middleware('guest')->group(function () {
    Route::get('/signup', \App\Livewire\Signup::class);
    Route::get('/login', \App\Livewire\Login::class);
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
});


Route::prefix('/requester')->group(base_path('routes/requester.php'));
Route::prefix('/volunteer')->group(base_path('routes/volunteer.php'));
Route::prefix('/admin')->group(base_path('routes/admin.php'));
Route::prefix('/lawyer')->group(base_path('routes/lawyer.php'));
