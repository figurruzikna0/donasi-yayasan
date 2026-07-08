<!DOCTYPE html>
<html lang="id" data-theme="baitul">
<head>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legalitas & Struktur - {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans antialiased">

    {{-- NAVBAR --}}
    @include('partials.public-navbar')

    {{-- LIGHTBOX --}}
    <div x-data="{ open: false, img: '' }">
        <div x-show="open" x-cloak class="fixed inset-0 z-[999] bg-black/80 flex items-center justify-center p-4" @click.self="open = false">
            <div class="relative max-w-5xl w-full max-h-[90vh] flex items-center justify-center">
                <button @click="open = false" class="absolute -top-10 right-0 text-white/70 hover:text-white text-sm font-semibold flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Tutup
                </button>
                <img :src="img" class="max-h-[85vh] w-auto object-contain rounded-lg shadow-2xl">
            </div>
        </div>

        {{-- LEGALITAS & STRUKTUR --}}
        <section class="py-20 lg:py-28 px-4 bg-base-200 min-h-screen">
            <div class="max-w-7xl mx-auto">
                <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-14">
                    <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-primary/10 text-primary inline-block mb-3">Transparansi</span>
                    <h2 class="text-3xl md:text-4xl font-black text-base-content tracking-tight">Legalitas & Struktur Organisasi</h2>
                    <p class="text-base-content/60 mt-2 text-sm">Dokumen resmi legalitas hukum dan struktur kepengurusan yayasan.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div data-aos="fade-right" class="card bg-base-100 shadow-md border border-base-300 rounded-2xl p-6 lg:p-8">
                        <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2">
                            <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-sm border border-base-300">📑</span>
                            Dokumen Legalitas
                        </h3>
                        @if($profil)
                            @if($profil->legalitas)
                                <p class="text-sm text-base-content/60 mb-4 leading-relaxed">{{ $profil->legalitas }}</p>
                            @endif
                            @if($profil->foto_legalitas)
                                <div @click="open = true; img = '{{ asset('storage/' . $profil->foto_legalitas) . '?v=' . now()->timestamp }}'" class="cursor-pointer">
                                    <img src="{{ asset('storage/' . $profil->foto_legalitas) . '?v=' . now()->timestamp }}" class="w-full h-auto max-h-[400px] object-contain rounded-lg border border-base-300 shadow-sm hover:opacity-90 transition-opacity" alt="Dokumen Legalitas">
                                    <p class="text-xs text-primary mt-2 text-center font-semibold">🔍 Klik untuk memperbesar</p>
                                </div>
                            @else
                                <div class="py-14 text-center text-sm text-base-content/40 border border-dashed rounded-xl">Dokumen legalitas belum diupload.</div>
                            @endif
                        @endif
                    </div>
                    <div data-aos="fade-left" class="card bg-base-100 shadow-md border border-base-300 rounded-2xl p-6 lg:p-8">
                        <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2">
                            <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-sm border border-base-300">📊</span>
                            Struktur Organisasi
                        </h3>
                        @if($profil?->foto_struktur)
                            <div @click="open = true; img = '{{ asset('storage/' . $profil->foto_struktur) . '?v=' . now()->timestamp }}'" class="cursor-pointer">
                                <img src="{{ asset('storage/' . $profil->foto_struktur) . '?v=' . now()->timestamp }}" class="w-full h-auto max-h-[400px] object-contain rounded-lg border border-base-300 shadow-sm hover:opacity-90 transition-opacity" alt="Struktur Organisasi">
                                <p class="text-xs text-primary mt-2 text-center font-semibold">🔍 Klik untuk memperbesar</p>
                            </div>
                        @else
                            <div class="py-14 text-center text-sm text-base-content/40 border border-dashed rounded-xl">Bagan struktur belum diupload.</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true, offset: 40 });</script>
</body>
</html>
