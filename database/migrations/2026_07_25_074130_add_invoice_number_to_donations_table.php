<?php
// === 2026_07_25_074130_add_invoice_number_to_donations_table: menambah kolom invoice_number (nomor invoice) ke tabel donations ===
// Migrasi CUSTOM — fitur PENOMORAN INVOICE donasi.
// Format: INV-DN-{tahunbulan}-{nomor_urut} (contoh: INV-DN-202608-0001).
// Dipakai untuk cetak invoice donasi (fitur rekap/invoice).
// Unique: 1 donasi = 1 nomor invoice, tidak bisa duplikat.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('invoice_number', 50)->nullable()->unique()->after('order_id');  // nomor invoice (50 karakter, unik)
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('invoice_number');
        });
    }
};