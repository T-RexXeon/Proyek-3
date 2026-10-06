<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'username' => 'budi',
            'nama_lengkap' => 'Budi Santoso',
            'password' => 'password123',
        ]);

        \App\Models\User::create([
            'username' => 'admin',
            'nama_lengkap' => 'Admin Sistem',
            'password' => 'admin123',
        ]);
    }
}
