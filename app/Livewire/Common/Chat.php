<?php

namespace App\Livewire\Common;

use App\Services\Messaging;
use App\Services\FileManager;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Chat as ModelsChat;

class Chat extends Component
{
    use WithFileUploads;

    /**
     * @var Collection<ModelsChat>
     */
    public Collection $chats;

    #[Session(key: 'currentChat')]
    public $currentChat;

    public $input;

    public $drawerOpen = false;

    public $totalUnreadCount = 0;

    public $attachment;

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
        $chat = auth()->user()->chats()->with(['messages.file', 'messages.user'])->find($chatId);
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
        if ($this->attachment) {
            $file = FileManager::store($this->attachment);
        }

        Messaging::sendMessage($this->input, $chatId, $file->id ?? null);
        $this->input = '';
        $this->attachment = null;

        // Refresh the chat list to update latest message
        $this->chats = Messaging::getAllDirectChats();

        // Refresh current chat to show new message
        $this->currentChat = auth()->user()->chats()->with('messages')->find($chatId);
    }

    public function removeAttachment()
    {
        $this->attachment = null;
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
            $this->currentChat = auth()->user()->chats()->with(['messages.file', 'messages.user'])->find($this->currentChat->id);
        }
    }

    public function render()
    {
        return view('livewire.common.chat');
    }
}
