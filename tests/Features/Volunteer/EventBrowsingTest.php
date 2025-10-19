<?php

namespace Tests\Feature\Volunteer;

use App\Models\User;
use App\Models\Event;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class EventBrowsingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->volunteer = User::factory()->create();
        $this->volunteer->assignRole('volunteer');
    }

    /** @test */
    public function volunteer_can_view_events_page()
    {
        $response = $this->actingAs($this->volunteer)->get('/volunteer/events');

        $response->assertStatus(200);
        $response->assertSeeLivewire('volunteer.dashboard.events');
    }

    /** @test */
    public function volunteer_can_browse_available_events()
    {
        Event::factory()->count(10)->create(['status' => 'published']);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.events')
            ->call('loadEvents')
            ->assertSet('events', function ($events) {
                return count($events) === 10;
            });
    }

    /** @test */
    public function volunteer_can_search_events_by_keyword()
    {
        Event::factory()->create([
            'title' => 'Beach Cleanup',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Tree Planting',
            'status' => 'published',
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.events')
            ->set('search', 'Beach')
            ->call('searchEvents')
            ->assertSet('events', function ($events) {
                return count($events) === 1 && $events->first()->title === 'Beach Cleanup';
            });
    }

    /** @test */
    public function volunteer_can_filter_events_by_date()
    {
        Event::factory()->count(3)->create([
            'status' => 'published',
            'start_date' => now()->addDays(7),
        ]);
        Event::factory()->count(2)->create([
            'status' => 'published',
            'start_date' => now()->addDays(14),
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.events')
            ->set('dateFrom', now()->format('Y-m-d'))
            ->set('dateTo', now()->addDays(10)->format('Y-m-d'))
            ->call('filterByDate')
            ->assertSet('events', function ($events) {
                return count($events) === 3;
            });
    }

    /** @test */
    public function volunteer_can_filter_events_by_location()
    {
        Event::factory()->count(2)->create([
            'status' => 'published',
            'location' => 'Miami',
        ]);
        Event::factory()->create([
            'status' => 'published',
            'location' => 'New York',
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.events')
            ->set('locationFilter', 'Miami')
            ->call('filterByLocation')
            ->assertSet('events', function ($events) {
                return count($events) === 2;
            });
    }

    /** @test */
    public function volunteer_can_apply_to_event()
    {
        $event = Event::factory()->create(['status' => 'published']);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.events')
            ->set('eventId', $event->id)
            ->call('applyToEvent')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('applications', [
            'event_id' => $event->id,
            'user_id' => $this->volunteer->id,
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function volunteer_cannot_apply_to_full_event()
    {
        $event = Event::factory()->create([
            'status' => 'published',
            'volunteers_needed' => 5,
            'volunteers_accepted' => 5,
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.events')
            ->set('eventId', $event->id)
            ->call('applyToEvent')
            ->assertHasErrors();
    }

    /** @test */
    public function volunteer_cannot_apply_to_closed_event()
    {
        $event = Event::factory()->create(['status' => 'closed']);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.events')
            ->set('eventId', $event->id)
            ->call('applyToEvent')
            ->assertHasErrors();
    }

    /** @test */
    public function volunteer_can_withdraw_application()
    {
        $event = Event::factory()->create(['status' => 'published']);
        $application = Application::factory()->create([
            'event_id' => $event->id,
            'user_id' => $this->volunteer->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.events')
            ->call('withdrawApplication', $application->id)
            ->assertHasNoErrors();

        $this->assertEquals('withdrawn', $application->fresh()->status);
    }

    /** @test */
    public function volunteer_cannot_apply_twice_to_same_event()
    {
        $event = Event::factory()->create(['status' => 'published']);
        Application::factory()->create([
            'event_id' => $event->id,
            'user_id' => $this->volunteer->id,
        ]);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.events')
            ->set('eventId', $event->id)
            ->call('applyToEvent')
            ->assertHasErrors();
    }
}
