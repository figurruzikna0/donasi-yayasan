<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('payment_method');
            $table->date('transfer_date')->nullable()->after('payment_proof');
        });

        Schema::table('sponsorships', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('payment_method');
            $table->date('transfer_date')->nullable()->after('payment_proof');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['payment_proof', 'transfer_date']);
        });

        Schema::table('sponsorships', function (Blueprint $table) {
            $table->dropColumn(['payment_proof', 'transfer_date']);
        });
    }
};
