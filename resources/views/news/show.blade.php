<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->judul }} - {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- NAVBAR --}}
    <nav id="navbar" class="navbar bg-base-100/90 backdrop-blur-lg sticky top-0 z-50 shadow-sm transition-all duration-300">
        <div class="navbar-start">
            <a href="/" class="flex items-center gap-3">
                @if($profil && $profil->logo)
                    <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo" class="h-9 w-9 rounded-full object-cover border border-emerald-200 shadow-sm">
                @else
                    <span class="text-2xl">🌿</span>
                @endif
                <span class="text-xl font-extrabold tracking-wide text-emerald-700">
                    {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}
                </span>
            </a>
        </div>

        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal gap-1">
                <li><a href="{{ url('/') }}" class="font-bold text-emerald-700">Beranda</a></li>
                <li class="dropdown dropdown-hover">
                    <a tabindex="0" class="font-bold text-emerald-700">
                        Tentang Kami
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </a>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-xl min-w-[200px] z-[100] border border-emerald-200">
                        <li><a href="{{ url('/#tentang-kami') }}" class="font-bold text-emerald-700">📖 Profil Yayasan</a></li>
                        <li><a href="{{ url('/#pendiri') }}" class="font-bold text-emerald-700">👤 Pengurus</a></li>
                        <li><a href="{{ url('/#legalitas') }}" class="font-bold text-emerald-700">📑 Legalitas & Struktur</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/#kampanye') }}" class="font-bold text-emerald-700">❤️ Program Donasi</a></li>
                <li><a href="{{ url('/#program-ota') }}" class="font-bold text-emerald-700">🤝 Orang Tua Asuh</a></li>
                <li><a href="{{ url('/#berita-kegiatan') }}" class="font-bold text-emerald-700">📰 Berita</a></li>
            </ul>
        </div>

        <div class="navbar-end gap-2">
            <a href="{{ route('register') }}" class="btn btn-outline btn-success btn-sm font-bold hidden sm:inline-flex">Daftar</a>
            <a href="{{ route('login') }}" class="btn btn-success btn-sm font-bold text-white hidden sm:inline-flex">Masuk</a>
            <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="btn btn-ghost btn-square lg:hidden">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden absolute top-full left-0 right-0 bg-base-100 border-t border-emerald-100 shadow-lg lg:hidden">
            <ul class="menu menu-md p-4">
                <li><a href="{{ url('/') }}" class="font-bold text-emerald-800">🏠 Beranda</a></li>
                <li class="menu-title text-xs"><span>Tentang</span></li>
                <li><a href="{{ url('/#tentang-kami') }}" class="text-emerald-700">📖 Profil Yayasan</a></li>
                <li><a href="{{ url('/#pendiri') }}" class="text-emerald-700">👤 Pengurus</a></li>
                <li><a href="{{ url('/#legalitas') }}" class="text-emerald-700">📑 Legalitas & Struktur</a></li>
                <li class="menu-title text-xs"><span>Program</span></li>
                <li><a href="{{ url('/#kampanye') }}" class="text-emerald-700">❤️ Program Donasi</a></li>
                <li><a href="{{ url('/#program-ota') }}" class="text-emerald-700">🤝 Orang Tua Asuh</a></li>
                <li><a href="{{ url('/#berita-kegiatan') }}" class="text-emerald-700">📰 Berita</a></li>
                <li class="menu-divider"></li>
                <li><a href="{{ route('register') }}" class="font-bold text-emerald-700">📝 Daftar Donatur</a></li>
                <li><a href="{{ route('login') }}" class="font-bold text-emerald-700">🔑 Masuk</a></li>
            </ul>
        </div>
    </nav>

    <div class="bg-gradient-to-b from-emerald-50 to-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

            {{-- Breadcrumb --}}
            <nav class="text-sm text-gray-400 mb-6">
                <a href="{{ url('/') }}" class="hover:text-emerald-600 transition-colors">Beranda</a>
                <span class="mx-1.5">/</span>
                <a href="{{ url('/#berita-kegiatan') }}" class="hover:text-emerald-600 transition-colors">Berita</a>
                <span class="mx-1.5">/</span>
                <span class="text-gray-600">{{ Str::limit($news->judul, 40) }}</span>
            </nav>

            {{-- Hero Image --}}
            @if($news->foto_utama)
            <div class="rounded-2xl overflow-hidden shadow-lg mb-8 max-h-80">
                <img src="{{ asset('storage/' . $news->foto_utama) }}" alt="{{ $news->judul }}" class="w-full h-56 sm:h-72 object-cover">
            </div>
            @endif

            {{-- Header Info --}}
            <div class="flex flex-wrap items-center gap-3 mb-4">
                @if($news->kategori)
                    <span class="text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full">{{ $news->kategori }}</span>
                @endif
                @if($news->tanggal_kegiatan)
                    <span class="text-xs text-gray-500">📅 {{ $news->tanggal_kegiatan->format('d M Y') }}</span>
                @endif
                @if($news->lokasi)
                    <span class="text-xs text-gray-500">📍 {{ $news->lokasi }}</span>
                @endif
            </div>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-emerald-800 leading-tight mb-8">{{ $news->judul }}</h1>

            {{-- Grid --}}
            <div class="lg:grid lg:grid-cols-3 lg:gap-12">

                {{-- Main Content --}}
                <article class="lg:col-span-2">

                    @if($news->ringkasan)
                        <div class="text-base text-emerald-700 font-medium mb-8 p-5 bg-emerald-50 rounded-xl border-l-4 border-emerald-500 leading-relaxed">
                            {{ $news->ringkasan }}
                        </div>
                    @endif

                    <div class="text-gray-700 leading-relaxed text-base space-y-4">
                        {!! nl2br(e($news->konten)) !!}
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <a href="{{ url('/#berita-kegiatan') }}" class="text-gray-500 hover:text-emerald-600 transition-colors text-sm flex items-center gap-1.5 font-medium">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                            Kembali ke Berita
                        </a>
                    </div>
                </article>

                {{-- Sidebar --}}
                <aside class="mt-10 lg:mt-0">
                    <div class="sticky top-24 space-y-6">

                        {{-- Info Kegiatan --}}
                        <div class="bg-white rounded-xl shadow-md border border-emerald-100 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 px-5 py-4">
                                <h3 class="text-white font-bold text-sm uppercase tracking-wider flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Informasi Kegiatan
                                </h3>
                            </div>
                            <div class="p-5 space-y-4">
                                @if($news->tanggal_kegiatan)
                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0 text-base">📅</div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Tanggal</p>
                                        <p class="text-sm font-bold text-emerald-700">{{ $news->tanggal_kegiatan->format('d F Y') }}</p>
                                    </div>
                                </div>
                                @endif
                                @if($news->lokasi)
                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0 text-base">📍</div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Lokasi</p>
                                        <p class="text-sm font-bold text-emerald-700">{{ $news->lokasi }}</p>
                                    </div>
                                </div>
                                @endif
                                @if($news->penyelenggara)
                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0 text-base">👤</div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Penyelenggara</p>
                                        <p class="text-sm font-bold text-emerald-700">{{ $news->penyelenggara }}</p>
                                    </div>
                                </div>
                                @endif
                                @if($news->kategori)
                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0 text-base">🏷️</div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Kategori</p>
                                        <p class="text-sm font-bold text-emerald-700">{{ $news->kategori }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- CTA --}}
                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-xl p-6 text-white shadow-md">
                            <div class="text-2xl mb-3">💚</div>
                            <p class="text-sm font-bold mb-1">Dukung Program Kami</p>
                            <p class="text-xs text-emerald-100 mb-4 leading-relaxed">Setiap donasi Anda berarti bagi mereka yang membutuhkan.</p>
                            <a href="{{ url('/#kampanye') }}" class="inline-block bg-white text-emerald-700 text-xs font-bold px-5 py-2.5 rounded-lg hover:bg-emerald-50 transition-colors shadow-sm">
                                Donasi Sekarang →
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

</body>
</html>