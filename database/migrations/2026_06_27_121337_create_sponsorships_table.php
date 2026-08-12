<?php
// === 2026_06_27_121337_create_sponsorships_table: membuat tabel sponsorships dengan kolom foster_child_id, order_id, donor_name, donor_email, amount, snap_token, status ===
// Migrasi CUSTOM — INTI MODUL ORANG TUA ASUH.
// Tabel transaksi sponsorship: donatur berkomitmen mengasuh anak
// dengan nominal tertentu. Kolom lain ditambahkan migrasi berikutnya:
//  - package, package_description, payment_method (2026_06_27_125546)
//  - donor_phone, starts_at, expires_at, reminder_sent_at + enum 'expired' (2026_06_28_101553)
//  - user_id (2026_07_03_155241)
//  - payment_proof, transfer_date (2026_07_23_160247)
//  - rejection_reason (2026_07_24_202921)

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            // Relasi ke anak asuh: kalau anak dihapus, sponsorship ikut
            // terhapus (CASCADE)
            $table->foreignId('foster_child_id')->constrained()->onDelete('cascade');
            $table->string('order_id')->unique();   // ID transaksi, UNIK (contoh: SPONSOR-12345678)
            $table->string('donor_name');           // nama donatur
            $table->string('donor_email');          // email donatur
            $table->decimal('amount', 12, 2);       // nominal komitmen (12 digit, 2 desimal)
            $table->string('snap_token')->nullable();  // token Snap Midtrans (cadangan)
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');  // status awal: menunggu konfirmasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsorships');
    }
};