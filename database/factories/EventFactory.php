<?php

namespace Database\Factories;

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
            'category_id' => Category::factory(),
            'chat_id' => Chat::factory()->group(),
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
            'name' => fake()->sentence(),
            'description' => fake()->optional()->paragraph(),
        ];
    }
}
