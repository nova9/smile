<?php

namespace App\Livewire\Common;

use App\Models\Event;
use App\Services\Messaging;
use Livewire\Component;

class GroupChat extends Component
{
    public $event;
    public $inputMessage;

    public function mount($eventId)
    {
        $this->event = Event::with('chat')->find($eventId);
    }

    public function sendMessage()
    {
        if (empty($this->inputMessage)) {
            return;
        }

        if ($this->event->chat) {
            Messaging::sendMessage($this->inputMessage, $this->event->chat->id);
            $this->inputMessage = '';
        }
    }

    public function render()
    {
        return view('livewire.common.group-chat');
    }
}
