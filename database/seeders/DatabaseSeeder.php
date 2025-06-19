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
            'name' => 'Test User',
            'mentor_id' => 1,
            'email' => 'bennytamba3004@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // User mentor
        User::create([
            'name' => 'Mentor Satu',
            'mentor_id' => 2,
            'email' => 'mentor@example.com',
            'password' => bcrypt('00000000'),
            'role' => 'mentor',
            'status' => 'active',
        ]);
    }
}
