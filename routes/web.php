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
    
    // Ambil data profil yayasan dari database
    $profil = \App\Models\ProfilYayasan::first(); 
    
    // Kirim data $campaigns dan $profil ke halaman welcome
    return view('welcome', compact('campaigns', 'profil')); 
});

// --- RUTE PUBLIK UNTUK DONASI ---
Route::get('/campaign/{campaign}/donate', [DonationController::class, 'create'])->name('donations.create');
Route::post('/campaign/{campaign}/donate', [DonationController::class, 'store'])->name('donations.store');

// --- RUTE DASHBOARD DONATUR ---
Route::get('/dashboard', [DonorController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- RUTE BAWAAN AUTH ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- RUTE UNTUK ADMIN ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Khusus Admin
    Route::get('/dashboard', function () {
        $totalFunds = \App\Models\Donation::where('status', 'success')->sum('amount');
        $activeCampaigns = \App\Models\Campaign::where('status', 'active')->count();
        $fosterChildren = \App\Models\FosterChild::count();
        
        // Ambil data profil yayasan
        $profil = \App\Models\ProfilYayasan::first();
        
        return view('admin.dashboard', compact('totalFunds', 'activeCampaigns', 'fosterChildren', 'profil'));
    })->name('dashboard');

    // === ROUTE KELOLA PROFIL YAYASAN ===
    Route::get('/profil', [ProfilYayasanController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilYayasanController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/update', [ProfilYayasanController::class, 'update'])->name('profil.update');

    // === ROUTE PENDIRI YAYASAN ===
    Route::get('/pendiri', [PendiriController::class, 'index'])->name('pendiri.index');
    Route::post('/pendiri', [PendiriController::class, 'store'])->name('pendiri.store');
    Route::delete('/pendiri/{id}', [PendiriController::class, 'destroy'])->name('pendiri.destroy');

    // Route Kelola Data Anak Asuh
    Route::resource('foster-children', FosterChildController::class)->names('foster-children');
    
    // Route Kelola Kampanye
    Route::resource('campaigns', CampaignController::class);
    
    // Route Kelola Transaksi (Index, Hapus, & ACC)
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::patch('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');

}); // <--- Pembatas grup admin aman di sini

require __DIR__.'/auth.php';