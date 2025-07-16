<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resources = [
            [
                'name' => 'Money',
                'description' => 'Funds required for the event',
                'unit' => 'cents'
            ],
            [
                'name' => 'Chairs',
                'description' => 'Seating for participants',
                'unit' => 'pcs'
            ],
            [
                'name' => 'Tables',
                'description' => 'Tables for event activities',
                'unit' => 'pcs'
            ],
            [
                'name' => 'Water Bottles',
                'description' => 'Drinking water for volunteers and attendees',
                'unit' => 'pcs'
            ],
            [
                'name' => 'First Aid Kit',
                'description' => 'Basic medical supplies for emergencies',
                'unit' => 'pcs'
            ],
        ];
        Resource::query()->insert($resources);
    }
}
