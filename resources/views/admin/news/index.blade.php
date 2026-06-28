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
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        @media (max-width: 720px) { .summary-grid { grid-template-columns: 1fr; } }

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
        .summary-icon.accent {
            background: var(--muted-olive-2); color: #fff;
        }
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

        /* ══ FOTO THUMBNAIL ══ */
        .news-thumb {
            width: 60px; height: 44px;
            object-fit: cover; border-radius: 8px;
            border: 1.5px solid #cde8b4;
        }
        .news-thumb-placeholder {
            width: 60px; height: 44px;
            background: #edfae0; border-radius: 8px;
            border: 1.5px solid #cde8b4;
            display: flex; align-items: center; justify-content: center;
        }
        .news-thumb-placeholder svg { width: 20px; height: 20px; stroke: var(--muted-olive); }

        /* ══ BADGES ══ */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 999px;
            font-size: 0.7rem; font-weight: 700;
        }
        .badge-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
        .badge-published {
            background: #edfae0; color: var(--fern);
            border: 1px solid #cde8b4;
        }
        .badge-published .badge-dot { background: var(--sage-green); }
        .badge-draft {
            background: #f3f4f6; color: #6b7280;
            border: 1px solid #e5e7eb;
        }
        .badge-draft .badge-dot { background: #9ca3af; }
        .badge-kategori {
            background: #f0fdf4; color: var(--sage-green);
            border: 1px solid var(--celadon);
            margin-top: 4px; display: inline-flex;
        }

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
            color: #fff; background: var(--muted-olive-2);
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
        .empty-state-sub   { font-size: 0.8rem; color: var(--sage-green); margin: 0 0 14px; }

        /* ══ PAGINATION ══ */
        .pagination-wrapper {
            padding: 16px 20px;
            border-top: 1px solid #e8f5d9;
        }
        .pagination-wrapper .pagination { display: flex; gap: 6px; flex-wrap: wrap; }
        .pagination-wrapper .page-item .page-link {
            padding: 6px 12px; border-radius: 8px;
            border: 1.5px solid var(--celadon);
            color: var(--fern); font-size: 0.8rem; font-weight: 600;
            text-decoration: none; transition: all 0.2s;
        }
        .pagination-wrapper .page-item.active .page-link {
            background: var(--fern); border-color: var(--fern); color: #fff;
        }
        .pagination-wrapper .page-item .page-link:hover { background: var(--celadon); }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:var(--fern);">
            Berita Kegiatan
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
                <a href="{{ route('admin.news.index') }}" class="sidebar-link active">
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
                        <span>Berita Kegiatan</span>
                    </nav>
                    <h1 class="page-title">Kelola Berita & Kegiatan</h1>
                    <p class="page-subtitle">Publikasikan narasi kegiatan, press release, dan laporan acara yayasan.</p>
                </div>
                <a href="{{ route('admin.news.create') }}" class="btn-add">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Berita
                </a>
            </div>

            {{-- Summary Cards --}}
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"/></svg>
                    </div>
                    <div>
                        <div class="summary-label">Total Berita</div>
                        <div class="summary-value">{{ $newsList->total() }}</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="summary-label">Tayang</div>
                        <div class="summary-value">{{ $newsList->getCollection()->where('status', 'published')->count() }}</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon accent">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <div class="summary-label">Draft</div>
                        <div class="summary-value">{{ $newsList->getCollection()->where('status', 'draft')->count() }}</div>
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
                    <div class="strip-icon">📰</div>
                    <div>
                        <p class="strip-title">Daftar Berita & Kegiatan</p>
                        <p class="strip-sub">Seluruh artikel dan laporan kegiatan yang terdaftar di sistem</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width:76px;">Foto</th>
                                <th>Judul & Kategori</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($newsList as $item)
                                <tr>
                                    {{-- Foto --}}
                                    <td>
                                        @if($item->foto_utama)
                                            <img src="{{ asset('storage/' . $item->foto_utama) }}"
                                                 alt="{{ $item->judul }}" class="news-thumb">
                                        @else
                                            <div class="news-thumb-placeholder">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                                    <path d="m21 15-5-5L5 21"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Judul & Kategori --}}
                                    <td>
                                        <div style="font-weight:800;color:var(--fern-deep);font-size:0.88rem;max-width:280px;">
                                            {{ Str::limit($item->judul, 55) }}
                                        </div>
                                        <span class="badge badge-kategori">{{ $item->kategori }}</span>
                                    </td>

                                    {{-- Tanggal --}}
                                    <td style="white-space:nowrap;font-size:0.82rem;font-weight:600;color:var(--sage-green);">
                                        {{ $item->tanggal_kegiatan->translatedFormat('d M Y') }}
                                    </td>

                                    {{-- Lokasi --}}
                                    <td style="font-size:0.82rem;font-weight:600;color:var(--sage-green);max-width:160px;">
                                        {{ $item->lokasi ?? '-' }}
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @if($item->status === 'published')
                                            <span class="badge badge-published">
                                                <span class="badge-dot"></span>
                                                Tayang
                                            </span>
                                        @else
                                            <span class="badge badge-draft">
                                                <span class="badge-dot"></span>
                                                Draft
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td>
                                        <div style="display:flex;align-items:center;justify-content:center;gap:8px;">
                                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn-edit">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.news.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Hapus berita \'{{ addslashes($item->judul) }}\'?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
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
                                                <svg fill="none" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                            </div>
                                            <p class="empty-state-title">Belum ada berita kegiatan</p>
                                            <p class="empty-state-sub">Mulai dengan menambahkan berita atau laporan kegiatan pertama.</p>
                                            <a href="{{ route('admin.news.create') }}" class="btn-add">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4v16m8-8H4"/></svg>
                                                Tambah Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($newsList->hasPages())
                    <div class="pagination-wrapper">
                        {{ $newsList->links() }}
                    </div>
                @endif
            </div>

        </main>
    </div>
</x-app-layout>