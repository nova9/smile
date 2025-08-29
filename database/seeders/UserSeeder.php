<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\Event;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::where('name', 'admin')->first();
        User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@smile.test',
            'password' => 'admin@123',
            'role_id' => $roleAdmin->id
        ]);

        $roleLawyer = Role::where('name', 'lawyer')->first();
        User::query()->create([
            'name' => 'Lawyer',
            'email' => 'lawyer@smile.test',
            'password' => 'lawyer@123',
            'role_id' => $roleLawyer->id
        ]);

        $roleRequester = Role::where('name', 'requester')->first();
        User::factory()->count(3)->recycle($roleRequester)->create();
        User::query()->create([
            'name' => 'Requester',
            'email' => 'r@s.com',
            'password' => 'password',
            'role_id' => $roleRequester->id
        ]);

        $roleVolunteer = Role::where('name', 'volunteer')->first();
        User::query()->create([
            'name' => 'Volunteer',
            'email' => 'v@s.com',
            'password' => 'password',
            'role_id' => $roleVolunteer->id
        ]);

        // Add more volunteers for demo/testing
        User::query()->create([
            'name' => 'Volunteer Two',
            'email' => 'v2@s.com',
            'password' => 'password',
            'role_id' => $roleVolunteer->id
        ]);
        User::query()->create([
            'name' => 'Volunteer Three',
            'email' => 'v3@s.com',
            'password' => 'password',
            'role_id' => $roleVolunteer->id
        ]);
        $existingBadges = Badge::all();
        User::factory()
            ->count(15)
            ->recycle($roleVolunteer)
            ->has(Event::factory()
                ->has(Tag::factory()->count(3))
                ->count(2), 'organizingEvents')
            ->create()
            ->each(function (User $user) use ($existingBadges) {
                $randomBadges = $existingBadges->random(rand(0, $existingBadges->count()));
                $user->badges()->attach($randomBadges);
            });
    }
}
