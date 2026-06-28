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

        .page-bg {
            background: linear-gradient(145deg, #eafcd4 0%, var(--lime-cream) 45%, var(--celadon) 100%);
            min-height: 100vh;
        }

        /* ── Card ── */
        .table-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid var(--celadon);
            box-shadow: 0 8px 24px rgba(92, 129, 72, 0.10);
            overflow: hidden;
        }

        /* ── Card header strip ── */
        .card-header {
            background: linear-gradient(90deg, var(--fern) 0%, var(--sage-green) 55%, var(--muted-olive) 100%);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        .card-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .card-header .header-icon {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.18);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .card-header h3 {
            color: #ffffff;
            font-size: 1.05rem;
            font-weight: 800;
            margin: 0;
        }
        .card-header p {
            color: rgba(255,255,255,0.78);
            font-size: 0.78rem;
            margin: 2px 0 0;
        }

        /* ── Btn tambah ── */
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 18px;
            background: #ffffff;
            color: var(--fern);
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .btn-add:hover {
            background: var(--lime-cream);
            transform: translateY(-1px);
        }

        /* ── Alert ── */
        .alert-success {
            background-color: var(--celadon);
            border: 1px solid var(--muted-olive);
            color: var(--fern);
            border-radius: 10px;
            padding: 12px 18px;
            font-weight: 700;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 24px 0;
        }

        /* ── Table ── */
        .news-table { width: 100%; border-collapse: separate; border-spacing: 0; }
        .news-table th {
            background-color: var(--fern);
            color: #ffffff;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 14px 16px;
            text-align: left;
        }
        .news-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #e8f5d9;
            vertical-align: middle;
            color: var(--fern);
            font-size: 0.875rem;
        }
        .news-table tbody tr { background: #ffffff; transition: background 0.15s; }
        .news-table tbody tr:hover { background: rgba(214,236,137,0.2); }
        .news-table tbody tr:last-child td { border-bottom: none; }

        /* ── Foto thumbnail ── */
        .news-thumb {
            width: 60px; height: 44px;
            object-fit: cover;
            border-radius: 6px;
            border: 1.5px solid var(--celadon);
        }
        .news-thumb-placeholder {
            width: 60px; height: 44px;
            background: var(--celadon);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
        }

        /* ── Badges ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 700;
        }
        .badge-published {
            background: var(--celadon);
            color: var(--fern);
            border: 1px solid var(--muted-olive);
        }
        .badge-draft {
            background: #f3f4f6;
            color: #6b7280;
            border: 1px solid #e5e7eb;
        }
        .badge-kategori {
            background: #f0fdf4;
            color: var(--sage-green);
            border: 1px solid var(--celadon);
        }

        /* ── Action buttons ── */
        .btn-edit {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 5px 12px; border-radius: 7px;
            font-size: 0.75rem; font-weight: 700;
            color: var(--sage-green);
            border: 1.5px solid var(--sage-green);
            background: transparent;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-edit:hover { background: var(--sage-green); color: #fff; }

        .btn-delete {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 5px 12px; border-radius: 7px;
            font-size: 0.75rem; font-weight: 700;
            color: #fff;
            background: var(--muted-olive-2);
            border: 1.5px solid var(--muted-olive-2);
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-delete:hover { background: var(--fern); border-color: var(--fern); }

        /* ── Pagination ── */
        .pagination-wrapper {
            padding: 16px 20px;
            border-top: 1px solid #e8f5d9;
        }
        .pagination-wrapper .pagination { display: flex; gap: 6px; flex-wrap: wrap; }
        .pagination-wrapper .page-item .page-link {
            padding: 6px 12px;
            border-radius: 8px;
            border: 1.5px solid var(--celadon);
            color: var(--fern);
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        .pagination-wrapper .page-item.active .page-link {
            background: var(--fern);
            border-color: var(--fern);
            color: #fff;
        }
        .pagination-wrapper .page-item .page-link:hover {
            background: var(--celadon);
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: var(--fern);">
            Berita Kegiatan Yayasan
        </h2>
    </x-slot>

    <div class="page-bg py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="table-card">

                {{-- Header strip --}}
                <div class="card-header">
                    <div class="card-header-left">
                        <div class="header-icon">📰</div>
                        <div>
                            <h3>Kelola Berita & Kegiatan</h3>
                            <p>Publikasikan narasi kegiatan, press release, dan laporan acara yayasan</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.news.create') }}" class="btn-add">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2.5"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Tambah Berita
                    </a>
                </div>

                {{-- Flash --}}
                @if(session('success'))
                    <div class="alert-success">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="news-table">
                        <thead>
                            <tr>
                                <th style="width:70px;">Foto</th>
                                <th>Judul & Kategori</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
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
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                     style="stroke: var(--fern); opacity:0.5;"
                                                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                                    <path d="m21 15-5-5L5 21"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Judul --}}
                                    <td>
                                        <div class="font-bold" style="color: var(--fern); max-width: 280px;">
                                            {{ Str::limit($item->judul, 55) }}
                                        </div>
                                        <span class="badge badge-kategori mt-1">{{ $item->kategori }}</span>
                                    </td>

                                    {{-- Tanggal --}}
                                    <td class="whitespace-nowrap" style="color: var(--sage-green);">
                                        {{ $item->tanggal_kegiatan->translatedFormat('d M Y') }}
                                    </td>

                                    {{-- Lokasi --}}
                                    <td style="color: var(--sage-green); max-width: 160px;">
                                        {{ $item->lokasi ?? '-' }}
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @if($item->status === 'published')
                                            <span class="badge badge-published">● Tayang</span>
                                        @else
                                            <span class="badge badge-draft">○ Draft</span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td>
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn-edit">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2.5"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.news.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Hapus berita \'{{ addslashes($item->judul) }}\'?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-delete">
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2.5"
                                                         stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"/>
                                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                        <path d="M10 11v6M14 11v6"/>
                                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-16">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center"
                                                 style="background: var(--celadon);">
                                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                                     style="stroke: var(--fern);"
                                                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                                    <polyline points="14 2 14 8 20 8"/>
                                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                                </svg>
                                            </div>
                                            <p class="font-bold" style="color: var(--fern);">Belum ada berita kegiatan</p>
                                            <p class="text-sm" style="color: var(--sage-green);">Mulai dengan menambahkan berita atau laporan kegiatan pertama.</p>
                                            <a href="{{ route('admin.news.create') }}" class="btn-add" style="margin-top:4px;">
                                                + Tambah Sekarang
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
        </div>
    </div>
</x-app-layout>