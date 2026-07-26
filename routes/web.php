<?php

/*
 * web.php — Semua Route HTTP Aplikasi
 * =====================================
 * Struktur route dibagi menjadi beberapa grup berdasarkan akses:
 *
 * [PUBLIK]    → Tidak perlu login (berita, halaman depan, profil yayasan)
 * [DONASI]    → Login + verifikasi email + throttle (donasi, sponsorship, invoice)
 * [DONATUR]   → Login + verifikasi email (dashboard & rekap donatur)
 * [ADMIN]     → Login + verifikasi email + role admin (kelola semua data)
 *
 * Alur akses umum:
 *   Guest       → Lihat berita, halaman depan, profil yayasan → donasi? login dulu
 *   Donatur     → Dashboard, donasi, sponsorship, invoice, rekap pribadi
 *   Admin       → Panel admin: kelola campaign, anak asuh, transaksi, user, berita, rekap
 */

use Illuminate\Support\Facades\Route;

// ─── CONTROLLERS ───────────────────────────────────────────
// Publik (tidak perlu login)
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;

// Admin (perlu login + role admin)
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\ChildDevelopmentController;
use App\Http\Controllers\Admin\FosterChildController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PendiriController;
use App\Http\Controllers\Admin\ProfilYayasanController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RekapController;

// Models (dipakai di route closure)
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\News;

// ─── RUTE PUBLIK: BERITA ───────────────────────────────────
// Siapa pun bisa lihat berita tanpa login
Route::get('/berita', function () {
    $kategoriList = \App\Models\News::where('status', 'published')
        ->whereNotNull('kategori')
        ->distinct()
        ->pluck('kategori')
        ->sort();

    $newsList = \App\Models\News::published()
        ->when(request('search'), fn($q, $s) => $q->where(function($q) use ($s) {
            $q->where('judul', 'like', "%{$s}%")
              ->orWhere('ringkasan', 'like', "%{$s}%")
              ->orWhere('lokasi', 'like', "%{$s}%")
              ->orWhere('penyelenggara', 'like', "%{$s}%");
        }))
        ->when(request('kategori'), fn($q, $k) => $q->where('kategori', $k))
        ->latest('tanggal_kegiatan')
        ->paginate(9)
        ->withQueryString();

    return view('news.index', compact('newsList', 'kategoriList'));
})->name('news.index');

Route::get('/berita/{slug}', function ($slug) {
    $news = \App\Models\News::where('slug', $slug)->published()->firstOrFail();
    return view('news.show', compact('news'));
})->name('news.show');

// ─── RUTE PUBLIK: HALAMAN DEPAN ────────────────────────────
// Jika user sudah login → redirect ke dashboard-nya
// Jika belum → tampilkan welcome page dengan data campaign & berita
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect('/admin/dashboard')
            : redirect('/dashboard');
    }

    $campaigns = Campaign::where('status', 'active')->latest()->get();
    $newsList = News::published()->latest('tanggal_kegiatan')->take(9)->get();

    $totalCampaigns  = Campaign::count();
    $totalDonasi     = Donation::where('status', 'success')->sum('amount');
    $totalTransaksi  = Donation::where('status', 'success')->count();

    return view('welcome', compact('campaigns', 'newsList', 'totalCampaigns', 'totalDonasi', 'totalTransaksi'));
});

// ─── RUTE PUBLIK: PROFIL YAYASAN ───────────────────────────
// Halaman statis: profil yayasan, daftar pengurus/pendiri, legalitas
Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/pengurus', function () {
    $daftarPendiri = \App\Models\Pendiri::latest()->get();
    return view('pengurus', compact('daftarPendiri'));
})->name('pengurus');

Route::get('/legalitas', function () {
    return view('legalitas');
})->name('legalitas');

// ─── RUTE PUBLIK: DETAIL KAMPANYE ──────────────────────────
// Publik/donatur bisa lihat detail campaign sebelum memutuskan donasi
Route::get('/campaign/{campaign}', [DonationController::class, 'show'])->name('campaign.show');

