<?php

namespace Tests\Feature\Requester;

use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class RequesterDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->requester = User::factory()->create();
        $this->requester->assignRole('requester');
    }

    /** @test */
    public function requester_can_access_dashboard()
    {
        $response = $this->actingAs($this->requester)->get('/requester/dashboard');

        $response->assertStatus(200);
        $response->assertSeeLivewire('requester.dashboard.index');
    }

    /** @test */
    public function non_requester_cannot_access_requester_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/requester/dashboard');

        $response->assertStatus(403);
    }

    /** @test */
    public function dashboard_displays_requester_metrics()
    {
        Event::factory()->count(5)->create(['user_id' => $this->requester->id]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.index')
            ->assertSet('totalEvents', function ($count) {
                return $count === 5;
            });
    }

    /** @test */
    public function requester_can_see_upcoming_events()
    {
        Event::factory()->count(3)->create([
            'user_id' => $this->requester->id,
            'start_date' => now()->addDays(5),
        ]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.index')
            ->call('loadUpcomingEvents')
            ->assertSet('upcomingEvents', function ($events) {
                return count($events) === 3;
            });
    }
}
