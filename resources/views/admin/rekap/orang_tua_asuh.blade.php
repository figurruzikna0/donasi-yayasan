<x-admin-layout>
<div class="bg-base-200 min-h-screen">
    <div class="px-8 pt-8 pb-0">
        <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
            <div>
                <div class="flex items-center gap-2.5 mb-2">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </span>
                    <div>
                        <h1 class="text-2xl font-black text-base-content">Data Seluruh Sponsorship</h1>
                        <p class="text-sm text-base-content/50">Rekap lengkap data orang tua asuh (sponsorship).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8 pt-6 space-y-6">
        {{-- STAT CARDS: total sponsorship, jumlah aktif, dan total dana terkumpul --}}
        <div class="grid grid-cols-3 gap-4 max-sm:grid-cols-1">
            <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Sponsorship</div>
                    <div class="text-2xl font-black text-base-content mt-0.5">{{ $totalCount }}</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Aktif</div>
                    <div class="text-2xl font-black text-base-content mt-0.5">{{ $activeCount }}</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Dana</div>
                    <div class="text-lg font-black text-base-content mt-0.5">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        {{-- FILTER & EXPORT: filter tanggal/search, export CSV (admin.rekap.orang-tua-asuh.export) & PDF (admin.rekap.orang-tua-asuh.export-pdf) --}}
        <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
            <div class="px-6 py-4 border-b border-base-200 flex flex-wrap items-center justify-between gap-3">
                <form method="GET" class="flex flex-wrap items-end gap-x-3 gap-y-2">
                    <div>
                        <label class="text-[11px] font-semibold text-base-content/50 block mb-0.5">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="input input-bordered input-sm w-40">
                    </div>
                    <div>
                        <label class="text-[11px] font-semibold text-base-content/50 block mb-0.5">Sampai</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="input input-bordered input-sm w-40">
                    </div>
                    <div>
                        <label class="text-[11px] font-semibold text-base-content/50 block mb-0.5">Cari</label>
                        <input type="text" name="search" placeholder="Cari donor/email/order/anak..." class="input input-bordered input-sm w-40" value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 btn-sm font-bold rounded-lg">Filter</button>
                    <a href="{{ route('admin.rekap.orang-tua-asuh') }}" class="btn btn-ghost btn-sm font-bold">Reset</a>
                </form>
                <div class="flex gap-2">
                    <a href="{{ route('admin.rekap.orang-tua-asuh.export') }}?{{ request()->getQueryString() }}" class="btn btn-sm bg-primary/10 hover:bg-primary/20 text-primary border-0 font-bold rounded-lg">Export CSV</a>
                    <a href="{{ route('admin.rekap.orang-tua-asuh.export-pdf') }}?{{ request()->getQueryString() }}" class="btn btn-sm bg-error/10 hover:bg-error/20 text-error border-0 font-bold rounded-lg">Export PDF</a>
                </div>
            </div>

            {{-- FILTER STATUS: filter sponsorship (Semua/Aktif/Menunggu/Kadaluarsa/Gagal) — via query param status --}}
            <div class="px-6 py-3 border-b border-base-200 bg-base-100/50 flex flex-wrap items-center gap-1.5">
                <span class="text-[11px] font-semibold text-base-content/50 mr-1">Status:</span>
                @php $curStatus = request('status'); @endphp
                <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => ''])) }}" class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ !$curStatus ? 'bg-primary text-white shadow-sm' : 'bg-base-200 text-base-content/60 hover:bg-base-300' }}">Semua</a>
                <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'aktif'])) }}" class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'aktif' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100' }}">Aktif</a>
                <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'pending'])) }}" class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'pending' ? 'bg-amber-500 text-white shadow-sm' : 'bg-amber-50 text-amber-600 border border-amber-200 hover:bg-amber-100' }}">Menunggu</a>
                <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'kadaluarsa'])) }}" class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'kadaluarsa' ? 'bg-gray-500 text-white shadow-sm' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100' }}">Kadaluarsa</a>
                <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'gagal'])) }}" class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'gagal' ? 'bg-red-500 text-white shadow-sm' : 'bg-red-50 text-red-600 border border-red-200 hover:bg-red-100' }}">Gagal</a>
            </div>

            {{-- TABEL SPONSORSHIP: daftar lengkap orang tua asuh — data dari $sponsorships, menampilkan periode & status dinamis --}}
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-200/50">
                            <th class="w-[140px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nama</th>
                            <th class="w-[170px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Email</th>
                            <th class="w-[120px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">No. Telepon</th>
                            <th class="w-[130px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Anak Asuh</th>
                            <th class="w-[90px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Paket</th>
                            <th class="w-[110px] text-right text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nominal</th>
                            <th class="w-[150px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Kode Donasi</th>
                            <th class="w-[120px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Metode</th>
                            <th class="w-[170px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Periode</th>
                            <th class="w-[90px] text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200/60">
                        @forelse($sponsorships as $s)
                            @php
                                $isExpiredPeriod = $s->expires_at && $s->expires_at->isPast();
                                $remainingDays = $s->expires_at ? (int) now()->diffInDays($s->expires_at) : null;

                                $statusKey = match(true) {
                                    $s->status === 'pending' => 'pending',
                                    $s->status === 'success' && !$isExpiredPeriod => 'aktif',
                                    $s->status === 'success' && $isExpiredPeriod => 'kadaluarsa',
                                    $s->status === 'expired' => 'kadaluarsa',
                                    default => 'gagal',
                                };

                                $pmt = $s->payment_method;
                                $pmClass = $pmt ? match(true) {
                                    str_contains($pmt, 'BRI') => 'bg-blue-50 text-blue-700 border-blue-200',
                                    str_contains($pmt, 'BCA') => 'bg-red-50 text-red-700 border-red-200',
                                    str_contains($pmt, 'Mandiri') => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                    str_contains($pmt, 'BNI') => 'bg-orange-50 text-orange-700 border-orange-200',
                                    default => 'bg-base-200/70 text-base-content/50 border-base-300'
                                } : null;
                            @endphp
                            <tr class="hover:bg-base-200/30 transition-colors">
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-primary/10 text-primary font-bold text-xs flex items-center justify-center uppercase shrink-0">{{ substr($s->donor_name, 0, 1) }}</div>
                                        <span class="text-sm font-semibold text-base-content">{{ $s->donor_name }}</span>
                                    </div>
                                </td>
                                <td class="text-sm text-base-content/60">{{ $s->donor_email }}</td>
                                <td>
                                    <span class="inline-flex items-center gap-1.5 text-sm text-base-content/60">
                                        <svg class="w-3 h-3 text-base-content/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        {{ $s->donor_phone ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.6rem] font-bold bg-primary/5 text-primary border border-primary/20">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        {{ $s->fosterChild?->name ?? 'Anak Dihapus' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[0.6rem] font-bold bg-amber-50 text-amber-700 border border-amber-200">{{ $s->package ?? '-' }}</span>
                                </td>
                                <td class="text-right">
                                    <div class="font-bold text-primary text-sm">Rp {{ number_format($s->amount, 0, ',', '.') }}</div>
                                </td>
                                <td>
                                    <span class="inline-flex text-[0.6rem] text-base-content/30 font-mono bg-base-200/70 px-1.5 py-0.5 rounded">{{ $s->order_id }}</span>
                                </td>
                                <td>
                                    @if($pmt)
                                        <span class="inline-flex items-center gap-1 text-[0.6rem] font-bold px-2 py-0.5 rounded-full border {{ $pmClass }}">
                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                            {{ $pmt }}
                                        </span>
                                    @else
                                        <span class="text-xs text-base-content/30">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($s->starts_at && $s->expires_at)
                                        <div class="text-sm font-bold text-base-content whitespace-nowrap">{{ $s->starts_at->format('d M Y') }} – {{ $s->expires_at->format('d M Y') }}</div>
                                        <div class="text-xs mt-1">
                                            @if($statusKey === 'aktif')
                                                <span class="text-emerald-600 font-semibold">{{ $remainingDays }} hari lagi</span>
                                            @elseif($statusKey === 'kadaluarsa')
                                                <span class="text-rose-600 font-semibold">Lewat {{ abs($remainingDays) }} hari</span>
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <div class="py-16 text-center">
                                        <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <p class="font-extrabold text-base-content">Belum ada sponsorship</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $sponsorships->links() }}
    </div>
</div>
</x-admin-layout>
