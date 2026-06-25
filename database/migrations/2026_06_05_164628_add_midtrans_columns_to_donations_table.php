<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Tambahkan ->nullable() di sini 👇
            $table->string('order_id')->nullable()->unique()->after('id');
            
            $table->string('snap_token')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['order_id', 'snap_token']);
        });
    }
};