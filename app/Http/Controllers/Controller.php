<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function dashboardRoute(): string
    {
        return Auth::check() && Auth::user()->role === 'admin'
            ? route('admin.dashboard')
            : route('dashboard');
    }
}
