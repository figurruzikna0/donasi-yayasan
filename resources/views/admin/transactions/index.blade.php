{{--
    ============================================================
    admin\transactions\index.blade.php — Riwayat Transaksi
    ============================================================
    Halaman admin untuk mengelola seluruh transaksi donasi:
    donasi kampanye dan sponsorship orang tua asuh.
    Data dikirim dari AdminTransactionController.index():
      - $donationCount, $sponsorshipCount, $donationSuccessCount,
        $sponsorshipSuccessCount, $donationPendingCount,
        $sponsorshipPendingCount → statistik kartu
      - $donations (paginate) → daftar donasi kampanye
      - $sponsorships (paginate) → daftar sponsorship
    Alur halaman: kartu statistik → tab "Donasi Kampanye" dan
    "Orang Tua Asuh" (Alpine.js) → tabel transaksi masing-masing
    dengan aksi Konfirmasi, Tolak (modal), dan Hapus (modal).
--}}
<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

    {{-- Header halaman --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.12),transparent_70%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,rgba(16,185,129,0.2),transparent_60%)]"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <div class="flex items-center gap-2.5 mb-1">
                        <span class="w-8 h-0.5 rounded-full bg-emerald-300/60"></span>
                        <span class="text-emerald-200/80 text-xs font-bold uppercase tracking-widest">Program</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Riwayat Transaksi</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Ringkasan donasi kampanye & sponsorship orang tua asuh</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-12 space-y-6">

        {{-- Kartu statistik ringkas transaksi --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 max-sm:grid-cols-1">
            {{-- Kartu 1: Total donasi kampanye --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Donasi</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $donationCount }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 2: Total sponsorship orang tua asuh --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center text-white shadow-lg shadow-sky-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Sponsorship</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $sponsorshipCount }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 3: Total transaksi sukses (donasi + sponsorship) --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Sukses</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $donationSuccessCount + $sponsorshipSuccessCount }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 4: Total transaksi tertunda (pending) --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white shadow-lg shadow-amber-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Tertunda</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $donationPendingCount + $sponsorshipPendingCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Seksi tab (Alpine.js): variabel tab berisi 'donasi' atau 'sponsor' --}}
        <div x-data="{ tab: 'donasi' }" class="space-y-4">
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-1.5 flex items-center justify-between">
                <div class="flex gap-1">
                    {{-- Tombol tab: Donasi Kampanye --}}
                    <button @click="tab = 'donasi'" :class="tab === 'donasi' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-base-content/50 hover:text-base-content hover:bg-base-200'" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Donasi Kampanye
                        <span class="ml-0.5 px-2 py-0.5 rounded-full text-xs font-bold" :class="tab === 'donasi' ? 'bg-white/20' : 'bg-base-300'">{{ $donationCount }}</span>
                    </button>
                    {{-- Tombol tab: Orang Tua Asuh (sponsorship) --}}
                    <button @click="tab = 'sponsor'" :class="tab === 'sponsor' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-base-content/50 hover:text-base-content hover:bg-base-200'" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Orang Tua Asuh
                        <span class="ml-0.5 px-2 py-0.5 rounded-full text-xs font-bold" :class="tab === 'sponsor' ? 'bg-white/20' : 'bg-base-300'">{{ $sponsorshipCount }}</span>
                    </button>
                </div>

            </div>

            {{-- Panel tab 1: TABEL DONASI KAMPANYE (x-show saat tab === 'donasi') --}}
            <div x-show="tab === 'donasi'" x-transition:enter.duration.200ms>
                <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
                    @if($donations->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                {{-- Kolom: Donatur, Kampanye, Nominal, Kode Donasi, Bukti, Status, Tanggal, Aksi --}}
                                <thead>
                                    <tr class="bg-base-50/80 border-b border-base-200">
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Donatur</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Kampanye</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-right">Nominal</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Kode Donasi</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Bukti</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Status</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Tanggal</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-base-100 stagger-enter">
                                    {{-- Perulangan setiap transaksi donasi kampanye --}}
                                    @foreach($donations as $item)
                                        <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                            <td class="py-4 px-6">
                                                {{-- Identitas donatur: avatar inisial, nama, dan email --}}
                                                <div class="flex items-center gap-3">
                                                    <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 font-bold text-sm flex items-center justify-center uppercase shrink-0">{{ substr($item->donor_name, 0, 1) }}</div>
                                                    <div class="min-w-0">
                                                        <div class="font-semibold text-sm text-base-content truncate max-w-[160px]">{{ $item->donor_name }}</div>
                                                        <div class="text-xs text-base-content/40 truncate max-w-[160px]">{{ $item->donor_email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                {{-- Nama target kampanye dari transaksi --}}
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-base-100 border border-base-200 text-base-content/60">
                                                    <svg class="w-3 h-3 text-base-content/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                                    {{ $item->target }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                {{-- Nominal donasi dengan format rupiah --}}
                                                <div class="font-black text-base-content">Rp {{ number_format($item->amount, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="py-4 px-6">
                                                {{-- Kode/order id transaksi dari Midtrans --}}
                                                <span class="font-mono text-[0.6rem] text-base-content/40 bg-base-100 px-1.5 py-0.5 rounded">{{ $item->order_id }}</span>
                                            </td>
                                            <td class="py-4 px-6">
                                                {{-- Bukti pembayaran: link dibuka di tab baru jika ada --}}
                                                @if($item->payment_proof)
                                                    <a href="{{ asset('storage/' . $item->payment_proof) }}" target="_blank"
                                                       class="inline-flex items-center gap-1 text-[0.6rem] font-bold px-2 py-0.5 rounded-full border bg-sky-50 text-sky-700 border-sky-200 hover:bg-sky-100 transition-colors">
                                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        Lihat Bukti
                                                    </a>
                                                @else
                                                    <span class="text-xs text-base-content/30">-</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{-- Penentuan ikon, label, dan warna badge status transaksi (success/pending/ditolak) --}}
                                                @php
                                                    $sIcon = $item->status == 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : ($item->status == 'pending' ? 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' : 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z');
                                                    $sLabel = $item->status == 'success' ? 'Sukses' : ($item->status == 'pending' ? 'Tertunda' : 'Ditolak');
                                                    $sClass = $item->status == 'success' ? 'text-emerald-700 bg-emerald-100 border-emerald-200' : ($item->status == 'pending' ? 'text-amber-700 bg-amber-100 border-amber-200' : 'text-rose-700 bg-rose-100 border-rose-200');
                                                @endphp
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $sClass }}">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $sIcon }}"/></svg>
                                                    {{ $sLabel }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                {{-- Tanggal transaksi (format dd/mm/yyyy) --}}
                                                <div class="flex items-center gap-2 text-xs text-base-content/60 whitespace-nowrap">
                                                    <svg class="w-3.5 h-3.5 text-base-content/30 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                                    {{ $item->created_at?->format('d/m/Y') }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{-- Tombol aksi (muncul saat baris di-hover): Konfirmasi, Tolak (hanya pending), Hapus --}}
                                                <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    {{-- Aksi approve hanya untuk transaksi berstatus pending --}}
                                                    @if($item->status==='pending')
                                                        <form action="{{ route('admin.transactions.approve', $item->order_id) }}" method="POST" class="inline">
                                                            @csrf @method('PATCH')
                                                            <button type="submit" class="btn btn-xs bg-emerald-600 hover:bg-emerald-700 text-white border-0 rounded-lg font-bold">Konfirmasi</button>
                                                        </form>
                                                        {{-- Tombol tolak membuka modal reject (Alpine $dispatch) --}}
                                                        <button type="button" @click="$dispatch('open-reject', { id: '{{ $item->order_id }}', donor: '{{ $item->donor_name }}' })" class="btn btn-xs bg-rose-50 hover:bg-rose-100 text-rose-600 border-rose-200 rounded-lg font-bold">Tolak</button>
                                                    @endif
                                                    {{-- Tombol hapus membuka modal delete --}}
                                                    <form action="{{ route('admin.transactions.destroy', $item->order_id) }}" method="POST" class="inline" x-data>
                                                        @csrf @method('DELETE')
                                                        <button type="button" @click="$dispatch('open-delete', { id: '{{ $item->order_id }}', donor: '{{ $item->donor_name }}' })" class="btn btn-ghost btn-xs text-base-content/50 hover:text-rose-600 hover:bg-rose-50 rounded-lg font-bold">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Paginasi tabel donasi kampanye --}}
                        <div class="p-4 border-t border-base-200 flex justify-center">
                            {{ $donations->links() }}
                        </div>
                    @else
                        {{-- Kondisi saat belum ada donasi kampanye --}}
                        <div class="py-16 text-center">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                                <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="font-black text-base-content text-lg">Belum ada donasi kampanye</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Panel tab 2: TABEL SPONSORSHIP (x-show saat tab === 'sponsor') --}}
            <div x-show="tab === 'sponsor'" x-transition:enter.duration.200ms>
                <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
                    @if($sponsorships->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                {{-- Kolom: Donatur, Anak Asuh, Paket, Nominal, Kode Donasi, Bukti, Status, Tanggal, Aksi --}}
                                <thead>
                                    <tr class="bg-base-50/80 border-b border-base-200">
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Donatur</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Anak Asuh</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Paket</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-right">Nominal</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Kode Donasi</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Bukti</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Status</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Tanggal</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-base-100 stagger-enter">
                                    {{-- Perulangan setiap data sponsorship --}}
                                    @foreach($sponsorships as $item)
                                        <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                            <td class="py-4 px-6">
                                                {{-- Identitas donatur: avatar inisial, nama, email, dan nomor HP (jika ada) --}}
                                                <div class="flex items-center gap-3">
                                                    <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 font-bold text-sm flex items-center justify-center uppercase shrink-0">{{ substr($item->donor_name, 0, 1) }}</div>
                                                    <div class="min-w-0">
                                                        <div class="font-semibold text-sm text-base-content truncate max-w-[160px]">{{ $item->donor_name }}</div>
                                                        <div class="text-xs text-base-content/40 truncate max-w-[160px]">{{ $item->donor_email }}</div>
                                                        @isset($item->donor_phone)
                                                            <div class="text-xs text-base-content/30 truncate max-w-[160px]">{{ $item->donor_phone }}</div>
                                                        @endisset
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                {{-- Nama anak asuh yang disponsori --}}
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-base-100 border border-base-200 text-base-content/60">
                                                    <svg class="w-3 h-3 text-base-content/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                    {{ $item->target }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                {{-- Badge paket sponsorship dengan warna berbeda tiap jenis (Bronze/Silver/Gold) --}}
                                                @if($item->package)
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold
                                                        @switch($item->package)
                                                            @case('Bronze') bg-amber-50 text-amber-700 border border-amber-200 @break
                                                            @case('Silver') bg-slate-100 text-slate-700 border border-slate-300 @break
                                                            @case('Gold') bg-yellow-50 text-yellow-700 border border-yellow-300 @break
                                                            @default bg-base-200 text-base-content/60 border border-base-300
                                                        @endswitch
                                                    ">
                                                        {{ $item->package }}
                                                    </span>
                                                @else
                                                    <span class="text-base-content/30 text-xs">-</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                {{-- Nominal sponsorship dengan format rupiah --}}
                                                <div class="font-black text-base-content">Rp {{ number_format($item->amount, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="py-4 px-6">
                                                {{-- Kode/order id sponsorship dari Midtrans --}}
                                                <span class="font-mono text-[0.6rem] text-base-content/40 bg-base-100 px-1.5 py-0.5 rounded">{{ $item->order_id }}</span>
                                            </td>
                                            <td class="py-4 px-6">
                                                {{-- Bukti pembayaran sponsorship: link ke storage jika ada --}}
                                                @if($item->payment_proof)
                                                    <a href="{{ asset('storage/' . $item->payment_proof) }}" target="_blank"
                                                       class="inline-flex items-center gap-1 text-[0.6rem] font-bold px-2 py-0.5 rounded-full border bg-sky-50 text-sky-700 border-sky-200 hover:bg-sky-100 transition-colors">
                                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        Lihat Bukti
                                                    </a>
                                                @else
                                                    <span class="text-xs text-base-content/30">-</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{-- Badge status sponsorship (sukses/pending/ditolak) --}}
                                                @php
                                                    $sIcon = $item->status == 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : ($item->status == 'pending' ? 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' : 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z');
                                                    $sLabel = $item->status == 'success' ? 'Sukses' : ($item->status == 'pending' ? 'Tertunda' : 'Ditolak');
                                                    $sClass = $item->status == 'success' ? 'text-emerald-700 bg-emerald-100 border-emerald-200' : ($item->status == 'pending' ? 'text-amber-700 bg-amber-100 border-amber-200' : 'text-rose-700 bg-rose-100 border-rose-200');
                                                @endphp
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $sClass }}">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $sIcon }}"/></svg>
                                                    {{ $sLabel }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                {{-- Tanggal transaksi sponsorship --}}
                                                <div class="flex items-center gap-2 text-xs text-base-content/60 whitespace-nowrap">
                                                    <svg class="w-3.5 h-3.5 text-base-content/30 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                                    {{ $item->created_at?->format('d/m/Y') }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{-- Tombol aksi sponsorship: Konfirmasi, Tolak (pending), Hapus --}}
                                                <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    {{-- Aksi konfirmasi & tolak hanya untuk status pending --}}
                                                    @if($item->status==='pending')
                                                        <form action="{{ route('admin.transactions.approve', $item->order_id) }}" method="POST" class="inline">
                                                            @csrf @method('PATCH')
                                                            <button type="submit" class="btn btn-xs bg-emerald-600 hover:bg-emerald-700 text-white border-0 rounded-lg font-bold">Konfirmasi</button>
                                                        </form>
                                                        <button type="button" @click="$dispatch('open-reject', { id: '{{ $item->order_id }}', donor: '{{ $item->donor_name }}' })" class="btn btn-xs bg-rose-50 hover:bg-rose-100 text-rose-600 border-rose-200 rounded-lg font-bold">Tolak</button>
                                                    @endif
                                                    {{-- Tombol hapus membuka modal delete --}}
                                                    <form action="{{ route('admin.transactions.destroy', $item->order_id) }}" method="POST" class="inline" x-data>
                                                        @csrf @method('DELETE')
                                                        <button type="button" @click="$dispatch('open-delete', { id: '{{ $item->order_id }}', donor: '{{ $item->donor_name }}' })" class="btn btn-ghost btn-xs text-base-content/50 hover:text-rose-600 hover:bg-rose-50 rounded-lg font-bold">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Paginasi tabel sponsorship --}}
                        <div class="p-4 border-t border-base-200 flex justify-center">
                            {{ $sponsorships->links() }}
                        </div>
                    @else
                        {{-- Kondisi saat belum ada sponsorship --}}
                        <div class="py-16 text-center">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                                <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <p class="font-black text-base-content text-lg">Belum ada sponsorship</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

