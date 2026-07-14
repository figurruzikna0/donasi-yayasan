<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="baitul">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $profil?->nama_yayasan ?? 'Yayasan Baitul Yatim Sukabumi' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-base-200">
            @include('layouts.navigation')

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

            @isset($header)
                <header class="bg-base-100 shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
