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

        /* Page background */
        .page-wrapper {
            background: linear-gradient(145deg, #eafcd4 0%, var(--lime-cream) 40%, var(--celadon) 100%);
            min-height: 100vh;
        }

        /* Utility text colours */
        .text-fern    { color: var(--fern) !important; }
        .text-sage    { color: var(--sage-green) !important; }

        /* ── Header box ── */
        .header-box {
            background: linear-gradient(100deg, var(--fern) 0%, var(--sage-green) 60%, var(--muted-olive) 100%);
            color: #ffffff;
        }
        .btn-header {
            background-color: #ffffff;
            color: var(--fern);
            border: 2px solid transparent;
            transition: all 0.25s ease;
        }
        .btn-header:hover {
            background-color: var(--fern);
            color: #ffffff;
            border-color: rgba(255,255,255,0.4);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(92, 129, 72, 0.35);
        }

        /* ── Summary cards ── */
        .summary-card {
            background-color: #ffffff;
            border: 1px solid var(--celadon);
            box-shadow: 0 4px 10px rgba(92, 129, 72, 0.08);
            transition: all 0.25s ease;
        }
        .summary-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(92, 129, 72, 0.18);
            border-color: var(--sage-green);
        }
        .icon-box {
            background-color: var(--celadon);
            color: var(--fern);
        }
        .icon-box-accent {
            background-color: var(--muted-olive-2);
            color: #ffffff;
        }

        /* ── Alert ── */
        .alert-success {
            background-color: var(--celadon);
            color: var(--fern);
            border: 1px solid var(--muted-olive);
        }

        /* ── Table card ── */
        .table-card {
            background-color: #ffffff;
            border: 1px solid var(--celadon);
            box-shadow: 0 10px 24px rgba(92, 129, 72, 0.10);
        }
        .table-header {
            background-color: var(--fern);
            color: #ffffff;
        }
        .table-row {
            border-bottom: 1px solid #e8f5d9;
            transition: background-color 0.15s;
        }
        .table-row:hover {
            background-color: rgba(214, 236, 137, 0.25); /* lime-cream transparan */
        }

        /* ── Badges ── */
        .badge-available {
            background-color: var(--celadon);
            color: var(--fern);
            border: 1px solid var(--muted-olive);
        }
        .badge-adopted {
            background-color: var(--fern);
            color: #ffffff;
        }

        /* ── Action buttons ── */
        .btn-edit {
            background-color: transparent;
            color: var(--sage-green);
            border: 1.5px solid var(--sage-green);
            transition: all 0.2s;
        }
        .btn-edit:hover {
            background-color: var(--sage-green);
            color: #ffffff;
        }

        .btn-delete {
            background-color: var(--muted-olive-2);
            color: #ffffff;
            border: 1.5px solid var(--muted-olive-2);
            transition: all 0.2s;
        }
        .btn-delete:hover {
            background-color: var(--fern);
            border-color: var(--fern);
            color: #ffffff;
        }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center header-box -mx-4 -my-4 px-6 py-6 rounded-xl shadow-md">
            <div class="mb-4 sm:mb-0">
                <h2 class="font-extrabold text-2xl leading-tight text-white">
                    Kelola Data Anak Asuh
                </h2>
                <p class="text-sm font-medium mt-1" style="color: rgba(255,255,255,0.85);">
                    Pantau dan kelola daftar seluruh anak asuh yayasan.
                </p>
            </div>
            <a href="{{ route('admin.foster-children.create') }}"
               class="btn-header inline-flex items-center gap-2 font-bold py-2.5 px-6 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Anak Asuh
            </a>
        </div>
    </x-slot>

    <div class="page-wrapper py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                {{-- Total --}}
                <div class="summary-card rounded-2xl p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl icon-box flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-sage uppercase tracking-wider">Total Anak Asuh</p>
                        <p class="text-3xl font-extrabold text-fern mt-1">{{ $children->count() }}</p>
                    </div>
                </div>

                {{-- Tersedia --}}
                <div class="summary-card rounded-2xl p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl icon-box flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-sage uppercase tracking-wider">Tersedia</p>
                        <p class="text-3xl font-extrabold text-fern mt-1">{{ $children->where('status', 'Tersedia')->count() }}</p>
                    </div>
                </div>

                {{-- Diasuh --}}
                <div class="summary-card rounded-2xl p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl icon-box-accent flex items-center justify-center flex-shrink-0 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-sage uppercase tracking-wider">Sedang Diasuh</p>
                        <p class="text-3xl font-extrabold text-fern mt-1">{{ $children->where('status', '!=', 'Tersedia')->count() }}</p>
                    </div>
                </div>

            </div>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="alert-success flex items-center gap-3 px-5 py-4 rounded-xl font-bold shadow-sm" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0"
                         viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Table Card --}}
            <div class="table-card overflow-hidden rounded-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="table-header">
                            <tr>
                                <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider">Umur</th>
                                <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider">Status</th>
                                <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($children as $child)
                                <tr class="table-row bg-white">

                                    {{-- Foto --}}
                                    <td class="px-6 py-4">
                                        @if($child->photo)
                                            <img src="{{ asset('storage/' . $child->photo) }}"
                                                 alt="Foto {{ $child->name }}"
                                                 class="w-14 h-14 object-cover rounded-xl shadow-sm"
                                                 style="border: 2px solid var(--celadon);">
                                        @else
                                            <div class="w-14 h-14 rounded-xl flex items-center justify-center"
                                                 style="background-color: var(--celadon); border: 2px solid var(--muted-olive);">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                     style="color: var(--fern);"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Nama --}}
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-fern text-base">{{ $child->name }}</span>
                                    </td>

                                    {{-- Umur --}}
                                    <td class="px-6 py-4">
                                        <div class="inline-flex items-center gap-1.5 font-semibold text-sage">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $child->age }} Tahun
                                        </div>
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-4">
                                        @if($child->status == 'Tersedia')
                                            <span class="badge-available text-xs font-bold px-3 py-1.5 rounded-full inline-flex items-center gap-1.5">
                                                <span class="w-2 h-2 rounded-full" style="background-color: var(--sage-green);"></span>
                                                Tersedia
                                            </span>
                                        @else
                                            <span class="badge-adopted text-xs font-bold px-3 py-1.5 rounded-full inline-flex items-center gap-1.5">
                                                <span class="w-2 h-2 rounded-full bg-white opacity-80"></span>
                                                Diasuh
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.foster-children.edit', $child->id) }}"
                                               class="btn-edit inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.foster-children.destroy', $child->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data {{ $child->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn-delete inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center bg-white">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-2xl icon-box flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                          d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/>
                                                </svg>
                                            </div>
                                            <p class="font-bold text-fern text-base">Belum ada data anak asuh</p>
                                            <p class="text-sm font-medium text-sage">Mulai dengan menambahkan data anak asuh baru ke sistem.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>