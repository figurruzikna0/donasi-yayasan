<?php
// === 2026_07_24_154947_add_urutan_to_pendiris_table: menambah kolom urutan (nomor urut tampilan) ke tabel pendiris ===
// Migrasi CUSTOM — mengatur URUTAN TAMPILAN pendiri/pengurus
// di halaman profil yayasan (misal: Ketua tampil lebih dulu).
// Default 0 = urutan awal/terakhir sesuai waktu buat.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendiris', function (Blueprint $table) {
            $table->integer('urutan')->default(0)->after('foto');   // nomor urut tampilan
        });
    }

    public function down(): void
    {
        Schema::table('pendiris', function (Blueprint $table) {
            $table->dropColumn('urutan');
        });
    }
};