<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User admin
        User::factory()->create([
            'name' => 'Admin Benny',
            'mentor_id' => 1,
            'email' => 'bennytamba3004@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // User mentor
        User::create([
            'name' => 'Mentor Nurul',
            'mentor_id' => 2,
            'email' => 'nurul123@gmail.com',
            'password' => bcrypt('nurul123'),
            'role' => 'mentor',
            'status' => 'active',
        ]);

        // User mentee
        User::create([
            'name' => 'Mentee gress',
            'mentor_id' => 2,
            'email' => 'gress123@gmail.com',
            'password' => bcrypt('gress123'),
            'role' => 'mentee',
            'status' => 'active',
        ]);
    }
}
