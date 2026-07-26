<!DOCTYPE html>
<html lang="id" data-theme="baitul">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legalitas & Struktur - {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    @include('partials.public-navbar')

    <x-breadcrumb :items="['Profil Yayasan' => route('profil'), 'Legalitas' => '']" />

    <div x-data="{ open: false, img: '' }">
        <div x-show="open" x-cloak class="fixed inset-0 z-[999] bg-black/90 backdrop-blur-sm flex items-center justify-center p-4" @click.self="open = false">
            <div class="relative max-w-5xl w-full max-h-[90vh] flex items-center justify-center">
                <button @click="open = false" class="absolute -top-12 right-0 text-white/50 hover:text-white text-sm font-semibold flex items-center gap-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    Tutup
                </button>
                <img :src="img" class="max-h-[85vh] w-auto object-contain rounded-xl shadow-2xl" @click="open = false">
            </div>
        </div>

        <section class="relative py-20 lg:py-28 px-4 bg-gradient-to-b from-base-200 to-base-300/50 overflow-hidden">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-20 left-1/4 w-72 h-72 rounded-full bg-primary/5 blur-3xl"></div>
                <div class="absolute bottom-20 right-1/4 w-96 h-96 rounded-full bg-secondary/5 blur-3xl"></div>
            </div>

            <div class="max-w-7xl mx-auto relative">
                <div class="text-center max-w-2xl mx-auto mb-14">
                    <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-primary/10 text-primary inline-block mb-4">Transparansi</span>
                    <h2 class="text-3xl md:text-4xl font-black text-base-content tracking-tight">Legalitas & Struktur Organisasi</h2>
                    <p class="text-base-content/60 mt-3 text-sm leading-relaxed">Dokumen resmi legalitas hukum dan struktur kepengurusan yayasan.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="group card bg-base-100/80 backdrop-blur-sm shadow-lg hover:shadow-xl border border-base-200 hover:border-primary/20 rounded-2xl p-6 lg:p-8 transition-all duration-300">
                        <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2.5">
                            <span class="w-9 h-9 bg-primary/10 rounded-xl flex items-center justify-center text-sm border border-primary/10 group-hover:bg-primary/20 transition-colors">📑</span>
                            Dokumen Legalitas
                        </h3>
                        @if($profil)
                            @if($profil->legalitas)
                                <p class="text-sm text-base-content/60 mb-5 leading-relaxed">{{ $profil->legalitas }}</p>
                            @endif
                            @if($profil->foto_legalitas)
                                <div @click="open = true; img = '{{ asset('storage/' . $profil->foto_legalitas) . '?v=' . now()->timestamp }}'" class="cursor-pointer group/image">
                                    <div class="relative overflow-hidden rounded-xl border border-base-200 shadow-sm">
                                        <img src="{{ asset('storage/' . $profil->foto_legalitas) . '?v=' . now()->timestamp }}" class="w-full h-auto max-h-[400px] object-contain bg-base-100 transition-transform duration-500 group-hover/image:scale-105" alt="Dokumen Legalitas">
                                        <div class="absolute inset-0 bg-black/0 group-hover/image:bg-black/10 transition-colors duration-300 flex items-center justify-center">
                                            <span class="opacity-0 group-hover/image:opacity-100 transition-opacity duration-300 bg-white/90 text-base-content text-xs font-bold px-4 py-2 rounded-full shadow-lg backdrop-blur-sm">Klik untuk memperbesar</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="py-16 text-center text-sm text-base-content/30 border-2 border-dashed border-base-300 rounded-xl bg-base-200/50">Dokumen legalitas belum diupload.</div>
                            @endif
                        @endif
                    </div>

                    <div class="group card bg-base-100/80 backdrop-blur-sm shadow-lg hover:shadow-xl border border-base-200 hover:border-primary/20 rounded-2xl p-6 lg:p-8 transition-all duration-300">
                        <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2.5">
                            <span class="w-9 h-9 bg-primary/10 rounded-xl flex items-center justify-center text-sm border border-primary/10 group-hover:bg-primary/20 transition-colors">📊</span>
                            Struktur Organisasi
                        </h3>
                        @if($profil?->foto_struktur)
                            <div @click="open = true; img = '{{ asset('storage/' . $profil->foto_struktur) . '?v=' . now()->timestamp }}'" class="cursor-pointer group/image">
                                <div class="relative overflow-hidden rounded-xl border border-base-200 shadow-sm">
                                    <img src="{{ asset('storage/' . $profil->foto_struktur) . '?v=' . now()->timestamp }}" class="w-full h-auto max-h-[400px] object-contain bg-base-100 transition-transform duration-500 group-hover/image:scale-105" alt="Struktur Organisasi">
                                    <div class="absolute inset-0 bg-black/0 group-hover/image:bg-black/10 transition-colors duration-300 flex items-center justify-center">
                                        <span class="opacity-0 group-hover/image:opacity-100 transition-opacity duration-300 bg-white/90 text-base-content text-xs font-bold px-4 py-2 rounded-full shadow-lg backdrop-blur-sm">Klik untuk memperbesar</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="py-16 text-center text-sm text-base-content/30 border-2 border-dashed border-base-300 rounded-xl bg-base-200/50">Bagan struktur organisasi belum diupload.</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('partials.footer')
</body>
</html>