// ─── RUTE DONASI & SPONSOR ──────────────────────────────────
// Wajib: login + verifikasi email + throttle (max 10 request per menit)
// Donatur harus verifikasi email dulu sebelum bisa donasi
Route::middleware(['auth', 'verified', 'throttle:10,1'])->group(function () {
    // Form donasi kampanye
    Route::get('/campaign/{campaign}/donate', [DonationController::class, 'create'])->name('donations.create');
    // Proses simpan donasi
    Route::post('/campaign/{campaign}/donate', [DonationController::class, 'store'])->name('donations.store');
    // Detail anak asuh (lihat profil anak sebelum sponsorship)
    Route::get('/foster-children/{id}', [DonationController::class, 'childDetail'])->name('sponsor.child-detail');
    // Form sponsorship anak asuh
    Route::get('/foster-children/{id}/sponsor', [DonationController::class, 'sponsorForm'])->name('sponsor.form');
    // Proses simpan sponsorship
    Route::post('/foster-children/{id}/sponsor', [DonationController::class, 'sponsorStore'])->name('sponsor.store');

    // Invoice dan PDF
    Route::get('/donations/{id}/invoice', [InvoiceController::class, 'donation'])->name('invoice.donation');
    Route::get('/sponsorships/{id}/invoice', [InvoiceController::class, 'sponsorship'])->name('invoice.sponsorship');
    Route::get('/donations/{id}/invoice/pdf', [InvoiceController::class, 'donationPdf'])->name('invoice.donation.pdf');
    Route::get('/sponsorships/{id}/invoice/pdf', [InvoiceController::class, 'sponsorshipPdf'])->name('invoice.sponsorship.pdf');
    Route::get('/child-developments/{id}/pdf', [InvoiceController::class, 'childDevelopmentPdf'])->name('invoice.child-development.pdf');
});

// ─── RUTE CALLBACK MIDTRANS ────────────────────────────────
// NONAKTIF: sistem saat ini pakai upload bukti transfer manual + konfirmasi admin
// Aktifkan kembali jika integrasi Midtrans sudah terverifikasi
// Route::post('/midtrans/callback', [DonationController::class, 'callback'])
//     ->name('midtrans.callback')
//     ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

