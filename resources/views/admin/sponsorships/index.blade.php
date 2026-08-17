{{--
    ============================================================
    admin\sponsorships\index.blade.php — Modul Orang Tua Asuh
    ============================================================
    Halaman utama modul Orang Tua Asuh: memantau daftar sponsorship
    anak asuh beserta status, periode aktif, dan masa jatuh tempo.
    Data $sponsorships (paginate) dikirim dari AdminSponsorshipController.index().
    Alur halaman: hitung statistik (total/aktif/menunggu/ditolak-expire)
    → kartu statistik → tabel sponsorship (Penyandang Dana & Anak Asuh,
    Paket & Nominal, Periode, Status, Aksi) → aksi Setujui/Tolak (modal)
    → Hapus (modal) → modal tolak sponsorship.
    Catatan: nomor WhatsApp donatur tersimpan dengan format 62xxx.
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
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Sponsorship Orang Tua Asuh</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Pantau status sponsorship anak asuh, masa aktif, dan jatuh tempo perpanjangan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-12 space-y-6">

        {{-- ------------------------------------------------------------------
            BLOK PHP: perhitungan statistik dari koleksi $sponsorships
            - $total: total seluruh sponsorship
            - $activeCount: status success dan periode belum lewat (aktif)
            - $pendingCount: status pending (menunggu konfirmasi)
            - $failedExpiredCount: success tapi sudah lewat masa aktif,
              atau status expired/failed/cancelled
        ------------------------------------------------------------------ --}}
        @php
            $total = $sponsorships->total();
            $activeCount = $sponsorships->filter(function($s) {
                $expired = $s->expires_at && $s->expires_at->isPast();
                return $s->status === 'success' && !$expired;
            })->count();
            $pendingCount = $sponsorships->filter(fn($s) => $s->status === 'pending')->count();
            $failedExpiredCount = $sponsorships->filter(function($s) {
                $expired = $s->expires_at && $s->expires_at->isPast();
                return ($s->status === 'success' && $expired) || in_array($s->status, ['expired', 'failed', 'cancelled']);
            })->count();
        @endphp

        {{-- Kartu statistik sponsorship: Total, Aktif, Menunggu, Ditolak/Expire --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 max-sm:grid-cols-1">
            {{-- Kartu 1: Total sponsorship --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Sponsorship</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $total }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 2: Jumlah sponsorship aktif (masih dalam periode) --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Aktif</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $activeCount }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 3: Jumlah sponsorship menunggu konfirmasi --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white shadow-lg shadow-amber-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Menunggu</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $pendingCount }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 4: Jumlah sponsorship ditolak / sudah lewat masa aktif --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-400 to-rose-600 flex items-center justify-center text-white shadow-lg shadow-rose-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Ditolak / Expire</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $failedExpiredCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ------------------------------------------------------------------
            TABEL DAFTAR SPONSORSHIP
            Kolom: Penyandang Dana & Anak Asuh, Paket & Nominal, Periode,
            Status (Menunggu / Aktif / Expire / Ditolak), dan Aksi.
            Status dihitung ulang tiap baris lewat blok php di dalam
            forelse (logika $statusKey + $remainingDays).
        ------------------------------------------------------------------ --}}
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-50/80 border-b border-base-200">
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Penyandang Dana &amp; Anak Asuh</th>
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Paket &amp; Nominal</th>
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Periode</th>
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Status</th>
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-100 stagger-enter">
                        {{-- Perulangan setiap data sponsorship --}}
                        @forelse($sponsorships as $sponsorship)
                            {{-- ------------------------------------------------------------------
                                LOGIKA STATUS PER BARIS:
                                - $isExpiredPeriod: true jika expires_at sudah lewat
                                - $remainingDays: sisa hari masa aktif
                                - $statusKey: pending / aktif / kadaluarsa / gagal
                                (dipakai untuk badge warna & label status)
                            ------------------------------------------------------------------ --}}
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
                            <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                <td class="py-4 px-6">
                                    {{-- Identitas donatur: avatar inisial, nama, email, nomor WA (format 62xxx), dan anak asuh --}}
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 font-bold text-sm flex items-center justify-center uppercase shrink-0">{{ substr($sponsorship->donor_name, 0, 1) }}</div>
                                        <div>
                                            <div class="font-bold text-sm text-base-content">{{ $sponsorship->donor_name }}</div>
                                            <div class="text-xs text-base-content/40">{{ $sponsorship->donor_email }}</div>
                                            {{-- Nomor WhatsApp donatur (tersimpan dalam format 62xxx) --}}
                                            <div class="text-xs text-base-content/40 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-1.5 16.5h.01"/></svg>
                                                {{ $sponsorship->donor_phone ?? '-' }}
                                            </div>
                                            {{-- Nama anak asuh yang disponsori (fallback jika anak dihapus) --}}
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-emerald-100 text-emerald-700 mt-1">{{ $sponsorship->fosterChild->name ?? 'Anak Dihapus' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    {{-- Paket sponsorship (Bronze/Silver/Gold), nominal, order id, dan metode bayar --}}
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[0.6rem] font-bold bg-amber-50 text-amber-700 border border-amber-200">{{ $sponsorship->package ?? '-' }}</span>
                                    <div class="font-black text-base-content mt-1">Rp {{ number_format($sponsorship->amount, 0, ',', '.') }}</div>
                                    <div class="text-xs text-base-content/30 font-mono mt-0.5">{{ $sponsorship->order_id }}</div>
                                    @if($sponsorship->payment_method)
                                        <div class="text-xs text-base-content/40 mt-0.5">via {{ $sponsorship->payment_method }}</div>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    {{-- Periode masa aktif sponsorship beserta sisa hari / keterangan lewat --}}
                                    @if($sponsorship->starts_at && $sponsorship->expires_at)
                                        <div class="text-sm font-bold text-base-content whitespace-nowrap">{{ $sponsorship->starts_at->format('d M Y') }} – {{ $sponsorship->expires_at->format('d M Y') }}</div>
                                        <div class="text-xs mt-1">
                                            @if($statusKey === 'aktif')
                                                <span class="text-emerald-600 font-semibold">{{ $remainingDays }} hari lagi</span>
                                            @elseif($statusKey === 'kadaluarsa')
                                                <span class="text-rose-600 font-semibold">{{ $remainingDays > 0 ? 'Lewat ' . $remainingDays . ' hari' : 'Expire' }}</span>
                                            @endif
                                        </div>
                                    @else
                                        {{-- Data periode kosong berarti sponsorship belum dibayar --}}
                                        <div class="text-sm font-bold text-base-content">-</div>
                                        <div class="text-xs text-base-content/40">Belum dibayar</div>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    {{-- Badge status sponsorship:
                                        - Aktif (hijau): success & periode masih berjalan
                                        - Menunggu (kuning): status pending
                                        - Expire (abu): success tapi periode lewat / status expired
                                        - Ditolak (merah): failed/cancelled/dll --}}
                                    @php
                                        $sIcon = $statusKey === 'aktif' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : ($statusKey === 'pending' ? 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' : ($statusKey === 'kadaluarsa' ? 'M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z' : 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'));
                                        $sLabel = $statusKey === 'aktif' ? 'Aktif' : ($statusKey === 'pending' ? 'Menunggu' : ($statusKey === 'kadaluarsa' ? 'Expire' : 'Ditolak'));
                                        $sClass = $statusKey === 'aktif' ? 'text-emerald-700 bg-emerald-100 border-emerald-200' : ($statusKey === 'pending' ? 'text-amber-700 bg-amber-100 border-amber-200' : ($statusKey === 'kadaluarsa' ? 'text-slate-600 bg-slate-100 border-slate-200' : 'text-rose-700 bg-rose-100 border-rose-200'));
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $sClass }}">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $sIcon }}"/></svg>
                                        {{ $sLabel }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    {{-- Tombol aksi (muncul saat baris di-hover):
                                        - Setujui (modal konfirmasi Alpine) + Tolak (modal reject)
                                          hanya tampil untuk status pending
                                        - Hapus (modal konfirmasi x-confirm-delete-modal) --}}
                                    <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @if($sponsorship->status === 'pending')
                                            {{-- Form setujui sponsorship: PATCH ke admin.sponsorships.approve --}}
                                            <form action="{{ route('admin.sponsorships.approve', $sponsorship->order_id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                @csrf @method('PATCH')
                                                <button type="button" @click="open = true" class="btn btn-xs bg-emerald-600 hover:bg-emerald-700 text-white border-0 rounded-lg font-bold gap-1">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-3.5 h-3.5" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    Setujui
                                                </button>
                                                {{-- Modal konfirmasi persetujuan manual --}}
                                                <dialog class="modal" :class="{ 'modal-open': open }">
                                                    <div class="modal-box max-w-sm">
                                                        <div class="text-center">
                                                            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center">
                                                                <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                            </div>
                                                            <h3 class="text-lg font-black text-base-content mb-1">Konfirmasi</h3>
                                                            <p class="text-sm text-base-content/60 mb-6">Setujui sponsorship ini secara manual?</p>
                                                        </div>
                                                        <div class="flex gap-2 justify-center">
                                                            <button type="button" @click="open = false" class="btn btn-ghost btn-sm font-bold px-6">Batal</button>
                                                            {{-- Tombol setujui: submit form melalui JavaScript --}}
                                                            <button @click="open = false; $el.closest('form').submit()" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 btn-sm font-bold px-6">Setujui</button>
                                                        </div>
                                                    </div>
                                                    <form method="dialog" class="modal-backdrop"><button>close</button></form>
                                                </dialog>
                                            </form>
                                            {{-- Tombol tolak membuka modal reject sponsorship --}}
                                            <button type="button" @click="$dispatch('open-reject-sponsor', { id: '{{ $sponsorship->order_id }}', donor: '{{ $sponsorship->donor_name }}' })" class="btn btn-xs bg-rose-50 hover:bg-rose-100 text-rose-600 border-rose-200 rounded-lg font-bold">Tolak</button>
                                        @endif
                                        {{-- Form hapus sponsorship: DELETE ke admin.sponsorships.destroy --}}
                                        <form action="{{ route('admin.sponsorships.destroy', $sponsorship->order_id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                            @csrf @method('DELETE')
                                            <button type="button" @click="open = true" class="btn btn-ghost btn-xs text-base-content/50 hover:text-rose-600 hover:bg-rose-50 rounded-lg font-bold">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-3.5 h-3.5" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                Hapus
                                            </button>
                                            {{-- Modal konfirmasi hapus sponsorship (komponen Alpine) --}}
                                            <x-confirm-delete-modal entity-name="{{ $sponsorship->donor_name }}" entity-type="sponsorship" />
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Kondisi saat belum ada sponsorship sama sekali --}}
                            <tr>
                                <td colspan="5">
                                    <div class="py-16 text-center">
                                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                                            <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <p class="font-black text-base-content text-lg">Belum Ada Sponsorship</p>
                                        <p class="text-sm text-base-content/50 mt-1">Sponsorship anak asuh yang masuk lewat Midtrans akan tampil di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Paginasi tabel sponsorship --}}
            @if($sponsorships->hasPages())
                <div class="p-4 border-t border-base-200 flex justify-center">
                    {{ $sponsorships->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

{{-- REJECT MODAL --}}
{{-- Modal penolakan sponsorship dengan alasan (Alpine.js).
    Mendengar event 'open-reject-sponsor' dari tombol Tolak.
    Alasan wajib diisi dan dikirim lewat PATCH ke
    admin/sponsorships/{orderId}/reject; notifikasi dikirim ke donatur. --}}
<div x-data="{ open: false, orderId: '', donorName: '', reason: '' }"
     @open-reject-sponsor.window="orderId = $event.detail.id; donorName = $event.detail.donor; reason = ''; open = true">
    <dialog class="modal" :class="{ 'modal-open': open }">
        <div class="modal-box max-w-md">
            <div class="text-center mb-4">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-rose-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                </div>
                <h3 class="text-lg font-black text-base-content mb-1">Tolak Sponsorship</h3>
                <p class="text-sm text-base-content/60 mb-4">Berikan alasan penolakan untuk <strong x-text="donorName"></strong></p>
            </div>
            {{-- Form kirim alasan penolakan ke endpoint reject --}}
            <form :action="`{{ url('admin/sponsorships') }}/${orderId}/reject`" method="POST">
                @csrf @method('PATCH')
                {{-- Textarea alasan dengan penghitung karakter (x-model reason) --}}
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
