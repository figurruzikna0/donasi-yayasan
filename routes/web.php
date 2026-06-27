<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\Admin\FosterChildController;
use App\Models\Campaign;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfilYayasanController;
use App\Http\Controllers\Admin\PendiriController;

// --- RUTE HALAMAN DEPAN ---
Route::get('/', function () {
    $campaigns = Campaign::where('status', 'active')->latest()->get();
    $profil = \App\Models\ProfilYayasan::first();
    $fosterChildren = \App\Models\FosterChild::latest()->get(); // ← tambah ini
    return view('welcome', compact('campaigns', 'profil', 'fosterChildren')); // ← dan ini
});

// --- RUTE PUBLIK (Donasi & Sponsor Anak Asuh) ---
Route::get('/campaign/{campaign}/donate', [DonationController::class, 'create'])->name('donations.create');
Route::post('/campaign/{campaign}/donate', [DonationController::class, 'store'])->name('donations.store');

// Rute Orang Tua Asuh (Publik)
Route::get('/foster-children/{id}/sponsor', [DonationController::class, 'sponsorForm'])->name('sponsor.form');
Route::post('/foster-children/{id}/sponsor', [DonationController::class, 'sponsorStore'])->name('sponsor.store');

// Rute Callback Midtrans (dipanggil server Midtrans, bukan oleh user)
Route::post('/midtrans/callback', [DonationController::class, 'callback'])
    ->name('midtrans.callback')
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

// --- RUTE AUTH & DASHBOARD ---
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
        $totalFunds = \App\Models\Donation::where('status', 'success')->sum('amount');
        $activeCampaigns = \App\Models\Campaign::where('status', 'active')->count();
        $fosterChildren = \App\Models\FosterChild::count();
        $profil = \App\Models\ProfilYayasan::first();
        
        return view('admin.dashboard', compact('totalFunds', 'activeCampaigns', 'fosterChildren', 'profil'));
    })->name('dashboard');

    // Profil & Pendiri
    Route::get('/profil', [ProfilYayasanController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilYayasanController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/update', [ProfilYayasanController::class, 'update'])->name('profil.update');

    Route::get('/pendiri', [PendiriController::class, 'index'])->name('pendiri.index');
    Route::post('/pendiri', [PendiriController::class, 'store'])->name('pendiri.store');
    Route::delete('/pendiri/{id}', [PendiriController::class, 'destroy'])->name('pendiri.destroy');

    // Kelola Data Anak Asuh
    Route::resource('foster-children', FosterChildController::class);
    
    // Kelola Kampanye
    Route::resource('campaigns', CampaignController::class);
    
    // Kelola Transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::patch('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');
});

require __DIR__.'/auth.php';