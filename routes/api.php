<?php
// === api.php: routes API untuk callback Midtrans ===

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;

// --- RUTE: POST /midtrans-callback → DonationController@callback (callback Midtrans via API) ---
Route::post('/midtrans-callback', [DonationController::class, 'callback']);