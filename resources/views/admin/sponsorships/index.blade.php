<x-admin-layout>
    <div class="bg-base-200 min-h-screen">

        {{-- Header: judul & deskripsi halaman Sponsorship Orang Tua Asuh --}}
        <div class="px-8 pt-8 pb-0">
            <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Sponsorship Orang Tua Asuh</h1>
                            <p class="text-sm text-base-content/50">Pantau status sponsorship anak asuh, masa aktif, dan jatuh tempo perpanjangan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            {{-- Hitung total, aktif, pending, gagal/kadaluarsa dari $sponsorships --}}
            @php
                $total = $sponsorships->total();
                $activeCount = $sponsorships->filter(function($s) {
                    $expired = $s->expires_at && $s->expires_at->isPast();
                    return $s->status === 'success' && !$expired;
                })->count();
                $pendingCount = $sponsorships->filter(fn($s) => $s->status === 'pending')->count();
                $failedExpiredCount = $sponsorships->filter(function($s) {
                    $expired = $s->expires_at && $s->expires_at->isPast();
                    return ($s->status === 'success' && $expired) || in_array($s->status, ['expired', 'failed', 'cancelled']);
                })->count();
            @endphp

            {{-- Kartu statistik: Total, Aktif, Menunggu, Gagal/Kadaluarsa --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Sponsorship</p>
                        <p class="text-2xl font-black text-base-content">{{ $total }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Aktif</p>
                        <p class="text-2xl font-black text-base-content">{{ $activeCount }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Menunggu</p>
                        <p class="text-2xl font-black text-base-content">{{ $pendingCount }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-rose-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                    </div>
                    <div>
                        <p class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Gagal / Kadaluarsa</p>
                        <p class="text-2xl font-black text-base-content">{{ $failedExpiredCount }}</p>
                    </div>
                </div>
            </div>

            {{-- Tabel daftar sponsorship: penyandang dana, anak asuh, paket, periode, status, & aksi --}}
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/></svg>
                    </div>
                    <div>
                        <p class="font-extrabold text-sm text-base-content">Daftar Sponsorship</p>
                        <p class="text-xs text-base-content/50">Total: {{ $total }} sponsorship</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="w-[230px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Penyandang Dana &amp; Anak Asuh</th>
                                <th class="w-[150px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Paket &amp; Nominal</th>
                                <th class="w-[170px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Periode</th>
                                <th class="w-[90px] text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                <th class="w-[120px] text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-200/60">
                            @forelse($sponsorships as $sponsorship)
                                @php
                                    $isExpiredPeriod = $sponsorship->expires_at && $sponsorship->expires_at->isPast();
                                    $remainingDays = $sponsorship->expires_at ? now()->diffInDays($sponsorship->expires_at) : null;

                                    $statusKey = match(true) {
                                        $sponsorship->status === 'pending' => 'pending',
                                        $sponsorship->status === 'success' && !$isExpiredPeriod => 'aktif',
                                        $sponsorship->status === 'success' && $isExpiredPeriod => 'kadaluarsa',
                                        $sponsorship->status === 'expired' => 'kadaluarsa',
                                        default => 'gagal',
                                    };
                                @endphp
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-primary/10 text-primary font-bold text-sm flex items-center justify-center uppercase shrink-0">{{ substr($sponsorship->donor_name, 0, 1) }}</div>
                                            <div>
                                                <div class="font-bold text-sm text-base-content">{{ $sponsorship->donor_name }}</div>
                                                <div class="text-xs text-base-content/40">{{ $sponsorship->donor_email }}</div>
                                                <div class="text-xs text-base-content/40">
                                                    <svg class="w-3.5 h-3.5 inline-block align-text-bottom" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-1.5 16.5h.01"/></svg>
                                                    {{ $sponsorship->donor_phone ?? '-' }}
                                                </div>
                                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-primary/5 text-primary border border-primary/20 mt-1">{{ $sponsorship->fosterChild->name ?? 'Anak Dihapus' }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-amber-50 text-amber-700 border border-amber-200">{{ $sponsorship->package ?? '-' }}</span>
                                        <div class="font-black text-base-content mt-1">Rp {{ number_format($sponsorship->amount, 0, ',', '.') }}</div>
                                        <div class="text-xs text-base-content/30 font-mono">{{ $sponsorship->order_id }}</div>
                                        @if($sponsorship->payment_method)
                                            <div class="text-xs text-base-content/40">via {{ $sponsorship->payment_method }}</div>
                                        @endif
                                    </td>

                                    <td>
                                        @if($sponsorship->starts_at && $sponsorship->expires_at)
                                            <div class="text-sm font-bold text-base-content whitespace-nowrap">{{ $sponsorship->starts_at->format('d M Y') }} – {{ $sponsorship->expires_at->format('d M Y') }}</div>
                                            <div class="text-xs mt-1">
                                                @if($statusKey === 'aktif')
                                                    <span class="text-emerald-600">{{ $remainingDays }} hari lagi</span>
                                                @elseif($statusKey === 'kadaluarsa')
                                                    <span class="text-rose-600">{{ $remainingDays > 0 ? 'Lewat ' . $remainingDays . ' hari' : 'Kadaluarsa' }}</span>
                                                @endif
                                            </div>
                                        @else
                                            <div class="text-sm font-bold text-base-content">-</div>
                                            <div class="text-xs text-base-content/40">Belum dibayar</div>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($statusKey === 'aktif')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Aktif
                                            </span>
                                        @elseif($statusKey === 'pending')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                Menunggu
                                            </span>
                                        @elseif($statusKey === 'kadaluarsa')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-base-200 text-base-content/50">
                                                <span class="w-1.5 h-1.5 rounded-full bg-base-content/20"></span>
                                                Kadaluarsa
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-600">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                Gagal
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            @if($sponsorship->status === 'pending')
                                                <form action="{{ route('admin.sponsorships.approve', $sponsorship->order_id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                    @csrf @method('PATCH')
                                                    <button type="button" @click="open = true" class="btn btn-sm bg-emerald-600 hover:bg-emerald-700 text-white border-0 rounded-lg font-bold">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                        Setujui
                                                    </button>
                                                    <dialog class="modal" :class="{ 'modal-open': open }">
                                                        <div class="modal-box max-w-sm">
                                                            <div class="text-center">
                                                                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center">
                                                                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                                </div>
                                                                <h3 class="text-lg font-black text-base-content mb-1">Konfirmasi</h3>
                                                                <p class="text-sm text-base-content/60 mb-6">Setujui sponsorship ini secara manual?</p>
                                                            </div>
                                                            <div class="flex gap-2 justify-center">
                                                                <button type="button" @click="open = false" class="btn btn-ghost btn-sm font-bold px-6">Batal</button>
                                                                <button @click="open = false; $el.closest('form').submit()" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 btn-sm font-bold px-6">Setujui</button>
                                                            </div>
                                                        </div>
                                                        <form method="dialog" class="modal-backdrop"><button>close</button></form>
                                                    </dialog>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.sponsorships.destroy', $sponsorship->order_id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                @csrf @method('DELETE')
                                                <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    Hapus
                                                </button>
                                                <x-confirm-delete-modal entity-name="{{ $sponsorship->donor_name }}" entity-type="sponsorship" />
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="py-16 text-center">
                                            <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-base-content">Belum Ada Sponsorship</p>
                                            <p class="text-sm text-base-content/50 mt-1">Sponsorship anak asuh yang masuk lewat Midtrans akan tampil di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- Pagination: navigasi halaman tabel sponsorship --}}
                @if($sponsorships->hasPages())
                    <div class="p-4 border-t border-base-200">
                        {{ $sponsorships->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-admin-layout>
