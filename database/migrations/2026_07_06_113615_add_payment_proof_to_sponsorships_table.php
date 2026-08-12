<?php
// === 2026_07_06_113615_add_payment_proof_to_sponsorships_table: menambah kolom payment_proof ke tabel sponsorships ===
// ⚠️ MIGRASI SEMENTARA — kolom ini pernah DITAMBAH lalu DIHAPUS.
// 1. Ditambah di sini (bukti transfer manual).
// 2. Dihapus oleh migrasi 2026_07_17_072125.
// 3. Ditambah ULANG oleh migrasi 2026_07_23_160247 (bersama transfer_date).
// Riwayat ini menunjukkan iterasi desain pembayaran sistem.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('payment_method');   // path bukti transfer
        });
    }

    public function down(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
        });
    }
};