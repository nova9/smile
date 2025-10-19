<?php

namespace Tests\Feature\Volunteer;

use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class VolunteerDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->volunteer = User::factory()->create();
        $this->volunteer->assignRole('volunteer');
    }

    /** @test */
    public function volunteer_can_access_dashboard()
    {
        $response = $this->actingAs($this->volunteer)->get('/volunteer/dashboard');

        $response->assertStatus(200);
        $response->assertSeeLivewire('volunteer.dashboard.index');
    }

    /** @test */
    public function non_volunteer_cannot_access_volunteer_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/volunteer/dashboard');

        $response->assertStatus(403);
    }

    /** @test */
    public function dashboard_shows_recommended_events()
    {
        Event::factory()->count(5)->create(['status' => 'published']);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.index')
            ->call('loadRecommendedEvents')
            ->assertSet('recommendedEvents', function ($events) {
                return count($events) > 0;
            });
    }

    /** @test */
    public function dashboard_shows_upcoming_events()
    {
        $events = Event::factory()->count(3)->create([
            'status' => 'published',
            'start_date' => now()->addDays(5),
        ]);

        foreach ($events as $event) {
            $event->participants()->attach($this->volunteer->id);
        }

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.index')
            ->call('loadUpcomingEvents')
            ->assertSet('upcomingEvents', function ($events) {
                return count($events) === 3;
            });
    }

    /** @test */
    public function dashboard_shows_volunteer_statistics()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.index')
            ->assertSet('totalHours', function ($hours) {
                return is_numeric($hours);
            })
            ->assertSet('eventsCompleted', function ($count) {
                return is_numeric($count);
            });
    }
}
