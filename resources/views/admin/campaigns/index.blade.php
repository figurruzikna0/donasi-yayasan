<x-app-layout>
    <style>
        :root {
            --honeydew: #f1faeeff;
            --frosted-blue: #a8dadcff;
            --cerulean: #457b9dff;
            --oxford-navy: #1d3557ff;
        }

        /* Timpa background utama aplikasi agar senada */
        .page-wrapper {
            background-color: var(--honeydew);
            min-height: 100vh;
        }

        /* Tipografi Header */
        .text-navy { color: var(--oxford-navy) !important; }
        .text-cerulean { color: var(--cerulean) !important; }

        /* Tombol Tambah Kampanye */
        .btn-primary-custom {
            background-color: var(--cerulean);
            color: var(--honeydew);
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        .btn-primary-custom:hover {
            background-color: var(--oxford-navy);
            box-shadow: 0 8px 15px rgba(29, 53, 87, 0.2);
            transform: translateY(-2px);
        }

        /* Alert Sukses */
        .alert-custom {
            background-color: var(--frosted-blue);
            color: var(--oxford-navy);
            border: 1px solid var(--cerulean);
            box-shadow: 0 4px 6px rgba(69, 123, 157, 0.1);
        }

        /* Styling Tabel */
        .table-card {
            background-color: #ffffff;
            border: 1px solid var(--frosted-blue);
            box-shadow: 0 10px 20px rgba(69, 123, 157, 0.08);
        }
        .table-header {
            background-color: var(--honeydew);
            color: var(--oxford-navy);
            border-bottom: 2px solid var(--frosted-blue);
        }
        .table-row {
            border-bottom: 1px solid var(--frosted-blue);
            transition: background-color 0.2s ease;
        }
        .table-row:hover {
            background-color: rgba(241, 250, 238, 0.6); /* Honeydew transparan */
        }

        /* Badge Status */
        .badge-active {
            background-color: var(--frosted-blue);
            color: var(--oxford-navy);
            border: 1px solid var(--cerulean);
        }
        .badge-inactive {
            background-color: #f1f5f9;
            color: #64748b;
            border: 1px solid #cbd5e1;
        }

        /* Tombol Aksi (Edit & Hapus) */
        .btn-edit-custom {
            background-color: transparent;
            color: var(--cerulean);
            border: 1px solid var(--cerulean);
            transition: all 0.2s ease;
        }
        .btn-edit-custom:hover {
            background-color: var(--frosted-blue);
            color: var(--oxford-navy);
        }

        .btn-delete-custom {
            background-color: var(--oxford-navy);
            color: var(--honeydew);
            border: 1px solid var(--oxford-navy);
            transition: all 0.2s ease;
        }
        .btn-delete-custom:hover {
            background-color: transparent;
            color: var(--oxford-navy);
        }
    </style>

    <div class="page-wrapper py-12">
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="font-extrabold text-2xl text-navy leading-tight">
                        {{ __('Daftar Kampanye Donasi') }}
                    </h2>
                    <p class="text-sm text-cerulean mt-1 font-medium">Buat dan kelola program donasi sebelum memantau transaksi masuk.</p>
                </div>
                <a href="{{ route('admin.campaigns.create') }}" class="btn-primary-custom inline-flex items-center px-4 py-2 rounded-lg font-bold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Kampanye
                </a>
            </div>
        </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="alert-custom mb-6 flex items-center p-4 rounded-lg font-semibold" role="alert">
                    <svg class="flex-shrink-0 inline w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="table-card overflow-hidden sm:rounded-xl">
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
                                <tr class="table-row bg-white">
                                    <td class="px-6 py-4">
                                        <div class="w-20 h-16 rounded-lg overflow-hidden border" style="border-color: var(--frosted-blue);">
                                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover">
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-navy text-base mb-1">{{ $campaign->title }}</div>
                                        <div class="font-medium text-cerulean">
                                            Target: <span class="font-bold">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($campaign->status == 'active')
                                            <span class="badge-active text-xs font-bold px-3 py-1.5 rounded-full">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="badge-inactive text-xs font-bold px-3 py-1.5 rounded-full">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn-edit-custom px-3 py-1.5 rounded font-bold text-xs">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin mau hapus kampanye ini? Datanya nggak bisa balik lho!');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete-custom px-3 py-1.5 rounded font-bold text-xs">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <svg class="mx-auto h-14 w-14 mb-4" style="color: var(--frosted-blue);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        <p class="text-xl font-bold text-navy">Belum ada kampanye</p>
                                        <p class="text-sm mt-2 font-medium text-cerulean">Mulai buat kampanye donasi pertamamu!</p>
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