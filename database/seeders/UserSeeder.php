<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = \App\Models\Role::where('name', 'admin')->first();
        \App\Models\User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@smile.test',
            'password' => 'admin@123',
            'role_id' => $roleAdmin->id
        ]);

        $roleLawyer = \App\Models\Role::where('name', 'lawyer')->first();
        \App\Models\User::query()->create([
            'name' => 'Lawyer',
            'email' => 'lawyer@smile.test',
            'password' => 'lawyer@123',
            'role_id' => $roleLawyer->id
        ]);
    }
}
