<?php

/*
 * providers.php — Daftar service provider
 * ==========================================
 * Mendaftarkan service provider yang dimuat
 * saat aplikasi di-bootstrap.
 */

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
];
