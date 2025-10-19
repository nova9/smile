<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Lawyer\Dashboard\Index as DashboardIndex;

Route::middleware(['auth', 'role:lawyer'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', DashboardIndex::class)->name('lawyer.dashboard');
        Route::get('/profile', \App\Livewire\Lawyer\Dashboard\Profile::class)->name('lawyer.profile');
        
        // Business Process Routes
        Route::get('/contract-drafting', \App\Livewire\Lawyer\Dashboard\ContractDrafting::class)->name('lawyer.contract-drafting');
        Route::get('/approval-workflow', \App\Livewire\Lawyer\Dashboard\ApprovalWorkflow::class)->name('lawyer.approval-workflow');
        Route::get('/digital-signature', \App\Livewire\Lawyer\Dashboard\DigitalSignature::class)->name('lawyer.digital-signature');
        Route::get('/contract-archive', \App\Livewire\Lawyer\Dashboard\ContractArchive::class)->name('lawyer.contract-archive');
        Route::get('/contract-customization', \App\Livewire\Lawyer\Dashboard\ContractCustomization::class)->name('lawyer.contract-customization');
        Route::get('/legal-qa', \App\Livewire\Lawyer\Dashboard\LegalQA::class)->name('lawyer.legal-qa');
    });
});
