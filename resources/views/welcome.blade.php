<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baitul Yatim - Salurkan Kebaikan Anda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        :root {
            --honeydew: #f1faeeff;
            --frosted-blue: #a8dadcff;
            --cerulean: #457b9dff;
            --oxford-navy: #1d3557ff;
        }

        body {
            background-color: var(--honeydew);
            color: var(--oxford-navy);
        }

        /* Navbar Styling */
        .custom-nav {
            background-color: rgba(241, 250, 238, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid transparent;
            transition: all 0.3s ease;
        }
        .custom-nav.scrolled {
            border-bottom: 1px solid var(--frosted-blue);
            box-shadow: 0 4px 20px rgba(69, 123, 157, 0.1);
        }
        .nav-link {
            color: var(--cerulean);
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: var(--oxford-navy);
        }
        .btn-admin {
            background-color: transparent;
            border: 1px solid var(--cerulean);
            color: var(--cerulean);
            transition: all 0.3s ease;
        }
        .btn-admin:hover {
            background-color: var(--cerulean);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(180deg, var(--frosted-blue) 0%, var(--honeydew) 100%);
            border-bottom: 1px solid var(--frosted-blue);
        }
        .hero-badge {
            background-color: rgba(69, 123, 157, 0.1);
            color: var(--cerulean);
            border: 1px solid var(--cerulean);
        }
        .hero-title { color: var(--oxford-navy); }
        .btn-primary {
            background-color: var(--oxford-navy);
            color: var(--honeydew);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: var(--cerulean);
            transform: translateY(-2px);
        }

        /* Campaign Cards */
        .campaign-card {
            background-color: #ffffff;
            border: 1px solid var(--frosted-blue);
            transition: all 0.3s ease;
        }
        .campaign-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(69, 123, 157, 0.15);
        }
        
        /* Progress Bar */
        .progress-bg { background-color: var(--frosted-blue); }
        .progress-fill { background-color: var(--cerulean); }

        /* Outline Button (Donasi) */
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--cerulean);
            color: var(--cerulean);
        }
        .btn-outline:hover {
            background-color: var(--cerulean);
            color: white;
        }

        /* Alert Success */
        .alert-success {
            background-color: var(--frosted-blue);
            border-bottom: 1px solid var(--cerulean);
            color: var(--oxford-navy);
        }
    </style>
</head>
<body class="font-sans antialiased">

    <nav id="navbar" class="custom-nav sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold tracking-wide text-oxford-navy">❤️ Baitul Yatim</span>
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

    @if(session('success'))
        <div class="alert-success text-center py-3 font-bold shadow-sm text-sm tracking-wide">
            {{ session('success') }}
        </div>
    @endif

    <header class="hero-section py-20 px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <span class="hero-badge text-xs uppercase tracking-widest font-bold px-4 py-1.5 rounded-full">Jembatan Kebaikan Anda</span>
            <h1 class="hero-title text-4xl md:text-5xl font-extrabold mt-6 leading-tight">Ubah Dunia Menjadi Lebih Baik Lewat Donasi Anda</h1>
            <p class="text-md md:text-lg mt-6 max-w-xl mx-auto font-medium" style="color: var(--cerulean);">Setiap rupiah yang Anda salurkan memiliki kekuatan besar untuk mengukir senyuman dan masa depan mereka yang membutuhkan.</p>
            <div class="mt-10">
                <a href="#kampanye" class="btn-primary font-bold px-8 py-3.5 rounded-xl shadow-lg inline-block">
                    Lihat Program Donasi
                </a>
            </div>
        </div>
    </header>

    <main id="kampanye" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold tracking-tight text-oxford-navy">Program Donasi Pilihan</h2>
            <p class="mt-2 text-cerulean">Pilih dan bantu wujudkan senyuman mereka hari ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($campaigns as $campaign)
                <div class="campaign-card rounded-2xl overflow-hidden flex flex-col justify-between">
                    <div class="h-52 w-full overflow-hidden" style="background-color: var(--frosted-blue);">
                        <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-oxford-navy line-clamp-2 min-h-[3.5rem] mb-3">
                            {{ $campaign->title }}
                        </h3>
                        <p class="text-sm line-clamp-3 mb-6" style="color: var(--cerulean);">
                            {{ $campaign->description }}
                        </p>
                    </div>

                    <div class="p-6 pt-0">
                        @php
                            $percentage = $campaign->target_amount > 0 ? ($campaign->collected_amount / $campaign->target_amount) * 100 : 0;
                            $percentage = $percentage > 100 ? 100 : $percentage;
                        @endphp

                        <div class="w-full progress-bg rounded-full h-2.5 mb-4">
                            <div class="progress-fill h-2.5 rounded-full transition-all duration-1000 ease-in-out" style="width: {{ $percentage }}%"></div>
                        </div>

                        <div class="flex justify-between items-center text-sm mb-6">
                            <div>
                                <span class="text-xs block text-cerulean">Terkumpul</span>
                                <span class="font-bold text-oxford-navy">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs block text-cerulean">Target</span>
                                <span class="font-bold text-oxford-navy">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('donations.create', $campaign->id) }}" class="block text-center w-full btn-outline font-bold py-3 rounded-xl transition">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-3 text-center py-16 rounded-2xl border border-dashed border-cerulean">
                    <p class="text-lg font-medium text-cerulean">Saat ini belum ada program donasi aktif.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="py-8 text-center text-sm border-t border-frosted-blue bg-white">
        <p class="text-oxford-navy">&copy; 2026 Baitul Yatim. Seluruh Hak Cipta Dilindungi.</p>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 10);
        });
    </script>
</body>
</html>