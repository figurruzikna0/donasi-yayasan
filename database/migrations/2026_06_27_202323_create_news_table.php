<?php
// === 2026_06_27_202323_create_news_table: membuat tabel news dengan kolom judul, slug, kategori, tanggal_kegiatan, lokasi, penyelenggara, ringkasan, konten, foto_utama, status ===

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori')->default('Kegiatan Umum');
            $table->date('tanggal_kegiatan');
            $table->string('lokasi')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->text('ringkasan')->nullable();
            $table->longText('konten');
            $table->string('foto_utama')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};