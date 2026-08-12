<!-- ============================================ -->
<!-- layouts/app.blade.php - LAYOUT UTAMA USER   -->
<!-- ============================================ -->
<!-- Peran: layout utama untuk semua halaman donatur yang sudah login (dashboard, rekap, profil, pengurus, legalitas, dll), dipakai lewat komponen x-app-layout. -->
<!-- Data: $profil (nama yayasan & logo) dari view composer global; $slot berisi konten halaman child; $header opsional untuk judul halaman. -->
<!-- Alur: render DOCTYPE + head (CSRF, font, Vite), navbar (layouts.navigation), notifikasi toast session & client-side (Alpine.js), header opsional, lalu konten $slot ke dalam <main>. -->
{{-- LAYOUTS_APP: layout utama untuk halaman user setelah login -- menyertakan navbar, notifikasi, header opsional, dan konten utama --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="baitul">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Token CSRF disuntikkan ke meta untuk dipakai fetch/axios pada permintaan POST ajax -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $profil?->nama_yayasan ?? 'Yayasan Baitul Yatim Sukabumi' }}</title>
        <link rel="icon" href="{{ $profil?->logo ? asset('storage/' . $profil->logo) : '/favicon.ico' }}">

        {{-- FONT: Google Font Figtree dari bunny.net --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- ASSET: CSS & JS via Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Muat ulang halaman saat kembali lewat cache bfcache agar data selalu segar -->
        <script>window.addEventListener('pageshow',function(e){if(e.persisted)location.reload()});</script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-base-200">
            <!-- Navbar utama donatur (partial layouts.navigation); hanya tampil untuk user non-admin -->
            @include('layouts.navigation')

            {{-- ══ GLOBAL TOAST NOTIFICATIONS ══ --}}
            <!-- Notifikasi global dari session: menampilkan komponen x-alert sesuai flash data success/error/warning/info/status -->
            <div class="fixed top-2 left-1/2 -translate-x-1/2 z-[9999] flex flex-col gap-3 max-w-lg w-full px-4 pointer-events-none">
                <div class="pointer-events-auto space-y-3">
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

            {{-- ══ CLIENT-SIDE TOAST (dipicu oleh JavaScript, bukan session) ══ --}}
            <!-- Toast sisi klien: mendengarkan event kustom 'toast-show' lewat Alpine.js, menampilkan pesan + progress bar yang menyusut selama 5 detik -->
            <div x-data="{ toast: { show: false, message: '', type: 'warning', progress: 100 } }"
                 @toast-show.window="
                    toast.message = $event.detail.message;
                    toast.type = $event.detail.type || 'warning';
                    toast.progress = 100;
                    toast.show = true;
                    setTimeout(() => { toast.show = false; }, 5000);
                    let start = Date.now();
                    let id = setInterval(() => {
                        let elapsed = Date.now() - start;
                        toast.progress = Math.max(0, 100 - (elapsed / 5000) * 100);
                        if (elapsed >= 5000) clearInterval(id);
                    }, 50);
                 "
                 x-cloak
                 x-show="toast.show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-250"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-y-3 scale-95"
                 class="fixed top-20 left-1/2 -translate-x-1/2 z-[9999] w-full max-w-md px-4 pointer-events-none">
                <div class="pointer-events-auto relative w-full bg-amber-50 dark:bg-amber-950/60 border-2 border-amber-200 dark:border-amber-800 shadow-lg shadow-amber-500/20 dark:shadow-amber-900/40 rounded-2xl overflow-hidden backdrop-blur-sm">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-amber-500"></div>
                    <div class="relative pl-6 pr-4 py-4">
                        <div class="flex items-start gap-3.5">
                            <div class="w-11 h-11 rounded-xl bg-amber-100 dark:bg-amber-900/60 flex items-center justify-center flex-shrink-0 text-amber-600 dark:text-amber-300 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                            </div>
                            <div class="flex-1 min-w-0 pt-0.5">
                                <div class="flex items-center gap-2">
                                    <p class="font-bold text-sm text-amber-900 dark:text-amber-100">Perhatian</p>
                                </div>
                                <p class="text-xs text-amber-700 dark:text-amber-300 mt-0.5 leading-relaxed" x-text="toast.message"></p>
                            </div>
                            <!-- Tombol tutup toast -->
                            <button @click="toast.show = false" class="flex-shrink-0 w-7 h-7 rounded-lg hover:bg-black/5 dark:hover:bg-white/10 flex items-center justify-center text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition-all duration-200 -mr-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>
                    <!-- Progress bar bawah: lebarnya mengikuti nilai toast.progress yang menyusut otomatis -->
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/5 dark:bg-white/5">
                        <div class="h-full rounded-full bg-amber-500 transition-all duration-[200ms] ease-linear"
                             :style="'width: ' + toast.progress + '%'">
                        </div>
                    </div>
                </div>
            </div>

            {{-- BAGIAN: header halaman opsional (hanya muncul jika child view mendefinisikan $header) --}}
            <!-- isset: jika child view mengirim blok $header, tampilkan sebagai header halaman berpita putih -->
            @isset($header)
                <header class="bg-base-100 shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- BAGIAN: konten utama halaman dari child view --}}
            <!-- Slot utama: seluruh isi halaman child view dirender di dalam <main> -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>