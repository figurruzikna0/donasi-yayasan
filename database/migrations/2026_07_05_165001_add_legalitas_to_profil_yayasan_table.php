<?php
// === 2026_07_05_165001_add_legalitas_to_profil_yayasan_table: menambah kolom legalitas ke tabel profil_yayasan ===
// Migrasi CUSTOM — menambah keterangan legalitas yayasan.
// Dipakai pada halaman profil (informasi legalitas organisasi).

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Penjagaan: jangan duplikat kalau kolom sudah pernah ditambahkan
        // (migrasi create_profil_yayasans sudah punya kolom legalitas —
        // file ini sebagai fallback yang aman).
        if (!Schema::hasColumn('profil_yayasan', 'legalitas')) {
            Schema::table('profil_yayasan', function (Blueprint $table) {
                $table->text('legalitas')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::table('profil_yayasan', function (Blueprint $table) {
            $table->dropColumn('legalitas');
        });
    }
};