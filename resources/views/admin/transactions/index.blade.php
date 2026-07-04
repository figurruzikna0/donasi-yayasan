<x-app-layout>
    <div class="bg-base-200">

        {{-- Page header --}}
        <div class="p-7 pb-0">
            <div class="flex items-end justify-between gap-3 mb-5 flex-wrap">
                <div>
                    <nav class="text-sm text-emerald-500 mb-1">
                        <a href="{{ route('admin.dashboard') }}" class="link link-hover text-emerald-600">Dashboard</a>
                        <span class="mx-1">/</span>
                        <span class="text-emerald-600">Manajemen Donasi</span>
                    </nav>
                    <h1 class="text-2xl font-black text-emerald-700">Manajemen Donasi</h1>
                    <p class="text-sm text-emerald-500 mt-1">Kelola semua transaksi donasi kampanye & sponsorship orang tua asuh.</p>
                </div>
            </div>
        </div>

        <div class="p-7 pt-0">

            {{-- Toast alerts --}}
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

            {{-- ══ TAB SWITCHER ══ --}}
            <div class="tabs tabs-box bg-base-100 border border-emerald-200 mb-5 w-fit">
                <button class="tab tab-active font-bold text-emerald-700" id="tab-donasi" onclick="switchTab('donasi')">
                    Donasi Kampanye
                    <span class="badge badge-sm ml-1">{{ $donations->count() }}</span>
                    @if($donations->where('status','pending')->count() > 0)
                        <span class="badge badge-warning badge-sm ml-1">{{ $donations->where('status','pending')->count() }} pending</span>
                    @endif
                </button>
                <button class="tab font-bold text-emerald-600" id="tab-sponsor" onclick="switchTab('sponsor')">
                    Orang Tua Asuh
                    <span class="badge badge-sm ml-1">{{ $sponsorships->count() }}</span>
                    @if($sponsorships->where('status','pending')->count() > 0)
                        <span class="badge badge-warning badge-sm ml-1">{{ $sponsorships->where('status','pending')->count() }} pending</span>
                    @endif
                </button>
            </div>

            {{-- ══════════════════════════════
                 TAB 1: DONASI KAMPANYE
            ══════════════════════════════ --}}
            <div id="panel-donasi">
                <div class="card bg-base-100 shadow-md border border-emerald-200">
                    <div class="p-4 border-b border-emerald-100 bg-emerald-50 flex flex-wrap gap-3 items-center justify-between">
                        <div class="relative w-full max-w-[300px]">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-emerald-400">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" id="searchDonasi" class="input input-bordered input-sm w-full pl-8" placeholder="Cari nama, email, order ID…">
                        </div>
                        <div>
                            <select id="statusDonasi" class="select select-bordered select-sm">
                                <option value="all">Semua Status</option>
                                <option value="success">Sukses</option>
                                <option value="pending">Tertunda</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Donatur &amp; Kampanye</th>
                                    <th>Nominal</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bodyDonasi">
                                @forelse($donations as $item)
                                    @php $sk = match($item->status) { 'success'=>'success','pending'=>'pending',default=>'gagal' }; @endphp
                                    <tr class="data-row-donasi"
                                        data-search="{{ strtolower($item->donor_name.' '.$item->donor_email.' '.$item->order_id) }}"
                                        data-status="{{ $sk }}"
                                        data-date="{{ $item->created_at ? $item->created_at->format('Y-m-d') : '' }}">
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <img class="w-9 h-9 rounded-full border-2 border-emerald-200 object-cover flex-shrink-0"
                                                     src="https://ui-avatars.com/api/?name={{ urlencode($item->donor_name) }}&background=b3e093&color=5c8148&rounded=true&bold=true" alt="">
                                                <div>
                                                    <div class="font-extrabold text-emerald-700 text-sm">{{ $item->donor_name }}</div>
                                                    <div class="text-xs text-emerald-400">{{ $item->donor_email }}</div>
                                                    <span class="badge badge-ghost badge-sm mt-1">{{ $item->target }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-black text-emerald-700">Rp {{ number_format($item->amount, 0, ',', '.') }}</div>
                                            <div class="text-xs text-emerald-400 font-mono">{{ $item->order_id }}</div>
                                            @if($item->payment_method)
                                                <div class="text-xs text-emerald-400">via {{ $item->payment_method }}</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->status=='success') <span class="badge badge-success">Sukses</span>
                                            @elseif($item->status=='pending') <span class="badge badge-warning">Tertunda</span>
                                            @else <span class="badge badge-error">Gagal</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-emerald-700">{{ $item->created_at?->format('d M Y') ?? '-' }}</div>
                                            <div class="text-xs text-emerald-400">{{ $item->created_at?->format('H:i') }} WIB</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                @if($item->status==='pending')
                                                    <form action="{{ route('admin.transactions.approve', $item->order_id) }}" method="POST"
                                                          x-data="{ open: false }" @submit.prevent="open = true">
                                                        @csrf @method('PATCH')
                                                        <button type="button" @click="open = true" class="btn btn-sm btn-success" title="Setujui">
                                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/></svg>
                                                        </button>
                                                        <dialog class="modal" :class="{ 'modal-open': open }">
                                                            <div class="modal-box"><h3 class="font-bold text-lg">Konfirmasi</h3><p class="py-4">Setujui donasi ini?</p>
                                                                <div class="modal-action">
                                                                    <button type="button" @click="open = false" class="btn btn-ghost">Batal</button>
                                                                    <button @click="open = false; $el.closest('form').submit()" class="btn btn-success">Setujui</button>
                                                                </div>
                                                            </div>
                                                        </dialog>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.transactions.destroy', $item->order_id) }}" method="POST"
                                                      x-data="{ open: false }" @submit.prevent="open = true">
                                                    @csrf @method('DELETE')
                                                    <button type="button" @click="open = true" class="btn btn-sm btn-error" title="Hapus">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                    <dialog class="modal" :class="{ 'modal-open': open }">
                                                        <div class="modal-box"><h3 class="font-bold text-lg">Konfirmasi Hapus</h3><p class="py-4">Hapus transaksi ini?</p>
                                                            <div class="modal-action">
                                                                <button type="button" @click="open = false" class="btn btn-ghost">Batal</button>
                                                                <button @click="open = false; $el.closest('form').submit()" class="btn btn-error">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </dialog>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5"><div class="py-16 text-center"><div class="w-14 h-14 bg-emerald-100 border border-emerald-200 rounded-xl flex items-center justify-center mx-auto mb-3"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-emerald-400"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg></div><p class="font-extrabold text-emerald-700">Belum Ada Donasi</p><p class="text-sm text-emerald-500">Donasi kampanye yang masuk akan tampil di sini.</p></div></td></tr>
                                @endforelse
                                <tr id="noResultDonasi" class="hidden"><td colspan="5"><div class="py-16 text-center"><p class="font-extrabold text-emerald-700">Tidak Ditemukan</p><p class="text-sm text-emerald-500">Coba kata kunci berbeda.</p></div></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-emerald-100 bg-emerald-50 flex flex-wrap items-center justify-between gap-3">
                        <div class="text-sm text-emerald-500" id="infoDonasi">—</div>
                        <div class="flex items-center gap-2">
                            <button id="prevDonasi" class="btn btn-sm btn-outline" disabled>← Prev</button>
                            <div id="pagesDonasi" class="flex items-center gap-1"></div>
                            <button id="nextDonasi" class="btn btn-sm btn-outline" disabled>Next →</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════
                 TAB 2: SPONSORSHIP OTA
            ══════════════════════════════ --}}
            <div id="panel-sponsor" class="hidden">
                <div class="card bg-base-100 shadow-md border border-emerald-200">
                    <div class="p-4 border-b border-emerald-100 bg-emerald-50 flex flex-wrap gap-3 items-center justify-between">
                        <div class="relative w-full max-w-[300px]">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-emerald-400">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" id="searchSponsor" class="input input-bordered input-sm w-full pl-8" placeholder="Cari nama, email, order ID…">
                        </div>
                        <div>
                            <select id="statusSponsor" class="select select-bordered select-sm">
                                <option value="all">Semua Status</option>
                                <option value="success">Sukses</option>
                                <option value="pending">Tertunda</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Donatur &amp; Anak Asuh</th>
                                    <th>Paket</th>
                                    <th>Nominal</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bodySponsor">
                                @forelse($sponsorships as $item)
                                    @php $sk = match($item->status) { 'success'=>'success','pending'=>'pending',default=>'gagal' }; @endphp
                                    <tr class="data-row-sponsor"
                                        data-search="{{ strtolower($item->donor_name.' '.$item->donor_email.' '.$item->order_id.' '.$item->target) }}"
                                        data-status="{{ $sk }}"
                                        data-date="{{ $item->created_at ? $item->created_at->format('Y-m-d') : '' }}">
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <img class="w-9 h-9 rounded-full border-2 border-emerald-200 object-cover flex-shrink-0"
                                                     src="https://ui-avatars.com/api/?name={{ urlencode($item->donor_name) }}&background=ede9fe&color=6d28d9&rounded=true&bold=true" alt="">
                                                <div>
                                                    <div class="font-extrabold text-emerald-700 text-sm">{{ $item->donor_name }}</div>
                                                    <div class="text-xs text-emerald-400">{{ $item->donor_email }}</div>
                                                    @isset($item->donor_phone)
                                                        <div class="text-xs text-emerald-400">📱 {{ $item->donor_phone }}</div>
                                                    @endisset
                                                    <span class="badge badge-ghost badge-sm mt-1">Anak: {{ $item->target }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning badge-sm">{{ $item->package ?? '-' }}</span>
                                            @if($item->payment_method)
                                                <div class="text-xs text-emerald-400 mt-1">via {{ $item->payment_method }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="font-black text-emerald-700">Rp {{ number_format($item->amount, 0, ',', '.') }}</div>
                                            <div class="text-xs text-emerald-400 font-mono">{{ $item->order_id }}</div>
                                        </td>
                                        <td class="text-center">
                                            @if($item->status=='success') <span class="badge badge-success">Sukses</span>
                                            @elseif($item->status=='pending') <span class="badge badge-warning">Tertunda</span>
                                            @else <span class="badge badge-error">Gagal</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-emerald-700">{{ $item->created_at?->format('d M Y') ?? '-' }}</div>
                                            <div class="text-xs text-emerald-400">{{ $item->created_at?->format('H:i') }} WIB</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                @if($item->status==='pending')
                                                    <form action="{{ route('admin.transactions.approve', $item->order_id) }}" method="POST"
                                                          x-data="{ open: false }" @submit.prevent="open = true">
                                                        @csrf @method('PATCH')
                                                        <button type="button" @click="open = true" class="btn btn-sm btn-success" title="Setujui">
                                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/></svg>
                                                        </button>
                                                        <dialog class="modal" :class="{ 'modal-open': open }">
                                                            <div class="modal-box"><h3 class="font-bold text-lg">Konfirmasi</h3><p class="py-4">Setujui sponsorship ini?</p>
                                                                <div class="modal-action">
                                                                    <button type="button" @click="open = false" class="btn btn-ghost">Batal</button>
                                                                    <button @click="open = false; $el.closest('form').submit()" class="btn btn-success">Setujui</button>
                                                                </div>
                                                            </div>
                                                        </dialog>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.transactions.destroy', $item->order_id) }}" method="POST"
                                                      x-data="{ open: false }" @submit.prevent="open = true">
                                                    @csrf @method('DELETE')
                                                    <button type="button" @click="open = true" class="btn btn-sm btn-error" title="Hapus">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                    <dialog class="modal" :class="{ 'modal-open': open }">
                                                        <div class="modal-box"><h3 class="font-bold text-lg">Konfirmasi Hapus</h3><p class="py-4">Hapus sponsorship ini?</p>
                                                            <div class="modal-action">
                                                                <button type="button" @click="open = false" class="btn btn-ghost">Batal</button>
                                                                <button @click="open = false; $el.closest('form').submit()" class="btn btn-error">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </dialog>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6"><div class="py-16 text-center"><div class="w-14 h-14 bg-emerald-100 border border-emerald-200 rounded-xl flex items-center justify-center mx-auto mb-3"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-emerald-400"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div><p class="font-extrabold text-emerald-700">Belum Ada Sponsorship</p><p class="text-sm text-emerald-500">Data orang tua asuh akan tampil di sini.</p></div></td></tr>
                                @endforelse
                                <tr id="noResultSponsor" class="hidden"><td colspan="6"><div class="py-16 text-center"><p class="font-extrabold text-emerald-700">Tidak Ditemukan</p><p class="text-sm text-emerald-500">Coba kata kunci berbeda.</p></div></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-emerald-100 bg-emerald-50 flex flex-wrap items-center justify-between gap-3">
                        <div class="text-sm text-emerald-500" id="infoSponsor">—</div>
                        <div class="flex items-center gap-2">
                            <button id="prevSponsor" class="btn btn-sm btn-outline" disabled>← Prev</button>
                            <div id="pagesSponsor" class="flex items-center gap-1"></div>
                            <button id="nextSponsor" class="btn btn-sm btn-outline" disabled>Next →</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
    function switchTab(tab) {
        const tabs = ['donasi', 'sponsor'];
        tabs.forEach(t => {
            document.getElementById('tab-' + t).classList.toggle('tab-active', t === tab);
            document.getElementById('panel-' + t).classList.toggle('hidden', t !== tab);
        });
    }

    function makePaginator(opts) {
        const { rowSelector, searchId, statusId, noResultId, infoId, prevId, nextId, pagesId } = opts;
        const PER_PAGE = 8;
        let currentPage = 1;
        let filtered = [];

        const allRows   = Array.from(document.querySelectorAll(rowSelector));
        const noResult  = document.getElementById(noResultId);
        const info      = document.getElementById(infoId);
        const prevBtn   = document.getElementById(prevId);
        const nextBtn   = document.getElementById(nextId);
        const pagesWrap = document.getElementById(pagesId);

        function render() {
            const total = filtered.length;
            allRows.forEach(r => r.classList.add('hidden'));

            if (total === 0) {
                noResult.classList.remove('hidden');
                info.innerHTML = 'Menampilkan <strong>0</strong> hasil';
                prevBtn.disabled = nextBtn.disabled = true;
                pagesWrap.innerHTML = '';
                return;
            }

            noResult.classList.add('hidden');
            const totalPages = Math.ceil(total / PER_PAGE);
            currentPage = Math.min(Math.max(currentPage, 1), totalPages);
            const start = (currentPage - 1) * PER_PAGE;
            const end   = Math.min(start + PER_PAGE, total);

            for (let i = start; i < end; i++) filtered[i].classList.remove('hidden');
            info.innerHTML = `Menampilkan <strong>${start+1}–${end}</strong> dari <strong>${total}</strong>`;
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages;

            pagesWrap.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                const b = document.createElement('button');
                b.textContent = i;
                b.className = 'btn btn-sm' + (i === currentPage ? ' btn-primary' : ' btn-ghost');
                b.addEventListener('click', () => { currentPage = i; render(); });
                pagesWrap.appendChild(b);
            }
        }

        function doFilter() {
            const q    = document.getElementById(searchId).value.toLowerCase().trim();
            const stat = document.getElementById(statusId).value;
            filtered = allRows.filter(r =>
                r.dataset.search.includes(q) &&
                (stat === 'all' || r.dataset.status === stat)
            );
            currentPage = 1;
            render();
        }

        document.getElementById(searchId).addEventListener('input', doFilter);
        document.getElementById(statusId).addEventListener('change', doFilter);
        prevBtn.addEventListener('click', () => { currentPage--; render(); });
        nextBtn.addEventListener('click', () => { currentPage++; render(); });

        filtered = [...allRows];
        render();
    }

    document.addEventListener('DOMContentLoaded', function () {
        makePaginator({
            rowSelector: '.data-row-donasi',
            searchId:    'searchDonasi',
            statusId:    'statusDonasi',
            noResultId:  'noResultDonasi',
            infoId:      'infoDonasi',
            prevId:      'prevDonasi',
            nextId:      'nextDonasi',
            pagesId:     'pagesDonasi',
        });

        makePaginator({
            rowSelector: '.data-row-sponsor',
            searchId:    'searchSponsor',
            statusId:    'statusSponsor',
            noResultId:  'noResultSponsor',
            infoId:      'infoSponsor',
            prevId:      'prevSponsor',
            nextId:      'nextSponsor',
            pagesId:     'pagesSponsor',
        });
    });
    </script>
</x-app-layout>
