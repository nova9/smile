<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;
use App\Models\Agreement;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ContractDrafting extends Component
{
    // Form fields
    public $topic = '';
    public $terms = '';

    // Edit mode
    public $editingAgreementId = null;
    public $isEditMode = false;

    public function mount()
    {
        // Set default terms if empty
        if (empty($this->terms)) {
            $this->terms = "1. The volunteer agrees to perform assigned duties diligently and responsibly.\n2. The organization will provide necessary guidance and a safe work environment.\n3. Confidential information must not be disclosed without consent.\n4. Either party may terminate this agreement with prior notice.";
        }
    }

    public function saveAgreement()
    {
        // Validate the input
        $this->validate([
            'topic' => 'required|string|max:255',
            'terms' => 'required|string',
        ]);

        try {
            if ($this->isEditMode && $this->editingAgreementId) {
                // Update existing agreement
                $agreement = Agreement::findOrFail($this->editingAgreementId);
                $agreement->update([
                    'topic' => $this->topic,
                    'terms' => $this->terms,
                ]);

                Log::info('Agreement updated successfully', [
                    'id' => $agreement->id,
                    'topic' => $agreement->topic,
                    'lawyer_id' => Auth::id()
                ]);

                session()->flash('message', 'Contract agreement updated successfully!');
            } else {
                // Create new agreement
                $agreement = Agreement::create([
                    'topic' => $this->topic,
                    'terms' => $this->terms,
                ]);

                Log::info('Agreement saved successfully', [
                    'id' => $agreement->id,
                    'topic' => $agreement->topic,
                    'lawyer_id' => Auth::id()
                ]);

                session()->flash('message', 'Contract agreement saved successfully!');
            }

            // Reset form fields
            $this->reset(['topic', 'terms', 'editingAgreementId', 'isEditMode']);

            // Set default terms again after reset
            $this->terms = "1. The volunteer agrees to perform assigned duties diligently and responsibly.\n2. The organization will provide necessary guidance and a safe work environment.\n3. Confidential information must not be disclosed without consent.\n4. Either party may terminate this agreement with prior notice.";

            // Dispatch browser event to close modal
            $this->dispatch('agreementSaved');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error saving agreement', [
                'error' => $e->getMessage(),
                'lawyer_id' => Auth::id()
            ]);

            // Flash error message
            session()->flash('error', 'Error saving agreement: ' . $e->getMessage());
        }
    }

    public function editAgreement($agreementId)
    {
        try {
            $agreement = Agreement::findOrFail($agreementId);

            $this->editingAgreementId = $agreement->id;
            $this->topic = $agreement->topic;
            $this->terms = $agreement->terms;
            $this->isEditMode = true;

            // Dispatch event to open modal in edit mode
            $this->dispatch('editAgreement', agreementId: $agreementId);

            Log::info('Editing agreement', [
                'id' => $agreementId,
                'lawyer_id' => Auth::id()
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading agreement for edit', [
                'error' => $e->getMessage(),
                'agreement_id' => $agreementId,
                'lawyer_id' => Auth::id()
            ]);

            session()->flash('error', 'Error loading agreement: ' . $e->getMessage());
        }
    }

    public function deleteAgreement($agreementId)
    {
        try {
            $agreement = Agreement::findOrFail($agreementId);
            $agreementTopic = $agreement->topic;

            $agreement->delete();

            Log::info('Agreement deleted successfully', [
                'id' => $agreementId,
                'topic' => $agreementTopic,
                'lawyer_id' => Auth::id()
            ]);

            session()->flash('message', 'Contract agreement deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting agreement', [
                'error' => $e->getMessage(),
                'agreement_id' => $agreementId,
                'lawyer_id' => Auth::id()
            ]);

            session()->flash('error', 'Error deleting agreement: ' . $e->getMessage());
        }
    }

    public function cancelEdit()
    {
        $this->reset(['topic', 'terms', 'editingAgreementId', 'isEditMode']);

        // Set default terms again after reset
        $this->terms = "1. The volunteer agrees to perform assigned duties diligently and responsibly.\n2. The organization will provide necessary guidance and a safe work environment.\n3. Confidential information must not be disclosed without consent.\n4. Either party may terminate this agreement with prior notice.";
    }

    public function render()
    {
        // Fetch saved agreements from database (latest first)
        $savedAgreements = Agreement::latest()->get();

        return view('livewire.lawyer.dashboard.contract-drafting', [
            'savedAgreements' => $savedAgreements
        ]);
    }
}
