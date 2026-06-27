<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }} - Salurkan Kebaikan Anda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        :root {
            --celadon:       #b3e093;
            --lime-cream:    #d6ec89;
            --muted-olive:   #a1c181;
            --muted-olive-2: #8bb650;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
            --bg-light:      #f7fdf3;
        }

        body {
            background-color: var(--bg-light);
            color: var(--fern);
        }

        .custom-nav {
            background-color: rgba(247, 253, 243, 0.9);
            backdrop-filter: blur(12px);
        }
        .custom-nav.scrolled {
            border-bottom: 1px solid var(--celadon);
            box-shadow: 0 4px 20px rgba(92, 129, 72, 0.06);
        }
        
        .hero-section {
            background: linear-gradient(175deg, var(--lime-cream) 0%, var(--celadon) 60%, #edf9e3 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--muted-olive-2) 0%, var(--sage-green) 100%);
            color: #ffffff;
            box-shadow: 0 4px 16px rgba(92, 129, 72, 0.25);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--sage-green) 0%, var(--fern) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(92, 129, 72, 0.35);
        }

        .pro-card {
            background-color: #ffffff;
            border: 1px solid rgba(179, 224, 147, 0.4);
            box-shadow: 0 10px 30px rgba(92, 129, 72, 0.04);
            transition: all 0.3s ease;
        }
        .pro-card:hover {
            box-shadow: 0 15px 35px rgba(92, 129, 72, 0.09);
            border-color: var(--muted-olive);
        }

        .btn-outline {
            background-color: transparent;
            border: 1.5px solid var(--sage-green);
            color: var(--sage-green);
            transition: all 0.25s ease;
        }
        .btn-outline:hover {
            background: linear-gradient(135deg, var(--muted-olive-2), var(--sage-green));
            border-color: transparent;
            color: #ffffff;
        }

        /* ── OTA Section ── */
        .ota-section {
            background: linear-gradient(160deg, #eafcd4 0%, var(--lime-cream) 45%, var(--celadon) 100%);
        }

        .ota-card {
            background-color: #ffffff;
            border: 1px solid var(--celadon);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(92, 129, 72, 0.08);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .ota-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 36px rgba(92, 129, 72, 0.16);
            border-color: var(--muted-olive);
        }

        .ota-card-photo {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background-color: var(--celadon);
        }

        .ota-card-photo-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--celadon) 0%, var(--lime-cream) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ota-card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .ota-age-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background-color: var(--celadon);
            color: var(--fern);
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 9999px;
            border: 1px solid var(--muted-olive);
            margin-bottom: 10px;
        }

        .ota-status-available {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background-color: var(--celadon);
            color: var(--fern);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 9999px;
            border: 1px solid var(--muted-olive);
        }
        .ota-status-available::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background-color: var(--sage-green);
            display: inline-block;
        }

        .ota-status-taken {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background-color: var(--fern);
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 9999px;
        }
        .ota-status-taken::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.6);
            display: inline-block;
        }

        .btn-ota {
            display: block;
            text-align: center;
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--muted-olive-2) 0%, var(--sage-green) 100%);
            color: #ffffff;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 3px 10px rgba(92, 129, 72, 0.22);
            margin-top: auto;
        }
        .btn-ota:hover {
            background: linear-gradient(135deg, var(--sage-green) 0%, var(--fern) 100%);
            box-shadow: 0 5px 16px rgba(92, 129, 72, 0.32);
            transform: translateY(-1px);
        }
        .btn-ota-disabled {
            display: block;
            text-align: center;
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            background: #e8f5d9;
            color: var(--muted-olive);
            border: 1.5px solid var(--celadon);
            cursor: not-allowed;
            margin-top: auto;
        }

        /* OTA section header accent */
        .ota-section-badge {
            background: rgba(255,255,255,0.7);
            border: 1px solid var(--muted-olive);
            color: var(--fern);
        }
    </style>
