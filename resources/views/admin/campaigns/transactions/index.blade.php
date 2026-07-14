<x-admin-layout>
    <div class="bg-base-200 min-h-screen">

        {{-- Page header --}}
        <div class="px-8 pt-8 pb-0">
            <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Verifikasi Pembayaran Donasi</h1>
                            <p class="text-sm text-base-content/50">Cek bukti transfer dan konfirmasi donasi yang masuk ke yayasan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            {{-- Table Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">✅</div>
                    <div>
                        <p class="font-extrabold text-sm text-base-content">Daftar Donasi Menunggu Verifikasi</p>
                        <p class="text-xs text-base-content/50">Konfirmasi manual untuk donasi yang membutuhkan pengecekan</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Donatur &amp; Kampanye</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nominal &amp; Bank</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Bukti Transfer</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <td>
                                        <div class="font-bold text-sm text-base-content">{{ $donation->donor_name }}</div>
                                        <div class="text-xs text-base-content/40 mb-1">{{ $donation->donor_email }}</div>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-primary/5 text-primary border border-primary/20">{{ $donation->campaign->title ?? 'Kampanye Dihapus' }}</span>
                                    </td>
                                    <td>
                                        <div class="font-bold text-primary">Rp {{ number_format($donation->amount, 0, ',', '.') }}</div>
                                        <div class="text-xs text-base-content/50 font-semibold mt-1">Via: {{ $donation->payment_method ?? 'N/A' }}</div>
                                    </td>
                                    <td>
                                        @if($donation->payment_proof)
                                            <a href="{{ asset('storage/' . $donation->payment_proof) }}" target="_blank" class="avatar">
                                                <div class="w-16 h-12 rounded-lg ring ring-base-300 ring-offset-1 hover:opacity-80 transition">
                                                    <img src="{{ asset('storage/' . $donation->payment_proof) }}" alt="Bukti" class="object-cover">
                                                </div>
                                            </a>
                                        @else
                                            <span class="text-xs text-rose-400 italic">Belum diupload</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($donation->status == 'pending')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                Menunggu
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Berhasil
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($donation->status == 'pending')
                                            <form action="{{ route('admin.transactions.approve', $donation->id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                @csrf @method('PATCH')
                                                <button type="button" @click="open = true" class="btn btn-sm bg-primary hover:bg-primary/90 text-white border-0 rounded-lg font-bold">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 13l4 4L19 7"/></svg>
                                                    Konfirmasi ACC
                                                </button>
                                                <dialog class="modal" :class="{ 'modal-open': open }">
                                                    <div class="modal-box max-w-sm">
                                                        <div class="text-center">
                                                            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center">
                                                                <svg class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                            </div>
                                                            <h3 class="text-lg font-black text-base-content mb-1">Konfirmasi Verifikasi</h3>
                                                            <p class="text-sm text-base-content/60 mb-6">Yakin menyetujui donasi ini?</p>
                                                        </div>
                                                        <div class="flex gap-2 justify-center">
                                                            <button type="button" @click="open = false" class="btn btn-ghost btn-sm font-bold px-6">Batal</button>
                                                            <button @click="open = false; $el.closest('form').submit()" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 btn-sm font-bold px-6">ACC</button>
                                                        </div>
                                                    </div>
                                                    <form method="dialog" class="modal-backdrop"><button>close</button></form>
                                                </dialog>
                                            </form>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-sm font-bold text-emerald-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                                Telah ACC
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="py-16 text-center">
                                            <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-base-content">Belum ada donasi menunggu verifikasi</p>
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
</x-admin-layout>
