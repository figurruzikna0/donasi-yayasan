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
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-sm font-bold text-emerald-800">Beranda</a>
                    <a href="#tentang-kami" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 transition">Tentang Kami</a>
                    <a href="#berkas-yayasan" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 transition">Legalitas & Struktur</a>
                    <a href="#pendiri" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 transition">Pengurus</a>
                    <a href="#kampanye" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 transition">Program Donasi</a>
                    <a href="{{ route('admin.dashboard') }}" class="border 1.5px border-emerald-600 text-emerald-700 text-xs px-4 py-2 rounded-xl font-bold shadow-sm hover:bg-emerald-600 hover:text-white transition">
                        Dashboard Admin →
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
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
            
            <div data-aos="fade-up" data-aos-delay="300" class="mt-10">
                <a href="#kampanye" class="btn-primary font-bold px-8 py-3.5 rounded-xl inline-block text-sm tracking-wide">
                    Lihat Program Donasi Aktif
                </a>
            </div>
        </div>
    </header>

    {{-- ── SECTION 1: TENTANG KAMI (DESAIN MODERN & ELEGAN) ── --}}
   {{-- ── SECTION 1: TENTANG KAMI (DESAIN PREMIUM & PROFESIONAL) ── --}}
    {{-- ── SECTION 1: TENTANG KAMI (DESAIN PREMIUM & PROFESIONAL) ── --}}
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
                    
                    <div data-aos="fade-up" data-aos-delay="100" class="bg-white p-8 md:p-10 rounded-2xl border border-emerald-100 shadow-sm relative overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <span class="text-2xl">📖</span>
                                <h3 class="text-xl font-bold text-emerald-950 tracking-tight">Sejarah & Rekam Jejak</h3>
                            </div>
                            <div class="text-gray-700 leading-relaxed text-justify text-base whitespace-pre-line font-normal">
                                {{ $profil?->sejarah_yayasan ?? 'Informasi sejarah belum diisi oleh administrator backend.' }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div data-aos="fade-up" data-aos-delay="200" class="bg-white p-8 rounded-2xl border border-emerald-100 shadow-sm border-t-4 border-t-emerald-500">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl mb-4 font-bold border border-emerald-100">🎯</div>
                            <h4 class="text-lg font-bold text-emerald-950 mb-2">Visi</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                {{ $profil?->visi ?? 'Menjadi lembaga pengasuhan anak yatim dan sosial yang amanah, transparan, serta profesional dalam membangun generasi berakhlak mulia.' }}
                            </p>
                        </div>
                        
                        <div data-aos="fade-up" data-aos-delay="300" class="bg-white p-8 rounded-2xl border border-emerald-100 shadow-sm border-t-4 border-t-emerald-500">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl mb-4 font-bold border border-emerald-100">🚀</div>
                            <h4 class="text-lg font-bold text-emerald-950 mb-2">Misi</h4>
                            <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">
                                {{ $profil?->misi ?? "• Memberikan pendidikan & fasilitas terbaik.\n• Mengelola amanah dengan transparansi.\n• Memberdayakan potensi anak asuh." }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 flex flex-col">
                    
                    <div data-aos="fade-left" data-aos-delay="400" class="rounded-2xl p-8 shadow-sm flex flex-col justify-between border border-[#b3e093] h-full" style="background: linear-gradient(175deg, var(--lime-cream) 0%, var(--celadon) 100%);">
                        <div>
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
                                    <p class="text-sm text-emerald-950 font-bold text-base">{{ $profil?->no_telp ?? '-' }}</p>
                                </div>

                                <div>
                                    <span class="block text-[11px] text-emerald-900/60 font-bold uppercase tracking-wider mb-1">Email Resmi</span>
                                    <p class="text-sm text-emerald-950 font-medium">{{ $profil?->email ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 pt-4 border-t border-emerald-900/10 text-center">
                            <p class="text-emerald-900/70 text-xs italic font-medium">
                                "Pintu kami selalu terbuka untuk silaturahmi & kebaikan."
                            </p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    
    {{-- ── SECTION 2: BERKAS DIGITAL (LEGALITAS & STRUKTUR FOTO VIA BACKEND) ── --}}

    {{-- ── SECTION 2: BERKAS DIGITAL (LEGALITAS & STRUKTUR FOTO VIA BACKEND) ── --}}
    {{-- ── SECTION 2: BERKAS DIGITAL (LEGALITAS & STRUKTUR) ── --}}
    <section id="berkas-yayasan" class="bg-white border-y border-emerald-100/60 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div data-aos="fade-up" class="text-center max-w-xl mx-auto mb-16">
                <h2 class="text-3xl font-extrabold text-emerald-900 tracking-tight">Berkas Resmi & Transparansi</h2>
                <p class="text-gray-500 mt-2 text-sm md:text-base">Dokumen resmi legalitas hukum dan kepegawaian yayasan.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div data-aos="fade-right" data-aos-delay="100" class="pro-card p-6 rounded-2xl flex flex-col justify-between">
                    <h3 class="text-lg font-bold text-emerald-900 mb-4 flex items-center gap-2">📑 Dokumen Surat Legalitas Resmi</h3>
                    @if($profil && $profil->foto_legalitas)
                        <div class="overflow-hidden rounded-xl border border-gray-100 bg-gray-50 p-2">
                            <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" alt="Legalitas Resmi Yayasan" class="w-full h-auto max-h-[450px] object-contain mx-auto rounded-lg shadow-sm">
                        </div>
                    @else
                        <div class="py-16 text-center text-sm text-gray-400 border border-dashed rounded-xl">Foto dokumen legalitas resmi belum diupload oleh admin.</div>
                    @endif
                </div>

                <div data-aos="fade-left" data-aos-delay="200" class="pro-card p-6 rounded-2xl flex flex-col justify-between">
                    <h3 class="text-lg font-bold text-emerald-900 mb-4 flex items-center gap-2">📊 Bagan Struktur Organisasi Pengurus</h3>
                    @if($profil && $profil->foto_struktur)
                        <div class="overflow-hidden rounded-xl border border-gray-100 bg-gray-50 p-2">
                            <img src="{{ asset('storage/' . $profil->foto_struktur) }}" alt="Struktur Organisasi" class="w-full h-auto max-h-[450px] object-contain mx-auto rounded-lg shadow-sm">
                        </div>
                    @else
                        <div class="py-16 text-center text-sm text-gray-400 border border-dashed rounded-xl">Foto bagan struktur organisasi belum diupload oleh admin.</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ── SECTION 3: PENDIRI & PENGURUS (DAPAT DI-LOOPING BANYAK ORANG) ── --}}
    <section id="pendiri" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs uppercase tracking-widest font-bold px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 inline-block mb-3">
                Struktur Manajemen
            </span>
            <h2 class="text-3xl font-extrabold text-emerald-900 tracking-tight">Pendiri & Tokoh Yayasan</h2>
            <p class="text-gray-500 mt-2 text-sm">Amanah dan berdedikasi tinggi demi kemaslahatan para mustahik.</p>
        </div>

        {{-- Loop Dinamis Banyak Anggota Pendiri --}}
        @php 
            $daftarPendiri = \App\Models\Pendiri::latest()->get(); 
        @endphp

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

    {{-- ── SECTION 4: KAMPANYE DONASI ── --}}
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
                            <h3 class="font-bold text-lg line-clamp-2 min-h-[3.5rem] mb-2 text-emerald-900">
                                {{ $campaign->title }}
                            </h3>
                            <p class="text-xs line-clamp-3 mb-6 text-gray-500 leading-relaxed">
                                {{ $campaign->description }}
                            </p>
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
    // Inisialisasi efek gerakan
    AOS.init({
        duration: 800, // Kecepatan animasi (milidetik)
        once: true, // Animasi cuma jalan sekali saat di-scroll ke bawah
        offset: 50, // Jarak scroll sebelum elemen muncul
    });
</script>
</body>
</html>