<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Buat enkripsi password


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Yayasan',
            'email' => 'admindonasi@yayasan.com',
            'password' => Hash::make('baitulyatim123'), // Passwordnya: baitulyatim123
            'role' => 'admin',
        ]);
    
    }
}
