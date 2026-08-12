<?php
// === 0001_01_01_000001_create_cache_table: membuat tabel cache dan cache_locks ===
// Migrasi BAWAAN Laravel untuk penyimpanan cache berbasis database
// (sesuai config/cache.php: 'default' => 'database').
// Dua tabel dibuat:
//  1. cache        → menyimpan nilai cache (key, value, waktu kedaluwarsa)
//  2. cache_locks  → menyimpan "kunci" (lock) agar proses bersamaan
//                    (concurrency) tidak saling menimpa — misal saat
//                    beberapa request menulis cache yang sama.

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
        // ── TABEL CACHE ──────────────────────────────────────
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();      // key cache sebagai PRIMARY KEY (unik)
            $table->mediumText('value');           // isi data cache (mediumText cukup untuk data kecil)
            $table->bigInteger('expiration')->index();  // timestamp kedaluwarsa (epoch) — di-index agar pembersihan cepat
        });

        // ── TABEL CACHE LOCKS ───────────────────────────────
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();      // key lock (unik)
            $table->string('owner');               // pemilik lock (identitas pemegang kunci)
            $table->bigInteger('expiration')->index();  // kapan lock otomatis lepas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};