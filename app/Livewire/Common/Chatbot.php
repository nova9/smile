<?php

namespace App\Livewire\Common;

use Livewire\Component;
use App\Services\ChatbotService;

class Chatbot extends Component
{
    public $messages = [];

    public $input = '';

    public function sendMessage()
    {
        if (trim($this->input) === '') return;

        // // Add user message
        $this->messages[] = [
            'role' => 'user',
            'content' => $this->input,
        ];
        // dd($this->messages);

        // Get reply from ChatbotService
        $service = app(ChatbotService::class);
        $formattedMessages = $service->formatMessagesForOpenAI($this->messages);
        $reply = $service->getChatbotReply($formattedMessages);

        // Add bot reply
        $this->messages[] = [
            'role' => 'assistant',
            'content' => $reply,
        ];

        $this->input = '';
    }

    public function render()
    {
        return view('livewire.common.chatbot');
    }
}
