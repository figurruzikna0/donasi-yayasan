<!-- ============================================ -->
<!-- layouts/navigation.blade.php - NAVBAR PENGGUNA (NON-ADMIN) -->
<!-- ============================================ -->
<!-- Peran: navigasi utama untuk pengguna yang sudah login dengan role selain admin (donatur), di-include dari layouts/app.blade.php. -->
<!-- Data: $navUser (data user login via Auth::user()) dan $profil (logo/nama yayasan) dari view composer global. -->
<!-- Alur: jika user non-admin, render navbar sticky berisi logo, menu Dashboard, dropdown akun desktop, dan menu hamburger mobile (state Alpine 'open'). -->
{{-- LAYOUTS_NAVIGATION: navigasi utama untuk pengguna non-admin -- logo, tautan dashboard, dropdown profil, dan menu mobile --}}
@php $navUser = Auth::user(); @endphp
<!-- if: seluruh navbar ini hanya dirender untuk pengguna dengan role selain 'admin'; admin memakai layout/sidebar panel sendiri -->
@if($navUser && $navUser->role !== 'admin')
{{-- BAGIAN: wrapper navigasi desktop dengan logo, tautan, dan dropdown profil --}}
<nav x-data="{ open: false }" class="bg-base-100 border-b border-base-200">
    <div class="navbar max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-[4rem]">
        <div class="flex-1 flex items-center gap-4">
            <!-- Logo & nama yayasan: menuju dashboard sesuai role user yang login -->
            <a href="{{ $navUser?->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="shrink-0 flex items-center gap-2">
                @php $logoNav = $profil; @endphp
                <!-- if: tampilkan logo yayasan dari storage jika ada, jika tidak tampilkan ikon fallback -->
                @if($logoNav?->logo)
                    <img src="{{ asset('storage/' . $logoNav->logo) . '?v=' . now()->timestamp }}" class="h-8 w-8 rounded-lg object-cover border border-base-300" alt="Logo">
                @else
                    <span class="text-xl">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0112 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18"/></svg>
                        </span>
                @endif
                <span class="text-sm font-bold text-primary hidden sm:inline">{{ $logoNav?->nama_yayasan ?? 'Baitul Yatim' }}</span>
            </a>
            <!-- Menu navigasi desktop: tautan Dashboard memakai komponen x-nav-link; item aktif dideteksi lewat request()->routeIs() -->
            <div class="hidden sm:flex gap-1">
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    Dashboard
                </x-nav-link>
            </div>
        </div>

        {{-- BAGIAN: dropdown profil pengguna untuk layar desktop --}}
        <div class="flex-none hidden sm:flex">
            <div class="dropdown dropdown-end">
                <!-- Tombol pemicu dropdown: avatar (foto atau inisial nama), nama user, dan panah -->
                <button tabindex="0" class="flex items-center gap-2.5 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors">
                    @if($navUser->avatar)
                        <img src="{{ asset('storage/' . $navUser->avatar) }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-base-300">
                    @else
                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-extrabold text-sm flex items-center justify-center ring-2 ring-base-300">
                            {{ strtoupper(substr($navUser->name, 0, 1)) }}
                        </div>
                    @endif
                    <span class="text-sm font-bold text-base-content hidden sm:inline">{{ $navUser->name }}</span>
                    <svg class="w-3.5 h-3.5 text-base-content/30 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <!-- Panel menu dropdown akun: Edit Profil dan Keluar -->
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-56 p-2 shadow-lg border border-base-200">
                    <li class="menu-title text-xs"><span>Akun</span></li>
                    <li><a href="{{ route('profile.edit') }}" class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Edit Profil
                    </a></li>
                    <li class="menu-title text-xs mt-2"><span>Sesi</span></li>
                    <li>
                        <!-- Form logout pada dropdown desktop: metode POST dengan token CSRF -->
                        <form method="POST" action="{{ route('logout') }}" class="p-0">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 text-error">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        {{-- BAGIAN: tombol hamburger untuk menu navigasi mobile --}}
        <div class="flex-none sm:hidden">
            <!-- Tombol hamburger: membalik state 'open' Alpine; ikon berubah antara garis menu dan tanda silang -->
            <button @click="open = ! open" class="btn btn-ghost btn-square">
                <svg x-show="!open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- BAGIAN: panel menu navigasi dropdown untuk layar mobile --}}
    <div x-show="open" class="sm:hidden bg-base-100 border-t border-base-200">
        <ul class="menu menu-md p-4 pt-2">
            <!-- Menu mobile: tautan dashboard memakai atribut Alpine (:href) karena berada dalam scope x-data -->
            <li><a :href="route('dashboard')" wire:navigate>Dashboard</a></li>
            <li class="menu-title text-xs"><span>Akun</span></li>
            <li><a :href="route('profile.edit')" class="flex items-center gap-2" wire:navigate>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Edit Profil
            </a></li>
            <li>
                <!-- Form logout pada menu mobile -->
                <form method="POST" action="{{ route('logout') }}" class="p-0">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-error w-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
@endif