<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }} - Salurkan Kebaikan Anda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- ════════════════════ NAVBAR ════════════════════ --}}
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
                <li><a href="#" class="font-bold text-emerald-700">Beranda</a></li>
                <li class="dropdown dropdown-hover">
                    <a tabindex="0" class="font-bold text-emerald-700">
                        Tentang Kami
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </a>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-xl min-w-[200px] z-[100] border border-emerald-200">
                        <li><a href="#tentang-kami" class="font-bold text-emerald-700">📖 Profil Yayasan</a></li>
                        <li><a href="#pendiri" class="font-bold text-emerald-700">👤 Pengurus</a></li>
                        <li><a href="#legalitas" class="font-bold text-emerald-700">📑 Legalitas & Struktur</a></li>
                    </ul>
                </li>
                <li><a href="#kampanye" class="font-bold text-emerald-700">❤️ Program Donasi</a></li>
                <li><a href="#program-ota" class="font-bold text-emerald-700">🤝 Orang Tua Asuh</a></li>
                <li><a href="#berita-kegiatan" class="font-bold text-emerald-700">📰 Berita</a></li>
            </ul>
        </div>

        <div class="navbar-end gap-2">
            <a href="{{ route('register') }}" class="btn btn-outline btn-success btn-sm font-bold hidden sm:inline-flex">Daftar</a>
            <a href="{{ route('login') }}" class="btn btn-success btn-sm font-bold text-white hidden sm:inline-flex">Masuk</a>
            <button onclick="toggleMobileMenu()" class="btn btn-ghost btn-square lg:hidden">
                <svg id="hamburger-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden absolute top-full left-0 right-0 bg-base-100 border-t border-emerald-100 shadow-lg lg:hidden">
            <ul class="menu menu-md p-4">
                <li><a href="#" class="font-bold text-emerald-800">🏠 Beranda</a></li>
                <li class="menu-title text-xs"><span>Tentang</span></li>
                <li><a href="#tentang-kami" class="text-emerald-700">📖 Profil Yayasan</a></li>
                <li><a href="#pendiri" class="text-emerald-700">👤 Pengurus</a></li>
                <li><a href="#legalitas" class="text-emerald-700">📑 Legalitas & Struktur</a></li>
                <li class="menu-title text-xs"><span>Program</span></li>
                <li><a href="#kampanye" class="text-emerald-700">❤️ Program Donasi</a></li>
                <li><a href="#program-ota" class="text-emerald-700">🤝 Orang Tua Asuh</a></li>
                <li><a href="#berita-kegiatan" class="text-emerald-700">📰 Berita</a></li>
                <li class="menu-divider"></li>
                <li><a href="{{ route('register') }}" class="font-bold text-emerald-700">📝 Daftar Donatur</a></li>
                <li><a href="{{ route('login') }}" class="font-bold text-emerald-700">🔑 Masuk</a></li>
            </ul>
        </div>
    </nav>

    <script>
        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
    </script>

    {{-- ════════════════════ HERO ════════════════════ --}}
    <header class="relative hero min-h-[65vh] lg:min-h-[75vh] overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1470&auto=format&fit=crop'); background-size: cover;">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/80 via-emerald-900/60 to-emerald-900/40"></div>
        </div>
        <div class="hero-content text-center max-w-4xl px-4 py-20 lg:py-28 relative z-10">
            <div>
                <span data-aos="fade-down" class="bg-white/90 border border-emerald-300 text-emerald-700 text-xs uppercase tracking-[0.2em] font-bold px-5 py-2 rounded-full inline-block mb-6 shadow-sm">
                    Jembatan Kebaikan Berkelanjutan
                </span>
                <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-[1.1] tracking-tight">
                    Salurkan <span class="text-emerald-300">Kebaikan</span>,<br>Ubah <span class="text-emerald-300">Masa Depan</span>
                </h1>
                <p data-aos="fade-up" data-aos-delay="200" class="text-base md:text-lg mt-6 max-w-2xl mx-auto text-white/80 font-medium leading-relaxed">
                    Setiap rupiah yang Anda salurkan memiliki kekuatan besar untuk mengukir senyuman dan masa depan mereka yang membutuhkan.
                </p>
                <div data-aos="fade-up" data-aos-delay="300" class="mt-10 flex flex-wrap justify-center gap-3">
                    <a href="#kampanye" class="btn btn-success text-white font-bold px-8 py-3.5 rounded-xl text-sm tracking-wide shadow-lg hover:shadow-xl transition-all">Lihat Program Donasi Aktif</a>
                    <a href="#program-ota" class="btn btn-outline border-white text-white font-bold px-8 py-3.5 rounded-xl text-sm tracking-wide bg-white/10 hover:bg-white hover:text-emerald-800 hover:border-white transition-all">🤝 Jadi Orang Tua Asuh</a>
                </div>
            </div>
        </div>
    </header>

    {{-- ════════════════════ TENTANG KAMI ════════════════════ --}}
    <section id="tentang-kami" class="relative py-20 lg:py-28 px-4 overflow-hidden">
        {{-- Background decorative --}}
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
                    <div data-aos="fade-up" class="relative bg-white rounded-2xl shadow-md border border-emerald-100 p-8 hover:shadow-lg transition-shadow">
                        <div class="absolute top-0 left-8 w-12 h-1 bg-emerald-500 rounded-full"></div>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center text-xl border border-emerald-100 flex-shrink-0">📖</div>
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

                    {{-- Visi & Misi side by side --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div data-aos="fade-up" data-aos-delay="100" class="relative bg-white rounded-2xl shadow-md border border-emerald-100 p-6 hover:shadow-lg transition-shadow group">
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent rounded-2xl pointer-events-none"></div>
                            <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center text-lg mb-4 border border-emerald-100 group-hover:bg-emerald-100 transition-colors">🎯</div>
                            <h4 class="text-base font-bold text-emerald-900 mb-3">Visi</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $profil?->visi ?? 'Menjadi lembaga pengasuhan anak yatim dan sosial yang amanah, transparan, serta profesional.' }}</p>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="150" class="relative bg-white rounded-2xl shadow-md border border-emerald-100 p-6 hover:shadow-lg transition-shadow group">
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent rounded-2xl pointer-events-none"></div>
                            <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center text-lg mb-4 border border-emerald-100 group-hover:bg-emerald-100 transition-colors">🚀</div>
                            <h4 class="text-base font-bold text-emerald-900 mb-3">Misi</h4>
                            <ul class="text-sm text-gray-600 leading-relaxed space-y-1.5 list-disc list-inside marker:text-emerald-500">
                                @php
                                    $misiList = $profil?->misi ? explode("\n", $profil->misi) : ['Memberikan pendidikan & fasilitas terbaik.', 'Mengelola amanah dengan transparansi.'];
                                @endphp
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
                    <div class="bg-white rounded-2xl shadow-md border border-emerald-100 p-6 hover:shadow-lg transition-shadow">
                        <h3 class="text-base font-bold text-emerald-900 mb-5 flex items-center gap-2">
                            <span class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-sm border border-emerald-100">📍</span>
                            Hubungi Kami
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center flex-shrink-0 text-sm border border-emerald-100">📍</div>
                                <div>
                                    <p class="text-[11px] text-emerald-600 font-bold uppercase tracking-wider">Alamat</p>
                                    <p class="text-sm text-gray-700 mt-0.5 leading-relaxed">{{ $profil?->alamat ?? 'Alamat belum diatur' }}</p>
                                </div>
                            </div>
                            <div class="border-t border-emerald-50"></div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center flex-shrink-0 text-sm border border-emerald-100">📞</div>
                                <div>
                                    <p class="text-[11px] text-emerald-600 font-bold uppercase tracking-wider">Telepon / WA</p>
                                    <p class="text-sm text-gray-700 mt-0.5 font-semibold">{{ $profil?->no_telp ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="border-t border-emerald-50"></div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center flex-shrink-0 text-sm border border-emerald-100">✉️</div>
                                <div>
                                    <p class="text-[11px] text-emerald-600 font-bold uppercase tracking-wider">Email</p>
                                    <p class="text-sm text-gray-700 mt-0.5">{{ $profil?->email ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Legalitas --}}
                    <div class="bg-white rounded-2xl shadow-md border border-emerald-100 p-6 hover:shadow-lg transition-shadow">
                        <h3 class="text-base font-bold text-emerald-900 mb-3 flex items-center gap-2">
                            <span class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-sm border border-emerald-100">🏛️</span>
                            Legalitas
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Informasi legalitas yayasan dapat dilihat pada bagian <a href="#legalitas" class="text-emerald-600 font-semibold underline underline-offset-2 hover:text-emerald-700">dokumen resmi</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════ PENGURUS ════════════════════ --}}
    @php $daftarPendiri = \App\Models\Pendiri::latest()->get(); @endphp
    <section id="pendiri" class="py-20 lg:py-28 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 inline-block mb-3 border border-emerald-200">Struktur Manajemen</span>
                <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight">Pengurus Yayasan</h2>
                <p class="text-gray-500 mt-2 text-sm">Amanah dan berdedikasi tinggi demi kemaslahatan para mustahik.</p>
            </div>

            @if($daftarPendiri->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 justify-center">
                    @foreach($daftarPendiri as $person)
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}" class="card bg-base-100 shadow-md border border-emerald-100 rounded-2xl p-6 text-center flex flex-col items-center hover:shadow-lg transition-shadow">
                            <div class="avatar">
                                <div class="w-20 rounded-full ring ring-emerald-100 ring-offset-2 mb-4">
                                    @if($person->foto)
                                        <img src="{{ asset('storage/' . $person->foto) }}" alt="{{ $person->nama }}">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($person->nama) }}&background=b3e093&color=5c8148&bold=true" alt="">
                                    @endif
                                </div>
                            </div>
                            <h3 class="text-base font-bold text-emerald-900">{{ $person->nama }}</h3>
                            <span class="badge badge-success badge-sm mt-1 mb-3">{{ $person->jabatan }}</span>
                            @if($person->deskripsi)
                                <p class="text-xs text-gray-500 italic leading-relaxed border-t border-emerald-50 pt-3">"{{ $person->deskripsi }}"</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-sm text-gray-400 border border-dashed rounded-xl max-w-md mx-auto">
                    Daftar pengurus yayasan belum dimasukkan oleh admin.
                </div>
            @endif
        </div>
    </section>

    {{-- ════════════════════ LEGALITAS & STRUKTUR ════════════════════ --}}
    <section id="legalitas" class="py-20 lg:py-28 px-4 bg-emerald-50">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 inline-block mb-3 border border-emerald-200">Transparansi</span>
                <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight">Legalitas & Struktur Organisasi</h2>
                <p class="text-gray-500 mt-2 text-sm">Dokumen resmi legalitas hukum dan struktur kepengurusan yayasan.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div data-aos="fade-right" class="card bg-base-100 shadow-md border border-emerald-100 rounded-2xl p-6">
                    <h3 class="text-base font-bold text-emerald-900 mb-4 flex items-center gap-2">📑 Dokumen Legalitas</h3>
                    @if($profil)
                        @if($profil->legalitas)<p class="text-sm text-gray-600 mb-4">{{ $profil->legalitas }}</p>@endif
                        @if($profil->foto_legalitas)
                            <a href="{{ asset('storage/' . $profil->foto_legalitas) }}" target="_blank">
                                <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" class="w-full h-auto max-h-[350px] object-contain rounded-lg border border-emerald-100 shadow-sm" alt="Dokumen Legalitas">
                            </a>
                        @else
                            <div class="py-14 text-center text-sm text-gray-400 border border-dashed rounded-xl">Dokumen legalitas belum diupload.</div>
                        @endif
                    @endif
                </div>
                <div data-aos="fade-left" class="card bg-base-100 shadow-md border border-emerald-100 rounded-2xl p-6">
                    <h3 class="text-base font-bold text-emerald-900 mb-4 flex items-center gap-2">📊 Struktur Organisasi</h3>
                    @if($profil?->foto_struktur)
                        <a href="{{ asset('storage/' . $profil->foto_struktur) }}" target="_blank">
                            <img src="{{ asset('storage/' . $profil->foto_struktur) }}" class="w-full h-auto max-h-[350px] object-contain rounded-lg border border-emerald-100 shadow-sm" alt="Struktur Organisasi">
                        </a>
                    @else
                        <div class="py-14 text-center text-sm text-gray-400 border border-dashed rounded-xl">Bagan struktur belum diupload.</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════ PROGRAM DONASI ════════════════════ --}}
    <section id="kampanye" class="py-20 lg:py-28 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 inline-block mb-3 border border-emerald-200">Donasi</span>
                <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight">Program Donasi Pilihan</h2>
                <p class="text-gray-500 mt-2 text-sm">Pilih dan salurkan donasi terbaik Anda dengan amanah & transparan.</p>
            </div>

            @if($campaigns->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($campaigns as $campaign)
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}" class="card bg-base-100 shadow-md border border-emerald-100 rounded-2xl overflow-hidden flex flex-col hover:shadow-lg transition-shadow">
                            @if($campaign->image)
                                <figure class="h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                                </figure>
                            @else
                                <div class="h-48 bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                                    <span class="text-4xl">❤️</span>
                                </div>
                            @endif
                            <div class="card-body p-5 flex flex-col flex-1">
                                <h3 class="font-bold text-base text-emerald-900 mb-2 line-clamp-2">{{ $campaign->title }}</h3>
                                <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 mb-4 flex-1">{{ $campaign->description }}</p>
                                @php $pct = $campaign->target_amount > 0 ? min(($campaign->collected_amount / $campaign->target_amount) * 100, 100) : 0; @endphp
                                <div class="mb-3">
                                    <div class="flex justify-between text-xs text-emerald-600 mb-1">
                                        <span class="font-semibold">{{ number_format($pct, 1) }}%</span>
                                        <span class="font-semibold">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }} / Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                    </div>
                                    <progress class="progress progress-success w-full h-2" value="{{ $pct }}" max="100"></progress>
                                </div>
                                <a href="{{ route('donations.create', $campaign->id) }}" class="btn btn-success text-white font-bold w-full mt-1">Donasi Sekarang</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-14 text-sm text-gray-400 border border-dashed rounded-xl max-w-md mx-auto">
                    Saat ini belum ada program donasi aktif yang dirilis.
                </div>
            @endif
        </div>
    </section>

    {{-- ════════════════════ ORANG TUA ASUH ════════════════════ --}}
    <section id="program-ota" class="py-20 lg:py-28 px-4 bg-emerald-50">
        <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
            <span class="bg-white/80 border border-emerald-300 text-emerald-700 text-xs uppercase tracking-[0.2em] font-bold px-5 py-2 rounded-full inline-block mb-4 shadow-sm">💚 Program Kebaikan Berkelanjutan</span>
            <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight">Program Orang Tua Asuh</h2>
            <p class="mt-4 text-sm text-emerald-700/70 font-medium max-w-xl mx-auto leading-relaxed">
                Jadilah orang tua asuh dan berikan masa depan yang lebih cerah bagi anak-anak yatim.
            </p>
            <div class="mt-8 bg-white/70 border border-emerald-200 rounded-2xl p-8 shadow-sm max-w-lg mx-auto">
                <span class="text-3xl block mb-3">🔒</span>
                <p class="text-sm text-emerald-700 font-semibold">Data anak asuh dan formulir pendaftaran</p>
                <p class="text-sm text-emerald-600">hanya tersedia untuk donatur yang sudah login.</p>
                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('register') }}" class="btn btn-success text-white font-bold px-6">Daftar Sekarang</a>
                    <a href="{{ route('login') }}" class="btn btn-outline btn-success font-bold px-6">Masuk</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════ BERITA KEGIATAN ════════════════════ --}}
    @if(isset($newsList) && $newsList->count() > 0)
    <section id="berita-kegiatan" class="py-20 lg:py-28 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 inline-block mb-3 border border-emerald-200">📰 Liputan Terkini</span>
                <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight">Berita & Kegiatan</h2>
                <p class="text-gray-500 mt-2 text-sm">Ikuti perkembangan program, kegiatan, dan laporan terbaru dari lapangan.</p>
            </div>

            <div data-aos="fade-up" class="news-carousel-outer relative px-6">
                <button class="btn btn-circle btn-outline btn-sm absolute top-1/2 -translate-y-1/2 z-10 left-0 lg:-left-5 bg-white border-emerald-400 text-emerald-700 hover:bg-emerald-700 hover:text-white hover:border-emerald-700 disabled:opacity-30 disabled:cursor-not-allowed disabled:pointer-events-none" id="news-prev" aria-label="Sebelumnya">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                </button>
                <div class="overflow-hidden">
                    <div class="flex gap-6 transition-transform duration-[450ms] ease-[cubic-bezier(0.4,0,0.2,1)] will-change-transform" id="news-track">
                        @foreach($newsList as $item)
                        <div class="news-slide flex-none w-full sm:w-1/2 lg:w-1/3 min-w-0">
                            <a href="{{ route('news.show', $item->slug) }}" class="card bg-base-100 shadow-md border border-emerald-100 rounded-2xl overflow-hidden flex flex-col h-full hover:shadow-lg transition-all group">
                                @if($item->foto_utama)
                                    <figure class="h-48 overflow-hidden">
                                        <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </figure>
                                @else
                                    <div class="h-48 bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                                        <span class="text-3xl">📰</span>
                                    </div>
                                @endif
                                <div class="p-5 flex flex-col flex-1">
                                    <span class="badge badge-success badge-sm mb-2">{{ $item->kategori }}</span>
                                    <h3 class="text-sm font-extrabold text-emerald-900 leading-snug mb-2 line-clamp-2 group-hover:text-emerald-600 transition-colors">{{ $item->judul }}</h3>
                                    <p class="text-xs text-gray-500 leading-relaxed flex-1 line-clamp-3 mb-4">
                                        {{ $item->ringkasan ?: \Illuminate\Support\Str::limit(strip_tags($item->konten), 120) }}
                                    </p>
                                    <div class="flex items-center justify-between text-[0.65rem] text-emerald-500 font-semibold border-t border-emerald-100 pt-3 mt-auto">
                                        <span>📅 {{ $item->tanggal_kegiatan->translatedFormat('d M Y') }}</span>
                                        @if($item->lokasi)<span>📍 {{ \Illuminate\Support\Str::limit($item->lokasi, 22) }}</span>@endif
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button class="btn btn-circle btn-outline btn-sm absolute top-1/2 -translate-y-1/2 z-10 right-0 lg:-right-5 bg-white border-emerald-400 text-emerald-700 hover:bg-emerald-700 hover:text-white hover:border-emerald-700 disabled:opacity-30 disabled:cursor-not-allowed disabled:pointer-events-none" id="news-next" aria-label="Berikutnya">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>

            <div class="flex justify-center gap-1.5 mt-7" id="news-dots"></div>
        </div>
    </section>
    @endif

    {{-- ════════════════════ FOOTER ════════════════════ --}}
    <footer class="bg-emerald-900">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2.5 mb-3">
                        @if($profil && $profil->logo)
                            <img src="{{ asset('storage/' . $profil->logo) }}" class="w-9 h-9 rounded-lg object-cover flex-shrink-0" alt="Logo">
                        @else
                            <span class="w-9 h-9 rounded-lg bg-emerald-800 flex items-center justify-center text-base flex-shrink-0">🌿</span>
                        @endif
                        <div>
                            <p class="text-sm font-bold text-emerald-100">{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</p>
                            <p class="text-[11px] text-emerald-400">Lembaga Sosial Amanah</p>
                        </div>
                    </div>
                    <p class="text-xs text-emerald-400 leading-relaxed">{{ $profil?->alamat ?? 'Alamat belum diatur' }}</p>
                </div>
                <div>
                    <p class="text-xs text-emerald-300 font-semibold uppercase tracking-wider mb-3">Kontak</p>
                    <ul class="space-y-2">
                        <li><a href="tel:{{ $profil?->no_telp }}" class="text-sm text-emerald-400 hover:text-emerald-200 transition-colors">📞 {{ $profil?->no_telp ?? '-' }}</a></li>
                        <li><a href="mailto:{{ $profil?->email }}" class="text-sm text-emerald-400 hover:text-emerald-200 transition-colors">✉️ {{ $profil?->email ?? '-' }}</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-xs text-emerald-300 font-semibold uppercase tracking-wider mb-3">Menu</p>
                    <ul class="space-y-1.5">
                        <li><a href="#tentang-kami" class="text-sm text-emerald-400 hover:text-emerald-200 transition-colors">Tentang Kami</a></li>
                        <li><a href="#kampanye" class="text-sm text-emerald-400 hover:text-emerald-200 transition-colors">Program Donasi</a></li>
                        <li><a href="#program-ota" class="text-sm text-emerald-400 hover:text-emerald-200 transition-colors">Orang Tua Asuh</a></li>
                        <li><a href="#berita-kegiatan" class="text-sm text-emerald-400 hover:text-emerald-200 transition-colors">Berita</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-xs text-emerald-300 font-semibold uppercase tracking-wider mb-3">Program</p>
                    <ul class="space-y-1.5">
                        <li class="text-sm text-emerald-400">Santunan Bulanan</li>
                        <li class="text-sm text-emerald-400">Beasiswa Yatim</li>
                        <li class="text-sm text-emerald-400">Orang Tua Asuh</li>
                        <li class="text-sm text-emerald-400">Renovasi Rumah</li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 pt-5 border-t border-emerald-800 text-center">
                <p class="text-xs text-emerald-500">&copy; {{ date('Y') }} {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}. Dikelola dengan penuh amanah & transparansi.</p>
            </div>
        </div>
    </footer>

    {{-- ════════════════════ SCRIPTS ════════════════════ --}}
    <script>
        window.addEventListener('scroll', function () {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 15) {
                nav.classList.add('shadow-md', 'border-b', 'border-emerald-100');
            } else {
                nav.classList.remove('shadow-md', 'border-b', 'border-emerald-100');
            }
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true, offset: 40 });</script>

    <script>
    (function () {
        const track    = document.getElementById('news-track');
        const dotsWrap = document.getElementById('news-dots');
        const btnPrev  = document.getElementById('news-prev');
        const btnNext  = document.getElementById('news-next');
        if (!track) return;
        const slides = Array.from(track.querySelectorAll('.news-slide'));
        if (slides.length === 0) return;
        let current = 0;

        function visibleCount() {
            return window.innerWidth >= 1024 ? 3 : window.innerWidth >= 640 ? 2 : 1;
        }
        function maxIndex() { return Math.max(0, slides.length - visibleCount()); }
        function buildDots() {
            dotsWrap.innerHTML = '';
            const total = maxIndex() + 1;
            for (let i = 0; i < total; i++) {
                const btn = document.createElement('button');
                btn.className = 'w-2 h-2 rounded-full bg-emerald-300 border-none cursor-pointer transition-all duration-300' + (i === current ? ' !w-6 !bg-emerald-700' : '');
                btn.addEventListener('click', () => goTo(i));
                dotsWrap.appendChild(btn);
            }
        }
        function updateDots() {
            Array.from(dotsWrap.children).forEach((d, i) => {
                d.className = 'w-2 h-2 rounded-full bg-emerald-300 border-none cursor-pointer transition-all duration-300' + (i === current ? ' !w-6 !bg-emerald-700' : '');
            });
        }
        function updateButtons() {
            btnPrev.disabled = current === 0;
            btnNext.disabled = current >= maxIndex();
        }
        function goTo(index) {
            current = Math.max(0, Math.min(index, maxIndex()));
            const slideEl = slides[0];
            const gap = 24;
            const slideW = slideEl.getBoundingClientRect().width;
            track.style.transform = `translateX(-${current * (slideW + gap)}px)`;
            updateDots();
            updateButtons();
        }
        btnPrev.addEventListener('click', () => goTo(current - 1));
        btnNext.addEventListener('click', () => goTo(current + 1));

        let timer = setInterval(() => { goTo(current >= maxIndex() ? 0 : current + 1); }, 4500);
        track.closest('.news-carousel-outer').addEventListener('mouseenter', () => clearInterval(timer));
        track.closest('.news-carousel-outer').addEventListener('mouseleave', () => {
            timer = setInterval(() => goTo(current >= maxIndex() ? 0 : current + 1), 4500);
        });

        let touchStartX = 0;
        track.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
        track.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) goTo(diff > 0 ? current + 1 : current - 1);
        });

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => { buildDots(); goTo(current); }, 150);
        });
        buildDots();
        updateButtons();
    })();
    </script>
</body>
</html>
