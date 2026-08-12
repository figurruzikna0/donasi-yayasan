<?php
// === 2026_07_03_155241_add_user_id_to_sponsorships_table: menambah kolom user_id (nullable) ke tabel sponsorships ===
// Migrasi CUSTOM — menghubungkan sponsorship dengan akun donatur.
// Sama pola dengan migrasi user_id di donations (2026_06_21_165345):
//  - nullable      → guest tanpa akun tetap bisa jadi orang tua asuh
//  - nullOnDelete  → akun dihapus, riwayat sponsorship tetap tersimpan

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->after('foster_child_id');
        });
    }

    public function down(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            // Rollback: hapus FK dulu baru kolom
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};