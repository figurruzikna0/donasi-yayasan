<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController; // <-- Import controller donatur baru kita
use App\Http\Controllers\FosterChildController;
use App\Models\Campaign;
use Illuminate\Support\Facades\Route;

// --- RUTE HALAMAN DEPAN ---
Route::get('/', function () {
    $campaigns = Campaign::where('status', 'active')->latest()->get();
    return view('welcome', compact('campaigns'));
});

// --- RUTE PUBLIK UNTUK DONASI ---
Route::get('/campaign/{campaign}/donate', [DonationController::class, 'create'])->name('donations.create');
Route::post('/campaign/{campaign}/donate', [DonationController::class, 'store'])->name('donations.store');

// --- RUTE DASHBOARD DONATUR (Baru) ---
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
        
        return view('admin.dashboard', compact('totalFunds', 'activeCampaigns', 'fosterChildren'));
    })->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {    

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route untuk kelola data anak asuh
    Route::resource('foster_children', FosterChildController::class);
    Route::resource('transactions', TransactionController::class);
});

    // Route untuk kelola kampanye
    Route::resource('campaigns', CampaignController::class);
    
    // Route untuk melihat daftar transaksi donasi
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    
    // RUTE BARU: UNTUK TOMBOL HAPUS DATA TESTING (TONG SAMPAH)
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});


require __DIR__.'/auth.php';