{{-- DELETE MODAL --}}
{{-- Modal konfirmasi hapus transaksi (Alpine.js).
    Mendengar event 'open-delete' yang di-$dispatch oleh tombol hapus.
    Form aksinya memakai DELETE ke URL admin/transactions/{orderId}. --}}
<div x-data="{ open: false, orderId: '', donorName: '' }"
     @open-delete.window="orderId = $event.detail.id; donorName = $event.detail.donor; open = true">
    <dialog class="modal" :class="{ 'modal-open': open }">
        <div class="modal-box max-w-sm p-0 overflow-hidden">
            <div class="px-6 pt-8 pb-6 text-center">
                <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-rose-50 flex items-center justify-center shadow-inner">
                    <svg class="w-8 h-8 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                </div>
                {{-- Teks konfirmasi dengan nama donatur dinamis (x-text) --}}
                <h3 class="text-lg font-black text-slate-800 mb-1">Konfirmasi Hapus</h3>
                <p class="text-sm text-slate-500 mb-6 leading-relaxed">Yakin ingin menghapus transaksi <strong class="text-slate-800" x-text="donorName"></strong>? Tindakan ini tidak bisa dibatalkan.</p>
                <div class="flex gap-3 justify-center">
                    {{-- Tombol batal menutup modal --}}
                    <button type="button" @click="open = false" class="btn btn-ghost btn-sm font-semibold px-6 text-slate-600 hover:bg-slate-100">Batal</button>
                    {{-- Form hapus dengan URL dinamis memakai Alpine (template literal) --}}
                    <form :action="`{{ url('admin/transactions') }}/${orderId}`" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm font-semibold px-6 text-white bg-rose-500 hover:bg-rose-600 border-none" @click="open = false">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop"><button @click="open = false">close</button></form>
    </dialog>
