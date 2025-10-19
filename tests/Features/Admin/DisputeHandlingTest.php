<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class DisputeHandlingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    /** @test */
    public function admin_can_view_disputes_page()
    {
        $response = $this->actingAs($this->admin)->get('/admin/disputes');

        $response->assertStatus(200);
        $response->assertSeeLivewire('admin.dashboard.dispute-handling');
    }

    /** @test */
    public function admin_can_view_all_disputes()
    {
        // Create sample disputes
        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.dispute-handling')
            ->call('loadDisputes')
            ->assertHasNoErrors();
    }

    /** @test */
    public function admin_can_assign_dispute_to_handler()
    {
        $handler = User::factory()->create();
        $handler->assignRole('admin');

        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.dispute-handling')
            ->set('disputeId', 1)
            ->set('handlerId', $handler->id)
            ->call('assignDispute')
            ->assertHasNoErrors();
    }

    /** @test */
    public function admin_can_resolve_dispute()
    {
        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.dispute-handling')
            ->set('disputeId', 1)
            ->set('resolution', 'Issue has been resolved through mediation')
            ->set('outcome', 'resolved')
            ->call('resolveDispute')
            ->assertHasNoErrors();
    }

    /** @test */
    public function admin_can_attach_evidence_to_dispute()
    {
        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.dispute-handling')
            ->set('disputeId', 1)
            ->set('evidence', ['document.pdf'])
            ->call('attachEvidence')
            ->assertHasNoErrors();
    }

    /** @test */
    public function admin_can_filter_disputes_by_status()
    {
        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.dispute-handling')
            ->set('statusFilter', 'pending')
            ->call('filterDisputes')
            ->assertHasNoErrors();
    }

    /** @test */
    public function admin_can_add_notes_to_dispute()
    {
        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.dispute-handling')
            ->set('disputeId', 1)
            ->set('note', 'Both parties have been contacted')
            ->call('addNote')
            ->assertHasNoErrors();
    }

    /** @test */
    public function resolution_is_required_when_resolving_dispute()
    {
        $this->actingAs($this->admin);

        Volt::test('admin.dashboard.dispute-handling')
            ->set('disputeId', 1)
            ->set('resolution', '')
            ->call('resolveDispute')
            ->assertHasErrors('resolution');
    }

    /** @test */
    public function non_admin_cannot_access_dispute_handling()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/disputes');

        $response->assertStatus(403);
    }
}
