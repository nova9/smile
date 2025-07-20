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
            [
               'name' => 'skills',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name' => 'age',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name' => 'latitude',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'name' => 'longitude',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name' => 'contact_number',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name' => 'gender',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
            ,
            [
                'name' => 'profile_picture',
                'created_at'=>now(),
                'updated_at'=>now(),
           ]

        ];
        Attribute::query()->insert($attributes);

    }
}
