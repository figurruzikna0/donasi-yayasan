<?php

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
