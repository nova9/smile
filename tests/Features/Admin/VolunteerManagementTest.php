<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class VolunteerManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    /** @test */
    public function admin_can_view_volunteer_management_page()
    {
        $response = $this->actingAs($this->admin)->get('/admin/volunteers');

        $response->assertStatus(200);
        $response->assertSeeLivewire('admin.dashboard.volunteer-management');
    }

    /** @test */
    public function admin_can_view_all_volunteers()
    {
        $volunteers = User::factory()->count(5)->create();
        foreach ($volunteers as $volunteer) {
            $volunteer->assignRole('volunteer');
        }

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.volunteer-management')
            ->call('loadVolunteers')
            ->assertSet('volunteers', function ($volunteers) {
                return count($volunteers) === 5;
            });
    }

    /** @test */
    public function admin_can_approve_volunteer()
    {
        $volunteer = User::factory()->create(['status' => 'pending']);
        $volunteer->assignRole('volunteer');

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.volunteer-management')
            ->call('approveVolunteer', $volunteer->id)
            ->assertHasNoErrors();

        $this->assertEquals('approved', $volunteer->fresh()->status);
    }

    /** @test */
    public function admin_can_reject_volunteer()
    {
        $volunteer = User::factory()->create(['status' => 'pending']);
        $volunteer->assignRole('volunteer');

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.volunteer-management')
            ->call('rejectVolunteer', $volunteer->id)
            ->assertHasNoErrors();

        $this->assertEquals('rejected', $volunteer->fresh()->status);
    }

    /** @test */
    public function admin_can_suspend_volunteer()
    {
        $volunteer = User::factory()->create(['status' => 'active']);
        $volunteer->assignRole('volunteer');

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.volunteer-management')
            ->call('suspendVolunteer', $volunteer->id)
            ->assertHasNoErrors();

        $this->assertEquals('suspended', $volunteer->fresh()->status);
    }

    /** @test */
    public function admin_can_filter_volunteers_by_status()
    {
        User::factory()->count(3)->create(['status' => 'active']);
        User::factory()->count(2)->create(['status' => 'pending']);

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.volunteer-management')
            ->set('statusFilter', 'active')
            ->call('filterVolunteers')
            ->assertSet('volunteers', function ($volunteers) {
                return count($volunteers) === 3;
            });
    }

    /** @test */
    public function admin_can_search_volunteers_by_name()
    {
        User::factory()->create(['name' => 'John Doe']);
        User::factory()->create(['name' => 'Jane Smith']);

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.volunteer-management')
            ->set('search', 'John')
            ->call('searchVolunteers')
            ->assertSet('volunteers', function ($volunteers) {
                return count($volunteers) === 1 && $volunteers->first()->name === 'John Doe';
            });
    }

    /** @test */
    public function admin_can_perform_bulk_approval()
    {
        $volunteers = User::factory()->count(3)->create(['status' => 'pending']);

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.volunteer-management')
            ->set('selectedVolunteers', $volunteers->pluck('id')->toArray())
            ->call('bulkApprove')
            ->assertHasNoErrors();

        foreach ($volunteers as $volunteer) {
            $this->assertEquals('approved', $volunteer->fresh()->status);
        }
    }

    /** @test */
    public function non_admin_cannot_manage_volunteers()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/volunteers');

        $response->assertStatus(403);
    }
}
