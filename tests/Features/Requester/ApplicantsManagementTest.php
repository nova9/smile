<?php

namespace Tests\Feature\Requester;

use App\Models\User;
use App\Models\Event;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ApplicantsManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->requester = User::factory()->create();
        $this->requester->assignRole('requester');
    }

    /** @test */
    public function requester_can_view_applicants_page()
    {
        $response = $this->actingAs($this->requester)->get('/requester/applicants');

        $response->assertStatus(200);
        $response->assertSeeLivewire('requester.dashboard.applicants');
    }

    /** @test */
    public function requester_can_view_applicants_for_their_events()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        $volunteers = User::factory()->count(5)->create();
        
        foreach ($volunteers as $volunteer) {
            Application::factory()->create([
                'event_id' => $event->id,
                'user_id' => $volunteer->id,
            ]);
        }

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.applicants')
            ->set('eventId', $event->id)
            ->call('loadApplicants')
            ->assertSet('applicants', function ($applicants) {
                return count($applicants) === 5;
            });
    }

    /** @test */
    public function requester_can_accept_applicant()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        $volunteer = User::factory()->create();
        $application = Application::factory()->create([
            'event_id' => $event->id,
            'user_id' => $volunteer->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.applicants')
            ->call('acceptApplicant', $application->id)
            ->assertHasNoErrors();

        $this->assertEquals('accepted', $application->fresh()->status);
    }

    /** @test */
    public function requester_can_reject_applicant()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        $volunteer = User::factory()->create();
        $application = Application::factory()->create([
            'event_id' => $event->id,
            'user_id' => $volunteer->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.applicants')
            ->call('rejectApplicant', $application->id)
            ->assertHasNoErrors();

        $this->assertEquals('rejected', $application->fresh()->status);
    }

    /** @test */
    public function requester_can_waitlist_applicant()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        $volunteer = User::factory()->create();
        $application = Application::factory()->create([
            'event_id' => $event->id,
            'user_id' => $volunteer->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.applicants')
            ->call('waitlistApplicant', $application->id)
            ->assertHasNoErrors();

        $this->assertEquals('waitlisted', $application->fresh()->status);
    }

    /** @test */
    public function requester_can_message_applicant()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        $volunteer = User::factory()->create();
        $application = Application::factory()->create([
            'event_id' => $event->id,
            'user_id' => $volunteer->id,
        ]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.applicants')
            ->set('applicantId', $volunteer->id)
            ->set('message', 'Thank you for applying!')
            ->call('sendMessage')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('messages', [
            'sender_id' => $this->requester->id,
            'recipient_id' => $volunteer->id,
        ]);
    }

    /** @test */
    public function requester_can_filter_applicants_by_status()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        Application::factory()->count(3)->create([
            'event_id' => $event->id,
            'status' => 'accepted',
        ]);
        Application::factory()->count(2)->create([
            'event_id' => $event->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.applicants')
            ->set('eventId', $event->id)
            ->set('statusFilter', 'accepted')
            ->call('filterApplicants')
            ->assertSet('applicants', function ($applicants) {
                return count($applicants) === 3;
            });
    }

    /** @test */
    public function requester_can_perform_bulk_accept()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        $applications = Application::factory()->count(3)->create([
            'event_id' => $event->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.applicants')
            ->set('selectedApplicants', $applications->pluck('id')->toArray())
            ->call('bulkAccept')
            ->assertHasNoErrors();

        foreach ($applications as $application) {
            $this->assertEquals('accepted', $application->fresh()->status);
        }
    }

    /** @test */
    public function requester_cannot_manage_applicants_for_other_users_events()
    {
        $otherRequester = User::factory()->create();
        $event = Event::factory()->create(['user_id' => $otherRequester->id]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.applicants')
            ->set('eventId', $event->id)
            ->call('loadApplicants')
            ->assertForbidden();
    }
}
