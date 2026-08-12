<!-- ============================================ -->
<!-- donations\child_detail.blade.php — detail profil anak asuh -->
<!-- ============================================ -->
<!-- Peran     : halaman informasi lengkap seorang anak asuh (foto, usia, jenis kelamin, deskripsi). -->
<!-- Controller: DonationController (atau controller terkait) — variabel $child (FosterChild). -->
<!-- Alur      : dari dashboard bagian program orang tua asuh -> klik anak -> detail tampil -> -->
<!--             tombol "Asuh Sekarang" menuju form sponsorship (sponsor.blade.php). -->
<x-app-layout>
    <div class="bg-base-200 min-h-0">

        <!-- BANNER ATAS: judul halaman dan tombol kembali ke dashboard (bagian program OTA) -->
        <div class="bg-gradient-to-r from-primary via-primary to-secondary text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">Profil Anak Asuh</h1>
                        <p class="text-primary-content/70 text-sm mt-1">Informasi lengkap anak yatim yang siap diasuh</p>
                    </div>
                    <a href="{{ route('dashboard') }}#program-ota" class="btn btn-outline border-white text-white hover:bg-white hover:text-primary btn-sm font-bold">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="card bg-base-100 shadow-md border border-base-300">
                <div class="card-body p-6 sm:p-8">

                    <div class="flex flex-col sm:flex-row gap-6 items-start mb-6">
                        <!-- FOTO ANAK: tampil foto dari storage; bila tidak ada, gunakan avatar otomatis ui-avatars.com -->
                        <div class="avatar">
                            <div class="w-28 rounded-full ring ring-primary/20 ring-offset-2">
                                @if($child->photo)
                                    <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->name }}" class="object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($child->name) }}&background=b3e093&color=5c8148&bold=true&size=112" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 space-y-3">
                            <!-- BADGE STATUS: hijau bila anak "Tersedia" (bisa diasuh), biru/info untuk status lain -->
                            <div class="flex items-center gap-3 flex-wrap">
                                <h2 class="text-2xl font-black text-primary">{{ $child->name }}</h2>
                                <span class="badge {{ $child->status == 'Tersedia' ? 'badge-success' : 'badge-info' }} badge-lg font-bold">
                                    {{ $child->status ?? 'Tidak Diketahui' }}
                                </span>
                            </div>
                            <!-- INFO DASAR: usia anak, dan jenis kelamin bila tersedia -->
                            <div class="flex flex-wrap gap-3 text-sm">
                                <span class="bg-base-200 px-3 py-1.5 rounded-lg border border-base-300 font-semibold text-base-content/70">
                                    <svg class="w-4 h-4 inline-block -mt-0.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                    {{ $child->age }} Tahun
                                </span>
                                @if($child->jenis_kelamin)
                                    <span class="bg-base-200 px-3 py-1.5 rounded-lg border border-base-300 font-semibold text-base-content/70">
                                        <svg class="w-4 h-4 inline-block -mt-0.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                        {{ $child->jenis_kelamin }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- DESKRIPSI ANAK: cerita singkat tentang anak (bila diisi admin) -->
                    @if($child->description)
                        <div class="mb-6">
                            <p class="text-xs uppercase tracking-wider text-primary font-bold mb-2">Tentang {{ $child->name }}</p>
                            <div class="bg-base-200 rounded-xl p-5 border border-base-300 text-sm text-base-content/70 leading-relaxed">
                                {{ $child->description }}
                            </div>
                        </div>
                    @endif

                    <!-- KONDISI: notifikasi bila pengguna AKTIF menjadi orang tua asuh anak ini -->
                    <!-- (ada sponsorship berstatus 'success' pada anak tersebut) -->
                    @if($child->sponsorships->where('status', 'success')->count())
                        <div class="bg-brand-500/5 border border-brand-200 rounded-xl p-4 mb-6">
                            <div class="flex items-center gap-2 text-brand-700 text-sm font-bold">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Anda sedang menjadi orang tua asuh untuk {{ $child->name }}
                            </div>
                        </div>
                    @endif

                    <!-- TOMBOL AKSI: -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-base-200">
                        <!-- KONDISI: anak berstatus Tersedia -> tombol "Asuh Sekarang" menuju form sponsorship; -->
                        <!-- jika tidak (sudah diasuh), tampilkan keterangan nonaktif -->
                        @if($child->status == 'Tersedia')
                            <a href="{{ route('sponsor.form', $child->id) }}" class="btn bg-primary hover:bg-primary/90 text-white border-0 rounded-lg font-bold flex-1 shadow-lg shadow-primary/20">
                                Asuh {{ $child->name }} Sekarang
                            </a>
                        @else
                            <span class="btn bg-brand-500/10 text-brand-700 border-brand-200 rounded-lg font-bold flex-1 cursor-default">
                                Anak sudah diasuh
                            </span>
                        @endif
                        <!-- TOMBOL KEMBALI: ke daftar program orang tua asuh di dashboard -->
                        <a href="{{ route('dashboard') }}#program-ota" class="btn btn-outline border-base-300 text-base-content/70 hover:bg-base-200 rounded-lg font-bold">
                            ← Kembali ke Daftar
                        </a>
                    </div>

                </div>
            </div>

            <div class="text-center mt-6 text-xs text-base-content/40">
                <p>Yayasan Baitul Yatim Sukabumi — Setiap anak berhak mendapatkan masa depan yang cerah</p>
            </div>
        </div>
    </div>
</x-app-layout>