<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="baitul">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $profil?->nama_yayasan ?? 'Yayasan Baitul Yatim Sukabumi' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="font-sans antialiased">
        <div class="flex bg-base-200 min-h-screen">
            @php $adminUser = Auth::user(); @endphp

            {{-- ══ GLOBAL TOAST NOTIFICATIONS ══ --}}
            <div class="fixed top-4 right-4 z-[100] flex flex-col gap-2 max-w-sm w-full pointer-events-none">
                <div class="pointer-events-auto space-y-2">
                    @if(session('success'))
                        <x-alert type="success" message="{{ session('success') }}" />
                    @endif
                    @if(session('error'))
                        <x-alert type="error" message="{{ session('error') }}" />
                    @endif
                    @if(session('warning'))
                        <x-alert type="warning" message="{{ session('warning') }}" />
                    @endif
                    @if(session('info'))
                        <x-alert type="info" message="{{ session('info') }}" />
                    @endif
                    @if(session('status'))
                        <x-alert type="success" message="{{ session('status') }}" title="Informasi" />
                    @endif
                </div>
            </div>

        {{-- ══ SIDEBAR BACKDROP (mobile only) ══ --}}
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden transition-opacity duration-300" onclick="closeSidebar()"></div>

        {{-- ══ SIDEBAR ══ --}}
        <aside id="admin-sidebar"
               class="w-60 shrink-0 bg-primary flex flex-col h-screen overflow-y-auto
                      sticky top-0
                      max-lg:fixed max-lg:left-0 max-lg:top-0 max-lg:z-40">
            <div class="px-8 py-9 border-b border-white/10">
                <button onclick="closeSidebar()" class="lg:hidden float-right text-white/50 hover:text-white mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    @if($profil && $profil->logo)
                        <img src="{{ asset('storage/' . $profil->logo) . '?v=' . now()->timestamp }}" alt="Logo" class="h-9 w-9 rounded-lg object-cover ring-2 ring-white/30">
                    @else
                        <div class="h-9 w-9 rounded-lg bg-brand-500 flex items-center justify-center text-white font-black text-base">BY</div>
                    @endif
                    <div>
                        <div class="text-base font-black text-white tracking-tight leading-tight">Baitul<span class="text-brand-300">Yatim</span></div>
                        <div class="text-[0.65rem] text-white/45 font-semibold uppercase tracking-widest mt-0.5">Panel Administrasi</div>
                    </div>
                </a>
            </div>

            <div class="px-4 pt-6 pb-1">
                <div class="text-[0.62rem] font-extrabold uppercase tracking-widest text-white/38 px-2 mb-1.5">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white transition-all duration-150 relative mb-0.5 {{ request()->routeIs('admin.dashboard') ? 'bg-white/13 before:absolute before:left-0 before:top-[22%] before:bottom-[22%] before:w-[3px] before:bg-brand-300 before:rounded-r-sm' : 'text-white/62 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>
            </div>

            <div class="px-4 pt-5 pb-1">
                <div class="text-[0.62rem] font-extrabold uppercase tracking-widest text-white/38 px-2 mb-1">Konten</div>
                <a href="{{ route('admin.profil.index') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Profil Yayasan
                </a>
                <a href="{{ route('admin.news.index') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"/></svg>
                    Berita Kegiatan
                </a>
                <a href="{{ route('admin.campaigns.index') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Kelola Kampanye
                </a>
                <a href="{{ route('admin.users.index') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Kelola User
                </a>
            </div>

            <div class="px-4 pt-5 pb-1">
                <div class="text-[0.62rem] font-extrabold uppercase tracking-widest text-white/38 px-2 mb-1">Program</div>
                <a href="{{ route('admin.foster-children.index') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Data Anak Asuh
                </a>
                <a href="{{ route('admin.sponsorships.index') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Orang Tua Asuh
                </a>
                <a href="{{ route('admin.child-developments.index') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                    Isi Perkembangan Anak
                </a>
                <a href="{{ route('admin.transactions.index') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Riwayat Transaksi
                    @php
                        $pendingCount = \App\Models\Donation::where('status','pending')->count()
                                      + \App\Models\Sponsorship::where('status','pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="ml-auto bg-brand-300 text-brand-800 text-[0.6rem] font-extrabold px-1.5 py-0.5 rounded-full">{{ $pendingCount }}</span>
                    @endif
                </a>
            </div>

            <div class="px-4 pt-5 pb-1">
                <div class="text-[0.62rem] font-extrabold uppercase tracking-widest text-white/38 px-2 mb-1">Rekap Data</div>
                <a href="{{ route('admin.rekap.donasi') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Data Donasi
                </a>
                <a href="{{ route('admin.rekap.donatur') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Data Donatur
                </a>
                <a href="{{ route('admin.rekap.orang-tua-asuh') }}" onclick="closeSidebar()" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Data Orang Tua Asuh
                </a>
            </div>

            <div class="mt-auto px-4 py-4 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-bold text-white/50 hover:bg-white/10 hover:text-white transition-all duration-150 cursor-pointer w-full bg-transparent border-none" onclick="closeSidebar()">
                        <svg class="w-[15px] h-[15px] opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- ══ MAIN CONTENT ══ --}}
        <main class="flex-1 overflow-x-hidden min-w-0 flex flex-col">

            {{-- ══ TOP NAVBAR ══ --}}
            <header class="bg-base-100 border-b border-base-200 sticky top-0 z-40">
                <div class="px-6 lg:px-8 h-16 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <button id="sidebar-toggle" class="btn btn-ghost btn-square lg:hidden" onclick="toggleSidebar()">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <div class="flex items-center gap-3">
                            @if($profil && $profil->logo)
                                <img src="{{ asset('storage/' . $profil->logo) . '?v=' . now()->timestamp }}" alt="Logo" class="h-8 w-8 rounded-lg object-cover ring-2 ring-base-200 lg:hidden">
                            @endif
                            <div id="page-title-area">
                                <h1 id="page-title-text" class="text-lg font-black text-base-content truncate max-w-[200px] sm:max-w-none">
                                    @yield('page_title', 'Dashboard')
                                </h1>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex items-center gap-1.5 px-3 py-1.5 bg-base-200 rounded-lg border border-base-300">
                            <svg class="w-3.5 h-3.5 text-base-content/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span id="topbar-date" class="text-xs font-bold text-base-content/50">—</span>
                        </div>

                        <div class="dropdown dropdown-end">
                            <button tabindex="0" class="flex items-center gap-2.5 px-3 py-2 rounded-lg hover:bg-base-200 transition-colors">
                                @if($adminUser->avatar)
                                    <img src="{{ asset('storage/' . $adminUser->avatar) }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-base-300">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-primary/10 text-primary font-extrabold text-sm flex items-center justify-center ring-2 ring-base-300">
                                        {{ strtoupper(substr($adminUser->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="text-sm font-bold text-base-content hidden sm:inline">{{ $adminUser->name }}</span>
                                <svg class="w-3.5 h-3.5 text-base-content/30 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-56 p-2 shadow-lg border border-base-200">
                                <li class="menu-title text-xs"><span>Akun</span></li>
                                <li><a href="{{ route('profile.edit') }}" class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Edit Profil
                                </a></li>
                                <li class="menu-title text-xs mt-2"><span>Sesi</span></li>
                                <li>
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
                </div>
            </header>

            {{-- ══ PAGE CONTENT ══ --}}
            {{ $slot }}
        </main>
    </div>

    <script>
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    function isMobile() {
        return window.innerWidth < 1024;
    }

    function setSidebarOpen(open) {
        if (!isMobile()) return;
        if (open) {
            sidebar.style.transform = 'translateX(0)';
            sidebar.style.transition = 'transform 0.3s ease';
            overlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            sidebar.style.transform = 'translateX(-100%)';
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }

    function toggleSidebar() {
        if (!isMobile()) return;
        const isOpen = sidebar.style.transform === 'translateX(0px)';
        setSidebarOpen(!isOpen);
    }

    function closeSidebar() {
        setSidebarOpen(false);
    }

    function handleResize() {
        if (isMobile()) {
            sidebar.style.transform = sidebar.style.transform || 'translateX(-100%)';
            sidebar.style.transition = 'transform 0.3s ease';
        } else {
            sidebar.style.transform = '';
            sidebar.style.transition = '';
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        handleResize();
        const now = new Date();
        const opts = { weekday:'long', day:'numeric', month:'long', year:'numeric' };
        const el = document.getElementById('topbar-date');
        if (el) el.textContent = now.toLocaleDateString('id-ID', opts);
    });

    window.addEventListener('resize', handleResize);
    </script>
</body>
</html>