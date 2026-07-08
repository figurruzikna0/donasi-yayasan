<x-app-layout>
    <div class="bg-base-200 min-h-screen">

        {{-- Header --}}
        <div class="bg-gradient-to-br from-primary via-primary to-primary/90 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-white/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-white/10 rounded-full blur-3xl"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative">
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-4">
                        <div class="avatar">
                            <div class="w-16 h-16 rounded-full ring ring-white/30 ring-offset-2 ring-offset-primary">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) . '?v=' . now()->timestamp }}" alt="{{ $user->name }}">
                                @else
                                    <div class="w-full h-full bg-white/20 text-white font-black text-2xl flex items-center justify-center uppercase rounded-full">{{ substr($user->name, 0, 1) }}</div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <h1 class="text-xl sm:text-2xl font-bold">Selamat Datang</h1>
                            <p class="text-primary-content/60 text-xs sm:text-sm mt-0.5">{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }} — Dashboard Donatur</p>
                            <div class="flex flex-wrap gap-3 mt-2 text-xs text-primary-content/50">
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
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                        <div class="text-primary-content/50 text-[0.6rem] font-bold uppercase tracking-wider">Total Donasi</div>
                        <div class="text-lg sm:text-xl font-black text-white mt-1">Rp {{ number_format($totalDonated, 0, ',', '.') }}</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                        <div class="text-primary-content/50 text-[0.6rem] font-bold uppercase tracking-wider">Sponsorship Aktif</div>
                        <div class="text-lg sm:text-xl font-black text-white mt-1">{{ $activeSponsorships }}</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                        <div class="text-primary-content/50 text-[0.6rem] font-bold uppercase tracking-wider">Transaksi Donasi</div>
                        <div class="text-lg sm:text-xl font-black text-white mt-1">{{ $donations->count() }}</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 flex flex-col justify-center">
                        <a href="{{ route('dashboard.rekap') }}" class="btn btn-xs bg-white/20 hover:bg-white/30 text-white border-0 backdrop-blur-sm rounded-lg font-bold w-full">Lihat Rekap →</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4 space-y-6 pb-8">

            {{-- Quick Actions --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <a href="#kampanye-donasi" class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm hover:shadow-md hover:border-primary/30 transition-all p-4 sm:p-5 flex items-center gap-3 sm:gap-4 group">
                    <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 text-xl group-hover:scale-110 transition-transform">💰</div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-sm text-base-content">Donasi Sekarang</h3>
                        <p class="text-xs text-base-content/40">Salurkan ke program pilihan</p>
                    </div>
                </a>
                <a href="#program-ota" class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm hover:shadow-md hover:border-primary/30 transition-all p-4 sm:p-5 flex items-center gap-3 sm:gap-4 group">
                    <div class="w-11 h-11 rounded-xl bg-brand-500/10 flex items-center justify-center flex-shrink-0 text-xl group-hover:scale-110 transition-transform">🤝</div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-sm text-base-content">Jadi Orang Tua Asuh</h3>
                        <p class="text-xs text-base-content/40">Sponsorship anak asuh</p>
                    </div>
                </a>
                <a href="#berita-kegiatan" class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm hover:shadow-md hover:border-primary/30 transition-all p-4 sm:p-5 flex items-center gap-3 sm:gap-4 group">
                    <div class="w-11 h-11 rounded-xl bg-sky-100/50 flex items-center justify-center flex-shrink-0 text-xl group-hover:scale-110 transition-transform">📰</div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-sm text-base-content">Berita & Kegiatan</h3>
                        <p class="text-xs text-base-content/40">Liputan terkini yayasan</p>
                    </div>
                </a>
                <a href="{{ route('profile.edit') }}" class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm hover:shadow-md hover:border-primary/30 transition-all p-4 sm:p-5 flex items-center gap-3 sm:gap-4 group">
                    <div class="w-11 h-11 rounded-xl bg-amber-400/10 flex items-center justify-center flex-shrink-0 text-xl group-hover:scale-110 transition-transform">⚙️</div>
                    <div class="min-w-0">
                        <h3 class="font-bold text-sm text-base-content">Edit Profil</h3>
                        <p class="text-xs text-base-content/40">Ubah data diri & password</p>
                    </div>
                </a>
            </div>

            {{-- Link Yayasan --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <a href="{{ route('profil') }}" class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm hover:shadow-md hover:border-primary/30 transition-all p-4 flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0 text-lg group-hover:scale-110 transition-transform">🏛️</div>
                    <div>
                        <p class="text-sm font-bold text-base-content">Profil Yayasan</p>
                        <p class="text-xs text-base-content/40">Sejarah, visi & misi</p>
                    </div>
                </a>
                <a href="{{ route('pengurus') }}" class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm hover:shadow-md hover:border-primary/30 transition-all p-4 flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-brand-500/10 flex items-center justify-center flex-shrink-0 text-lg group-hover:scale-110 transition-transform">👥</div>
                    <div>
                        <p class="text-sm font-bold text-base-content">Pengurus Yayasan</p>
                        <p class="text-xs text-base-content/40">Struktur manajemen</p>
                    </div>
                </a>
                <a href="{{ route('legalitas') }}" class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm hover:shadow-md hover:border-primary/30 transition-all p-4 flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-amber-400/10 flex items-center justify-center flex-shrink-0 text-lg group-hover:scale-110 transition-transform">📜</div>
                    <div>
                        <p class="text-sm font-bold text-base-content">Legalitas & Struktur</p>
                        <p class="text-xs text-base-content/40">Dokumen & bagan organisasi</p>
                    </div>
                </a>
            </div>

            {{-- ══ BERITA KEGIATAN ══ --}}
            <div id="berita-kegiatan" class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-sky-100/50 flex items-center justify-center text-base">📰</div>
                    <div>
                        <h2 class="font-bold text-base-content">Berita & Kegiatan</h2>
                        <p class="text-xs text-base-content/40">Liputan dan kegiatan terbaru yayasan</p>
                    </div>
                </div>
                <div class="p-6">
                    @if($newsList->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($newsList as $news)
                                <a href="{{ route('news.show', $news->slug) }}" class="bg-white rounded-xl border border-base-200 shadow-sm hover:shadow-md transition-all group overflow-hidden">
                                    @if($news->foto_utama)
                                        <figure class="h-40 overflow-hidden">
                                            <img src="{{ asset('storage/' . $news->foto_utama) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $news->judul }}">
                                        </figure>
                                    @endif
                                    <div class="p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            @if($news->kategori)<span class="inline-flex items-center gap-1 text-[0.6rem] font-semibold px-2 py-0.5 rounded-full bg-primary/5 text-primary border border-primary/20">{{ $news->kategori }}</span>@endif
                                            @if($news->tanggal_kegiatan)<span class="text-xs text-base-content/40">{{ $news->tanggal_kegiatan->format('d M Y') }}</span>@endif
                                        </div>
                                        <h3 class="font-bold text-sm text-base-content group-hover:text-primary transition-colors">{{ $news->judul }}</h3>
                                        @if($news->ringkasan)<p class="text-xs text-base-content/50 mt-1 line-clamp-2">{{ Str::limit($news->ringkasan, 100) }}</p>@endif
                                        @if($news->lokasi)<p class="text-xs text-base-content/30 mt-2 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> {{ $news->lokasi }}</p>@endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-base-content/40 text-sm text-center py-8">Belum ada berita kegiatan.</p>
                    @endif
                </div>
            </div>

            {{-- ══ KAMPANYE DONASI ══ --}}
            <div id="kampanye-donasi" class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center text-base">💰</div>
                    <div>
                        <h2 class="font-bold text-base-content">Kampanye Donasi</h2>
                        <p class="text-xs text-base-content/40">Program donasi yang sedang berjalan</p>
                    </div>
                </div>
                <div class="p-6">
                    @if($campaigns->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($campaigns as $camp)
                                <div class="bg-white rounded-xl border border-base-200 shadow-sm overflow-hidden hover:shadow-md transition-all">
                                    @if($camp->image)
                                        <figure class="h-36 overflow-hidden">
                                            <img src="{{ asset('storage/' . $camp->image) }}" class="w-full h-full object-cover" alt="{{ $camp->title }}">
                                        </figure>
                                    @endif
                                    <div class="p-4">
                                        <h3 class="font-bold text-sm text-base-content">{{ $camp->title }}</h3>
                                        <p class="text-xs text-base-content/50 mt-1 line-clamp-2">{{ Str::limit($camp->description, 80) }}</p>
                                        <div class="mt-3">
                                            <div class="flex justify-between text-xs text-base-content/40 mb-1.5">
                                                <span>Terkumpul</span>
                                                <span class="font-bold text-primary">Rp {{ number_format($camp->collected_amount, 0, ',', '.') }} / Rp {{ number_format($camp->target_amount, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="w-full h-2 bg-base-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-primary rounded-full transition-all" style="width: {{ $camp->target_amount > 0 ? min(($camp->collected_amount / $camp->target_amount) * 100, 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <a href="{{ route('donations.create', $camp->id) }}" class="btn btn-sm bg-primary hover:bg-primary/90 text-white border-0 rounded-lg font-bold mt-3 w-full">Donasi Sekarang</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 bg-base-200/50 rounded-xl border border-base-200">
                            <p class="font-semibold text-base-content/60">Belum ada program donasi aktif</p>
                            <p class="text-xs text-base-content/40 mt-1">Nantikan program donasi terbaru dari yayasan.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ══ PROGRAM ORANG TUA ASUH ══ --}}
            <div id="program-ota" class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-brand-500/10 flex items-center justify-center text-base">🤝</div>
                    <div>
                        <h2 class="font-bold text-base-content">Program Orang Tua Asuh</h2>
                        <p class="text-xs text-base-content/40">Jadilah orang tua asuh untuk anak yatim</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-3 gap-3 mb-6">
                        <div class="bg-base-200/50 rounded-xl p-4 text-center">
                            <div class="text-[0.6rem] font-bold uppercase tracking-wider text-base-content/40">Total</div>
                            <div class="text-xl font-black text-primary mt-1">{{ $totalFoster }}</div>
                        </div>
                        <div class="bg-base-200/50 rounded-xl p-4 text-center">
                            <div class="text-[0.6rem] font-bold uppercase tracking-wider text-base-content/40">Tersedia</div>
                            <div class="text-xl font-black text-brand-600 mt-1">{{ $tersediaFoster }}</div>
                        </div>
                        <div class="bg-base-200/50 rounded-xl p-4 text-center">
                            <div class="text-[0.6rem] font-bold uppercase tracking-wider text-base-content/40">Anda Asuh</div>
                            <div class="text-xl font-black text-amber-600 mt-1">{{ $diasuhFoster }}</div>
                        </div>
                    </div>

                    @if($fosterChildren->isNotEmpty())
                        @php
                            $chunks = $fosterChildren->chunk(3);
                        @endphp
                        <div class="relative" x-data="{ slide: 0, total: {{ $chunks->count() }} }">
                            <div class="overflow-hidden">
                                @foreach($chunks as $i => $chunk)
                                    <div x-show="slide === {{ $i }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach($chunk as $child)
                                            <div class="bg-white rounded-xl border border-base-200 shadow-sm overflow-hidden">
                                                <div class="p-4">
                                                    <div class="flex items-center gap-3 mb-3">
                                                        <div class="w-12 h-12 rounded-full bg-primary/10 text-primary font-bold flex items-center justify-center flex-shrink-0 text-sm uppercase ring-2 ring-base-200">{{ substr($child->name, 0, 1) }}</div>
                                                        <div class="min-w-0">
                                                            <h3 class="font-bold text-sm text-base-content truncate">{{ $child->name }}</h3>
                                                            <div class="flex gap-1 mt-0.5 flex-wrap">
                                                                <span class="inline-flex items-center text-[0.55rem] font-semibold px-1.5 py-0.5 rounded-full bg-base-200 text-base-content/50">{{ $child->age }} Thn</span>
                                                                @if($child->jenis_kelamin)
                                                                    <span class="inline-flex items-center text-[0.55rem] font-semibold px-1.5 py-0.5 rounded-full bg-base-200 text-base-content/50">{{ $child->jenis_kelamin }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($child->description)
                                                        <p class="text-xs text-base-content/50 mb-3 line-clamp-2">{{ Str::limit($child->description, 100) }}</p>
                                                    @endif
                                                    @if($child->status == 'Tersedia')
                                                        <a href="{{ route('sponsor.form', $child->id) }}" class="btn btn-sm bg-primary hover:bg-primary/90 text-white border-0 rounded-lg font-bold w-full">Asuh Sekarang</a>
                                                    @else
                                                        <span class="btn btn-sm bg-brand-500/10 text-brand-700 border-brand-200 rounded-lg font-bold w-full cursor-default flex items-center justify-center gap-1">
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
                                <button @click="slide = slide > 0 ? slide - 1 : total - 1" class="w-8 h-8 rounded-full bg-primary/10 hover:bg-primary/20 text-primary flex items-center justify-center transition-colors text-sm font-bold">‹</button>
                                <template x-for="i in total" :key="i">
                                    <button @click="slide = i - 1" class="w-2 h-2 rounded-full transition-all duration-200" :class="slide === i - 1 ? 'bg-primary scale-125' : 'bg-base-300 hover:bg-primary/40'" :aria-label="'Halaman ' + i"></button>
                                </template>
                                <button @click="slide = slide < total - 1 ? slide + 1 : 0" class="w-8 h-8 rounded-full bg-primary/10 hover:bg-primary/20 text-primary flex items-center justify-center transition-colors text-sm font-bold">›</button>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-8 bg-base-200/50 rounded-xl border border-base-200">
                            <p class="font-semibold text-base-content/60">Belum ada data anak asuh</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>