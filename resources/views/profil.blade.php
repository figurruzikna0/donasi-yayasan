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

    {{-- HEADER --}}
    <section class="relative py-20 lg:py-28 px-4 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 via-white to-emerald-50/60 pointer-events-none"></div>
        <div class="absolute top-0 left-0 w-72 h-72 bg-emerald-100/40 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-100/30 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-7xl mx-auto relative">
            <div data-aos="fade-up" class="text-center max-w-3xl mx-auto mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 inline-block mb-3 border border-emerald-200">Mengenal Kami</span>
                <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight">Tentang {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</h2>
                <p class="text-emerald-700/70 mt-3 max-w-2xl mx-auto">Mendedikasikan diri untuk memberikan pengasuhan, pendidikan, dan masa depan yang lebih cerah bagi anak-anak yatim.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

                {{-- LEFT: Sejarah + Visi Misi (3/5) --}}
                <div class="lg:col-span-3 flex flex-col gap-6">
                    {{-- Sejarah --}}
                    <div data-aos="fade-up" class="relative bg-white rounded-2xl shadow-sm border border-emerald-100 p-8">
                        <div class="absolute top-0 left-8 w-12 h-1 bg-emerald-500 rounded-full"></div>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center text-xl flex-shrink-0">📖</div>
                            <div>
                                <h3 class="text-lg font-bold text-emerald-900">Sejarah & Rekam Jejak</h3>
                                <p class="text-xs text-emerald-500">Perjalanan panjang penuh kebermanfaatan</p>
                            </div>
                        </div>
                        <div class="border-l-2 border-emerald-100 pl-5">
                            <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                                {{ $profil?->sejarah_yayasan ?? 'Informasi sejarah belum diisi oleh administrator backend.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Visi & Misi --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div data-aos="fade-up" data-aos-delay="100" class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6 group">
                            <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center text-lg mb-4 group-hover:bg-emerald-100 transition-colors">🎯</div>
                            <h4 class="text-base font-bold text-emerald-900 mb-3">Visi</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $profil?->visi ?? 'Belum diatur' }}</p>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="150" class="bg-white rounded-2xl shadow-sm border border-emerald-100 p-6 group">
                            <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center text-lg mb-4 group-hover:bg-emerald-100 transition-colors">🚀</div>
                            <h4 class="text-base font-bold text-emerald-900 mb-3">Misi</h4>
                            <ul class="text-sm text-gray-600 leading-relaxed space-y-1.5 list-disc list-inside marker:text-emerald-400">
                                @php $misiList = $profil?->misi ? explode("\n", $profil->misi) : []; @endphp
                                @foreach($misiList as $m)
                                    <li>{{ ltrim($m, '• ') }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Kontak + Legalitas (2/5) --}}
                <div data-aos="fade-left" class="lg:col-span-2 flex flex-col gap-6">
                    {{-- Kontak --}}
                    <div class="bg-emerald-50 rounded-2xl border border-emerald-200 p-6">
                        <h3 class="text-base font-bold text-emerald-900 mb-5 flex items-center gap-2">
                            <span class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-sm shadow-sm">📍</span>
                            Hubungi Kami
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center flex-shrink-0 text-sm shadow-sm">📍</div>
                                <div class="flex-1">
                                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Alamat</p>
                                    <p class="text-sm text-gray-700 mt-0.5 leading-relaxed">{{ $profil?->alamat ?? 'Alamat belum diatur' }}</p>
                                    <p class="text-xs text-emerald-500 mt-1">Patokan: Gudang Rongsok Cimenteng</p>
                                    <a href="https://maps.app.goo.gl/FQatKLZU39dm6zNr7?g_st=aw" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 mt-2 text-xs font-semibold text-emerald-600 bg-white border border-emerald-200 px-3 py-1.5 rounded-lg hover:bg-emerald-100 transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        Buka di Google Maps
                                    </a>
                                </div>
                            </div>
                            <div class="border-t border-emerald-200"></div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center flex-shrink-0 text-sm shadow-sm">📞</div>
                                <div>
                                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Telepon / WA</p>
                                    <p class="text-sm text-gray-700 mt-0.5">{{ $profil?->no_telp ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="border-t border-emerald-200"></div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center flex-shrink-0 text-sm shadow-sm">✉️</div>
                                <div>
                                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Email</p>
                                    <p class="text-sm text-gray-700 mt-0.5">{{ $profil?->email ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Legalitas --}}
                    <div class="bg-emerald-50 rounded-2xl border border-emerald-200 p-6">
                        <h3 class="text-base font-bold text-emerald-900 mb-3 flex items-center gap-2">
                            <span class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-sm shadow-sm">🏛️</span>
                            Legalitas
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Informasi legalitas yayasan dapat dilihat pada bagian <a href="{{ route('legalitas') }}" class="text-emerald-600 font-semibold underline underline-offset-2 hover:text-emerald-700">dokumen resmi</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    @include('partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true, offset: 40 });</script>
</body>
</html>
