<?php
// === Controller: base controller untuk semua controller ===

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    // --- DASHBOARD ROUTE: mengembalikan route dashboard sesuai role user (admin/donatur) ---
    protected function dashboardRoute(): string
    {
        return Auth::check() && Auth::user()->role === 'admin'
            ? route('admin.dashboard')
            : route('dashboard');
    }
}
