<?php
// === 2026_06_21_165345_add_user_id_to_donations_table: menambah kolom user_id (nullable) ke tabel donations ===

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
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};
