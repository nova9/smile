<?php

namespace Tests\Feature\Requester;

use App\Models\User;
use App\Models\Event;
use App\Models\Certificate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class CertificateManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->requester = User::factory()->create();
        $this->requester->assignRole('requester');
    }

    /** @test */
    public function requester_can_view_issued_certificates()
    {
        $response = $this->actingAs($this->requester)->get('/requester/certificates');

        $response->assertStatus(200);
        $response->assertSeeLivewire('requester.dashboard.certificates.issued-certificates');
    }

    /** @test */
    public function requester_can_see_certificates_for_their_events()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        Certificate::factory()->count(3)->create(['event_id' => $event->id]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.certificates.issued-certificates')
            ->call('loadCertificates')
            ->assertSet('certificates', function ($certificates) {
                return count($certificates) >= 3;
            });
    }

    /** @test */
    public function requester_can_issue_certificate_to_volunteer()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        $volunteer = User::factory()->create();

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.certificates.certificate')
            ->set('eventId', $event->id)
            ->set('volunteerId', $volunteer->id)
            ->call('issueCertificate')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('certificates', [
            'event_id' => $event->id,
            'user_id' => $volunteer->id,
        ]);
    }

    /** @test */
    public function requester_can_view_certificate_details()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        $certificate = Certificate::factory()->create(['event_id' => $event->id]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.certificates.certificate')
            ->set('certificateId', $certificate->id)
            ->call('viewCertificate')
            ->assertHasNoErrors();
    }

    /** @test */
    public function requester_can_download_certificate()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        $certificate = Certificate::factory()->create(['event_id' => $event->id]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.certificates.certificate')
            ->set('certificateId', $certificate->id)
            ->call('downloadCertificate')
            ->assertFileDownloaded();
    }

    /** @test */
    public function requester_can_revoke_certificate()
    {
        $event = Event::factory()->create(['user_id' => $this->requester->id]);
        $certificate = Certificate::factory()->create([
            'event_id' => $event->id,
            'status' => 'active',
        ]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.certificates.issued-certificates')
            ->call('revokeCertificate', $certificate->id)
            ->assertHasNoErrors();

        $this->assertEquals('revoked', $certificate->fresh()->status);
    }

    /** @test */
    public function requester_can_filter_certificates_by_event()
    {
        $event1 = Event::factory()->create(['user_id' => $this->requester->id]);
        $event2 = Event::factory()->create(['user_id' => $this->requester->id]);
        
        Certificate::factory()->count(2)->create(['event_id' => $event1->id]);
        Certificate::factory()->count(3)->create(['event_id' => $event2->id]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.certificates.issued-certificates')
            ->set('eventFilter', $event1->id)
            ->call('filterCertificates')
            ->assertSet('certificates', function ($certificates) {
                return count($certificates) === 2;
            });
    }

    /** @test */
    public function requester_cannot_access_certificates_from_other_requesters()
    {
        $otherRequester = User::factory()->create();
        $event = Event::factory()->create(['user_id' => $otherRequester->id]);
        $certificate = Certificate::factory()->create(['event_id' => $event->id]);

        $this->actingAs($this->requester);

        Volt::test('requester.dashboard.certificates.certificate')
            ->set('certificateId', $certificate->id)
            ->call('viewCertificate')
            ->assertForbidden();
    }
}
