<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

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

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 max-sm:grid-cols-1">
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
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center text-white shadow-lg shadow-sky-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Sponsorship</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $sponsorshipCount }}</div>
                    </div>
                </div>
            </div>
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

        <div x-data="{ tab: 'donasi' }" class="space-y-4">
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-1.5 flex items-center justify-between">
                <div class="flex gap-1">
                    <button @click="tab = 'donasi'" :class="tab === 'donasi' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-base-content/50 hover:text-base-content hover:bg-base-200'" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Donasi Kampanye
                        <span class="ml-0.5 px-2 py-0.5 rounded-full text-xs font-bold" :class="tab === 'donasi' ? 'bg-white/20' : 'bg-base-300'">{{ $donationCount }}</span>
                    </button>
                    <button @click="tab = 'sponsor'" :class="tab === 'sponsor' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-base-content/50 hover:text-base-content hover:bg-base-200'" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Orang Tua Asuh
                        <span class="ml-0.5 px-2 py-0.5 rounded-full text-xs font-bold" :class="tab === 'sponsor' ? 'bg-white/20' : 'bg-base-300'">{{ $sponsorshipCount }}</span>
                    </button>
                </div>

            </div>

            <div x-show="tab === 'donasi'" x-transition:enter.duration.200ms>
                <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
                    @if($donations->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table w-full">
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
                                    @foreach($donations as $item)
                                        <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 font-bold text-sm flex items-center justify-center uppercase shrink-0">{{ substr($item->donor_name, 0, 1) }}</div>
                                                    <div class="min-w-0">
                                                        <div class="font-semibold text-sm text-base-content truncate max-w-[160px]">{{ $item->donor_name }}</div>
                                                        <div class="text-xs text-base-content/40 truncate max-w-[160px]">{{ $item->donor_email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-base-100 border border-base-200 text-base-content/60">
                                                    <svg class="w-3 h-3 text-base-content/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                                    {{ $item->target }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                <div class="font-black text-base-content">Rp {{ number_format($item->amount, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="font-mono text-[0.6rem] text-base-content/40 bg-base-100 px-1.5 py-0.5 rounded">{{ $item->order_id }}</span>
                                            </td>
                                            <td class="py-4 px-6">
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
                                                @php
                                                    $sIcon = $item->status == 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : ($item->status == 'pending' ? 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' : 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z');
                                                    $sLabel = $item->status == 'success' ? 'Sukses' : ($item->status == 'pending' ? 'Tertunda' : 'Gagal');
                                                    $sClass = $item->status == 'success' ? 'text-emerald-700 bg-emerald-100 border-emerald-200' : ($item->status == 'pending' ? 'text-amber-700 bg-amber-100 border-amber-200' : 'text-rose-700 bg-rose-100 border-rose-200');
                                                @endphp
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $sClass }}">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $sIcon }}"/></svg>
                                                    {{ $sLabel }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-2 text-xs text-base-content/60 whitespace-nowrap">
                                                    <svg class="w-3.5 h-3.5 text-base-content/30 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                                    {{ $item->created_at?->format('d/m/Y') }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    @if($item->status==='pending')
                                                        <form action="{{ route('admin.transactions.approve', $item->order_id) }}" method="POST" class="inline">
                                                            @csrf @method('PATCH')
                                                            <button type="submit" class="btn btn-xs bg-emerald-600 hover:bg-emerald-700 text-white border-0 rounded-lg font-bold">Konfirmasi</button>
                                                        </form>
                                                        <button type="button" @click="$dispatch('open-reject', { id: '{{ $item->order_id }}', donor: '{{ $item->donor_name }}' })" class="btn btn-xs bg-rose-50 hover:bg-rose-100 text-rose-600 border-rose-200 rounded-lg font-bold">Tolak</button>
                                                    @endif
                                                    <form action="{{ route('admin.transactions.destroy', $item->order_id) }}" method="POST" class="inline" x-data="{ open: false }" @submit.prevent="open = true">
                                                        @csrf @method('DELETE')
                                                        <button type="button" @click="open = true" class="btn btn-ghost btn-xs text-base-content/50 hover:text-rose-600 hover:bg-rose-50 rounded-lg font-bold">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                        </button>
                                                        <x-confirm-delete-modal entity-name="{{ $item->donor_name }}" entity-type="transaksi" />
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 border-t border-base-200 flex justify-center">
                            {{ $donations->links() }}
                        </div>
                    @else
                        <div class="py-16 text-center">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                                <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="font-black text-base-content text-lg">Belum ada donasi kampanye</p>
                        </div>
                    @endif
                </div>
            </div>

            <div x-show="tab === 'sponsor'" x-transition:enter.duration.200ms>
                <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
                    @if($sponsorships->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table w-full">
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
                                    @foreach($sponsorships as $item)
                                        <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                            <td class="py-4 px-6">
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
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-base-100 border border-base-200 text-base-content/60">
                                                    <svg class="w-3 h-3 text-base-content/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                    {{ $item->target }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
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
                                                <div class="font-black text-base-content">Rp {{ number_format($item->amount, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="font-mono text-[0.6rem] text-base-content/40 bg-base-100 px-1.5 py-0.5 rounded">{{ $item->order_id }}</span>
                                            </td>
                                            <td class="py-4 px-6">
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
                                                @php
                                                    $sIcon = $item->status == 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : ($item->status == 'pending' ? 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' : 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z');
                                                    $sLabel = $item->status == 'success' ? 'Sukses' : ($item->status == 'pending' ? 'Tertunda' : 'Gagal');
                                                    $sClass = $item->status == 'success' ? 'text-emerald-700 bg-emerald-100 border-emerald-200' : ($item->status == 'pending' ? 'text-amber-700 bg-amber-100 border-amber-200' : 'text-rose-700 bg-rose-100 border-rose-200');
                                                @endphp
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $sClass }}">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $sIcon }}"/></svg>
                                                    {{ $sLabel }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-2 text-xs text-base-content/60 whitespace-nowrap">
                                                    <svg class="w-3.5 h-3.5 text-base-content/30 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                                    {{ $item->created_at?->format('d/m/Y') }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    @if($item->status==='pending')
                                                        <form action="{{ route('admin.transactions.approve', $item->order_id) }}" method="POST" class="inline">
                                                            @csrf @method('PATCH')
                                                            <button type="submit" class="btn btn-xs bg-emerald-600 hover:bg-emerald-700 text-white border-0 rounded-lg font-bold">Konfirmasi</button>
                                                        </form>
                                                        <button type="button" @click="$dispatch('open-reject', { id: '{{ $item->order_id }}', donor: '{{ $item->donor_name }}' })" class="btn btn-xs bg-rose-50 hover:bg-rose-100 text-rose-600 border-rose-200 rounded-lg font-bold">Tolak</button>
                                                    @endif
                                                    <form action="{{ route('admin.transactions.destroy', $item->order_id) }}" method="POST" class="inline" x-data="{ open: false }" @submit.prevent="open = true">
                                                        @csrf @method('DELETE')
                                                        <button type="button" @click="open = true" class="btn btn-ghost btn-xs text-base-content/50 hover:text-rose-600 hover:bg-rose-50 rounded-lg font-bold">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                        </button>
                                                        <x-confirm-delete-modal entity-name="{{ $item->donor_name }}" entity-type="transaksi" />
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 border-t border-base-200 flex justify-center">
                            {{ $sponsorships->links() }}
                        </div>
                    @else
                        <div class="py-16 text-center">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                                <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <p class="font-black text-base-content text-lg">Belum ada sponsorship</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

{{-- REJECT MODAL --}}
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
            <form :action="`{{ url('admin/transactions') }}/${orderId}/reject`" method="POST">
                @csrf @method('PATCH')
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
