<?php
// === 2026_07_26_000001_create_sessions_table: membuat tabel sessions untuk menyimpan data session login user ===
// Migrasi CUSTOM — tabel sessions (driver session = database).
// Sebenarnya tabel sessions sudah dibuat di migrasi bawaan
// (0001_01_01_000000_create_users_table), file ini jadi PENGGANTI/
// PENJAGA: bila tabel sudah ada, lewati (return). Dipakai supaya
// tabel sessions dijamin ada saat session memakai database.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Sudah ada? Langsung selesai (hindari error "table exists").
        if (Schema::hasTable('sessions')) {
            return;
        }

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();       // ID session (dari cookie)
            $table->foreignId('user_id')->nullable()->index();  // user login (null = tamu)
            $table->string('ip_address', 45)->nullable();       // IP pengguna
            $table->text('user_agent')->nullable();             // info browser
            $table->longText('payload');           // isi session
            $table->integer('last_activity')->index();          // aktivitas terakhir
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};