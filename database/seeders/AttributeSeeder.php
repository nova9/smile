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
            'latitude',
            'longitude',
            'contact_number',
            'gender',
            'profile_picture',
            'logo',
            'front_image',
            'back_image',
            'selfie',
            'document_type',
            'interests',
            'city',
            'verification_details',
            'description',
            'level',
            'date_of_birth',
            'education'
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
