<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="baitul">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akses Ditolak — {{ $profil?->nama_yayasan ?? 'Yayasan Baitul Yatim Sukabumi' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center relative overflow-hidden bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-900 px-4">

        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl"></div>
            <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] rounded-full bg-teal-400/10 blur-3xl"></div>
            <div class="absolute top-1/3 left-1/4 w-64 h-64 rounded-full bg-white/5 blur-2xl"></div>
            <svg class="absolute inset-0 w-full h-full opacity-[0.04]" viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg">
                <defs><pattern id="dots" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1.5" fill="white"/></pattern></defs>
                <rect width="800" height="800" fill="url(#dots)"/>
            </svg>
        </div>

        <div class="relative z-10 text-center max-w-md">
            <div class="mb-8">
                <span class="text-8xl font-black text-emerald-300/30 select-none">403</span>
            </div>

            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center ring-1 ring-white/20">
                <svg class="w-10 h-10 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
            </div>

            <h1 class="text-3xl font-black text-white mb-3">Akses Ditolak</h1>
            <p class="text-emerald-200/70 text-sm leading-relaxed mb-8">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator jika ini sebuah kesalahan.</p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="/" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-emerald-950 bg-emerald-400 hover:bg-emerald-300 transition-all duration-200 shadow-lg shadow-emerald-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955a1.126 1.126 0 011.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-emerald-200 border border-emerald-700/50 hover:bg-emerald-800/30 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Login
                </a>
            </div>
        </div>

        <p class="relative z-10 mt-12 text-xs text-white/30 font-semibold tracking-wider">&copy; {{ date('Y') }} {{ $profil?->nama_yayasan ?? 'Yayasan Baitul Yatim Sukabumi' }}.</p>
    </div>
</body>
</html>
