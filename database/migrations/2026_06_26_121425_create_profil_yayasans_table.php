<?php
// === 2026_06_26_121425_create_profil_yayasans_table: membuat tabel profil_yayasan dengan kolom nama_yayasan, email, no_telp, alamat, sejarah, visi, misi, logo, legalitas, foto ===
// Migrasi CUSTOM untuk fitur PROFIL YAYASAN.
// Tabel bersifat SINGLE-ROW (hanya 1 record): data identitas yayasan
// yang ditampilkan di halaman profil. Kolom foto_qris sempat ditambahkan
// (2026_07_06) lalu dihapus lagi (2026_07_14) karena tidak dipakai.

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
    Schema::create('profil_yayasan', function (Blueprint $table) {
        $table->id();
        $table->string('nama_yayasan');            // nama yayasan
        $table->string('email');                   // email yayasan
        $table->string('no_telp');                 // nomor telepon yayasan
        $table->text('alamat');                    // alamat yayasan

        // TAMBAHKAN KOLOM-KOLOM BARU INI:
        $table->text('sejarah_yayasan')->nullable();   // sejarah yayasan
        $table->text('visi')->nullable();              // visi
        $table->text('misi')->nullable();              // misi
        $table->string('logo')->nullable();            // logo (path file)
        $table->text('legalitas')->nullable();         // keterangan legalitas
        $table->string('foto_legalitas')->nullable();  // foto dokumen legalitas
        $table->string('foto_struktur')->nullable();   // foto struktur organisasi

        $table->timestamps();
    });
}
};