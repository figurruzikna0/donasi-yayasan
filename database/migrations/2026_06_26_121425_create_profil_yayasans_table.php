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
    Schema::create('profil_yayasan', function (Blueprint $table) {
        $table->id();
        $table->string('nama_yayasan');
        $table->string('email');
        $table->string('no_telp');
        $table->text('alamat');
        
        // TAMBAHKAN KOLOM-KOLOM BARU INI:
        $table->text('sejarah_yayasan')->nullable();
        $table->text('visi')->nullable();
        $table->text('misi')->nullable();
        $table->string('logo')->nullable();
        $table->text('legalitas')->nullable();
        $table->string('foto_legalitas')->nullable();
        $table->string('foto_struktur')->nullable();
        
        $table->timestamps();
    });
}
};
