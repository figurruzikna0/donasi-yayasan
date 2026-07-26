<?php

/*
 * AdminLayout — Layout khusus halaman admin/panel
 * =================================================
 * Merender file resources/views/layouts/admin.blade.php sebagai template
 * utama untuk halaman dashboard admin dan fitur manajemen lainnya.
 */

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    // Tampilkan layout admin (sidebar admin + navbar)
    public function render(): View
    {
        return view('layouts.admin');
    }
}
