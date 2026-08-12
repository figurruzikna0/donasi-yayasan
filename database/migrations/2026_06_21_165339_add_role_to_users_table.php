<?php
// === 2026_06_21_165339_add_role_to_users_table: menambah kolom role (default 'donatur') ke tabel users ===
// Migrasi CUSTOM — KUNCI PEMISAHAN ADMIN & DONATUR.
// Sistem memakai SATU tabel users, dibedakan oleh kolom role:
//  - 'admin'   → akses panel admin (profil yayasan, berita, transaksi, dll.)
//  - 'donatur' → akses dashboard donatur
// Kolom ditambahkan setelah email, default 'donatur'.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Nambahin hak akses, default-nya jadi 'donatur'
        $table->string('role')->default('donatur')->after('email');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');   // rollback: hapus kolom role
    });
}
};