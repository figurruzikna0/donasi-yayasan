<!DOCTYPE html>
<html lang="id" data-theme="baitul">
<head>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }} - Salurkan Kebaikan Anda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- ════════════════════ NAVBAR ════════════════════ --}}
    @include('partials.public-navbar', ['isHome' => true, 'scrollEffect' => true])

    {{-- HERO SECTION: banner utama dengan background gambar, teks ajakan donasi & tombol CTA ke #kampanye dan #program-ota --}}
    <header class="relative hero min-h-[85vh] lg:min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat scale-105" style="background-image: url('{{ asset('images/hero.jpeg') }}'); background-size: cover;">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/95 via-emerald-900/85 to-emerald-900/75"></div>
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
        <div class="hero-content text-center max-w-4xl px-4 py-20 lg:py-28 relative z-10">
            <div>
                <span data-aos="fade-down" class="bg-white/90 border border-emerald-300 text-emerald-700 text-xs uppercase tracking-[0.2em] font-bold px-5 py-2 rounded-full inline-block mb-6 shadow-sm">
                    Setiap Kebaikan Pasti Berbuah
                </span>
                <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-[1.1] tracking-tight">
                    Hal Kecil untuk <span class="text-emerald-300">Mereka</span>,<br>Pahala Besar untuk <span class="text-emerald-300">Anda</span>
                </h1>
                <p data-aos="fade-up" data-aos-delay="200" class="text-base md:text-lg mt-6 max-w-2xl mx-auto text-white/80 font-medium leading-relaxed">
                    Setiap hal kecil yang diberikan untuk anak yatim tidak akan pernah membuat Anda rugi. Sebaliknya, Allah menggantinya dengan keberkahan yang tak terduga.
                </p>
                <div data-aos="fade-up" data-aos-delay="300" class="mt-10 flex flex-wrap justify-center gap-3">
                    <a href="#kampanye" class="btn btn-success text-white font-bold px-8 py-3.5 rounded-xl text-sm tracking-wide shadow-lg hover:shadow-xl transition-all">Lihat Program Donasi Aktif</a>
                    <a href="#program-ota" class="btn btn-outline border-white text-white font-bold px-8 py-3.5 rounded-xl text-sm tracking-wide bg-white/10 hover:bg-white hover:text-emerald-800 hover:border-white transition-all">Jadi Orang Tua Asuh</a>
                </div>
            </div>
        </div>
    </header>

    {{-- PROGRAM DONASI: daftar campaign aktif dari DB ($campaigns), tiap card menampilkan progress & tombol "Donasi Sekarang" menuju donations.create --}}
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
                                    <svg class="w-12 h-12 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
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

    {{-- STATS DONASI: menampilkan total campaign, total donasi terkumpul & total transaksi dari controller --}}
    <section class="py-16 lg:py-20 px-4 bg-gradient-to-br from-emerald-50 via-white to-emerald-50">
        <div class="max-w-7xl mx-auto" data-aos="fade-up">
            <div class="text-center mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 inline-block mb-3 border border-emerald-200">Bukti Transparansi</span>
                <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight mb-2">Pergerakan Donasi <span class="text-emerald-500">Real-Time</span></h2>
                <p class="text-sm text-gray-500 max-w-xl mx-auto">Setiap rupiah yang disalurkan tercatat dan dapat dipertanggungjawabkan.</p>
            </div>

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

    {{-- ORANG TUA ASUH: ajakan menjadi sponsor anak yatim, tombol Daftar/Mengarah ke register/login --}}
    <section id="program-ota" class="py-20 lg:py-28 px-4 bg-emerald-50">
        <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
            <span class="bg-white/80 border border-emerald-300 text-emerald-700 text-xs uppercase tracking-[0.2em] font-bold px-5 py-2 rounded-full inline-block mb-4 shadow-sm">Program Kebaikan Berkelanjutan</span>
            <h2 class="text-3xl md:text-4xl font-black text-emerald-900 tracking-tight">Program Orang Tua Asuh</h2>
            <p class="mt-4 text-sm text-emerald-700/70 font-medium max-w-xl mx-auto leading-relaxed">
                Jadilah orang tua asuh dan berikan masa depan yang lebih cerah bagi anak-anak yatim.
            </p>
            <div class="mt-8 bg-white/70 border border-emerald-200 rounded-2xl p-8 shadow-sm max-w-lg mx-auto">
                <svg class="w-10 h-10 text-emerald-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                <p class="text-sm text-emerald-700 font-semibold">Data anak asuh dan formulir pendaftaran</p>
                <p class="text-sm text-emerald-600">hanya tersedia untuk donatur yang sudah login.</p>
                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('register') }}" class="btn btn-success text-white font-bold px-6">Daftar Sekarang</a>
                    <a href="{{ route('login') }}" class="btn btn-outline btn-success font-bold px-6">Masuk</a>
                </div>
            </div>
        </div>
    </section>

    {{-- BERITA KEGIATAN: carousel berita dari DB ($newsList), tiap item mengarah ke news.show --}}
    @if(isset($newsList) && $newsList->count() > 0)
    <section id="berita-kegiatan" class="py-20 lg:py-28 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 inline-block mb-3 border border-emerald-200">Liputan Terkini</span>
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
                                        <svg class="w-10 h-10 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                                    </div>
                                @endif
                                <div class="p-5 flex flex-col flex-1">
                                    <span class="badge badge-success badge-sm mb-2">{{ $item->kategori }}</span>
                                    <h3 class="text-sm font-extrabold text-emerald-900 leading-snug mb-2 line-clamp-2 group-hover:text-emerald-600 transition-colors">{{ $item->judul }}</h3>
                                    <p class="text-xs text-gray-500 leading-relaxed flex-1 line-clamp-3 mb-4">
                                        {{ $item->ringkasan ?: \Illuminate\Support\Str::limit(strip_tags($item->konten), 120) }}
                                    </p>
                                    <div class="flex items-center justify-between text-[0.65rem] text-emerald-500 font-semibold border-t border-emerald-100 pt-3 mt-auto">
                                        <span>{{ $item->tanggal_kegiatan->translatedFormat('d M Y') }}</span>
                                        @if($item->lokasi)<span>{{ \Illuminate\Support\Str::limit($item->lokasi, 22) }}</span>@endif
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

    {{-- FOOTER: partial footer yayasan --}}
    @include('partials.footer')

    {{-- SCRIPTS: AOS animasi + carousel berita dengan auto-slide & touch support --}}
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
