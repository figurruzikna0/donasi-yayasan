<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Menambahkan kolom metode pembayaran dan bukti transfer
            $table->string('payment_method')->nullable()->after('amount');
            $table->string('payment_proof')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_proof']);
        });
    }
};