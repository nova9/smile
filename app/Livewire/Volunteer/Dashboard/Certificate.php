<?php

namespace App\Livewire\Volunteer\Dashboard;

use Livewire\Component;
use App\Models\Event;

class Certificate extends Component
{
    public $certificate;
    public $requester;
    public $id;

    public function mount($id)
    {
        $this->id = $id;
        $event = Event::where('id', $id)->first();

        if ($event) {
            $this->certificate = [
                'id' => $event->id,
                'name' => $event->name,
                'description' => $event->description,
                'starts_at' => $event->starts_at,
                'ends_at' => $event->ends_at,
            ];

            $this->requester = $event->user ? [
                'name' => $event->user->name,
            ] : null;
        } else {
            $this->certificate = null;
            $this->requester = null;
        }
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.certificate');
    }
}
