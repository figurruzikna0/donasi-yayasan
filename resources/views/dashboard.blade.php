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

        .dashboard-container {
            background: linear-gradient(160deg, #eafcd4 0%, var(--lime-cream) 40%, var(--celadon) 100%);
            min-height: 100vh;
            color: var(--fern);
        }

        /* ── Card Panel ── */
        .card-panel {
            background-color: #ffffff;
            border: 1px solid var(--celadon);
            box-shadow: 0 8px 24px rgba(92, 129, 72, 0.10);
            border-radius: 1rem;
            overflow: hidden;
        }

        /* ── Page heading ── */
        .header-title {
            color: var(--fern) !important;
        }
        .header-subtitle {
            color: var(--sage-green);
        }

        /* ── Section title with gradient underline ── */
        .section-title {
            color: var(--fern);
            font-weight: 800;
            padding-bottom: 0.75rem;
            position: relative;
            display: inline-block;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--fern), var(--sage-green), var(--muted-olive), transparent);
            border-radius: 2px;
        }

        /* ── Table ── */
        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .custom-table th {
            background-color: var(--fern);
            color: #ffffff;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
        }

        .custom-table tbody tr {
            background-color: #ffffff;
            transition: all 0.2s ease;
        }

        .custom-table tbody tr:hover {
            background-color: rgba(214, 236, 137, 0.3); /* lime-cream transparan */
            transform: scale(1.005);
            box-shadow: 0 2px 12px rgba(92, 129, 72, 0.12);
            z-index: 10;
            position: relative;
        }

        .custom-table td {
            border-bottom: 1px solid #e8f5d9;
            color: var(--fern);
        }

        .custom-table td.td-campaign {
            color: var(--fern);
            font-weight: 600;
        }

        .custom-table td.td-amount {
            color: var(--muted-olive-2);
            font-weight: 700;
        }

        .custom-table td.td-date {
            color: var(--sage-green);
        }

        /* ── Status Badges ── */
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .badge-sukses {
            background-color: var(--celadon);
            color: var(--fern);
            border: 1px solid var(--muted-olive);
        }
        .badge-sukses::before { background-color: var(--sage-green); }

        .badge-tertunda {
            background-color: rgba(234, 179, 8, 0.1);
            color: #92651a;
            border: 1px solid #f0c040;
        }
        .badge-tertunda::before { background-color: #f0c040; }

        .badge-gagal {
            background-color: rgba(239, 68, 68, 0.08);
            color: #b91c1c;
            border: 1px solid #fca5a5;
        }
        .badge-gagal::before { background-color: #f87171; }

        /* ── Row click animation ── */
        .row-clicked {
            animation: pulse-green 0.45s ease;
        }

        @keyframes pulse-green {
            0%   { background-color: #ffffff; }
            40%  { background-color: rgba(139, 182, 80, 0.25); }
            100% { background-color: #ffffff; }
        }

        /* ── Empty state ── */
        .empty-state-icon {
            background-color: var(--celadon);
            color: var(--fern);
            width: 56px; height: 56px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }

        .btn-start {
            background: linear-gradient(135deg, var(--muted-olive-2) 0%, var(--sage-green) 100%);
            color: #ffffff;
            font-weight: 700;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 3px 10px rgba(92, 129, 72, 0.25);
        }
        .btn-start:hover {
            background: linear-gradient(135deg, var(--sage-green) 0%, var(--fern) 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(92, 129, 72, 0.35);
        }
    </style>

    <div class="dashboard-container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Page heading --}}
            <div class="mb-6 px-4 sm:px-0">
                <h2 class="font-extrabold text-2xl header-title leading-tight">
                    {{ __('Dashboard Donatur') }}
                </h2>
                <p class="text-sm mt-1 header-subtitle">Pantau riwayat sedekah dan kontribusi Anda.</p>
            </div>

            <div class="card-panel">
                <div class="p-6">
                    <h3 class="text-lg mb-6 section-title">Riwayat Sedekah</h3>

                    @if($donations->isEmpty())
                        {{-- Empty state --}}
                        <div class="text-center py-14">
                            <div class="empty-state-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <p class="font-semibold mb-1" style="color: var(--fern);">Belum ada catatan sedekah</p>
                            <p class="text-sm mb-5" style="color: var(--sage-green);">Yuk, mulai donasi pertamamu dan ukir kebaikan hari ini!</p>
                            <button class="btn-start">Mulai Donasi</button>
                        </div>
                    @else
                        <div class="overflow-x-auto rounded-xl"
                             style="border: 1px solid var(--celadon);">
                            <table class="custom-table text-sm text-left">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-4">Tanggal</th>
                                        <th class="px-6 py-4">Kampanye</th>
                                        <th class="px-6 py-4">Nominal</th>
                                        <th class="px-6 py-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donations as $donasi)
                                        <tr onclick="highlightRow(this)" class="cursor-pointer">
                                            <td class="px-6 py-4 whitespace-nowrap td-date">
                                                {{ $donasi->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 td-campaign">
                                                {{ $donasi->campaign->title ?? 'Donasi Umum' }}
                                            </td>
                                            <td class="px-6 py-4 td-amount">
                                                Rp {{ number_format($donasi->amount, 0, ',', '.') }}
                                            </td>
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
            document.querySelectorAll('.custom-table tbody tr')
                    .forEach(r => r.classList.remove('row-clicked'));
            void row.offsetWidth; // reflow trigger
            row.classList.add('row-clicked');
        }
    </script>
</x-app-layout>