<x-app-layout>
    <style>
        :root {
            --celadon:       #b3e093;
            --muted-olive:   #a1c181;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
            --honeydew:      #f0f7ec;
        }

        .page-wrapper {
            background-color: var(--honeydew);
            min-height: 100vh;
        }

        /* Tipografi */
        .text-fern { color: var(--fern) !important; }
        .text-sage { color: var(--sage-green) !important; }

        /* Tombol Tambah Kampanye */
        .btn-primary-custom {
            background-color: var(--fern);
            color: white;
            transition: all 0.3s ease;
        }
        .btn-primary-custom:hover {
            background-color: var(--sage-green);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(92, 129, 72, 0.2);
        }

        /* Alert Sukses */
        .alert-custom {
            background-color: #eafcd4;
            color: var(--fern);
            border: 1px solid var(--celadon);
        }

        /* Styling Tabel */
        .table-card {
            background-color: #ffffff;
            border: 1px solid var(--celadon);
            box-shadow: 0 10px 20px rgba(92, 129, 72, 0.05);
        }
        .table-header {
            background-color: #f8fafc;
            color: var(--fern);
            border-bottom: 2px solid var(--celadon);
        }
        .table-row {
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.2s ease;
        }
        .table-row:hover {
            background-color: #fdfefc;
        }

        /* Badge Status */
        .badge-active {
            background-color: var(--celadon);
            color: var(--fern);
        }
        .badge-inactive {
            background-color: #f1f5f9;
            color: #64748b;
        }

        /* Tombol Aksi */
        .btn-edit-custom {
            background-color: transparent;
            color: var(--sage-green);
            border: 1px solid var(--sage-green);
        }
        .btn-edit-custom:hover {
            background-color: var(--sage-green);
            color: white;
        }
        .btn-delete-custom {
            background-color: #ef4444;
            color: white;
            border: 1px solid #ef4444;
        }
        .btn-delete-custom:hover {
            background-color: #dc2626;
        }
    </style>

    <div class="page-wrapper py-12">
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="font-extrabold text-2xl text-fern leading-tight">
                        {{ __('Daftar Kampanye Donasi') }}
                    </h2>
                    <p class="text-sm text-sage mt-1 font-medium">Kelola program donasi untuk memberikan dampak lebih luas.</p>
                </div>
                <a href="{{ route('admin.campaigns.create') }}" class="btn-primary-custom inline-flex items-center px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Kampanye
                </a>
            </div>
        </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="alert-custom mb-6 flex items-center p-4 rounded-xl font-semibold">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="table-card overflow-hidden sm:rounded-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="table-header text-xs uppercase font-bold">
                            <tr>
                                <th scope="col" class="px-6 py-4">Gambar</th>
                                <th scope="col" class="px-6 py-4">Detail Kampanye</th>
                                <th scope="col" class="px-6 py-4">Status</th>
                                <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($campaigns as $campaign)
                                <tr class="table-row">
                                    <td class="px-6 py-4">
                                        <div class="w-20 h-16 rounded-xl overflow-hidden border border-gray-100">
                                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800 text-base mb-1">{{ $campaign->title }}</div>
                                        <div class="font-medium text-sage">
                                            Target: <span class="font-bold text-fern">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($campaign->status == 'active')
                                            <span class="badge-active text-xs font-bold px-3 py-1 rounded-full">Aktif</span>
                                        @else
                                            <span class="badge-inactive text-xs font-bold px-3 py-1 rounded-full">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn-edit-custom px-4 py-1.5 rounded-lg font-bold text-xs">Edit</a>
                                            <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-delete-custom px-4 py-1.5 rounded-lg font-bold text-xs">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center text-slate-400">
                                        Belum ada kampanye yang tersedia.
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