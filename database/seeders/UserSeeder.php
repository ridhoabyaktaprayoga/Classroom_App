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

        // Create demo admin
        User::create([
            'name' => 'Admin Demo',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create demo announcement for students
        \App\Models\Announcement::create([
            'title' => 'Welcome Students!',
            'content' => 'Welcome to our learning management system. Please check your assignments regularly.',
            'target_role' => 'siswa',
            'start_date' => now(),
            'end_date' => now()->addDays(7),
        ]);

        // Create demo announcement for teachers
        \App\Models\Announcement::create([
            'title' => 'Teacher Guidelines',
            'content' => 'Please ensure all assignments are graded within 3 days of submission.',
            'target_role' => 'guru',
            'start_date' => now(),
            'end_date' => now()->addDays(7),
        ]);

        // Create demo announcement for all users
        \App\Models\Announcement::create([
            'title' => 'System Maintenance',
            'content' => 'The system will be under maintenance this Sunday from 2 AM to 4 AM.',
            'target_role' => 'all',
            'start_date' => now(),
            'end_date' => now()->addDays(3),
        ]);
    }
}
