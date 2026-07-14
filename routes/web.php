<?php

use Illuminate\Support\Facades\Route;

// Controllers — Publik
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;

// Controllers — Admin
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

// Models
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\FosterChild;
use App\Models\News;
use App\Models\Sponsorship;
use App\Models\ProfilYayasan;

// --- RUTE BERITA PUBLIK ---
Route::get('/berita/{slug}', function ($slug) {
    $news = \App\Models\News::where('slug', $slug)->published()->firstOrFail();
    return view('news.show', compact('news'));
})->name('news.show');

// --- RUTE HALAMAN DEPAN ---
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

// --- RUTE HALAMAN PROFIL, PENGURUS, LEGALITAS ---
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

// --- RUTE DONASI & SPONSOR (wajib login & verifikasi) ---
Route::middleware(['auth', 'verified', 'throttle:10,1'])->group(function () {
    Route::get('/campaign/{campaign}/donate', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/campaign/{campaign}/donate', [DonationController::class, 'store'])->name('donations.store');
    Route::get('/foster-children/{id}/sponsor', [DonationController::class, 'sponsorForm'])->name('sponsor.form');
    Route::post('/foster-children/{id}/sponsor', [DonationController::class, 'sponsorStore'])->name('sponsor.store');

    // Invoice
    Route::get('/donations/{id}/invoice', [InvoiceController::class, 'donation'])->name('invoice.donation');
    Route::get('/sponsorships/{id}/invoice', [InvoiceController::class, 'sponsorship'])->name('invoice.sponsorship');
    Route::get('/donations/{id}/invoice/pdf', [InvoiceController::class, 'donationPdf'])->name('invoice.donation.pdf');
    Route::get('/sponsorships/{id}/invoice/pdf', [InvoiceController::class, 'sponsorshipPdf'])->name('invoice.sponsorship.pdf');
    Route::get('/child-developments/{id}/pdf', [InvoiceController::class, 'childDevelopmentPdf'])->name('invoice.child-development.pdf');
});

// --- RUTE CALLBACK MIDTRANS (dipanggil server Midtrans, bukan user) ---
Route::post('/midtrans/callback', [DonationController::class, 'callback'])
    ->name('midtrans.callback')
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

// --- RUTE AUTH & DASHBOARD DONATUR ---
Route::get('/dashboard', [DonorController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/dashboard/rekap', [DonorController::class, 'rekap'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.rekap');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// --- RUTE ADMIN (Terlindungi) ---
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil & Pendiri Yayasan
    Route::get('/profil', [ProfilYayasanController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilYayasanController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/update', [ProfilYayasanController::class, 'update'])->name('profil.update');

    Route::get('/pendiri', [PendiriController::class, 'index'])->name('pendiri.index');
    Route::post('/pendiri', [PendiriController::class, 'store'])->name('pendiri.store');
    Route::delete('/pendiri/{id}', [PendiriController::class, 'destroy'])->name('pendiri.destroy');

    // Kelola Data Anak Asuh (CRUD profil anak)
    Route::resource('foster-children', FosterChildController::class);

    // Kelola Perkembangan Anak Asuh
    Route::resource('child-developments', ChildDevelopmentController::class);

    // Kelola Sponsorship / Orang Tua Asuh
    Route::get('/sponsorships', [SponsorshipController::class, 'index'])->name('sponsorships.index');
    Route::get('/sponsorships/contacts', [SponsorshipController::class, 'contacts'])->name('sponsorships.contacts');
    Route::patch('/sponsorships/{id}/approve', [SponsorshipController::class, 'approve'])->name('sponsorships.approve');
    Route::delete('/sponsorships/{id}', [SponsorshipController::class, 'destroy'])->name('sponsorships.destroy');

    // Kelola Berita Kegiatan
    Route::resource('news', NewsController::class);

    // Kelola Kampanye
    Route::resource('campaigns', CampaignController::class);

    // Kelola Transaksi Donasi Kampanye
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions/sync-all', [TransactionController::class, 'syncAll'])->name('transactions.sync-all');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::patch('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');
    Route::post('/transactions/{id}/sync', [TransactionController::class, 'sync'])->name('transactions.sync');

    // Kelola Data User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Rekap Data
    Route::prefix('rekap')->name('rekap.')->group(function () {
        Route::get('/donasi', [RekapController::class, 'donasi'])->name('donasi');
        Route::get('/donasi/export', [RekapController::class, 'donasiExport'])->name('donasi.export');
        Route::get('/donasi/export-pdf', [RekapController::class, 'donasiExportPdf'])->name('donasi.export-pdf');
        Route::get('/donatur', [RekapController::class, 'donatur'])->name('donatur');
        Route::get('/donatur/export', [RekapController::class, 'donaturExport'])->name('donatur.export');
        Route::get('/donatur/export-pdf', [RekapController::class, 'donaturExportPdf'])->name('donatur.export-pdf');
        Route::get('/orang-tua-asuh', [RekapController::class, 'orangTuaAsuh'])->name('orang-tua-asuh');
        Route::get('/orang-tua-asuh/export', [RekapController::class, 'orangTuaAsuhExport'])->name('orang-tua-asuh.export');
        Route::get('/orang-tua-asuh/export-pdf', [RekapController::class, 'orangTuaAsuhExportPdf'])->name('orang-tua-asuh.export-pdf');
    });
});

require __DIR__.'/auth.php';