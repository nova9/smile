<?php

namespace Tests\Feature\Common;

use App\Models\User;
use App\Models\SupportTicket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class HelpSupportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_access_help_support()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/help-support');

        $response->assertStatus(200);
        $response->assertSeeLivewire('common.help-support');
    }

    /** @test */
    public function guest_cannot_access_help_support()
    {
        $response = $this->get('/help-support');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function user_can_create_support_ticket()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Volt::test('common.help-support')
            ->set('subject', 'Need help with account')
            ->set('message', 'I cannot access my profile settings')
            ->set('category', 'technical')
            ->call('createTicket')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('support_tickets', [
            'user_id' => $user->id,
            'subject' => 'Need help with account',
            'category' => 'technical',
        ]);
    }

    /** @test */
    public function subject_is_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Volt::test('common.help-support')
            ->set('subject', '')
            ->set('message', 'Some message')
            ->call('createTicket')
            ->assertHasErrors('subject');
    }

    /** @test */
    public function message_is_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Volt::test('common.help-support')
            ->set('subject', 'Help needed')
            ->set('message', '')
            ->call('createTicket')
            ->assertHasErrors('message');
    }

    /** @test */
    public function user_can_attach_files_to_ticket()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Volt::test('common.help-support')
            ->set('subject', 'Bug report')
            ->set('message', 'Found a bug')
            ->set('attachments', ['screenshot.png'])
            ->call('createTicket')
            ->assertHasNoErrors();

        $ticket = SupportTicket::latest()->first();
        $this->assertNotNull($ticket->attachments);
    }

    /** @test */
    public function user_can_view_their_support_tickets()
    {
        $user = User::factory()->create();
        SupportTicket::factory()->count(3)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        Volt::test('common.help-support')
            ->call('loadTickets')
            ->assertSet('tickets', function ($tickets) {
                return count($tickets) === 3;
            });
    }

    /** @test */
    public function user_can_view_ticket_details()
    {
        $user = User::factory()->create();
        $ticket = SupportTicket::factory()->create([
            'user_id' => $user->id,
            'subject' => 'Test Ticket',
        ]);

        $this->actingAs($user);

        Volt::test('common.help-support')
            ->set('selectedTicket', $ticket->id)
            ->call('viewTicket')
            ->assertSet('ticketDetails.subject', 'Test Ticket');
    }

    /** @test */
    public function user_cannot_view_other_users_tickets()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $ticket = SupportTicket::factory()->create(['user_id' => $otherUser->id]);

        $this->actingAs($user);

        Volt::test('common.help-support')
            ->set('selectedTicket', $ticket->id)
            ->call('viewTicket')
            ->assertForbidden();
    }

    /** @test */
    public function user_can_reply_to_ticket()
    {
        $user = User::factory()->create();
        $ticket = SupportTicket::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        Volt::test('common.help-support')
            ->set('ticketId', $ticket->id)
            ->set('reply', 'Additional information here')
            ->call('addReply')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('support_ticket_replies', [
            'support_ticket_id' => $ticket->id,
            'message' => 'Additional information here',
        ]);
    }

    /** @test */
    public function user_can_close_their_ticket()
    {
        $user = User::factory()->create();
        $ticket = SupportTicket::factory()->create([
            'user_id' => $user->id,
            'status' => 'open',
        ]);

        $this->actingAs($user);

        Volt::test('common.help-support')
            ->call('closeTicket', $ticket->id)
            ->assertHasNoErrors();

        $this->assertEquals('closed', $ticket->fresh()->status);
    }
}
