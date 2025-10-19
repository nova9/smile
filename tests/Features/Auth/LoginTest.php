<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_page_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSeeLivewire('login');
    }

    /** @test */
    public function user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        Volt::test('login')
            ->set('email', 'test@example.com')
            ->set('password', 'password123')
            ->call('login')
            ->assertRedirect('/dashboard');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_login_with_invalid_email()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        Volt::test('login')
            ->set('email', 'wrong@example.com')
            ->set('password', 'password123')
            ->call('login')
            ->assertHasErrors('email');

        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_with_invalid_password()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        Volt::test('login')
            ->set('email', 'test@example.com')
            ->set('password', 'wrongpassword')
            ->call('login')
            ->assertHasErrors('email');

        $this->assertGuest();
    }

    /** @test */
    public function email_is_required()
    {
        Volt::test('login')
            ->set('email', '')
            ->set('password', 'password123')
            ->call('login')
            ->assertHasErrors('email');
    }

    /** @test */
    public function password_is_required()
    {
        Volt::test('login')
            ->set('email', 'test@example.com')
            ->set('password', '')
            ->call('login')
            ->assertHasErrors('password');
    }

    /** @test */
    public function remember_me_persists_session()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        Volt::test('login')
            ->set('email', 'test@example.com')
            ->set('password', 'password123')
            ->set('remember', true)
            ->call('login');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function authenticated_user_is_redirected_from_login_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function user_is_redirected_to_intended_url_after_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $this->get('/profile');

        Volt::test('login')
            ->set('email', 'test@example.com')
            ->set('password', 'password123')
            ->call('login')
            ->assertRedirect('/profile');
    }

    /** @test */
    public function login_is_rate_limited_after_multiple_failed_attempts()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            Volt::test('login')
                ->set('email', 'test@example.com')
                ->set('password', 'wrongpassword')
                ->call('login');
        }

        Volt::test('login')
            ->set('email', 'test@example.com')
            ->set('password', 'password123')
            ->call('login')
            ->assertHasErrors('email');

        $this->assertGuest();
    }

    /** @test */
    public function disabled_user_cannot_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'status' => 'disabled',
        ]);

        Volt::test('login')
            ->set('email', 'test@example.com')
            ->set('password', 'password123')
            ->call('login')
            ->assertHasErrors('email');

        $this->assertGuest();
    }
}
