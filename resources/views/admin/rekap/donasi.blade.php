<x-admin-layout>
<div class="bg-base-200 min-h-screen">
    <div class="px-8 pt-8 pb-0">
        <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
            <div>
                <div class="flex items-center gap-2.5 mb-2">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <div>
                        <h1 class="text-2xl font-black text-base-content">Data Seluruh Donasi</h1>
                        <p class="text-sm text-base-content/50">Rekap lengkap transaksi donasi kampanye.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8 pt-6 space-y-6">
        {{-- STAT CARDS: total dana terkumpul, jumlah transaksi, sukses, dan tertunda — dari controller rekap donasi --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 max-sm:grid-cols-1">
            <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Dana Terkumpul</div>
                    <div class="text-lg font-black text-base-content mt-0.5">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <div>
                    <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Transaksi</div>
                    <div class="text-2xl font-black text-base-content mt-0.5">{{ $totalCount }}</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Sukses</div>
                    <div class="text-2xl font-black text-base-content mt-0.5">{{ $successCount }}</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Tertunda</div>
                    <div class="text-2xl font-black text-base-content mt-0.5">{{ $pendingCount }}</div>
                </div>
            </div>
        </div>

        {{-- FILTER & EXPORT: filter tanggal/search, export CSV (admin.rekap.donasi.export) & PDF (admin.rekap.donasi.export-pdf) --}}
        <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
            <div class="px-6 py-4 border-b border-base-200 flex flex-wrap items-center justify-between gap-3">
                <form method="GET" class="flex flex-wrap items-center gap-2">
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="input input-bordered input-sm">
                    <span class="text-xs text-base-content/50">s/d</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="input input-bordered input-sm">
                    <input type="text" name="search" placeholder="Cari nama/email/order..." class="input input-bordered input-sm" value="{{ request('search') }}">
                    <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 btn-sm font-bold rounded-lg">Filter</button>
                    <a href="{{ route('admin.rekap.donasi') }}" class="btn btn-ghost btn-sm font-bold">Reset</a>
                </form>
                <div class="flex gap-2">
                    <a href="{{ route('admin.rekap.donasi.export') }}?{{ request()->getQueryString() }}" class="btn btn-sm bg-primary/10 hover:bg-primary/20 text-primary border-0 font-bold rounded-lg">Export CSV</a>
                    <a href="{{ route('admin.rekap.donasi.export-pdf') }}?{{ request()->getQueryString() }}" class="btn btn-sm bg-error/10 hover:bg-error/20 text-error border-0 font-bold rounded-lg">Export PDF</a>
                </div>
            </div>

            {{-- FILTER STATUS: filter donasi berdasarkan status (Semua/Sukses/Tertunda/Gagal) — via query param status --}}
            <div class="px-6 py-3 border-b border-base-200 bg-base-100/50 flex flex-wrap items-center gap-1.5">
                <span class="text-[11px] font-semibold text-base-content/50 mr-1">Status:</span>
                @php $curStatus = request('status'); @endphp
                <a href="{{ route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => ''])) }}" class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ !$curStatus ? 'bg-primary text-white shadow-sm' : 'bg-base-200 text-base-content/60 hover:bg-base-300' }}">Semua</a>
                <a href="{{ route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => 'success'])) }}" class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'success' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100' }}">Sukses</a>
                <a href="{{ route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => 'pending'])) }}" class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'pending' ? 'bg-amber-500 text-white shadow-sm' : 'bg-amber-50 text-amber-600 border border-amber-200 hover:bg-amber-100' }}">Tertunda</a>
                <a href="{{ route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => 'failed'])) }}" class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'failed' ? 'bg-red-500 text-white shadow-sm' : 'bg-red-50 text-red-600 border border-red-200 hover:bg-red-100' }}">Gagal</a>
            </div>

            {{-- TABEL DONASI: daftar transaksi donasi kampanye — data dari $donations, mendukung filter & pagination --}}
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-200/50">
                            <th class="w-[140px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Order ID</th>
                            <th class="w-[160px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Donatur</th>
                            <th class="w-[140px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Kampanye</th>
                            <th class="w-[120px] text-right text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nominal</th>
                            <th class="w-[120px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Metode</th>
                            <th class="w-[90px] text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                            <th class="w-[120px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200/60">
                        @forelse($donations as $d)
                            <tr class="hover:bg-base-200/30 transition-colors">
                                <td class="font-mono text-xs text-base-content/60">{{ $d->order_id ?? '-' }}</td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-primary/10 text-primary font-bold text-xs flex items-center justify-center uppercase">{{ substr($d->donor_name, 0, 1) }}</div>
                                        <span class="text-sm font-semibold text-base-content">{{ $d->donor_name }}</span>
                                    </div>
                                </td>
                                <td class="text-sm text-base-content/60">{{ $d->campaign?->title ?? '-' }}</td>
                                <td class="text-right font-bold text-primary">Rp {{ number_format($d->amount, 0, ',', '.') }}</td>
                                <td class="text-sm text-base-content/60">{{ $d->payment_method ?? '-' }}</td>
                                <td class="text-center">
                                    @if($d->status == 'success')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Sukses
                                        </span>
                                    @elseif($d->status == 'pending')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Tertunda
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Gagal
                                        </span>
                                    @endif
                                </td>
                                <td class="text-xs text-base-content/60 whitespace-nowrap">{{ $d->created_at ? $d->created_at->format('d/m/Y H:i') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="py-16 text-center">
                                        <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <p class="font-extrabold text-base-content">Belum ada data donasi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $donations->links() }}
    </div>
</div>
</x-admin-layout>
