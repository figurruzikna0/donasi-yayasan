<?php
// === 2026_07_08_090323_drop_foster_parents_table: menghapus tabel foster_parents (diganti dengan sistem sponsorship) ===
// Migrasi CUSTOM — PERUBAHAN DESAIN PENTING.
// Tabel foster_parents (desain awal: relasi langsung donatur-anak)
// DIHAPUS dan diganti sistem SPONSORSHIP (transaksi berperiode,
// lebih fleksibel: ada pending/approve/expired + nominal + periode).
// down() dipakai restore desain lama jika rollback.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('foster_parents');   // hapus tabel lama
    }

    public function down(): void
    {
        // Restore struktur tabel lama (untuk rollback)
        Schema::create('foster_parents', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();        // donatur
            $table->foreignId('foster_child_id')->constrained('foster_children')->cascadeOnDelete();  // anak asuh
            $table->integer('monthly_amount');     // komitmen per bulan
            $table->enum('status', ['Aktif', 'Berhenti'])->default('Aktif');
            $table->timestamps();
        });
    }
};