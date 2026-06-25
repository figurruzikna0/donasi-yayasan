<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan model User dipanggil
use Illuminate\Support\Facades\Hash; // Buat enkripsi password

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Bikin Akun Admin
        User::create([
            'name' => 'Admin Yayasan',
            'email' => 'admindonasi@yayasan.com',
            'password' => Hash::make('baitulyatim123'), // Passwordnya: baitulyatim123
            'role' => 'admin',
        ]);
    }
}