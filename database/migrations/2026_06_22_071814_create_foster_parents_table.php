<?php
// === 2026_06_22_071814_create_foster_parents_table: membuat tabel foster_parents dengan kolom user_id, foster_child_id, monthly_amount, status ===

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
    Schema::create('foster_parents', function (Blueprint $table) {
        $table->id();
        // ID Donatur yang jadi orang tua asuh
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        
        // ID Anak yang diasuh
        $table->foreignId('foster_child_id')->constrained('foster_children')->cascadeOnDelete();
        
        // Nominal komitmen donasi per bulan (misal Rp 100.000)
        $table->integer('monthly_amount');
        
        // Status komitmen
        $table->enum('status', ['Aktif', 'Berhenti'])->default('Aktif');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foster_parents');
    }
};
