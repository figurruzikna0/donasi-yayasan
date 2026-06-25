<x-app-layout>
    <style>
        :root {
            --honeydew: #f1faeeff;
            --frosted-blue: #a8dadcff;
            --cerulean: #457b9dff;
            --oxford-navy: #1d3557ff;
        }

        .page-wrapper { background-color: var(--honeydew); min-height: 100vh; }
        .text-navy { color: var(--oxford-navy) !important; }
        .text-cerulean { color: var(--cerulean) !important; }

        /* Tabel & Card */
        .table-card {
            background-color: #ffffff;
            border: 1px solid var(--frosted-blue);
            box-shadow: 0 10px 20px rgba(8, 8, 8, 0.08);
        }
        .table-header {
            background-color: var(--honeydew);
            color: var(--oxford-navy);
            border-bottom: 2px solid var(--frosted-blue);
        }
        .table-row { border-bottom: 1px solid var(--frosted-blue); transition: 0.2s; }
        .table-row:hover { background-color: rgba(241, 250, 238, 0.5); }

        /* Badges */
        .badge-pending { background-color: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }
        .badge-success { background-color: #dcfce7; color: #166534; border: 1px solid #86efac; }

        /* Button Konfirmasi */
        .btn-confirm {
            background-color: var(--cerulean);
            color: var(--oxford-navy);
            transition: all 0.3s ease;
        }
        .btn-confirm:hover { background-color: var(--oxford-navy); }
    </style>

    <div class="page-wrapper py-12">
        <x-slot name="header">
            <h2 class="font-extrabold text-2xl text-navy leading-tight">
                {{ __('Verifikasi Pembayaran Donasi') }}
            </h2>
            <p class="text-sm text-cerulean mt-1 font-medium">Cek bukti transfer dan konfirmasi donasi yang masuk ke yayasan.</p>
        </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 rounded-lg font-semibold" style="background-color: var(--frosted-blue); color: var(--oxford-navy);">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-card overflow-hidden sm:rounded-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="table-header text-xs uppercase font-bold">
                            <tr>
                                <th scope="col" class="px-6 py-4">Donatur & Kampanye</th>
                                <th scope="col" class="px-6 py-4">Nominal & Bank</th>
                                <th scope="col" class="px-6 py-4">Bukti Transfer</th>
                                <th scope="col" class="px-6 py-4 text-center">Status</th>
                                <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                                <tr class="table-row">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-navy">{{ $donation->donor_name }}</div>
                                        <div class="text-xs text-cerulean mb-1">{{ $donation->donor_email }}</div>
                                        <div class="text-xs font-bold text-cerulean bg-frosted-blue inline-block px-2 py-0.5 rounded">
                                            {{ $donation->campaign->title ?? 'Kampanye Dihapus' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="font-bold text-navy text-base">Rp {{ number_format($donation->amount, 0, ',', '.') }}</div>
                                        <div class="text-xs text-cerulean font-semibold mt-1">Via: {{ $donation->payment_method ?? 'N/A' }}</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($donation->payment_proof)
                                            <a href="{{ asset('storage/' . $donation->payment_proof) }}" target="_blank" class="block w-16 h-16 rounded overflow-hidden border border-frosted-blue shadow-sm hover:opacity-80 transition">
                                                <img src="{{ asset('storage/' . $donation->payment_proof) }}" alt="Bukti" class="w-full h-full object-cover">
                                            </a>
                                        @else
                                            <span class="text-xs text-red-400 italic">Belum diupload</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if($donation->status == 'pending')
                                            <span class="badge-pending text-xs font-bold px-3 py-1 rounded-full">Menunggu</span>
                                        @else
                                            <span class="badge-success text-xs font-bold px-3 py-1 rounded-full">Berhasil</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if($donation->status == 'pending')
                                            <form action="{{ route('admin.transactions.approve', $donation->id) }}" method="POST" onsubmit="return confirm('Yakin ACC donasi ini?');">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn-confirm px-4 py-2 rounded-lg font-bold text-xs shadow-sm">
                                                    Konfirmasi ACC
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-cerulean flex items-center justify-center font-bold">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Telah ACC
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-cerulean font-medium">
                                        Belum ada donasi menunggu verifikasi.
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