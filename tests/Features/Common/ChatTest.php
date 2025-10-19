<?php

namespace Tests\Feature\Common;

use App\Models\User;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_access_chat()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/chat');

        $response->assertStatus(200);
        $response->assertSeeLivewire('common.chat');
    }

    /** @test */
    public function guest_cannot_access_chat()
    {
        $response = $this->get('/chat');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function user_can_send_message_in_one_to_one_chat()
    {
        $sender = User::factory()->create();
        $recipient = User::factory()->create();
        $chat = Chat::factory()->create();

        $this->actingAs($sender);

        Volt::test('common.chat')
            ->set('chatId', $chat->id)
            ->set('message', 'Hello, how are you?')
            ->call('sendMessage')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('messages', [
            'chat_id' => $chat->id,
            'user_id' => $sender->id,
            'content' => 'Hello, how are you?',
        ]);
    }

    /** @test */
    public function user_can_send_file_attachment()
    {
        $sender = User::factory()->create();
        $chat = Chat::factory()->create();

        $this->actingAs($sender);

        Volt::test('common.chat')
            ->set('chatId', $chat->id)
            ->set('message', 'Check this file')
            ->set('attachment', 'document.pdf')
            ->call('sendMessage')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('messages', [
            'chat_id' => $chat->id,
            'user_id' => $sender->id,
        ]);
    }

    /** @test */
    public function message_content_is_required()
    {
        $user = User::factory()->create();
        $chat = Chat::factory()->create();

        $this->actingAs($user);

        Volt::test('common.chat')
            ->set('chatId', $chat->id)
            ->set('message', '')
            ->call('sendMessage')
            ->assertHasErrors('message');
    }

    /** @test */
    public function user_can_view_chat_history()
    {
        $user = User::factory()->create();
        $chat = Chat::factory()->create();
        Message::factory()->count(10)->create(['chat_id' => $chat->id]);

        $this->actingAs($user);

        Volt::test('common.chat')
            ->set('chatId', $chat->id)
            ->call('loadMessages')
            ->assertSet('messages', function ($messages) {
                return count($messages) === 10;
            });
    }

    /** @test */
    public function user_cannot_access_chat_they_are_not_participant_of()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $chat = Chat::factory()->create();

        $this->actingAs($user);

        Volt::test('common.chat')
            ->set('chatId', $chat->id)
            ->call('loadMessages')
            ->assertForbidden();
    }

    /** @test */
    public function messages_are_paginated()
    {
        $user = User::factory()->create();
        $chat = Chat::factory()->create();
        Message::factory()->count(50)->create(['chat_id' => $chat->id]);

        $this->actingAs($user);

        Volt::test('common.chat')
            ->set('chatId', $chat->id)
            ->call('loadMessages')
            ->assertSet('messages', function ($messages) {
                return count($messages) <= 20; // Assuming 20 per page
            });
    }

    /** @test */
    public function user_receives_realtime_message_updates()
    {
        $user = User::factory()->create();
        $chat = Chat::factory()->create();

        $this->actingAs($user);

        // Simulate receiving a message
        $message = Message::factory()->create([
            'chat_id' => $chat->id,
            'content' => 'New message',
        ]);

        Volt::test('common.chat')
            ->set('chatId', $chat->id)
            ->dispatch('message-received', $message->id)
            ->assertDispatched('message-received');
    }
}
