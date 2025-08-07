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
                'skills' => 'teamwork environmental awareness',
                'tags' => ['cleaning', 'beach', 'sustainability']
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
                'skills' => 'gardening teamwork',
                'tags' => ['planting', 'nature', 'community']
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
                'skills' => 'empathy communication',
                'tags' => ['social work', 'elderly', 'care']
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
                'skills' => 'leadership public speaking',
                'tags' => ['workshop', 'leadership', 'youth']
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
                'skills' => 'creativity art',
                'tags' => ['art', 'community', 'mural']
            ],
        ];

        $events = array_merge($events, [
            [
                'name' => 'Urban Gardening Workshop',
                'category_id' => 2,
                'maximum_participants' => 35,
                'description' => 'Learn sustainable gardening techniques for small spaces.',
                'starts_at' => now()->addDays(6),
                'ends_at' => now()->addDays(6)->addHours(4),
                'latitude' => 6.9271,
                'longitude' => 79.8612,
                'city' => 'Colombo',
                'notes' => 'Bring a notebook and gardening gloves.',
                'minimum_age' => 15,
                'skills' => 'gardening sustainability',
                'tags' => ['gardening', 'urban', 'sustainability']
            ],
            [
                'name' => 'Charity Run for Education',
                'category_id' => 6,
                'maximum_participants' => 100,
                'description' => 'Join a 5K run to raise funds for local school supplies.',
                'starts_at' => now()->addDays(10),
                'ends_at' => now()->addDays(10)->addHours(3),
                'latitude' => 7.2906,
                'longitude' => 80.6337,
                'city' => 'Kandy',
                'notes' => 'Wear comfortable running shoes.',
                'minimum_age' => 14,
                'skills' => 'fitness teamwork',
                'tags' => ['running', 'charity', 'education']
            ],
            [
                'name' => 'Beach Yoga Session',
                'category_id' => 7,
                'maximum_participants' => 20,
                'description' => 'A relaxing yoga session by the seaside at sunrise.',
                'starts_at' => now()->addDays(8),
                'ends_at' => now()->addDays(8)->addHours(2),
                'latitude' => 6.1471,
                'longitude' => 81.1218,
                'city' => 'Hambantota',
                'notes' => 'Bring a yoga mat or towel.',
                'minimum_age' => 16,
                'skills' => 'yoga mindfulness',
                'tags' => ['yoga', 'wellness', 'beach']
            ],
            [
                'name' => 'Food Drive for Homeless',
                'category_id' => 3,
                'maximum_participants' => 30,
                'description' => 'Collect and distribute food to homeless communities.',
                'starts_at' => now()->addDays(3),
                'ends_at' => now()->addDays(3)->addHours(4),
                'latitude' => 6.0535,
                'longitude' => 80.2210,
                'city' => 'Galle',
                'notes' => 'Bring non-perishable food items to donate.',
                'minimum_age' => 18,
                'skills' => 'organization empathy',
                'tags' => ['charity', 'food drive', 'community']
            ],
            [
                'name' => 'Tech for Kids Workshop',
                'category_id' => 4,
                'maximum_participants' => 25,
                'description' => 'Introduce children to basic coding and robotics.',
                'starts_at' => now()->addDays(9),
                'ends_at' => now()->addDays(9)->addHours(5),
                'latitude' => 8.5874,
                'longitude' => 81.2152,
                'city' => 'Trincomalee',
                'notes' => 'Laptops provided, but bring your own if preferred.',
                'minimum_age' => 15,
                'skills' => 'coding teaching',
                'tags' => ['technology', 'education', 'youth']
            ],
            [
                'name' => 'River Cleanup Initiative',
                'category_id' => 1,
                'maximum_participants' => 40,
                'description' => 'Help clean the riverbanks and promote water conservation.',
                'starts_at' => now()->addDays(5),
                'ends_at' => now()->addDays(5)->addHours(4),
                'latitude' => 6.9864,
                'longitude' => 81.0550,
                'city' => 'Batticaloa',
                'notes' => 'Wear sturdy shoes and bring gloves.',
                'minimum_age' => 16,
                'skills' => 'teamwork environmental awareness',
                'tags' => ['cleaning', 'river', 'sustainability']
            ],
            [
                'name' => 'Cultural Dance Festival',
                'category_id' => 5,
                'maximum_participants' => 50,
                'description' => 'Perform or learn traditional dances from the region.',
                'starts_at' => now()->addDays(12),
                'ends_at' => now()->addDays(12)->addHours(6),
                'latitude' => 9.6615,
                'longitude' => 80.0255,
                'city' => 'Jaffna',
                'notes' => 'Wear comfortable clothing suitable for dancing.',
                'minimum_age' => 14,
                'skills' => 'dancing creativity',
                'tags' => ['dance', 'culture', 'festival']
            ],
            [
                'name' => 'Animal Shelter Volunteer Day',
                'category_id' => 8,
                'maximum_participants' => 15,
                'description' => 'Assist with feeding and caring for animals at a local shelter.',
                'starts_at' => now()->addDays(4),
                'ends_at' => now()->addDays(4)->addHours(3),
                'latitude' => 6.9271,
                'longitude' => 79.8612,
                'city' => 'Colombo',
                'notes' => 'Wear closed-toe shoes and avoid strong perfumes.',
                'minimum_age' => 18,
                'skills' => 'animal care empathy',
                'tags' => ['animals', 'volunteering', 'care']
            ],
            [
                'name' => 'Health Awareness Campaign',
                'category_id' => 8,
                'maximum_participants' => 30,
                'description' => 'Spread awareness about basic health and hygiene practices.',
                'starts_at' => now()->addDays(7),
                'ends_at' => now()->addDays(7)->addHours(4),
                'latitude' => 7.9403,
                'longitude' => 81.0188,
                'city' => 'Ampara',
                'notes' => 'Bring a notebook for taking notes.',
                'minimum_age' => 17,
                'skills' => 'communication public health',
                'tags' => ['health', 'awareness', 'community']
            ],
            [
                'name' => 'Recycling Art Project',
                'category_id' => 5,
                'maximum_participants' => 20,
                'description' => 'Create art pieces from recycled materials to promote sustainability.',
                'starts_at' => now()->addDays(11),
                'ends_at' => now()->addDays(11)->addHours(5),
                'latitude' => 6.9271,
                'longitude' => 79.8612,
                'city' => 'Colombo',
                'notes' => 'Bring any recyclable materials you have.',
                'minimum_age' => 16,
                'skills' => 'creativity art',
                'tags' => ['art', 'recycling', 'sustainability']
            ],
        ]);

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
