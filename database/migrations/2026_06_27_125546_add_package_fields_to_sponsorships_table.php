<?php
// === 2026_06_27_125546_add_package_fields_to_sponsorships_table: menambah kolom package, package_description, payment_method ke tabel sponsorships ===

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->string('package')->nullable()->after('foster_child_id');
            $table->text('package_description')->nullable()->after('package');
            $table->string('payment_method')->nullable()->after('package_description');
        });
    }

    public function down(): void
    {
        Schema::table('sponsorships', function (Blueprint $table) {
            $table->dropColumn(['package', 'package_description', 'payment_method']);
        });
    }
};