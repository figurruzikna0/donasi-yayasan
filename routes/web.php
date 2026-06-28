<?php

use Illuminate\Support\Facades\Route;

// Controllers — Publik
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ProfileController;

// Controllers — Admin
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\FosterChildController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PendiriController;
use App\Http\Controllers\Admin\ProfilYayasanController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\TransactionController;

// Models
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\FosterChild;
use App\Models\News;
use App\Models\ProfilYayasan;

// --- RUTE HALAMAN DEPAN ---
Route::get('/', function () {
    $campaigns = Campaign::where('status', 'active')->latest()->get();
    $profil = ProfilYayasan::first();
    $fosterChildren = FosterChild::latest()->get();
    $newsList = News::published()->latest('tanggal_kegiatan')->take(9)->get();

    return view('welcome', compact('campaigns', 'profil', 'fosterChildren', 'newsList'));
});

// --- RUTE PUBLIK: DONASI KAMPANYE ---
Route::get('/campaign/{campaign}/donate', [DonationController::class, 'create'])->name('donations.create');
Route::post('/campaign/{campaign}/donate', [DonationController::class, 'store'])->name('donations.store');

// --- RUTE PUBLIK: SPONSOR ORANG TUA ASUH ---
Route::get('/foster-children/{id}/sponsor', [DonationController::class, 'sponsorForm'])->name('sponsor.form');
Route::post('/foster-children/{id}/sponsor', [DonationController::class, 'sponsorStore'])->name('sponsor.store');

// --- RUTE CALLBACK MIDTRANS (dipanggil server Midtrans, bukan user) ---
Route::post('/midtrans/callback', [DonationController::class, 'callback'])
    ->name('midtrans.callback')
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

// --- RUTE AUTH & DASHBOARD DONATUR ---
Route::get('/dashboard', [DonorController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- RUTE ADMIN (Terlindungi) ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        $totalFunds = Donation::where('status', 'success')->sum('amount');
        $activeCampaigns = Campaign::where('status', 'active')->count();
        $fosterChildren = FosterChild::count();
        $profil = ProfilYayasan::first();

        return view('admin.dashboard', compact('totalFunds', 'activeCampaigns', 'fosterChildren', 'profil'));
    })->name('dashboard');

    // Profil & Pendiri Yayasan
    Route::get('/profil', [ProfilYayasanController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilYayasanController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/update', [ProfilYayasanController::class, 'update'])->name('profil.update');

    Route::get('/pendiri', [PendiriController::class, 'index'])->name('pendiri.index');
    Route::post('/pendiri', [PendiriController::class, 'store'])->name('pendiri.store');
    Route::delete('/pendiri/{id}', [PendiriController::class, 'destroy'])->name('pendiri.destroy');

    // Kelola Data Anak Asuh (CRUD profil anak)
    Route::resource('foster-children', FosterChildController::class);

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
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::patch('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');
});

require __DIR__.'/auth.php';