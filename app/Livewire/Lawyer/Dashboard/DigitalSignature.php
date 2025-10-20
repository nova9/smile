<?php

namespace App\Livewire\Lawyer\Dashboard;

use App\Models\ContractRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class DigitalSignature extends Component
{
    use WithFileUploads;

    public $signatureImage;
    public $signingContractId;
    public $showSignatureModal = false;

    public function mount()
    {
        // Any initialization if needed
    }

    /**
     * Open signature modal for a specific contract
     */
    public function openSignatureModal($contractRequestId)
    {
        $this->signingContractId = $contractRequestId;
        $this->showSignatureModal = true;
        $this->signatureImage = null;
    }

    /**
     * Close signature modal
     */
    public function closeSignatureModal()
    {
        $this->showSignatureModal = false;
        $this->signingContractId = null;
        $this->signatureImage = null;
    }

    /**
     * Sign the contract with uploaded signature
     */
    public function signContract()
    {
        $this->validate([
            'signatureImage' => 'required|image|max:2048', // 2MB max
        ]);

        try {
            $contractRequest = ContractRequest::with(['event', 'requester', 'agreement'])
                ->findOrFail($this->signingContractId);

            // Store the signature image
            $signaturePath = $this->signatureImage->store('signatures', 'public');

            // Update contract request
            $contractRequest->update([
                'status' => 'approved',
                'lawyer_id' => Auth::id(),
                'signature_path' => $signaturePath,
                'signed_at' => now(),
            ]);

            // Publish the event (make it visible)
            if ($contractRequest->event) {
                $contractRequest->event->update(['is_active' => true]);
            }

            Log::info('Contract signed', [
                'contract_request_id' => $contractRequest->id,
                'lawyer_id' => Auth::id(),
                'event_id' => $contractRequest->event_id,
            ]);

            session()->flash('success', 'Contract signed successfully! The event is now published.');

            $this->closeSignatureModal();
        } catch (\Exception $e) {
            Log::error('Error signing contract: ' . $e->getMessage());
            session()->flash('error', 'Failed to sign contract. Please try again.');
        }
    }

    public function render()
    {
        // Get pending contract requests:
        // 1. Sign-only requests (no custom requirements: notes is null)
        // 2. Approved customizations (has notes but customization_status = 'approved')
        // 3. Rejected customizations (notes cleared, customization_status = 'rejected')
        // Must be: status = 'pending', not yet signed (whereNull('signed_at')), not yet assigned a lawyer
        $pendingContracts = ContractRequest::with(['event', 'requester', 'agreement'])
            ->where('status', 'pending')
            ->whereNull('signed_at') // Not yet signed
            ->whereNull('lawyer_id') // Not yet assigned to a lawyer
            ->where(function ($query) {
                $query->where(function ($q) {
                    // Sign-only requests (no custom requirements)
                    $q->whereNull('notes')
                        ->whereNull('customization_status');
                })
                    ->orWhere(function ($q) {
                        // Approved customizations ready for signature
                        $q->where('customization_status', 'approved');
                    })
                    ->orWhere(function ($q) {
                        // Rejected customizations (use default terms)
                        $q->where('customization_status', 'rejected');
                    });
            })
            ->latest()
            ->get();

        // Get signed contracts by this lawyer
        $signedContracts = ContractRequest::with(['event', 'requester', 'agreement'])
            ->where('status', 'approved')
            ->whereNotNull('signed_at') // Already signed
            ->where('lawyer_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();

        return view('livewire.lawyer.dashboard.digital-signature', [
            'pendingContracts' => $pendingContracts,
            'signedContracts' => $signedContracts,
        ]);
    }
}
