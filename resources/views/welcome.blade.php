<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baitul Yatim - Salurkan Kebaikan Anda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        :root {
            --celadon:       #b3e093;
            --lime-cream:    #d6ec89;
            --muted-olive:   #a1c181;
            --muted-olive-2: #8bb650;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
        }

        body {
            background-color: #f4fde8;
            color: var(--fern);
        }

        /* ── Navbar ── */
        .custom-nav {
            background-color: rgba(244, 253, 232, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid transparent;
            transition: all 0.3s ease;
        }
        .custom-nav.scrolled {
            border-bottom: 1px solid var(--celadon);
            box-shadow: 0 4px 20px rgba(92, 129, 72, 0.12);
        }
        .nav-link {
            color: var(--sage-green);
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: var(--fern);
        }
        .btn-admin {
            background-color: transparent;
            border: 1.5px solid var(--sage-green);
            color: var(--sage-green);
            transition: all 0.3s ease;
        }
        .btn-admin:hover {
            background-color: var(--sage-green);
            color: #ffffff;
        }

        /* ── Hero ── */
        .hero-section {
            background: linear-gradient(175deg, var(--lime-cream) 0%, var(--celadon) 55%, #e4f8cb 100%);
            border-bottom: 1px solid var(--muted-olive);
        }
        .hero-badge {
            background-color: rgba(92, 129, 72, 0.1);
            color: var(--fern);
            border: 1px solid var(--muted-olive);
        }
        .hero-title {
            color: var(--fern);
        }
        .hero-subtitle {
            color: var(--sage-green);
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--muted-olive-2) 0%, var(--sage-green) 100%);
            color: #ffffff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(92, 129, 72, 0.3);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--sage-green) 0%, var(--fern) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(92, 129, 72, 0.4);
        }

        /* ── Campaign Cards ── */
        .campaign-card {
            background-color: #ffffff;
            border: 1px solid var(--celadon);
            transition: all 0.3s ease;
        }
        .campaign-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(92, 129, 72, 0.18);
            border-color: var(--muted-olive);
        }

        /* Campaign card image placeholder */
        .card-img-placeholder {
            background: linear-gradient(135deg, var(--celadon) 0%, var(--lime-cream) 100%);
        }

        /* ── Progress Bar ── */
        .progress-bg   { background-color: var(--celadon); }
        .progress-fill {
            background: linear-gradient(90deg, var(--muted-olive-2), var(--sage-green));
        }

        /* ── Donate Button ── */
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

        /* ── Alert ── */
        .alert-success {
            background-color: var(--celadon);
            border-bottom: 1px solid var(--muted-olive);
            color: var(--fern);
        }

        /* ── Section headings ── */
        .section-title   { color: var(--fern); }
        .section-subtitle { color: var(--sage-green); }

        /* ── Empty state ── */
        .empty-state {
            border-color: var(--muted-olive);
            color: var(--sage-green);
        }

        /* ── Footer ── */
        .site-footer {
            background-color: #ffffff;
            border-top: 1px solid var(--celadon);
            color: var(--fern);
        }

        /* Amount labels */
        .amount-label  { color: var(--sage-green); }
        .amount-value  { color: var(--fern); }
    </style>
</head>
<body class="font-sans antialiased">

    {{-- Navbar --}}
    <nav id="navbar" class="custom-nav sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold tracking-wide" style="color: var(--fern);">🌿 Baitul Yatim</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="nav-link font-bold text-sm">Home</a>
                    <a href="#kampanye" class="nav-link font-bold text-sm">Program Donasi</a>
                    <a href="{{ route('admin.campaigns.index') }}" class="btn-admin text-xs px-4 py-2 rounded-lg font-bold">
                        Dashboard Admin →
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert-success text-center py-3 font-bold shadow-sm text-sm tracking-wide">
            {{ session('success') }}
        </div>
    @endif

    {{-- Hero --}}
    <header class="hero-section py-24 px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <span class="hero-badge text-xs uppercase tracking-widest font-bold px-4 py-1.5 rounded-full inline-block">
                Jembatan Kebaikan Anda
            </span>
            <h1 class="hero-title text-4xl md:text-5xl font-extrabold mt-6 leading-tight">
                Ubah Dunia Menjadi Lebih Baik Lewat Donasi Anda
            </h1>
            <p class="hero-subtitle text-md md:text-lg mt-6 max-w-xl mx-auto font-medium">
                Setiap rupiah yang Anda salurkan memiliki kekuatan besar untuk mengukir senyuman dan masa depan mereka yang membutuhkan.
            </p>
            <div class="mt-10">
                <a href="#kampanye" class="btn-primary font-bold px-8 py-3.5 rounded-xl inline-block">
                    Lihat Program Donasi
                </a>
            </div>
        </div>
    </header>

    {{-- Campaign Grid --}}
    <main id="kampanye" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-14">
            <h2 class="section-title text-3xl font-bold tracking-tight">Program Donasi Pilihan</h2>
            <p class="section-subtitle mt-2">Pilih dan bantu wujudkan senyuman mereka hari ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($campaigns as $campaign)
                <div class="campaign-card rounded-2xl overflow-hidden flex flex-col justify-between">

                    {{-- Campaign image --}}
                    <div class="h-52 w-full overflow-hidden card-img-placeholder">
                        <img src="{{ asset('storage/' . $campaign->image) }}"
                             alt="{{ $campaign->title }}"
                             class="w-full h-full object-cover">
                    </div>

                    <div class="p-6">
                        <h3 class="font-bold text-xl line-clamp-2 min-h-[3.5rem] mb-3"
                            style="color: var(--fern);">
                            {{ $campaign->title }}
                        </h3>
                        <p class="text-sm line-clamp-3 mb-6" style="color: var(--sage-green);">
                            {{ $campaign->description }}
                        </p>
                    </div>

                    <div class="p-6 pt-0">
                        @php
                            $percentage = $campaign->target_amount > 0
                                ? ($campaign->collected_amount / $campaign->target_amount) * 100
                                : 0;
                            $percentage = min($percentage, 100);
                        @endphp

                        {{-- Progress bar --}}
                        <div class="w-full progress-bg rounded-full h-2.5 mb-4">
                            <div class="progress-fill h-2.5 rounded-full transition-all duration-1000 ease-in-out"
                                 style="width: {{ $percentage }}%"></div>
                        </div>

                        {{-- Amounts --}}
                        <div class="flex justify-between items-center text-sm mb-6">
                            <div>
                                <span class="text-xs block amount-label">Terkumpul</span>
                                <span class="font-bold amount-value">
                                    Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs block amount-label">Target</span>
                                <span class="font-bold amount-value">
                                    Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('donations.create', $campaign->id) }}"
                           class="block text-center w-full btn-outline font-bold py-3 rounded-xl">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-3 text-center py-16 rounded-2xl border-2 border-dashed empty-state">
                    <p class="text-lg font-medium">Saat ini belum ada program donasi aktif.</p>
                </div>
            @endforelse
        </div>
    </main>

    {{-- Footer --}}
    <footer class="site-footer py-8 text-center text-sm">
        <p>&copy; 2026 Baitul Yatim. Seluruh Hak Cipta Dilindungi.</p>
    </footer>

    <script>
        window.addEventListener('scroll', function () {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 10);
        });
    </script>
</body>
</html>