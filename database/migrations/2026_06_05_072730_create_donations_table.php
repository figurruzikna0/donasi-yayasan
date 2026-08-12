<?php
// === 2026_06_05_072730_create_donations_table: membuat tabel donations dengan kolom campaign_id, donor_name, donor_email, amount, status, order_id, snap_token, payment_proof ===
// Migrasi CUSTOM untuk fitur DONASI KAMPANYE (sumbangan umum).
// Kolom payment_proof pernah dihapus (2026_07_17) lalu ditambah ULANG
// dengan transfer_date (2026_07_23) karena sistem beralih dari
// payment gateway (Midtrans) ke upload bukti transfer manual.

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

            // Relasi ke tabel kampanye: kalau kampanye dihapus, donasinya
            // ikut terhapus (CASCADE) agar tidak ada data menggantung.
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');

            // Data si donatur (disimpan denormalisasi di sini,
            // agar guest/tamu tanpa akun tetap bisa berdonasi)
            $table->string('donor_name');          // nama donatur
            $table->string('donor_email');         // email donatur

            // Jumlah uang yang didonasikan (unsignedBigInteger = bilangan
            // positif besar, muat nominal jutaan tanpa koma)
            $table->unsignedBigInteger('amount');

            // Status donasi: pending (belum disetujui admin), success
            // (sudah dikonfirmasi), failed (ditolak/gagal)
            $table->string('status')->default('pending');

            // Kolom integrasi Midtrans (snap):
            // order_id = ID transaksi unik, snap_token = token pembayaran Snap.
            // Masih disimpan untuk kompatibilitas, meski pembayaran kini manual.
            $table->string('order_id', 100)->unique()->nullable();
            $table->string('snap_token')->nullable();

            // Bukti bayar untuk transfer manual (path file bukti)
            $table->string('payment_proof')->nullable();

            $table->timestamps();                  // created_at & updated_at
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