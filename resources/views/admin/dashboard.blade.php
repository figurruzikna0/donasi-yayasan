<x-app-layout>
    <style>
        :root {
            --honeydew: #f1faeeff;
            --frosted-blue: #a8dadcff;
            --cerulean: #457b9dff;
            --oxford-navy: #1d3557ff;
        }

        .admin-dashboard {
            background-color: var(--honeydew);
            min-height: 100vh;
            color: var(--oxford-navy);
        }

        .admin-header {
            color: var(--oxford-navy) !important;
            letter-spacing: 0.02em;
        }

        /* Top Navigation Container */
        .top-nav-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        /* Action Buttons Styling */
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            border-radius: 9999px; /* Bentuk pill/melingkar biar elegan */
            font-size: 0.875rem;
            font-weight: 700;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(29, 53, 87, 0.05);
        }

        /* Varian Tombol */
        .btn-outline {
            background-color: #ffffff;
            border: 1.5px solid var(--cerulean);
            color: var(--cerulean);
        }
        .btn-outline:hover {
            background-color: var(--frosted-blue);
            color: var(--oxford-navy);
            transform: translateY(-2px);
        }

        .btn-solid {
            background-color: var(--cerulean);
            color: var(--honeydew);
            border: 1.5px solid var(--cerulean);
        }
        .btn-solid:hover {
            background-color: var(--oxford-navy);
            border-color: var(--oxford-navy);
            box-shadow: 0 6px 12px rgba(29, 53, 87, 0.15);
            transform: translateY(-2px);
        }

        .btn-highlight {
            background-color: var(--oxford-navy);
            color: var(--honeydew);
            border: 1.5px solid var(--oxford-navy);
        }
        .btn-highlight:hover {
            background-color: var(--cerulean);
            border-color: var(--cerulean);
            box-shadow: 0 6px 12px rgba(69, 123, 157, 0.2);
            transform: translateY(-2px);
        }

        /* Stat Cards */
        .stat-card {
            background-color: #ffffff;
            border: 1px solid var(--frosted-blue);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(29, 53, 87, 0.05);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(69, 123, 157, 0.12);
            border-color: var(--cerulean);
        }
        .border-accent-1 { border-left: 5px solid var(--cerulean); }
        .border-accent-2 { border-left: 5px solid var(--frosted-blue); }
        .border-accent-3 { border-left: 5px solid var(--oxford-navy); }

        .stat-title { color: var(--cerulean); font-weight: 700; }
        .stat-value { color: var(--oxford-navy); }

        /* Welcome Panel */
        .panel-welcome {
            background-color: #ffffff;
            border: 1px solid var(--frosted-blue);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(29, 53, 87, 0.05);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hour = new Date().getHours();
            let greeting = 'Selamat Datang';
            if (hour >= 5 && hour < 12) greeting = 'Selamat Pagi';
            else if (hour >= 12 && hour < 15) greeting = 'Selamat Siang';
            else if (hour >= 15 && hour < 18) greeting = 'Selamat Sore';
            else greeting = 'Selamat Malam';
            
            const greetingElement = document.getElementById('dynamic-greeting');
            if(greetingElement) greetingElement.innerText = greeting + ' di Panel Admin';
        });
    </script>

    <div class="admin-dashboard">
        <x-slot name="header">
            <h2 class="font-bold text-2xl admin-header leading-tight text-center md:text-left">
                {{ __('Dashboard Admin Yayasan') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="top-nav-wrapper">
                    <a href="#" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Profil Yayasan
                    </a>
                    <a href="#" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"></path></svg>
                        Berita Kegiatan
                    </a>
                    <a href="{{ route('admin.campaigns.index') ?? '#' }}" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Kelola Kampanye
                    </a>

                    <a href="#" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Orang Tua Asuh
                    </a>
                    <a href="#" class="action-btn btn-outline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Data Anak Asuh
                    </a>

                    <a href="#" class="action-btn btn-solid">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Riwayat Transaksi
                    </a>
                    <a href="#" class="action-btn btn-highlight">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        Isi Perkembangan Anak Asuh
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8"> 
                    <div class="stat-card border-accent-1 p-6">
                        <div class="text-xs stat-title truncate uppercase tracking-widest mb-1">Total Donasi (Sukses)</div>
                        <div class="mt-1 text-3xl font-extrabold stat-value">Rp {{ number_format($totalFunds ?? 0, 0, ',', '.') }}</div>
                    </div>
                    
                    <div class="stat-card border-accent-2 p-6">
                        <div class="text-xs stat-title truncate uppercase tracking-widest mb-1">Kampanye Aktif</div>
                        <div class="mt-1 text-3xl font-extrabold stat-value">{{ $activeCampaigns ?? 0 }} <span class="text-sm font-semibold" style="color: var(--cerulean);">Program</span></div>
                    </div>
                    
                    <div class="stat-card border-accent-3 p-6">
                        <div class="text-xs stat-title truncate uppercase tracking-widest mb-1">Total Anak Asuh</div>
                        <div class="mt-1 text-3xl font-extrabold stat-value">{{ $fosterChildren ?? 0 }} <span class="text-sm font-semibold" style="color: var(--cerulean);">Anak</span></div>
                    </div>
                </div>

                <div class="panel-welcome p-6 md:p-8">
                    <div>
                        <h3 class="text-2xl font-extrabold mb-3" style="color: var(--oxford-navy);">
                            <span id="dynamic-greeting">Selamat Datang</span> 👋
                        </h3>
                        <p class="text-md font-medium leading-relaxed" style="color: var(--cerulean);">
                            Kelola operasional yayasan secara terpusat melalui menu di atas. Pastikan untuk <strong>memverifikasi riwayat transaksi</strong> dari orang tua asuh terlebih dahulu. Setelah transaksi divalidasi, Anda dapat langsung beralih ke menu <strong>Isi Perkembangan Anak Asuh</strong> untuk memperbarui data harian mereka.
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>