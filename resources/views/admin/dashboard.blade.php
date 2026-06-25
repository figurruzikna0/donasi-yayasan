<x-app-layout>
    <style>
        :root {
            --honeydew: #f1faeeff;
            --frosted-blue: #a8dadcff;
            --cerulean: #457b9dff;
            --oxford-navy: #1d3557ff;
        }

        .admin-dashboard {
            /* Background utama jadi terang dan fresh */
            background-color: var(--honeydew);
            min-height: 100vh;
            color: var(--oxford-navy);
        }

        /* Header Styling */
        .admin-header {
            color: var(--oxford-navy) !important;
            letter-spacing: 0.02em;
        }

        /* Stat Cards - Dibuat putih bersih biar kontras dengan honeydew */
        .stat-card {
            background-color: #ffffff;
            border: 1px solid var(--frosted-blue);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(29, 53, 87, 0.05);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(69, 123, 157, 0.15);
            border-color: var(--cerulean);
        }

        /* Garis aksen di sebelah kiri card */
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

        /* Quick Action Buttons */
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        /* Tombol Kelola Kampanye */
        .btn-solid {
            background-color: var(--cerulean);
            color: var(--honeydew);
        }
        .btn-solid:hover {
            background-color: var(--oxford-navy);
            box-shadow: 0 8px 15px rgba(29, 53, 87, 0.2);
            transform: scale(1.02);
        }

        /* Tombol Data Anak Asuh */
        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--cerulean);
            color: var(--cerulean);
        }
        .btn-outline:hover {
            background-color: var(--frosted-blue);
            color: var(--oxford-navy);
            border-color: var(--frosted-blue);
            transform: scale(1.02);
        }

        /* Tombol Riwayat Transaksi */
        .btn-dark {
            background-color: var(--oxford-navy);
            color: var(--honeydew);
            border: 2px solid transparent;
        }
        .btn-dark:hover {
            background-color: var(--cerulean);
            transform: scale(1.02);
            box-shadow: 0 8px 15px rgba(69, 123, 157, 0.3);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hour = new Date().getHours();
            let greeting = 'Selamat Datang';
            
            if (hour >= 5 && hour < 12) {
                greeting = 'Selamat Pagi';
            } else if (hour >= 12 && hour < 15) {
                greeting = 'Selamat Siang';
            } else if (hour >= 15 && hour < 18) {
                greeting = 'Selamat Sore';
            } else {
                greeting = 'Selamat Malam';
            }
            
            const greetingElement = document.getElementById('dynamic-greeting');
            if(greetingElement) {
                greetingElement.innerText = greeting + ' di Panel Admin';
            }
        });
    </script>

    <div class="admin-dashboard">
        <x-slot name="header">
            <h2 class="font-bold text-2xl admin-header leading-tight">
                {{ __('Dashboard Admin Yayasan') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
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
                    <div class="mb-8 border-b pb-6" style="border-color: var(--frosted-blue);">
                        <h3 class="text-2xl font-extrabold mb-3" style="color: var(--oxford-navy);">
                            <span id="dynamic-greeting">Selamat Datang</span> 👋
                        </h3>
                        <p class="text-md font-medium" style="color: var(--cerulean);">
                            Kelola operasional yayasan dengan mudah. Pantau transaksi donasi yang masuk untuk memperbarui data perkembangan anak asuh.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        
                        <a href="{{ route('admin.campaigns.index') ?? '#' }}" class="action-btn btn-solid">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Kelola Kampanye
                        </a>

                        <a href="#" class="action-btn btn-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Data Anak Asuh
                        </a>

                        <a href="#" class="action-btn btn-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Riwayat Transaksi
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>