<?php

namespace App\Livewire\Lawyer\Dashboard;

use App\Models\ContractRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ContractArchive extends Component
{
    public $viewingContract = null;
    public $showViewModal = false;

    /**
     * Open modal to view contract details
     */
    public function viewContract($contractId)
    {
        $this->viewingContract = ContractRequest::with(['event', 'requester', 'agreement'])
            ->where('id', $contractId)
            ->where('lawyer_id', Auth::id())
            ->first();

        if ($this->viewingContract) {
            $this->showViewModal = true;
        }
    }

    /**
     * Close view modal
     */
    public function closeViewModal()
    {
        $this->showViewModal = false;
        $this->viewingContract = null;
    }

    /**
     * Download contract as PDF
     */
    public function downloadContract($contractId)
    {
        $contract = ContractRequest::with(['event', 'requester', 'agreement'])
            ->where('id', $contractId)
            ->where('lawyer_id', Auth::id())
            ->first();

        if (!$contract) {
            session()->flash('error', 'Contract not found.');
            return;
        }

        // Prepare contract data
        $data = [
            'contract' => $contract,
            'lawyer' => Auth::user(),
            'organization' => $contract->requester_details['organization'] ?? $contract->requester->name,
            'contact' => $contract->requester_details['phone'] ?? 'N/A',
            'email' => $contract->requester_details['email'] ?? $contract->requester->email,
            'address' => $contract->requester_details['address'] ?? 'N/A',
            'terms' => $contract->customized_terms ?? $contract->agreement->terms,
            'signatureUrl' => $contract->signature_path ? Storage::url($contract->signature_path) : null,
        ];

        // Generate PDF
        $pdf = Pdf::loadView('pdfs.contract', $data);

        // Generate filename
        $filename = 'Contract_' . $contract->agreement->topic . '_' . $contract->event->name . '_' . $contract->signed_at->format('Y-m-d') . '.pdf';
        $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $filename);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

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
