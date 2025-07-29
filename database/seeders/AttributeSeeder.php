<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            'skills',
            'age',
            'latitude',
            'longitude',
            'contact_number',
            'gender',
            'profile_picture',
            'front_image',
            'back_image',
            'selfie',
            'document_type',
        ];

        $attributes = array_map(function($item) {
            return [
                'name' => $item,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $attributes);
        Attribute::query()->insert($attributes);

    }
}
