<!DOCTYPE html>
<html lang="id" data-theme="baitul">
<head>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Yayasan - {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- NAVBAR --}}
    @include('partials.public-navbar')

    {{-- HERO PROFIL: banner profil yayasan dengan tejudul, tombol Donasi & Orang Tua Asuh --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-emerald-900 via-emerald-800 to-emerald-700 text-white">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-300/30 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-emerald-200/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 right-1/4 w-48 h-48 bg-emerald-100/10 rounded-full blur-2xl"></div>
        </div>
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 relative">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
                <div class="flex-1 text-center lg:text-left" data-aos="fade-right">
                    <span class="inline-block text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-white/10 text-white/80 border border-white/20 mb-5">
                        Mengenal Kami
                    </span>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-tight">
                        Tentang {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}
                    </h1>
                    <p class="text-emerald-100/80 mt-4 max-w-xl text-base leading-relaxed">
                        Simak perjalanan, visi, dan misi kami dalam mendampingi generasi penerus bangsa.
                    </p>
                    <div class="flex flex-wrap gap-3 mt-7 justify-center lg:justify-start">
                        <a href="{{ url('/#kampanye-donasi') }}" class="inline-flex items-center gap-2 bg-white text-emerald-800 font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl hover:bg-emerald-50 transition-all text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Donasi Sekarang
                        </a>
                        <a href="{{ url('/#program-ota') }}" class="inline-flex items-center gap-2 bg-emerald-600/30 text-white border border-white/20 font-bold px-6 py-3 rounded-xl hover:bg-emerald-600/50 transition-all text-sm backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Jadi Orang Tua Asuh
                        </a>
                    </div>
                </div>
                <div class="flex-1 w-full max-w-md" data-aos="fade-left">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl border border-white/10 p-5 text-center">
                            <div class="text-3xl font-black">50+</div>
                            <div class="text-xs text-emerald-200/70 mt-1 font-semibold">Anak Yatim</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl border border-white/10 p-5 text-center">
                            <div class="text-3xl font-black">5</div>
                            <div class="text-xs text-emerald-200/70 mt-1 font-semibold">Program Aktif</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl border border-white/10 p-5 text-center">
                            <div class="text-3xl font-black">200+</div>
                            <div class="text-xs text-emerald-200/70 mt-1 font-semibold">Donatur Tetap</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl border border-white/10 p-5 text-center">
                            <div class="text-3xl font-black">2015</div>
                            <div class="text-xs text-emerald-200/70 mt-1 font-semibold">Berdiri Sejak</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-16 lg:py-20 px-4 bg-emerald-50">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

                {{-- SEJARAH & VISI MISI: konten dari DB ($profil->sejarah_yayasan, visi, misi) --}}
                <div class="lg:col-span-3 flex flex-col gap-8">
                    {{-- Sejarah --}}
                    <div data-aos="fade-up">
                        <div class="flex items-center gap-3 mb-5">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <div>
                                <h3 class="text-lg font-bold text-emerald-900">Sejarah & Rekam Jejak</h3>
                                <p class="text-xs text-emerald-500 mt-0.5">Perjalanan panjang penuh kebermanfaatan</p>
                            </div>
                        </div>
                        <div class="ml-8 pl-5 border-l-2 border-emerald-200">
                            <p class="text-gray-600 leading-[1.8] whitespace-pre-line">
                                {{ $profil?->sejarah_yayasan ?? 'Informasi sejarah belum diisi oleh administrator backend.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Visi & Misi --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div data-aos="fade-up" data-aos-delay="100" class="bg-white rounded-xl border border-emerald-100/70 p-6">
                            <svg class="w-[18px] h-[18px] text-emerald-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <h4 class="text-sm font-bold text-emerald-900 mb-2">Visi</h4>
                            <p class="text-sm text-gray-600 leading-[1.7]">{{ $profil?->visi ?? 'Belum diatur' }}</p>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="150" class="bg-white rounded-xl border border-emerald-100/70 p-6">
                            <svg class="w-[18px] h-[18px] text-emerald-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <h4 class="text-sm font-bold text-emerald-900 mb-2">Misi</h4>
                            <ul class="text-sm text-gray-600 leading-[1.8] space-y-1.5">
                                @php $misiList = $profil?->misi ? explode("\n", $profil->misi) : []; @endphp
                                @foreach($misiList as $m)
                                    <li class="flex items-start gap-2">
                                        <svg class="w-3.5 h-3.5 text-emerald-400 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg>
                                        <span>{{ ltrim($m, '• ') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- KONTAK & LEGALITAS: alamat, telepon, email dari DB + link ke halaman legalitas --}}
                <div data-aos="fade-left" class="lg:col-span-2 flex flex-col gap-6">
                    {{-- Kontak --}}
                    <div class="bg-white rounded-xl border border-emerald-100/70 p-6">
                        <h3 class="text-sm font-bold text-emerald-900 mb-5 flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Hubungi Kami
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-emerald-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <div>
                                    <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Alamat</p>
                                    <p class="text-sm text-gray-600 mt-0.5 leading-relaxed">{{ $profil?->alamat ?? 'Alamat belum diatur' }}</p>
                                    <a href="https://maps.app.goo.gl/FQatKLZU39dm6zNr7?g_st=aw" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 mt-2 text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        Buka di Google Maps
                                    </a>
                                </div>
                            </div>
                            <div class="border-t border-emerald-100"></div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-emerald-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <div>
                                    <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Telepon / WA</p>
                                    <p class="text-sm text-gray-600 mt-0.5">{{ $profil?->no_telp ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="border-t border-emerald-100"></div>
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-emerald-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <div>
                                    <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Email</p>
                                    <p class="text-sm text-gray-600 mt-0.5">{{ $profil?->email ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Legalitas --}}
                    <div class="bg-white rounded-xl border border-emerald-100/70 p-6">
                        <h3 class="text-sm font-bold text-emerald-900 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            Legalitas
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Informasi legalitas yayasan dapat dilihat pada bagian <a href="{{ route('legalitas') }}" class="text-emerald-600 font-semibold underline underline-offset-2 hover:text-emerald-700">dokumen resmi</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER: partial footer yayasan --}}
    @include('partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true, offset: 40 });</script>
</body>
</html>
