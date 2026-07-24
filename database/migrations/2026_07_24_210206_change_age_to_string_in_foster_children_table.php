<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE foster_children MODIFY COLUMN age VARCHAR(10) NOT NULL DEFAULT '0'");
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE foster_children MODIFY COLUMN age INT NOT NULL DEFAULT 0');
    }
};