</head>
<body class="font-sans antialiased">

    {{-- Navbar --}}
    <nav id="navbar" class="custom-nav sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    @if($profil && $profil->logo)
                        <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo" class="h-9 w-9 rounded-full object-cover border border-emerald-200 shadow-sm">
                    @else
                        <span class="text-2xl">🌿</span>
                    @endif
                    <span class="text-xl font-extrabold tracking-wide" style="color: var(--fern);">
                        {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}
                    </span>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#" class="text-sm font-bold text-emerald-800">Beranda</a>
                    <a href="#tentang-kami" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 transition">Tentang Kami</a>
                    <a href="#berkas-yayasan" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 transition">Legalitas & Struktur</a>
                    <a href="#pendiri" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 transition">Pengurus</a>

                    {{-- ★ Tombol baru Program OTA ★ --}}
                    <a href="#program-ota"
                       class="text-sm font-bold px-4 py-1.5 rounded-full transition"
                       style="background: linear-gradient(135deg, var(--muted-olive-2), var(--sage-green)); color:#ffffff; box-shadow: 0 2px 8px rgba(92,129,72,0.25);"
                       onmouseover="this.style.background='linear-gradient(135deg,var(--sage-green),var(--fern))'"
                       onmouseout="this.style.background='linear-gradient(135deg,var(--muted-olive-2),var(--sage-green))'">
                        🤝 Program OTA
                    </a>

                    <a href="#kampanye" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 transition">Program Donasi</a>
                    <a href="{{ route('admin.dashboard') }}" class="border border-emerald-600 text-emerald-700 text-xs px-4 py-2 rounded-xl font-bold shadow-sm hover:bg-emerald-600 hover:text-white transition">
                        Dashboard Admin →
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <header class="hero-section py-28 px-4 text-center border-b border-emerald-100 overflow-hidden">
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
                <a href="#kampanye" class="btn-primary font-bold px-8 py-3.5 rounded-xl inline-block text-sm tracking-wide">
                    Lihat Program Donasi Aktif
                </a>
                <a href="#program-ota"
                   class="font-bold px-8 py-3.5 rounded-xl inline-block text-sm tracking-wide border-2 transition"
                   style="border-color: var(--fern); color: var(--fern); background: rgba(255,255,255,0.6);"
                   onmouseover="this.style.background='var(--fern)';this.style.color='#fff'"
                   onmouseout="this.style.background='rgba(255,255,255,0.6)';this.style.color='var(--fern)'">
                    🤝 Jadi Orang Tua Asuh
                </a>
            </div>
        </div>
    </header>

    {{-- SECTION: TENTANG KAMI --}}
    <section id="tentang-kami" class="relative py-20 bg-[#f7fdf3] overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
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
                    <div data-aos="fade-up" data-aos-delay="100" class="bg-white p-8 md:p-10 rounded-2xl border border-emerald-100 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="text-2xl">📖</span>
                            <h3 class="text-xl font-bold text-emerald-950 tracking-tight">Sejarah & Rekam Jejak</h3>
                        </div>
                        <div class="text-gray-700 leading-relaxed text-justify text-base whitespace-pre-line font-normal">
                            {{ $profil?->sejarah_yayasan ?? 'Informasi sejarah belum diisi oleh administrator backend.' }}
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div data-aos="fade-up" data-aos-delay="200" class="bg-white p-8 rounded-2xl border border-emerald-100 shadow-sm border-t-4 border-t-emerald-500">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl mb-4 border border-emerald-100">🎯</div>
                            <h4 class="text-lg font-bold text-emerald-950 mb-2">Visi</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $profil?->visi ?? 'Menjadi lembaga pengasuhan anak yatim dan sosial yang amanah, transparan, serta profesional.' }}</p>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="300" class="bg-white p-8 rounded-2xl border border-emerald-100 shadow-sm border-t-4 border-t-emerald-500">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl mb-4 border border-emerald-100">🚀</div>
                            <h4 class="text-lg font-bold text-emerald-950 mb-2">Misi</h4>
                            <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $profil?->misi ?? "• Memberikan pendidikan & fasilitas terbaik.\n• Mengelola amanah dengan transparansi." }}</p>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 flex flex-col">
                    <div data-aos="fade-left" data-aos-delay="400" class="rounded-2xl p-8 shadow-sm border border-[#b3e093] h-full" style="background: linear-gradient(175deg, var(--lime-cream) 0%, var(--celadon) 100%);">
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
    <section id="berkas-yayasan" class="bg-white border-y border-emerald-100/60 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-aos="fade-up" class="text-center max-w-xl mx-auto mb-16">
                <h2 class="text-3xl font-extrabold text-emerald-900 tracking-tight">Berkas Resmi & Transparansi</h2>
                <p class="text-gray-500 mt-2 text-sm">Dokumen resmi legalitas hukum dan kepegawaian yayasan.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div data-aos="fade-right" data-aos-delay="100" class="pro-card p-6 rounded-2xl">
                    <h3 class="text-lg font-bold text-emerald-900 mb-4 flex items-center gap-2">📑 Dokumen Surat Legalitas Resmi</h3>
                    @if($profil && $profil->foto_legalitas)
                        <div class="overflow-hidden rounded-xl border border-gray-100 bg-gray-50 p-2">
                            <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" alt="Legalitas" class="w-full h-auto max-h-[450px] object-contain mx-auto rounded-lg shadow-sm">
                        </div>
                    @else
                        <div class="py-16 text-center text-sm text-gray-400 border border-dashed rounded-xl">Foto dokumen legalitas belum diupload.</div>
                    @endif
                </div>
                <div data-aos="fade-left" data-aos-delay="200" class="pro-card p-6 rounded-2xl">
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
    <section id="pendiri" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs uppercase tracking-widest font-bold px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 inline-block mb-3">Struktur Manajemen</span>
            <h2 class="text-3xl font-extrabold text-emerald-900 tracking-tight">Pendiri & Tokoh Yayasan</h2>
            <p class="text-gray-500 mt-2 text-sm">Amanah dan berdedikasi tinggi demi kemaslahatan para mustahik.</p>
        </div>
        @php $daftarPendiri = \App\Models\Pendiri::latest()->get(); @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
            @forelse($daftarPendiri as $person)
                <div class="pro-card rounded-2xl p-6 text-center flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-md mb-4 bg-emerald-50">
                        <img src="{{ asset('storage/' . $person->foto) }}" alt="{{ $person->nama }}" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-emerald-900">{{ $person->nama }}</h3>
                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mt-1">{{ $person->jabatan }}</p>
                </div>
            @empty
                <div class="col-span-full text-center py-8 text-sm text-gray-400 border border-dashed rounded-xl max-w-md mx-auto w-full">
                    Daftar profil pendiri yayasan belum dimasukkan oleh admin.
                </div>
            @endforelse
        </div>
    </section>

    {{-- ★★★ SECTION BARU: PROGRAM ORANG TUA ASUH ★★★ --}}
    <section id="program-ota" class="ota-section py-24 border-t border-emerald-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section header --}}
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-16">
                <span class="ota-section-badge text-xs uppercase tracking-widest font-bold px-4 py-1.5 rounded-full inline-block mb-3 shadow-sm">
                    💚 Program Kebaikan Berkelanjutan
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight mt-2" style="color: var(--fern);">
                    Program Orang Tua Asuh
                </h2>
                <p class="mt-3 text-sm font-medium leading-relaxed" style="color: var(--sage-green);">
                    Jadilah orang tua asuh bagi anak-anak kami. Dukungan rutin Anda memastikan mereka mendapat pendidikan,
                    gizi, dan masa depan yang layak. Pilih anak yang ingin Anda asuh di bawah ini.
                </p>
            </div>

            {{-- Statistik ringkas --}}
            <div data-aos="fade-up" data-aos-delay="50" class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-2xl mx-auto mb-14">
                <div class="bg-white rounded-2xl p-5 text-center border border-celadon shadow-sm" style="border-color: var(--celadon);">
                    <p class="text-3xl font-extrabold" style="color: var(--fern);">{{ $fosterChildren->count() }}</p>
                    <p class="text-xs font-bold uppercase tracking-wider mt-1" style="color: var(--sage-green);">Total Anak Asuh</p>
                </div>
                <div class="bg-white rounded-2xl p-5 text-center border shadow-sm" style="border-color: var(--celadon);">
                    <p class="text-3xl font-extrabold" style="color: var(--fern);">{{ $fosterChildren->where('status', 'Tersedia')->count() }}</p>
                    <p class="text-xs font-bold uppercase tracking-wider mt-1" style="color: var(--sage-green);">Menunggu OTA</p>
                </div>
                <div class="col-span-2 md:col-span-1 bg-white rounded-2xl p-5 text-center border shadow-sm" style="border-color: var(--celadon);">
                    <p class="text-3xl font-extrabold" style="color: var(--fern);">{{ $fosterChildren->where('status', '!=', 'Tersedia')->count() }}</p>
                    <p class="text-xs font-bold uppercase tracking-wider mt-1" style="color: var(--sage-green);">Sedang Diasuh</p>
                </div>
            </div>

            {{-- Grid anak asuh --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($fosterChildren as $child)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}" class="ota-card">

                        {{-- Foto --}}
                        @if($child->photo)
                            <img src="{{ asset('storage/' . $child->photo) }}"
                                 alt="Foto {{ $child->name }}"
                                 class="ota-card-photo">
                        @else
                            <div class="ota-card-photo-placeholder">
                                <svg width="52" height="52" viewBox="0 0 24 24" fill="none"
                                     style="stroke: var(--fern); opacity: 0.45;"
                                     stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                        @endif

                        <div class="ota-card-body">
                            {{-- Badge umur & status --}}
                            <div class="flex items-center justify-between mb-2 flex-wrap gap-1">
                                <span class="ota-age-badge">
                                    🗓 {{ $child->age }} Tahun
                                </span>
                                @if($child->status == 'Tersedia')
                                    <span class="ota-status-available">Tersedia</span>
                                @else
                                    <span class="ota-status-taken">Diasuh</span>
                                @endif
                            </div>

                            {{-- Nama --}}
                            <h3 class="font-bold text-base mb-2" style="color: var(--fern);">
                                {{ $child->name }}
                            </h3>

                            {{-- Deskripsi singkat --}}
                            @if($child->description)
                                <p class="text-xs leading-relaxed mb-4 line-clamp-3" style="color: var(--sage-green);">
                                    {{ $child->description }}
                                </p>
                            @else
                                <p class="text-xs italic mb-4" style="color: var(--muted-olive);">Belum ada cerita yang ditambahkan.</p>
                            @endif

                            {{-- Tombol aksi --}}
                            @if($child->status == 'Tersedia')
                                <a href="{{ route('sponsor.form', $child->id) }}" class="btn-ota">
                                    🤝 Asuh Sekarang
                                </a>
                            @else
                                <span class="btn-ota-disabled">✓ Sudah Diasuh</span>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center py-16 rounded-2xl border-2 border-dashed" style="border-color: var(--muted-olive);">
                        <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center" style="background-color: var(--celadon);">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                 style="stroke: var(--fern);"
                                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <p class="font-bold text-base mb-1" style="color: var(--fern);">Belum ada data anak asuh</p>
                        <p class="text-sm" style="color: var(--sage-green);">Admin belum menambahkan data anak ke dalam sistem.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    {{-- SECTION: KAMPANYE DONASI --}}
    <main id="kampanye" class="bg-white border-t border-emerald-100/60 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-16">
                <h2 class="text-3xl font-extrabold text-emerald-900 tracking-tight">Program Donasi Pilihan</h2>
                <p class="text-gray-500 mt-2 text-sm">Pilih dan salurkan donasi terbaik Anda dengan amanah & transparan.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($campaigns as $campaign)
                    <div class="pro-card rounded-2xl overflow-hidden flex flex-col justify-between">
                        <div class="h-52 w-full overflow-hidden bg-gray-50 border-b border-gray-100">
                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-lg line-clamp-2 min-h-[3.5rem] mb-2 text-emerald-900">{{ $campaign->title }}</h3>
                            <p class="text-xs line-clamp-3 mb-6 text-gray-500 leading-relaxed">{{ $campaign->description }}</p>
                        </div>
                        <div class="p-6 pt-0">
                            @php
                                $percentage = $campaign->target_amount > 0 ? ($campaign->collected_amount / $campaign->target_amount) * 100 : 0;
                                $percentage = min($percentage, 100);
                            @endphp
                            <div class="w-full bg-gray-100 rounded-full h-2 mb-4 shadow-inner">
                                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-2 rounded-full transition-all duration-1000" style="width: {{ $percentage }}%"></div>
                            </div>
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
                            <a href="{{ route('donations.create', $campaign->id) }}" class="block text-center w-full btn-outline font-bold py-2.5 rounded-xl text-xs">
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

    {{-- Footer --}}
    <footer class="bg-white py-12 border-t border-emerald-100 text-center text-xs">
        <div class="max-w-7xl mx-auto px-4 space-y-3">
            <p class="font-bold text-base text-emerald-900">{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</p>
            <p class="text-gray-500 max-w-md mx-auto leading-relaxed">{{ $profil?->alamat ?? 'Alamat kantor belum diatur' }}</p>
            <div class="pt-6 mt-6 border-t border-gray-100 text-gray-400">
                <p>&copy; {{ date('Y') }} {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}. Seluruh Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function () {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 15);
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 50 });
    </script>
</body>
</html>