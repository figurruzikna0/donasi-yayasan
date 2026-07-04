<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">Rekap Data Donatur</h2>
    </x-slot>

    <div class="bg-base-200 p-8">
        <div class="max-w-7xl mx-auto">
            <nav class="text-sm text-emerald-500 mb-1">
                <a href="{{ route('admin.dashboard') }}" class="link link-hover text-emerald-600">Dashboard</a>
                <span class="mx-1">/</span>
                <span class="text-emerald-600">Rekap Donatur</span>
            </nav>
            <h1 class="text-2xl font-black text-emerald-700 mb-1">Data Seluruh Donatur</h1>
            <p class="text-sm text-emerald-500 mb-6">Rekap lengkap user donatur terdaftar beserta data registrasi.</p>

            <div class="stats shadow w-full mb-6">
                <div class="stat">
                    <div class="stat-figure text-2xl">👥</div>
                    <div class="stat-title">Total Donatur Terdaftar</div>
                    <div class="stat-value text-emerald-700">{{ $totalDonatur }}</div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">💰</div>
                    <div class="stat-title">Total Donasi Sukses</div>
                    <div class="stat-value text-emerald-700">Rp {{ number_format($totalDonasiAll, 0, ',', '.') }}</div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">🤝</div>
                    <div class="stat-title">Total Sponsorship Aktif</div>
                    <div class="stat-value text-emerald-700">{{ $totalSponsorshipAll }}</div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-0">
                    <div class="p-4 border-b border-emerald-100 flex flex-wrap items-center justify-between gap-3">
                        <form method="GET" class="flex flex-wrap items-center gap-2">
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="input input-bordered input-sm">
                            <span class="text-xs text-emerald-500">s/d</span>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="input input-bordered input-sm">
                            <input type="text" name="search" placeholder="Cari nama/email/HP/NIK..." class="input input-bordered input-sm"
                                   value="{{ request('search') }}">
                            <button type="submit" class="btn btn-success btn-sm text-white">Cari</button>
                            <a href="{{ route('admin.rekap.donatur') }}" class="btn btn-ghost btn-sm">Reset</a>
                        </form>
                        <a href="{{ route('admin.rekap.donatur.export') }}?{{ request()->getQueryString() }}" class="btn btn-outline btn-sm btn-info">
                            Export CSV
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username (Email)</th>
                                    <th>Password</th>
                                    <th>No. HP</th>
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>Aktivitas</th>
                                    <th>Verifikasi</th>
                                    <th>Terdaftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donaturs as $u)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="avatar">
                                                <div class="w-7 rounded-full">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($u->name) }}&background=b3e093&color=5c8148" alt="">
                                                </div>
                                            </div>
                                            <span class="text-sm font-semibold">{{ $u->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-sm font-mono">{{ $u->email }}</td>
                                    <td>
                                        <span class="badge badge-success badge-sm">Tersimpan</span>
                                    </td>
                                    <td class="text-sm">{{ $u->phone ?? '-' }}</td>
                                    <td class="text-sm font-mono">{{ $u->nik ?? '-' }}</td>
                                    <td class="text-sm max-w-[200px] truncate" title="{{ $u->address }}">{{ $u->address ?? '-' }}</td>
                                    <td>
                                        <div class="text-xs">
                                            <span class="font-semibold">{{ $u->donations_count }}</span> donasi
                                            <br><span class="font-semibold">{{ $u->sponsorships_count }}</span> sponsorship
                                        </div>
                                    </td>
                                    <td>
                                        @if($u->email_verified_at)
                                            <span class="badge badge-success badge-sm">Terverifikasi</span>
                                        @else
                                            <span class="badge badge-ghost badge-sm">Belum</span>
                                        @endif
                                    </td>
                                    <td class="text-xs">{{ $u->created_at->format('d/m/Y') }}<br>{{ $u->created_at->format('H:i') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="9" class="text-center py-10 text-base-content/60">Belum ada donatur terdaftar.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($donaturs->hasPages())
                        <div class="p-4 border-t border-emerald-100">{{ $donaturs->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
