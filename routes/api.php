<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;

// Rute "Telinga" VIP khusus untuk nerima laporan otomatis dari Midtrans
Route::post('/midtrans-callback', [DonationController::class, 'callback']);