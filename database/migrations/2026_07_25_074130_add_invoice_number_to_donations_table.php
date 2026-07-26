<?php
// === 2026_07_25_074130_add_invoice_number: menambah kolom invoice_number (nomor invoice) ke tabel donations ===
// Format: INV-DN-{tahunbulan}-{nomor_urut}, dipakai untuk penomoran invoice donasi

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
        Schema::table('donations', function (Blueprint $table) {
            $table->string('invoice_number', 50)->nullable()->unique()->after('order_id');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('invoice_number');
        });
    }
};
