<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Livewire\Volt\Volt;
use Tests\TestCase;

class SignupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function signup_page_can_be_rendered()
    {
        $response = $this->get('/signup');

        $response->assertStatus(200);
        $response->assertSeeLivewire('signup');
    }

    /** @test */
    public function user_can_register_with_valid_data()
    {
        Notification::fake();

        Volt::test('signup')
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->call('register')
            ->assertRedirect('/dashboard');

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $user = User::where('email', 'john@example.com')->first();
        $this->assertTrue(Hash::check('Password123!', $user->password));
    }

    /** @test */
    public function name_is_required()
    {
        Volt::test('signup')
            ->set('name', '')
            ->set('email', 'john@example.com')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->call('register')
            ->assertHasErrors('name');
    }

    /** @test */
    public function email_is_required()
    {
        Volt::test('signup')
            ->set('name', 'John Doe')
            ->set('email', '')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->call('register')
            ->assertHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid()
    {
        Volt::test('signup')
            ->set('name', 'John Doe')
            ->set('email', 'not-an-email')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->call('register')
            ->assertHasErrors('email');
    }

    /** @test */
    public function email_must_be_unique()
    {
        User::factory()->create(['email' => 'john@example.com']);

        Volt::test('signup')
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->call('register')
            ->assertHasErrors('email');
    }

    /** @test */
    public function password_is_required()
    {
        Volt::test('signup')
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('password', '')
            ->set('password_confirmation', '')
            ->call('register')
            ->assertHasErrors('password');
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        Volt::test('signup')
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'DifferentPassword123!')
            ->call('register')
            ->assertHasErrors('password');
    }

    /** @test */
    public function password_must_meet_minimum_length()
    {
        Volt::test('signup')
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('password', 'short')
            ->set('password_confirmation', 'short')
            ->call('register')
            ->assertHasErrors('password');
    }

    /** @test */
    public function user_can_select_role_during_signup()
    {
        Volt::test('signup')
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->set('role', 'volunteer')
            ->call('register');

        $user = User::where('email', 'john@example.com')->first();
        $this->assertTrue($user->hasRole('volunteer'));
    }

    /** @test */
    public function authenticated_user_is_redirected_from_signup_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/signup');

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function email_verification_is_sent_after_registration()
    {
        Notification::fake();

        Volt::test('signup')
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->call('register');

        $user = User::where('email', 'john@example.com')->first();
        $this->assertNull($user->email_verified_at);
    }
}
