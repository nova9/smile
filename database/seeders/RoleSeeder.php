<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'requester', 'description' => 'Entity who can request volunteers'],
            ['name' => 'volunteer', 'description' => 'Entity who can volunteer for requests'],
            ['name' => 'admin', 'description' => 'Administrator with full access to the system'],
            ['name' => 'lawyer', 'description' => 'A lawyer']

        ];

        Role::query()->insert($roles);
    }
}
