<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use OpenAI\Laravel\Facades\OpenAI;

class ChatbotService
{
    public $context;
    public function __construct()
    {
        $this->context = file_get_contents(storage_path('app/context.txt'));
        // dd($this->context);
    }

    public function getChatbotReply(array $messages): ?string
    {
        // dd($messages);
        $context = $this->context;
        $systemMessage = [
            'role' => 'system',
            'content' => [
                [   
                    'type' => 'text',
                    'text' => $context,
                ]
            ],
        ];

        $formattedMessages = collect($messages)->map(function ($msg) {
            return [
                'role' => $msg['role'],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => $msg['content'],
                    ]
                ],
            ];
        })->toArray();

        array_unshift($formattedMessages, $systemMessage);

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => $formattedMessages,
        ]);
        // dd($response['choices'][0]['message']['content']); // --- IGNORE ---

        // If you want to return the reply, uncomment below:
        return $response['choices'][0]['message']['content'] ?? null;

        // return null;
    }

  
}
