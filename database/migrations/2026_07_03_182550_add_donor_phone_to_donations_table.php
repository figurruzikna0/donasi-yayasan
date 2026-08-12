<?php
// === 2026_07_03_182550_add_donor_phone_to_donations_table: menambah kolom donor_phone ke tabel donations ===
// Migrasi CUSTOM — menambah nomor HP donatur pada donasi kampanye,
// supaya admin bisa menghubungi donatur / kirim notifikasi WA.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('donor_phone')->nullable()->after('donor_email');   // no HP donatur
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('donor_phone');
        });
    }
};