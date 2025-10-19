<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    /** @test */
    public function admin_can_view_event_details()
    {
        $event = Event::factory()->create();

        $response = $this->actingAs($this->admin)->get("/admin/events/{$event->id}");

        $response->assertStatus(200);
        $response->assertSeeLivewire('admin.dashboard.event-details');
    }

    /** @test */
    public function admin_can_approve_event()
    {
        $event = Event::factory()->create(['status' => 'pending']);

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.event-details')
            ->set('eventId', $event->id)
            ->call('approveEvent')
            ->assertHasNoErrors();

        $this->assertEquals('approved', $event->fresh()->status);
    }

    /** @test */
    public function admin_can_reject_event()
    {
        $event = Event::factory()->create(['status' => 'pending']);

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.event-details')
            ->set('eventId', $event->id)
            ->set('rejectionReason', 'Does not meet community guidelines')
            ->call('rejectEvent')
            ->assertHasNoErrors();

        $this->assertEquals('rejected', $event->fresh()->status);
    }

    /** @test */
    public function admin_can_cancel_event()
    {
        $event = Event::factory()->create(['status' => 'approved']);

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.event-details')
            ->set('eventId', $event->id)
            ->set('cancellationReason', 'Safety concerns')
            ->call('cancelEvent')
            ->assertHasNoErrors();

        $this->assertEquals('cancelled', $event->fresh()->status);
    }

    /** @test */
    public function admin_can_view_event_participants()
    {
        $event = Event::factory()->create();
        $participants = User::factory()->count(5)->create();
        
        foreach ($participants as $participant) {
            $event->participants()->attach($participant->id);
        }

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.event-details')
            ->set('eventId', $event->id)
            ->call('loadParticipants')
            ->assertSet('participants', function ($participants) {
                return count($participants) === 5;
            });
    }

    /** @test */
    public function admin_can_moderate_event_reviews()
    {
        $event = Event::factory()->create();

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.event-details')
            ->set('eventId', $event->id)
            ->set('reviewId', 1)
            ->call('removeReview')
            ->assertHasNoErrors();
    }

    /** @test */
    public function rejection_reason_is_required_when_rejecting_event()
    {
        $event = Event::factory()->create(['status' => 'pending']);

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.event-details')
            ->set('eventId', $event->id)
            ->set('rejectionReason', '')
            ->call('rejectEvent')
            ->assertHasErrors('rejectionReason');
    }
}
