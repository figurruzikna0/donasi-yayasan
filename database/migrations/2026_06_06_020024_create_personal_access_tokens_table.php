<?php
// === 2026_06_06_020024_create_personal_access_tokens_table: membuat tabel personal_access_tokens untuk Sanctum API token ===
// Migrasi BAWAAN Laravel Sanctum. Tabel ini menyimpan token API pribadi
// (personal access token) untuk autentikasi API/SPA.
// Aplikasi ini memakai auth session (bukan API), jadi tabel ini ada
// sebagai infrastruktur bawaan — tidak dipakai aktif.

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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();

            // morphs('tokenable') membuat 2 kolom sekaligus:
            //  - tokenable_type (nama model: User/dll.)
            //  - tokenable_id (ID record pemilik token)
            // => "polimorfik": token bisa dimiliki model apa pun.
            $table->morphs('tokenable');

            $table->text('name');                  // nama token (misal "Mobile App")
            $table->string('token', 64)->unique(); // hash token (64 karakter, UNIK)
            $table->text('abilities')->nullable(); // izin token (misal ['read', 'write'])
            $table->timestamp('last_used_at')->nullable();  // kapan token terakhir dipakai
            $table->timestamp('expires_at')->nullable()->index();  // masa berlaku token (di-index)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};