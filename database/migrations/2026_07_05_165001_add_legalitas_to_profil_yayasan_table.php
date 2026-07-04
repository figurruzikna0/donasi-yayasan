<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('profil_yayasan', 'legalitas')) {
            Schema::table('profil_yayasan', function (Blueprint $table) {
                $table->text('legalitas')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::table('profil_yayasan', function (Blueprint $table) {
            $table->dropColumn('legalitas');
        });
    }
};
