<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@smkmigas.com',
            'password' => 'admin123',
            'role' => 'superadmin'
        ]);
        User::factory()->create([
            'name' => 'admin',
            'email' => 'tu@smkmigas.com',
            'password' => 'admin123',
            'role' => 'tu'
        ]);
    }
}
