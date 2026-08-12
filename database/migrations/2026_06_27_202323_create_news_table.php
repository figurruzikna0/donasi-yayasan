<?php
// === 2026_06_27_202323_create_news_table: membuat tabel news dengan kolom judul, slug, kategori, tanggal_kegiatan, lokasi, penyelenggara, ringkasan, konten, foto_utama, status ===
// Migrasi CUSTOM untuk fitur BERITA/KEGIATAN yayasan.
// Data berita ditampilkan di halaman publik; status membedakan
// berita draf (belum tampil) vs published (sudah tampil).

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('judul');                     // judul berita
            $table->string('slug')->unique();            // slug URL, UNIK
            $table->string('kategori')->default('Kegiatan Umum');  // kategori berita, default 'Kegiatan Umum'
            $table->date('tanggal_kegiatan');            // tanggal pelaksanaan kegiatan
            $table->string('lokasi')->nullable();        // tempat kegiatan
            $table->string('penyelenggara')->nullable(); // pihak penyelenggara
            $table->text('ringkasan')->nullable();       // cuplikan singkat
            $table->longText('konten');                  // isi berita lengkap (LONGTEXT = muat konten panjang)
            $table->string('foto_utama')->nullable();    // gambar sampul
            $table->string('status')->default('draft');  // status: 'draft' (default) / 'published'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};