<x-app-layout>
    <style>
        :root {
            --celadon:       #b3e093;
            --lime-cream:    #d6ec89;
            --muted-olive:   #a1c181;
            --muted-olive-2: #8bb650;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
            --fern-deep:     #354a2b;
            --bg:            #f3fbea;
        }

        .page-shell {
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
            font-size: 1rem; font-weight: 900; color: #fff; letter-spacing: -0.01em; line-height: 1.2;
        }
        .sidebar-brand-name span { color: var(--celadon); }
        .sidebar-brand-sub {
            font-size: 0.68rem; color: rgba(255,255,255,0.5); font-weight: 600;
            margin-top: 2px; text-transform: uppercase; letter-spacing: 0.06em;
        }
        .sidebar-section { padding: 16px 10px 4px; }
        .sidebar-section-label {
            font-size: 0.62rem; font-weight: 800; text-transform: uppercase;
            letter-spacing: 0.12em; color: rgba(255,255,255,0.38);
            padding: 0 8px; margin-bottom: 4px;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: 9px;
            padding: 9px 10px; border-radius: 10px;
            font-size: 0.8rem; font-weight: 600;
            color: rgba(255,255,255,0.62); text-decoration: none;
            transition: all 0.18s; margin-bottom: 1px; position: relative;
        }
        .sidebar-link:hover { background: rgba(255,255,255,0.09); color: #fff; }
        .sidebar-link.active { background: rgba(255,255,255,0.13); color: #fff; }
        .sidebar-link.active::before {
            content: ''; position: absolute; left: 0; top: 22%; bottom: 22%;
            width: 3px; background: var(--celadon); border-radius: 0 3px 3px 0;
        }
        .sidebar-link svg { width: 16px; height: 16px; flex-shrink: 0; opacity: 0.65; }
        .sidebar-link:hover svg, .sidebar-link.active svg { opacity: 1; }
        .sidebar-footer {
            margin-top: auto; padding: 12px 10px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-logout {
            display: flex; align-items: center; gap: 8px; padding: 8px 10px;
            border-radius: 10px; font-size: 0.78rem; font-weight: 700;
            color: rgba(255,255,255,0.5); background: none; border: none;
            width: 100%; cursor: pointer; transition: all 0.18s;
        }
        .sidebar-logout:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .sidebar-logout svg { width: 15px; height: 15px; opacity: 0.6; }

        /* ══ MAIN ══ */
        .page-main {
            flex: 1; min-width: 0;
            padding: 32px 36px;
            overflow-x: hidden;
        }

        /* ══ PAGE HEADER ══ */
        .page-header {
            display: flex; align-items: flex-end;
            justify-content: space-between;
            gap: 12px; margin-bottom: 28px; flex-wrap: wrap;
        }
        .breadcrumb {
            display: flex; align-items: center; gap: 5px;
            font-size: 0.72rem; font-weight: 600; color: var(--muted-olive);
            margin-bottom: 4px;
        }
        .breadcrumb a { color: var(--sage-green); text-decoration: none; }
        .breadcrumb a:hover { color: var(--fern); }
        .page-title {
            font-size: 1.35rem; font-weight: 900;
            color: var(--fern-deep); margin: 0;
        }
        .page-subtitle {
            font-size: 0.8rem; color: var(--sage-green); margin-top: 3px;
        }

        /* ══ TOMBOL TAMBAH ══ */
        .btn-add {
            padding: 10px 22px; border-radius: 10px;
            font-size: 0.85rem; font-weight: 800; color: #fff;
            background: linear-gradient(135deg, var(--muted-olive-2), var(--sage-green));
            border: none; cursor: pointer;
            box-shadow: 0 3px 12px rgba(92,129,72,0.28);
            transition: all 0.2s; text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-add:hover {
            background: linear-gradient(135deg, var(--sage-green), var(--fern));
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(92,129,72,0.35);
            color: #fff;
        }
        .btn-add svg { width: 15px; height: 15px; }

        /* ══ SUMMARY CARDS ══ */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        @media (max-width: 900px) { .summary-grid { grid-template-columns: repeat(2,1fr); } }
        @media (max-width: 520px) { .summary-grid { grid-template-columns: 1fr; } }

        .summary-card {
            background: #fff;
            border: 1px solid #d4edbe;
            border-radius: 14px;
            padding: 18px 20px;
            display: flex; align-items: center; gap: 14px;
            box-shadow: 0 2px 10px rgba(92,129,72,0.07);
            transition: all 0.2s;
        }
        .summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(92,129,72,0.14);
            border-color: var(--muted-olive);
        }
        .summary-icon {
            width: 44px; height: 44px; border-radius: 12px;
            background: #edfae0; color: var(--fern);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .summary-icon.accent  { background: var(--muted-olive-2); color: #fff; }
        .summary-icon.boy     { background: #dbeafe; color: #1d4ed8; }
        .summary-icon.girl    { background: #fce7f3; color: #be185d; }
        .summary-icon svg { width: 22px; height: 22px; }
        .summary-label {
            font-size: 0.68rem; font-weight: 800; text-transform: uppercase;
            letter-spacing: 0.06em; color: var(--sage-green);
        }
        .summary-value {
            font-size: 1.75rem; font-weight: 900;
            color: var(--fern-deep); line-height: 1.1; margin-top: 2px;
        }

        /* ══ FLASH ══ */
        .flash-success {
            background: #dcfce7; border: 1px solid #86efac;
            border-left: 4px solid #16a34a;
            border-radius: 10px; padding: 12px 16px;
            font-size: 0.82rem; font-weight: 700; color: #15803d;
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 20px;
        }
        .flash-success svg { width: 16px; height: 16px; flex-shrink: 0; }

        /* ══ TABLE CARD ══ */
        .table-card {
            background: #fff;
            border: 1px solid #d4edbe;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(92,129,72,0.07);
            overflow: hidden;
        }

        .card-header-strip {
            background: linear-gradient(90deg, var(--fern) 0%, var(--sage-green) 55%, var(--muted-olive) 100%);
            padding: 16px 24px;
            display: flex; align-items: center; gap: 12px;
        }
        .strip-icon {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.18);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .strip-title { color: #fff; font-size: 0.95rem; font-weight: 800; margin: 0; }
        .strip-sub   { color: rgba(255,255,255,0.75); font-size: 0.75rem; margin: 2px 0 0; }

        /* ══ TABLE ══ */
        .data-table {
            width: 100%;
            font-size: 0.875rem;
            text-align: left;
            border-collapse: collapse;
        }
        .data-table thead tr {
            background: #f9fef4;
            border-bottom: 2px solid #cde8b4;
        }
        .data-table thead th {
            padding: 13px 20px;
            font-size: 0.68rem; font-weight: 800;
            text-transform: uppercase; letter-spacing: 0.06em;
            color: var(--fern);
        }
        .data-table tbody tr {
            border-bottom: 1px solid #f0f9ec;
            transition: background 0.15s;
        }
        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #fafff7; }
        .data-table td { padding: 14px 20px; vertical-align: middle; }

        /* ══ GENDER BADGE ══ */
        .badge-gender {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 11px; border-radius: 999px;
            font-size: 0.72rem; font-weight: 700;
        }
        .badge-gender-laki {
            background: #dbeafe; color: #1e40af;
            border: 1px solid #bfdbfe;
        }
        .badge-gender-perempuan {
            background: #fce7f3; color: #9d174d;
            border: 1px solid #fbcfe8;
        }

        /* ══ STATUS BADGES ══ */
        .badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 999px;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.02em;
        }
        .badge-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
        .badge-available {
            background: #edfae0; color: var(--fern);
            border: 1px solid #cde8b4;
        }
        .badge-available .badge-dot { background: var(--sage-green); }
        .badge-adopted {
            background: var(--fern); color: #fff;
        }
        .badge-adopted .badge-dot { background: rgba(255,255,255,0.7); }

        /* ══ ACTION BUTTONS ══ */
        .btn-edit {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 6px 14px; border-radius: 8px;
            font-size: 0.78rem; font-weight: 700;
            color: var(--sage-green); background: transparent;
            border: 1.5px solid var(--muted-olive);
            text-decoration: none; transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        .btn-edit:hover { background: var(--sage-green); color: #fff; border-color: var(--sage-green); }

        .btn-delete {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 6px 14px; border-radius: 8px;
            font-size: 0.78rem; font-weight: 700;
            color: #fff;
            background: var(--muted-olive-2);
            border: 1.5px solid var(--muted-olive-2);
            cursor: pointer; transition: background 0.2s, border-color 0.2s;
        }
        .btn-delete:hover { background: var(--fern); border-color: var(--fern); }
        .btn-edit svg, .btn-delete svg { width: 13px; height: 13px; }

        /* ══ EMPTY STATE ══ */
        .empty-state {
            padding: 56px 24px; text-align: center;
        }
        .empty-state-icon {
            width: 52px; height: 52px;
            background: #edfae0; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 14px;
        }
        .empty-state-icon svg { width: 24px; height: 24px; stroke: var(--muted-olive); }
        .empty-state-title { font-size: 0.95rem; font-weight: 800; color: var(--fern-deep); margin: 0 0 4px; }
        .empty-state-sub   { font-size: 0.8rem; color: var(--sage-green); margin: 0; }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:var(--fern);">
            Data Anak Asuh
        </h2>
    </x-slot>

    <div class="page-shell">

        {{-- ══ SIDEBAR ══ --}}
        <aside class="dash-sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-name">Baitul<span>Yatim</span></div>
                <div class="sidebar-brand-sub">Panel Administrasi</div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
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
                <a href="{{ route('admin.foster-children.index') }}" class="sidebar-link active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Data Anak Asuh
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="sidebar-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Riwayat Transaksi
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

        {{-- ══ MAIN ══ --}}
        <main class="page-main">

            {{-- Page header --}}
            <div class="page-header">
                <div>
                    <nav class="breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>/</span>
                        <span>Data Anak Asuh</span>
                    </nav>
                    <h1 class="page-title">Kelola Data Anak Asuh</h1>
                    <p class="page-subtitle">Pantau dan kelola daftar seluruh anak asuh yayasan.</p>
                </div>
                <a href="{{ route('admin.foster-children.create') }}" class="btn-add">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Anak Asuh
                </a>
            </div>

            {{-- Summary Cards — 4 kolom, tambah Laki-laki & Perempuan --}}
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/></svg>
                    </div>
                    <div>
                        <div class="summary-label">Total Anak Asuh</div>
                        <div class="summary-value">{{ $children->count() }}</div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon boy">
                        {{-- Male icon --}}
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3h5m0 0v5m0-5l-6 6M12 12a5 5 0 100-10 5 5 0 000 10zm0 0v9"/></svg>
                    </div>
                    <div>
                        <div class="summary-label">Laki-laki</div>
                        <div class="summary-value">{{ $children->where('jenis_kelamin', 'Laki-laki')->count() }}</div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon girl">
                        {{-- Female icon --}}
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a5 5 0 100-10 5 5 0 000 10zm0 0v4m-3 2h6"/></svg>
                    </div>
                    <div>
                        <div class="summary-label">Perempuan</div>
                        <div class="summary-value">{{ $children->where('jenis_kelamin', 'Perempuan')->count() }}</div>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon accent">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <div class="summary-label">Sedang Diasuh</div>
                        <div class="summary-value">{{ $children->where('status', '!=', 'Tersedia')->count() }}</div>
                    </div>
                </div>
            </div>

            {{-- Flash --}}
            @if(session('success'))
                <div class="flash-success">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Table Card --}}
            <div class="table-card">
                <div class="card-header-strip">
                    <div class="strip-icon">👶</div>
                    <div>
                        <p class="strip-title">Daftar Anak Asuh</p>
                        <p class="strip-sub">Seluruh data anak yang terdaftar dalam program OTA</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Jenis Kelamin</th>
                                <th>Status</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($children as $child)
                                <tr>
                                    {{-- Foto --}}
                                    <td>
                                        @if($child->photo)
                                            <img src="{{ asset('storage/' . $child->photo) }}"
                                                 alt="Foto {{ $child->name }}"
                                                 style="width:52px;height:52px;object-fit:cover;border-radius:10px;border:1.5px solid #cde8b4;">
                                        @else
                                            <div style="width:52px;height:52px;border-radius:10px;background:#edfae0;border:1.5px solid #cde8b4;display:flex;align-items:center;justify-content:center;">
                                                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:var(--muted-olive);">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Nama --}}
                                    <td>
                                        <span style="font-weight:800;color:var(--fern-deep);font-size:0.9rem;">{{ $child->name }}</span>
                                    </td>

                                    {{-- Umur --}}
                                    <td>
                                        <span style="display:inline-flex;align-items:center;gap:5px;font-size:0.82rem;font-weight:600;color:var(--sage-green);">
                                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $child->age }} Tahun
                                        </span>
                                    </td>

                                    {{-- Jenis Kelamin --}}
                                    <td>
                                        @if($child->jenis_kelamin === 'Laki-laki')
                                            <span class="badge-gender badge-gender-laki">
                                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 3h5m0 0v5m0-5l-6 6M12 12a5 5 0 100-10 5 5 0 000 10zm0 0v9"/></svg>
                                                Laki-laki
                                            </span>
                                        @elseif($child->jenis_kelamin === 'Perempuan')
                                            <span class="badge-gender badge-gender-perempuan">
                                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14a5 5 0 100-10 5 5 0 000 10zm0 0v4m-3 2h6"/></svg>
                                                Perempuan
                                            </span>
                                        @else
                                            <span style="font-size:0.78rem;color:#9ca3af;">—</span>
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @if($child->status == 'Tersedia')
                                            <span class="badge badge-available">
                                                <span class="badge-dot"></span>
                                                Tersedia
                                            </span>
                                        @else
                                            <span class="badge badge-adopted">
                                                <span class="badge-dot"></span>
                                                Diasuh
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td>
                                        <div style="display:flex;align-items:center;justify-content:center;gap:8px;">
                                            <a href="{{ route('admin.foster-children.edit', $child->id) }}" class="btn-edit">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.foster-children.destroy', $child->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data {{ $child->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <div class="empty-state-icon">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/></svg>
                                            </div>
                                            <p class="empty-state-title">Belum ada data anak asuh</p>
                                            <p class="empty-state-sub">Mulai dengan menambahkan data anak asuh baru ke sistem.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>