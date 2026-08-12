<!-- ============================================ -->
<!-- admin\child-developments\show.blade.php      -->
<!-- Halaman detail satu laporan perkembangan     -->
<!-- anak (modul Orang Tua Asuh); diinput admin    -->
<!-- Dipakai oleh Admin\ChildDevelopmentControllershow -->
<!-- Alur: menampilkan atribut $childDevelopment   -->
<!-- (judul, anak asuh, tanggal, penulis, foto,    -->
<!-- deskripsi, info sponsorship) plus lightbox    -->
<!-- foto memakai Alpine.js                        -->
<!-- ============================================ -->
<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

    <!-- Header halaman detail laporan -->
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.12),transparent_70%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,rgba(16,185,129,0.2),transparent_60%)]"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <div class="flex items-center gap-2.5 mb-1">
                        <span class="w-8 h-0.5 rounded-full bg-emerald-300/60"></span>
                        <span class="text-emerald-200/80 text-xs font-bold uppercase tracking-widest">Program</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Detail Perkembangan</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">{{ $childDevelopment->judul }}</p>
                </div>
                <div class="flex gap-2">
                    <!-- Tombol edit laporan -->
                    <a href="{{ route('admin.child-developments.edit', $childDevelopment) }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-amber-600 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <!-- Tombol kembali ke daftar laporan -->
                    <a href="{{ route('admin.child-developments.index') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-4 h-4"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12 space-y-6">

        <!-- Kartu utama detail laporan -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="px-8 py-6 space-y-6">

                <!-- Judul laporan -->
                <div>
                    <p class="text-xs uppercase tracking-wider text-base-content/40 font-bold">Judul Laporan</p>
                    <p class="text-lg font-bold text-emerald-700">{{ $childDevelopment->judul }}</p>
                </div>

                <!-- Grid info: Anak Asuh, Tanggal, Ditulis oleh -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                        <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Anak Asuh</p>
                        <div class="flex items-center gap-2 mt-1">
                            <!-- Avatar anak asuh: foto tersimpan atau placeholder ui-avatars -->
                            <div class="avatar">
                                <div class="w-8 rounded-full ring ring-emerald-200">
                                    @if($childDevelopment->fosterChild?->photo)
                                        <img src="{{ asset('storage/' . $childDevelopment->fosterChild->photo) }}" alt="">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($childDevelopment->fosterChild?->name ?? '?') }}&background=b3e093&color=5c8148&bold=true" alt="">
                                    @endif
                                </div>
                            </div>
                            <!-- Nama anak asuh terkait (relasi fosterChild) -->
                            <span class="font-bold text-emerald-700">{{ $childDevelopment->fosterChild?->name ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                        <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Tanggal</p>
                        <p class="font-bold text-emerald-700">{{ $childDevelopment->tanggal ? $childDevelopment->tanggal->format('d/m/Y') : '-' }}</p>
                    </div>
                    <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                        <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Ditulis oleh</p>
                        <!-- Admin yang menulis laporan (relasi user) -->
                        <p class="font-bold text-emerald-700">{{ $childDevelopment->user?->name ?? '-' }}</p>
                    </div>
                </div>

                <!-- Foto laporan (tampil bila ada); diklik membuka lightbox -->
                <!-- dengan mengirim event 'open-lightbox' via $dispatch -->
                @if($childDevelopment->foto)
                    <div>
                        <p class="text-xs uppercase tracking-wider text-base-content/40 font-bold mb-2">Foto</p>
                        <img src="{{ asset('storage/' . $childDevelopment->foto) }}"
                             class="w-full max-h-64 object-cover rounded-xl border border-base-200 cursor-pointer hover:opacity-90 transition-opacity"
                             alt="{{ $childDevelopment->judul }}"
                             @click="$dispatch('open-lightbox', { src: '{{ asset('storage/' . $childDevelopment->foto) }}' })">
                    </div>
                @endif

                <!-- Deskripsi perkembangan anak -->
                <div>
                    <p class="text-xs uppercase tracking-wider text-base-content/40 font-bold mb-1">Deskripsi</p>
                    <div class="bg-base-100 rounded-xl p-4 border border-base-200 text-sm text-base-content/70 leading-relaxed">
                        {{ $childDevelopment->deskripsi }}
                    </div>
                </div>

                <!-- Informasi sponsorship terkait (tampil bila ada relasinya) -->
                @if($childDevelopment->sponsorship)
                    <div class="bg-amber-50 rounded-xl p-4 border border-amber-200 text-sm">
                        <p class="font-bold text-amber-700 mb-1">Informasi Sponsorship</p>
                        <p>Donatur: {{ $childDevelopment->sponsorship->donor_name }} · Paket: {{ $childDevelopment->sponsorship->package }}</p>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>

{{-- LIGHTBOX --}}
<!-- ============================================ -->
<!-- Modal lightbox foto (Alpine.js): menampilkan -->
<!-- gambar ukuran besar saat foto diklik. State  -->
<!-- 'open' & 'src' diset lewat event window      -->
<!-- 'open-lightbox'; tutup lewat tombol X, klik  -->
<!-- latar, atau tombol Escape                    -->
<!-- ============================================ -->
<div x-data="{ open: false, src: '' }"
     @open-lightbox.window="src = $event.detail.src; open = true"
     @keydown.escape.window="open = false"
     x-show="open"
     x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
     @click.self="open = false">
    <!-- Tombol tutup lightbox -->
    <button @click="open = false" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 text-white flex items-center justify-center transition-colors z-10">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <!-- Gambar yang ditampilkan di lightbox (sumber dari :src) -->
    <img :src="src" alt="Foto" class="max-w-[90vw] max-h-[90vh] object-contain rounded-xl shadow-2xl">
</div>
</x-admin-layout>
