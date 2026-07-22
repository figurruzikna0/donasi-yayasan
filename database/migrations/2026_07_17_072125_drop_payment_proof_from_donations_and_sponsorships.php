<?php
// === 2026_07_17_072125_drop_payment_proof_from_donations_and_sponsorships: menghapus kolom payment_proof dari tabel donations dan sponsorships ===

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
        });

        Schema::table('sponsorships', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('payment_method');
        });

        Schema::table('sponsorships', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('payment_method');
        });
    }
};
