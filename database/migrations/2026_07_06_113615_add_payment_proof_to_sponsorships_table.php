<?php
// === 2026_07_06_113615_add_payment_proof_to_sponsorships_table: menambah kolom payment_proof ke tabel sponsorships ===

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
        });
    }
};
