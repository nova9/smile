<?php

namespace Tests\Feature\Common;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_view_notifications()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/notifications');

        $response->assertStatus(200);
        $response->assertSeeLivewire('common.notification');
    }

    /** @test */
    public function guest_cannot_access_notifications()
    {
        $response = $this->get('/notifications');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function user_can_see_their_notifications()
    {
        $user = User::factory()->create();
        
        $user->notifications()->create([
            'type' => 'App\Notifications\TestNotification',
            'data' => ['message' => 'Test notification'],
        ]);

        $this->actingAs($user);

        Volt::test('common.notification')
            ->call('loadNotifications')
            ->assertSet('notifications', function ($notifications) {
                return count($notifications) === 1;
            });
    }

    /** @test */
    public function user_can_mark_notification_as_read()
    {
        $user = User::factory()->create();
        
        $notification = $user->notifications()->create([
            'type' => 'App\Notifications\TestNotification',
            'data' => ['message' => 'Test notification'],
            'read_at' => null,
        ]);

        $this->actingAs($user);

        Volt::test('common.notification')
            ->call('markAsRead', $notification->id)
            ->assertHasNoErrors();

        $this->assertNotNull($notification->fresh()->read_at);
    }

    /** @test */
    public function user_can_mark_all_notifications_as_read()
    {
        $user = User::factory()->create();
        
        $user->notifications()->createMany([
            [
                'type' => 'App\Notifications\TestNotification',
                'data' => ['message' => 'Notification 1'],
            ],
            [
                'type' => 'App\Notifications\TestNotification',
                'data' => ['message' => 'Notification 2'],
            ],
        ]);

        $this->actingAs($user);

        Volt::test('common.notification')
            ->call('markAllAsRead')
            ->assertHasNoErrors();

        $this->assertEquals(0, $user->unreadNotifications()->count());
    }

    /** @test */
    public function user_can_delete_notification()
    {
        $user = User::factory()->create();
        
        $notification = $user->notifications()->create([
            'type' => 'App\Notifications\TestNotification',
            'data' => ['message' => 'Test notification'],
        ]);

        $this->actingAs($user);

        Volt::test('common.notification')
            ->call('deleteNotification', $notification->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('notifications', [
            'id' => $notification->id,
        ]);
    }

    /** @test */
    public function notifications_are_ordered_by_newest_first()
    {
        $user = User::factory()->create();
        
        $user->notifications()->create([
            'type' => 'App\Notifications\TestNotification',
            'data' => ['message' => 'Old notification'],
            'created_at' => now()->subDays(2),
        ]);

        $user->notifications()->create([
            'type' => 'App\Notifications\TestNotification',
            'data' => ['message' => 'New notification'],
            'created_at' => now(),
        ]);

        $this->actingAs($user);

        Volt::test('common.notification')
            ->call('loadNotifications')
            ->assertSet('notifications', function ($notifications) {
                return $notifications->first()->data['message'] === 'New notification';
            });
    }

    /** @test */
    public function user_cannot_access_other_users_notifications()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        
        $notification = $otherUser->notifications()->create([
            'type' => 'App\Notifications\TestNotification',
            'data' => ['message' => 'Private notification'],
        ]);

        $this->actingAs($user);

        Volt::test('common.notification')
            ->call('markAsRead', $notification->id)
            ->assertForbidden();
    }
}
