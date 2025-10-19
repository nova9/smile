<?php

namespace Tests\Feature\Volunteer;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->volunteer = User::factory()->create();
        $this->volunteer->assignRole('volunteer');
    }

    /** @test */
    public function volunteer_can_view_profile_page()
    {
        $response = $this->actingAs($this->volunteer)->get('/volunteer/profile');

        $response->assertStatus(200);
        $response->assertSeeLivewire('volunteer.dashboard.profile');
    }

    /** @test */
    public function volunteer_can_update_profile()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.profile')
            ->set('name', 'Updated Name')
            ->set('bio', 'Updated bio')
            ->set('phone', '1234567890')
            ->call('updateProfile')
            ->assertHasNoErrors();

        $this->volunteer->refresh();
        $this->assertEquals('Updated Name', $this->volunteer->name);
        $this->assertEquals('Updated bio', $this->volunteer->bio);
    }

    /** @test */
    public function volunteer_can_add_skills()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.profile')
            ->set('skills', ['first-aid', 'teaching', 'cooking'])
            ->call('updateSkills')
            ->assertHasNoErrors();

        $this->assertTrue($this->volunteer->skills->contains('name', 'first-aid'));
    }

    /** @test */
    public function volunteer_can_update_availability()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.profile')
            ->set('availability', ['monday', 'wednesday', 'friday'])
            ->call('updateAvailability')
            ->assertHasNoErrors();
    }

    /** @test */
    public function volunteer_can_upload_profile_picture()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.profile')
            ->set('profilePicture', 'profile.jpg')
            ->call('uploadProfilePicture')
            ->assertHasNoErrors();
    }

    /** @test */
    public function volunteer_can_upload_certifications()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.profile')
            ->set('certification', 'first-aid-cert.pdf')
            ->set('certificationName', 'First Aid Certification')
            ->call('uploadCertification')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('certifications', [
            'user_id' => $this->volunteer->id,
            'name' => 'First Aid Certification',
        ]);
    }

    /** @test */
    public function volunteer_can_update_password()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.profile')
            ->set('currentPassword', 'password')
            ->set('newPassword', 'NewPassword123!')
            ->set('newPassword_confirmation', 'NewPassword123!')
            ->call('updatePassword')
            ->assertHasNoErrors();
    }

    /** @test */
    public function current_password_is_required_for_password_change()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.profile')
            ->set('currentPassword', '')
            ->set('newPassword', 'NewPassword123!')
            ->call('updatePassword')
            ->assertHasErrors('currentPassword');
    }

    /** @test */
    public function new_password_must_be_confirmed()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.profile')
            ->set('currentPassword', 'password')
            ->set('newPassword', 'NewPassword123!')
            ->set('newPassword_confirmation', 'DifferentPassword123!')
            ->call('updatePassword')
            ->assertHasErrors('newPassword');
    }

    /** @test */
    public function volunteer_can_update_notification_preferences()
    {
        $this->actingAs($this->volunteer);

        Volt::test('volunteer.dashboard.profile')
            ->set('emailNotifications', true)
            ->set('smsNotifications', false)
            ->call('updateNotificationPreferences')
            ->assertHasNoErrors();
    }
}
