<x-app-layout>
    <style>
        :root {
            --celadon:       #b3e093;
            --lime-cream:    #d6ec89;
            --muted-olive:   #a1c181;
            --muted-olive-2: #8bb650;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
        }

        .admin-dashboard {
            background: linear-gradient(155deg, #eafcd4 0%, var(--lime-cream) 45%, var(--celadon) 100%);
            min-height: 100vh;
        }

        /* ── Header slot ── */
        .admin-header {
            color: var(--fern) !important;
            letter-spacing: 0.02em;
        }

        /* ── Greeting banner (top) ── */
        .greeting-banner {
            background: linear-gradient(100deg, var(--fern) 0%, var(--sage-green) 55%, var(--muted-olive) 100%);
            border-radius: 16px;
            padding: 20px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            box-shadow: 0 6px 20px rgba(92, 129, 72, 0.25);
            margin-bottom: 2rem;
        }

        .greeting-banner .greeting-text {
            color: #ffffff;
        }

        .greeting-banner .greeting-text h3 {
            font-size: 1.4rem;
            font-weight: 800;
            margin: 0 0 4px;
        }

        .greeting-banner .greeting-text p {
            font-size: 0.88rem;
            color: rgba(255,255,255,0.82);
            margin: 0;
            max-width: 520px;
            line-height: 1.55;
        }

        .greeting-banner .greeting-icon {
            width: 52px;
            height: 52px;
            background: rgba(255,255,255,0.18);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }

        /* ── Nav pill buttons ── */
        .top-nav-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            padding: 0.55rem 1.15rem;
            border-radius: 9999px;
            font-size: 0.82rem;
            font-weight: 700;
            transition: all 0.25s ease;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(92, 129, 72, 0.08);
        }

        .btn-outline {
            background-color: #ffffff;
            border: 1.5px solid var(--muted-olive);
            color: var(--sage-green);
        }
        .btn-outline:hover {
            background-color: var(--celadon);
            border-color: var(--sage-green);
            color: var(--fern);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(92, 129, 72, 0.15);
        }

        .btn-solid {
            background: linear-gradient(135deg, var(--muted-olive-2), var(--sage-green));
            color: #ffffff;
            border: 1.5px solid transparent;
        }
        .btn-solid:hover {
            background: linear-gradient(135deg, var(--sage-green), var(--fern));
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(92, 129, 72, 0.28);
        }

        .btn-highlight {
            background-color: var(--fern);
            color: #ffffff;
            border: 1.5px solid var(--fern);
        }
        .btn-highlight:hover {
            background-color: var(--sage-green);
            border-color: var(--sage-green);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(92, 129, 72, 0.25);
        }

        /* ── Stat cards ── */
        .stat-card {
            background-color: #ffffff;
            border: 1px solid var(--celadon);
            border-radius: 14px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 10px rgba(92, 129, 72, 0.07);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(92, 129, 72, 0.15);
            border-color: var(--muted-olive);
        }

        .border-accent-1 { border-left: 5px solid var(--sage-green); }
        .border-accent-2 { border-left: 5px solid var(--muted-olive-2); }
        .border-accent-3 { border-left: 5px solid var(--fern); }

        .stat-title { color: var(--sage-green); font-weight: 700; }
        .stat-value { color: var(--fern); }
        .stat-unit   { color: var(--muted-olive-2); }
    </style>

    <x-slot name="header">
        <h2 class="font-bold text-2xl admin-header leading-tight text-center md:text-left">
            {{ __('Dashboard Admin Yayasan') }}
        </h2>
    </x-slot>

    <div class="admin-dashboard">
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{-- ① Greeting banner — paling atas ── --}}
                <div class="greeting-banner">
                    <div class="greeting-text">
                        <h3><span id="dynamic-greeting">Selamat Datang</span> 👋</h3>
                        <p>
                            Pastikan untuk <strong>memverifikasi riwayat transaksi</strong> dari orang tua asuh terlebih dahulu.
                            Setelah divalidasi, lanjutkan ke menu <strong>Isi Perkembangan Anak Asuh</strong> untuk memperbarui data harian mereka.
                        </p>
                    </div>
                    <div class="greeting-icon">🌿</div>
                </div>

                {{-- ② Navigation pills ── --}}
                <div class="top-nav-wrapper">
                    <a href="#" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        Profil Yayasan
                    </a>
                    <a href="#" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"/></svg>
                        Berita Kegiatan
                    </a>
                    <a href="{{ route('admin.campaigns.index') }}" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Kelola Kampanye
                    </a>
                    <a href="#" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Orang Tua Asuh
                    </a>
                    <a href="{{ route('admin.foster-children.index') }}" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Data Anak Asuh
                    </a>
                    <a href="{{ route('admin.transactions.index') ?? '#' }}" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Riwayat Transaksi
                    </a>
                    <a href="#" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                        Isi Perkembangan Anak Asuh
                    </a>
                </div>

                {{-- ③ Stat cards ── --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div class="stat-card border-accent-1 p-6">
                        <div class="text-xs stat-title uppercase tracking-widest mb-1">Total Donasi (Sukses)</div>
                        <div class="mt-1 text-3xl font-extrabold stat-value">
                            Rp {{ number_format($totalFunds ?? 0, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="stat-card border-accent-2 p-6">
                        <div class="text-xs stat-title uppercase tracking-widest mb-1">Kampanye Aktif</div>
                        <div class="mt-1 text-3xl font-extrabold stat-value">
                            {{ $activeCampaigns ?? 0 }}
                            <span class="text-sm font-semibold stat-unit">Program</span>
                        </div>
                    </div>

                    <div class="stat-card border-accent-3 p-6">
                        <div class="text-xs stat-title uppercase tracking-widest mb-1">Total Anak Asuh</div>
                        <div class="mt-1 text-3xl font-extrabold stat-value">
                            {{ $fosterChildren ?? 0 }}
                            <span class="text-sm font-semibold stat-unit">Anak</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hour = new Date().getHours();
            let greeting = 'Selamat Datang';
            if      (hour >= 5  && hour < 12) greeting = 'Selamat Pagi';
            else if (hour >= 12 && hour < 15) greeting = 'Selamat Siang';
            else if (hour >= 15 && hour < 18) greeting = 'Selamat Sore';
            else                               greeting = 'Selamat Malam';

            const el = document.getElementById('dynamic-greeting');
            if (el) el.innerText = greeting + ' di Panel Admin';
        });
    </script>
</x-app-layout>