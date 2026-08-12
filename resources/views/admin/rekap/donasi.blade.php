{{--
    ============================================================
    admin\rekap\donasi.blade.php — Rekap Donasi
    ============================================================
    Halaman rekap lengkap transaksi donasi kampanye untuk admin.
    Data dikirim dari RekapController:
      - $totalAmount, $totalCount, $successCount, $pendingCount
        → kartu statistik
      - $donations (paginate) → daftar donasi kampanye
    Alur halaman: header + tombol export CSV/PDF → kartu statistik
    (total dana, total transaksi, sukses, tertunda) → form filter
    (rentang tanggal & kata kunci) → filter status
    (Semua/Sukses/Tertunda/Gagal) → tabel donasi (order id, donatur,
    kampanye, nominal, metode, status, tanggal) → paginasi.
--}}
<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

    {{-- Header halaman: judul + tombol export CSV dan PDF --}}
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
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Data Seluruh Donasi</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Rekap lengkap transaksi donasi kampanye</p>
                </div>
                {{-- Tombol export: menyertakan query string filter saat ini --}}
                <div class="flex gap-2">
                    <a href="{{ route('admin.rekap.donasi.export') }}?{{ request()->getQueryString() }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        CSV
                    </a>
                    <a href="{{ route('admin.rekap.donasi.export-pdf') }}?{{ request()->getQueryString() }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-12 space-y-6">

        {{-- Kartu statistik rekap donasi --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 max-sm:grid-cols-1">
            {{-- Kartu 1: Total dana terkumpul --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Dana Terkumpul</div>
                        <div class="text-xl font-black text-base-content mt-0.5">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 2: Total jumlah transaksi --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center text-white shadow-lg shadow-sky-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Transaksi</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $totalCount }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 3: Jumlah donasi sukses --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Sukses</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $successCount }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 4: Jumlah donasi tertunda (pending) --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white shadow-lg shadow-amber-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Tertunda</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $pendingCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            {{-- Form filter: rentang tanggal (start_date s/d end_date) dan kata kunci pencarian --}}
            <div class="px-4 sm:px-6 py-4 border-b border-base-200 flex flex-wrap items-center justify-between gap-3 bg-base-50/30">
                <form method="GET" class="flex flex-wrap items-center gap-2">
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="input input-bordered input-sm rounded-xl">
                    <span class="text-xs text-base-content/50">s/d</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="input input-bordered input-sm rounded-xl">
                    {{-- Pencarian: nama / email / order id --}}
                    <input type="text" name="search" placeholder="Cari nama/email/order..." class="input input-bordered input-sm rounded-xl" value="{{ request('search') }}">
                    {{-- Tombol terapkan filter dan reset --}}
                    <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 btn-sm font-bold rounded-xl">Filter</button>
                    <a href="{{ route('admin.rekap.donasi') }}" class="btn btn-ghost btn-sm font-bold rounded-xl">Reset</a>
                </form>
            </div>

            {{-- Filter status donasi: Semua / Sukses / Tertunda / Gagal.
                Tautan aktif diberi warna berbeda (baca request('status')). --}}
            <div class="px-4 sm:px-6 py-3 border-b border-base-200 bg-base-50/30 flex flex-wrap items-center gap-1.5">
                <span class="text-[11px] font-semibold text-base-content/50 mr-1">Status:</span>
                @php $curStatus = request('status'); @endphp
                <a href="{{ route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => ''])) }}"
                   class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-200 {{ !$curStatus ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80' }}">Semua</a>
                <a href="{{ route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => 'success'])) }}"
                   class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-200 {{ $curStatus === 'success' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80' }}">Sukses</a>
                <a href="{{ route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => 'pending'])) }}"
                   class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-200 {{ $curStatus === 'pending' ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80' }}">Tertunda</a>
                <a href="{{ route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => 'failed'])) }}"
                   class="px-3 py-1.5 text-xs font-bold rounded-xl transition-all duration-200 {{ $curStatus === 'failed' ? 'bg-rose-500 text-white shadow-lg shadow-rose-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80' }}">Gagal</a>
            </div>

            @if($donations->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        {{-- Kolom tabel rekap donasi: Order ID, Donatur, Kampanye,
                            Nominal, Metode, Status, Tanggal --}}
                        <thead>
                            <tr class="bg-base-50/80 border-b border-base-200">
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Order ID</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Donatur</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Kampanye</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-right">Nominal</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Metode</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Status</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-100">
                            {{-- Perulangan setiap transaksi donasi --}}
                            @foreach($donations as $d)
                                <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                    <td>
                                        {{-- Kode/order id transaksi dari Midtrans --}}
                                        <span class="font-mono text-[0.6rem] text-base-content/40 bg-base-100 px-1.5 py-0.5 rounded">{{ $d->order_id ?? '-' }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{-- Nama donatur dengan avatar inisial --}}
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 font-bold text-xs flex items-center justify-center uppercase shrink-0">{{ substr($d->donor_name, 0, 1) }}</div>
                                            <span class="text-sm font-bold text-base-content">{{ $d->donor_name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-base-content/60">{{ $d->campaign?->title ?? '-' }}</td>
                                    <td class="py-4 px-6 text-right">
                                        {{-- Nominal donasi dengan format rupiah --}}
                                        <span class="font-black text-base-content">Rp {{ number_format($d->amount, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{-- Metode pembayaran yang dipakai donatur --}}
                                        <span class="inline-flex items-center gap-1.5 text-xs text-base-content/60">
                                            <svg class="w-3.5 h-3.5 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                                            {{ $d->payment_method ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        {{-- Badge status donasi: Sukses (hijau), Tertunda (kuning), Ditolak (merah) --}}
                                        @php
                                            $icon = $d->status == 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : ($d->status == 'pending' ? 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' : 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z');
                                            $label = $d->status == 'success' ? 'Sukses' : ($d->status == 'pending' ? 'Tertunda' : 'Ditolak');
                                            $classes = $d->status == 'success' ? 'text-emerald-700 bg-emerald-100 border-emerald-200' : ($d->status == 'pending' ? 'text-amber-700 bg-amber-100 border-amber-200' : 'text-rose-700 bg-rose-100 border-rose-200');
                                        @endphp
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $classes }}">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                                            {{ $label }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{-- Tanggal & jam transaksi donasi --}}
                                        <div class="flex items-center gap-2 text-xs text-base-content/60 whitespace-nowrap">
                                            <svg class="w-3.5 h-3.5 text-base-content/30 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                            {{ $d->created_at ? $d->created_at->format('d/m/Y H:i') : '-' }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                {{-- Kondisi saat tidak ada data donasi --}}
                <div class="py-16 text-center">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                        <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="font-black text-base-content text-lg">Belum ada data donasi</p>
                </div>
            @endif
        </div>

        {{-- Paginasi tabel rekap --}}
        <div class="flex justify-center">
            {{ $donations->links() }}
        </div>
    </div>
</div>
</x-admin-layout>