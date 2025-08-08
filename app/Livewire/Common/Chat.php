<?php

namespace App\Livewire\Common;

use App\Services\Messaging;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Models\Chat as ModelsChat;

class Chat extends Component
{
    /**
     * @var Collection<ModelsChat>
     */
    public Collection $chats;

    public $currentChat;

    public $input;

    public $drawerOpen = false;

    public function mount()
    {
        $this->chats = Messaging::getAllDirectChats();
    }

    public function openChat($chatId)
    {
        $chat = auth()->user()->chats()->with('messages')->find($chatId);
        $this->drawerOpen = false;
        $this->currentChat = $chat;
    }

    public function sendMessage($chatId)
    {
        Messaging::sendMessage($this->input, $chatId);
        $this->input = "";
    }

    public function closeChat()
    {
        $this->currentChat = null;
        $this->input = '';
    }

    public function render()
    {
        return view('livewire.common.chat');
    }
}
