{{-- PARTIALS_PUBLIC_NAVBAR: navigasi utama publik -- logo yayasan, menu desktop & mobile (Beranda, Tentang Kami, Donasi, OTA, Berita), tombol Daftar/Masuk --}}
<nav id="navbar" class="navbar bg-base-100/90 backdrop-blur-lg sticky top-0 z-50 shadow-sm{{ isset($scrollEffect) && $scrollEffect ? ' transition-all duration-300' : '' }}">
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

    {{-- BAGIAN: konfigurasi link dropdown Tentang Kami -- toggle antara route name (internal) atau anchor # (homepage) --}}
    @php
        $useRouteLinks = $useRouteLinks ?? true;
        $tentangLinks = $useRouteLinks
            ? [['route' => route('profil'), 'label' => 'Profil Yayasan'], ['route' => route('pengurus'), 'label' => 'Pengurus'], ['route' => route('legalitas'), 'label' => 'Legalitas & Struktur']]
            : [['route' => url('/#tentang-kami'), 'label' => 'Profil Yayasan'], ['route' => url('/#pendiri'), 'label' => 'Pengurus'], ['route' => url('/#legalitas'), 'label' => 'Legalitas & Struktur']];
    @endphp

    {{-- BAGIAN: menu navigasi utama versi desktop --}}
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal gap-1">
            <li><a href="{{ ($isHome ?? false) ? '#' : url('/') }}" class="font-bold text-emerald-700">Beranda</a></li>
            <li class="dropdown dropdown-hover">
                <a tabindex="0" class="font-bold text-emerald-700">
                    Tentang Kami
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </a>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-xl min-w-[200px] z-[100] border border-emerald-200">
                    @foreach($tentangLinks as $link)
                    <li><a href="{{ $link['route'] }}" class="font-bold text-emerald-700">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ ($isHome ?? false) ? '#kampanye' : url('/#kampanye') }}" class="font-bold text-emerald-700">Program Donasi</a></li>
            <li><a href="{{ ($isHome ?? false) ? '#program-ota' : url('/#program-ota') }}" class="font-bold text-emerald-700">Orang Tua Asuh</a></li>
            <li><a href="{{ ($isHome ?? false) ? '#berita-kegiatan' : url('/#berita-kegiatan') }}" class="font-bold text-emerald-700">Berita</a></li>
        </ul>
    </div>

    {{-- BAGIAN: tombol aksi Daftar / Masuk (desktop) dan tombol hamburger (mobile) --}}
    <div class="navbar-end gap-2">
        <a href="{{ route('register') }}" class="btn btn-outline btn-success btn-sm font-bold hidden sm:inline-flex">Daftar</a>
        <a href="{{ route('login') }}" class="btn btn-success btn-sm font-bold text-white hidden sm:inline-flex">Masuk</a>
        <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="btn btn-ghost btn-square lg:hidden">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- BAGIAN: menu navigasi mobile (hidden default, toggle via tombol hamburger) --}}
    <div id="mobile-menu" class="hidden absolute top-full left-0 right-0 bg-base-100 border-t border-emerald-100 shadow-lg lg:hidden">
        <ul class="menu menu-md p-4">
            <li><a href="{{ ($isHome ?? false) ? '#' : url('/') }}" class="font-bold text-emerald-800">Beranda</a></li>
            <li class="menu-title text-xs"><span>Tentang</span></li>
            @foreach($tentangLinks as $link)
            <li><a href="{{ $link['route'] }}" class="text-emerald-700">{{ $link['label'] }}</a></li>
            @endforeach
            <li class="menu-title text-xs"><span>Program</span></li>
            <li><a href="{{ ($isHome ?? false) ? '#kampanye' : url('/#kampanye') }}" class="text-emerald-700">Program Donasi</a></li>
            <li><a href="{{ ($isHome ?? false) ? '#program-ota' : url('/#program-ota') }}" class="text-emerald-700">Orang Tua Asuh</a></li>
            <li><a href="{{ ($isHome ?? false) ? '#berita-kegiatan' : url('/#berita-kegiatan') }}" class="text-emerald-700">Berita</a></li>
            <li class="menu-divider"></li>
            <li><a href="{{ route('register') }}" class="font-bold text-emerald-700">Daftar Donatur</a></li>
            <li><a href="{{ route('login') }}" class="font-bold text-emerald-700">Masuk</a></li>
        </ul>
    </div>
</nav>

{{-- BAGIAN: script untuk menambah shadow & border navbar saat scroll (hanya jika $scrollEffect aktif) --}}
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
