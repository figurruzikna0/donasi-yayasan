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

            {{-- BREADCRUMB: navigasi Beranda / Berita / Judul Artikel --}}
            <nav class="text-sm text-gray-400 mb-6">
                <a href="{{ url('/') }}" class="hover:text-emerald-600 transition-colors">Beranda</a>
                <span class="mx-1.5">/</span>
                <a href="{{ url('/#berita-kegiatan') }}" class="hover:text-emerald-600 transition-colors">Berita</a>
                <span class="mx-1.5">/</span>
                <span class="text-gray-600">{{ Str::limit($news->judul, 40) }}</span>
            </nav>

            {{-- HERO IMAGE: foto utama berita dari storage --}}
            @if($news->foto_utama)
            <div class="rounded-2xl overflow-hidden shadow-lg mb-8 max-h-80">
                <img src="{{ asset('storage/' . $news->foto_utama) }}" alt="{{ $news->judul }}" class="w-full h-56 sm:h-72 object-cover">
            </div>
            @endif

            {{-- HEADER INFO: kategori, tanggal, lokasi kegiatan --}}
            <div class="flex flex-wrap items-center gap-3 mb-4">
                @if($news->kategori)
                    <span class="text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full">{{ $news->kategori }}</span>
                @endif
                @if($news->tanggal_kegiatan)
                    <span class="text-xs text-gray-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $news->tanggal_kegiatan->format('d M Y') }}
                    </span>
                @endif
                @if($news->lokasi)
                    <span class="text-xs text-gray-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $news->lokasi }}
                    </span>
                @endif
            </div>

            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-emerald-800 leading-tight mb-8">{{ $news->judul }}</h1>

            {{-- Grid --}}
            <div class="lg:grid lg:grid-cols-3 lg:gap-12">

                {{-- MAIN KONTEN: ringkasan + konten berita dari DB, tombol kembali ke beranda --}}
                <article class="lg:col-span-2">

                    @if($news->ringkasan)
                        <div class="text-base text-emerald-700 font-medium mb-8 p-5 bg-emerald-50 rounded-xl border-l-4 border-emerald-500 leading-relaxed text-justify">
                            {{ $news->ringkasan }}
                        </div>
                    @endif

                    <div class="text-gray-700 leading-relaxed text-base space-y-4 text-justify">
                        {!! nl2br(e($news->konten)) !!}
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <a href="{{ url('/#berita-kegiatan') }}" class="text-gray-500 hover:text-emerald-600 transition-colors text-sm flex items-center gap-1.5 font-medium">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                            Kembali ke Berita
                        </a>
                    </div>
                </article>

                {{-- SIDEBAR: info detail kegiatan & CTA donasi --}}
                <aside class="mt-10 lg:mt-0">
                    <div class="sticky top-24 space-y-6">

                        {{-- INFO KEGIATAN: tanggal, lokasi, penyelenggara, kategori --}}
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
                                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Tanggal</p>
                                        <p class="text-sm font-bold text-emerald-700">{{ $news->tanggal_kegiatan->format('d F Y') }}</p>
                                    </div>
                                </div>
                                @endif
                                @if($news->lokasi)
                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Lokasi</p>
                                        <p class="text-sm font-bold text-emerald-700">{{ $news->lokasi }}</p>
                                    </div>
                                </div>
                                @endif
                                @if($news->penyelenggara)
                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Penyelenggara</p>
                                        <p class="text-sm font-bold text-emerald-700">{{ $news->penyelenggara }}</p>
                                    </div>
                                </div>
                                @endif
                                @if($news->kategori)
                                <div class="flex items-start gap-3">
                                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Kategori</p>
                                        <p class="text-sm font-bold text-emerald-700">{{ $news->kategori }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- CTA DONASI: card ajakan donasi, tombol mengarah ke #kampanye di halaman utama --}}
                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-xl p-6 text-white shadow-md">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                            </div>
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