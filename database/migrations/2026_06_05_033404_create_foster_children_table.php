<?php
// === 2026_06_05_033404_create_foster_children_table: membuat tabel foster_children dengan kolom name, age, description, photo, status ===

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
    Schema::create('foster_children', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('age');
        $table->text('description')->nullable(); // Cerita latar belakang anak
        $table->string('photo')->nullable(); // Link foto anak
        $table->enum('status', ['Tersedia', 'Diasuh'])->default('Tersedia'); 
        $table->timestamps();
        });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foster_children');
    }
};
