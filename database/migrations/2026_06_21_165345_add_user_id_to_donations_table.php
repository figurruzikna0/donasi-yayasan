<?php
// === 2026_06_21_165345_add_user_id_to_donations_table: menambah kolom user_id (nullable) ke tabel donations ===
// Migrasi CUSTOM — menghubungkan donasi dengan akun donatur.
//  - user_id  → ID user (donatur) yang berdonasi
//  - NULLABLE → tamu (guest) tetap bisa berdonasi tanpa login
//  - nullOnDelete → kalau akun user dihapus, data donasinya TETAP ada
//    (hanya kolom user_id yang jadi null) — penting untuk arsip keuangan.
// Note: ada migrasi serupa untuk sponsorships (2026_07_03_155241).

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
    Schema::table('donations', function (Blueprint $table) {
        // Menandai donasi ini punya siapa (bisa kosong kalau nyumbang sebagai tamu)
        $table->foreignId('user_id')->nullable()->after('campaign_id')->constrained('users')->nullOnDelete();
    });
}

public function down(): void
{
    Schema::table('donations', function (Blueprint $table) {
        // Rollback: hapus foreign key dulu, baru hapus kolomnya
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};