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
        }

        .shell {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background-color: #f3fbea;
            font-family: 'Inter', system-ui, sans-serif;
            color: var(--fern-deep);
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background-color: var(--fern);
            display: flex;
            flex-direction: column;
            z-index: 20;
        }
        .sidebar-logo {
            height: 64px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .logo-icon {
            width: 34px; height: 34px;
            background: var(--celadon);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .logo-icon svg { color: var(--fern); }
        .logo-text { font-size: 1.1rem; font-weight: 900; color: #ffffff; letter-spacing: -0.02em; }
        .logo-text span { color: var(--celadon); }
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 20px 12px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .nav-section-label {
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.45);
            padding: 0 10px;
            margin: 12px 0 6px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 10px;
            font-size: 0.845rem;
            font-weight: 600;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            transition: all 0.18s ease;
            position: relative;
        }
        .nav-item:hover { background-color: rgba(255,255,255,0.08); color: #ffffff; }
        .nav-item svg { width: 17px; height: 17px; flex-shrink: 0; opacity: 0.7; transition: opacity 0.18s; }
        .nav-item:hover svg { opacity: 1; }
        .nav-item.active { background-color: rgba(255,255,255,0.12); color: #ffffff; }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            background: var(--celadon);
            border-radius: 0 3px 3px 0;
        }
        .nav-item.active svg { opacity: 1; }
        .nav-badge {
            margin-left: auto;
            background: var(--celadon);
            color: var(--fern);
            font-size: 0.65rem;
            font-weight: 800;
            padding: 1px 7px;
            border-radius: 99px;
            min-width: 20px;
            text-align: center;
        }
        .sidebar-footer { padding: 14px 12px; border-top: 1px solid rgba(255,255,255,0.1); }
        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.18s;
        }
        .user-card:hover { background: rgba(255,255,255,0.08); }
        .user-card img { width: 36px; height: 36px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.2); }
        .user-card .user-name { font-size: 0.82rem; font-weight: 700; color: #ffffff; }
        .user-card .user-email { font-size: 0.72rem; color: rgba(255,255,255,0.5); }

        /* ── MAIN ── */
        .main-area { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .topbar {
            height: 64px;
            background: rgba(243, 251, 234, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #d4edbe;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 10;
            flex-shrink: 0;
        }
        .search-wrap { position: relative; width: 280px; }
        .search-wrap svg { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); width: 15px; height: 15px; color: var(--muted-olive); }
        .search-input-top {
            width: 100%;
            padding: 7px 12px 7px 34px;
            background: #ffffff;
            border: 1.5px solid var(--celadon);
            border-radius: 10px;
            font-size: 0.82rem;
            color: var(--fern);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-input-top::placeholder { color: var(--muted-olive); }
        .search-input-top:focus { border-color: var(--muted-olive-2); box-shadow: 0 0 0 3px rgba(139,182,80,0.15); }
        .topbar-actions { display: flex; align-items: center; gap: 10px; }
        .icon-btn {
            width: 36px; height: 36px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 10px;
            background: #ffffff;
            border: 1.5px solid var(--celadon);
            color: var(--sage-green);
            cursor: pointer;
            transition: all 0.18s;
        }
        .icon-btn:hover { background: var(--celadon); color: var(--fern); }
        .icon-btn svg { width: 17px; height: 17px; }

        .content-area { flex: 1; overflow-x: hidden; overflow-y: auto; padding: 28px; background: #f3fbea; }

        /* ── TOAST ── */
        .toast {
            position: fixed; top: 78px; right: 24px; z-index: 50;
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px;
            background: #ffffff;
            border: 1px solid var(--celadon);
            border-left: 4px solid var(--sage-green);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(92,129,72,0.15);
            max-width: 340px;
            animation: slideDown 0.35s ease-out;
        }
        .toast-icon { width: 30px; height: 30px; background: var(--celadon); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .toast-icon svg { width: 15px; height: 15px; color: var(--fern); }
        .toast-msg { font-size: 0.83rem; font-weight: 700; color: var(--fern); flex: 1; }
        .toast-close { width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; border-radius: 6px; cursor: pointer; color: var(--muted-olive); transition: all 0.15s; }
        .toast-close:hover { background: #f3fbea; color: var(--fern); }
        .toast-close svg { width: 13px; height: 13px; }
        @keyframes slideDown { from { transform: translateY(-16px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* ── PAGE HEADER ── */
        .page-header { display: flex; flex-direction: row; align-items: flex-end; justify-content: space-between; gap: 12px; margin-bottom: 22px; flex-wrap: wrap; }
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 0.75rem; font-weight: 600; color: var(--muted-olive); margin-bottom: 4px; }
        .breadcrumb a { color: var(--sage-green); text-decoration: none; }
        .breadcrumb a:hover { color: var(--fern); }
        .page-title { font-size: 1.45rem; font-weight: 900; color: var(--fern); letter-spacing: -0.02em; margin: 0; }
        .page-subtitle { font-size: 0.82rem; color: var(--sage-green); margin-top: 3px; }

        /* ── TAB SWITCHER ── */
        .tab-wrapper {
            display: flex;
            gap: 0;
            margin-bottom: 20px;
            background: #ffffff;
            border: 1.5px solid var(--celadon);
            border-radius: 12px;
            padding: 4px;
            width: fit-content;
        }
        .tab-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            border-radius: 9px;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--sage-green);
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .tab-btn:hover { background: #f3fbea; color: var(--fern); }
        .tab-btn.active {
            background: var(--fern);
            color: #ffffff;
            box-shadow: 0 3px 10px rgba(92,129,72,0.25);
        }
        .tab-btn .tab-count {
            background: rgba(255,255,255,0.25);
            color: #ffffff;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 1px 7px;
            border-radius: 99px;
            min-width: 20px;
            text-align: center;
        }
        .tab-btn:not(.active) .tab-count {
            background: var(--celadon);
            color: var(--fern);
        }
        .tab-btn .tab-pending {
            background: #fef3c7;
            color: #92400e;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 1px 7px;
            border-radius: 99px;
        }
        .tab-btn.active .tab-pending {
            background: rgba(255,255,255,0.2);
            color: #ffffff;
        }

        /* ── TABLE CARD ── */
        .table-card { background: #ffffff; border: 1px solid #d4edbe; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(92,129,72,0.07); }
        .toolbar { padding: 14px 20px; border-bottom: 1px solid #e8f5d9; display: flex; flex-wrap: wrap; gap: 10px; align-items: center; justify-content: space-between; background: #f9fdf4; }
        .search-table-wrap { position: relative; width: 100%; max-width: 300px; }
        .search-table-wrap svg { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: var(--muted-olive); }
        .table-search-input { width: 100%; padding: 7px 12px 7px 32px; background: #ffffff; border: 1.5px solid var(--celadon); border-radius: 9px; font-size: 0.8rem; color: var(--fern); outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box; }
        .table-search-input::placeholder { color: var(--muted-olive); }
        .table-search-input:focus { border-color: var(--muted-olive-2); box-shadow: 0 0 0 3px rgba(139,182,80,0.15); background: #fff; }
        .filters-row { display: flex; gap: 8px; flex-wrap: wrap; }
        .filter-select-wrap { position: relative; }
        .filter-select { appearance: none; padding: 7px 30px 7px 12px; background: #ffffff; border: 1.5px solid var(--celadon); border-radius: 9px; font-size: 0.8rem; font-weight: 700; color: var(--sage-green); cursor: pointer; outline: none; transition: border-color 0.18s; }
        .filter-select:focus { border-color: var(--muted-olive-2); box-shadow: 0 0 0 3px rgba(139,182,80,0.12); }
        .filter-chevron { pointer-events: none; position: absolute; right: 9px; top: 50%; transform: translateY(-50%); width: 13px; height: 13px; color: var(--muted-olive); }

        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead { background: #f3fbea; border-bottom: 1.5px solid #d4edbe; }
        .data-table th { padding: 11px 20px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.07em; color: var(--sage-green); white-space: nowrap; }
        .data-table tbody tr { border-bottom: 1px solid #edf7e2; transition: background 0.15s; }
        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: rgba(214,236,137,0.18); }
        .data-table td { padding: 13px 20px; vertical-align: middle; }

        .donor-cell { display: flex; align-items: center; gap: 11px; }
        .donor-avatar { width: 38px; height: 38px; border-radius: 50%; border: 2px solid var(--celadon); object-fit: cover; flex-shrink: 0; }
        .donor-name { font-size: 0.84rem; font-weight: 800; color: var(--fern); }
        .donor-email { font-size: 0.72rem; color: var(--muted-olive); margin: 1px 0 4px; }
        .donor-phone { font-size: 0.7rem; color: var(--sage-green); }

        .campaign-tag { display: inline-block; padding: 2px 8px; background: #edf7e2; border: 1px solid var(--celadon); border-radius: 6px; font-size: 0.68rem; font-weight: 700; color: var(--sage-green); }
        .package-tag { display: inline-block; padding: 2px 8px; background: #fdf6e3; border: 1px solid #e8d8a0; border-radius: 6px; font-size: 0.68rem; font-weight: 700; color: #92651a; }
        .sponsor-tag { display: inline-block; padding: 2px 8px; background: #ede9fe; border: 1px solid #c4b5fd; border-radius: 6px; font-size: 0.68rem; font-weight: 700; color: #6d28d9; }

        .amount-value { font-size: 0.9rem; font-weight: 900; color: var(--fern); }
        .order-id { font-size: 0.68rem; font-family: monospace; color: var(--muted-olive); margin-top: 3px; display: flex; align-items: center; gap: 4px; }
        .order-id svg { width: 11px; height: 11px; }
        .payment-method-note { font-size: 0.68rem; color: var(--muted-olive); margin-top: 1px; }

        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 8px; font-size: 0.72rem; font-weight: 800; }
        .badge-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
        .badge-sukses { background: rgba(34, 197, 94, 0.1); color: #16a34a; border: 1px solid rgba(34,197,94,0.25); }
        .badge-sukses .badge-dot { background: #22c55e; }
        .badge-pending { background: rgba(234, 179, 8, 0.1); color: #92651a; border: 1px solid rgba(234,179,8,0.3); }
        .badge-pending .badge-dot { background: #eab308; animation: pulse 1.5s infinite; }
        .badge-gagal { background: rgba(239, 68, 68, 0.08); color: #b91c1c; border: 1px solid rgba(239,68,68,0.2); }
        .badge-gagal .badge-dot { background: #ef4444; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.35; } }

        .date-main { font-size: 0.82rem; font-weight: 700; color: var(--fern); text-align: right; }
        .date-time { font-size: 0.7rem; color: var(--muted-olive); text-align: right; margin-top: 2px; }

        .action-cell { display: flex; align-items: center; justify-content: center; gap: 6px; }
        .delete-btn { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: none; background: transparent; color: var(--muted-olive); cursor: pointer; transition: all 0.18s; }
        .delete-btn:hover { background: rgba(239,68,68,0.1); color: #dc2626; }
        .delete-btn svg { width: 16px; height: 16px; }
        .approve-btn { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: none; background: transparent; color: var(--muted-olive); cursor: pointer; transition: all 0.18s; }
        .approve-btn:hover { background: rgba(34,197,94,0.1); color: #16a34a; }
        .approve-btn svg { width: 16px; height: 16px; }

        .empty-state { padding: 64px 24px; text-align: center; }
        .empty-icon { width: 56px; height: 56px; background: #edf7e2; border: 1px solid var(--celadon); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; }
        .empty-icon svg { width: 26px; height: 26px; color: var(--muted-olive); }
        .empty-title { font-size: 0.95rem; font-weight: 800; color: var(--fern); }
        .empty-sub { font-size: 0.78rem; color: var(--sage-green); margin-top: 4px; }

        .table-footer { padding: 12px 20px; border-top: 1px solid #e8f5d9; background: #f9fdf4; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px; }
        .pagination-info { font-size: 0.78rem; color: var(--sage-green); }
        .pagination-info strong { color: var(--fern); }
        .pagination-btns { display: flex; align-items: center; gap: 6px; }
        .page-btn { min-width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; border: 1.5px solid var(--celadon); background: #ffffff; font-size: 0.78rem; font-weight: 700; color: var(--sage-green); cursor: pointer; transition: all 0.15s; padding: 0 10px; }
        .page-btn:hover:not(:disabled) { background: var(--celadon); border-color: var(--muted-olive); color: var(--fern); }
        .page-btn.active { background: var(--fern); border-color: var(--fern); color: #ffffff; }
        .page-btn:disabled { opacity: 0.4; cursor: not-allowed; }

        .hidden { display: none !important; }

        @media (max-width: 767px) { .sidebar { display: none; } }
    </style>

    <div class="shell">

        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
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
                <a href="{{ route('admin.transactions.index') }}" class="nav-item active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Manajemen Donasi
                    <span class="nav-badge">{{ $donations->where('status', 'pending')->count() + $sponsorships->where('status', 'pending')->count() }}</span>
                </a>
                <a href="{{ route('admin.sponsorships.contacts') }}" class="nav-item">
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

        {{-- MAIN --}}
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

                {{-- Toast --}}
                @if(session('success'))
                    <div class="toast" id="toast-msg">
                        <div class="toast-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg></div>
                        <span class="toast-msg">{{ session('success') }}</span>
                        <div class="toast-close" onclick="document.getElementById('toast-msg').remove()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="toast" id="toast-err" style="border-left-color:#dc2626;">
                        <div class="toast-icon" style="background:#fee2e2;"><svg fill="none" stroke="#dc2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg></div>
                        <span class="toast-msg" style="color:#dc2626;">{{ session('error') }}</span>
                        <div class="toast-close" onclick="document.getElementById('toast-err').remove()"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></div>
                    </div>
                @endif

                {{-- Page header --}}
                <div class="page-header">
                    <div>
                        <nav class="breadcrumb">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            <span>/</span>
                            <span>Manajemen Donasi</span>
                        </nav>
                        <h1 class="page-title">Manajemen Donasi</h1>
                        <p class="page-subtitle">Kelola semua transaksi donasi kampanye & sponsorship orang tua asuh.</p>
                    </div>
                </div>

                {{-- ══ TAB SWITCHER ══ --}}
                <div class="tab-wrapper">
                    <button class="tab-btn active" id="tab-donasi" onclick="switchTab('donasi')">
                        💰 Donasi Kampanye
                        <span class="tab-count">{{ $donations->count() }}</span>
                        @if($donations->where('status','pending')->count() > 0)
                            <span class="tab-pending">{{ $donations->where('status','pending')->count() }} pending</span>
                        @endif
                    </button>
                    <button class="tab-btn" id="tab-sponsor" onclick="switchTab('sponsor')">
                        🤝 Orang Tua Asuh
                        <span class="tab-count">{{ $sponsorships->count() }}</span>
                        @if($sponsorships->where('status','pending')->count() > 0)
                            <span class="tab-pending">{{ $sponsorships->where('status','pending')->count() }} pending</span>
                        @endif
                    </button>
                </div>

                {{-- ══════════════════════════════
                     TAB 1: DONASI KAMPANYE
                ══════════════════════════════ --}}
                <div id="panel-donasi" class="table-card">
                    <div class="toolbar">
                        <div class="search-table-wrap">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" id="searchDonasi" class="table-search-input" placeholder="Cari nama, email, order ID…">
                        </div>
                        <div class="filters-row">
                            <div class="filter-select-wrap">
                                <select id="statusDonasi" class="filter-select">
                                    <option value="all">Semua Status</option>
                                    <option value="success">Sukses</option>
                                    <option value="pending">Tertunda</option>
                                    <option value="gagal">Gagal</option>
                                </select>
                                <svg class="filter-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Donatur &amp; Kampanye</th>
                                    <th>Nominal</th>
                                    <th style="text-align:center;">Status</th>
                                    <th style="text-align:right;">Tanggal</th>
                                    <th style="text-align:center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bodyDonasi">
                                @forelse($donations as $item)
                                    @php $sk = match($item->status) { 'success'=>'success','pending'=>'pending',default=>'gagal' }; @endphp
                                    <tr class="data-row-donasi"
                                        data-search="{{ strtolower($item->donor_name.' '.$item->donor_email.' '.$item->order_id) }}"
                                        data-status="{{ $sk }}"
                                        data-date="{{ $item->created_at ? $item->created_at->format('Y-m-d') : '' }}">
                                        <td>
                                            <div class="donor-cell">
                                                <img class="donor-avatar" src="https://ui-avatars.com/api/?name={{ urlencode($item->donor_name) }}&background=b3e093&color=5c8148&rounded=true&bold=true" alt="">
                                                <div>
                                                    <div class="donor-name">{{ $item->donor_name }}</div>
                                                    <div class="donor-email">{{ $item->donor_email }}</div>
                                                    <span class="campaign-tag">{{ $item->target }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="amount-value">Rp {{ number_format($item->amount, 0, ',', '.') }}</div>
                                            <div class="order-id"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>{{ $item->order_id }}</div>
                                            @if($item->payment_method)
                                            <div class="payment-method-note" style="margin-top:3px;">via {{ $item->payment_method }}</div>
                                            @endif
                                        </td>
                                        <td style="text-align:center;">
                                            @if($item->status=='success') <span class="badge badge-sukses"><span class="badge-dot"></span>Sukses</span>
                                            @elseif($item->status=='pending') <span class="badge badge-pending"><span class="badge-dot"></span>Tertunda</span>
                                            @else <span class="badge badge-gagal"><span class="badge-dot"></span>Gagal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="date-main">{{ $item->created_at?->format('d M Y') ?? '-' }}</div>
                                            <div class="date-time">{{ $item->created_at?->format('H:i') }} WIB</div>
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="action-cell">
                                                @if($item->status==='pending')
                                                    <form action="{{ route('admin.transactions.approve', $item->order_id) }}" method="POST" onsubmit="return confirm('Setujui donasi ini?')">
                                                        @csrf @method('PATCH')
                                                        <button type="submit" class="approve-btn" title="Setujui"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/></svg></button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.transactions.destroy', $item->order_id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="delete-btn" title="Hapus"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5"><div class="empty-state"><div class="empty-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg></div><p class="empty-title">Belum Ada Donasi</p><p class="empty-sub">Donasi kampanye yang masuk akan tampil di sini.</p></div></td></tr>
                                @endforelse
                                <tr id="noResultDonasi" class="hidden"><td colspan="5"><div class="empty-state"><p class="empty-title">Tidak Ditemukan</p><p class="empty-sub">Coba kata kunci berbeda.</p></div></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer">
                        <div class="pagination-info" id="infoDonasi">—</div>
                        <div class="pagination-btns">
                            <button id="prevDonasi" class="page-btn" disabled>← Prev</button>
                            <div id="pagesDonasi" class="pagination-btns"></div>
                            <button id="nextDonasi" class="page-btn" disabled>Next →</button>
                        </div>
                    </div>
                </div>

                {{-- ══════════════════════════════
                     TAB 2: SPONSORSHIP OTA
                ══════════════════════════════ --}}
                <div id="panel-sponsor" class="table-card hidden" style="margin-top:0;">
                    <div class="toolbar">
                        <div class="search-table-wrap">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" id="searchSponsor" class="table-search-input" placeholder="Cari nama, email, order ID…">
                        </div>
                        <div class="filters-row">
                            <div class="filter-select-wrap">
                                <select id="statusSponsor" class="filter-select">
                                    <option value="all">Semua Status</option>
                                    <option value="success">Sukses</option>
                                    <option value="pending">Tertunda</option>
                                    <option value="gagal">Gagal</option>
                                </select>
                                <svg class="filter-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Donatur &amp; Anak Asuh</th>
                                    <th>Paket</th>
                                    <th>Nominal</th>
                                    <th style="text-align:center;">Status</th>
                                    <th style="text-align:right;">Tanggal</th>
                                    <th style="text-align:center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bodySponsor">
                                @forelse($sponsorships as $item)
                                    @php $sk = match($item->status) { 'success'=>'success','pending'=>'pending',default=>'gagal' }; @endphp
                                    <tr class="data-row-sponsor"
                                        data-search="{{ strtolower($item->donor_name.' '.$item->donor_email.' '.$item->order_id.' '.$item->target) }}"
                                        data-status="{{ $sk }}"
                                        data-date="{{ $item->created_at ? $item->created_at->format('Y-m-d') : '' }}">
                                        <td>
                                            <div class="donor-cell">
                                                <img class="donor-avatar" src="https://ui-avatars.com/api/?name={{ urlencode($item->donor_name) }}&background=ede9fe&color=6d28d9&rounded=true&bold=true" alt="">
                                                <div>
                                                    <div class="donor-name">{{ $item->donor_name }}</div>
                                                    <div class="donor-email">{{ $item->donor_email }}</div>
                                                    @isset($item->donor_phone)
                                                        <div class="donor-phone">📱 {{ $item->donor_phone }}</div>
                                                    @endisset
                                                    <span class="sponsor-tag" style="margin-top:3px;display:inline-block;">Anak: {{ $item->target }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="package-tag">{{ $item->package ?? '-' }}</span>
                                            @if($item->payment_method)
                                                <div class="payment-method-note" style="margin-top:5px;">via {{ $item->payment_method }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="amount-value">Rp {{ number_format($item->amount, 0, ',', '.') }}</div>
                                            <div class="order-id"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>{{ $item->order_id }}</div>
                                        </td>
                                        <td style="text-align:center;">
                                            @if($item->status=='success') <span class="badge badge-sukses"><span class="badge-dot"></span>Sukses</span>
                                            @elseif($item->status=='pending') <span class="badge badge-pending"><span class="badge-dot"></span>Tertunda</span>
                                            @else <span class="badge badge-gagal"><span class="badge-dot"></span>Gagal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="date-main">{{ $item->created_at?->format('d M Y') ?? '-' }}</div>
                                            <div class="date-time">{{ $item->created_at?->format('H:i') }} WIB</div>
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="action-cell">
                                                @if($item->status==='pending')
                                                    <form action="{{ route('admin.transactions.approve', $item->order_id) }}" method="POST" onsubmit="return confirm('Setujui sponsorship ini?')">
                                                        @csrf @method('PATCH')
                                                        <button type="submit" class="approve-btn" title="Setujui"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/></svg></button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.transactions.destroy', $item->order_id) }}" method="POST" onsubmit="return confirm('Hapus sponsorship ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="delete-btn" title="Hapus"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6"><div class="empty-state"><div class="empty-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div><p class="empty-title">Belum Ada Sponsorship</p><p class="empty-sub">Data orang tua asuh akan tampil di sini.</p></div></td></tr>
                                @endforelse
                                <tr id="noResultSponsor" class="hidden"><td colspan="6"><div class="empty-state"><p class="empty-title">Tidak Ditemukan</p><p class="empty-sub">Coba kata kunci berbeda.</p></div></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer">
                        <div class="pagination-info" id="infoSponsor">—</div>
                        <div class="pagination-btns">
                            <button id="prevSponsor" class="page-btn" disabled>← Prev</button>
                            <div id="pagesSponsor" class="pagination-btns"></div>
                            <button id="nextSponsor" class="page-btn" disabled>Next →</button>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
    // ── Tab switcher ──
    function switchTab(tab) {
        const tabs   = ['donasi', 'sponsor'];
        tabs.forEach(t => {
            document.getElementById('tab-' + t).classList.toggle('active', t === tab);
            document.getElementById('panel-' + t).classList.toggle('hidden', t !== tab);
        });
    }

    // ── Generic paginator factory ──
    function makePaginator(opts) {
        const { rowSelector, searchId, statusId, noResultId, infoId, prevId, nextId, pagesId } = opts;
        const PER_PAGE = 8;
        let currentPage = 1;
        let filtered = [];

        const allRows   = Array.from(document.querySelectorAll(rowSelector));
        const noResult  = document.getElementById(noResultId);
        const info      = document.getElementById(infoId);
        const prevBtn   = document.getElementById(prevId);
        const nextBtn   = document.getElementById(nextId);
        const pagesWrap = document.getElementById(pagesId);

        function render() {
            const total = filtered.length;
            allRows.forEach(r => r.classList.add('hidden'));

            if (total === 0) {
                noResult.classList.remove('hidden');
                info.innerHTML = 'Menampilkan <strong>0</strong> hasil';
                prevBtn.disabled = nextBtn.disabled = true;
                pagesWrap.innerHTML = '';
                return;
            }

            noResult.classList.add('hidden');
            const totalPages = Math.ceil(total / PER_PAGE);
            currentPage = Math.min(Math.max(currentPage, 1), totalPages);
            const start = (currentPage - 1) * PER_PAGE;
            const end   = Math.min(start + PER_PAGE, total);

            for (let i = start; i < end; i++) filtered[i].classList.remove('hidden');
            info.innerHTML = `Menampilkan <strong>${start+1}–${end}</strong> dari <strong>${total}</strong>`;
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages;

            pagesWrap.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                const b = document.createElement('button');
                b.textContent = i;
                b.className = 'page-btn' + (i === currentPage ? ' active' : '');
                b.addEventListener('click', () => { currentPage = i; render(); });
                pagesWrap.appendChild(b);
            }
        }

        function doFilter() {
            const q    = document.getElementById(searchId).value.toLowerCase().trim();
            const stat = document.getElementById(statusId).value;
            filtered = allRows.filter(r =>
                r.dataset.search.includes(q) &&
                (stat === 'all' || r.dataset.status === stat)
            );
            currentPage = 1;
            render();
        }

        document.getElementById(searchId).addEventListener('input', doFilter);
        document.getElementById(statusId).addEventListener('change', doFilter);
        prevBtn.addEventListener('click', () => { currentPage--; render(); });
        nextBtn.addEventListener('click', () => { currentPage++; render(); });

        filtered = [...allRows];
        render();
    }

    document.addEventListener('DOMContentLoaded', function () {
        makePaginator({
            rowSelector: '.data-row-donasi',
            searchId:    'searchDonasi',
            statusId:    'statusDonasi',
            noResultId:  'noResultDonasi',
            infoId:      'infoDonasi',
            prevId:      'prevDonasi',
            nextId:      'nextDonasi',
            pagesId:     'pagesDonasi',
        });

        makePaginator({
            rowSelector: '.data-row-sponsor',
            searchId:    'searchSponsor',
            statusId:    'statusSponsor',
            noResultId:  'noResultSponsor',
            infoId:      'infoSponsor',
            prevId:      'prevSponsor',
            nextId:      'nextSponsor',
            pagesId:     'pagesSponsor',
        });
    });
    </script>
</x-app-layout>