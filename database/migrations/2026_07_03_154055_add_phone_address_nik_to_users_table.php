<?php
// === 2026_07_03_154055_add_phone_address_nik_to_users_table: menambah kolom phone, address, nik ke tabel users ===
// Migrasi CUSTOM — melengkapi data profil pengguna (admin & donatur).
// Menambah 3 kolom:
//  - phone   → nomor HP (untuk notifikasi WA & kontak)
//  - address → alamat
//  - nik     → NIK (Nomor Induk Kependudukan), khusus donatur (VARCHAR 20)
// Semuanya nullable agar pendaftaran tetap simpel.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');      // no HP
            $table->text('address')->nullable()->after('phone');      // alamat
            $table->string('nik', 20)->nullable()->after('address');  // NIK (dibatasi 20 karakter)
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address', 'nik']);
        });
    }
};