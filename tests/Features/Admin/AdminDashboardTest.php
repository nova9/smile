<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    /** @test */
    public function admin_can_access_dashboard()
    {
        $response = $this->actingAs($this->admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSeeLivewire('admin.dashboard.index');
    }

    /** @test */
    public function non_admin_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    /** @test */
    public function guest_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function dashboard_displays_key_metrics()
    {
        User::factory()->count(10)->create();
        Event::factory()->count(5)->create();

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.index')
            ->assertSet('totalUsers', function ($count) {
                return $count > 0;
            })
            ->assertSet('totalEvents', function ($count) {
                return $count > 0;
            });
    }

    /** @test */
    public function admin_can_filter_dashboard_by_date_range()
    {
        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.index')
            ->set('startDate', now()->subDays(7)->format('Y-m-d'))
            ->set('endDate', now()->format('Y-m-d'))
            ->call('filterByDate')
            ->assertHasNoErrors();
    }

    /** @test */
    public function dashboard_shows_recent_activities()
    {
        Event::factory()->count(5)->create(['created_at' => now()->subHours(2)]);

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.index')
            ->call('loadRecentActivities')
            ->assertSet('recentActivities', function ($activities) {
                return count($activities) > 0;
            });
    }

    /** @test */
    public function admin_can_export_dashboard_data()
    {
        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.index')
            ->call('exportData')
            ->assertFileDownloaded('dashboard-export.csv');
    }
}
