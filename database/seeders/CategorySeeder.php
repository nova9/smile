<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // volunteer categories
        $categories = [
            ['name' => 'Environmental Protection', 'color' => '#4CAF50'],
            ['name' => 'Education and Literacy', 'color' => '#2196F3'],
            ['name' => 'Health and Wellness', 'color' => '#FF9800'],
            ['name' => 'Community Development', 'color' => '#9C27B0'],
            ['name' => 'Animal Welfare', 'color' => '#FF5722'],
            ['name' => 'Disaster Relief', 'color' => '#607D8B'],
            ['name' => 'Arts and Culture', 'color' => '#E91E63'],
            ['name' => 'Human Rights', 'color' => '#3F51B5'],
        ];

        Category::query()->insert($categories);
    }
}
