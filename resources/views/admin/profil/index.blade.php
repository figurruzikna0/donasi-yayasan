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
        .sidebar-brand { padding: 20px 18px 16px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-brand-name { font-size: 1rem; font-weight: 900; color: #fff; letter-spacing: -0.01em; line-height: 1.2; }
        .sidebar-brand-name span { color: var(--celadon); }
        .sidebar-brand-sub { font-size: 0.68rem; color: rgba(255,255,255,0.5); font-weight: 600; margin-top: 2px; text-transform: uppercase; letter-spacing: 0.06em; }
        .sidebar-section { padding: 16px 10px 4px; }
        .sidebar-section-label { font-size: 0.62rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: rgba(255,255,255,0.38); padding: 0 8px; margin-bottom: 4px; }
        .sidebar-link { display: flex; align-items: center; gap: 9px; padding: 9px 10px; border-radius: 10px; font-size: 0.8rem; font-weight: 600; color: rgba(255,255,255,0.62); text-decoration: none; transition: all 0.18s; margin-bottom: 1px; position: relative; }
        .sidebar-link:hover { background: rgba(255,255,255,0.09); color: #fff; }
        .sidebar-link.active { background: rgba(255,255,255,0.13); color: #fff; }
        .sidebar-link.active::before { content: ''; position: absolute; left: 0; top: 22%; bottom: 22%; width: 3px; background: var(--celadon); border-radius: 0 3px 3px 0; }
        .sidebar-link svg { width: 16px; height: 16px; flex-shrink: 0; opacity: 0.65; }
        .sidebar-link:hover svg, .sidebar-link.active svg { opacity: 1; }
        .sidebar-footer { margin-top: auto; padding: 12px 10px; border-top: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logout { display: flex; align-items: center; gap: 8px; padding: 8px 10px; border-radius: 10px; font-size: 0.78rem; font-weight: 700; color: rgba(255,255,255,0.5); background: none; border: none; width: 100%; cursor: pointer; transition: all 0.18s; }
        .sidebar-logout:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .sidebar-logout svg { width: 15px; height: 15px; opacity: 0.6; }

        /* ══ MAIN ══ */
        .page-main { flex: 1; min-width: 0; padding: 32px 36px; overflow-x: hidden; }

        /* ══ PAGE HEADER ══ */
        .page-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 12px; margin-bottom: 28px; flex-wrap: wrap; }
        .breadcrumb { display: flex; align-items: center; gap: 5px; font-size: 0.72rem; font-weight: 600; color: var(--muted-olive); margin-bottom: 4px; }
        .breadcrumb a { color: var(--sage-green); text-decoration: none; }
        .breadcrumb a:hover { color: var(--fern); }
        .page-title { font-size: 1.35rem; font-weight: 900; color: var(--fern-deep); margin: 0; }
        .page-subtitle { font-size: 0.8rem; color: var(--sage-green); margin-top: 3px; }

        /* ══ TAB SWITCHER ══ */
        .tab-wrapper {
            display: flex; gap: 0; margin-bottom: 22px;
            background: #fff; border: 1.5px solid var(--celadon);
            border-radius: 12px; padding: 4px; width: fit-content;
        }
        .tab-btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 18px; border-radius: 9px;
            font-size: 0.8rem; font-weight: 700; color: var(--sage-green);
            background: transparent; border: none; cursor: pointer;
            transition: all 0.2s; white-space: nowrap;
        }
        .tab-btn:hover { background: #f3fbea; color: var(--fern); }
        .tab-btn.active { background: var(--fern); color: #fff; box-shadow: 0 3px 10px rgba(92,129,72,0.25); }
        .tab-btn .tab-count {
            background: var(--celadon); color: var(--fern);
            font-size: 0.64rem; font-weight: 800; padding: 1px 7px;
            border-radius: 99px; min-width: 18px; text-align: center;
        }
        .tab-btn.active .tab-count { background: rgba(255,255,255,0.25); color: #fff; }

        .tab-panel { display: block; }
        .tab-panel.hidden { display: none; }

        /* ══ FORM CARD ══ */
        .form-card {
            background: #fff; border: 1px solid #d4edbe; border-radius: 16px;
            box-shadow: 0 4px 16px rgba(92,129,72,0.07);
            overflow: hidden; margin-bottom: 20px;
        }
        .card-header-strip {
            background: linear-gradient(90deg, var(--fern) 0%, var(--sage-green) 55%, var(--muted-olive) 100%);
            padding: 16px 24px; display: flex; align-items: center; gap: 12px;
        }
        .strip-icon { width: 36px; height: 36px; background: rgba(255,255,255,0.18); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
        .strip-title { color: #fff; font-size: 0.95rem; font-weight: 800; margin: 0; }
        .strip-sub   { color: rgba(255,255,255,0.75); font-size: 0.75rem; margin: 2px 0 0; }
        .card-body { padding: 24px 28px 28px; }

        /* ══ FIELD ══ */
        .field-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        @media (max-width: 720px) { .field-grid-2 { grid-template-columns: 1fr; } }
        .field-group { margin-bottom: 18px; }
        .field-group:last-child { margin-bottom: 0; }
        .field-label { display: block; font-size: 0.72rem; font-weight: 800; color: var(--fern); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px; }
        .field-label .opt { font-weight: 400; text-transform: none; color: var(--muted-olive); font-size: 0.7rem; }
        .field-input, .field-select, .field-textarea {
            width: 100%; padding: 10px 14px; border: 1.5px solid #cde8b4; border-radius: 10px;
            font-size: 0.88rem; color: #1a2e12; background: #f9fef4; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s; box-sizing: border-box;
        }
        .field-input:focus, .field-select:focus, .field-textarea:focus {
            border-color: var(--muted-olive-2); box-shadow: 0 0 0 3px rgba(139,182,80,0.18); background: #fff;
        }
        .field-input::placeholder, .field-textarea::placeholder { color: #8aaa72; }
        .field-textarea { resize: vertical; }
        .field-error { font-size: 0.72rem; color: #e06b4f; margin-top: 4px; }

        /* ══ FILE UPLOAD ══ */
        .file-zone { border: 1.5px dashed var(--muted-olive); border-radius: 12px; background: #f5fded; padding: 18px 16px; transition: border-color 0.2s, background 0.2s; position: relative; }
        .file-zone:hover { border-color: var(--sage-green); background: #edfae0; }
        .file-zone-label { display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 0.85rem; font-weight: 700; color: var(--fern); }
        .file-zone-label svg { width: 18px; height: 18px; stroke: var(--sage-green); flex-shrink: 0; }
        input[type="file"].hidden-file { position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none; }
        .file-hint { font-size: 0.68rem; color: var(--sage-green); font-weight: 600; margin-top: 5px; }
        .file-preview { margin-top: 10px; border: 1.5px solid #cde8b4; border-radius: 10px; padding: 6px; background: #f9fef4; }
        .file-preview img { max-height: 140px; width: auto; object-fit: contain; display: block; margin: 0 auto; border-radius: 6px; }
        .file-preview-label { font-size: 0.66rem; color: var(--muted-olive); font-weight: 600; text-align: center; margin-bottom: 4px; }
        .logo-preview { width: 52px; height: 52px; border-radius: 50%; object-fit: cover; border: 2px solid var(--celadon); margin-top: 10px; display: block; }

        /* ══ ACTIONS ══ */
        .form-actions { display: flex; align-items: center; justify-content: flex-end; gap: 12px; padding-top: 20px; border-top: 1px solid #e8f5d9; margin-top: 4px; }
        .btn-cancel { padding: 10px 22px; border-radius: 10px; font-size: 0.85rem; font-weight: 700; color: var(--fern); background: transparent; border: 1.5px solid var(--muted-olive); text-decoration: none; transition: background 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-cancel:hover { background: var(--celadon); }
        .btn-save { padding: 10px 28px; border-radius: 10px; font-size: 0.85rem; font-weight: 800; color: #fff; background: linear-gradient(135deg, var(--muted-olive-2), var(--sage-green)); border: none; cursor: pointer; box-shadow: 0 3px 12px rgba(92,129,72,0.28); transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-save:hover { background: linear-gradient(135deg, var(--sage-green), var(--fern)); transform: translateY(-1px); box-shadow: 0 6px 18px rgba(92,129,72,0.35); }

        /* ══ FLASH ══ */
        .flash-success { background: #dcfce7; border: 1px solid #86efac; border-left: 4px solid #16a34a; border-radius: 10px; padding: 12px 16px; font-size: 0.82rem; font-weight: 700; color: #15803d; display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .flash-error { background: #fee2e2; border: 1px solid #fca5a5; border-left: 4px solid #dc2626; border-radius: 10px; padding: 12px 16px; font-size: 0.82rem; font-weight: 700; color: #b91c1c; display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }

        /* ══ PENDIRI LIST (read view inside Pendiri tab) ══ */
        .pendiri-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 14px; margin-bottom: 4px;
        }
        .pendiri-card {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 14px; border: 1.5px solid #e8f5d9; border-radius: 12px;
            background: #f9fdf4; transition: border-color 0.18s, background 0.18s;
        }
        .pendiri-card:hover { border-color: var(--celadon); background: #fff; }
        .pendiri-avatar { width: 50px; height: 50px; border-radius: 12px; object-fit: cover; border: 2px solid var(--celadon); flex-shrink: 0; }
        .pendiri-avatar-placeholder { display: flex; align-items: center; justify-content: center; background: var(--celadon); color: var(--fern); font-weight: 800; font-size: 1.05rem; }
        .pendiri-info { flex: 1; min-width: 0; }
        .pendiri-name { font-size: 0.84rem; font-weight: 800; color: var(--fern-deep); margin: 0; }
        .pendiri-role { font-size: 0.72rem; font-weight: 700; color: var(--sage-green); margin: 1px 0 5px; }
        .pendiri-quote { font-size: 0.74rem; color: #5c7a4d; font-style: italic; margin: 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .pendiri-delete-btn { width: 28px; height: 28px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; border-radius: 8px; border: none; background: transparent; color: var(--muted-olive); cursor: pointer; transition: all 0.18s; }
        .pendiri-delete-btn:hover { background: rgba(239,68,68,0.1); color: #dc2626; }
        .pendiri-delete-btn svg { width: 14px; height: 14px; }
        .pendiri-empty { padding: 36px 16px; text-align: center; border: 1.5px dashed var(--muted-olive); border-radius: 12px; background: #f9fdf4; grid-column: 1 / -1; }

        .pendiri-section-label {
            font-size: 0.72rem; font-weight: 800; text-transform: uppercase;
            letter-spacing: 0.06em; color: var(--fern); margin-bottom: 14px;
            display: flex; align-items: center; gap: 7px;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:var(--fern);">
            Profil Yayasan
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
                <a href="{{ route('admin.profil.index') }}" class="sidebar-link active">
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

            <div class="page-header">
                <div>
                    <nav class="breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>/</span>
                        <span>Profil Yayasan</span>
                    </nav>
                    <h1 class="page-title">Profil & Berkas Yayasan</h1>
                    <p class="page-subtitle">Kelola informasi dasar, visi misi, dokumen resmi, dan data pendiri.</p>
                </div>
            </div>

            {{-- Flash --}}
            @if(session('success'))
                <div class="flash-success">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="flash-error">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- ══ TAB SWITCHER ══ --}}
            <div class="tab-wrapper">
                <button class="tab-btn active" id="tab-profil" onclick="switchProfilTab('profil')">
                    🏢 Profil Yayasan
                </button>
                <button class="tab-btn" id="tab-pendiri" onclick="switchProfilTab('pendiri')">
                    👥 Pendiri & Pengurus
                    <span class="tab-count">{{ $pendiris->count() }}</span>
                </button>
            </div>

            {{-- ══════════════════════════════
                 TAB 1: PROFIL YAYASAN
                 (form independen → admin.profil.update)
            ══════════════════════════════ --}}
            <div id="panel-profil" class="tab-panel">
                <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- CARD 1: Info Dasar --}}
                    <div class="form-card">
                        <div class="card-header-strip">
                            <div class="strip-icon">🏢</div>
                            <div>
                                <p class="strip-title">Informasi Dasar</p>
                                <p class="strip-sub">Nama, kontak, logo, dan alamat yayasan</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="field-grid-2">
                                <div class="field-group">
                                    <label class="field-label">Nama Yayasan</label>
                                    <input type="text" name="nama_yayasan" class="field-input" required
                                           value="{{ old('nama_yayasan', $profil?->nama_yayasan) }}"
                                           placeholder="Yayasan Baitul Yatim">
                                    @error('nama_yayasan') <p class="field-error">{{ $message }}</p> @enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label">Email Resmi</label>
                                    <input type="email" name="email" class="field-input" required
                                           value="{{ old('email', $profil?->email) }}"
                                           placeholder="info@yayasan.org">
                                    @error('email') <p class="field-error">{{ $message }}</p> @enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label">No. Telepon / WhatsApp</label>
                                    <input type="text" name="no_telp" class="field-input" required
                                           value="{{ old('no_telp', $profil?->no_telp) }}"
                                           placeholder="08123456789">
                                    @error('no_telp') <p class="field-error">{{ $message }}</p> @enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label">Logo Yayasan <span class="opt">(Opsional)</span></label>
                                    <div class="file-zone">
                                        <label class="file-zone-label" for="logo-input">
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            <span id="logo-label">Pilih file logo…</span>
                                        </label>
                                        <input type="file" name="logo" id="logo-input" accept="image/*" class="hidden-file"
                                               onchange="previewFile(this,'logo-label','logo-preview-img')">
                                        <p class="file-hint">PNG/JPG transparan lebih baik · Maks 1MB</p>
                                    </div>
                                    @if($profil?->logo)
                                        <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo" class="logo-preview" id="logo-preview-img">
                                    @else
                                        <img src="" alt="" class="logo-preview" id="logo-preview-img" style="display:none;">
                                    @endif
                                </div>
                            </div>
                            <div class="field-group">
                                <label class="field-label">Alamat Lengkap</label>
                                <textarea name="alamat" rows="2" class="field-textarea" required
                                          placeholder="Jl. Kebaikan No. 1, Kota...">{{ old('alamat', $profil?->alamat) }}</textarea>
                                @error('alamat') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- CARD 2: Sejarah, Visi, Misi --}}
                    <div class="form-card">
                        <div class="card-header-strip">
                            <div class="strip-icon">📖</div>
                            <div>
                                <p class="strip-title">Sejarah, Visi & Misi</p>
                                <p class="strip-sub">Narasi dan arah gerak yayasan</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="field-group">
                                <label class="field-label">Sejarah / Deskripsi Yayasan</label>
                                <textarea name="sejarah_yayasan" rows="5" class="field-textarea" required
                                          placeholder="Ceritakan bagaimana yayasan ini berdiri dan berkembang…">{{ old('sejarah_yayasan', $profil?->sejarah_yayasan) }}</textarea>
                                @error('sejarah_yayasan') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <div class="field-grid-2">
                                <div class="field-group">
                                    <label class="field-label">Visi</label>
                                    <textarea name="visi" rows="4" class="field-textarea" required
                                              placeholder="Menjadi lembaga amanah…">{{ old('visi', $profil?->visi) }}</textarea>
                                    @error('visi') <p class="field-error">{{ $message }}</p> @enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label">Misi <span class="opt">(gunakan Enter untuk poin baru)</span></label>
                                    <textarea name="misi" rows="4" class="field-textarea" required
                                              placeholder="• Memberikan pendidikan terbaik&#10;• Mengelola amanah dengan transparan">{{ old('misi', $profil?->misi) }}</textarea>
                                    @error('misi') <p class="field-error">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CARD 3: Berkas Visual --}}
                    <div class="form-card">
                        <div class="card-header-strip">
                            <div class="strip-icon">📂</div>
                            <div>
                                <p class="strip-title">Berkas Resmi & Transparansi</p>
                                <p class="strip-sub">Dokumen legalitas dan bagan struktur organisasi</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="field-grid-2">
                                <div class="field-group">
                                    <label class="field-label">📜 Surat Legalitas Resmi <span class="opt">(Opsional)</span></label>
                                    <div class="file-zone">
                                        <label class="file-zone-label" for="legalitas-input">
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            <span id="legalitas-label">Pilih foto dokumen…</span>
                                        </label>
                                        <input type="file" name="foto_legalitas" id="legalitas-input" accept="image/*" class="hidden-file"
                                               onchange="previewFile(this,'legalitas-label','legalitas-img')">
                                        <p class="file-hint">JPG / PNG · Maks 2MB</p>
                                    </div>
                                    @if($profil?->foto_legalitas)
                                        <div class="file-preview" style="margin-top:10px;">
                                            <p class="file-preview-label">Berkas saat ini</p>
                                            <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" id="legalitas-img" alt="Legalitas">
                                        </div>
                                    @else
                                        <div class="file-preview" id="legalitas-preview-wrap" style="margin-top:10px;display:none;">
                                            <p class="file-preview-label">Preview baru</p>
                                            <img id="legalitas-img" alt="" src="">
                                        </div>
                                    @endif
                                </div>

                                <div class="field-group">
                                    <label class="field-label">📊 Bagan Struktur Organisasi <span class="opt">(Opsional)</span></label>
                                    <div class="file-zone">
                                        <label class="file-zone-label" for="struktur-input">
                                            <svg viewBox="0 0 24 24" fill="none"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            <span id="struktur-label">Pilih foto bagan…</span>
                                        </label>
                                        <input type="file" name="foto_struktur" id="struktur-input" accept="image/*" class="hidden-file"
                                               onchange="previewFile(this,'struktur-label','struktur-img')">
                                        <p class="file-hint">JPG / PNG · Maks 2MB</p>
                                    </div>
                                    @if($profil?->foto_struktur)
                                        <div class="file-preview" style="margin-top:10px;">
                                            <p class="file-preview-label">Berkas saat ini</p>
                                            <img src="{{ asset('storage/' . $profil->foto_struktur) }}" id="struktur-img" alt="Struktur">
                                        </div>
                                    @else
                                        <div class="file-preview" id="struktur-preview-wrap" style="margin-top:10px;display:none;">
                                            <p class="file-preview-label">Preview baru</p>
                                            <img id="struktur-img" alt="" src="">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.profil.index') }}" class="btn-cancel">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                            Batal
                        </a>
                        <button type="submit" class="btn-save">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            Simpan Perubahan Profil
                        </button>
                    </div>
                </form>
            </div>

            {{-- ══════════════════════════════
                 TAB 2: PENDIRI & PENGURUS
                 (form independen → admin.pendiri.store)
            ══════════════════════════════ --}}
            <div id="panel-pendiri" class="tab-panel hidden">

                {{-- Daftar pendiri saat ini --}}
                <div class="form-card">
                    <div class="card-header-strip">
                        <div class="strip-icon">👥</div>
                        <div>
                            <p class="strip-title">Daftar Pendiri Saat Ini</p>
                            <p class="strip-sub">{{ $pendiris->count() }} orang terdaftar dan tampil di halaman publik</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pendiri-grid">
                            @forelse($pendiris as $pendiri)
                                <div class="pendiri-card">
                                    @if($pendiri->foto)
                                        <img src="{{ asset('storage/' . $pendiri->foto) }}" class="pendiri-avatar" alt="{{ $pendiri->nama }}">
                                    @else
                                        <div class="pendiri-avatar pendiri-avatar-placeholder">{{ strtoupper(substr($pendiri->nama, 0, 1)) }}</div>
                                    @endif
                                    <div class="pendiri-info">
                                        <p class="pendiri-name">{{ $pendiri->nama }}</p>
                                        <p class="pendiri-role">{{ $pendiri->jabatan }}</p>
                                        @if($pendiri->deskripsi)
                                            <p class="pendiri-quote">"{{ $pendiri->deskripsi }}"</p>
                                        @endif
                                    </div>
                                    <form action="{{ route('admin.pendiri.destroy', $pendiri->id) }}" method="POST" onsubmit="return confirm('Hapus data pendiri ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="pendiri-delete-btn" title="Hapus">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="pendiri-empty">
                                    <p style="font-weight:700;color:var(--fern);font-size:0.85rem;margin:0;">Belum Ada Data Pendiri</p>
                                    <p style="font-size:0.76rem;color:var(--sage-green);margin:3px 0 0;">Tambahkan pendiri pertama lewat form di bawah.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Form tambah pendiri — independen, route sendiri --}}
                <form action="{{ route('admin.pendiri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-card">
                        <div class="card-header-strip">
                            <div class="strip-icon">➕</div>
                            <div>
                                <p class="strip-title">Tambah Pendiri Baru</p>
                                <p class="strip-sub">Lengkapi data berikut untuk menambahkan pendiri atau pengurus baru</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="field-grid-2">
                                <div class="field-group">
                                    <label class="field-label">Nama Lengkap</label>
                                    <input type="text" name="nama" class="field-input" required
                                           value="{{ old('nama') }}" placeholder="Nama lengkap">
                                    @error('nama') <p class="field-error">{{ $message }}</p> @enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label">Jabatan</label>
                                    <input type="text" name="jabatan" class="field-input" required
                                           value="{{ old('jabatan') }}" placeholder="Ketua Yayasan">
                                    @error('jabatan') <p class="field-error">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="field-group">
                                <label class="field-label">Kata Sambutan <span class="opt">(Opsional)</span></label>
                                <textarea name="deskripsi" rows="3" class="field-textarea"
                                          placeholder="Kata sambutan singkat…">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">Foto</label>
                                <div class="file-zone">
                                    <label class="file-zone-label" for="pendiri-foto-input">
                                        <svg viewBox="0 0 24 24" fill="none"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span id="pendiri-foto-label">Pilih foto pendiri…</span>
                                    </label>
                                    <input type="file" name="foto" id="pendiri-foto-input" accept="image/*" class="hidden-file"
                                           onchange="previewFile(this,'pendiri-foto-label','pendiri-foto-img')">
                                    <p class="file-hint">JPG/PNG · Maks 1MB</p>
                                </div>
                                <div class="file-preview" id="pendiri-foto-preview-wrap" style="margin-top:10px;display:none;">
                                    <p class="file-preview-label">Preview foto</p>
                                    <img id="pendiri-foto-img" alt="" src="">
                                </div>
                                @error('foto') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-actions mb-10">
                        <button type="reset" class="btn-cancel" onclick="resetPendiriPreview()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                            Reset Form
                        </button>
                        <button type="submit" class="btn-save">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                            Tambah Pendiri
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    <script>
    // ── Tab switcher (mirrors transactions page pattern) ──
    function switchProfilTab(tab) {
        const tabs = ['profil', 'pendiri'];
        tabs.forEach(t => {
            document.getElementById('tab-' + t).classList.toggle('active', t === tab);
            document.getElementById('panel-' + t).classList.toggle('hidden', t !== tab);
        });
    }

    // ── File preview helper (shared by both forms) ──
    function previewFile(input, labelId, imgId) {
        const label = document.getElementById(labelId);
        const img   = document.getElementById(imgId);

        if (input.files && input.files[0]) {
            label.textContent = input.files[0].name;

            const wrap = document.getElementById(imgId.replace('-img', '-preview-wrap'));
            if (wrap) wrap.style.display = 'block';

            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetPendiriPreview() {
        document.getElementById('pendiri-foto-label').textContent = 'Pilih foto pendiri…';
        document.getElementById('pendiri-foto-preview-wrap').style.display = 'none';
    }

    // ── If validation errors came back for pendiri form, auto-switch to that tab ──
    @if($errors->has('nama') || $errors->has('jabatan') || $errors->has('foto'))
        document.addEventListener('DOMContentLoaded', () => switchProfilTab('pendiri'));
    @endif
    </script>
</x-app-layout>