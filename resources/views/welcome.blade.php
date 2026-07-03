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


    {{-- Navbar --}}
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
                <li><a href="#" class="font-bold text-emerald-800 hover:text-emerald-950">Beranda</a></li>
                <li class="dropdown dropdown-hover">
                    <a tabindex="0" class="font-bold text-emerald-700">
                        Tentang Kami
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </a>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-xl min-w-[200px] z-[100] border border-emerald-200">
                        <li><a href="#tentang-kami" class="font-bold text-emerald-700"><span class="text-base">📖</span> Profil Yayasan</a></li>
                        <li class="menu-divider"></li>
                        <li><a href="#berkas-yayasan" class="font-bold text-emerald-700"><span class="text-base">📑</span> Legalitas & Struktur</a></li>
                        <li><a href="#pendiri" class="font-bold text-emerald-700"><span class="text-base">👤</span> Pengurus</a></li>
                    </ul>
                </li>
                <li class="dropdown dropdown-hover">
                    <a tabindex="0" class="font-bold text-emerald-600">
                        💚 Donasi
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6 6-6"/>
                        </svg>
                    </a>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-xl min-w-[200px] z-[100] border border-emerald-200">
                        <li><a href="#program-ota" class="font-bold text-emerald-700"><span class="text-base">🤝</span> Orang Tua Asuh</a></li>
                        <li class="menu-divider"></li>
                        <li><a href="#kampanye" class="font-bold text-emerald-700"><span class="text-base">❤️</span> Program Donasi</a></li>
                    </ul>
                </li>
                <li><a href="#berita-kegiatan" class="font-bold text-emerald-600">📰 Berita</a></li>
            </ul>
        </div>

        <div class="navbar-end gap-2">
            <a href="{{ route('register') }}" class="btn btn-outline btn-success btn-sm font-bold hidden sm:inline-flex">
                Daftar
            </a>
            <a href="{{ route('login') }}" class="btn btn-success btn-sm font-bold text-white hidden sm:inline-flex">
                Masuk
            </a>
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
                <li><a href="#berkas-yayasan" class="text-emerald-700">📑 Legalitas & Struktur</a></li>
                <li><a href="#pendiri" class="text-emerald-700">👤 Pengurus</a></li>
                <li class="menu-title text-xs"><span>Donasi</span></li>
                <li><a href="#program-ota" class="text-emerald-700">🤝 Orang Tua Asuh</a></li>
                <li><a href="#kampanye" class="text-emerald-700">❤️ Program Donasi</a></li>
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

    {{-- Hero --}}
    <header class="hero min-h-[60vh] lg:min-h-[70vh] bg-gradient-to-br from-emerald-100 via-emerald-50 to-white py-20 lg:py-28 px-4 text-center border-b border-emerald-100 overflow-hidden">
        <div class="max-w-3xl mx-auto">
            <span data-aos="fade-down" class="bg-white/70 border border-emerald-200 text-emerald-800 text-xs uppercase tracking-widest font-bold px-4 py-1.5 rounded-full inline-block mb-4 shadow-sm">
                Jembatan Kebaikan Berkelanjutan
            </span>
            <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-5xl font-extrabold mt-2 leading-tight tracking-tight text-emerald-900">
                Ubah Dunia Menjadi Lebih Baik Lewat Donasi Anda
            </h1>
            <p data-aos="fade-up" data-aos-delay="200" class="text-md md:text-lg mt-6 max-w-xl mx-auto font-medium text-emerald-800/80 leading-relaxed">
                Setiap rupiah yang Anda salurkan memiliki kekuatan besar untuk mengukir senyuman dan masa depan mereka yang membutuhkan.
            </p>
            <div data-aos="fade-up" data-aos-delay="300" class="mt-10 flex flex-wrap justify-center gap-3">
                <a href="#kampanye" class="btn btn-success text-white font-bold px-8 py-3.5 rounded-xl text-sm tracking-wide shadow-lg hover:shadow-xl transition-all">
                    Lihat Program Donasi Aktif
                </a>
                <a href="#program-ota"
                   class="btn btn-outline btn-success font-bold px-8 py-3.5 rounded-xl text-sm tracking-wide bg-white/60 hover:bg-emerald-700 hover:text-white hover:border-emerald-700 transition-all">
                    🤝 Jadi Orang Tua Asuh
                </a>
            </div>
        </div>
    </header>

    {{-- SECTION: TENTANG KAMI --}}
    <section id="tentang-kami" class="py-20 px-4 bg-emerald-50 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs uppercase tracking-widest font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-800 inline-block mb-3 border border-emerald-200 shadow-sm">
                    Mengenal Kami
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-emerald-950 tracking-tight">
                    Tentang {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}
                </h2>
                <p class="text-sm text-emerald-800/70 mt-3 max-w-xl mx-auto font-medium">
                    Mendedikasikan diri untuk memberikan pengasuhan, pendidikan, dan masa depan yang lebih cerah bagi anak-anak yatim.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <div class="lg:col-span-8 flex flex-col gap-6">
                    <div data-aos="fade-up" data-aos-delay="100" class="card bg-base-100 shadow-md border border-emerald-100 rounded-2xl p-8 md:p-10">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="text-2xl">📖</span>
                            <h3 class="text-xl font-bold text-emerald-950 tracking-tight">Sejarah & Rekam Jejak</h3>
                        </div>
                        <div class="text-gray-700 leading-relaxed text-justify text-base whitespace-pre-line font-normal">
                            {{ $profil?->sejarah_yayasan ?? 'Informasi sejarah belum diisi oleh administrator backend.' }}
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div data-aos="fade-up" data-aos-delay="200" class="card bg-base-100 shadow-md border-t-4 border-t-emerald-500 rounded-2xl p-8">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl mb-4 border border-emerald-100">🎯</div>
                            <h4 class="text-lg font-bold text-emerald-950 mb-2">Visi</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $profil?->visi ?? 'Menjadi lembaga pengasuhan anak yatim dan sosial yang amanah, transparan, serta profesional.' }}</p>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="300" class="card bg-base-100 shadow-md border-t-4 border-t-emerald-500 rounded-2xl p-8">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl mb-4 border border-emerald-100">🚀</div>
                            <h4 class="text-lg font-bold text-emerald-950 mb-2">Misi</h4>
                            <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $profil?->misi ?? "• Memberikan pendidikan & fasilitas terbaik.\n• Mengelola amanah dengan transparansi." }}</p>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 flex flex-col">
                    <div data-aos="fade-left" data-aos-delay="400" class="card bg-emerald-50 shadow-md border border-emerald-200 rounded-2xl p-8 h-full">
                        <h3 class="text-xl font-bold text-emerald-950 mb-8 border-b border-emerald-900/10 pb-4 flex items-center gap-2">
                            <span>📍</span> Hubungi Kami
                        </h3>
                        <div class="space-y-6">
                            <div>
                                <span class="block text-[11px] text-emerald-900/60 font-bold uppercase tracking-wider mb-1">Alamat Kantor</span>
                                <p class="text-sm text-emerald-950 font-medium leading-relaxed">{{ $profil?->alamat ?? 'Alamat belum diatur' }}</p>
                            </div>
                            <div>
                                <span class="block text-[11px] text-emerald-900/60 font-bold uppercase tracking-wider mb-1">Telepon / WhatsApp</span>
                                <p class="text-sm text-emerald-950 font-bold">{{ $profil?->no_telp ?? '-' }}</p>
                            </div>
                            <div>
                                <span class="block text-[11px] text-emerald-900/60 font-bold uppercase tracking-wider mb-1">Email Resmi</span>
                                <p class="text-sm text-emerald-950 font-medium">{{ $profil?->email ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="mt-8 pt-4 border-t border-emerald-900/10 text-center">
                            <p class="text-emerald-900/70 text-xs italic font-medium">"Pintu kami selalu terbuka untuk silaturahmi & kebaikan."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION: BERKAS --}}
    <section id="berkas-yayasan" class="bg-white border-y border-emerald-100/60 py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-xl mx-auto mb-16">
                <h2 class="text-3xl font-extrabold text-emerald-900 tracking-tight">Berkas Resmi & Transparansi</h2>
                <p class="text-gray-500 mt-2 text-sm">Dokumen resmi legalitas hukum dan kepegawaian yayasan.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div data-aos="fade-right" data-aos-delay="100" class="card bg-base-100 shadow-md border border-emerald-100 p-6 rounded-2xl">
                    <h3 class="text-lg font-bold text-emerald-900 mb-4 flex items-center gap-2">📑 Dokumen Surat Legalitas Resmi</h3>
                    @if($profil && $profil->foto_legalitas)
                        <div class="overflow-hidden rounded-xl border border-gray-100 bg-gray-50 p-2">
                            <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" alt="Legalitas" class="w-full h-auto max-h-[450px] object-contain mx-auto rounded-lg shadow-sm">
                        </div>
                    @else
                        <div class="py-16 text-center text-sm text-gray-400 border border-dashed rounded-xl">Foto dokumen legalitas belum diupload.</div>
                    @endif
                </div>
                <div data-aos="fade-left" data-aos-delay="200" class="card bg-base-100 shadow-md border border-emerald-100 p-6 rounded-2xl">
                    <h3 class="text-lg font-bold text-emerald-900 mb-4 flex items-center gap-2">📊 Bagan Struktur Organisasi</h3>
                    @if($profil && $profil->foto_struktur)
                        <div class="overflow-hidden rounded-xl border border-gray-100 bg-gray-50 p-2">
                            <img src="{{ asset('storage/' . $profil->foto_struktur) }}" alt="Struktur" class="w-full h-auto max-h-[450px] object-contain mx-auto rounded-lg shadow-sm">
                        </div>
                    @else
                        <div class="py-16 text-center text-sm text-gray-400 border border-dashed rounded-xl">Foto struktur organisasi belum diupload.</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION: PENDIRI --}}
    <section id="pendiri" class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs uppercase tracking-widest font-bold px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 inline-block mb-3">Struktur Manajemen</span>
                <h2 class="text-3xl font-extrabold text-emerald-900 tracking-tight">Pendiri & Tokoh Yayasan</h2>
                <p class="text-gray-500 mt-2 text-sm">Amanah dan berdedikasi tinggi demi kemaslahatan para mustahik.</p>
            </div>
            @php $daftarPendiri = \App\Models\Pendiri::latest()->get(); @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
                @forelse($daftarPendiri as $person)
                    <div class="card bg-base-100 shadow-md rounded-2xl p-6 text-center flex flex-col items-center">
                        <div class="avatar">
                            <div class="w-24 rounded-full ring ring-white ring-offset-2 ring-offset-emerald-50 mb-4">
                                <img src="{{ asset('storage/' . $person->foto) }}" alt="{{ $person->nama }}">
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-emerald-900">{{ $person->nama }}</h3>
                        <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mt-1 mb-3">{{ $person->jabatan }}</p>
                        @if($person->deskripsi)
                            <p class="text-xs text-gray-500 italic leading-relaxed border-t border-emerald-50 pt-3 mt-1">
                                "{{ $person->deskripsi }}"
                            </p>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center py-8 text-sm text-gray-400 border border-dashed rounded-xl max-w-md mx-auto w-full">
                        Daftar profil pendiri yayasan belum dimasukkan oleh admin.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ★★★ SECTION: PROGRAM ORANG TUA ASUH ★★★ --}}
    <section id="program-ota" class="py-24 px-4 border-t border-emerald-200/60 bg-gradient-to-br from-emerald-100 via-emerald-50 to-emerald-100">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-16">
                <span class="bg-white/70 border border-emerald-400 text-emerald-700 text-xs uppercase tracking-widest font-bold px-4 py-1.5 rounded-full inline-block mb-3 shadow-sm">
                    💚 Program Kebaikan Berkelanjutan
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight mt-2 text-emerald-700">
                    Program Orang Tua Asuh
                </h2>
                <p class="mt-3 text-sm font-medium leading-relaxed text-emerald-600">
                    Jadilah orang tua asuh bagi anak-anak kami. Dukungan rutin Anda memastikan mereka mendapat pendidikan,
                    gizi, dan masa depan yang layak. Pilih anak yang ingin Anda asuh di bawah ini.
                </p>
            </div>

            <div data-aos="fade-up" data-aos-delay="50" class="stats shadow bg-base-100 grid grid-cols-2 md:grid-cols-3 max-w-2xl mx-auto mb-14">
                <div class="stat py-5 text-center">
                    <p class="text-3xl font-extrabold text-emerald-700">{{ $fosterChildren->count() }}</p>
                    <p class="text-xs font-bold uppercase tracking-wider mt-1 text-emerald-600">Total Anak Asuh</p>
                </div>
                <div class="stat py-5 text-center">
                    <p class="text-3xl font-extrabold text-emerald-700">{{ $fosterChildren->where('status', 'Tersedia')->count() }}</p>
                    <p class="text-xs font-bold uppercase tracking-wider mt-1 text-emerald-600">Menunggu OTA</p>
                </div>
                <div class="stat py-5 text-center col-span-2 md:col-span-1">
                    <p class="text-3xl font-extrabold text-emerald-700">{{ $fosterChildren->where('status', '!=', 'Tersedia')->count() }}</p>
                    <p class="text-xs font-bold uppercase tracking-wider mt-1 text-emerald-600">Sedang Diasuh</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($fosterChildren as $child)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}" class="card bg-base-100 shadow-md border border-emerald-200 rounded-2xl overflow-hidden flex flex-col">
                        @if($child->photo)
                            <figure class="w-full h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $child->photo) }}"
                                     alt="Foto {{ $child->name }}"
                                     class="w-full h-full object-cover">
                            </figure>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-emerald-200 to-emerald-100 flex items-center justify-center">
                                <svg width="52" height="52" viewBox="0 0 24 24" fill="none"
                                     class="stroke-emerald-700 opacity-45"
                                     stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                        @endif
                        <div class="card-body p-5 flex-1 flex flex-col">
                            <div class="flex items-center justify-between mb-2 flex-wrap gap-1">
                                <span class="badge badge-soft text-xs gap-1">🗓 {{ $child->age }} Tahun</span>
                                @if($child->status == 'Tersedia')
                                    <span class="badge badge-success gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white inline-block"></span>
                                        Tersedia
                                    </span>
                                @else
                                    <span class="badge badge-ghost gap-1">Diasuh</span>
                                @endif
                            </div>
                            @if($child->jenis_kelamin)
                                @if($child->jenis_kelamin == 'Laki-laki')
                                    <span class="badge badge-info text-xs mb-2">♂ Laki-laki</span>
                                @else
                                    <span class="badge badge-secondary text-xs mb-2">♀ Perempuan</span>
                                @endif
                            @endif
                            <h3 class="font-bold text-base mb-2 text-emerald-700">{{ $child->name }}</h3>
                            @if($child->description)
                                <p class="text-xs leading-relaxed mb-4 line-clamp-3 text-emerald-600">{{ $child->description }}</p>
                            @else
                                <p class="text-xs italic mb-4 text-emerald-400">Belum ada cerita yang ditambahkan.</p>
                            @endif
                            @if($child->status == 'Tersedia')
                                <a href="{{ route('sponsor.form', $child->id) }}" class="btn btn-success w-full mt-auto">🤝 Asuh Sekarang</a>
                            @else
                                <span class="btn btn-disabled w-full mt-auto">✓ Sudah Diasuh</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 rounded-2xl border-2 border-dashed border-emerald-400">
                        <p class="font-bold text-base mb-1 text-emerald-700">Belum ada data anak asuh</p>
                        <p class="text-sm text-emerald-600">Admin belum menambahkan data anak ke dalam sistem.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @if(isset($newsList) && $newsList->count() > 0)
    <section id="berita-kegiatan" class="py-24 px-4 bg-white border-t border-b border-emerald-100/50">
        <div class="max-w-7xl mx-auto">

            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs uppercase tracking-widest font-bold px-4 py-1.5 rounded-full inline-block mb-3 shadow-sm bg-emerald-100/50 border border-emerald-400 text-emerald-700">
                    📰 Liputan Terkini
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight mt-2 text-emerald-700">
                    Berita & Kegiatan Yayasan
                </h2>
                <p class="mt-3 text-sm font-medium leading-relaxed text-emerald-600">
                    Ikuti perkembangan program, kegiatan, dan laporan terbaru dari lapangan.
                </p>
            </div>

            <div data-aos="fade-up" data-aos-delay="100" class="news-carousel-outer relative px-6">
                <button class="btn btn-circle btn-outline btn-sm absolute top-1/2 -translate-y-1/2 z-10 left-0 lg:-left-5 bg-white border-emerald-400 text-emerald-700 hover:bg-emerald-700 hover:text-white hover:border-emerald-700 disabled:opacity-30 disabled:cursor-not-allowed disabled:pointer-events-none" id="news-prev" aria-label="Sebelumnya">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </button>

                <div class="overflow-hidden">
                    <div class="flex gap-6 transition-transform duration-[450ms] ease-[cubic-bezier(0.4,0,0.2,1)] will-change-transform" id="news-track">
                        @foreach($newsList as $item)
                        <div class="news-slide flex-none w-full sm:w-1/2 lg:w-1/3 min-w-0">
                            <div class="card bg-base-100 shadow-md border border-emerald-100/45 rounded-2xl overflow-hidden flex flex-col h-full">
                                @if($item->foto_utama)
                                    <figure class="w-full h-48 overflow-hidden">
                                        <img src="{{ asset('storage/' . $item->foto_utama) }}"
                                             alt="{{ $item->judul }}"
                                             class="w-full h-full object-cover bg-gradient-to-br from-emerald-200 to-emerald-100">
                                    </figure>
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-emerald-200 to-emerald-100 flex items-center justify-center shrink-0">
                                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none"
                                             class="stroke-emerald-700 opacity-40"
                                             stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <path d="m21 15-5-5L5 21"/>
                                        </svg>
                                    </div>
                                @endif

                                <div class="p-5 flex-1 flex flex-col">
                                    <span class="badge badge-soft text-[0.68rem] uppercase tracking-wider mb-2.5">{{ $item->kategori }}</span>
                                    <h3 class="text-[0.95rem] font-extrabold text-emerald-700 leading-tight mb-2 line-clamp-2">{{ $item->judul }}</h3>
                                    <p class="text-xs text-emerald-600 leading-relaxed flex-1 line-clamp-3 mb-4">
                                        {{ $item->ringkasan ?: \Illuminate\Support\Str::limit(strip_tags($item->konten), 120) }}
                                    </p>
                                    <div class="flex items-center justify-between text-[0.72rem] text-emerald-400 font-semibold border-t border-emerald-100/40 pt-3 mt-auto">
                                        <span>📅 {{ $item->tanggal_kegiatan->translatedFormat('d M Y') }}</span>
                                        @if($item->lokasi)
                                            <span>📍 {{ \Illuminate\Support\Str::limit($item->lokasi, 22) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button class="btn btn-circle btn-outline btn-sm absolute top-1/2 -translate-y-1/2 z-10 right-0 lg:-right-5 bg-white border-emerald-400 text-emerald-700 hover:bg-emerald-700 hover:text-white hover:border-emerald-700 disabled:opacity-30 disabled:cursor-not-allowed disabled:pointer-events-none" id="news-next" aria-label="Berikutnya">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </button>
            </div>

            <div class="flex justify-center gap-1.5 mt-7" id="news-dots"></div>

        </div>
    </section>
    @endif

    {{-- SECTION: KAMPANYE DONASI --}}
    <main id="kampanye" class="bg-white border-t border-emerald-100/60 py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-xl mx-auto mb-16">
                <h2 class="text-3xl font-extrabold text-emerald-900 tracking-tight">Program Donasi Pilihan</h2>
                <p class="text-gray-500 mt-2 text-sm">Pilih dan salurkan donasi terbaik Anda dengan amanah & transparan.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($campaigns as $campaign)
                    <div class="card bg-base-100 shadow-md border border-emerald-100/40 rounded-2xl overflow-hidden flex flex-col justify-between">
                        <figure class="h-52 w-full overflow-hidden bg-gray-50 border-b border-gray-100">
                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                        </figure>
                        <div class="card-body p-6">
                            <h3 class="font-bold text-lg line-clamp-2 min-h-[3.5rem] mb-2 text-emerald-900">{{ $campaign->title }}</h3>
                            <p class="text-xs line-clamp-3 mb-6 text-gray-500 leading-relaxed">{{ $campaign->description }}</p>
                            @php
                                $percentage = $campaign->target_amount > 0 ? ($campaign->collected_amount / $campaign->target_amount) * 100 : 0;
                                $percentage = min($percentage, 100);
                            @endphp
                            <progress class="progress progress-success w-full mb-4" value="{{ $percentage }}" max="100"></progress>
                            <div class="flex justify-between items-center text-xs mb-6">
                                <div>
                                    <span class="text-gray-400 block">Terkumpul</span>
                                    <span class="font-bold text-emerald-900 text-sm">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-gray-400 block">Target</span>
                                    <span class="font-bold text-emerald-900 text-sm">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('donations.create', $campaign->id) }}" class="btn btn-outline btn-success w-full text-xs font-bold">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-sm text-gray-400 border border-dashed rounded-xl max-w-md mx-auto w-full">
                        Saat ini belum ada program donasi aktif yang dirilis.
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <footer class="footer footer-center bg-base-100 border-t border-emerald-100 p-10 text-base-content">
        <div class="max-w-7xl mx-auto space-y-3">
            <p class="font-bold text-base text-emerald-900">{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</p>
            <p class="text-gray-500 max-w-md mx-auto leading-relaxed text-sm">{{ $profil?->alamat ?? 'Alamat kantor belum diatur' }}</p>
            <div class="pt-6 mt-6 border-t border-gray-100 text-gray-400 text-xs">
                <p>&copy; {{ date('Y') }} {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}. Seluruh Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

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
    <script>
        AOS.init({ duration: 800, once: true, offset: 50 });
    </script>

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
            if (window.innerWidth >= 1024) return 3;
            if (window.innerWidth >= 640)  return 2;
            return 1;
        }

        function maxIndex() {
            return Math.max(0, slides.length - visibleCount());
        }

        function buildDots() {
            dotsWrap.innerHTML = '';
            const total = maxIndex() + 1;
            for (let i = 0; i < total; i++) {
                const btn = document.createElement('button');
                btn.className = 'w-2 h-2 rounded-full bg-emerald-200 border-none cursor-pointer transition-all duration-300' + (i === current ? ' !w-6 !bg-emerald-700' : '');
                btn.setAttribute('aria-label', 'Slide ' + (i + 1));
                btn.addEventListener('click', () => goTo(i));
                dotsWrap.appendChild(btn);
            }
        }

        function updateDots() {
            Array.from(dotsWrap.children).forEach((d, i) => {
                d.className = 'w-2 h-2 rounded-full bg-emerald-200 border-none cursor-pointer transition-all duration-300' + (i === current ? ' !w-6 !bg-emerald-700' : '');
            });
        }

        function updateButtons() {
            btnPrev.disabled = current === 0;
            btnNext.disabled = current >= maxIndex();
        }

        function goTo(index) {
            current = Math.max(0, Math.min(index, maxIndex()));

            const slideEl   = slides[0];
            const gap       = 24;
            const slideW    = slideEl.getBoundingClientRect().width;
            const offset    = current * (slideW + gap);

            track.style.transform = `translateX(-${offset}px)`;
            updateDots();
            updateButtons();
        }

        btnPrev.addEventListener('click', () => goTo(current - 1));
        btnNext.addEventListener('click', () => goTo(current + 1));

        let timer = setInterval(() => {
            goTo(current >= maxIndex() ? 0 : current + 1);
        }, 5000);

        track.closest('.news-carousel-outer').addEventListener('mouseenter', () => clearInterval(timer));
        track.closest('.news-carousel-outer').addEventListener('mouseleave', () => {
            timer = setInterval(() => goTo(current >= maxIndex() ? 0 : current + 1), 5000);
        });

        let touchStartX = 0;
        track.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
        track.addEventListener('touchend',   e => {
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