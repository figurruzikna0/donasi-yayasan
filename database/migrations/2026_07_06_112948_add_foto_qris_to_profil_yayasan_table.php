<?php
// === 2026_07_06_112948_add_foto_qris_to_profil_yayasan_table: menambah kolom foto_qris ke tabel profil_yayasan ===
// ⚠️ MIGRASI SEMENTARA — kolom ini DIPAKAI SEMENTARA lalu DIHAPUS.
// Foto QRIS sempat direncanakan untuk pembayaran donasi via scan QR.
// Karena sistem memakai bukti transfer manual, kolom foto_qris
// dihapus oleh migrasi 2026_07_14_145403. File ini hanya dokumentasi.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_yayasan', function (Blueprint $table) {
            $table->string('foto_qris')->nullable()->after('foto_struktur');   // foto QRIS pembayaran
        });
    }

    public function down(): void
    {
        Schema::table('profil_yayasan', function (Blueprint $table) {
            $table->dropColumn('foto_qris');
        });
    }
};