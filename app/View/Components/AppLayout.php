<?php

/*
 * AppLayout — Layout untuk halaman yang membutuhkan autentikasi (user/login)
 * ==========================================================================
 * Merender file resources/views/layouts/app.blade.php sebagai template utama
 * untuk halaman-halaman yang hanya bisa diakses setelah login.
 */

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    // Tampilkan layout app (sidebar + navbar untuk user yang sudah login)
    public function render(): View
    {
        return view('layouts.app');
    }
}
