<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 2 Admin
        User::create([
            'name' => 'Benny Tamba',
            'email' => 'bennytamba3004@gmail.com',
            'password' => Hash::make('benny123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Bagus Sadewo',
            'email' => 'bagus123@gmail.com',
            'password' => Hash::make('bagus123'),
            'role' => 'admin',
        ]);

        // 2 Mentor
        $mentor1 = User::create([
            'name' => 'Aulia Nasution',
            'email' => 'aulia123@gmail.com',
            'password' => Hash::make('aulia123'),
            'role' => 'mentor',
        ]);

        $mentor2 = User::create([
            'name' => 'Zikkri Saragih',
            'email' => 'zikkri123@gmail.com',
            'password' => Hash::make('zikkri123'),
            'role' => 'mentor',
        ]);

        // 6 Mentee
        User::create([
            'name' => 'Dzikri Butar-Butar',
            'email' => 'dzikri123@gmail.com',
            'nim' => '2205102019',
            'kelas' => 'MI-6D',
            'password' => Hash::make('dzikri123'),
            'role' => 'mentee',
            'mentor_id' => $mentor1->id,
        ]);

        User::create([
            'name' => 'Nurul Nasution',
            'email' => 'nurul123@gmail.com',
            'nim' => '2205102043',
            'kelas' => 'MI-6D',
            'password' => Hash::make('nurul123'),
            'role' => 'mentee',
            'mentor_id' => $mentor1->id,
        ]);

        User::create([
            'name' => 'Gracey Ginting',
            'email' => 'gracey123@gmail.com',
            'nim' => '2205102079',
            'kelas' => 'MI-6D',
            'password' => Hash::make('gress123'),
            'role' => 'mentee',
            'mentor_id' => $mentor1->id,
        ]);

        User::create([
            'name' => 'Aji Malau',
            'email' => 'aji123@gmail.com',
            'nim' => '2205102001',
            'kelas' => 'MI-6D',
            'password' => Hash::make('aji123'),
            'role' => 'mentee',
            'mentor_id' => $mentor2->id,
        ]);

        User::create([
            'name' => 'Tivany',
            'email' => 'tivany123@gmail.com',
            'nim' => '2205102002',
            'kelas' => 'MI-6D',
            'password' => Hash::make('tivany123'),
            'role' => 'mentee',
            'mentor_id' => $mentor2->id,
        ]);

        User::create([
            'name' => 'Indah Purba',
            'email' => 'indah123@gmail.com',
            'nim' => '2205102100',
            'kelas' => 'MI-6D',
            'password' => Hash::make('indah123'),
            'role' => 'mentee',
            'mentor_id' => $mentor2->id,
        ]);
    }
}
