<?php
// === 2026_07_24_154947_add_urutan_to_pendiris_table: menambah kolom urutan (nomor urut tampilan) ke tabel pendiris ===
// Dipakai untuk mengatur urutan tampilan pendiri/pengurus di halaman profil yayasan

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendiris', function (Blueprint $table) {
            $table->integer('urutan')->default(0)->after('foto');
        });
    }

    public function down(): void
    {
        Schema::table('pendiris', function (Blueprint $table) {
            $table->dropColumn('urutan');
        });
    }
};