// ─── RUTE DASHBOARD DONATUR ────────────────────────────────
// Wajib: login + verifikasi email
Route::get('/dashboard', [DonorController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rekap donasi & sponsorship milik donatur yang login
Route::get('/dashboard/rekap', [DonorController::class, 'rekap'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.rekap');

// Halaman informasi yayasan untuk donatur (stay di layout dashboard)
Route::get('/dashboard/profil-yayasan', [DonorController::class, 'profil'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.profil');
Route::get('/dashboard/pengurus', [DonorController::class, 'pengurus'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.pengurus');
Route::get('/dashboard/legalitas', [DonorController::class, 'legalitas'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.legalitas');

// ─── RUTE PROFIL DONATUR ──────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');     // Edit profil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update profil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Hapus akun
});

// ─── RUTE ADMIN ──────────────────────────────────────────────
// Proteksi: auth + verifikasi email + middleware 'admin' (cek role)
// Semua route di-prefix /admin dan diberi nama admin.*
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // ── DASHBOARD ADMIN ──
    // Statistik: total dana, campaign aktif, anak asuh, grafik cashflow
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ── PROFIL & PENDIRI YAYASAN ──
    Route::get('/profil', [ProfilYayasanController::class, 'index'])->name('profil.index');     // Lihat profil
    Route::get('/profil/edit', [ProfilYayasanController::class, 'edit'])->name('profil.edit');   // Form edit profil
    Route::put('/profil/update', [ProfilYayasanController::class, 'update'])->name('profil.update'); // Simpan perubahan

    // CRUD data pendiri/pengurus yayasan
    Route::get('/pendiri', [PendiriController::class, 'index'])->name('pendiri.index');
    Route::post('/pendiri', [PendiriController::class, 'store'])->name('pendiri.store');
    Route::put('/pendiri/{id}', [PendiriController::class, 'update'])->name('pendiri.update');
    Route::delete('/pendiri/{id}', [PendiriController::class, 'destroy'])->name('pendiri.destroy');

    // ── KELOLA ANAK ASUH ──
    // CRUD lengkap: index, create, store, show, edit, update, destroy
    Route::resource('foster-children', FosterChildController::class);

    // ── LAPORAN PERKEMBANGAN ANAK ──
    Route::resource('child-developments', ChildDevelopmentController::class);

    // ── KELOLA SPONSORSHIP ──
    Route::get('/sponsorships', [SponsorshipController::class, 'index'])->name('sponsorships.index');   // Daftar semua sponsorship
    Route::get('/sponsorships/contacts', [SponsorshipController::class, 'contacts'])->name('sponsorships.contacts'); // Kontak anak asuh + status
    Route::patch('/sponsorships/{id}/approve', [SponsorshipController::class, 'approve'])->name('sponsorships.approve'); // Setujui
    Route::patch('/sponsorships/{id}/reject', [SponsorshipController::class, 'reject'])->name('sponsorships.reject');   // Tolak
    Route::delete('/sponsorships/{id}', [SponsorshipController::class, 'destroy'])->name('sponsorships.destroy'); // Hapus

    // ── KELOLA BERITA ──
    Route::resource('news', NewsController::class);

    // ── KELOLA CAMPAIGN ──
    Route::resource('campaigns', CampaignController::class);

    // ── KELOLA TRANSAKSI ──
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');  // Daftar transaksi
    Route::post('/transactions/sync-all', [TransactionController::class, 'syncAll'])->name('transactions.sync-all'); // Sync semua ke Midtrans
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');     // Hapus
    Route::patch('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('transactions.approve'); // Setujui
    Route::patch('/transactions/{id}/reject', [TransactionController::class, 'reject'])->name('transactions.reject');   // Tolak dgn alasan
    Route::post('/transactions/{id}/sync', [TransactionController::class, 'sync'])->name('transactions.sync');   // Sync satu transaksi ke Midtrans

    // ── KELOLA USER ──
    Route::get('/users', [UserController::class, 'index'])->name('users.index');      // Daftar semua user
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');   // Form edit user
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');    // Update user
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Hapus user

    // ── REKAP & EXPORT ──
    // Prefix /admin/rekap/... → name admin.rekap.*
    // Format export: CSV & PDF (landscape)
    Route::prefix('rekap')->name('rekap.')->group(function () {
        // Donasi
        Route::get('/donasi', [RekapController::class, 'donasi'])->name('donasi');                // Tabel rekap donasi
        Route::get('/donasi/export', [RekapController::class, 'donasiExport'])->name('donasi.export');       // CSV
        Route::get('/donasi/export-pdf', [RekapController::class, 'donasiExportPdf'])->name('donasi.export-pdf'); // PDF

        // Donatur
        Route::get('/donatur', [RekapController::class, 'donatur'])->name('donatur');               // Tabel rekap donatur
        Route::get('/donatur/export', [RekapController::class, 'donaturExport'])->name('donatur.export');     // CSV
        Route::get('/donatur/export-pdf', [RekapController::class, 'donaturExportPdf'])->name('donatur.export-pdf'); // PDF

        // Orang Tua Asuh
        Route::get('/orang-tua-asuh', [RekapController::class, 'orangTuaAsuh'])->name('orang-tua-asuh');        // Tabel rekap OTA
        Route::get('/orang-tua-asuh/export', [RekapController::class, 'orangTuaAsuhExport'])->name('orang-tua-asuh.export');   // CSV
        Route::get('/orang-tua-asuh/export-pdf', [RekapController::class, 'orangTuaAsuhExportPdf'])->name('orang-tua-asuh.export-pdf'); // PDF
    });
});

require __DIR__.'/auth.php';