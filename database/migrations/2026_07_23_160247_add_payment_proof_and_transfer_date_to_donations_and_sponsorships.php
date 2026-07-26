<?php
// === 2026_07_23_160247_add_payment_proof_and_transfer_date: menambah ulang kolom payment_proof (bukti transfer) + transfer_date (tanggal transfer) ke tabel donations dan sponsorships ===
// Sebelumnya kolom payment_proof pernah di-drop (2026_07_17_072125), ditambah lagi karena sistem ganti dari Midtrans ke upload bukti manual

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('payment_method');
            $table->date('transfer_date')->nullable()->after('payment_proof');
        });

        Schema::table('sponsorships', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('payment_method');
            $table->date('transfer_date')->nullable()->after('payment_proof');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['payment_proof', 'transfer_date']);
        });

        Schema::table('sponsorships', function (Blueprint $table) {
            $table->dropColumn(['payment_proof', 'transfer_date']);
        });
    }
};
