<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;
use App\Models\Contract;

class LegalReviews extends Component
{
    public function render()
    {
        // Replace this with your actual query logic
        $activities = Contract::where('needs_legal_review', true)->get();

        return view('livewire.lawyer.dashboard.legal-reviews', [
            'activities' => $activities,
        ]);
    }
}


