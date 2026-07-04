<?php

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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel kampanye (kalau kampanye dihapus, data donasinya ikut terhapus biar rapi)
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            
            // Data si donatur
            $table->string('donor_name');
            $table->string('donor_email');
            
            // Jumlah uang yang didonasikan (pakai bigInteger biar muat nominal besar)
            $table->unsignedBigInteger('amount');
            
            // Status donasi: pending (belum bayar), paid/success (sudah bayar), failed (gagal)
            $table->string('status')->default('pending');
            
            // Kolom untuk integrasi Midtrans
            $table->string('order_id', 100)->unique()->nullable();
            $table->string('snap_token')->nullable();
            
            // Bukti bayar (untuk transfer manual)
            $table->string('payment_proof')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