</div>

{{-- REJECT MODAL --}}
{{-- Modal penolakan transaksi dengan alasan (Alpine.js).
    Mendengar event 'open-reject'. Alasan wajib diisi (minimal 1
    karakter) dan dikirim bersama form PATCH ke
    admin/transactions/{orderId}/reject; notifikasi dikirim ke donatur. --}}
<div x-data="{ open: false, orderId: '', donorName: '', reason: '' }"
     @open-reject.window="orderId = $event.detail.id; donorName = $event.detail.donor; reason = ''; open = true">
    <dialog class="modal" :class="{ 'modal-open': open }">
        <div class="modal-box max-w-md">
            <div class="text-center mb-4">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-rose-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                </div>
                <h3 class="text-lg font-black text-base-content mb-1">Tolak Transaksi</h3>
                <p class="text-sm text-base-content/60 mb-4">Berikan alasan penolakan untuk <strong x-text="donorName"></strong></p>
            </div>
            {{-- Form kirim alasan penolakan ke endpoint reject --}}
            <form :action="`{{ url('admin/transactions') }}/${orderId}/reject`" method="POST">
                @csrf @method('PATCH')
                {{-- Textarea alasan penolakan dengan penghitung karakter (x-model reason) --}}
                <textarea name="rejection_reason" x-model="reason" required maxlength="1000" rows="4"
                          class="textarea textarea-bordered w-full resize-none text-sm"
                          placeholder="Masukkan alasan penolakan..."></textarea>
                <div class="text-xs text-base-content/40 text-right mt-1" x-text="reason.length + '/1000'"></div>
                <div class="flex gap-2 justify-end mt-4">
                    <button type="button" @click="open = false" class="btn btn-ghost btn-sm font-bold px-6">Batal</button>
                    <button type="submit" class="btn bg-rose-600 hover:bg-rose-700 text-white border-0 btn-sm font-bold px-6">Tolak & Kirim Notifikasi</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button @click="open = false">close</button></form>
    </dialog>
</div>
</x-admin-layout>
