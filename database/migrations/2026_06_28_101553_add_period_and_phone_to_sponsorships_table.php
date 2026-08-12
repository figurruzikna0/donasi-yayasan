<?php
// === 2026_06_28_101553_add_period_and_phone_to_sponsorships_table: menambah kolom donor_phone, starts_at, expires_at, reminder_sent_at ke tabel sponsorships ===
// Migrasi CUSTOM — MASA ASUH & REMINDER (inti fitur perpanjangan OTA).
// Menambah 4 kolom:
//  - donor_phone      → nomor HP donatur (untuk kirim WA)
//  - starts_at        → tanggal mulai masa asuh (terisi saat approve)
//  - expires_at       → tanggal berakhir (+1 bulan dari starts_at)
//  - reminder_sent_at → kapan reminder WA terakhir dikirim (anti-spam)
// PLUS: memperluas ENUM status menambahkan nilai 'expired'
// (untuk sponsorship yang otomatis dinonaktifkan setelah lewat masa asuh).

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->string('donor_phone')->nullable()->after('donor_email');   // no HP donatur
            $table->timestamp('starts_at')->nullable()->after('status');       // tanggal mulai masa asuh
            $table->timestamp('expires_at')->nullable()->after('starts_at');   // tanggal berakhir masa asuh
            $table->timestamp('reminder_sent_at')->nullable()->after('expires_at');  // waktu reminder terakhir
        });

        // Tambah 'expired' ke enum status.
        // PENTING: dipisah khusus MySQL — SQLite TIDAK mendukung
        // ALTER MODIFY ENUM, jadi dikerjakan lewat DB::statement langsung.
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE sponsorships MODIFY status ENUM('pending', 'success', 'failed', 'expired') DEFAULT 'pending'");
        }
    }

    public function down(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->dropColumn(['donor_phone', 'starts_at', 'expires_at', 'reminder_sent_at']);
        });

        if (DB::getDriverName() === 'mysql') {
            // Rollback: kembalikan enum ke 3 nilai awal (hapus 'expired')
            DB::statement("ALTER TABLE sponsorships MODIFY status ENUM('pending', 'success', 'failed') DEFAULT 'pending'");
        }
    }
};