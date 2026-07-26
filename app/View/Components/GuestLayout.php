<?php

/*
 * GuestLayout — Layout untuk halaman publik / tanpa login
 * =========================================================
 * Merender file resources/views/layouts/guest.blade.php sebagai template
 * untuk halaman seperti login, register, forgot password, dll.
 */

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    // Tampilkan layout guest (minimalis, tanpa sidebar)
    public function render(): View
    {
        return view('layouts.guest');
    }
}
