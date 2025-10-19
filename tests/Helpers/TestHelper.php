<?php

namespace Tests\Helpers;

use App\Models\User;
use App\Models\Event;
use App\Models\Application;
use App\Models\Certificate;
use App\Models\Badge;
use Illuminate\Support\Facades\Hash;

/**
 * Test Helper Class
 * 
 * Provides common helper methods for creating test data and scenarios
 */
class TestHelper
{
    /**
     * Create a user with a specific role
     */
    public static function createUserWithRole(string $role, array $attributes = []): User
    {
        $user = User::factory()->create($attributes);
        $user->assignRole($role);
        return $user;
    }

    /**
     * Create an admin user
     */
    public static function createAdmin(array $attributes = []): User
    {
        return self::createUserWithRole('admin', $attributes);
    }

    /**
     * Create a volunteer user
     */
    public static function createVolunteer(array $attributes = []): User
    {
        return self::createUserWithRole('volunteer', $attributes);
    }

    /**
     * Create a requester user
     */
    public static function createRequester(array $attributes = []): User
    {
        return self::createUserWithRole('requester', $attributes);
    }

    /**
     * Create a lawyer user
     */
    public static function createLawyer(array $attributes = []): User
    {
        return self::createUserWithRole('lawyer', $attributes);
    }

    /**
     * Create an event with a requester
     */
    public static function createEventWithRequester(array $eventAttributes = [], array $requesterAttributes = []): Event
    {
        $requester = self::createRequester($requesterAttributes);
        return Event::factory()->create(array_merge(['user_id' => $requester->id], $eventAttributes));
    }

    /**
     * Create a published event
     */
    public static function createPublishedEvent(array $attributes = []): Event
    {
        return Event::factory()->create(array_merge(['status' => 'published'], $attributes));
    }

    /**
     * Create a completed event
     */
    public static function createCompletedEvent(array $attributes = []): Event
    {
        return Event::factory()->create(array_merge(['status' => 'completed'], $attributes));
    }

    /**
     * Create an application for an event
     */
    public static function createApplication(Event $event, User $volunteer, array $attributes = []): Application
    {
        return Application::factory()->create(array_merge([
            'event_id' => $event->id,
            'user_id' => $volunteer->id,
        ], $attributes));
    }

    /**
     * Apply a volunteer to an event
     */
    public static function applyVolunteerToEvent(User $volunteer, Event $event, string $status = 'pending'): Application
    {
        return self::createApplication($event, $volunteer, ['status' => $status]);
    }

    /**
     * Accept a volunteer for an event
     */
    public static function acceptVolunteerForEvent(User $volunteer, Event $event): Application
    {
        return self::applyVolunteerToEvent($volunteer, $event, 'accepted');
    }

    /**
     * Create multiple volunteers and apply them to an event
     */
    public static function createVolunteersForEvent(Event $event, int $count, string $status = 'pending'): array
    {
        $volunteers = [];
        for ($i = 0; $i < $count; $i++) {
            $volunteer = self::createVolunteer();
            self::applyVolunteerToEvent($volunteer, $event, $status);
            $volunteers[] = $volunteer;
        }
        return $volunteers;
    }

    /**
     * Create a certificate for a volunteer
     */
    public static function createCertificateForVolunteer(User $volunteer, Event $event, array $attributes = []): Certificate
    {
        return Certificate::factory()->create(array_merge([
            'user_id' => $volunteer->id,
            'event_id' => $event->id,
        ], $attributes));
    }

    /**
     * Award a badge to a volunteer
     */
    public static function awardBadgeToVolunteer(User $volunteer, Badge $badge): void
    {
        $volunteer->badges()->attach($badge->id, [
            'awarded_at' => now(),
        ]);
    }

    /**
     * Create a full event scenario with participants
     */
    public static function createFullEventScenario(): array
    {
        $requester = self::createRequester();
        $event = Event::factory()->create([
            'user_id' => $requester->id,
            'status' => 'published',
            'volunteers_needed' => 5,
        ]);

        $volunteers = self::createVolunteersForEvent($event, 3, 'accepted');
        $pendingVolunteers = self::createVolunteersForEvent($event, 2, 'pending');

        return [
            'requester' => $requester,
            'event' => $event,
            'acceptedVolunteers' => $volunteers,
            'pendingVolunteers' => $pendingVolunteers,
        ];
    }

    /**
     * Create a test user with standard password
     */
    public static function createTestUser(array $attributes = []): User
    {
        return User::factory()->create(array_merge([
            'password' => Hash::make('password'),
        ], $attributes));
    }

    /**
     * Create multiple users with a specific role
     */
    public static function createUsersWithRole(string $role, int $count, array $attributes = []): array
    {
        $users = [];
        for ($i = 0; $i < $count; $i++) {
            $users[] = self::createUserWithRole($role, $attributes);
        }
        return $users;
    }

    /**
     * Create a dispute scenario
     */
    public static function createDisputeScenario(): array
    {
        $volunteer = self::createVolunteer();
        $requester = self::createRequester();
        $event = Event::factory()->create(['user_id' => $requester->id]);

        return [
            'volunteer' => $volunteer,
            'requester' => $requester,
            'event' => $event,
        ];
    }

    /**
     * Generate random skill set
     */
    public static function randomSkills(int $count = 3): array
    {
        $allSkills = [
            'first-aid',
            'teaching',
            'cooking',
            'nursing',
            'construction',
            'gardening',
            'technology',
            'administration',
            'event-planning',
            'communication',
        ];

        return array_slice($allSkills, 0, $count);
    }

    /**
     * Generate test date range
     */
    public static function futureEventDateRange(): array
    {
        return [
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(8),
        ];
    }

    /**
     * Generate past date range
     */
    public static function pastEventDateRange(): array
    {
        return [
            'start_date' => now()->subDays(8),
            'end_date' => now()->subDays(7),
        ];
    }

    /**
     * Clear all test data
     */
    public static function clearTestData(): void
    {
        User::query()->delete();
        Event::query()->delete();
        Application::query()->delete();
        Certificate::query()->delete();
    }
}
