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

        .table-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid var(--celadon);
            box-shadow: 0 8px 24px rgba(92, 129, 72, 0.10);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(90deg, var(--fern) 0%, var(--sage-green) 55%, var(--muted-olive) 100%);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        .card-header-left { display: flex; align-items: center; gap: 12px; }
        .card-header .header-icon {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.18);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .card-header h3 { color: #ffffff; font-size: 1.05rem; font-weight: 800; margin: 0; }
        .card-header p { color: rgba(255,255,255,0.78); font-size: 0.78rem; margin: 2px 0 0; }

        .btn-add {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 18px;
            background: #ffffff; color: var(--fern);
            border-radius: 10px; font-size: 0.82rem; font-weight: 700;
            text-decoration: none; transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .btn-add:hover { background: var(--lime-cream); transform: translateY(-1px); }

        .alert-success {
            background-color: var(--celadon);
            border: 1px solid var(--muted-olive);
            color: var(--fern);
            border-radius: 10px;
            padding: 12px 18px;
            font-weight: 700;
            font-size: 0.875rem;
            display: flex; align-items: center; gap: 10px;
            margin: 20px 24px 0;
        }
        .alert-error {
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #b91c1c;
            border-radius: 10px;
            padding: 12px 18px;
            font-weight: 700;
            font-size: 0.875rem;
            display: flex; align-items: center; gap: 10px;
            margin: 20px 24px 0;
        }

        .dev-table { width: 100%; border-collapse: separate; border-spacing: 0; }
        .dev-table th {
            background-color: var(--fern);
            color: #ffffff;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 14px 16px;
            text-align: left;
        }
        .dev-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #e8f5d9;
            vertical-align: middle;
            color: var(--fern);
            font-size: 0.875rem;
        }
        .dev-table tbody tr { background: #ffffff; transition: background 0.15s; }
        .dev-table tbody tr:hover { background: rgba(214,236,137,0.2); }
        .dev-table tbody tr:last-child td { border-bottom: none; }

        .dev-thumb {
            width: 56px; height: 56px;
            object-fit: cover;
            border-radius: 8px;
            border: 1.5px solid var(--celadon);
        }
        .dev-thumb-placeholder {
            width: 56px; height: 56px;
            background: var(--celadon);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }

        .child-tag {
            display: inline-block;
            padding: 2px 9px;
            background: #edf7e2;
            border: 1px solid var(--celadon);
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--sage-green);
        }

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

        .empty-state { padding: 64px 24px; text-align: center; }
        .empty-icon {
            width: 56px; height: 56px;
            background: var(--celadon);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 14px;
        }
        .empty-title { font-size: 0.95rem; font-weight: 800; color: var(--fern); }
        .empty-sub { font-size: 0.78rem; color: var(--sage-green); margin-top: 4px; }

        .pagination-wrapper { padding: 16px 20px; border-top: 1px solid #e8f5d9; }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: var(--fern);">
            Perkembangan Anak Asuh
        </h2>
    </x-slot>

    <div class="page-bg py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="table-card">

                <div class="card-header">
                    <div class="card-header-left">
                        <div class="header-icon">📈</div>
                        <div>
                            <h3>Laporan Perkembangan Anak Asuh</h3>
                            <p>Catat update berkala untuk anak yang sedang disponsori orang tua asuh</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.child-developments.create') }}" class="btn-add">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Tambah Laporan
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert-success">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="dev-table">
                        <thead>
                            <tr>
                                <th style="width:76px;">Foto</th>
                                <th>Judul & Anak Asuh</th>
                                <th>Tanggal</th>
                                <th>Dibuat Oleh</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($developments as $item)
                                <tr>
                                    <td>
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="dev-thumb">
                                        @else
                                            <div class="dev-thumb-placeholder">
                                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" style="stroke: var(--fern); opacity:0.5;" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                                    <path d="m21 15-5-5L5 21"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="font-bold" style="color: var(--fern); max-width: 280px;">
                                            {{ Str::limit($item->judul, 55) }}
                                        </div>
                                        <span class="child-tag mt-1">{{ $item->fosterChild->name ?? '-' }}</span>
                                    </td>
                                    <td class="whitespace-nowrap" style="color: var(--sage-green);">
                                        {{ $item->tanggal->translatedFormat('d M Y') }}
                                    </td>
                                    <td style="color: var(--sage-green);">
                                        {{ $item->user->name ?? '-' }}
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.child-developments.edit', $item->id) }}" class="btn-edit">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.child-developments.destroy', $item->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus laporan \'{{ addslashes($item->judul) }}\'?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-delete">
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
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
                                    <td colspan="5" class="text-center py-16">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="empty-icon">
                                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" style="stroke: var(--fern);" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                                    <circle cx="9" cy="7" r="4"/>
                                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                                </svg>
                                            </div>
                                            <p class="font-bold" style="color: var(--fern);">Belum ada laporan perkembangan</p>
                                            <p class="text-sm" style="color: var(--sage-green);">Mulai dengan menambahkan laporan untuk anak yang sedang disponsori.</p>
                                            <a href="{{ route('admin.child-developments.create') }}" class="btn-add" style="margin-top:4px;">
                                                + Tambah Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($developments->hasPages())
                    <div class="pagination-wrapper">
                        {{ $developments->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>