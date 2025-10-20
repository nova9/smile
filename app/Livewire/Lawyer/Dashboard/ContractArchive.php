<?php

namespace App\Livewire\Lawyer\Dashboard;

use App\Models\ContractRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContractArchive extends Component
{
    public function render()
    {
        // Get all signed contracts by this lawyer
        $signedContracts = ContractRequest::with(['event', 'requester', 'agreement'])
            ->where('status', 'approved')
            ->where('lawyer_id', Auth::id())
            ->latest('signed_at')
            ->get();

        return view('livewire.lawyer.dashboard.contract-archive', [
            'signedContracts' => $signedContracts
        ]);
    }
}
