<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatbotService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('openai');
    }

    public function getChatbotReply(array $messages): ?string
    {
        // dd($messages);
        $response = Http::withToken($this->apiKey)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('https://api.openai.com/v1/chat/completions',[
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages,
            ]);
        dd($response->body());

        if ($response->successful()) {
            dd($response['choices'][0]['message']['content']);
            return $response['choices'][0]['message']['content'] ?? null;
        }

        // Handle error (log, throw, etc.)
        return null;
    }

    public function formatMessagesForOpenAI($chatMessages)
    {
        // Convert your Message models to OpenAI format
        return collect($chatMessages)->map(function ($msg) {
            // dd($msg['role']);
            return [
                'role' => $msg['role'],
                'content' => $msg['content'],
            ];
        })->toArray();
    }
}
