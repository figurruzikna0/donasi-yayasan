<x-app-layout>
    <style>
        :root {
            --celadon:       #b3e093;
            --lime-cream:    #d6ec89;
            --muted-olive:   #a1c181;
            --muted-olive-2: #8bb650;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
            --fern-dark:     #47623a;
            --fern-deep:     #354a2b;
            --bg:            #f3fbea;
        }

        /* ══ SHELL ══ */
        .dash-shell {
            display: flex;
            min-height: 100vh;
            background: var(--bg);
            font-family: 'Inter', system-ui, sans-serif;
        }

        /* ══ SIDEBAR ══ */
        .dash-sidebar {
            width: 230px;
            flex-shrink: 0;
            background: var(--fern);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 20px 18px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand-name {
            font-size: 1rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: -0.01em;
            line-height: 1.2;
        }

        .sidebar-brand-name span { color: var(--celadon); }

        .sidebar-brand-sub {
            font-size: 0.68rem;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .sidebar-section {
            padding: 16px 10px 4px;
        }

        .sidebar-section-label {
            font-size: 0.62rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.38);
            padding: 0 8px;
            margin-bottom: 4px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 10px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.62);
            text-decoration: none;
            transition: all 0.18s;
            margin-bottom: 1px;
            position: relative;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,0.09);
            color: #fff;
        }

        .sidebar-link.active {
            background: rgba(255,255,255,0.13);
            color: #fff;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 22%; bottom: 22%;
            width: 3px;
            background: var(--celadon);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-link svg {
            width: 16px; height: 16px;
            flex-shrink: 0;
            opacity: 0.65;
        }

        .sidebar-link:hover svg,
        .sidebar-link.active svg { opacity: 1; }

        .sidebar-link .link-badge {
            margin-left: auto;
            background: var(--celadon);
            color: var(--fern);
            font-size: 0.6rem;
            font-weight: 800;
            padding: 1px 6px;
            border-radius: 99px;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 12px 10px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 10px;
            font-size: 0.78rem;
            font-weight: 700;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            transition: all 0.18s;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
        }

        .sidebar-logout:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }

        .sidebar-logout svg { width: 15px; height: 15px; opacity: 0.6; }

        /* ══ MAIN ══ */
        .dash-main {
            flex: 1;
            overflow-x: hidden;
            padding: 28px 32px;
            min-width: 0;
        }

        /* ══ TOP BAR ══ */
        .dash-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .dash-greeting h1 {
            font-size: 1.35rem;
            font-weight: 900;
            color: var(--fern-deep);
            margin: 0 0 3px;
        }

        .dash-greeting p {
            font-size: 0.8rem;
            color: var(--sage-green);
            margin: 0;
        }

        .topbar-date {
            background: #fff;
            border: 1.5px solid var(--celadon);
            border-radius: 10px;
            padding: 7px 14px;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--sage-green);
        }

        /* ══ STAT CARDS ══ */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        @media (max-width: 900px) { .stat-grid { grid-template-columns: 1fr; } }

        .stat-card {
            background: #fff;
            border: 1px solid #d4edbe;
            border-radius: 14px;
            padding: 20px 22px;
            box-shadow: 0 3px 12px rgba(92,129,72,0.07);
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px;
            height: 100%;
            border-radius: 14px 0 0 14px;
        }

        .stat-card.card-dana::after  { background: var(--sage-green); }
        .stat-card.card-camp::after  { background: var(--muted-olive-2); }
        .stat-card.card-anak::after  { background: var(--fern); }

        .stat-label {
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--muted-olive);
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--fern-deep);
            line-height: 1;
        }

        .stat-unit {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--muted-olive);
            margin-left: 4px;
        }

        .stat-sub {
            font-size: 0.7rem;
            color: var(--sage-green);
            margin-top: 6px;
            font-weight: 600;
        }

        .stat-icon {
            position: absolute;
            top: 16px; right: 18px;
            width: 36px; height: 36px;
            background: #f0fdf0;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
        }

        /* ══ CHART GRID ══ */
        .chart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        @media (max-width: 1024px) { .chart-grid { grid-template-columns: 1fr; } }

        .chart-card {
            background: #fff;
            border: 1px solid #d4edbe;
            border-radius: 14px;
            padding: 20px 22px;
            box-shadow: 0 3px 12px rgba(92,129,72,0.07);
        }

        .chart-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chart-title {
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--fern-deep);
        }

        .chart-subtitle {
            font-size: 0.7rem;
            color: var(--muted-olive);
            font-weight: 600;
            margin-top: 2px;
        }

        .chart-period-btn {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--sage-green);
            background: #f0fdf0;
            border: 1px solid var(--celadon);
            border-radius: 7px;
            padding: 4px 10px;
            cursor: pointer;
            transition: all 0.15s;
        }

        .chart-period-btn.active,
        .chart-period-btn:hover {
            background: var(--fern);
            color: #fff;
            border-color: var(--fern);
        }

        /* ══ BOTTOM ROW: Recent + Child Status ══ */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 900px) { .bottom-grid { grid-template-columns: 1fr; } }

        .info-card {
            background: #fff;
            border: 1px solid #d4edbe;
            border-radius: 14px;
            padding: 20px 22px;
            box-shadow: 0 3px 12px rgba(92,129,72,0.07);
        }

        .info-card-title {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--fern-deep);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        /* Recent transactions list */
        .txn-row {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 9px 0;
            border-bottom: 1px solid #edf7e2;
        }

        .txn-row:last-child { border-bottom: none; }

        .txn-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .txn-name {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--fern-deep);
        }

        .txn-target {
            font-size: 0.68rem;
            color: var(--muted-olive);
        }

        .txn-amount {
            margin-left: auto;
            font-size: 0.82rem;
            font-weight: 800;
            color: var(--fern);
            white-space: nowrap;
        }

        .txn-badge {
            font-size: 0.62rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
            white-space: nowrap;
        }

        .txn-badge.success { background: #dcfce7; color: #16a34a; }
        .txn-badge.pending { background: #fef9c3; color: #92651a; }
        .txn-badge.failed  { background: #fee2e2; color: #b91c1c; }

        /* Child status donut legend */
        .legend-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #edf7e2;
            font-size: 0.8rem;
        }

        .legend-row:last-child { border-bottom: none; }

        .legend-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .legend-label { font-weight: 700; color: var(--fern-deep); flex: 1; }
        .legend-count { font-weight: 900; color: var(--fern); }
        .legend-pct   { font-size: 0.68rem; color: var(--muted-olive); margin-left: 4px; }

        /* Empty state */
        .empty-txn {
            padding: 32px 0;
            text-align: center;
            color: var(--muted-olive);
            font-size: 0.8rem;
        }
    </style>

    {{-- Hide default x-app-layout padding --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: var(--fern);">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="dash-shell">

        {{-- ══ SIDEBAR ══ --}}
        <aside class="dash-sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-name">Baitul<span>Yatim</span></div>
                <div class="sidebar-brand-sub">Panel Administrasi</div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">Menu Utama</div>

                <a href="{{ route('admin.dashboard') }}" class="sidebar-link active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">Konten</div>

                <a href="{{ route('admin.profil.index') }}" class="sidebar-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Profil Yayasan
                </a>

                <a href="{{ route('admin.news.index') }}" class="sidebar-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"/></svg>
                    Berita Kegiatan
                </a>

                <a href="{{ route('admin.campaigns.index') }}" class="sidebar-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Kelola Kampanye
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">Program OTA</div>

                <a href="{{ route('admin.foster-children.index') }}" class="sidebar-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Data Anak Asuh
                </a>

                <a href="{{ route('admin.transactions.index') }}" class="sidebar-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Riwayat Transaksi
                    @php
                        $pendingCount = \App\Models\Donation::where('status','pending')->count()
                                      + \App\Models\Sponsorship::where('status','pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="link-badge">{{ $pendingCount }}</span>
                    @endif
                </a>
            </div>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-logout">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- ══ MAIN CONTENT ══ --}}
        <main class="dash-main">

            {{-- Topbar --}}
            <div class="dash-topbar">
                <div class="dash-greeting">
                    <h1 id="greeting-text">Selamat Datang 👋</h1>
                    <p>{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }} — Panel Administrasi</p>
                </div>
                <div class="topbar-date" id="topbar-date">—</div>
            </div>

            {{-- Stat Cards --}}
            <div class="stat-grid">
                <div class="stat-card card-dana">
                    <div class="stat-icon">💰</div>
                    <div class="stat-label">Total Dana Terkumpul</div>
                    <div class="stat-value">
                        Rp {{ number_format($totalFunds ?? 0, 0, ',', '.') }}
                    </div>
                    <div class="stat-sub">Dari donasi yang berhasil</div>
                </div>

                <div class="stat-card card-camp">
                    <div class="stat-icon">📣</div>
                    <div class="stat-label">Kampanye Aktif</div>
                    <div class="stat-value">
                        {{ $activeCampaigns ?? 0 }}<span class="stat-unit">Program</span>
                    </div>
                    <div class="stat-sub">Sedang berjalan saat ini</div>
                </div>

                <div class="stat-card card-anak">
                    <div class="stat-icon">👦</div>
                    <div class="stat-label">Total Anak Asuh</div>
                    <div class="stat-value">
                        {{ $fosterChildren ?? 0 }}<span class="stat-unit">Anak</span>
                    </div>
                    <div class="stat-sub">Terdaftar dalam sistem</div>
                </div>
            </div>

            {{-- Charts --}}
            <div class="chart-grid">

                {{-- Cashflow Chart --}}
                <div class="chart-card">
                    <div class="chart-card-header">
                        <div>
                            <div class="chart-title">📈 Cashflow Donasi</div>
                            <div class="chart-subtitle">Total dana masuk per bulan (Rp)</div>
                        </div>
                        <div style="display:flex;gap:5px;">
                            <button class="chart-period-btn active" onclick="setCashflowPeriod('6', this)">6 Bln</button>
                            <button class="chart-period-btn" onclick="setCashflowPeriod('12', this)">12 Bln</button>
                        </div>
                    </div>
                    <canvas id="cashflowChart" height="200"></canvas>
                </div>

                {{-- Donut: Status Anak --}}
                <div class="chart-card">
                    <div class="chart-card-header">
                        <div>
                            <div class="chart-title">👦 Status Anak Asuh</div>
                            <div class="chart-subtitle">Distribusi status saat ini</div>
                        </div>
                    </div>
                    <canvas id="childDonut" height="170"></canvas>
                    <div style="margin-top:14px;" id="donut-legend"></div>
                </div>

            </div>

            {{-- Bottom Row --}}
            <div class="bottom-grid">

                {{-- Recent Transactions --}}
                <div class="info-card">
                    <div class="info-card-title">
                        🧾 Transaksi Terbaru
                        <a href="{{ route('admin.transactions.index') }}"
                           style="margin-left:auto;font-size:0.7rem;font-weight:700;color:var(--sage-green);text-decoration:none;">
                            Lihat Semua →
                        </a>
                    </div>

                    @php
                        $recentDonations = \App\Models\Donation::with('campaign')
                            ->latest()->take(4)->get();
                    @endphp

                    @forelse($recentDonations as $txn)
                        <div class="txn-row">
                            <img class="txn-avatar"
                                 src="https://ui-avatars.com/api/?name={{ urlencode($txn->donor_name) }}&background=b3e093&color=5c8148&rounded=true&bold=true"
                                 alt="">
                            <div style="flex:1;min-width:0;">
                                <div class="txn-name">{{ $txn->donor_name }}</div>
                                <div class="txn-target">{{ $txn->campaign->title ?? '-' }}</div>
                            </div>
                            <div style="text-align:right;">
                                <div class="txn-amount">Rp {{ number_format($txn->amount, 0, ',', '.') }}</div>
                                <span class="txn-badge {{ $txn->status === 'success' ? 'success' : ($txn->status === 'pending' ? 'pending' : 'failed') }}">
                                    {{ $txn->status === 'success' ? 'Sukses' : ($txn->status === 'pending' ? 'Tertunda' : 'Gagal') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-txn">Belum ada transaksi</div>
                    @endforelse
                </div>

                {{-- Child Status Detail --}}
                <div class="info-card">
                    <div class="info-card-title">📊 Rincian Anak Asuh</div>

                    @php
                        $totalAnak    = \App\Models\FosterChild::count();
                        $tersedia     = \App\Models\FosterChild::where('status','Tersedia')->count();
                        $diasuh       = \App\Models\FosterChild::where('status','Diasuh')->count();
                        $lainnya      = $totalAnak - $tersedia - $diasuh;
                    @endphp

                    <div class="legend-row">
                        <span class="legend-dot" style="background:var(--sage-green);"></span>
                        <span class="legend-label">Tersedia / Menunggu OTA</span>
                        <span class="legend-count">{{ $tersedia }}</span>
                        <span class="legend-pct">({{ $totalAnak > 0 ? round($tersedia/$totalAnak*100) : 0 }}%)</span>
                    </div>
                    <div class="legend-row">
                        <span class="legend-dot" style="background:var(--fern);"></span>
                        <span class="legend-label">Sedang Diasuh</span>
                        <span class="legend-count">{{ $diasuh }}</span>
                        <span class="legend-pct">({{ $totalAnak > 0 ? round($diasuh/$totalAnak*100) : 0 }}%)</span>
                    </div>
                    @if($lainnya > 0)
                    <div class="legend-row">
                        <span class="legend-dot" style="background:var(--muted-olive);"></span>
                        <span class="legend-label">Status Lainnya</span>
                        <span class="legend-count">{{ $lainnya }}</span>
                        <span class="legend-pct">({{ $totalAnak > 0 ? round($lainnya/$totalAnak*100) : 0 }}%)</span>
                    </div>
                    @endif

                    <div style="margin-top:16px;padding-top:14px;border-top:1px solid #edf7e2;">
                        <div style="font-size:0.7rem;font-weight:700;color:var(--muted-olive);text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px;">
                            Sponsorship Pending
                        </div>
                        @php
                            $pendingSpons = \App\Models\Sponsorship::where('status','pending')->count();
                        @endphp
                        <div style="font-size:1.3rem;font-weight:900;color:var(--fern);">
                            {{ $pendingSpons }}
                            <span style="font-size:0.78rem;font-weight:700;color:var(--muted-olive);margin-left:4px;">transaksi</span>
                        </div>
                        @if($pendingSpons > 0)
                            <a href="{{ route('admin.transactions.index') }}"
                               style="display:inline-block;margin-top:8px;font-size:0.72rem;font-weight:700;color:#fff;background:var(--fern);padding:5px 12px;border-radius:8px;text-decoration:none;">
                                Proses Sekarang →
                            </a>
                        @endif
                    </div>
                </div>

            </div>

        </main>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
    // ── Greeting & date ──
    document.addEventListener('DOMContentLoaded', function () {
        const h = new Date().getHours();
        const g = h < 5 ? 'Selamat Malam' : h < 12 ? 'Selamat Pagi' : h < 15 ? 'Selamat Siang' : h < 18 ? 'Selamat Sore' : 'Selamat Malam';
        document.getElementById('greeting-text').textContent = g + ' 👋';

        const now = new Date();
        const opts = { weekday:'long', day:'numeric', month:'long', year:'numeric' };
        document.getElementById('topbar-date').textContent = now.toLocaleDateString('id-ID', opts);
    });

    // ── Cashflow data dari backend (PHP → JS) ──
    // Ambil data 12 bulan terakhir
    @php
        $cashflow12 = [];
        $labels12   = [];
        for ($i = 11; $i >= 0; $i--) {
            $date  = now()->subMonths($i);
            $total = \App\Models\Donation::where('status','success')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('amount');
            $cashflow12[] = (int) $total;
            $labels12[]   = $date->locale('id')->isoFormat('MMM YY');
        }
    @endphp

    const allLabels   = @json($labels12);
    const allData     = @json($cashflow12);

    let cashflowPeriod = 6;
    let cashflowChart;

    function buildCashflow(period) {
        const labels = allLabels.slice(-period);
        const data   = allData.slice(-period);

        if (cashflowChart) cashflowChart.destroy();

        const ctx = document.getElementById('cashflowChart').getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, 'rgba(92,129,72,0.22)');
        gradient.addColorStop(1, 'rgba(92,129,72,0)');

        cashflowChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Dana Masuk (Rp)',
                    data,
                    borderColor: '#5c8148',
                    borderWidth: 2.5,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.42,
                    pointBackgroundColor: '#5c8148',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ' Rp ' + ctx.raw.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: '#edf7e2' },
                        ticks: { color: '#a1c181', font: { size: 11, weight: '600' } }
                    },
                    y: {
                        grid: { color: '#edf7e2' },
                        ticks: {
                            color: '#a1c181',
                            font: { size: 11 },
                            callback: v => 'Rp ' + (v >= 1e6 ? (v/1e6).toFixed(1)+'jt' : v >= 1e3 ? (v/1e3).toFixed(0)+'rb' : v)
                        }
                    }
                }
            }
        });
    }

    function setCashflowPeriod(p, btn) {
        cashflowPeriod = parseInt(p);
        document.querySelectorAll('.chart-period-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        buildCashflow(cashflowPeriod);
    }

    // ── Donut chart: status anak asuh ──
    @php
        $tersediaJs = \App\Models\FosterChild::where('status','Tersedia')->count();
        $diasuhJs   = \App\Models\FosterChild::where('status','Diasuh')->count();
        $lainnyaJs  = \App\Models\FosterChild::count() - $tersediaJs - $diasuhJs;
    @endphp

    (function () {
        const tersedia = {{ $tersediaJs }};
        const diasuh   = {{ $diasuhJs }};
        const lainnya  = {{ $lainnyaJs }};
        const total    = tersedia + diasuh + lainnya;

        const ctx = document.getElementById('childDonut').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Tersedia', 'Diasuh', 'Lainnya'],
                datasets: [{
                    data: [tersedia, diasuh, lainnya > 0 ? lainnya : 0],
                    backgroundColor: ['#76a45b', '#5c8148', '#a1c181'],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ' ' + ctx.label + ': ' + ctx.raw + ' anak'
                        }
                    }
                }
            }
        });

        // Legend
        const items = [
            { label: 'Tersedia', count: tersedia, color: '#76a45b' },
            { label: 'Diasuh',   count: diasuh,   color: '#5c8148' },
        ];
        if (lainnya > 0) items.push({ label: 'Lainnya', count: lainnya, color: '#a1c181' });

        const legend = document.getElementById('donut-legend');
        items.forEach(item => {
            const pct = total > 0 ? Math.round(item.count / total * 100) : 0;
            legend.innerHTML += `
                <div class="legend-row">
                    <span class="legend-dot" style="background:${item.color};"></span>
                    <span class="legend-label">${item.label}</span>
                    <span class="legend-count">${item.count}</span>
                    <span class="legend-pct">(${pct}%)</span>
                </div>`;
        });
    })();

    // ── Init cashflow ──
    buildCashflow(6);
    </script>
</x-app-layout>