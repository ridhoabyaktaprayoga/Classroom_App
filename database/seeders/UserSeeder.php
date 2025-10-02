<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create demo guru
        User::create([
            'name' => 'Guru Demo',
            'email' => 'guru@example.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        // Create demo siswa
        User::create([
            'name' => 'Siswa Demo',
            'email' => 'siswa@example.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
    }
}
