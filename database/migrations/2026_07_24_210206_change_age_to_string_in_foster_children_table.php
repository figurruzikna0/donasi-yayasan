<?php
// === 2026_07_24_210206_change_age_to_string_in_foster_children_table: mengubah kolom age di tabel foster_children dari integer (angka) menjadi string (teks) ===
// Migrasi CUSTOM — perubahan tipe data penting.
// Alasan: supaya bisa diisi "4 tahun" atau "Balita" bukan cuma angka.
// Dilakukan lewat DB::statement (SQL mentah) karena mengubah tipe kolom
// enum/tipe butuh SQL native; VARCHAR(10) cukup muat "4 tahun".

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom age dari INT menjadi VARCHAR(10), NOT NULL default '0'
        // (data lama otomatis jadi string, misal 7 → '7')
        DB::statement("ALTER TABLE foster_children MODIFY COLUMN age VARCHAR(10) NOT NULL DEFAULT '0'");
    }

    public function down(): void
    {
        // Rollback: kembalikan ke INT NOT NULL default 0
        DB::statement('ALTER TABLE foster_children MODIFY COLUMN age INT NOT NULL DEFAULT 0');
    }
};