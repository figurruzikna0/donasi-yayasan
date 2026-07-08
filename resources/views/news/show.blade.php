<!DOCTYPE html>
<html lang="id" data-theme="baitul">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->judul }} - {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- NAVBAR --}}
    @include('partials.public-navbar', ['useRouteLinks' => false, 'scrollEffect' => true])

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