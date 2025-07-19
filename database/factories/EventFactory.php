<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Category;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first(),
            'chat_id' => Chat::factory()->group(),
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
            'name' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'starts_at' => fake()->dateTimeBetween('now', '+1 hour'),
            'ends_at' => fake()->dateTimeBetween('now', '+7 days'),
            'address_id' => Address::factory(),
            'max_participants' => fake()->numberBetween(1, 100),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'skills' => fake()->words(3, true),
            'minimum_age' => fake()->numberBetween(13, 65),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}
