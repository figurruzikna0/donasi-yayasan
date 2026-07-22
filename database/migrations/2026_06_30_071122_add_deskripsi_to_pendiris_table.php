<?php
// === 2026_06_30_071122_add_deskripsi_to_pendiris_table: menambah kolom deskripsi ke tabel pendiris ===

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
        if (!Schema::hasColumn('pendiris', 'deskripsi')) {
            Schema::table('pendiris', function (Blueprint $table) {
                $table->text('deskripsi')->nullable()->after('jabatan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendiris', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
};
