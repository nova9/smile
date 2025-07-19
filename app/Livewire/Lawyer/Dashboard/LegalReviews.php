<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Contract;

class LegalReviews extends Component
{
    use WithFileUploads;

    public $contracts;
    public $file = []; // Use array for multiple files by contract ID

    public function mount()
    {
        $this->contracts = Contract::with('requester')->get();
    }

    public function uploadDocument($id)
    {
        $this->validate([
            "file.$id" => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $uploadedFile = $this->file[$id];

        $path = $uploadedFile->store('contracts', 'public');

        $contract = Contract::find($id);
        if ($contract) {
            $contract->contract_document = $path;
            $contract->status = 'approved';
            $contract->save();
        }

        session()->flash('success', 'Document uploaded successfully!');
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.legal-reviews');
    }
}
