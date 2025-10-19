<?php

namespace App\Livewire\Common;

use App\Models\Event;
use App\Services\FileManager;
use App\Services\Messaging;
use Livewire\Component;
use Livewire\WithFileUploads;

class GroupChat extends Component
{
    use WithFileUploads;

    public $event;
    public $messages;
    public $inputMessage;
    public $fileInput;

    public function mount($eventId)
    {
        $this->event = Event::with('chat')->find($eventId);
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Messaging::getMessagesForChatDisplay($this->event->chat);
    }

    public function sendMessage()
    {
        if ($this->fileInput) {
            $file = FileManager::store($this->fileInput);
        }

        if ($this->event->chat) {
            Messaging::sendMessage($this->inputMessage, $this->event->chat->id, $file->id ?? null);
            $this->inputMessage = '';
            $this->clearFileInput();
        }
    }

    public function clearFileInput()
    {
        $this->fileInput = null;
    }

    public function render()
    {
        return view('livewire.common.group-chat');
    }
}
