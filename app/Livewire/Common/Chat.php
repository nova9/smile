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
        // Validate that either message or file is provided
        $this->validate([
            'input' => 'required_without:attachment|string|max:1000',
            'attachment' => 'nullable|file|max:10240', // 10MB max
        ]);

        $fileId = null;
        $messageType = Message::TYPE_TEXT;

        // Handle file upload if present
        if ($this->attachment) {
            $file = FileManager::store($this->attachment, auth()->id());
            $fileId = $file->id;

            // Determine message type based on mime type
            $mimeType = $this->attachment->getMimeType();
            if (str_starts_with($mimeType, 'image/')) {
                $messageType = Message::TYPE_IMAGE;
            } else {
                $messageType = Message::TYPE_DOCUMENT;
            }
        }

        // Send message with file info
        Messaging::sendMessage(
            $this->input ?: ($messageType === Message::TYPE_IMAGE ? 'Sent an image' : 'Sent a document'),
            $chatId,
            $fileId,
            $messageType
        );

        $this->input = "";
        $this->attachment = null;
        
        // Refresh the chat list to update latest message
        $this->chats = Messaging::getAllDirectChats();
        $this->updateUnreadCount();
        
        // Refresh current chat to show new message
        $this->currentChat = auth()->user()->chats()->with(['messages.file', 'messages.user'])->find($chatId);
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
