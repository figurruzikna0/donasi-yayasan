{{-- PARTIALS_PUBLIC_NAVBAR: navigasi utama publik -- logo yayasan, menu desktop & mobile, tombol Daftar/Masuk --}}
<nav id="navbar" class="navbar bg-base-100/90 backdrop-blur-lg sticky top-0 z-50 shadow-sm{{ isset($scrollEffect) && $scrollEffect ? ' transition-all duration-300' : '' }}"
     x-data="{ mobileOpen: false, tentangOpen: false }">
    <div class="navbar-start">
        <a href="/" class="flex items-center gap-3">
            @if($profil && $profil->logo)
                <img src="{{ asset('storage/' . $profil->logo) . '?v=' . now()->timestamp }}" alt="Logo" class="h-9 w-9 rounded-full object-cover border border-emerald-200 shadow-sm">
            @else
                <span class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                </span>
            @endif
            <span class="text-xl font-extrabold tracking-wide text-emerald-700">
                {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}
            </span>
        </a>
    </div>

    {{-- BAGIAN: konfigurasi link dropdown Tentang Kami --}}
    @php
        $useRouteLinks = $useRouteLinks ?? true;
        $tentangLinks = $useRouteLinks
            ? [['route' => route('profil'), 'label' => 'Profil Yayasan'], ['route' => route('pengurus'), 'label' => 'Pengurus'], ['route' => route('legalitas'), 'label' => 'Legalitas & Struktur']]
            : [['route' => url('/#tentang-kami'), 'label' => 'Profil Yayasan'], ['route' => url('/#pendiri'), 'label' => 'Pengurus'], ['route' => url('/#legalitas'), 'label' => 'Legalitas & Struktur']];
    @endphp

    {{-- MENU DESKTOP --}}
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal gap-1">
            <li><a href="{{ ($isHome ?? false) ? '#' : url('/') }}" class="font-bold text-emerald-700">Beranda</a></li>
            <li class="dropdown" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a @click.prevent="open = !open" :class="open ? 'bg-emerald-50' : ''" class="font-bold text-emerald-700 cursor-pointer flex items-center gap-1">
                    Tentang Kami
                    <svg class="w-3.5 h-3.5 transition-transform" :class="open ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
                </a>
                <ul x-show="open" x-cloak @click.outside="open = false" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="absolute top-full mt-1 menu p-2 shadow-xl bg-base-100 rounded-xl min-w-[200px] z-[100] border border-emerald-200">
                    @foreach($tentangLinks as $link)
                    <li><a href="{{ $link['route'] }}" class="font-bold text-emerald-700" @click="open = false">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ ($isHome ?? false) ? '#aksi-cepat' : url('/#aksi-cepat') }}" class="font-bold text-emerald-700">Program Donasi</a></li>
            <li><a href="{{ ($isHome ?? false) ? '#program-ota' : url('/#program-ota') }}" class="font-bold text-emerald-700">Orang Tua Asuh</a></li>
            <li><a href="{{ route('news.index') }}" class="font-bold text-emerald-700">Berita</a></li>
        </ul>
    </div>

    {{-- TOMBOL AKSI DESKTOP + HAMBURGER MOBILE --}}
    <div class="navbar-end gap-2">
        <a href="{{ route('register') }}" class="btn btn-outline btn-success btn-sm font-bold hidden sm:inline-flex">Daftar</a>
        <a href="{{ route('login') }}" class="btn btn-success btn-sm font-bold text-white hidden sm:inline-flex">Masuk</a>
        <button @click="mobileOpen = !mobileOpen" class="btn btn-ghost btn-square lg:hidden">
            <svg x-show="!mobileOpen" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="mobileOpen" x-cloak width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <path d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- MENU MOBILE --}}
    <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="absolute top-full left-0 right-0 bg-base-100 border-t border-emerald-100 shadow-lg lg:hidden" @click.outside="mobileOpen = false">
        <ul class="menu menu-md p-4">
            <li><a href="{{ ($isHome ?? false) ? '#' : url('/') }}" class="font-bold text-emerald-800" @click="mobileOpen = false">Beranda</a></li>
            <li class="menu-title text-xs"><span>Tentang</span></li>
            @foreach($tentangLinks as $link)
            <li><a href="{{ $link['route'] }}" class="text-emerald-700" @click="mobileOpen = false">{{ $link['label'] }}</a></li>
            @endforeach
            <li class="menu-title text-xs"><span>Program</span></li>
            <li><a href="{{ ($isHome ?? false) ? '#aksi-cepat' : url('/#aksi-cepat') }}" class="text-emerald-700" @click="mobileOpen = false">Program Donasi</a></li>
            <li><a href="{{ ($isHome ?? false) ? '#program-ota' : url('/#program-ota') }}" class="text-emerald-700" @click="mobileOpen = false">Orang Tua Asuh</a></li>
            <li><a href="{{ route('news.index') }}" class="text-emerald-700" @click="mobileOpen = false">Berita</a></li>
            <li class="menu-divider"></li>
            <li><a href="{{ route('register') }}" class="font-bold text-emerald-700" @click="mobileOpen = false">Daftar Donatur</a></li>
            <li><a href="{{ route('login') }}" class="font-bold text-emerald-700" @click="mobileOpen = false">Masuk</a></li>
        </ul>
    </div>
</nav>

{{-- SCROLL EFFECT --}}
@if(isset($scrollEffect) && $scrollEffect)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var nav = document.getElementById('navbar');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 15) {
                nav.classList.add('shadow-md', 'border-b', 'border-emerald-100');
            } else {
                nav.classList.remove('shadow-md', 'border-b', 'border-emerald-100');
            }
        });
    });
</script>
@endif
