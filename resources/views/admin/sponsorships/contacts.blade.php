<x-app-layout>
    <div class="bg-base-200">

        {{-- Page header --}}
        <div class="p-7 pb-0">
            <div class="flex items-end justify-between gap-3 mb-5 flex-wrap">
                <div>
                    <nav class="text-sm text-emerald-500 mb-1">
                        <a href="{{ route('admin.dashboard') }}" class="link link-hover text-emerald-600">Dashboard</a>
                        <span class="mx-1">/</span>
                        <span class="text-emerald-600">Orang Tua Asuh</span>
                    </nav>
                    <h1 class="text-2xl font-black text-emerald-700">Data Anak &amp; Orang Tua Asuh</h1>
                    <p class="text-sm text-emerald-500 mt-1">Kontak orang tua asuh per anak — buat keperluan notifikasi langsung, tanpa rincian transaksi.</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.foster-children.index') }}" class="btn btn-sm btn-outline">Kelola Data Anak Asuh</a>
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-outline">Riwayat Transaksi</a>
                </div>
            </div>
        </div>

        <div class="p-7 pt-0">

            {{-- Table Card --}}
            <div class="card bg-base-100 shadow-md border border-emerald-200">

                <div class="p-4 border-b border-emerald-100 bg-emerald-50 flex flex-wrap gap-3 items-center justify-between">
                    <div class="relative w-full max-w-[300px]">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-emerald-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" id="tableSearch" class="input input-bordered input-sm w-full pl-8" placeholder="Cari nama anak atau orang tua asuh…">
                    </div>
                    <div>
                        <select id="statusFilter" class="select select-bordered select-sm">
                            <option value="all">Semua</option>
                            <option value="disponsori">Sudah Disponsori</option>
                            <option value="belum">Belum Disponsori</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Anak Asuh</th>
                                <th>Orang Tua Asuh</th>
                                <th>Masa Aktif</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($children as $child)
                                @php
                                    $sponsorship = $child->activeSponsorship;
                                    $isExpiredPeriod = $sponsorship?->expires_at?->isPast();
                                    $remainingDays = $sponsorship?->expires_at ? now()->diffInDays($sponsorship->expires_at) : null;
                                @endphp
                                <tr class="data-row"
                                    data-search="{{ strtolower($child->name . ' ' . ($sponsorship->donor_name ?? '')) }}"
                                    data-status="{{ $sponsorship ? 'disponsori' : 'belum' }}">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img class="w-9 h-9 rounded-full border-2 border-emerald-200 object-cover flex-shrink-0"
                                                 src="{{ $child->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($child->name) . '&background=b3e093&color=5c8148&rounded=true&bold=true' }}"
                                                 alt="{{ $child->name }}">
                                            <div>
                                                <div class="font-extrabold text-emerald-700 text-sm">{{ $child->name }}</div>
                                                <div class="text-xs text-emerald-400">{{ $child->age }} Tahun</div>
                                                @if($child->status === 'Diasuh')
                                                    <span class="badge badge-success badge-sm mt-1">Diasuh</span>
                                                @else
                                                    <span class="badge badge-ghost badge-sm mt-1">Tersedia</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @if($sponsorship)
                                            <div class="font-extrabold text-emerald-700 text-sm">{{ $sponsorship->donor_name }}</div>
                                            <a href="mailto:{{ $sponsorship->donor_email }}" class="link link-hover text-emerald-600 text-xs">{{ $sponsorship->donor_email }}</a>
                                            @if($sponsorship->donor_phone)
                                                <div class="text-xs text-emerald-400">📱 {{ $sponsorship->donor_phone }}</div>
                                            @endif
                                            <span class="badge badge-warning badge-sm mt-1">{{ $sponsorship->package ?? '-' }}</span>
                                            @if($sponsorship->payment_method)
                                                <div class="text-xs text-emerald-400 mt-1">via {{ $sponsorship->payment_method }}</div>
                                            @endif
                                        @else
                                            <span class="text-emerald-400 text-sm italic">Belum ada orang tua asuh</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($sponsorship && $sponsorship->starts_at && $sponsorship->expires_at)
                                            <div class="text-sm font-bold text-emerald-700">{{ $sponsorship->starts_at->format('d M Y') }} – {{ $sponsorship->expires_at->format('d M Y') }}</div>
                                            <div class="text-xs mt-1">
                                                @if($isExpiredPeriod)
                                                    <span class="text-red-500">Lewat {{ $remainingDays }} hari</span>
                                                @else
                                                    <span class="text-emerald-500">{{ $remainingDays }} hari lagi</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-emerald-400 text-sm">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="py-16 text-center">
                                            <div class="w-14 h-14 bg-emerald-100 border border-emerald-200 rounded-xl flex items-center justify-center mx-auto mb-3">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-emerald-400"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-emerald-700">Belum Ada Data Anak Asuh</p>
                                            <p class="text-sm text-emerald-500">Tambahkan data anak asuh lewat menu "Kelola Data Anak Asuh".</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="noResultRow" class="hidden">
                                <td colspan="3">
                                    <div class="py-16 text-center">
                                        <p class="font-extrabold text-emerald-700">Tidak Ditemukan</p>
                                        <p class="text-sm text-emerald-500">Coba kata kunci pencarian yang berbeda.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput  = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const allRows      = Array.from(document.querySelectorAll('.data-row'));
            const noResultRow  = document.getElementById('noResultRow');

            function filter() {
                const q    = searchInput.value.toLowerCase().trim();
                const stat = statusFilter.value;
                let visibleCount = 0;

                allRows.forEach(row => {
                    const match = row.dataset.search.includes(q) && (stat === 'all' || row.dataset.status === stat);
                    row.classList.toggle('hidden', !match);
                    if (match) visibleCount++;
                });

                noResultRow.classList.toggle('hidden', visibleCount !== 0 || allRows.length === 0);
            }

            searchInput.addEventListener('input', filter);
            statusFilter.addEventListener('change', filter);
        });
    </script>
</x-app-layout>
