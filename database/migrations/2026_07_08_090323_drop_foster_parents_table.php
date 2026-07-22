<?php
// === 2026_07_08_090323_drop_foster_parents_table: menghapus tabel foster_parents (diganti dengan sistem sponsorship) ===

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('foster_parents');
    }

    public function down(): void
    {
        Schema::create('foster_parents', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('foster_child_id')->constrained('foster_children')->cascadeOnDelete();
            $table->integer('monthly_amount');
            $table->enum('status', ['Aktif', 'Berhenti'])->default('Aktif');
            $table->timestamps();
        });
    }
};
