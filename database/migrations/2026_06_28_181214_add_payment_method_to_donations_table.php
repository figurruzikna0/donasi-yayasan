<?php
// === 2026_06_28_181214_add_payment_method_to_donations_table: menambah kolom payment_method ke tabel donations ===

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('amount');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });
    }
};