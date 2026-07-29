{{--
    ========================================================
    DASHBOARD DONATUR (resources/views/dashboard.blade.php)
    ========================================================
    Halaman utama setelah donatur login.
    Data dikirim dari DonorController.dashboard():
      - $campaigns         → daftar campaign aktif
      - $fosterChildren    → daftar anak asuh (Tersedia + yg sudah diasuh oleh user ini)
      - $donations         → riwayat donasi user ini
      - $sponsorships      → riwayat sponsorship user ini
      - $user              → data user yang login
      - $pendiris, $newsList → data publik
      - $totalDonated, $activeSponsorships → statistik
      - $totalFoster, $tersediaFoster, $diasuhFoster → statistik anak
    ========================================================
--}}
<x-app-layout>
    <div class="bg-slate-50 min-h-screen">

        {{-- HEADER DASHBOARD --}}
        <div class="relative overflow-hidden bg-gradient-to-r from-emerald-900 via-emerald-700 to-emerald-500">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.12),transparent_70%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,rgba(16,185,129,0.2),transparent_60%)]"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative">
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-4">
                        <div class="avatar">
                            <div class="w-16 h-16 rounded-full ring ring-white/30 ring-offset-2 ring-offset-emerald-700">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) . '?v=' . now()->timestamp }}" alt="{{ $user->name }}">
                                @else
                                    <div class="w-full h-full bg-white/20 text-white font-black text-2xl flex items-center justify-center uppercase rounded-full">{{ substr($user->name, 0, 1) }}</div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <h1 class="text-xl sm:text-2xl font-bold text-white">Selamat Datang</h1>
                            <p class="text-emerald-100/60 text-xs sm:text-sm mt-0.5">{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }} — Dashboard Donatur</p>
                            <div class="flex flex-wrap gap-3 mt-2 text-xs text-emerald-100/50">
                                @if($user->phone)
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    {{ $user->phone }}
                                </span>
                                @endif
                                @if($user->email)
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ $user->email }}
                                </span>
                                @endif
                                @if($user->address)
                                <span class="flex items-center gap-1 max-w-xs truncate">
                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $user->address }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($profil?->logo)
                        <img src="{{ asset('storage/' . $profil->logo) . '?v=' . now()->timestamp }}" class="h-14 w-14 rounded-xl object-cover border-2 border-white/20 hidden sm:block" alt="Logo">
                    @endif
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/5">
                        <div class="text-emerald-100/50 text-[0.6rem] font-bold uppercase tracking-wider">Total Donasi</div>
                        <div class="text-lg sm:text-xl font-black text-white mt-1">Rp {{ number_format($totalDonated, 0, ',', '.') }}</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/5">
                        <div class="text-emerald-100/50 text-[0.6rem] font-bold uppercase tracking-wider">Sponsorship Aktif</div>
                        <div class="text-lg sm:text-xl font-black text-white mt-1">{{ $activeSponsorships }}</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/5">
                        <div class="text-emerald-100/50 text-[0.6rem] font-bold uppercase tracking-wider">Transaksi Donasi</div>
                        <div class="text-lg sm:text-xl font-black text-white mt-1">{{ $donations->count() }}</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 flex flex-col justify-center border border-white/5">
                        <a href="{{ route('dashboard.rekap') }}" class="btn btn-xs bg-white/20 hover:bg-white/30 text-white border-0 backdrop-blur-sm rounded-lg font-bold w-full">Lihat Rekap →</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4 space-y-6 pb-8">

            {{-- QUICK ACTIONS --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <a href="#kampanye-donasi" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 hover:shadow-md hover:border-emerald-200 transition-all p-4 sm:p-5 flex items-center gap-3 sm:gap-4 group">
                    <div class="w-11 h-11 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-sm text-slate-800">Donasi Sekarang</h3>
                        <p class="text-xs text-slate-400">Salurkan ke program pilihan</p>
                    </div>
                </a>
                <a href="#program-ota" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 hover:shadow-md hover:border-emerald-200 transition-all p-4 sm:p-5 flex items-center gap-3 sm:gap-4 group">
                    <div class="w-11 h-11 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-sm text-slate-800">Jadi Orang Tua Asuh</h3>
                        <p class="text-xs text-slate-400">Sponsorship anak asuh</p>
                    </div>
                </a>
                <a href="#berita-kegiatan" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 hover:shadow-md hover:border-emerald-200 transition-all p-4 sm:p-5 flex items-center gap-3 sm:gap-4 group">
                    <div class="w-11 h-11 rounded-xl bg-sky-100 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-sm text-slate-800">Berita & Kegiatan</h3>
                        <p class="text-xs text-slate-400">Liputan terkini yayasan</p>
                    </div>
                </a>
                <a href="{{ route('profile.edit') }}" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 hover:shadow-md hover:border-amber-200 transition-all p-4 sm:p-5 flex items-center gap-3 sm:gap-4 group">
                    <div class="w-11 h-11 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-amber-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-sm text-slate-800">Edit Profil</h3>
                        <p class="text-xs text-slate-400">Ubah data diri & password</p>
                    </div>
                </a>
            </div>

            {{-- LINK YAYASAN --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <a href="{{ route('dashboard.profil') }}" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 hover:shadow-md hover:border-emerald-200 transition-all p-4 flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Profil Yayasan</p>
                        <p class="text-xs text-slate-400">Sejarah, visi & misi</p>
                    </div>
                </a>
                <a href="{{ route('dashboard.pengurus') }}" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 hover:shadow-md hover:border-emerald-200 transition-all p-4 flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Pengurus Yayasan</p>
                        <p class="text-xs text-slate-400">Struktur manajemen</p>
                    </div>
                </a>
                <a href="{{ route('dashboard.legalitas') }}" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 hover:shadow-md hover:border-amber-200 transition-all p-4 flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-amber-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Legalitas & Struktur</p>
                        <p class="text-xs text-slate-400">Dokumen & bagan organisasi</p>
                    </div>
                </a>
            </div>

            {{-- BERITA KEGIATAN --}}
            <div id="berita-kegiatan" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-sky-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Berita & Kegiatan</h2>
                        <p class="text-xs text-slate-400">Liputan dan kegiatan terbaru yayasan</p>
                    </div>
                </div>
                <div class="p-6">
                    @if($newsList->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($newsList as $news)
                                <a href="{{ route('news.show', $news->slug) }}" class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-all group overflow-hidden">
                                    @if($news->foto_utama)
                                        <figure class="h-40 overflow-hidden">
                                            <img src="{{ asset('storage/' . $news->foto_utama) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $news->judul }}">
                                        </figure>
                                    @endif
                                    <div class="p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            @if($news->kategori)<span class="inline-flex items-center gap-1 text-[0.6rem] font-semibold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">{{ $news->kategori }}</span>@endif
                                            @if($news->tanggal_kegiatan)<span class="text-xs text-slate-400">{{ $news->tanggal_kegiatan->format('d M Y') }}</span>@endif
                                        </div>
                                        <h3 class="font-bold text-sm text-slate-800 group-hover:text-emerald-700 transition-colors">{{ $news->judul }}</h3>
                                        @if($news->ringkasan)<p class="text-xs text-slate-400 mt-1 line-clamp-2">{{ Str::limit($news->ringkasan, 100) }}</p>@endif
                                        @if($news->lokasi)<p class="text-xs text-slate-300 mt-2 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> {{ $news->lokasi }}</p>@endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-slate-400 text-sm text-center py-8">Belum ada berita kegiatan.</p>
                    @endif
                </div>
            </div>

            {{-- KAMPANYE DONASI --}}
            <div id="kampanye-donasi" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Kampanye Donasi</h2>
                        <p class="text-xs text-slate-400">Program donasi yang sedang berjalan</p>
                    </div>
                </div>
                <div class="p-6">
                    @if($campaigns->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($campaigns as $camp)
                                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition-all group">
                                    @if($camp->image)
                                        <a href="{{ route('campaign.show', $camp->id) }}">
                                            <figure class="h-36 overflow-hidden">
                                                <img src="{{ asset('storage/' . $camp->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $camp->title }}">
                                            </figure>
                                        </a>
                                    @endif
                                    <div class="p-4">
                                        <a href="{{ route('campaign.show', $camp->id) }}" class="hover:text-emerald-700 transition-colors">
                                            <h3 class="font-bold text-sm text-slate-800 group-hover:text-emerald-700 transition-colors">{{ $camp->title }}</h3>
                                            <p class="text-xs text-slate-400 mt-1 line-clamp-2">{{ Str::limit($camp->description, 80) }}</p>
                                        </a>
                                        <div class="mt-3">
                                            <div class="flex justify-between text-xs text-slate-400 mb-1.5">
                                                <span>Terkumpul</span>
                                                <span class="font-bold text-emerald-700">Rp {{ number_format($camp->collected_amount, 0, ',', '.') }} / Rp {{ number_format($camp->target_amount, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full transition-all" style="width: {{ $camp->target_amount > 0 ? min(($camp->collected_amount / $camp->target_amount) * 100, 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="flex gap-2 mt-3">
                                            <a href="{{ route('campaign.show', $camp->id) }}" class="btn btn-sm btn-outline border-slate-300 text-slate-500 hover:bg-slate-100 hover:text-slate-700 rounded-lg font-bold flex-1">Lihat Detail</a>
                                            <a href="{{ route('donations.create', $camp->id) }}" class="btn btn-sm bg-emerald-700 hover:bg-emerald-800 text-white border-0 rounded-lg font-bold flex-1 shadow-sm">Donasi Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 bg-slate-50 rounded-xl border border-slate-200">
                            <p class="font-semibold text-slate-500">Belum ada program donasi aktif</p>
                            <p class="text-xs text-slate-400 mt-1">Nantikan program donasi terbaru dari yayasan.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- PROGRAM ORANG TUA ASUH --}}
            <div id="program-ota" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">Program Orang Tua Asuh</h2>
                        <p class="text-xs text-slate-400">Jadilah orang tua asuh untuk anak yatim</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-3 gap-3 mb-6">
                        <div class="bg-slate-50 rounded-xl p-4 text-center border border-slate-200">
                            <div class="text-[0.6rem] font-bold uppercase tracking-wider text-slate-400">Total</div>
                            <div class="text-xl font-black text-emerald-700 mt-1">{{ $totalFoster }}</div>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4 text-center border border-slate-200">
                            <div class="text-[0.6rem] font-bold uppercase tracking-wider text-slate-400">Tersedia</div>
                            <div class="text-xl font-black text-emerald-600 mt-1">{{ $tersediaFoster }}</div>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4 text-center border border-slate-200">
                            <div class="text-[0.6rem] font-bold uppercase tracking-wider text-slate-400">Anda Asuh</div>
                            <div class="text-xl font-black text-amber-600 mt-1">{{ $diasuhFoster }}</div>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-xl border border-slate-200 p-4 mb-6">
                        <form method="GET" action="{{ route('dashboard') }}#program-ota" class="flex flex-wrap items-center gap-x-3 gap-y-2">
                            <input type="hidden" name="usia" id="usia-input" value="{{ request('usia') }}">
                            <input type="hidden" name="jenis_kelamin" id="jenis_kelamin-input" value="{{ request('jenis_kelamin') }}">

                            <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-700 tracking-wider mr-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                                Filter
                            </span>

                            <div class="dropdown dropdown-bottom">
                                <button type="button" class="btn btn-xs border-emerald-200 rounded-lg font-bold transition-all duration-200 {{ request('usia') ? 'bg-emerald-700 text-white shadow-sm shadow-emerald-200 border-emerald-700' : 'bg-white text-slate-500 hover:border-emerald-400 hover:text-slate-700' }}" onclick="this.closest('.dropdown').classList.toggle('dropdown-open')">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ request('usia') ? 'Usia ' . request('usia') . ' Thn' : 'Usia' }}
                                    <svg class="w-3 h-3 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <ul class="dropdown-content menu bg-white rounded-xl shadow-xl border border-slate-200 p-1.5 w-44 z-10">
                                    <li><button type="button" class="flex items-center gap-2 text-sm rounded-lg {{ !request('usia') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-500 hover:bg-slate-50' }}" onclick="setFilter('usia', '')"><span class="w-4 h-4 rounded-full border-2 flex items-center justify-center {{ !request('usia') ? 'border-emerald-700 bg-emerald-700' : 'border-slate-300' }}"><span class="w-1.5 h-1.5 rounded-full {{ !request('usia') ? 'bg-white' : '' }}"></span></span>Semua Usia</button></li>
                                    <li><button type="button" class="flex items-center gap-2 text-sm rounded-lg {{ request('usia') == '0-5' ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-500 hover:bg-slate-50' }}" onclick="setFilter('usia', '0-5')"><span class="w-4 h-4 rounded-full border-2 flex items-center justify-center {{ request('usia') == '0-5' ? 'border-emerald-700 bg-emerald-700' : 'border-slate-300' }}"><span class="w-1.5 h-1.5 rounded-full {{ request('usia') == '0-5' ? 'bg-white' : '' }}"></span></span>0 - 5 Tahun</button></li>
                                    <li><button type="button" class="flex items-center gap-2 text-sm rounded-lg {{ request('usia') == '6-10' ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-500 hover:bg-slate-50' }}" onclick="setFilter('usia', '6-10')"><span class="w-4 h-4 rounded-full border-2 flex items-center justify-center {{ request('usia') == '6-10' ? 'border-emerald-700 bg-emerald-700' : 'border-slate-300' }}"><span class="w-1.5 h-1.5 rounded-full {{ request('usia') == '6-10' ? 'bg-white' : '' }}"></span></span>6 - 10 Tahun</button></li>
                                    <li><button type="button" class="flex items-center gap-2 text-sm rounded-lg {{ request('usia') == '11-15' ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-500 hover:bg-slate-50' }}" onclick="setFilter('usia', '11-15')"><span class="w-4 h-4 rounded-full border-2 flex items-center justify-center {{ request('usia') == '11-15' ? 'border-emerald-700 bg-emerald-700' : 'border-slate-300' }}"><span class="w-1.5 h-1.5 rounded-full {{ request('usia') == '11-15' ? 'bg-white' : '' }}"></span></span>11 - 15 Tahun</button></li>
                                    <li><button type="button" class="flex items-center gap-2 text-sm rounded-lg {{ request('usia') == '16-20' ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-500 hover:bg-slate-50' }}" onclick="setFilter('usia', '16-20')"><span class="w-4 h-4 rounded-full border-2 flex items-center justify-center {{ request('usia') == '16-20' ? 'border-emerald-700 bg-emerald-700' : 'border-slate-300' }}"><span class="w-1.5 h-1.5 rounded-full {{ request('usia') == '16-20' ? 'bg-white' : '' }}"></span></span>16 - 20 Tahun</button></li>
                                </ul>
                            </div>

                            <div class="dropdown dropdown-bottom">
                                <button type="button" class="btn btn-xs border-emerald-200 rounded-lg font-bold transition-all duration-200 {{ request('jenis_kelamin') ? 'bg-emerald-700 text-white shadow-sm shadow-emerald-200 border-emerald-700' : 'bg-white text-slate-500 hover:border-emerald-400 hover:text-slate-700' }}" onclick="this.closest('.dropdown').classList.toggle('dropdown-open')">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    {{ request('jenis_kelamin') ?? 'Jenis Kelamin' }}
                                    <svg class="w-3 h-3 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <ul class="dropdown-content menu bg-white rounded-xl shadow-xl border border-slate-200 p-1.5 w-44 z-10">
                                    <li><button type="button" class="flex items-center gap-2 text-sm rounded-lg {{ !request('jenis_kelamin') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-500 hover:bg-slate-50' }}" onclick="setFilter('jenis_kelamin', '')"><span class="w-4 h-4 rounded-full border-2 flex items-center justify-center {{ !request('jenis_kelamin') ? 'border-emerald-700 bg-emerald-700' : 'border-slate-300' }}"><span class="w-1.5 h-1.5 rounded-full {{ !request('jenis_kelamin') ? 'bg-white' : '' }}"></span></span>Semua</button></li>
                                    <li><button type="button" class="flex items-center gap-2 text-sm rounded-lg {{ request('jenis_kelamin') == 'Laki-laki' ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-500 hover:bg-slate-50' }}" onclick="setFilter('jenis_kelamin', 'Laki-laki')"><span class="w-4 h-4 rounded-full border-2 flex items-center justify-center {{ request('jenis_kelamin') == 'Laki-laki' ? 'border-emerald-700 bg-emerald-700' : 'border-slate-300' }}"><span class="w-1.5 h-1.5 rounded-full {{ request('jenis_kelamin') == 'Laki-laki' ? 'bg-white' : '' }}"></span></span><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg> Laki-laki</button></li>
<li><button type="button" class="flex items-center gap-2 text-sm rounded-lg {{ request('jenis_kelamin') == 'Perempuan' ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-500 hover:bg-slate-50' }}" onclick="setFilter('jenis_kelamin', 'Perempuan')"><span class="w-4 h-4 rounded-full border-2 flex items-center justify-center {{ request('jenis_kelamin') == 'Perempuan' ? 'border-emerald-700 bg-emerald-700' : 'border-slate-300' }}"><span class="w-1.5 h-1.5 rounded-full {{ request('jenis_kelamin') == 'Perempuan' ? 'bg-white' : '' }}"></span></span><svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg> Perempuan</button></li>
                                </ul>
                            </div>

                            @if(request('usia') || request('jenis_kelamin'))
                                <a href="{{ route('dashboard') }}#program-ota" class="btn btn-xs bg-rose-50 hover:bg-rose-100 text-rose-600 border-0 rounded-lg font-bold transition-all duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Reset Filter
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="flex items-center gap-1.5 mb-3">
                        <p class="text-xs text-slate-400">
                            Menampilkan <span class="font-bold text-slate-600">{{ $fosterChildren->count() }}</span> dari <span class="font-bold text-slate-600">{{ $totalVisible }}</span> anak
                        </p>
                    </div>

                    <script>
                        function setFilter(key, value) {
                            if (key === 'usia') {
                                document.getElementById('usia-input').value = value;
                            } else {
                                document.getElementById('jenis_kelamin-input').value = value;
                            }
                            document.querySelector('#program-ota form').submit();
                        }
                    </script>

                    @if($fosterChildren->isNotEmpty())
                        @php
                            $chunks = $fosterChildren->chunk(3);
                        @endphp
                        <div class="relative" x-data="{ slide: 0, total: {{ $chunks->count() }} }">
                            <div class="overflow-hidden">
                                @foreach($chunks as $i => $chunk)
                                    <div x-show="slide === {{ $i }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach($chunk as $child)
                                            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition-all">
                                                <div class="p-4">
                                                    <div class="flex items-center gap-3 mb-3">
                                                        <div class="w-12 h-12 rounded-full flex-shrink-0 overflow-hidden ring-2 ring-emerald-100">
                                                            @if($child->photo)
                                                                <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->name }}" class="w-full h-full object-cover">
                                                            @else
                                                                <div class="w-full h-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center text-sm uppercase">{{ substr($child->name, 0, 1) }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="min-w-0">
                                                            <h3 class="font-bold text-sm text-slate-800 truncate">{{ $child->name }}</h3>
                                                            <div class="flex gap-1 mt-0.5 flex-wrap">
                                                                <span class="inline-flex items-center text-[0.55rem] font-semibold px-1.5 py-0.5 rounded-full bg-slate-100 text-slate-500">{{ $child->age }} Thn</span>
                                                                @if($child->jenis_kelamin)
                                                                    <span class="inline-flex items-center text-[0.55rem] font-semibold px-1.5 py-0.5 rounded-full bg-slate-100 text-slate-500">{{ $child->jenis_kelamin }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($child->description)
                                                        <p class="text-xs text-slate-400 mb-3 line-clamp-2">{{ Str::limit($child->description, 100) }}</p>
                                                    @endif
                                                    @if($child->status == 'Tersedia')
                                                        <div class="flex gap-2">
                                                            <a href="{{ route('sponsor.child-detail', $child->id) }}" class="btn btn-sm btn-outline border-slate-300 text-slate-500 hover:bg-slate-100 hover:text-slate-700 rounded-lg font-bold flex-1">
                                                                Lihat Profil
                                                            </a>
                                                            <a href="{{ route('sponsor.form', $child->id) }}" class="btn btn-sm bg-emerald-700 hover:bg-emerald-800 text-white border-0 rounded-lg font-bold flex-1 shadow-sm">
                                                                Asuh Sekarang
                                                            </a>
                                                        </div>
                                                    @else
                                                        <span class="btn btn-sm bg-emerald-50 text-emerald-700 border-emerald-200 rounded-lg font-bold w-full cursor-default flex items-center justify-center gap-1">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            Anak Asuh Anda
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                            @if($chunks->count() > 1)
                            <div class="flex items-center justify-center gap-3 mt-5">
                                <button @click="slide = slide > 0 ? slide - 1 : total - 1" class="w-8 h-8 rounded-full bg-emerald-100 hover:bg-emerald-200 text-emerald-700 flex items-center justify-center transition-colors text-sm font-bold">‹</button>
                                <template x-for="i in total" :key="i">
                                    <button @click="slide = i - 1" class="w-2 h-2 rounded-full transition-all duration-200" :class="slide === i - 1 ? 'bg-emerald-700 scale-125' : 'bg-slate-300 hover:bg-emerald-300'" :aria-label="'Halaman ' + i"></button>
                                </template>
                                <button @click="slide = slide < total - 1 ? slide + 1 : 0" class="w-8 h-8 rounded-full bg-emerald-100 hover:bg-emerald-200 text-emerald-700 flex items-center justify-center transition-colors text-sm font-bold">›</button>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-8 bg-slate-50 rounded-xl border border-slate-200">
                            <p class="font-semibold text-slate-500">Belum ada data anak asuh</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
