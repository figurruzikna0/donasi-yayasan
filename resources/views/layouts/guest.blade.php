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
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-900">

            {{-- Decorative ornaments --}}
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl"></div>
                <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] rounded-full bg-teal-400/10 blur-3xl"></div>
                <div class="absolute top-1/3 left-1/4 w-64 h-64 rounded-full bg-white/5 blur-2xl"></div>

                {{-- Geometric pattern overlay --}}
                <svg class="absolute inset-0 w-full h-full opacity-[0.04]" viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="dots" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                            <circle cx="20" cy="20" r="1.5" fill="white"/>
                        </pattern>
                    </defs>
                    <rect width="800" height="800" fill="url(#dots)"/>
                </svg>

                {{-- Decorative lines --}}
                <div class="absolute top-0 left-0 w-px h-full bg-gradient-to-b from-transparent via-emerald-400/20 to-transparent"></div>
                <div class="absolute top-0 right-0 w-px h-full bg-gradient-to-b from-transparent via-emerald-400/20 to-transparent"></div>
            </div>

            {{-- Logo & Brand --}}
            <div class="relative z-10">
                <a href="/" class="flex flex-col items-center gap-3">
                    @php $logoProfil = $profil; @endphp
                    @if($logoProfil?->logo)
                        <div class="p-2.5 bg-white/95 rounded-2xl shadow-lg ring-1 ring-white/20 backdrop-blur-sm">
                            <img src="{{ asset('storage/' . $logoProfil->logo) . '?v=' . now()->timestamp }}" class="h-14 w-14 rounded-xl object-cover" alt="Logo">
                        </div>
                    @else
                        <span class="text-4xl bg-white/95 p-3 rounded-2xl shadow-lg ring-1 ring-white/20">🌿</span>
                    @endif
                    <span class="text-sm font-bold text-white/90 tracking-wide">{{ $logoProfil?->nama_yayasan ?? 'Yayasan Baitul Yatim' }}</span>
                </a>
            </div>

            {{-- Card --}}
            <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-5 bg-white/95 backdrop-blur-md shadow-2xl overflow-hidden sm:rounded-2xl ring-1 ring-white/20">
                {{ $slot }}
            </div>

            {{-- Footer text --}}
            <p class="relative z-10 mt-6 text-xs text-white/40 font-semibold tracking-wider">© {{ date('Y') }} {{ $logoProfil?->nama_yayasan ?? 'Yayasan Baitul Yatim' }}. All rights reserved.</p>
        </div>
    </body>
</html>
