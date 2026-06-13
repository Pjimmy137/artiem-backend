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
        // User::factory(10)->create();
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@artiemhotels.com'], // Evita duplicados si lo ejecutas más veces
            [
                'name' => 'Admin Artiem',
                'password' => \Illuminate\Support\Facades\Hash::make('artiem2026'),
                'email_verified_at' => now(),
            ]
        );
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
