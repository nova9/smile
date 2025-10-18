<?php

namespace Database\Seeders;

use App\Jobs\GenerateEmbedding;
use App\Models\Chat;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'Beach Cleanup Campaign',
                'category_id' => 1,
                'maximum_participants' => 50,
                'description' => 'Join us to clean up the coastal areas and help preserve marine life.',
                'starts_at' => now()->addDays(3),
                'ends_at' => now()->addDays(3)->addHours(5),
                'latitude' => 6.9271,
                'longitude' => 79.8612,
                'city' => 'Colombo',
                'notes' => 'Bring gloves and reusable water bottles.',
                'minimum_age' => 16,
                'skills' => ['teamwork', 'environmental awareness'],
                'recruiting_method' => 'first_come',
                'tags' => ['cleaning', 'beach', 'sustainability'],
                'participant_requirements' => [
                    [
                        'filter_types' => 'gender',
                        'male_participants' => 20,
                        'female_participants' => 20,
                        'non_binary_participants' => 10
                    ],
                    [
                        'filter_types' => 'level',
                        'beginner_participants' => 15,
                        'intermediate_participants' => 20,
                        'advanced_participants' => 15
                    ]
                ]
            ],
            [
                'name' => 'Tree Planting Day',
                'category_id' => 2,
                'maximum_participants' => 30,
                'description' => 'Help plant 100 trees in a reforestation effort.',
                'starts_at' => now()->addDays(5),
                'ends_at' => now()->addDays(5)->addHours(3),
                'latitude' => 7.2906,
                'longitude' => 80.6337,
                'city' => 'Kandy',
                'notes' => 'Wear outdoor shoes and bring water.',
                'minimum_age' => 18,
                'skills' => ['gardening', 'teamwork'],
                'recruiting_method' => 'application_review',
                'tags' => ['planting', 'nature', 'community'],
                'participant_requirements' => [
                    [
                        'filter_types' => 'gender',
                        'male_participants' => 10,
                        'female_participants' => 10,
                        'non_binary_participants' => 10
                    ],
                    [
                        'filter_types' => 'level',
                        'beginner_participants' => 10,
                        'intermediate_participants' => 10,
                        'advanced_participants' => 10
                    ]
                ]
            ],
            [
                'name' => 'Elderly Home Visit',
                'category_id' => 3,
                'maximum_participants' => 20,
                'description' => 'Spend time with senior citizens and assist with daily tasks.',
                'starts_at' => now()->addDays(2),
                'ends_at' => now()->addDays(2)->addHours(4),
                'latitude' => 6.0535,
                'longitude' => 80.2210,
                'city' => 'Galle',
                'notes' => 'Bring any games or music if you like.',
                'minimum_age' => 18,
                'skills' => ['empathy', 'communication'],
                'recruiting_method' => 'first_come',
                'tags' => ['social work', 'elderly', 'care'],
                'participant_requirements' => [
                    [
                        'filter_types' => 'gender',
                        'male_participants' => 7,
                        'female_participants' => 7,
                        'non_binary_participants' => 6
                    ],
                    [
                        'filter_types' => 'level',
                        'beginner_participants' => 7,
                        'intermediate_participants' => 7,
                        'advanced_participants' => 6
                    ]
                ]
            ],
            [
                'name' => 'Youth Leadership Workshop',
                'category_id' => 4,
                'maximum_participants' => 40,
                'description' => 'A workshop focused on developing leadership and communication skills.',
                'starts_at' => now()->addDays(7),
                'ends_at' => now()->addDays(7)->addHours(6),
                'latitude' => 8.5874,
                'longitude' => 81.2152,
                'city' => 'Trincomalee',
                'notes' => 'Lunch and snacks provided.',
                'minimum_age' => 17,
                'skills' => ['leadership', 'public speaking'],
                'recruiting_method' => 'skill_assessment',
                'tags' => ['workshop', 'leadership', 'youth'],
                'participant_requirements' => [
                    [
                        'filter_types' => 'gender',
                        'male_participants' => 15,
                        'female_participants' => 15,
                        'non_binary_participants' => 10
                    ],
                    [
                        'filter_types' => 'level',
                        'beginner_participants' => 10,
                        'intermediate_participants' => 15,
                        'advanced_participants' => 15
                    ]
                ]
            ],
            [
                'name' => 'Community Mural Painting',
                'category_id' => 5,
                'maximum_participants' => 25,
                'description' => 'Help paint a mural in the town center to promote unity and culture.',
                'starts_at' => now()->addDays(4),
                'ends_at' => now()->addDays(4)->addHours(5),
                'latitude' => 9.6615,
                'longitude' => 80.0255,
                'city' => 'Jaffna',
                'notes' => 'Wear clothes you can get paint on.',
                'minimum_age' => 16,
                'skills' => ['creativity', 'art'],
                'recruiting_method' => 'first_come',
                'tags' => ['art', 'community', 'mural'],
                'participant_requirements' => [
                    [
                        'filter_types' => 'gender',
                        'male_participants' => 10,
                        'female_participants' => 10,
                        'non_binary_participants' => 5
                    ],
                    [
                        'filter_types' => 'level',
                        'beginner_participants' => 10,
                        'intermediate_participants' => 10,
                        'advanced_participants' => 5
                    ]
                ]
            ],
        ];

        $user = User::where('email', 'r@s.com')->first();

        foreach ($events as $data) {

            $chat = Chat::create(['is_group' => true]);

            $event = collect($data);
            $sanitized = $event->except(['tags']);


            $event = $user->organizingEvents()->create([
                ...$sanitized,
                'chat_id' => $chat->id,
            ]);

            $tagIds = collect($data['tags'])->map(function ($tagName) {
                return Tag::firstOrCreate(['name' => $tagName])->id;
            });

            $event->tags()->sync($tagIds);

            GenerateEmbedding::dispatch($event, ['name', 'description', 'skills', 'notes']);
        }
    }
}
