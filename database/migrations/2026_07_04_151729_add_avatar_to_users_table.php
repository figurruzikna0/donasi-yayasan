<?php
// === 2026_07_04_151729_add_avatar_to_users_table: menambah kolom avatar ke tabel users ===
// Migrasi CUSTOM — menambah foto profil (avatar) untuk pengguna.
// Path file disimpan; file-nya di storage/app/public/avatars.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('address');   // path foto profil
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
        });
    }
};