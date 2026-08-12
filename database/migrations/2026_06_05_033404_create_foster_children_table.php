<?php
// === 2026_06_05_033404_create_foster_children_table: membuat tabel foster_children dengan kolom name, age, description, photo, status ===
// Migrasi CUSTOM untuk fitur ANAK ASUH (foster child) — objek utama
// modul Orang Tua Asuh (OTA). Kolom age awalnya integer,
// kemudian diubah jadi string (VARCHAR 10) oleh migrasi terpisah
// (2026_07_24_210206) agar bisa diisi "7 tahun". Kolom jenis_kelamin
// ditambahkan oleh migrasi 2026_07_01_071401.

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
    Schema::create('foster_children', function (Blueprint $table) {
        $table->id();                             // id (PK)
        $table->string('name');                   // nama anak asuh
        $table->integer('age');                   // usia (AWALNYA integer; nanti diubah jadi VARCHAR 10)
        $table->text('description')->nullable();  // deskripsi / cerita latar belakang anak
        $table->string('photo')->nullable();      // link/path foto anak (disimpan di storage/public)
        $table->enum('status', ['Tersedia', 'Diasuh'])->default('Tersedia');  // status anak: belum diasuh / sedang diasuh
        $table->timestamps();                     // created_at & updated_at
        });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foster_children');
    }
};