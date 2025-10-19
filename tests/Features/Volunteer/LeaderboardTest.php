<?php

namespace Tests\Feature\Volunteer;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class LeaderboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->volunteer = User::factory()->create();
        $this->volunteer->assignRole('volunteer');
    }

    /** @test */
    public function volunteer_can_view_leaderboard()
    {
        $response = $this->actingAs($this->volunteer)->get('/volunteer/leaderboard');

        $response->assertStatus(200);
        $response->assertSeeLivewire('volunteer.dashboard.leaderboard');
    }

    /** @test */
    public function leaderboard_displays_top_volunteers()
    {
        $volunteers = User::factory()->count(10)->create();
        
        foreach ($volunteers as $volunteer) {
            $volunteer->assignRole('volunteer');
        }

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.leaderboard')
            ->call('loadLeaderboard')
            ->assertSet('topVolunteers', function ($volunteers) {
                return count($volunteers) > 0;
            });
    }

    /** @test */
    public function volunteer_can_filter_leaderboard_by_time_range()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.leaderboard')
            ->set('timeRange', 'month')
            ->call('filterByTimeRange')
            ->assertHasNoErrors();
    }

    /** @test */
    public function volunteer_can_view_their_rank()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.leaderboard')
            ->call('loadMyRank')
            ->assertSet('myRank', function ($rank) {
                return is_numeric($rank);
            });
    }

    /** @test */
    public function leaderboard_shows_volunteer_scores()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.leaderboard')
            ->call('loadLeaderboard')
            ->assertSet('topVolunteers', function ($volunteers) {
                return isset($volunteers[0]['score']);
            });
    }
}
