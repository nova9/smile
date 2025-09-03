<?php

namespace App\Livewire\Common;

use Livewire\Component;
use App\Services\ChatbotService;
use Livewire\Volt\Compilers\Mount;

class Chatbot extends Component
{

    
    public $messages = [];

    public $input = '';
    public $reply='';
    

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
        $this->reply = $service->getChatbotReply($this->messages);
        // dd($reply);
        // Add bot reply
        $this->messages[] = [
            'role' => 'assistant',
            'content' => $this->reply,
        ];

        $this->input = '';
    }

    public function render()
    {
        return view('livewire.common.chatbot');
    }
}
