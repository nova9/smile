<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function forgot_password_page_can_be_rendered()
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
        $response->assertSeeLivewire('forgotpassword');
    }

    /** @test */
    public function reset_link_can_be_requested_for_existing_user()
    {
        Notification::fake();

        $user = User::factory()->create(['email' => 'test@example.com']);

        Volt::test('forgotpassword')
            ->set('email', 'test@example.com')
            ->call('sendResetLink')
            ->assertHasNoErrors();

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /** @test */
    public function email_is_required()
    {
        Volt::test('forgotpassword')
            ->set('email', '')
            ->call('sendResetLink')
            ->assertHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid()
    {
        Volt::test('forgotpassword')
            ->set('email', 'not-an-email')
            ->call('sendResetLink')
            ->assertHasErrors('email');
    }

    /** @test */
    public function non_existing_email_returns_generic_success_message()
    {
        Notification::fake();

        Volt::test('forgotpassword')
            ->set('email', 'nonexistent@example.com')
            ->call('sendResetLink')
            ->assertHasNoErrors();

        Notification::assertNothingSent();
    }

    /** @test */
    public function password_reset_is_rate_limited()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);

        for ($i = 0; $i < 5; $i++) {
            Volt::test('forgotpassword')
                ->set('email', 'test@example.com')
                ->call('sendResetLink');
        }

        Volt::test('forgotpassword')
            ->set('email', 'test@example.com')
            ->call('sendResetLink')
            ->assertHasErrors('email');
    }

    /** @test */
    public function authenticated_user_is_redirected_from_forgot_password_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/forgot-password');

        $response->assertRedirect('/dashboard');
    }
}
