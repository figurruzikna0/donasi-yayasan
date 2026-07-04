<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">Rekap Data Donasi</h2>
    </x-slot>

    <div class="bg-base-200 p-8">
        <div class="max-w-7xl mx-auto">
            <nav class="text-sm text-emerald-500 mb-1">
                <a href="{{ route('admin.dashboard') }}" class="link link-hover text-emerald-600">Dashboard</a>
                <span class="mx-1">/</span>
                <span class="text-emerald-600">Rekap Donasi</span>
            </nav>
            <h1 class="text-2xl font-black text-emerald-700 mb-1">Data Seluruh Donasi</h1>
            <p class="text-sm text-emerald-500 mb-6">Rekap lengkap transaksi donasi kampanye.</p>

            <div class="stats shadow w-full mb-6">
                <div class="stat">
                    <div class="stat-figure text-2xl">💰</div>
                    <div class="stat-title">Total Dana Terkumpul</div>
                    <div class="stat-value text-emerald-700">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">📋</div>
                    <div class="stat-title">Total Transaksi</div>
                    <div class="stat-value text-emerald-700">{{ $totalCount }}</div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">✅</div>
                    <div class="stat-title">Sukses</div>
                    <div class="stat-value text-emerald-700">{{ $successCount }}</div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">⏳</div>
                    <div class="stat-title">Pending</div>
                    <div class="stat-value text-emerald-700">{{ $pendingCount }}</div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-0">
                    <div class="p-4 border-b border-emerald-100 flex flex-wrap items-center justify-between gap-3">
                        <form method="GET" class="flex flex-wrap items-center gap-2">
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="input input-bordered input-sm">
                            <span class="text-xs text-emerald-500">s/d</span>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="input input-bordered input-sm">
                            <input type="text" name="search" placeholder="Cari nama/email/order..." class="input input-bordered input-sm"
                                   value="{{ request('search') }}">
                            <select name="status" class="select select-bordered select-sm">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Sukses</option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                            </select>
                            <button type="submit" class="btn btn-success btn-sm text-white">Filter</button>
                            <a href="{{ route('admin.rekap.donasi') }}" class="btn btn-ghost btn-sm">Reset</a>
                        </form>
                        <a href="{{ route('admin.rekap.donasi.export') }}?{{ request()->getQueryString() }}" class="btn btn-outline btn-sm btn-info">
                            Export CSV
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Donatur</th>
                                    <th>Email</th>
                                    <th>Kampanye</th>
                                    <th>Nominal</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donations as $d)
                                <tr>
                                    <td class="font-mono text-xs">{{ $d->order_id ?? '-' }}</td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="avatar">
                                                <div class="w-7 rounded-full">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($d->donor_name) }}&background=b3e093&color=5c8148" alt="">
                                                </div>
                                            </div>
                                            <span class="text-sm font-semibold">{{ $d->donor_name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-sm">{{ $d->donor_email }}</td>
                                    <td class="text-sm">{{ $d->campaign?->title ?? '-' }}</td>
                                    <td class="font-bold text-emerald-700">Rp {{ number_format($d->amount, 0, ',', '.') }}</td>
                                    <td class="text-sm">{{ $d->payment_method ?? '-' }}</td>
                                    <td>
                                        @php $c = $d->status == 'success' ? 'badge-success' : ($d->status == 'pending' ? 'badge-warning' : 'badge-error') @endphp
                                        <span class="badge {{ $c }} badge-sm">{{ $d->status }}</span>
                                    </td>
                                    <td class="text-xs">{{ $d->created_at ? $d->created_at->format('d/m/Y H:i') : '-' }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="8" class="text-center py-10 text-base-content/60">Belum ada data donasi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($donations->hasPages())
                        <div class="p-4 border-t border-emerald-100">{{ $donations->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
