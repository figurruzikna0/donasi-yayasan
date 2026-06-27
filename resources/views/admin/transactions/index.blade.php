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

        /* ── Full-screen shell ── */
        .shell {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background-color: #f3fbea;
            font-family: 'Inter', system-ui, sans-serif;
            color: var(--fern-deep);
        }

        /* ══════════════════════════════
           SIDEBAR
        ══════════════════════════════ */
        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background-color: var(--fern);
            display: flex;
            flex-direction: column;
            z-index: 20;
        }

        /* Logo strip */
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

        .logo-text {
            font-size: 1.1rem;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.02em;
        }

        .logo-text span {
            color: var(--celadon);
        }

        /* Nav section */
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

        .nav-item:hover {
            background-color: rgba(255,255,255,0.08);
            color: #ffffff;
        }

        .nav-item svg {
            width: 17px; height: 17px;
            flex-shrink: 0;
            opacity: 0.7;
            transition: opacity 0.18s;
        }

        .nav-item:hover svg { opacity: 1; }

        /* Active state */
        .nav-item.active {
            background-color: rgba(255,255,255,0.12);
            color: #ffffff;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            background: var(--celadon);
            border-radius: 0 3px 3px 0;
        }

        .nav-item.active svg { opacity: 1; }

        /* Badge count */
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

        /* User footer */
        .sidebar-footer {
            padding: 14px 12px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

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

        .user-card img {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.2);
        }

        .user-card .user-name {
            font-size: 0.82rem; font-weight: 700; color: #ffffff;
        }

        .user-card .user-email {
            font-size: 0.72rem; color: rgba(255,255,255,0.5);
        }

        /* ══════════════════════════════
           MAIN AREA
        ══════════════════════════════ */
        .main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Top bar */
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

        .search-wrap {
            position: relative;
            width: 280px;
        }

        .search-wrap svg {
            position: absolute;
            left: 11px; top: 50%;
            transform: translateY(-50%);
            width: 15px; height: 15px;
            color: var(--muted-olive);
        }

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

        .search-input-top:focus {
            border-color: var(--muted-olive-2);
            box-shadow: 0 0 0 3px rgba(139,182,80,0.15);
        }

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

        /* ══════════════════════════════
           SCROLLABLE CONTENT
        ══════════════════════════════ */
        .content-area {
            flex: 1;
            overflow-x: hidden;
            overflow-y: auto;
            padding: 28px;
            background: #f3fbea;
        }

        /* Toast */
        .toast {
            position: fixed;
            top: 78px; right: 24px;
            z-index: 50;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: #ffffff;
            border: 1px solid var(--celadon);
            border-left: 4px solid var(--sage-green);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(92,129,72,0.15);
            max-width: 340px;
            animation: slideDown 0.35s ease-out;
        }

        .toast-icon {
            width: 30px; height: 30px;
            background: var(--celadon);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .toast-icon svg { width: 15px; height: 15px; color: var(--fern); }
        .toast-msg { font-size: 0.83rem; font-weight: 700; color: var(--fern); flex: 1; }

        .toast-close {
            width: 22px; height: 22px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 6px;
            cursor: pointer;
            color: var(--muted-olive);
            transition: all 0.15s;
        }

        .toast-close:hover { background: #f3fbea; color: var(--fern); }
        .toast-close svg { width: 13px; height: 13px; }

        @keyframes slideDown {
            from { transform: translateY(-16px); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }

        /* Page header */
        .page-header {
            display: flex;
            flex-direction: row;
            align-items: flex-end;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--muted-olive);
            margin-bottom: 4px;
        }

        .breadcrumb a { color: var(--sage-green); text-decoration: none; }
        .breadcrumb a:hover { color: var(--fern); }
        .breadcrumb-sep { color: var(--muted-olive); }

        .page-title {
            font-size: 1.45rem;
            font-weight: 900;
            color: var(--fern);
            letter-spacing: -0.02em;
            margin: 0;
        }

        .page-subtitle {
            font-size: 0.82rem;
            color: var(--sage-green);
            margin-top: 3px;
        }

        .btn-export {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            background: #ffffff;
            border: 1.5px solid var(--muted-olive);
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--sage-green);
            cursor: pointer;
            transition: all 0.18s;
            white-space: nowrap;
        }

        .btn-export:hover {
            background: var(--celadon);
            border-color: var(--sage-green);
            color: var(--fern);
        }

        .btn-export svg { width: 15px; height: 15px; }

        /* ══════════════════════════════
           TABLE CARD
        ══════════════════════════════ */
        .table-card {
            background: #ffffff;
            border: 1px solid #d4edbe;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(92,129,72,0.07);
        }

        /* Toolbar */
        .toolbar {
            padding: 14px 20px;
            border-bottom: 1px solid #e8f5d9;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
            background: #f9fdf4;
        }

        .search-table-wrap {
            position: relative;
            width: 100%;
            max-width: 300px;
        }

        .search-table-wrap svg {
            position: absolute;
            left: 11px; top: 50%;
            transform: translateY(-50%);
            width: 14px; height: 14px;
            color: var(--muted-olive);
        }

        .table-search-input {
            width: 100%;
            padding: 7px 12px 7px 32px;
            background: #ffffff;
            border: 1.5px solid var(--celadon);
            border-radius: 9px;
            font-size: 0.8rem;
            color: var(--fern);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }

        .table-search-input::placeholder { color: var(--muted-olive); }

        .table-search-input:focus {
            border-color: var(--muted-olive-2);
            box-shadow: 0 0 0 3px rgba(139,182,80,0.15);
            background: #fff;
        }

        /* Filter selects */
        .filters-row { display: flex; gap: 8px; flex-wrap: wrap; }

        .filter-select-wrap { position: relative; }

        .filter-select {
            appearance: none;
            padding: 7px 30px 7px 12px;
            background: #ffffff;
            border: 1.5px solid var(--celadon);
            border-radius: 9px;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--sage-green);
            cursor: pointer;
            outline: none;
            transition: border-color 0.18s;
        }

        .filter-select:focus {
            border-color: var(--muted-olive-2);
            box-shadow: 0 0 0 3px rgba(139,182,80,0.12);
        }

        .filter-chevron {
            pointer-events: none;
            position: absolute;
            right: 9px; top: 50%;
            transform: translateY(-50%);
            width: 13px; height: 13px;
            color: var(--muted-olive);
        }

        /* Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background: #f3fbea;
            border-bottom: 1.5px solid #d4edbe;
        }

        .data-table th {
            padding: 11px 20px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--sage-green);
            white-space: nowrap;
        }

        .data-table tbody tr {
            border-bottom: 1px solid #edf7e2;
            transition: background 0.15s;
        }

        .data-table tbody tr:last-child { border-bottom: none; }

        .data-table tbody tr:hover { background: rgba(214,236,137,0.18); }

        .data-table td { padding: 13px 20px; vertical-align: middle; }

        /* Donor cell */
        .donor-cell { display: flex; align-items: center; gap: 11px; }

        .donor-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            border: 2px solid var(--celadon);
            object-fit: cover;
            flex-shrink: 0;
        }

        .donor-name {
            font-size: 0.84rem; font-weight: 800;
            color: var(--fern);
        }

        .donor-email {
            font-size: 0.72rem; color: var(--muted-olive);
            margin: 1px 0 4px;
        }

        .campaign-tag {
            display: inline-block;
            padding: 2px 8px;
            background: #edf7e2;
            border: 1px solid var(--celadon);
            border-radius: 6px;
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--sage-green);
        }

        .package-tag {
            display: inline-block;
            padding: 2px 8px;
            background: #fdf6e3;
            border: 1px solid #e8d8a0;
            border-radius: 6px;
            font-size: 0.68rem;
            font-weight: 700;
            color: #92651a;
        }

        /* Amount cell */
        .amount-value {
            font-size: 0.9rem; font-weight: 900;
            color: var(--fern);
        }

        .order-id {
            font-size: 0.68rem;
            font-family: 'JetBrains Mono', monospace;
            color: var(--muted-olive);
            margin-top: 3px;
            display: flex; align-items: center; gap: 4px;
        }

        .order-id svg { width: 11px; height: 11px; }

        .payment-method-note {
            font-size: 0.68rem;
            color: var(--muted-olive);
            margin-top: 1px;
        }

        /* Status badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.72rem;
            font-weight: 800;
        }

        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .badge-sukses {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34,197,94,0.25);
        }
        .badge-sukses .badge-dot { background: #22c55e; }

        .badge-pending {
            background: rgba(234, 179, 8, 0.1);
            color: #92651a;
            border: 1px solid rgba(234,179,8,0.3);
        }
        .badge-pending .badge-dot { background: #eab308; animation: pulse 1.5s infinite; }

        .badge-gagal {
            background: rgba(239, 68, 68, 0.08);
            color: #b91c1c;
            border: 1px solid rgba(239,68,68,0.2);
        }
        .badge-gagal .badge-dot { background: #ef4444; }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.35; }
        }

        /* Date cell */
        .date-main {
            font-size: 0.82rem; font-weight: 700; color: var(--fern);
            text-align: right;
        }

        .date-time {
            font-size: 0.7rem; color: var(--muted-olive);
            text-align: right; margin-top: 2px;
        }

        /* Action buttons */
        .action-cell { display: flex; align-items: center; justify-content: center; gap: 6px; }

        .delete-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px; height: 32px;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: var(--muted-olive);
            cursor: pointer;
            transition: all 0.18s;
        }

        .delete-btn:hover {
            background: rgba(239,68,68,0.1);
            color: #dc2626;
        }

        .delete-btn svg { width: 16px; height: 16px; }

        .approve-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px; height: 32px;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: var(--muted-olive);
            cursor: pointer;
            transition: all 0.18s;
        }

        .approve-btn:hover {
            background: rgba(34,197,94,0.1);
            color: #16a34a;
        }

        .approve-btn svg { width: 16px; height: 16px; }

        /* Empty state */
        .empty-state {
            padding: 64px 24px;
            text-align: center;
        }

        .empty-icon {
            width: 56px; height: 56px;
            background: #edf7e2;
            border: 1px solid var(--celadon);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 14px;
        }

        .empty-icon svg { width: 26px; height: 26px; color: var(--muted-olive); }

        .empty-title {
            font-size: 0.95rem; font-weight: 800; color: var(--fern);
        }

        .empty-sub {
            font-size: 0.78rem; color: var(--sage-green); margin-top: 4px;
        }

        /* Pagination footer */
        .table-footer {
            padding: 12px 20px;
            border-top: 1px solid #e8f5d9;
            background: #f9fdf4;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .pagination-info {
            font-size: 0.78rem;
            color: var(--sage-green);
        }

        .pagination-info strong { color: var(--fern); }

        .pagination-btns { display: flex; align-items: center; gap: 6px; }

        .page-btn {
            min-width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px;
            border: 1.5px solid var(--celadon);
            background: #ffffff;
            font-size: 0.78rem; font-weight: 700;
            color: var(--sage-green);
            cursor: pointer;
            transition: all 0.15s;
            padding: 0 10px;
        }

        .page-btn:hover:not(:disabled) {
            background: var(--celadon);
            border-color: var(--muted-olive);
            color: var(--fern);
        }

        .page-btn.active {
            background: var(--fern);
            border-color: var(--fern);
            color: #ffffff;
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Responsive: hide sidebar on mobile */
        @media (max-width: 767px) {
            .sidebar { display: none; }
        }
    </style>

    <div class="shell">

        {{-- ══ SIDEBAR ══ --}}
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

                <a href="#" class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    Dashboard
                </a>

                <a href="#" class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Manajemen User
                </a>

                {{-- AKTIF --}}
                <a href="#" class="nav-item active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Manajemen Donasi
                    <span class="nav-badge">{{ $transactions->where('status', 'pending')->count() }}</span>
                </a>

                <a href="#" class="nav-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
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

        {{-- ══ MAIN ══ --}}
        <div class="main-area">

            {{-- Topbar --}}
            <header class="topbar">
                <div class="search-wrap">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" class="search-input-top" placeholder="Pencarian cepat…">
                </div>
                <div class="topbar-actions">
                    <button class="icon-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                </div>
            </header>

            {{-- Scrollable content --}}
            <main class="content-area">

                {{-- Toast --}}
                @if(session('success'))
                    <div class="toast" id="toast-success">
                        <div class="toast-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="toast-msg">{{ session('success') }}</span>
                        <div class="toast-close" onclick="this.closest('#toast-success').remove()">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="toast" id="toast-error" style="border-left-color:#dc2626;">
                        <div class="toast-icon" style="background:#fee2e2;">
                            <svg fill="none" stroke="#dc2626" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <span class="toast-msg">{{ session('error') }}</span>
                        <div class="toast-close" onclick="this.closest('#toast-error').remove()">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </div>
                @endif

                {{-- Page header --}}
                <div class="page-header">
                    <div>
                        <nav class="breadcrumb">
                            <a href="#">Dashboard</a>
                            <span class="breadcrumb-sep">/</span>
                            <span>Manajemen Donasi</span>
                        </nav>
                        <h1 class="page-title">Manajemen Donasi</h1>
                        <p class="page-subtitle">Kelola semua transaksi donasi & sponsorship yang masuk ke sistem yayasan.</p>
                    </div>
                    <button class="btn-export">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export CSV
                    </button>
                </div>

                {{-- Table card --}}
                <div class="table-card">

                    {{-- Toolbar --}}
                    <div class="toolbar">
                        <div class="search-table-wrap">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" id="tableSearch" class="table-search-input"
                                   placeholder="Cari nama, email, order ID…">
                        </div>

                        <div class="filters-row">
                            <div class="filter-select-wrap">
                                <select id="statusFilter" class="filter-select">
                                    <option value="all">Semua Status</option>
                                    <option value="success">Sukses</option>
                                    <option value="pending">Tertunda</option>
                                    <option value="gagal">Gagal</option>
                                </select>
                                <svg class="filter-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="filter-select-wrap">
                                <select id="timeFilter" class="filter-select">
                                    <option value="all">Semua Waktu</option>
                                    <option value="today">Hari Ini</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="month">Bulan Ini</option>
                                </select>
                                <svg class="filter-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Donatur &amp; Program</th>
                                    <th>Nominal</th>
                                    <th style="text-align:center;">Status</th>
                                    <th style="text-align:right;">Tanggal</th>
                                    <th style="text-align:center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @forelse($transactions as $transaction)
                                    @php
                                        $statusKey = match($transaction->status) {
                                            'success' => 'success',
                                            'pending' => 'pending',
                                            default => 'gagal',
                                        };
                                    @endphp
                                    <tr class="data-row"
                                        data-search="{{ strtolower($transaction->donor_name . ' ' . $transaction->donor_email . ' ' . $transaction->order_id) }}"
                                        data-status="{{ $statusKey }}"
                                        data-date="{{ $transaction->created_at ? $transaction->created_at->format('Y-m-d') : '' }}">

                                        {{-- Donatur --}}
                                        <td>
                                            <div class="donor-cell">
                                                <img class="donor-avatar"
                                                     src="https://ui-avatars.com/api/?name={{ urlencode($transaction->donor_name) }}&background=b3e093&color=5c8148&rounded=true&bold=true"
                                                     alt="{{ $transaction->donor_name }}">
                                                <div>
                                                    <div class="donor-name">{{ $transaction->donor_name }}</div>
                                                    <div class="donor-email">{{ $transaction->donor_email }}</div>
                                                    <div style="display:flex; gap:5px; flex-wrap:wrap; margin-top:3px;">
                                                        <span class="campaign-tag">{{ $transaction->target }}</span>
                                                        @if($transaction->type === 'sponsorship')
                                                            <span class="package-tag">{{ $transaction->package ?? 'Sponsor' }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Nominal --}}
                                        <td>
                                            <div class="amount-value">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</div>
                                            <div class="order-id">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                                </svg>
                                                {{ $transaction->order_id ?? '-' }}
                                            </div>
                                            @if($transaction->payment_method)
                                                <div class="payment-method-note">via {{ $transaction->payment_method }}</div>
                                            @endif
                                        </td>

                                        {{-- Status --}}
                                        <td style="text-align:center;">
                                            @if($transaction->status == 'success')
                                                <span class="badge badge-sukses">
                                                    <span class="badge-dot"></span> Sukses
                                                </span>
                                            @elseif($transaction->status == 'pending')
                                                <span class="badge badge-pending">
                                                    <span class="badge-dot"></span> Tertunda
                                                </span>
                                            @else
                                                <span class="badge badge-gagal">
                                                    <span class="badge-dot"></span> Gagal
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Tanggal --}}
                                        <td>
                                            <div class="date-main">{{ $transaction->created_at ? $transaction->created_at->format('d M Y') : '-' }}</div>
                                            <div class="date-time">{{ $transaction->created_at ? $transaction->created_at->format('H:i') . ' WIB' : '' }}</div>
                                        </td>

                                        {{-- Aksi --}}
                                        <td style="text-align:center;">
                                            <div class="action-cell">
                                                @if($transaction->status === 'pending')
                                                    <form action="{{ route('admin.transactions.approve', $transaction->order_id) }}" method="POST"
                                                          onsubmit="return confirm('Setujui transaksi ini?');">
                                                        @csrf @method('PATCH')
                                                        <button type="submit" class="approve-btn" title="Setujui">
                                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.transactions.destroy', $transaction->order_id) }}" method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="delete-btn" title="Hapus">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="emptyInitRow">
                                        <td colspan="5">
                                            <div class="empty-state">
                                                <div class="empty-icon">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                                    </svg>
                                                </div>
                                                <p class="empty-title">Belum Ada Transaksi</p>
                                                <p class="empty-sub">Donasi dan sponsorship yang masuk lewat Midtrans akan tampil di sini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse

                                <tr id="noResultRow" class="hidden">
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                </svg>
                                            </div>
                                            <p class="empty-title">Tidak Ditemukan</p>
                                            <p class="empty-sub">Coba kata kunci pencarian yang berbeda.</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination footer --}}
                    <div class="table-footer">
                        <div class="pagination-info" id="paginationInfo">
                            Menampilkan <strong>0</strong> hasil
                        </div>
                        <div class="pagination-btns">
                            <button id="prevBtn" class="page-btn" disabled>← Prev</button>
                            <div id="pageNumbers" class="pagination-btns"></div>
                            <button id="nextBtn" class="page-btn" disabled>Next →</button>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rowsPerPage = 5;
            let currentPage = 1;

            const searchInput  = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const timeFilter   = document.getElementById('timeFilter');
            const allRows      = Array.from(document.querySelectorAll('.data-row'));
            const noResultRow  = document.getElementById('noResultRow');
            const prevBtn      = document.getElementById('prevBtn');
            const nextBtn      = document.getElementById('nextBtn');
            const pageNums     = document.getElementById('pageNumbers');
            const pageInfo     = document.getElementById('paginationInfo');

            let filteredRows = [...allRows];

            function checkDate(dateStr, filter) {
                if (filter === 'all' || !dateStr) return filter === 'all';
                const today = new Date(); today.setHours(0,0,0,0);
                const d     = new Date(dateStr); d.setHours(0,0,0,0);
                const diff  = Math.ceil((today - d) / 864e5);
                if (filter === 'today') return diff === 0;
                if (filter === 'week')  return diff >= 0 && diff <= 7;
                if (filter === 'month') return diff >= 0 && diff <= 30;
                return true;
            }

            function render() {
                const total = filteredRows.length;

                if (total === 0) {
                    noResultRow.classList.remove('hidden');
                    allRows.forEach(r => r.classList.add('hidden'));
                    pageInfo.innerHTML = "Menampilkan <strong>0</strong> hasil";
                    prevBtn.disabled = nextBtn.disabled = true;
                    pageNums.innerHTML = '';
                    return;
                }

                noResultRow.classList.add('hidden');
                const totalPages = Math.ceil(total / rowsPerPage);
                currentPage = Math.min(Math.max(currentPage, 1), totalPages);
                const start = (currentPage - 1) * rowsPerPage;
                const end   = Math.min(start + rowsPerPage, total);

                allRows.forEach(r => r.classList.add('hidden'));
                for (let i = start; i < end; i++) filteredRows[i].classList.remove('hidden');

                pageInfo.innerHTML = `Menampilkan <strong>${start + 1}–${end}</strong> dari <strong>${total}</strong> transaksi`;
                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages;

                pageNums.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const b = document.createElement('button');
                    b.textContent = i;
                    b.className = 'page-btn' + (i === currentPage ? ' active' : '');
                    b.addEventListener('click', () => { currentPage = i; render(); });
                    pageNums.appendChild(b);
                }
            }

            function filter() {
                const q    = searchInput.value.toLowerCase().trim();
                const stat = statusFilter.value;
                const time = timeFilter.value;

                filteredRows = allRows.filter(row =>
                    row.dataset.search.includes(q) &&
                    (stat === 'all' || row.dataset.status === stat) &&
                    checkDate(row.dataset.date, time)
                );

                currentPage = 1;
                render();
            }

            searchInput.addEventListener('input', filter);
            statusFilter.addEventListener('change', filter);
            timeFilter.addEventListener('change', filter);
            prevBtn.addEventListener('click', () => { currentPage--; render(); });
            nextBtn.addEventListener('click', () => { currentPage++; render(); });

            render();
        });
    </script>
</x-app-layout>