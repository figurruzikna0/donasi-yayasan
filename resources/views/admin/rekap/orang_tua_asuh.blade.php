<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">Rekap Data Orang Tua Asuh</h2>
    </x-slot>

    <div class="bg-base-200 p-8">
        <div class="max-w-7xl mx-auto">
            <nav class="text-sm text-emerald-500 mb-1">
                <a href="{{ route('admin.dashboard') }}" class="link link-hover text-emerald-600">Dashboard</a>
                <span class="mx-1">/</span>
                <span class="text-emerald-600">Rekap Orang Tua Asuh</span>
            </nav>
            <h1 class="text-2xl font-black text-emerald-700 mb-1">Data Seluruh Sponsorship</h1>
            <p class="text-sm text-emerald-500 mb-6">Rekap lengkap data orang tua asuh (sponsorship).</p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">🤝</div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-500">Total Sponsorship</p>
                        <p class="text-2xl font-black text-emerald-700">{{ $totalCount }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">✅</div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-500">Aktif</p>
                        <p class="text-2xl font-black text-emerald-700">{{ $activeCount }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">💰</div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-500">Total Dana</p>
                        <p class="text-2xl font-black text-emerald-700">Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="p-4 border-b border-emerald-100 bg-emerald-50">
                    <form method="GET" class="flex flex-wrap items-end gap-x-3 gap-y-2">
                        <div>
                            <label class="text-[11px] font-semibold text-emerald-600 block mb-0.5">Dari Tanggal</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="input input-bordered input-sm w-40">
                        </div>
                        <div>
                            <label class="text-[11px] font-semibold text-emerald-600 block mb-0.5">Sampai</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="input input-bordered input-sm w-40">
                        </div>
                        <div>
                            <label class="text-[11px] font-semibold text-emerald-600 block mb-0.5">Cari</label>
                            <input type="text" name="search" placeholder="Cari donor/email/order/anak..." class="input input-bordered input-sm w-40"
                                   value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn btn-success text-white btn-sm min-w-[4rem]">Filter</button>
                        <a href="{{ route('admin.rekap.orang-tua-asuh') }}" class="btn btn-ghost btn-sm">Reset</a>
                        <a href="{{ route('admin.rekap.orang-tua-asuh.export') }}?{{ request()->getQueryString() }}" class="btn btn-outline btn-sm btn-info">Export CSV</a>
                    </form>
                </div>

                <div class="px-4 py-3 border-b border-emerald-100 bg-white flex flex-wrap items-center gap-1.5">
                    <span class="text-[11px] font-semibold text-emerald-600 mr-1">Status:</span>
                    @php $curStatus = request('status'); @endphp
                    <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => ''])) }}"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ !$curStatus ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100' }}">Semua</a>
                    <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'aktif'])) }}"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'aktif' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100' }}">Aktif</a>
                    <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'pending'])) }}"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'pending' ? 'bg-amber-500 text-white shadow-sm' : 'bg-amber-50 text-amber-600 border border-amber-200 hover:bg-amber-100' }}">Menunggu</a>
                    <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'kadaluarsa'])) }}"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'kadaluarsa' ? 'bg-gray-500 text-white shadow-sm' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100' }}">Kadaluarsa</a>
                    <a href="{{ route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'gagal'])) }}"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all {{ $curStatus === 'gagal' ? 'bg-red-500 text-white shadow-sm' : 'bg-red-50 text-red-600 border border-red-200 hover:bg-red-100' }}">Gagal</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th class="text-emerald-700">Penyandang Dana &amp; Anak Asuh</th>
                                <th class="text-emerald-700">Paket &amp; Nominal</th>
                                <th class="text-emerald-700">Periode</th>
                                <th class="text-center text-emerald-700">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sponsorships as $s)
                                @php
                                    $isExpiredPeriod = $s->expires_at && $s->expires_at->isPast();
                                    $remainingDays   = $s->expires_at ? (int) now()->diffInDays($s->expires_at) : null;

                                    $statusKey = match(true) {
                                        $s->status === 'pending'                => 'pending',
                                        $s->status === 'success' && !$isExpiredPeriod => 'aktif',
                                        $s->status === 'success' && $isExpiredPeriod  => 'kadaluarsa',
                                        $s->status === 'expired'                => 'kadaluarsa',
                                        default                                 => 'gagal',
                                    };
                                @endphp
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img class="w-9 h-9 rounded-full border-2 border-emerald-200 object-cover flex-shrink-0"
                                                 src="https://ui-avatars.com/api/?name={{ urlencode($s->donor_name) }}&background=b3e093&color=5c8148&rounded=true&bold=true"
                                                 alt="{{ $s->donor_name }}">
                                            <div>
                                                <div class="font-extrabold text-emerald-700 text-sm">{{ $s->donor_name }}</div>
                                                <div class="text-xs text-emerald-400">{{ $s->donor_email }}</div>
                                                <div class="text-xs text-emerald-400">📱 {{ $s->donor_phone ?? '-' }}</div>
                                                <span class="badge badge-ghost badge-sm mt-1">{{ $s->fosterChild?->name ?? 'Anak Dihapus' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning badge-sm">{{ $s->package ?? '-' }}</span>
                                        <div class="font-black text-emerald-700 mt-1">Rp {{ number_format($s->amount, 0, ',', '.') }}</div>
                                        <div class="text-xs text-emerald-400 font-mono">{{ $s->order_id }}</div>
                                        @if($s->payment_method)
                                            <div class="text-xs text-emerald-400">via {{ $s->payment_method }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($s->starts_at && $s->expires_at)
                                            <div class="text-sm font-bold text-emerald-700 whitespace-nowrap">{{ $s->starts_at->format('d M Y') }} – {{ $s->expires_at->format('d M Y') }}</div>
                                            <div class="text-xs mt-1">
                                                @if($statusKey === 'aktif')
                                                    <span class="text-emerald-500">{{ $remainingDays }} hari lagi</span>
                                                @elseif($statusKey === 'kadaluarsa')
                                                    <span class="text-red-500">Lewat {{ abs($remainingDays) }} hari</span>
                                                @endif
                                            </div>
                                        @else
                                            <div class="text-sm font-bold text-emerald-700">-</div>
                                            <div class="text-xs text-emerald-400">Belum dibayar</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($statusKey === 'aktif')
                                            <span class="badge badge-success">Aktif</span>
                                        @elseif($statusKey === 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($statusKey === 'kadaluarsa')
                                            <span class="badge badge-ghost">Kadaluarsa</span>
                                        @else
                                            <span class="badge badge-error">Gagal</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="py-16 text-center">
                                            <div class="w-14 h-14 bg-emerald-100 border border-emerald-200 rounded-xl flex items-center justify-center mx-auto mb-3">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-emerald-400"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-emerald-700">Belum Ada Sponsorship</p>
                                            <p class="text-sm text-emerald-500">Sponsorship anak asuh yang masuk akan tampil di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($sponsorships->hasPages())
                    <div class="p-4 border-t border-emerald-100">{{ $sponsorships->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>