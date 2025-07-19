<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Contract;

class LegalReviews extends Component
{
    use WithFileUploads;

    public $contracts;
    public $file = [];

    public function mount()
    {
        $this->contracts = Contract::with('requester')->get();


    }

    public function setCurrentContract($contractId)
    {
        $this->currentContractId = $contractId;
    }


    public function uploadDocument($contractId)
    {
        $this->validate([
            "file.$contractId" => 'required|file|mimes:pdf|max:5120',
        ]);

        $uploadedFile = $this->file[$contractId];
        $path = $uploadedFile->store('contracts', 'public');

        $contract = Contract::findOrFail($contractId);
        $contract->contract_document = $path;
        $contract->status = 'approved';
        $contract->save();

        // Refresh the list
        $this->mount();
        session()->flash('success', 'Contract uploaded successfully!');
    }

    public function approve($contractId)
    {
        $contract = Contract::findOrFail($contractId);
        $contract->status = 'approved';
        $contract->save();

        $this->mount(); // Refresh data
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.legal-reviews');
    }
}
