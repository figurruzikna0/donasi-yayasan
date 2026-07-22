<?php
// === 2026_06_27_121337_create_sponsorships_table: membuat tabel sponsorships dengan kolom foster_child_id, order_id, donor_name, donor_email, amount, snap_token, status ===

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('foster_child_id')->constrained()->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->string('donor_name');
            $table->string('donor_email');
            $table->decimal('amount', 12, 2);
            $table->string('snap_token')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsorships');
    }
};