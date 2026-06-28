<x-app-layout>
    <style>
        :root {
            --celadon:       #b3e093;
            --muted-olive:   #a1c181;
            --muted-olive-2: #8bb650;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
            --fern-dark:     #47623a;
            --fern-deep:     #354a2b;
        }

        .shell { display: flex; height: 100vh; overflow: hidden; background-color: #f3fbea; font-family: 'Inter', system-ui, sans-serif; color: var(--fern-deep); }

        .sidebar { width: 240px; flex-shrink: 0; background-color: var(--fern); display: flex; flex-direction: column; z-index: 20; }
        .sidebar-logo { height: 64px; display: flex; align-items: center; gap: 10px; padding: 0 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .logo-icon { width: 34px; height: 34px; background: var(--celadon); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .logo-icon svg { color: var(--fern); }
        .logo-text { font-size: 1.1rem; font-weight: 900; color: #ffffff; letter-spacing: -0.02em; }
        .logo-text span { color: var(--celadon); }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 20px 12px; display: flex; flex-direction: column; gap: 2px; }
        .nav-section-label { font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.45); padding: 0 10px; margin: 12px 0 6px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: 10px; font-size: 0.845rem; font-weight: 600; color: rgba(255,255,255,0.65); text-decoration: none; transition: all 0.18s ease; position: relative; }
        .nav-item:hover { background-color: rgba(255,255,255,0.08); color: #ffffff; }
        .nav-item svg { width: 17px; height: 17px; flex-shrink: 0; opacity: 0.7; transition: opacity 0.18s; }
        .nav-item:hover svg { opacity: 1; }
        .nav-item.active { background-color: rgba(255,255,255,0.12); color: #ffffff; }
        .nav-item.active::before { content: ''; position: absolute; left: 0; top: 20%; bottom: 20%; width: 3px; background: var(--celadon); border-radius: 0 3px 3px 0; }
        .nav-item.active svg { opacity: 1; }
        .nav-badge { margin-left: auto; background: var(--celadon); color: var(--fern); font-size: 0.65rem; font-weight: 800; padding: 1px 7px; border-radius: 99px; min-width: 20px; text-align: center; }
        .sidebar-footer { padding: 14px 12px; border-top: 1px solid rgba(255,255,255,0.1); }
        .user-card { display: flex; align-items: center; gap: 10px; padding: 8px 10px; border-radius: 10px; cursor: pointer; transition: background 0.18s; }
        .user-card:hover { background: rgba(255,255,255,0.08); }
        .user-card img { width: 36px; height: 36px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.2); }
        .user-card .user-name { font-size: 0.82rem; font-weight: 700; color: #ffffff; }
        .user-card .user-email { font-size: 0.72rem; color: rgba(255,255,255,0.5); }

        .main-area { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .topbar { height: 64px; background: rgba(243, 251, 234, 0.92); backdrop-filter: blur(12px); border-bottom: 1px solid #d4edbe; display: flex; align-items: center; justify-content: space-between; padding: 0 28px; z-index: 10; flex-shrink: 0; }
        .search-wrap { position: relative; width: 280px; }
        .search-wrap svg { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; color: var(--muted-olive); }
        .search-input-top { width: 100%; padding: 7px 12px 7px 34px; background: #ffffff; border: 1.5px solid var(--celadon); border-radius: 10px; font-size: 0.82rem; color: var(--fern); outline: none; }
        .search-input-top::placeholder { color: var(--muted-olive); }
        .topbar-actions { display: flex; align-items: center; gap: 10px; }
        .icon-btn { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: #ffffff; border: 1.5px solid var(--celadon); color: var(--sage-green); cursor: pointer; }
        .icon-btn svg { width: 17px; height: 17px; }

        .content-area { flex: 1; overflow-x: hidden; overflow-y: auto; padding: 28px; background: #f3fbea; }

        .page-header { display: flex; flex-direction: row; align-items: flex-end; justify-content: space-between; gap: 12px; margin-bottom: 22px; flex-wrap: wrap; }
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 0.75rem; font-weight: 600; color: var(--muted-olive); margin-bottom: 4px; }
        .breadcrumb a { color: var(--sage-green); text-decoration: none; }
        .page-title { font-size: 1.45rem; font-weight: 900; color: var(--fern); letter-spacing: -0.02em; margin: 0; }
        .page-subtitle { font-size: 0.82rem; color: var(--sage-green); margin-top: 3px; }
        .header-actions { display: flex; gap: 8px; }
        .btn-secondary {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 16px;
            background: #ffffff;
            border: 1.5px solid var(--muted-olive);
            border-radius: 10px;
            font-size: 0.8rem; font-weight: 700;
            color: var(--sage-green);
            text-decoration: none;
            transition: all 0.18s;
            white-space: nowrap;
        }
        .btn-secondary:hover { background: var(--celadon); border-color: var(--sage-green); color: var(--fern); }

        .table-card { background: #ffffff; border: 1px solid #d4edbe; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(92,129,72,0.07); }
        .toolbar { padding: 14px 20px; border-bottom: 1px solid #e8f5d9; display: flex; flex-wrap: wrap; gap: 10px; align-items: center; justify-content: space-between; background: #f9fdf4; }
        .search-table-wrap { position: relative; width: 100%; max-width: 300px; }
        .search-table-wrap svg { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: var(--muted-olive); }
        .table-search-input { width: 100%; padding: 7px 12px 7px 32px; background: #ffffff; border: 1.5px solid var(--celadon); border-radius: 9px; font-size: 0.8rem; color: var(--fern); outline: none; box-sizing: border-box; }
        .table-search-input::placeholder { color: var(--muted-olive); }
        .filter-select-wrap { position: relative; }
        .filter-select { appearance: none; padding: 7px 30px 7px 12px; background: #ffffff; border: 1.5px solid var(--celadon); border-radius: 9px; font-size: 0.8rem; font-weight: 700; color: var(--sage-green); cursor: pointer; outline: none; }
        .filter-chevron { pointer-events: none; position: absolute; right: 9px; top: 50%; transform: translateY(-50%); width: 13px; height: 13px; color: var(--muted-olive); }

        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead { background: #f3fbea; border-bottom: 1.5px solid #d4edbe; }
        .data-table th { padding: 11px 20px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.07em; color: var(--sage-green); white-space: nowrap; }
        .data-table tbody tr { border-bottom: 1px solid #edf7e2; }
        .data-table tbody tr:hover { background: rgba(214,236,137,0.18); }
        .data-table td { padding: 13px 20px; vertical-align: middle; }

        .child-cell { display: flex; align-items: center; gap: 11px; }
        .child-avatar { width: 38px; height: 38px; border-radius: 50%; border: 2px solid var(--celadon); object-fit: cover; flex-shrink: 0; }
        .child-name { font-size: 0.84rem; font-weight: 800; color: var(--fern); }
        .child-age { font-size: 0.72rem; color: var(--muted-olive); }

        .donor-name { font-size: 0.83rem; font-weight: 800; color: var(--fern); margin-bottom: 2px; }
        .contact-link { display: flex; align-items: center; gap: 5px; font-size: 0.78rem; color: var(--sage-green); text-decoration: none; margin-top: 2px; }
        .contact-link:hover { color: var(--fern); text-decoration: underline; }
        .no-sponsor { font-size: 0.8rem; color: var(--muted-olive); font-style: italic; }

        .package-tag { display: inline-block; padding: 2px 8px; background: #fdf6e3; border: 1px solid #e8d8a0; border-radius: 6px; font-size: 0.68rem; font-weight: 700; color: #92651a; margin-top: 5px; }
        .payment-method-note { font-size: 0.7rem; color: var(--muted-olive); margin-top: 3px; }

        .period-main { font-size: 0.8rem; font-weight: 700; color: var(--fern); }
        .period-sub { font-size: 0.7rem; margin-top: 2px; }
        .period-sub.aktif { color: #16a34a; }
        .period-sub.lewat { color: #b91c1c; }

        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 8px; font-size: 0.72rem; font-weight: 800; }
        .badge-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
        .badge-diasuh { background: rgba(34, 197, 94, 0.1); color: #16a34a; border: 1px solid rgba(34,197,94,0.25); }
        .badge-diasuh .badge-dot { background: #22c55e; }
        .badge-tersedia { background: rgba(148, 163, 184, 0.12); color: #64748b; border: 1px solid rgba(148,163,184,0.3); }
        .badge-tersedia .badge-dot { background: #94a3b8; }

        .empty-state { padding: 64px 24px; text-align: center; }
        .empty-icon { width: 56px; height: 56px; background: #edf7e2; border: 1px solid var(--celadon); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; }
        .empty-icon svg { width: 26px; height: 26px; color: var(--muted-olive); }
        .empty-title { font-size: 0.95rem; font-weight: 800; color: var(--fern); }
        .empty-sub { font-size: 0.78rem; color: var(--sage-green); margin-top: 4px; }

        .hidden { display: none !important; }

        @media (max-width: 767px) { .sidebar { display: none; } }
    </style>

    <div class="shell">

        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <span class="logo-text">Baitul<span>Yatim</span></span>
            </div>
            <nav class="sidebar-nav">
                <p class="nav-section-label">Menu Utama</p>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Manajemen Donasi
                    <span class="nav-badge">{{ $pendingCount }}</span>
                </a>
                <a href="{{ route('admin.sponsorships.contacts') }}" class="nav-item active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Orang Tua Asuh
                </a>
            </nav>
            <div class="sidebar-footer">
                <div class="user-card">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=b3e093&color=5c8148&rounded=true&bold=true" alt="Admin">
                    <div>
                        <p class="user-name">Admin Pusat</p>
                        <p class="user-email">admin@yayasan.org</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="main-area">
            <header class="topbar">
                <div class="search-wrap">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" class="search-input-top" placeholder="Pencarian cepat…">
                </div>
                <div class="topbar-actions">
                    <button class="icon-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </button>
                </div>
            </header>

            <main class="content-area">
                <div class="page-header">
                    <div>
                        <nav class="breadcrumb">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            <span>/</span>
                            <span>Orang Tua Asuh</span>
                        </nav>
                        <h1 class="page-title">Data Anak &amp; Orang Tua Asuh</h1>
                        <p class="page-subtitle">Kontak orang tua asuh per anak — buat keperluan notifikasi langsung, tanpa rincian transaksi.</p>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('admin.foster-children.index') }}" class="btn-secondary">⚙️ Kelola Data Anak Asuh</a>
                        <a href="{{ route('admin.transactions.index') }}" class="btn-secondary">📋 Riwayat Transaksi</a>
                    </div>
                </div>

                <div class="table-card">
                    <div class="toolbar">
                        <div class="search-table-wrap">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" id="tableSearch" class="table-search-input" placeholder="Cari nama anak atau orang tua asuh…">
                        </div>
                        <div class="filter-select-wrap">
                            <select id="statusFilter" class="filter-select">
                                <option value="all">Semua</option>
                                <option value="disponsori">Sudah Disponsori</option>
                                <option value="belum">Belum Disponsori</option>
                            </select>
                            <svg class="filter-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Anak Asuh</th>
                                    <th>Orang Tua Asuh</th>
                                    <th>Masa Aktif</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @forelse($children as $child)
                                    @php
                                        $sponsorship = $child->activeSponsorship;
                                        $isExpiredPeriod = $sponsorship?->expires_at?->isPast();
                                        $remainingDays = $sponsorship?->expires_at ? now()->diffInDays($sponsorship->expires_at) : null;
                                    @endphp
                                    <tr class="data-row"
                                        data-search="{{ strtolower($child->name . ' ' . ($sponsorship->donor_name ?? '')) }}"
                                        data-status="{{ $sponsorship ? 'disponsori' : 'belum' }}">
                                        <td>
                                            <div class="child-cell">
                                                <img class="child-avatar"
                                                     src="{{ $child->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($child->name) . '&background=b3e093&color=5c8148&rounded=true&bold=true' }}"
                                                     alt="{{ $child->name }}">
                                                <div>
                                                    <div class="child-name">{{ $child->name }}</div>
                                                    <div class="child-age">{{ $child->age }} Tahun</div>
                                                    @if($child->status === 'Diasuh')
                                                        <span class="badge badge-diasuh" style="margin-top:4px;"><span class="badge-dot"></span> Diasuh</span>
                                                    @else
                                                        <span class="badge badge-tersedia" style="margin-top:4px;"><span class="badge-dot"></span> Tersedia</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            @if($sponsorship)
                                                <div class="donor-name">{{ $sponsorship->donor_name }}</div>
                                                <a href="mailto:{{ $sponsorship->donor_email }}" class="contact-link">✉️ {{ $sponsorship->donor_email }}</a>
                                                @if($sponsorship->donor_phone)
                                                    <a href="https://wa.me/{{ $sponsorship->donor_phone }}" target="_blank" class="contact-link">📱 {{ $sponsorship->donor_phone }}</a>
                                                @endif
                                                <span class="package-tag">{{ $sponsorship->package ?? '-' }}</span>
                                                @if($sponsorship->payment_method)
                                                <div class="payment-method-note">via {{ $sponsorship->payment_method }}</div>
                                                @endif
                                            @else
                                                <span class="no-sponsor">Belum ada orang tua asuh</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($sponsorship && $sponsorship->starts_at && $sponsorship->expires_at)
                                                <div class="period-main">{{ $sponsorship->starts_at->format('d M Y') }} – {{ $sponsorship->expires_at->format('d M Y') }}</div>
                                                @if($isExpiredPeriod)
                                                    <div class="period-sub lewat">Lewat {{ $remainingDays }} hari</div>
                                                @else
                                                    <div class="period-sub aktif">{{ $remainingDays }} hari lagi</div>
                                                @endif
                                            @else
                                                <span class="no-sponsor">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <div class="empty-state">
                                                <div class="empty-icon">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                </div>
                                                <p class="empty-title">Belum Ada Data Anak Asuh</p>
                                                <p class="empty-sub">Tambahkan data anak asuh lewat menu "Kelola Data Anak Asuh".</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                <tr id="noResultRow" class="hidden">
                                    <td colspan="3">
                                        <div class="empty-state">
                                            <p class="empty-title">Tidak Ditemukan</p>
                                            <p class="empty-sub">Coba kata kunci pencarian yang berbeda.</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput  = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const allRows      = Array.from(document.querySelectorAll('.data-row'));
            const noResultRow  = document.getElementById('noResultRow');

            function filter() {
                const q    = searchInput.value.toLowerCase().trim();
                const stat = statusFilter.value;
                let visibleCount = 0;

                allRows.forEach(row => {
                    const match = row.dataset.search.includes(q) && (stat === 'all' || row.dataset.status === stat);
                    row.classList.toggle('hidden', !match);
                    if (match) visibleCount++;
                });

                noResultRow.classList.toggle('hidden', visibleCount !== 0 || allRows.length === 0);
            }

            searchInput.addEventListener('input', filter);
            statusFilter.addEventListener('change', filter);
        });
    </script>
</x-app-layout>