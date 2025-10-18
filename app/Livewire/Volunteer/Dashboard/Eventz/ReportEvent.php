<?php

namespace App\Livewire\Volunteer\Dashboard\Eventz;

use Livewire\Component;
use App\Models\Event;
use App\Models\EventReport;

class ReportEvent extends Component
{
    public $eventId;
    public $reason = '';
    public $details = '';
    public $showModal = false;

    protected $rules = [
        'reason' => 'required|string',
        'details' => 'nullable|string|max:500',
    ];

    public function mount($eventId)
    {
        $this->eventId = $eventId;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['reason', 'details']);
    }

    public function submit()
    {
        $this->validate();

        // Check if user already reported this event
        $existingReport = EventReport::where('event_id', $this->eventId)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReport) {
            session()->flash('error', 'You have already reported this event.');
            $this->closeModal();
            return;
        }

        // Create the report
        EventReport::create([
            'event_id' => $this->eventId,
            'user_id' => auth()->id(),
            'reason' => $this->reason,
            'details' => $this->details,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Event reported successfully. Admin will review it.');
        $this->closeModal();
        $this->dispatch('reportSubmitted');
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.eventz.report-event');
    }
}
