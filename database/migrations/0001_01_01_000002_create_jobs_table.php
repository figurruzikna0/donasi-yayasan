<?php
// === 0001_01_01_000002_create_jobs_table: membuat tabel jobs, job_batches, dan failed_jobs ===
// Migrasi BAWAAN Laravel untuk QUEUE (antrian pekerjaan).
// Tiga tabel dibuat:
//  1. jobs          → antrian job yang menunggu diproses
//  2. job_batches   → info kelompok job (batch) yang dijalankan bersama
//  3. failed_jobs   → catatan job yang GAGAL diproses (untuk retry/debug)
// Dipakai bila aplikasi memakai queue driver 'database'
// (config/queue.php). Saat ini sistem belum aktif memakai queue.

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
        // ── TABEL JOBS (antrian) ─────────────────────────────
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();                          // ID job
            $table->string('queue')->index();      // nama antrian (default/email/dll.) — di-index
            $table->longText('payload');           // isi job (data serialisasi)
            $table->unsignedSmallInteger('attempts');  // berapa kali job sudah dicoba
            $table->unsignedInteger('reserved_at')->nullable();  // kapan job "diambil" worker (null = belum)
            $table->unsignedInteger('available_at'); // kapan job boleh diproses (untuk delay)
            $table->unsignedInteger('created_at');   // waktu job dibuat
        });

        // ── TABEL JOB BATCHES (kelompok job) ────────────────
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();       // ID batch (string UUID)
            $table->string('name');                // nama batch
            $table->integer('total_jobs');         // total job dalam batch
            $table->integer('pending_jobs');       // job yang belum selesai
            $table->integer('failed_jobs');        // job yang gagal
            $table->longText('failed_job_ids');    // daftar ID job gagal (serialisasi)
            $table->mediumText('options')->nullable();   // opsi tambahan batch
            $table->integer('cancelled_at')->nullable(); // kapan batch dibatalkan (null = tidak)
            $table->integer('created_at');         // waktu batch dibuat
            $table->integer('finished_at')->nullable();  // kapan batch selesai (null = belum)
        });

        // ── TABEL FAILED JOBS (job gagal) ───────────────────
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();      // identitas unik job gagal
            $table->string('connection');          // koneksi queue asal
            $table->string('queue');               // nama antrian asal
            $table->longText('payload');           // isi job yang gagal
            $table->longText('exception');         // pesan exception/error lengkap (untuk debugging)
            $table->timestamp('failed_at')->useCurrent();  // waktu gagal (otomatis = sekarang)

            // Index gabungan: memudahkan pencarian berdasarkan koneksi+antrian+waktu
            $table->index(['connection', 'queue', 'failed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};