<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function reset_password_page_can_be_rendered_with_valid_token()
    {
        $user = User::factory()->create();
        $token = Password::createToken($user);

        $response = $this->get("/reset-password/{$token}?email={$user->email}");

        $response->assertStatus(200);
        $response->assertSeeLivewire('resetpassword');
    }

    /** @test */
    public function password_can_be_reset_with_valid_token()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $token = Password::createToken($user);

        Volt::test('resetpassword')
            ->set('token', $token)
            ->set('email', 'test@example.com')
            ->set('password', 'NewPassword123!')
            ->set('password_confirmation', 'NewPassword123!')
            ->call('resetPassword')
            ->assertRedirect('/login');

        $user->refresh();
        $this->assertTrue(Hash::check('NewPassword123!', $user->password));
    }

    /** @test */
    public function password_cannot_be_reset_with_invalid_token()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);

        Volt::test('resetpassword')
            ->set('token', 'invalid-token')
            ->set('email', 'test@example.com')
            ->set('password', 'NewPassword123!')
            ->set('password_confirmation', 'NewPassword123!')
            ->call('resetPassword')
            ->assertHasErrors('email');
    }

    /** @test */
    public function password_cannot_be_reset_with_expired_token()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $token = Password::createToken($user);

        // Simulate token expiration by traveling in time
        $this->travel(2)->hours();

        Volt::test('resetpassword')
            ->set('token', $token)
            ->set('email', 'test@example.com')
            ->set('password', 'NewPassword123!')
            ->set('password_confirmation', 'NewPassword123!')
            ->call('resetPassword')
            ->assertHasErrors('email');
    }

    /** @test */
    public function email_is_required()
    {
        Volt::test('resetpassword')
            ->set('token', 'some-token')
            ->set('email', '')
            ->set('password', 'NewPassword123!')
            ->set('password_confirmation', 'NewPassword123!')
            ->call('resetPassword')
            ->assertHasErrors('email');
    }

    /** @test */
    public function password_is_required()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $token = Password::createToken($user);

        Volt::test('resetpassword')
            ->set('token', $token)
            ->set('email', 'test@example.com')
            ->set('password', '')
            ->set('password_confirmation', '')
            ->call('resetPassword')
            ->assertHasErrors('password');
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $token = Password::createToken($user);

        Volt::test('resetpassword')
            ->set('token', $token)
            ->set('email', 'test@example.com')
            ->set('password', 'NewPassword123!')
            ->set('password_confirmation', 'DifferentPassword123!')
            ->call('resetPassword')
            ->assertHasErrors('password');
    }

    /** @test */
    public function password_must_meet_minimum_length()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $token = Password::createToken($user);

        Volt::test('resetpassword')
            ->set('token', $token)
            ->set('email', 'test@example.com')
            ->set('password', 'short')
            ->set('password_confirmation', 'short')
            ->call('resetPassword')
            ->assertHasErrors('password');
    }

    /** @test */
    public function token_cannot_be_reused_after_successful_reset()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $token = Password::createToken($user);

        Volt::test('resetpassword')
            ->set('token', $token)
            ->set('email', 'test@example.com')
            ->set('password', 'NewPassword123!')
            ->set('password_confirmation', 'NewPassword123!')
            ->call('resetPassword');

        Volt::test('resetpassword')
            ->set('token', $token)
            ->set('email', 'test@example.com')
            ->set('password', 'AnotherPassword123!')
            ->set('password_confirmation', 'AnotherPassword123!')
            ->call('resetPassword')
            ->assertHasErrors('email');
    }
}
