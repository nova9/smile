<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'Starter Helper',
                'description' => 'Completed first 1 hour of volunteering.',
                'points' => 1,
                'icon_name' => 'badge1.svg'
            ],
            [
                'name' => '100-Hour Legend',
                'description' => 'Reached 100 hours of volunteering.',
                'points' => 100,
                'icon_name' => 'badge2.svg'
            ],
            [
                'name' => 'First Event',
                'description' => 'Participated in your first event.',
                'points' => 1,
                'icon_name' => 'badge3.svg'
            ],
            [
                'name' => 'Event Pro',
                'description' => 'Participated in 10 events.',
                'points' => 10,
                'icon_name' => 'badge4.svg'
            ],
            [
                'name' => 'Monthly Star',
                'description' => 'Volunteered at least once a month for 6 months.',
                'points' => 6,
                'icon_name' => 'badge5.svg'
            ],
            [
                'name' => 'Team Player',
                'description' => 'Completed a team-based task.',
                'points' => 1,
                'icon_name' => 'badge6.svg'
            ],
            [
                'name' => 'Volunteer of the Month',
                'description' => 'Recognized as the best volunteer in a month.',
                'points' => 'monthly_top',
                'icon_name' => 'badge7.svg'
            ],
            [
                'name' => 'Lifetime Achiever',
                'description' => 'Earned 500+ volunteer hours.',
                'points' => 500,
                'icon_name' => 'badge8.svg'
            ],
        ];

        foreach ($badges as $badge) {
            $file = \App\Models\File::query()->create([
                'name' => $badge['icon_name'],
            ]);
            \App\Models\Badge::query()->create([
                'name' => $badge['name'],
                'description' => $badge['description'],
                'points' => $badge['points'],
                'icon_file_id' => $file->id,
            ]);
        }
    }
}
