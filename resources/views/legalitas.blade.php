<!-- ============================================ -->
<!-- legalitas.blade.php - HALAMAN LEGALITAS PUBLIK -->
<!-- ============================================ -->
<!-- Peran: halaman publik yang menampilkan dokumen legalitas hukum dan bagan struktur organisasi yayasan dari database. -->
<!-- Data berasal dari variabel $profil (model ProfilYayasan) via view composer global, diakses dari route 'legalitas'. -->
<!-- Alur: navbar publik, breadcrumb, modal lightbox gambar (Alpine.js), seksi legalitas & struktur dengan fitur klik-untuk-perbesar, lalu footer. -->
<!DOCTYPE html>
<html lang="id" data-theme="baitul">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legalitas & Struktur - {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    <!-- Navbar publik (partial) -->
    @include('partials.public-navbar')

    <!-- Komponen breadcrumb: Beranda > Profil Yayasan > Legalitas -->
    <x-breadcrumb :items="['Profil Yayasan' => route('profil'), 'Legalitas' => '']" />

    <!-- State Alpine.js: 'open' untuk membuka/menutup modal lightbox dan 'img' untuk menyimpan URL gambar yang diperbesar -->
    <div x-data="{ open: false, img: '' }">
        <!-- Modal lightbox: menampilkan gambar dokumen/struktur secara fullscreen ketika variabel 'open' bernilai true; klik di luar atau tombol Tutup untuk menutupnya -->
        <div x-show="open" x-cloak class="fixed inset-0 z-[999] bg-black/90 backdrop-blur-sm flex items-center justify-center p-4" @click.self="open = false">
            <div class="relative max-w-5xl w-full max-h-[90vh] flex items-center justify-center">
                <button @click="open = false" class="absolute -top-12 right-0 text-white/50 hover:text-white text-sm font-semibold flex items-center gap-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    Tutup
                </button>
                <!-- Atribut :src Alpine mengisi sumber gambar sesuai nilai variabel 'img' -->
                <img :src="img" class="max-h-[85vh] w-auto object-contain rounded-xl shadow-2xl" @click="open = false">
            </div>
        </div>

        <!-- Seksi utama: header gradasi lalu grid dua kolom (Dokumen Legalitas dan Struktur Organisasi) -->
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
                    <!-- Kartu 1: Dokumen Legalitas -->
                    <div class="group card bg-base-100/80 backdrop-blur-sm shadow-lg hover:shadow-xl border border-base-200 hover:border-primary/20 rounded-2xl p-6 lg:p-8 transition-all duration-300">
                        <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2.5">
                            <span class="w-9 h-9 bg-primary/10 rounded-xl flex items-center justify-center text-sm border border-primary/10 group-hover:bg-primary/20 transition-colors">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </span>
                            Dokumen Legalitas
                        </h3>
                        <!-- Kondisi if berlapis: hanya render jika data $profil ada, lalu tampilkan teks legalitas (jika ada) dan foto dokumen legalitas (jika ada) -->
                        @if($profil)
                            @if($profil->legalitas)
                                <p class="text-sm text-base-content/60 mb-5 leading-relaxed">{{ $profil->legalitas }}</p>
                            @endif
                            @if($profil->foto_legalitas)
                                <!-- Gambar dokumen legalitas: diklik untuk membuka lightbox; URL memakai query '?v=timestamp' agar cache browser selalu diperbarui -->
                                <div @click="open = true; img = '{{ asset('storage/' . $profil->foto_legalitas) . '?v=' . now()->timestamp }}'" class="cursor-pointer group/image">
                                    <div class="relative overflow-hidden rounded-xl border border-base-200 shadow-sm">
                                        <img src="{{ asset('storage/' . $profil->foto_legalitas) . '?v=' . now()->timestamp }}" class="w-full h-auto max-h-[400px] object-contain bg-base-100 transition-transform duration-500 group-hover/image:scale-105" alt="Dokumen Legalitas">
                                        <div class="absolute inset-0 bg-black/0 group-hover/image:bg-black/10 transition-colors duration-300 flex items-center justify-center">
                                            <span class="opacity-0 group-hover/image:opacity-100 transition-opacity duration-300 bg-white/90 text-base-content text-xs font-bold px-4 py-2 rounded-full shadow-lg backdrop-blur-sm">Klik untuk memperbesar</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Blok else: pesan ketika dokumen legalitas belum diunggah -->
                                <div class="py-16 text-center text-sm text-base-content/30 border-2 border-dashed border-base-300 rounded-xl bg-base-200/50">Dokumen legalitas belum diupload.</div>
                            @endif
                        @endif
                    </div>

                    <!-- Kartu 2: Struktur Organisasi -->
                    <div class="group card bg-base-100/80 backdrop-blur-sm shadow-lg hover:shadow-xl border border-base-200 hover:border-primary/20 rounded-2xl p-6 lg:p-8 transition-all duration-300">
                        <h3 class="text-base font-bold text-base-content mb-4 flex items-center gap-2.5">
                            <span class="w-9 h-9 bg-primary/10 rounded-xl flex items-center justify-center text-sm border border-primary/10 group-hover:bg-primary/20 transition-colors">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                            </span>
                            Struktur Organisasi
                        </h3>
                        <!-- Kondisi if: tampilkan bagan struktur organisasi jika $profil->foto_struktur ada; klik membuka lightbox -->
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
                            <!-- Blok else: pesan ketika bagan struktur organisasi belum diunggah -->
                            <div class="py-16 text-center text-sm text-base-content/30 border-2 border-dashed border-base-300 rounded-xl bg-base-200/50">Bagan struktur organisasi belum diupload.</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer publik (partial) -->
    @include('partials.footer')
</body>
</html>
