<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ResetPasswordController;
use App\Livewire\ResetPassword;

Route::post('/contracts/{id}/upload', [ContractController::class, 'uploadDocument'])->name('contracts.upload');
Route::post('/contracts/{id}/approve', [ContractController::class, 'approveContract'])->name('contracts.approve');



Route::get('/', \App\Livewire\Welcome::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::get('/profile', \App\Http\Controllers\ProfileController::class)->name('profile');
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
    Route::get('/signup', \App\Livewire\Signup::class);
    Route::get('/login', \App\Livewire\Login::class);
    Route::get('/forgot-password', \App\Livewire\ForgotPassword::class);
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
});

// Route group files for user types
Route::prefix('/requester')->group(base_path('routes/requester.php'));
Route::prefix('/volunteer')->group(base_path('routes/volunteer.php'));
Route::prefix('/admin')->group(base_path('routes/admin.php'));
Route::prefix('/lawyer')->group(base_path('routes/lawyer.php'));

//chatbot
Route::post('/chat/send', [\App\Livewire\Common\Chatbot::class, 'sendMessage']);
