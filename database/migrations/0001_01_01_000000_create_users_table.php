<?php
// === 0001_01_01_000000_create_users_table: membuat tabel users, password_reset_tokens, dan sessions ===
// Migrasi BAWAAN Laravel (Breeze) — bagian paling awal dari struktur database.
// Tiga tabel dibuat sekaligus:
//  1. users                → tabel pengguna (admin & donatur, dibedakan kolom role)
//  2. password_reset_tokens→ token untuk fitur lupa password
//  3. sessions             → penyimpanan session login (driver database)
// Kolom role/phone/address/nik/avatar ditambahkan di migrasi selanjutnya.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations — dijalankan saat `php artisan migrate`.
     */
    public function up(): void
    {
        // ── TABEL USERS (pengguna) ────────────────────────────
        Schema::create('users', function (Blueprint $table) {
            $table->id();                          // id (BIGINT, PK, auto increment)
            $table->string('name');                // nama lengkap
            $table->string('email')->unique();     // email login, dijamin TIDAK duplikat
            $table->timestamp('email_verified_at')->nullable();  // waktu verifikasi email (null = belum verifikasi)
            $table->string('password');            // password (disimpan sebagai HASH, bukan teks asli)
            $table->rememberToken();               // remember_token: token "ingat saya" (VARCHAR 100, nullable)
            $table->timestamps();                  // created_at & updated_at (otomatis diisi Eloquent)
        });

        // ── TABEL PASSWORD RESET TOKENS (lupa password) ──────
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();    // email sebagai kunci utama (1 token per email)
            $table->string('token');               // token reset password
            $table->timestamp('created_at')->nullable();  // waktu token dibuat (untuk pengecekan masa berlaku)
        });

        // ── TABEL SESSIONS (sesi login) ──────────────────────
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();       // ID session (diambil dari cookie session)
            $table->foreignId('user_id')->nullable()->index();  // user yang login (null = tamu), di-index untuk query cepat
            $table->string('ip_address', 45)->nullable();       // IP pengguna (45 = muat IPv6)
            $table->text('user_agent')->nullable();             // info browser/perangkat pengguna
            $table->longText('payload');           // isi data session (diserialisasi)
            $table->integer('last_activity')->index();          // timestamp aktivitas terakhir (untuk pembersihan session)
        });
    }

    /**
     * Reverse the migrations — dijalankan saat `php artisan migrate:rollback`.
     */
    public function down(): void
    {
        // Hapus tabel dengan urutan terbalik (anak dulu, induk terakhir)
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};