<?php
// === 2026_06_30_000001_create_child_developments_table: membuat tabel child_developments dengan kolom sponsorship_id, foster_child_id, user_id, tanggal, judul, deskripsi, foto ===

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
        Schema::create('child_developments', function (Blueprint $table) {
            $table->id();

            // Relasi ke sponsorship spesifik (periode pengasuhan yang mana)
            $table->foreignId('sponsorship_id')
                  ->constrained('sponsorships')
                  ->onDelete('cascade');

            // Relasi langsung ke anak — supaya query "semua laporan anak X"
            // tidak perlu join lewat sponsorships setiap saat.
            // Didenormalisasi secara sengaja dari sponsorships.foster_child_id
            // saat record dibuat, supaya tetap akurat walau sponsorship lama
            // suatu saat dihapus/diarsipkan.
            $table->foreignId('foster_child_id')
                  ->constrained('foster_children')
                  ->onDelete('cascade');

            // Admin mana yang membuat laporan ini
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->date('tanggal');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('foto')->nullable();

            $table->timestamps();

            // Query paling umum: "semua laporan untuk sponsorship ini, urut tanggal"
            $table->index(['sponsorship_id', 'tanggal']);
            // Query kedua paling umum: "semua laporan untuk anak ini lintas sponsorship"
            $table->index(['foster_child_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_developments');
    }
};