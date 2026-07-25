<?php

/*
 * AdminMiddleware — Middleware Pengecek Role Admin
 * =================================================
 * Middleware ini dipasang di semua route grup /admin/*.
 * Dicek di routes/web.php via alias 'admin':
 *   Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->...
 *
 * Logika:
 *   - Cek apakah user sudah login
 *   - Cek apakah role = 'admin'
 *   - Jika tidak → return 403 "Akses ditolak"
 *   - Jika ya → lanjut ke controller
 *
 * Terdaftar di bootstrap/app.php:
 *   ->withMiddleware(function (Middleware $middleware) {
 *       $middleware->alias(['admin' => AdminMiddleware::class]);
 *   })
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk administrator.');
        }

        return $next($request);
    }
}
