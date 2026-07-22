<?php
// === 2026_07_03_155241_add_user_id_to_sponsorships_table: menambah kolom user_id (nullable) ke tabel sponsorships ===

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->after('foster_child_id');
        });
    }

    public function down(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
