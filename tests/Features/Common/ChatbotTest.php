<?php

namespace Tests\Feature\Common;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ChatbotTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_access_chatbot()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/chatbot');

        $response->assertStatus(200);
        $response->assertSeeLivewire('common.chatbot');
    }

    /** @test */
    public function guest_cannot_access_chatbot()
    {
        $response = $this->get('/chatbot');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function user_can_send_prompt_to_chatbot()
    {
        Http::fake([
            'api.openai.com/*' => Http::response([
                'choices' => [
                    ['message' => ['content' => 'This is a response from the chatbot']]
                ]
            ], 200),
        ]);

        $user = User::factory()->create();
        $this->actingAs($user);

        Volt::test('common.chatbot')
            ->set('prompt', 'Hello, chatbot!')
            ->call('sendPrompt')
            ->assertSet('response', 'This is a response from the chatbot')
            ->assertHasNoErrors();
    }

    /** @test */
    public function prompt_is_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Volt::test('common.chatbot')
            ->set('prompt', '')
            ->call('sendPrompt')
            ->assertHasErrors('prompt');
    }

    /** @test */
    public function chatbot_maintains_conversation_context()
    {
        Http::fake([
            'api.openai.com/*' => Http::response([
                'choices' => [
                    ['message' => ['content' => 'Contextual response']]
                ]
            ], 200),
        ]);

        $user = User::factory()->create();
        $this->actingAs($user);

        $component = Volt::test('common.chatbot')
            ->set('prompt', 'First message')
            ->call('sendPrompt')
            ->set('prompt', 'Follow-up message')
            ->call('sendPrompt');

        $this->assertTrue(count($component->get('conversationHistory')) >= 2);
    }

    /** @test */
    public function chatbot_is_rate_limited()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Http::fake([
            'api.openai.com/*' => Http::response([
                'choices' => [
                    ['message' => ['content' => 'Response']]
                ]
            ], 200),
        ]);

        for ($i = 0; $i < 10; $i++) {
            Volt::test('common.chatbot')
                ->set('prompt', 'Message ' . $i)
                ->call('sendPrompt');
        }

        Volt::test('common.chatbot')
            ->set('prompt', 'One more message')
            ->call('sendPrompt')
            ->assertHasErrors();
    }

    /** @test */
    public function chatbot_handles_api_errors_gracefully()
    {
        Http::fake([
            'api.openai.com/*' => Http::response([], 500),
        ]);

        $user = User::factory()->create();
        $this->actingAs($user);

        Volt::test('common.chatbot')
            ->set('prompt', 'Hello')
            ->call('sendPrompt')
            ->assertHasErrors();
    }

    /** @test */
    public function user_can_clear_conversation_history()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Volt::test('common.chatbot')
            ->set('conversationHistory', [
                ['role' => 'user', 'content' => 'Hello'],
                ['role' => 'assistant', 'content' => 'Hi there!'],
            ])
            ->call('clearHistory')
            ->assertSet('conversationHistory', []);
    }
}
