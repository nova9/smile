<?php

namespace App\Livewire\Lawyer\Dashboard;

use App\Models\ContractRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ContractCustomization extends Component
{
    public $selectedRequestId;
    public $showReviewModal = false;
    public $customizedTerms = '';

    /**
     * Open review modal for a contract request with custom requirements
     */
    public function openReviewModal($contractRequestId)
    {
        $contractRequest = ContractRequest::with(['event', 'requester', 'agreement'])
            ->findOrFail($contractRequestId);

        $this->selectedRequestId = $contractRequestId;
        $this->customizedTerms = $contractRequest->agreement->terms ?? '';
        $this->showReviewModal = true;
    }

    /**
     * Close review modal
     */
    public function closeReviewModal()
    {
        $this->showReviewModal = false;
        $this->selectedRequestId = null;
        $this->customizedTerms = '';
    }

    /**
     * Approve custom requirements and move to digital signature with modified terms
     */
    public function approveCustomization()
    {
        try {
            $contractRequest = ContractRequest::with(['event', 'agreement'])
                ->findOrFail($this->selectedRequestId);

            // Append the new requirements to the existing contract terms
            $originalTerms = $contractRequest->agreement->terms ?? '';
            $additionalRequirements = $contractRequest->notes ?? '';

            // Combine original terms with additional requirements
            $combinedTerms = $originalTerms . "\n\n--- ADDITIONAL REQUIREMENTS ---\n\n" . $additionalRequirements;

            // Store the combined terms in the contract request
            $contractRequest->update([
                'customized_terms' => $combinedTerms,
                'customization_status' => 'approved',
            ]);

            Log::info('Contract customization approved', [
                'contract_request_id' => $contractRequest->id,
                'lawyer_id' => Auth::id(),
            ]);

            session()->flash('success', 'Additional requirements approved and added to contract! Ready for signature.');

            $this->closeReviewModal();

            // Redirect to digital signature page
            return redirect()->route('lawyer.digital-signature');
        } catch (\Exception $e) {
            Log::error('Error approving customization: ' . $e->getMessage());
            session()->flash('error', 'Failed to approve customization. Please try again.');
        }
    }

    /**
     * Reject custom requirements and move to digital signature with default terms
     */
    public function rejectCustomization()
    {
        try {
            $contractRequest = ContractRequest::with(['event', 'agreement'])
                ->findOrFail($this->selectedRequestId);

            // Clear the notes and mark as rejected, use default terms
            $contractRequest->update([
                'notes' => null, // Clear the custom requirements
                'customization_status' => 'rejected',
                'customized_terms' => null, // Use default terms from agreement
            ]);

            Log::info('Contract customization rejected', [
                'contract_request_id' => $contractRequest->id,
                'lawyer_id' => Auth::id(),
            ]);

            session()->flash('success', 'Customization rejected. Contract moved to Digital Signature with default terms.');

            $this->closeReviewModal();

            // Redirect to digital signature page
            return redirect()->route('lawyer.digital-signature');
        } catch (\Exception $e) {
            Log::error('Error rejecting customization: ' . $e->getMessage());
            session()->flash('error', 'Failed to reject customization. Please try again.');
        }
    }

    public function render()
    {
        // Get contract requests with custom requirements (notes not null)
        $customizationRequests = ContractRequest::with(['event', 'requester', 'agreement'])
            ->whereNotNull('notes') // Custom requirements requested
            ->where('status', 'pending')
            ->whereNull('customization_status') // Not yet approved or rejected
            ->latest()
            ->get();

        return view('livewire.lawyer.dashboard.contract-customization', [
            'customizationRequests' => $customizationRequests,
        ]);
    }
}
