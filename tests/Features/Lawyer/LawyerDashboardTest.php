<?php

namespace Tests\Feature\Lawyer;

use App\Models\User;
use App\Models\Contract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class LawyerDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->lawyer = User::factory()->create();
        $this->lawyer->assignRole('lawyer');
    }

    /** @test */
    public function lawyer_can_access_dashboard()
    {
        $response = $this->actingAs($this->lawyer)->get('/lawyer/dashboard');

        $response->assertStatus(200);
        $response->assertSeeLivewire('lawyer.dashboard.index');
    }

    /** @test */
    public function non_lawyer_cannot_access_lawyer_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/lawyer/dashboard');

        $response->assertStatus(403);
    }

    /** @test */
    public function lawyer_can_view_assigned_contracts()
    {
        Contract::factory()->count(3)->create(['lawyer_id' => $this->lawyer->id]);

        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.index')
            ->call('loadContracts')
            ->assertSet('contracts', function ($contracts) {
                return count($contracts) === 3;
            });
    }

    /** @test */
    public function lawyer_dashboard_shows_pending_matters()
    {
        $this->actingAs($this->lawyer);

        Volt::test('lawyer.dashboard.index')
            ->assertSet('pendingMatters', function ($matters) {
                return is_countable($matters);
            });
    }
}
