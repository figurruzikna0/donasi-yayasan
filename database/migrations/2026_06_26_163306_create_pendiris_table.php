<?php
// === 2026_06_26_163306_create_pendiris_table: membuat tabel pendiris dengan kolom nama, jabatan, deskripsi, foto ===
// Migrasi CUSTOM untuk fitur PENDIRI/PENGURUS YAYASAN.
// Data orang-orang yang tampil di halaman profil yayasan (struktur
// kepengurusan). Kolom deskripsi ditambahkan oleh migrasi
// 2026_06_30_071122, kolom urutan oleh migrasi 2026_07_24_154947.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendiris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                // nama pendiri/pengurus
            $table->string('jabatan');             // jabatan (Ketua, Sekretaris, dll.)
            $table->text('deskripsi')->nullable(); // deskripsi singkat
            $table->string('foto')->nullable();    // foto (path file)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendiris');
    }
};