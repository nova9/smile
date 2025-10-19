<?php

namespace Tests\Feature\Volunteer;

use App\Models\User;
use App\Models\Badge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class AchievementsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->volunteer = User::factory()->create();
        $this->volunteer->assignRole('volunteer');
    }

    /** @test */
    public function volunteer_can_view_achievements_page()
    {
        $response = $this->actingAs($this->volunteer)->get('/volunteer/achievements');

        $response->assertStatus(200);
        $response->assertSeeLivewire('volunteer.dashboard.achievements');
    }

    /** @test */
    public function volunteer_can_see_their_badges()
    {
        $badges = Badge::factory()->count(3)->create();
        
        foreach ($badges as $badge) {
            $this->volunteer->badges()->attach($badge->id);
        }

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.achievements')
            ->call('loadBadges')
            ->assertSet('badges', function ($badges) {
                return count($badges) === 3;
            });
    }

    /** @test */
    public function volunteer_can_view_achievement_details()
    {
        $badge = Badge::factory()->create();
        $this->volunteer->badges()->attach($badge->id);

        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.achievements-content')
            ->set('badgeId', $badge->id)
            ->call('viewBadgeDetails')
            ->assertHasNoErrors();
    }

    /** @test */
    public function volunteer_can_see_milestones()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.achievements')
            ->call('loadMilestones')
            ->assertSet('milestones', function ($milestones) {
                return is_array($milestones) || is_countable($milestones);
            });
    }

    /** @test */
    public function volunteer_can_view_progress_towards_next_badge()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.achievements')
            ->call('loadProgress')
            ->assertSet('progress', function ($progress) {
                return is_array($progress);
            });
    }
}
