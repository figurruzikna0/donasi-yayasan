<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-emerald-700 leading-tight">
            {{ __('Verifikasi Pembayaran Donasi') }}
        </h2>
        <p class="text-sm text-emerald-500 mt-1 font-medium">Cek bukti transfer dan konfirmasi donasi yang masuk ke yayasan.</p>
    </x-slot>

    <div class="bg-emerald-50 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="alert alert-success mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Donatur & Kampanye</th>
                                <th>Nominal & Bank</th>
                                <th>Bukti Transfer</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                                <tr>
                                    <td>
                                        <div class="font-bold text-emerald-700">{{ $donation->donor_name }}</div>
                                        <div class="text-xs text-emerald-500 mb-1">{{ $donation->donor_email }}</div>
                                        <div class="text-xs font-bold text-emerald-600 bg-emerald-100 inline-block px-2 py-0.5 rounded">
                                            {{ $donation->campaign->title ?? 'Kampanye Dihapus' }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="font-bold text-emerald-700 text-base">Rp {{ number_format($donation->amount, 0, ',', '.') }}</div>
                                        <div class="text-xs text-emerald-500 font-semibold mt-1">Via: {{ $donation->payment_method ?? 'N/A' }}</div>
                                    </td>

                                    <td>
                                        @if($donation->payment_proof)
                                            <a href="{{ asset('storage/' . $donation->payment_proof) }}" target="_blank" class="block w-16 h-16 rounded overflow-hidden border border-emerald-200 shadow-sm hover:opacity-80 transition">
                                                <img src="{{ asset('storage/' . $donation->payment_proof) }}" alt="Bukti" class="w-full h-full object-cover">
                                            </a>
                                        @else
                                            <span class="text-xs text-red-400 italic">Belum diupload</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($donation->status == 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @else
                                            <span class="badge badge-success">Berhasil</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($donation->status == 'pending')
                                            <form action="{{ route('admin.transactions.approve', $donation->id) }}" method="POST" onsubmit="return confirm('Yakin ACC donasi ini?');">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    Konfirmasi ACC
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-emerald-500 flex items-center justify-center font-bold">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Telah ACC
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-emerald-500 font-medium">
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
