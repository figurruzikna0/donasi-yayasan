<?php
// === 2026_06_05_033358_create_campaigns_table: membuat tabel campaigns dengan kolom title, slug, description, target_amount, collected_amount, image, status ===
// Migrasi CUSTOM (dibuat tim) untuk fitur KAMPANYE DONASI
// (program donasi umum yayasan, misal: bantuan bencana, pembangunan, dll.).

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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();                          // id (PK)

            $table->string('title');               // judul kampanye
            $table->string('slug')->unique();      // slug URL, UNIK (untuk halaman publik yg rapi)
            $table->text('description');           // deskripsi lengkap kampanye
            $table->decimal('target_amount', 15, 2);       // target dana (DECIMAL: 15 digit total, 2 desimal)
            $table->decimal('collected_amount', 15, 2)->default(0);  // dana terkumpul, mulai dari 0
            $table->string('image')->nullable();   // gambar kampanye
            $table->enum('status', ['active', 'completed'])->default('active');  // status: aktif/selesai
            $table->timestamps();                  // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};