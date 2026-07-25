<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.12),transparent_70%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,rgba(16,185,129,0.2),transparent_60%)]"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <div class="flex items-center gap-2.5 mb-1">
                        <span class="w-8 h-0.5 rounded-full bg-emerald-300/60"></span>
                        <span class="text-emerald-200/80 text-xs font-bold uppercase tracking-widest">Rekap Admin</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Data Seluruh Sponsorship</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Rekap lengkap data orang tua asuh (sponsorship)</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.rekap.orang-tua-asuh.export') }}?{{ request()->getQueryString() }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        CSV
                    </a>
                    <a href="{{ route('admin.rekap.orang-tua-asuh.export-pdf') }}?{{ request()->getQueryString() }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-12 space-y-6">

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Sponsorship</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $totalCount }}</div>
                    </div>
                </div>
            </div>
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center text-white shadow-lg shadow-sky-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Aktif</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $activeCount }}</div>
                    </div>
                </div>
            </div>
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white shadow-lg shadow-amber-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Dana</div>
                        <div class="text-xl font-black text-base-content mt-0.5">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="px-4 sm:px-6 py-4 border-b border-base-200 flex flex-wrap items-center justify-between gap-3 bg-base-50/30">
                <form method="GET" class="flex flex-wrap items-end gap-x-3 gap-y-2">
                    <div>
                        <label class="text-[11px] font-semibold text-base-content/50 block mb-0.5">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="input input-bordered input-sm rounded-xl w-40">
                    </div>
                    <div>
                        <label class="text-[11px] font-semibold text-base-content/50 block mb-0.5">Sampai</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="input input-bordered input-sm rounded-xl w-40">
                    </div>
                    <div>
                        <label class="text-[11px] font-semibold text-base-content/50 block mb-0.5">Cari</label>
                        <input type="text" name="search" placeholder="Cari donor/email/order/anak..." class="input input-bordered input-sm rounded-xl w-40" value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 btn-sm font-bold rounded-xl">Filter</button>
                    <a href="{{ route('admin.rekap.orang-tua-asuh') }}" class="btn btn-ghost btn-sm font-bold rounded-xl">Reset</a>
                </form>
            </div>

            <div class="px-4 sm:px-6 py-3 border-b border-base-200 bg-base-50/30 flex flex-wrap items-center gap-1.5">
                <span class="text-[11px] font-semibold text-base-content/50 mr-1">Status:</span>
                @php $curStatus = request('status'); @endphp
                <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => ''])) }}"
                   class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-200 {{ !$curStatus ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80' }}">Semua</a>
                <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'aktif'])) }}"
                   class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-200 {{ $curStatus === 'aktif' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80' }}">Aktif</a>
                <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'pending'])) }}"
                   class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-200 {{ $curStatus === 'pending' ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80' }}">Menunggu</a>
                <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'kadaluarsa'])) }}"
                   class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-200 {{ $curStatus === 'kadaluarsa' ? 'bg-slate-600 text-white shadow-lg shadow-slate-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80' }}">Kadaluarsa</a>
                <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'gagal'])) }}"
                   class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-200 {{ $curStatus === 'gagal' ? 'bg-rose-500 text-white shadow-lg shadow-rose-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80' }}">Gagal</a>
            </div>

            @if($sponsorships->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-50/80 border-b border-base-200">
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Nama</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Email</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">No. Telepon</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Anak Asuh</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Paket</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-right">Nominal</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Kode Donasi</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Metode</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Periode</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-100">
                            @foreach($sponsorships as $s)
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
                                <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 font-bold text-xs flex items-center justify-center uppercase shrink-0">{{ substr($s->donor_name, 0, 1) }}</div>
                                            <span class="text-sm font-bold text-base-content">{{ $s->donor_name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-base-content/60">{{ $s->donor_email }}</td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center gap-1.5 text-sm text-base-content/60">
                                            <svg class="w-3.5 h-3.5 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                            {{ $s->donor_phone ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.6rem] font-bold bg-emerald-100 text-emerald-700">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            {{ $s->fosterChild?->name ?? 'Anak Dihapus' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[0.6rem] font-bold bg-amber-50 text-amber-700 border border-amber-200">{{ $s->package ?? '-' }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="font-black text-base-content">Rp {{ number_format($s->amount, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="font-mono text-[0.6rem] text-base-content/40 bg-base-100 px-1.5 py-0.5 rounded">{{ $s->order_id }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($pmt)
                                            <span class="inline-flex items-center gap-1 text-[0.6rem] font-bold px-2 py-0.5 rounded-full border {{ $pmClass }}">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                                {{ $pmt }}
                                            </span>
                                        @else
                                            <span class="text-xs text-base-content/30">-</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($s->starts_at && $s->expires_at)
                                            <div class="text-sm font-bold text-base-content whitespace-nowrap">{{ $s->starts_at->format('d M Y') }} – {{ $s->expires_at->format('d M Y') }}</div>
                                            <div class="text-xs mt-0.5">
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
                                    <td class="py-4 px-6 text-center">
                                        @php
                                            $sIcon = $statusKey === 'aktif' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : ($statusKey === 'pending' ? 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' : ($statusKey === 'kadaluarsa' ? 'M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z' : 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'));
                                            $sLabel = $statusKey === 'aktif' ? 'Aktif' : ($statusKey === 'pending' ? 'Menunggu' : ($statusKey === 'kadaluarsa' ? 'Kadaluarsa' : 'Gagal'));
                                            $sClass = $statusKey === 'aktif' ? 'text-emerald-700 bg-emerald-100 border-emerald-200' : ($statusKey === 'pending' ? 'text-amber-700 bg-amber-100 border-amber-200' : ($statusKey === 'kadaluarsa' ? 'text-slate-600 bg-slate-100 border-slate-200' : 'text-rose-700 bg-rose-100 border-rose-200'));
                                        @endphp
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $sClass }}">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $sIcon }}"/></svg>
                                            {{ $sLabel }}
                                        </span>
                                        @if($statusKey === 'gagal' && $s->rejection_reason)
                                            <div class="mt-1.5 text-[0.6rem] text-rose-600 bg-rose-50 rounded-lg px-2.5 py-1.5 border border-rose-200 leading-relaxed max-w-[200px]">
                                                <span class="font-bold">Alasan:</span> {{ $s->rejection_reason }}
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="py-16 text-center">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                        <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <p class="font-black text-base-content text-lg">Belum ada sponsorship</p>
                </div>
            @endif
        </div>

        <div class="flex justify-center">
            {{ $sponsorships->links() }}
        </div>
    </div>
</div>
</x-admin-layout>
