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
                    <h1 class="text-2xl font-black text-emerald-700">Sponsorship Orang Tua Asuh</h1>
                    <p class="text-sm text-emerald-500 mt-1">Pantau status sponsorship anak asuh, masa aktif, dan jatuh tempo perpanjangan.</p>
                </div>
            </div>
        </div>

        <div class="p-7 pt-0">

            @if(session('success'))
                <div class="alert alert-success mb-5">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error mb-5">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Table Card --}}
            <div class="card bg-base-100 shadow-md border border-emerald-200">

                <div class="p-4 border-b border-emerald-100 bg-emerald-50 flex flex-wrap gap-3 items-center justify-between">
                    <div class="relative w-full max-w-[300px]">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-emerald-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" id="tableSearch" class="input input-bordered input-sm w-full pl-8" placeholder="Cari nama, anak asuh, order ID…">
                    </div>
                    <div>
                        <select id="statusFilter" class="select select-bordered select-sm">
                            <option value="all">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="pending">Menunggu Bayar</option>
                            <option value="kadaluarsa">Kadaluarsa</option>
                            <option value="gagal">Gagal</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Penyandang Dana &amp; Anak Asuh</th>
                                <th>Paket &amp; Nominal</th>
                                <th>Periode</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
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
                                <tr class="data-row"
                                    data-search="{{ strtolower($sponsorship->donor_name . ' ' . ($sponsorship->fosterChild->name ?? '') . ' ' . $sponsorship->order_id) }}"
                                    data-status="{{ $statusKey }}">

                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img class="w-9 h-9 rounded-full border-2 border-emerald-200 object-cover flex-shrink-0"
                                                 src="https://ui-avatars.com/api/?name={{ urlencode($sponsorship->donor_name) }}&background=b3e093&color=5c8148&rounded=true&bold=true"
                                                 alt="{{ $sponsorship->donor_name }}">
                                            <div>
                                                <div class="font-extrabold text-emerald-700 text-sm">{{ $sponsorship->donor_name }}</div>
                                                <div class="text-xs text-emerald-400">{{ $sponsorship->donor_email }}</div>
                                                <div class="text-xs text-emerald-400">📱 {{ $sponsorship->donor_phone ?? '-' }}</div>
                                                <span class="badge badge-ghost badge-sm mt-1">{{ $sponsorship->fosterChild->name ?? 'Anak Dihapus' }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge badge-warning badge-sm">{{ $sponsorship->package ?? '-' }}</span>
                                        <div class="font-black text-emerald-700 mt-1">Rp {{ number_format($sponsorship->amount, 0, ',', '.') }}</div>
                                        <div class="text-xs text-emerald-400 font-mono">{{ $sponsorship->order_id }}</div>
                                        @if($sponsorship->payment_method)
                                            <div class="text-xs text-emerald-400">via {{ $sponsorship->payment_method }}</div>
                                        @endif
                                    </td>

                                    <td>
                                        @if($sponsorship->starts_at && $sponsorship->expires_at)
                                            <div class="text-sm font-bold text-emerald-700">{{ $sponsorship->starts_at->format('d M Y') }} – {{ $sponsorship->expires_at->format('d M Y') }}</div>
                                            <div class="text-xs mt-1">
                                                @if($statusKey === 'aktif')
                                                    <span class="text-emerald-500">{{ $remainingDays }} hari lagi</span>
                                                @elseif($statusKey === 'kadaluarsa')
                                                    <span class="text-red-500">Lewat {{ $remainingDays }} hari</span>
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

                                    <td class="text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            @if($sponsorship->status === 'pending')
                                                <form action="{{ route('admin.sponsorships.approve', $sponsorship->order_id) }}" method="POST"
                                                      onsubmit="return confirm('Setujui sponsorship ini secara manual?');">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success" title="Setujui">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.sponsorships.destroy', $sponsorship->order_id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data sponsorship ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-error" title="Hapus">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="emptyInitRow">
                                    <td colspan="5">
                                        <div class="py-16 text-center">
                                            <div class="w-14 h-14 bg-emerald-100 border border-emerald-200 rounded-xl flex items-center justify-center mx-auto mb-3">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-emerald-400"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-emerald-700">Belum Ada Sponsorship</p>
                                            <p class="text-sm text-emerald-500">Sponsorship anak asuh yang masuk lewat Midtrans akan tampil di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse

                            <tr id="noResultRow" class="hidden">
                                <td colspan="5">
                                    <div class="py-16 text-center">
                                        <p class="font-extrabold text-emerald-700">Tidak Ditemukan</p>
                                        <p class="text-sm text-emerald-500">Coba kata kunci pencarian yang berbeda.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-emerald-100 bg-emerald-50 flex flex-wrap items-center justify-between gap-3">
                    <div class="text-sm text-emerald-500" id="paginationInfo">Menampilkan <strong>0</strong> hasil</div>
                    <div class="flex items-center gap-2">
                        <button id="prevBtn" class="btn btn-sm btn-outline" disabled>← Prev</button>
                        <div id="pageNumbers" class="flex items-center gap-1"></div>
                        <button id="nextBtn" class="btn btn-sm btn-outline" disabled>Next →</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rowsPerPage = 5;
            let currentPage = 1;

            const searchInput  = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const allRows      = Array.from(document.querySelectorAll('.data-row'));
            const noResultRow  = document.getElementById('noResultRow');
            const prevBtn      = document.getElementById('prevBtn');
            const nextBtn      = document.getElementById('nextBtn');
            const pageNums     = document.getElementById('pageNumbers');
            const pageInfo     = document.getElementById('paginationInfo');

            let filteredRows = [...allRows];

            function render() {
                const total = filteredRows.length;

                if (total === 0) {
                    noResultRow.classList.remove('hidden');
                    allRows.forEach(r => r.classList.add('hidden'));
                    pageInfo.innerHTML = "Menampilkan <strong>0</strong> hasil";
                    prevBtn.disabled = nextBtn.disabled = true;
                    pageNums.innerHTML = '';
                    return;
                }

                noResultRow.classList.add('hidden');
                const totalPages = Math.ceil(total / rowsPerPage);
                currentPage = Math.min(Math.max(currentPage, 1), totalPages);
                const start = (currentPage - 1) * rowsPerPage;
                const end   = Math.min(start + rowsPerPage, total);

                allRows.forEach(r => r.classList.add('hidden'));
                for (let i = start; i < end; i++) filteredRows[i].classList.remove('hidden');

                pageInfo.innerHTML = `Menampilkan <strong>${start + 1}–${end}</strong> dari <strong>${total}</strong> sponsorship`;
                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages;

                pageNums.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const b = document.createElement('button');
                    b.textContent = i;
                    b.className = 'btn btn-sm' + (i === currentPage ? ' btn-primary' : ' btn-ghost');
                    b.addEventListener('click', () => { currentPage = i; render(); });
                    pageNums.appendChild(b);
                }
            }

            function filter() {
                const q    = searchInput.value.toLowerCase().trim();
                const stat = statusFilter.value;

                filteredRows = allRows.filter(row =>
                    row.dataset.search.includes(q) &&
                    (stat === 'all' || row.dataset.status === stat)
                );

                currentPage = 1;
                render();
            }

            searchInput.addEventListener('input', filter);
            statusFilter.addEventListener('change', filter);
            prevBtn.addEventListener('click', () => { currentPage--; render(); });
            nextBtn.addEventListener('click', () => { currentPage++; render(); });

            render();
        });
    </script>
</x-app-layout>
