<?php

namespace App\Livewire\Common;

use App\Services\Messaging;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Component;
use App\Models\Chat as ModelsChat;

class Chat extends Component
{
    /**
     * @var Collection<ModelsChat>
     */
    public Collection $chats;

    #[Session(key: 'currentChat')]
    public $currentChat;

    public $input;

    public $drawerOpen = false;
    
    public $totalUnreadCount = 0;

    public function mount()
    {
        $this->chats = Messaging::getAllDirectChats();
        $this->updateUnreadCount();
    }
    
    public function updateUnreadCount()
    {
        $this->totalUnreadCount = $this->chats->sum(function ($chat) {
            return Messaging::getUnreadMessageCount($chat);
        });
    }


    #[On('openChat')]
    public function openChat($chatId)
    {
        $chat = auth()->user()->chats()->with('messages')->find($chatId);
        $this->drawerOpen = false;
        $this->currentChat = $chat;
        
        // Mark all messages in this chat as read
        if ($chat) {
            Messaging::markMessagesAsRead($chat);
        }
        
        // Refresh the chat list to update unread status
        $this->chats = Messaging::getAllDirectChats();
        $this->updateUnreadCount();
    }

    public function sendMessage($chatId)
    {
        Messaging::sendMessage($this->input, $chatId);
        $this->input = "";
        
        // Refresh the chat list to update latest message
        $this->chats = Messaging::getAllDirectChats();
        $this->updateUnreadCount();
        
        // Refresh current chat to show new message
        $this->currentChat = auth()->user()->chats()->with('messages')->find($chatId);
    }

    public function closeChat()
    {
        $this->currentChat = null;
        $this->input = '';
    }

    public function refreshChats()
    {
        $this->chats = Messaging::getAllDirectChats();
        $this->updateUnreadCount();
        
        // Also refresh current chat if it's open
        if ($this->currentChat) {
            $this->currentChat = auth()->user()->chats()->with('messages')->find($this->currentChat->id);
        }
    }

    public function render()
    {
        return view('livewire.common.chat');
    }
}
