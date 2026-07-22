<?php
// === 2026_07_06_112948_add_foto_qris_to_profil_yayasan_table: menambah kolom foto_qris ke tabel profil_yayasan ===

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_yayasan', function (Blueprint $table) {
            $table->string('foto_qris')->nullable()->after('foto_struktur');
        });
    }

    public function down(): void
    {
        Schema::table('profil_yayasan', function (Blueprint $table) {
            $table->dropColumn('foto_qris');
        });
    }
};
