<x-app-layout>
    <style>
        :root {
            --black: #020202ff;
            --evergreen: #0d2818ff;
            --black-forest: #04471cff;
            --sea-green: #058c42ff;
            --malachite: #16db65ff;
        }

        /* Container & Text Overrides */
        .dashboard-container {
            /* Timpa background bawaan app-layout jika diperlukan */
            background-color: var(--black);
            min-height: 100vh;
            color: #e2e8f0; /* warna teks default (slate-200) */
        }

        .card-panel {
            background-color: var(--evergreen);
            border: 1px solid var(--black-forest);
            box-shadow: 0 4px 6px -1px rgba(22, 219, 101, 0.1);
            border-radius: 0.75rem;
        }

        .header-title {
            color: var(--malachite) !important;
            text-shadow: 0 0 10px rgba(22, 219, 101, 0.2);
        }

        .section-title {
            color: var(--sea-green);
            border-bottom: 2px solid var(--black-forest);
            padding-bottom: 0.75rem;
        }

        /* Table Styling */
        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .custom-table th {
            background-color: var(--black-forest);
            color: var(--malachite);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .custom-table tr {
            transition: all 0.3s ease;
        }

        .custom-table tbody tr {
            background-color: var(--evergreen);
        }

        .custom-table tbody tr:hover {
            background-color: var(--black-forest);
            transform: scale(1.01);
            box-shadow: 0 0 15px rgba(5, 140, 66, 0.2);
            z-index: 10;
            position: relative;
        }

        .custom-table td {
            border-bottom: 1px solid var(--black-forest);
            color: #cbd5e1;
        }

        /* Status Badges */
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-sukses {
            background-color: rgba(22, 219, 101, 0.1);
            color: var(--malachite);
            border: 1px solid var(--malachite);
        }

        .badge-tertunda {
            background-color: rgba(234, 179, 8, 0.1);
            color: #facc15;
            border: 1px solid #facc15;
        }

        .badge-gagal {
            background-color: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid #f87171;
        }

        /* Interactive JS effect class */
        .row-clicked {
            animation: pulse-green 0.5s ease;
        }

        @keyframes pulse-green {
            0% { background-color: var(--black-forest); }
            50% { background-color: var(--sea-green); color: var(--black); }
            100% { background-color: var(--evergreen); }
        }
    </style>

    <div class="dashboard-container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 px-4 sm:px-0">
                <h2 class="font-semibold text-2xl header-title leading-tight">
                    {{ __('Dashboard Donatur') }}
                </h2>
                <p class="text-sm mt-1" style="color: var(--sea-green)">Pantau riwayat sedekah dan kontribusi Anda.</p>
            </div>

            <div class="card-panel overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-6 section-title">Riwayat Sedekah</h3>
                    
                    @if($donations->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-400 mb-4">Belum ada catatan sedekah. Yuk, mulai donasi pertamamu!</p>
                            <button class="px-6 py-2 rounded-lg font-bold transition" style="background-color: var(--sea-green); color: var(--black);" onmouseover="this.style.backgroundColor='var(--malachite)'" onmouseout="this.style.backgroundColor='var(--sea-green)'">
                                Start Donasi
                            </button>
                        </div>
                    @else
                        <div class="overflow-x-auto rounded-lg border border-gray-800" style="border-color: var(--black-forest)">
                            <table class="custom-table text-sm text-left">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-4">Tanggal</th>
                                        <th scope="col" class="px-6 py-4">Kampanye</th>
                                        <th scope="col" class="px-6 py-4">Nominal</th>
                                        <th scope="col" class="px-6 py-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donations as $donasi)
                                        <tr onclick="highlightRow(this)" class="cursor-pointer">
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $donasi->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-4 font-medium" style="color: white;">{{ $donasi->campaign->title ?? 'Donasi Umum' }}</td>
                                            <td class="px-6 py-4 font-bold" style="color: var(--malachite);">Rp {{ number_format($donasi->amount, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4">
                                                @if($donasi->status == 'Sukses')
                                                    <span class="badge badge-sukses">Sukses</span>
                                                @elseif($donasi->status == 'Tertunda')
                                                    <span class="badge badge-tertunda">Tertunda</span>
                                                @else
                                                    <span class="badge badge-gagal">{{ $donasi->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script>
        function highlightRow(row) {
            // Reset class animasi di semua baris
            const rows = document.querySelectorAll('.custom-table tbody tr');
            rows.forEach(r => r.classList.remove('row-clicked'));
            
            // Trigger reflow biar animasi bisa jalan berulang kali saat diklik
            void row.offsetWidth;
            
            // Tambahkan class animasi ke baris yang diklik
            row.classList.add('row-clicked');
            
            // Opsional: Logika tambahan misal redirect ke halaman detail donasi
            // window.location.href = '/donasi/detail/' + row.dataset.id;
        }
    </script>
</x-app-layout>