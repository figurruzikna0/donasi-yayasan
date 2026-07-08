<x-admin-layout>
    <div class="bg-base-200 min-h-screen">

        {{-- Page header --}}
        <div class="px-8 pt-8 pb-0">
            <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Data Anak &amp; Orang Tua Asuh</h1>
                            <p class="text-sm text-base-content/50">Kontak orang tua asuh per anak — buat keperluan notifikasi langsung.</p>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.foster-children.index') }}" class="btn btn-sm bg-primary/10 hover:bg-primary/20 text-primary border-0 font-bold rounded-lg">Kelola Data Anak Asuh</a>
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm bg-primary/10 hover:bg-primary/20 text-primary border-0 font-bold rounded-lg">Riwayat Transaksi</a>
                </div>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            {{-- Table Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex flex-wrap gap-3 items-center justify-between">
                    <div class="relative w-full max-w-[300px]">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-base-content/30">
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
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Anak Asuh</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Orang Tua Asuh</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Masa Aktif</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($children as $child)
                                @php
                                    $sponsorship = $child->activeSponsorship;
                                    $isExpiredPeriod = $sponsorship?->expires_at?->isPast();
                                    $remainingDays = $sponsorship?->expires_at ? now()->diffInDays($sponsorship->expires_at) : null;
                                @endphp
                                <tr class="data-row hover:bg-base-200/30 transition-colors"
                                    data-search="{{ strtolower($child->name . ' ' . ($sponsorship->donor_name ?? '')) }}"
                                    data-status="{{ $sponsorship ? 'disponsori' : 'belum' }}">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="w-9 h-9 rounded-full ring ring-base-300 ring-offset-1">
                                                    <img src="{{ $child->photo ? asset('storage/' . $child->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($child->name) . '&background=b3e093&color=5c8148&rounded=true&bold=true' }}" alt="{{ $child->name }}" class="object-cover">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold text-sm text-base-content">{{ $child->name }}</div>
                                                <div class="text-xs text-base-content/40">{{ $child->age }} Tahun</div>
                                                @if($child->status === 'Diasuh')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.6rem] font-bold bg-emerald-100 text-emerald-700 mt-1">Diasuh</span>
                                                @else
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.6rem] font-bold bg-base-200 text-base-content/50 mt-1">Tersedia</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($sponsorship)
                                            <div class="font-bold text-sm text-base-content">{{ $sponsorship->donor_name }}</div>
                                            <a href="mailto:{{ $sponsorship->donor_email }}" class="link link-hover text-primary text-xs">{{ $sponsorship->donor_email }}</a>
                                            @if($sponsorship->donor_phone)
                                                <div class="text-xs text-base-content/40">📱 {{ $sponsorship->donor_phone }}</div>
                                            @endif
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-amber-50 text-amber-700 border border-amber-200 mt-1">{{ $sponsorship->package ?? '-' }}</span>
                                            @if($sponsorship->payment_method)
                                                <div class="text-xs text-base-content/40 mt-1">via {{ $sponsorship->payment_method }}</div>
                                            @endif
                                        @else
                                            <span class="text-base-content/30 text-sm italic">Belum ada orang tua asuh</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($sponsorship && $sponsorship->starts_at && $sponsorship->expires_at)
                                            <div class="text-sm font-bold text-base-content whitespace-nowrap">{{ $sponsorship->starts_at->format('d M Y') }} – {{ $sponsorship->expires_at->format('d M Y') }}</div>
                                            <div class="text-xs mt-1">
                                                @if($isExpiredPeriod)
                                                    <span class="text-rose-600">Lewat {{ $remainingDays }} hari</span>
                                                @else
                                                    <span class="text-emerald-600">{{ $remainingDays }} hari lagi</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-base-content/30 text-sm">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="py-16 text-center">
                                            <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-base-content">Belum Ada Data Anak Asuh</p>
                                            <p class="text-sm text-base-content/50 mt-1">Tambahkan data anak asuh lewat menu "Kelola Data Anak Asuh".</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="noResultRow" class="hidden">
                                <td colspan="3">
                                    <div class="py-16 text-center">
                                        <p class="font-extrabold text-base-content">Tidak Ditemukan</p>
                                        <p class="text-sm text-base-content/50">Coba kata kunci pencarian yang berbeda.</p>
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
</x-admin-layout>
