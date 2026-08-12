<!-- ============================================ -->
<!-- welcome.blade.php - HALAMAN LANDING PUBLIK  -->
<!-- ============================================ -->
<!-- Peran: halaman depan website yang pertama kali dilihat pengunjung, berisi hero section, aksi cepat, daftar program donasi aktif, statistik donasi, program orang tua asuh, berita terbaru, dan footer. -->
<!-- Data dikirim dari route '/' di web.php: $campaigns (campaign aktif), $newsList (berita terbaru), $totalCampaigns, $totalDonasi, $totalTransaksi, serta $profil (data yayasan) yang disuntik lewat view composer global. -->
<!-- Alur: merender hero, lalu program donasi, statistik, program OTA, berita (carousel), footer, dan skrip JavaScript carousel + animasi AOS. Jika user sudah login, route akan mengarahkan ke dashboard masing-masing. -->
{{--
    ========================================================
    HALAMAN DEPAN (resources/views/welcome.blade.php)
    ========================================================
    Halaman utama publik. Menampilkan:
      - Hero section dengan statistik (total campaign, donasi, transaksi)
      - Daftar campaign aktif (3 kolom grid)
      - Berita terbaru (6 items)
      - CTA untuk login/daftar

    Data dikirim dari route '/' di web.php (closure):
      - $campaigns          → campaign aktif
      - $newsList           → 9 berita terbaru
      - $totalCampaigns     → total campaign
      - $totalDonasi        → total dana terkumpul
      - $totalTransaksi     → total transaksi sukses
      - $profil             → data yayasan (via view composer global)

    Jika user sudah login → redirect ke dashboard masing-masing.
    ========================================================
--}}
<!DOCTYPE html>
<html lang="id" data-theme="baitul">
<head>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Judul halaman memakai nama yayasan dari database (jika kosong, fallback "Baitul Yatim") -->
    <title>{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }} - Salurkan Kebaikan Anda</title>
    <link rel="icon" href="{{ $profil?->logo ? asset('storage/' . $profil->logo) : '/favicon.ico' }}">
    <!-- Memuat file CSS dan JS yang di-bundle oleh Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- NAVBAR --}}
    <!-- Navbar publik (partial). Parameter isHome=true membuat link memakai anchor '#...' dalam halaman ini, scrollEffect=true mengaktifkan efek bayangan saat halaman di-scroll -->
    @include('partials.public-navbar', ['isHome' => true, 'scrollEffect' => true])

    {{-- HERO SECTION --}}
    <!-- Seksi hero: gambar latar hero.jpeg ditimpa overlay gradasi hijau tua agar teks terbaca, dengan tagline utama yayasan -->
    <header class="relative hero min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/hero.jpeg') }}'); background-size: cover;">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/88 via-emerald-900/85 to-emerald-900/88"></div>
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
        <div class="hero-content text-center max-w-4xl px-4 pt-8 lg:pt-12 pb-16 lg:pb-20 relative z-10">
            <div>
                <p data-aos="fade-down" class="text-emerald-200 text-lg sm:text-xl md:text-2xl uppercase tracking-[0.4em] font-black mb-5 drop-shadow-lg">
                    PEDULI YATIM
                </p>
                <span data-aos="fade-down" data-aos-delay="50" class="bg-white/95 border-2 border-emerald-300 text-emerald-700 text-sm sm:text-base uppercase tracking-[0.2em] font-bold px-6 py-2.5 rounded-full inline-block mb-6 shadow-lg">
                    Titipan Rasulullah SAW
                </span>
                <!-- Tagline utama; atribut data-aos mengaktifkan animasi scroll AOS -->
                <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-5xl lg:text-7xl font-black text-white leading-[1.15] tracking-tight">
                    Rezeki Itu <span class="text-emerald-300">Pasti</span>,<br>Kemuliaan Harus <span class="text-emerald-300">Dicari</span>,<br>Berbagi Tidak Akan Membuatmu <span class="text-emerald-300">Rugi</span>.
                </h1>

            </div>
        </div>
    </header>

    {{-- SECTION AKSI CEPAT --}}
    <!-- Seksi aksi cepat: dua kartu pintasan menuju bagian kampanye dan program orang tua asuh -->
    <section id="aksi-cepat" class="py-10 lg:py-12 px-4 bg-emerald-50 border-b border-emerald-100">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Kartu pintasan "Lihat Program Donasi Aktif" yang menautkan ke seksi #kampanye -->
                <a href="#kampanye" class="group bg-white rounded-2xl p-6 sm:p-8 flex items-center gap-5 shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-lg hover:border-emerald-200 transition-all border border-slate-200">
                    <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 group-hover:bg-emerald-200 transition-colors">
                        <svg class="w-7 h-7 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-emerald-800 text-lg">Lihat Program Donasi Aktif</p>
                        <p class="text-sm text-slate-500 mt-0.5">Salurkan donasi terbaik Anda</p>
                    </div>
                    <svg class="w-5 h-5 text-emerald-400 ml-auto shrink-0 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
                <!-- Kartu pintasan "Jadi Orang Tua Asuh" yang menautkan ke seksi #program-ota -->
                <a href="#program-ota" class="group bg-white rounded-2xl p-6 sm:p-8 flex items-center gap-5 shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-lg hover:border-emerald-200 transition-all border border-slate-200">
                    <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 group-hover:bg-emerald-200 transition-colors">
                        <svg class="w-7 h-7 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-emerald-800 text-lg">Jadi Orang Tua Asuh</p>
                        <p class="text-sm text-slate-500 mt-0.5">Dukung masa depan anak yatim</p>
                    </div>
                    <svg class="w-5 h-5 text-emerald-400 ml-auto shrink-0 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- PROGRAM DONASI --}}
    <!-- Seksi program donasi: menampilkan grid kampanye aktif yang datanya dikirim dari controller -->
    <section id="kampanye" class="py-20 lg:py-28 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 inline-block mb-3 border border-emerald-200">Donasi</span>
                <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight">Program Donasi Pilihan</h2>
                <p class="text-slate-500 mt-2 text-sm">Pilih dan salurkan donasi terbaik Anda dengan amanah & transparan.</p>
            </div>

            <!-- Kondisi if: jika ada kampanye aktif, tampilkan grid 3 kolom; jika tidak, tampilkan pesan kosong -->
            @if($campaigns->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- foreach: iterasi setiap kampanye untuk dirender menjadi kartu program donasi -->
                    @foreach($campaigns as $campaign)
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}" class="bg-white rounded-2xl overflow-hidden flex flex-col hover:shadow-lg transition-all group border border-slate-200 shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] hover:border-emerald-200">
                            <!-- Kondisi if: menampilkan gambar kampanye jika ada, jika tidak memakai placeholder gradasi -->
                            @if($campaign->image)
                                <a href="{{ route('campaign.show', $campaign->id) }}">
                                    <figure class="h-48 overflow-hidden">
                                        <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </figure>
                                </a>
                            @else
                                <a href="{{ route('campaign.show', $campaign->id) }}">
                                    <div class="h-48 bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                                    </div>
                                </a>
                            @endif
                            <div class="p-5 flex flex-col flex-1">
                                <!-- Judul dan deskripsi kampanye, diklik untuk membuka halaman detail campaign -->
                                <a href="{{ route('campaign.show', $campaign->id) }}" class="hover:text-emerald-700 transition-colors">
                                    <h3 class="font-bold text-base text-slate-800 mb-2 line-clamp-2 group-hover:text-emerald-700 transition-colors">{{ $campaign->title }}</h3>
                                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-2 mb-4 flex-1">{{ $campaign->description }}</p>
                                </a>
                                <!-- php: menghitung persentase dana terkumpul dibanding target (dibatasi maksimal 100%) untuk progress bar -->
                                @php $pct = $campaign->target_amount > 0 ? min(($campaign->collected_amount / $campaign->target_amount) * 100, 100) : 0; @endphp
                                <div class="mb-3">
                                    <!-- Tampilan angka persentase dan nominal dana terkumpul / target, diformat dengan number_format -->
                                    <div class="flex justify-between text-xs text-slate-500 mb-1">
                                        <span class="font-semibold">{{ number_format($pct, 1) }}%</span>
                                        <span class="font-semibold">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }} / Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                    </div>
                                    <!-- Progress bar yang lebarnya mengikuti nilai persentase ($pct) -->
                                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full transition-all" style="width: {{ $pct }}%"></div>
                                    </div>
                                </div>
                                <div class="flex gap-2 mt-1">
                                    <!-- Tombol "Lihat Detail" menuju halaman detail campaign -->
                                    <a href="{{ route('campaign.show', $campaign->id) }}" class="btn btn-sm btn-outline border-slate-300 text-slate-500 hover:bg-slate-100 hover:text-slate-700 font-bold flex-1 rounded-xl">Lihat Detail</a>
                                    <!-- auth/else: jika user sudah login, tombol Donasi mengarah ke form donasi; jika belum login, diarahkan ke halaman login terlebih dahulu -->
                                    @auth
                                        <a href="{{ route('donations.create', $campaign->id) }}" class="btn btn-sm bg-emerald-700 hover:bg-emerald-800 text-white border-0 font-bold flex-1 rounded-xl shadow-sm">Donasi</a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-sm bg-emerald-700 hover:bg-emerald-800 text-white border-0 font-bold flex-1 rounded-xl shadow-sm">Donasi</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Blok else: state kosong ketika belum ada program donasi aktif -->
                <div class="text-center py-14 text-sm text-slate-400 border border-dashed border-slate-300 rounded-xl max-w-md mx-auto">
                    Saat ini belum ada program donasi aktif yang dirilis.
                </div>
            @endif
        </div>
    </section>

    {{-- STATS DONASI --}}
    <!-- Seksi statistik: menampilkan total kampanye, total donasi, dan total transaksi secara real-time dari database -->
    <section class="py-16 lg:py-20 px-4 bg-gradient-to-br from-emerald-50 via-white to-emerald-50">
        <div class="max-w-7xl mx-auto" data-aos="fade-up">
            <div class="text-center mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 inline-block mb-3 border border-emerald-200">Bukti Transparansi</span>
                <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight mb-2">Pergerakan Donasi <span class="text-emerald-500">Real-Time</span></h2>
                <p class="text-sm text-slate-500 max-w-xl mx-auto">Setiap rupiah yang disalurkan tercatat dan dapat dipertanggungjawabkan.</p>
            </div>

            <!-- Grid 3 kolom statistik: jumlah campaign, nominal donasi terkumpul, dan jumlah transaksi -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-0">
                <div class="relative bg-white rounded-2xl lg:rounded-none shadow-md lg:shadow-none lg:bg-transparent p-6 lg:p-0 lg:px-8 xl:px-12 flex flex-col lg:flex-row lg:items-baseline lg:justify-center gap-1 text-center lg:text-left">
                    <div class="hidden lg:block absolute right-0 top-1/4 bottom-1/4 w-px bg-gradient-to-b from-transparent via-emerald-300 to-transparent"></div>
                    <p class="text-4xl md:text-5xl font-black text-emerald-700">{{ number_format($totalCampaigns, 0, ',', '.') }}</p>
                    <p class="text-sm font-semibold text-emerald-500 uppercase tracking-wider">Campaign</p>
                </div>
                <div class="relative bg-white rounded-2xl lg:rounded-none shadow-md lg:shadow-none lg:bg-transparent p-6 lg:p-0 lg:px-8 xl:px-12 flex flex-col lg:flex-row lg:items-baseline lg:justify-center gap-1 text-center lg:text-left">
                    <div class="hidden lg:block absolute right-0 top-1/4 bottom-1/4 w-px bg-gradient-to-b from-transparent via-emerald-300 to-transparent"></div>
                    <p class="text-4xl md:text-5xl font-black text-emerald-700">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</p>
                    <p class="text-sm font-semibold text-emerald-500 uppercase tracking-wider">Donasi Terkumpul</p>
                </div>
                <div class="relative bg-white rounded-2xl lg:rounded-none shadow-md lg:shadow-none lg:bg-transparent p-6 lg:p-0 lg:px-8 xl:px-12 flex flex-col lg:flex-row lg:items-baseline lg:justify-center gap-1 text-center lg:text-left">
                    <p class="text-4xl md:text-5xl font-black text-emerald-700">{{ number_format($totalTransaksi, 0, ',', '.') }}</p>
                    <p class="text-sm font-semibold text-emerald-500 uppercase tracking-wider">Transaksi Campaign</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ORANG TUA ASUH --}}
    <!-- Seksi program orang tua asuh: ajakan mendaftar atau masuk untuk mengakses data anak asuh -->
    <section id="program-ota" class="py-20 lg:py-28 px-4 bg-emerald-50">
        <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
            <span class="bg-white/80 border border-emerald-300 text-emerald-700 text-xs uppercase tracking-[0.2em] font-bold px-5 py-2 rounded-full inline-block mb-4 shadow-sm">Program Kebaikan Berkelanjutan</span>
            <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight">Program Orang Tua Asuh</h2>
            <p class="mt-4 text-sm text-emerald-700/70 font-medium max-w-xl mx-auto leading-relaxed">
                Jadilah orang tua asuh dan berikan masa depan yang lebih cerah bagi anak-anak yatim.
            </p>
            <div class="mt-8 bg-white border border-slate-200 rounded-2xl p-8 shadow-[0_1px_3px_rgba(0,0,0,0.06)] max-w-lg mx-auto">
                <svg class="w-10 h-10 text-emerald-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                <p class="text-sm text-slate-700 font-semibold">Data anak asuh dan formulir pendaftaran</p>
                <p class="text-sm text-slate-500">hanya tersedia untuk donatur yang sudah login.</p>
                <!-- Tombol CTA: Daftar Sekarang dan Masuk, masing-masing menuju route register dan login -->
                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('register') }}" class="btn bg-emerald-700 hover:bg-emerald-800 text-white font-bold px-6 border-0 shadow-sm">Daftar Sekarang</a>
                    <a href="{{ route('login') }}" class="btn btn-outline border-emerald-300 text-emerald-700 hover:bg-emerald-700 hover:text-white font-bold px-6">Masuk</a>
                </div>
            </div>
        </div>
    </section>

    {{-- BERITA KEGIATAN --}}
    <!-- Kondisi if: seksi berita hanya dirender jika variabel $newsList ada dan berisi data -->
    @if(isset($newsList) && $newsList->count() > 0)
    <section id="berita-kegiatan" class="py-20 lg:py-28 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 inline-block mb-3 border border-emerald-200">Liputan Terkini</span>
                <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight">Berita & Kegiatan</h2>
                <p class="text-slate-500 mt-2 text-sm">Ikuti perkembangan program, kegiatan, dan laporan terbaru dari lapangan.</p>
            </div>

            <!-- Carousel berita: tombol navigasi kiri/kanan, track geser berisi kartu berita, dan titik navigasi di bawah -->
            <div data-aos="fade-up" class="news-carousel-outer relative px-6">
                <!-- Tombol panah kiri untuk bergeser ke berita sebelumnya -->
                <button class="btn btn-circle btn-outline btn-sm absolute top-1/2 -translate-y-1/2 z-10 left-0 lg:-left-5 bg-white border-emerald-400 text-emerald-700 hover:bg-emerald-700 hover:text-white hover:border-emerald-700 disabled:opacity-30 disabled:cursor-not-allowed disabled:pointer-events-none" id="news-prev" aria-label="Sebelumnya">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                </button>
                <div class="overflow-hidden">
                    <!-- Track berita yang digeser oleh skrip JavaScript; setiap item dirender sebagai kartu berita -->
                    <div class="flex gap-6 transition-transform duration-[450ms] ease-[cubic-bezier(0.4,0,0.2,1)] will-change-transform" id="news-track">
                        @foreach($newsList as $item)
                        <div class="news-slide flex-none w-full sm:w-1/2 lg:w-1/3 min-w-0">
                            <!-- Kartu berita: tautan ke halaman detail berita, menampilkan foto utama, kategori, judul, ringkasan, tanggal, dan lokasi -->
                            <a href="{{ route('news.show', $item->slug) }}" class="bg-white rounded-2xl overflow-hidden flex flex-col h-full hover:shadow-lg transition-all group border border-slate-200 shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] hover:border-emerald-200">
                                <!-- Kondisi if: tampilkan foto utama berita jika ada, jika tidak gunakan placeholder ikon -->
                                @if($item->foto_utama)
                                    <figure class="h-48 overflow-hidden">
                                        <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </figure>
                                @else
                                    <div class="h-48 bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                                    </div>
                                @endif
                                <div class="p-5 flex flex-col flex-1">
                                    <span class="inline-flex items-center text-[0.6rem] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 mb-2 w-fit">{{ $item->kategori }}</span>
                                    <h3 class="text-sm font-extrabold text-slate-800 leading-snug mb-2 line-clamp-2 group-hover:text-emerald-700 transition-colors">{{ $item->judul }}</h3>
                                    <!-- Ringkasan berita; jika kosong, potong isi konten otomatis dengan Str::limit -->
                                    <p class="text-xs text-slate-500 leading-relaxed flex-1 line-clamp-3 mb-4">
                                        {{ $item->ringkasan ?: \Illuminate\Support\Str::limit(strip_tags($item->konten), 120) }}
                                    </p>
                                    <!-- Baris bawah kartu: tanggal kegiatan (diformat bahasa Indonesia) dan lokasi (jika ada) -->
                                    <div class="flex items-center justify-between text-[0.65rem] text-emerald-600 font-semibold border-t border-slate-100 pt-3 mt-auto">
                                        <span>{{ $item->tanggal_kegiatan->translatedFormat('d M Y') }}</span>
                                        @if($item->lokasi)<span>{{ \Illuminate\Support\Str::limit($item->lokasi, 22) }}</span>@endif
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Tombol panah kanan untuk bergeser ke berita berikutnya -->
                <button class="btn btn-circle btn-outline btn-sm absolute top-1/2 -translate-y-1/2 z-10 right-0 lg:-right-5 bg-white border-emerald-400 text-emerald-700 hover:bg-emerald-700 hover:text-white hover:border-emerald-700 disabled:opacity-30 disabled:cursor-not-allowed disabled:pointer-events-none" id="news-next" aria-label="Berikutnya">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>

            <!-- Titik navigasi (dots) carousel yang dibuat dinamis oleh skrip JavaScript -->
            <div class="flex justify-center gap-1.5 mt-7" id="news-dots"></div>
        </div>
    </section>
    @endif

    {{-- FOOTER --}}
    <!-- Footer publik (partial) berisi navigasi, program, kontak, dan lokasi yayasan -->
    @include('partials.footer')

    {{-- SCRIPTS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Inisialisasi animasi AOS: durasi 700ms, sekali jalan, offset 40px -->
    <script>AOS.init({ duration: 700, once: true, offset: 40 });</script>

    <!-- ========================================================== -->
    <!-- SKRIP CAROUSEL BERITA: navigasi tombol prev/next, titik (dots), geser otomatis tiap 4,5 detik, dukungan swipe sentuh, dan rebuild saat resize layar -->
    <!-- ========================================================== -->
    <script>
    (function () {
        <!-- Ambil elemen-elemen carousel: track, wadah dots, dan tombol prev/next -->
        const track    = document.getElementById('news-track');
        const dotsWrap = document.getElementById('news-dots');
        const btnPrev  = document.getElementById('news-prev');
        const btnNext  = document.getElementById('news-next');
        <!-- Jika elemen track tidak ditemukan, hentikan skrip (halaman tanpa carousel) -->
        if (!track) return;
        const slides = Array.from(track.querySelectorAll('.news-slide'));
        if (slides.length === 0) return;
        let current = 0;

        <!-- Fungsi visibleCount: menentukan jumlah berita yang terlihat berdasarkan lebar layar (1 / 2 / 3) -->
        function visibleCount() {
            return window.innerWidth >= 1024 ? 3 : window.innerWidth >= 640 ? 2 : 1;
        }
        <!-- Fungsi maxIndex: indeks slide terakhir yang diperbolehkan agar tidak melewati batas -->
        function maxIndex() { return Math.max(0, slides.length - visibleCount()); }
        <!-- Fungsi buildDots: membuat tombol titik navigasi sebanyak jumlah halaman carousel -->
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
        <!-- Fungsi updateDots: menyorot titik yang aktif sesuai slide saat ini -->
        function updateDots() {
            Array.from(dotsWrap.children).forEach((d, i) => {
                d.className = 'w-2 h-2 rounded-full bg-emerald-300 border-none cursor-pointer transition-all duration-300' + (i === current ? ' !w-6 !bg-emerald-700' : '');
            });
        }
        <!-- Fungsi updateButtons: menonaktifkan tombol prev di awal dan tombol next di akhir -->
        function updateButtons() {
            btnPrev.disabled = current === 0;
            btnNext.disabled = current >= maxIndex();
        }
        <!-- Fungsi goTo: menggeser track ke slide tertentu dan memperbarui dots serta tombol -->
        function goTo(index) {
            current = Math.max(0, Math.min(index, maxIndex()));
            const slideEl = slides[0];
            const gap = 24;
            const slideW = slideEl.getBoundingClientRect().width;
            track.style.transform = `translateX(-${current * (slideW + gap)}px)`;
            updateDots();
            updateButtons();
        }
        <!-- Pasang event klik pada tombol prev dan next -->
        btnPrev.addEventListener('click', () => goTo(current - 1));
        btnNext.addEventListener('click', () => goTo(current + 1));

        <!-- Geser otomatis setiap 4,5 detik; berhenti saat mouse di atas carousel, lanjut lagi saat keluar -->
        let timer = setInterval(() => { goTo(current >= maxIndex() ? 0 : current + 1); }, 4500);
        track.closest('.news-carousel-outer').addEventListener('mouseenter', () => clearInterval(timer));
        track.closest('.news-carousel-outer').addEventListener('mouseleave', () => {
            timer = setInterval(() => goTo(current >= maxIndex() ? 0 : current + 1), 4500);
        });

        <!-- Dukungan swipe sentuh: catat posisi awal dan geser ke kiri/kanan jika pergerakan melebihi 40px -->
        let touchStartX = 0;
        track.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
        track.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) goTo(diff > 0 ? current + 1 : current - 1);
        });

        <!-- Saat ukuran jendela berubah, rebuild dots dan pertahankan posisi slide (debounce 150ms) -->
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
