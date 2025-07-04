<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil UserSeeder
        $this->call([
            UserSeeder::class,
        ]);
    }
}
