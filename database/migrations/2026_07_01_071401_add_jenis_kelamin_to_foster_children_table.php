<?php
// === 2026_07_01_071401_add_jenis_kelamin_to_foster_children_table: menambah kolom jenis_kelamin (enum Laki-laki/Perempuan) ke tabel foster_children ===

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
        Schema::table('foster_children', function (Blueprint $table) {
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])
                    ->nullable()
                    ->after('age');
        });
    }

    public function down(): void
    {
        Schema::table('foster_children', function (Blueprint $table) {
            $table->dropColumn('jenis_kelamin');
        });
    }
};
