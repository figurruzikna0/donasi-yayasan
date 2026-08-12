<?php
// === 2026_07_24_202921_add_rejection_reason: menambah kolom rejection_reason (alasan penolakan) ke tabel sponsorships dan donations ===
// Migrasi CUSTOM — fitur PENOLAKAN transaksi oleh admin.
// Saat admin menolak, alasan disimpan di sini dan dikirim ke donatur
// via WhatsApp (pesan "Sponsorship Ditolak" / "Donasi Ditolak").

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('reminder_sent_at');  // alasan penolakan sponsorship
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('status');  // alasan penolakan donasi
        });
    }

    public function down(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->dropColumn('rejection_reason');
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('rejection_reason');
        });
    }
};