<x-app-layout>
    <div x-data="{ open: false, img: '' }">
        <div x-show="open" x-cloak class="fixed inset-0 z-[999] bg-black/90 backdrop-blur-sm flex items-center justify-center p-4" @click.self="open = false">
            <div class="relative max-w-5xl w-full max-h-[90vh] flex items-center justify-center">
                <button @click="open = false" class="absolute -top-12 right-0 text-white/50 hover:text-white text-sm font-semibold flex items-center gap-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>Tutup
                </button>
                <img :src="img" class="max-h-[85vh] w-auto object-contain rounded-xl shadow-2xl" @click="open = false">
            </div>
        </div>

        <div class="bg-gradient-to-r from-primary via-primary to-secondary text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-3 py-1 rounded-full bg-white/10 inline-block mb-3">Transparansi</span>
                <h1 class="text-2xl sm:text-3xl font-black">Legalitas & Struktur Organisasi</h1>
                <p class="text-primary-content/70 text-sm mt-1">Dokumen resmi legalitas hukum dan struktur kepengurusan yayasan.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="card bg-base-100 shadow-md border border-base-200 rounded-2xl p-6 lg:p-8">
                    <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-sm">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </span>
                        Dokumen Legalitas
                    </h3>
                    @if($profil)
                        @if($profil->legalitas)
                            <p class="text-sm text-base-content/60 mb-4 leading-relaxed">{{ $profil->legalitas }}</p>
                        @endif
                        @if($profil->foto_legalitas)
                            <div @click="open = true; img = '{{ asset('storage/' . $profil->foto_legalitas) . '?v=' . now()->timestamp }}'" class="cursor-pointer group">
                                <div class="relative overflow-hidden rounded-xl border border-base-200">
                                    <img src="{{ asset('storage/' . $profil->foto_legalitas) . '?v=' . now()->timestamp }}" class="w-full h-auto max-h-[400px] object-contain bg-base-100 transition-transform duration-500 group-hover:scale-105" alt="Dokumen Legalitas">
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors flex items-center justify-center">
                                        <span class="opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 text-base-content text-xs font-bold px-4 py-2 rounded-full shadow-lg">Klik untuk memperbesar</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="py-14 text-center text-sm text-base-content/30 border-2 border-dashed border-base-300 rounded-xl bg-base-200/50">Dokumen legalitas belum diupload.</div>
                        @endif
                    @endif
                </div>

                <div class="card bg-base-100 shadow-md border border-base-200 rounded-2xl p-6 lg:p-8">
                    <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-sm">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                            </span>
                        Struktur Organisasi
                    </h3>
                    @if($profil?->foto_struktur)
                        <div @click="open = true; img = '{{ asset('storage/' . $profil->foto_struktur) . '?v=' . now()->timestamp }}'" class="cursor-pointer group">
                            <div class="relative overflow-hidden rounded-xl border border-base-200">
                                <img src="{{ asset('storage/' . $profil->foto_struktur) . '?v=' . now()->timestamp }}" class="w-full h-auto max-h-[400px] object-contain bg-base-100 transition-transform duration-500 group-hover:scale-105" alt="Struktur Organisasi">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors flex items-center justify-center">
                                    <span class="opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 text-base-content text-xs font-bold px-4 py-2 rounded-full shadow-lg">Klik untuk memperbesar</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="py-14 text-center text-sm text-base-content/30 border-2 border-dashed border-base-300 rounded-xl bg-base-200/50">Bagan struktur organisasi belum diupload.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
