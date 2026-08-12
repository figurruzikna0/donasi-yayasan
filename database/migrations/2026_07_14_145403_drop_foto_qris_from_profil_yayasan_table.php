<?php
// === 2026_07_14_145403_drop_foto_qris_from_profil_yayasan_table: menghapus kolom foto_qris dari tabel profil_yayasan ===
// Migrasi CUSTOM — finalisasi desain: fitur QRIS dibatalkan.
// Kolom foto_qris (yang ditambah migrasi 2026_07_06_112948) dihapus
// karena pembayaran memakai upload bukti transfer manual.
// down() menambahkannya lagi (untuk rollback).

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_yayasan', function (Blueprint $table) {
            $table->dropColumn('foto_qris');    // hapus kolom foto QRIS
        });
    }

    public function down(): void
    {
        Schema::table('profil_yayasan', function (Blueprint $table) {
            $table->string('foto_qris')->nullable()->after('foto_struktur');   // restore kolom
        });
    }
};