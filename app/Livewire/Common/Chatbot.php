<?php

namespace App\Livewire\Common;

use Livewire\Component;
use App\Services\ChatbotService;
use Livewire\Volt\Compilers\Mount;

class Chatbot extends Component
{
    public $messages = [];
    public $input = '';
    public $reply = '';

    public function mount()
    {
        $this->messages = session('chatbot_messages', []);
    }

    public function sendMessage()
    {
        if (trim($this->input) === '') return;

        $this->messages[] = [
            'role' => 'user',
            'content' => $this->input,
        ];

        $service = app(ChatbotService::class);
        $this->reply = $service->getChatbotReply($this->messages);
        $this->messages[] = [
            'role' => 'assistant',
            'content' => $this->reply,
        ];

        session(['chatbot_messages' => $this->messages]);
        $this->input = '';
    }

    public function render()
    {
        return view('livewire.common.chatbot');
    }

    public function logoutClearChat()
    {
        session()->forget('chatbot_messages');
        $this->messages = [];
    }
}
