<?php
// === 2026_06_28_101553_add_period_and_phone_to_sponsorships_table: menambah kolom donor_phone, starts_at, expires_at, reminder_sent_at ke tabel sponsorships ===

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->string('donor_phone')->nullable()->after('donor_email');
            $table->timestamp('starts_at')->nullable()->after('status');
            $table->timestamp('expires_at')->nullable()->after('starts_at');
            $table->timestamp('reminder_sent_at')->nullable()->after('expires_at');
        });

        // Tambah 'expired' ke enum status (MySQL only; SQLite tidak support ALTER MODIFY ENUM)
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
            DB::statement("ALTER TABLE sponsorships MODIFY status ENUM('pending', 'success', 'failed') DEFAULT 'pending'");
        }
    }
};