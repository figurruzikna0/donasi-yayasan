<?php
// === 2026_06_21_165339_add_role_to_users_table: menambah kolom role (default 'donatur') ke tabel users ===

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
    Schema::table('users', function (Blueprint $table) {
        // Nambahin hak akses, default-nya jadi 'donatur'
        $table->string('role')->default('donatur')->after('email');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
}
};
