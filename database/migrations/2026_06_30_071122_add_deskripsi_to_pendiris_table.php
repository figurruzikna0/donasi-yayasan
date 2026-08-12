<?php
// === 2026_06_30_071122_add_deskripsi_to_pendiris_table: menambah kolom deskripsi ke tabel pendiris ===
// Migrasi CUSTOM — menambah deskripsi pendiri/pengurus.
// Pakai Schema::hasColumn() sebagai penjagaan: kalau kolom sudah ada
// (misal sudah dibuat versi lain), jangan buat dua kali.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek dulu: kolom 'deskripsi' BELUM ada? Baru tambahkan.
        if (!Schema::hasColumn('pendiris', 'deskripsi')) {
            Schema::table('pendiris', function (Blueprint $table) {
                $table->text('deskripsi')->nullable()->after('jabatan');  // deskripsi singkat (TEXT, nullable)
            });
        }
    }

    public function down(): void
    {
        Schema::table('pendiris', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
};