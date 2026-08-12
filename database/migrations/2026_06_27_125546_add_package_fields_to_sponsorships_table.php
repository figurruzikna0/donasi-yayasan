<?php
// === 2026_06_27_125546_add_package_fields_to_sponsorships_table: menambah kolom package, package_description, payment_method ke tabel sponsorships ===
// Migrasi CUSTOM — melengkapi data paket sponsorship.
// Menambah 3 kolom:
//  - package            → nama paket komitmen (misal: Reguler/Premium/Eksekutif)
//  - package_description→ deskripsi paket
//  - payment_method     → metode pembayaran (dari Midtrans / transfer manual)

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->string('package')->nullable()->after('foster_child_id');          // nama paket (nullable)
            $table->text('package_description')->nullable()->after('package');        // deskripsi paket
            $table->string('payment_method')->nullable()->after('package_description'); // metode bayar
        });
    }

    public function down(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            // Rollback: hapus ketiga kolom sekaligus
            $table->dropColumn(['package', 'package_description', 'payment_method']);
        });
    }
};