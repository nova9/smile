<?php

namespace App\Livewire\Common;

use App\Models\Event;
use Livewire\Component;

class GroupChat extends Component
{
    public $event;
    public $inputMessage;

    public function mount($eventId)
    {
        $this->event = Event::find($eventId);
    }

    public function render()
    {
        return view('livewire.common.group-chat');
    }
}
