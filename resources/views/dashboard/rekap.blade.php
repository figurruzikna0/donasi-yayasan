<!-- ============================================ -->
<!-- dashboard/rekap.blade.php - REKAP TRANSAKSI  -->
<!-- ============================================ -->
<!-- Peran: halaman donatur yang menampilkan rekap seluruh transaksi (donasi, sponsorship/Orang Tua Asuh, dan laporan perkembangan anak) dalam bentuk 3 tab + tabel. -->
<!-- Data dikirim dari DonorController (route dashboard.rekap): $donations, $sponsorships, $childDevelopments, dan $profil. -->
<!-- Alur: header gradasi + kartu statistik, tab navigasi (Donasi / Sponsorship & Anak Asuh / Perkembangan Anak) yang di-switch dengan JavaScript, tabel-tabel riwayat, lightbox foto (Alpine.js), lalu skrip switchTab. -->
<x-app-layout>
    <div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

        {{-- HEADER — gradasi dengan statistik ringkas --}}
        <!-- Header halaman: judul "Rekap Transaksi" dan tombol kembali ke dashboard -->
        <div class="relative overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.12),transparent_70%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,rgba(16,185,129,0.2),transparent_60%)]"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <div class="flex items-center gap-2.5 mb-1">
                            <span class="w-8 h-0.5 rounded-full bg-emerald-300/60"></span>
                            <span class="text-emerald-200/80 text-xs font-bold uppercase tracking-widest">Donatur Area</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Rekap Transaksi</h1>
                        <p class="text-emerald-100/80 text-sm mt-1.5 max-w-xl">Pantau semua donasi, sponsorship, dan perkembangan anak asuh dalam satu tampilan</p>
                    </div>
                    <!-- Tombol kembali menuju halaman dashboard donatur -->
                    <a href="{{ route('dashboard') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-12 space-y-6">

            {{-- KARTU STATISTIK --}}
            <!-- 3 kartu statistik ringkas: total donasi sukses, sponsorship aktif, dan jumlah laporan perkembangan -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Kartu 1: total donasi sukses (hanya status 'success') dan jumlah transaksi termasuk yang menunggu -->
                <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                    <div class="relative flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Donasi</div>
                            <div class="text-2xl font-black text-emerald-700">Rp {{ number_format($donations->where('status', 'success')->sum('amount'), 0, ',', '.') }}</div>
                            <div class="text-xs text-base-content/40 mt-0.5 flex items-center gap-1">
                                <span>{{ $donations->count() }} transaksi</span>
                                <!-- Kondisi if: tambahan keterangan jumlah donasi yang masih menunggu konfirmasi -->
                                @if($donations->where('status', 'pending')->count() > 0)
                                    <span class="w-1 h-1 rounded-full bg-base-300"></span>
                                    <span class="text-amber-500 font-semibold">{{ $donations->where('status', 'pending')->count() }} menunggu</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kartu 2: jumlah sponsorship dengan status sukses (aktif) dari total sponsorship -->
                <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                    <div class="relative flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center text-white shadow-lg shadow-sky-200 shrink-0">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Sponsorship Aktif</div>
                            <div class="text-2xl font-black text-sky-700">{{ $sponsorships->where('status', 'success')->count() }}</div>
                            <div class="text-xs text-base-content/40 mt-0.5">{{ $sponsorships->count() }} total sponsorship</div>
                        </div>
                    </div>
                </div>

                <!-- Kartu 3: jumlah laporan perkembangan anak dari yayasan -->
                <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                    <div class="relative flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white shadow-lg shadow-amber-200 shrink-0">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                        </div>
                        <div>
                            <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Laporan Perkembangan</div>
                            <div class="text-2xl font-black text-amber-700">{{ $childDevelopments->count() }}</div>
                            <div class="text-xs text-base-content/40 mt-0.5">update dari yayasan</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB NAVIGASI --}}
            <!-- Tab navigasi: 3 tombol (Donasi, Sponsorship & Anak Asuh, Perkembangan Anak) yang mengaktifkan panel tabel terkait lewat fungsi switchTab() -->
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
                <div class="border-b border-base-200 bg-base-50/50 px-4 sm:px-6">
                    <div class="flex gap-1" id="tabNav" role="tablist">
                        <!-- Tab Donasi: aktif secara default (kelas aktif emerald), data-tab="donasi" dipakai oleh switchTab() -->
                        <button class="tab-btn relative px-5 py-4 text-sm font-bold transition-all duration-200 text-emerald-700 border-b-2 border-emerald-600 -mb-[1px]" data-tab="donasi" onclick="switchTab('donasi')" role="tab">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Donasi
                            </span>
                        </button>
                        <!-- Tab Sponsorship & Anak Asuh -->
                        <button class="tab-btn relative px-5 py-4 text-sm font-bold transition-all duration-200 text-base-content/40 border-b-2 border-transparent hover:text-emerald-600 hover:border-emerald-300" data-tab="sponsorship" onclick="switchTab('sponsorship')" role="tab">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Sponsorship &amp; Anak Asuh
                            </span>
                        </button>
                        <!-- Tab Perkembangan Anak -->
                        <button class="tab-btn relative px-5 py-4 text-sm font-bold transition-all duration-200 text-base-content/40 border-b-2 border-transparent hover:text-emerald-600 hover:border-emerald-300" data-tab="perkembangan" onclick="switchTab('perkembangan')" role="tab">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                                Perkembangan Anak
                            </span>
                        </button>
                    </div>
                </div>

                {{-- TAB DONASI --}}
                <!-- Panel tab Donasi: filter status (Alpine dFilter) dan tabel riwayat donasi -->
                <div id="tab-donasi" class="p-0" x-data="{ dFilter: 'all' }">
                    <div class="p-4 sm:p-6 border-b border-base-200 bg-base-50/30">
                        <!-- Tombol filter status donasi: mengubah nilai dFilter (all/success/pending/failed) yang menyaring baris tabel -->
                        <div class="flex gap-2 flex-wrap">
                            <button @click="dFilter = 'all'" :class="dFilter === 'all' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80'" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all duration-200">Semua</button>
                            <button @click="dFilter = 'success'" :class="dFilter === 'success' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80'" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all duration-200">Berhasil</button>
                            <button @click="dFilter = 'pending'" :class="dFilter === 'pending' ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80'" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all duration-200">Menunggu</button>
                            <button @click="dFilter = 'failed'" :class="dFilter === 'failed' ? 'bg-rose-500 text-white shadow-lg shadow-rose-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80'" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all duration-200">Ditolak</button>
                        </div>
                    </div>

                    <!-- Kondisi if: tampilkan tabel riwayat donasi jika ada data, jika tidak tampilkan state kosong dengan CTA donasi -->
                    @if($donations->isNotEmpty())
                        <div class="overflow-x-auto">
                            <!-- Tabel riwayat donasi: kolom Tanggal, Program, Metode, Nominal, Status, dan aksi Invoice -->
                            <table class="table w-full">
                                <thead>
                                    <tr class="bg-base-50/80 border-b border-base-200">
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Tanggal</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Program</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Metode</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-right">Nominal</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Status</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-base-100">
                                    <!-- foreach: setiap donasi menjadi satu baris; atribut x-show menyembunyikan baris jika tidak cocok dengan filter dFilter -->
                                    @foreach($donations as $d)
                                        <tr x-show="dFilter === 'all' || dFilter === '{{ $d->status }}'" x-transition:enter.duration.200ms class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-9 h-9 rounded-xl bg-base-100 group-hover:bg-emerald-100/50 flex items-center justify-center text-base-content/30 group-hover:text-emerald-500 transition-all shrink-0">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                                    </div>
                                                    <!-- Tanggal dan jam transaksi dibuat (created_at) -->
                                                    <div>
                                                        <div class="text-sm font-semibold text-base-content">{{ $d->created_at->format('d M Y') }}</div>
                                                        <div class="text-[0.6rem] text-base-content/40">{{ $d->created_at->format('H:i') }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- Nama program kampanye terkait (relasi campaign) -->
                                            <td class="py-4 px-6">
                                                <span class="text-sm font-semibold text-emerald-700">{{ $d->campaign?->title ?? '-' }}</span>
                                            </td>
                                            <!-- Metode pembayaran donasi -->
                                            <td class="py-4 px-6">
                                                <span class="inline-flex items-center gap-1.5 text-xs text-base-content/60">
                                                    <svg class="w-3.5 h-3.5 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                                                    {{ $d->payment_method ?? '-' }}
                                                </span>
                                            </td>
                                            <!-- Nominal donasi (kanan) -->
                                            <td class="py-4 px-6 text-right">
                                                <span class="font-black text-base-content text-lg">Rp {{ number_format($d->amount, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <!-- php: menentukan warna badge, teks, dan ikon berdasarkan status donasi (success/pending/failed) -->
                                                @php
                                                    $bc = $d->status == 'success' ? 'badge-success text-emerald-700 bg-emerald-100 border-emerald-200' : ($d->status == 'pending' ? 'badge-warning text-amber-700 bg-amber-100 border-amber-200' : 'badge-error text-rose-700 bg-rose-100 border-rose-200');
                                                    $bt = $d->status == 'success' ? 'Berhasil' : ($d->status == 'pending' ? 'Menunggu' : 'Ditolak');
                                                    $icon = $d->status == 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : ($d->status == 'pending' ? 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' : 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z');
                                                @endphp
                                                <!-- Badge status transaksi dengan ikon sesuai status -->
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $bc }}">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
                                                    {{ $bt }}
                                                </span>
                                                <!-- Kondisi if: menampilkan alasan penolakan jika donasi gagal dan ada catatan rejection_reason -->
                                                @if($d->status === 'failed' && $d->rejection_reason)
                                                    <div class="mt-1.5 text-[0.6rem] text-rose-600 bg-rose-50 rounded-lg px-2.5 py-1.5 border border-rose-200 leading-relaxed max-w-[200px]">
                                                        <span class="font-bold">Alasan:</span> {{ $d->rejection_reason }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6">
                                                <!-- Kondisi if: tombol Invoice (unduh PDF) hanya untuk donasi berstatus sukses -->
                                                @if($d->status === 'success')
                                                    <a href="{{ route('invoice.donation', $d->id) }}" target="_blank" class="btn btn-ghost btn-xs text-emerald-600 hover:bg-emerald-50 rounded-lg gap-1.5 font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                                        Invoice
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- State kosong: belum ada riwayat donasi, disertai tombol ajakan berdonasi -->
                        <div class="py-16 text-center">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                                <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="font-black text-base-content text-lg">Belum ada riwayat donasi</p>
                            <p class="text-sm text-base-content/50 mt-1 max-w-sm mx-auto">Setiap donasi yang kamu lakukan akan tercatat di sini. Yuk mulai donasi sekarang!</p>
                            <a href="{{ url('/#kampanye') }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl mt-4 gap-2 btn-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                Donasi Sekarang
                            </a>
                        </div>
                    @endif
                </div>

                {{-- TAB SPONSORSHIP --}}
                <!-- Panel tab Sponsorship: filter status (Alpine sFilter) dan tabel riwayat sponsorship/Orang Tua Asuh -->
                <div id="tab-sponsorship" class="hidden p-0" x-data="{ sFilter: 'all' }">
                    <div class="p-4 sm:p-6 border-b border-base-200 bg-base-50/30">
                        <!-- Tombol filter status sponsorship: all/success/pending/failed/expired -->
                        <div class="flex gap-2 flex-wrap">
                            <button @click="sFilter = 'all'" :class="sFilter === 'all' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80'" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all duration-200">Semua</button>
                            <button @click="sFilter = 'success'" :class="sFilter === 'success' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80'" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all duration-200">Aktif</button>
                            <button @click="sFilter = 'pending'" :class="sFilter === 'pending' ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80'" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all duration-200">Pending</button>
                            <button @click="sFilter = 'failed'" :class="sFilter === 'failed' ? 'bg-rose-500 text-white shadow-lg shadow-rose-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80'" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all duration-200">Ditolak</button>
                            <button @click="sFilter = 'expired'" :class="sFilter === 'expired' ? 'bg-slate-600 text-white shadow-lg shadow-slate-200' : 'bg-base-200/70 text-base-content/60 hover:bg-base-200 hover:text-base-content/80'" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all duration-200">Expire</button>
                        </div>
                    </div>

                    <!-- Kondisi if: tampilkan tabel sponsorship jika ada data, jika tidak tampilkan state kosong dengan CTA menjadi orang tua asuh -->
                    @if($sponsorships->isNotEmpty())
                        <div class="overflow-x-auto">
                            <!-- Tabel sponsorship: kolom Anak Asuh, Paket, Metode, Nominal, Periode, Status, dan aksi -->
                            <table class="table w-full">
                                <thead>
                                    <tr class="bg-base-50/80 border-b border-base-200">
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Anak Asuh</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Paket</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Metode</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-right">Nominal</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Periode</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Status</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-base-100">
                                    <!-- foreach: setiap sponsorship menjadi satu baris -->
                                    @foreach($sponsorships as $s)
                                        <!-- php: menghitung apakah masa sponsorship sudah lewat (expired), lalu menentukan kelas badge, teks, dan ikon status -->
                                        @php
                                            $isExpired = $s->expires_at && $s->expires_at->isPast();
                                            if ($s->status == 'success' && !$isExpired) {
                                                $sClass = 'text-emerald-700 bg-emerald-100 border-emerald-200';
                                                $sText = 'Aktif';
                                                $sIcon = 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z';
                                            } elseif ($s->status == 'pending') {
                                                $sClass = 'text-amber-700 bg-amber-100 border-amber-200';
                                                $sText = 'Pending';
                                                $sIcon = 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z';
                                            } elseif ($isExpired || $s->status == 'expired') {
                                                $sClass = 'text-slate-600 bg-slate-100 border-slate-200';
                                                $sText = 'Expire';
                                                $sIcon = 'M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z';
                                            } else {
                                                $sClass = 'text-rose-700 bg-rose-100 border-rose-200';
                                                $sText = 'Ditolak';
                                                $sIcon = 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z';
                                            }
                                        @endphp
                                        <tr x-show="sFilter === 'all' || sFilter === '{{ $s->status }}'" x-transition:enter.duration.200ms class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                            <td class="py-4 px-6">
                                                <!-- Kolom anak asuh: foto anak (atau avatar placeholder ui-avatars) dan nama anak -->
                                                <div class="flex items-center gap-3">
                                                    <div class="avatar">
                                                        <div class="w-10 h-10 rounded-xl ring ring-base-200">
                                                            <img src="{{ $s->fosterChild?->photo ? asset('storage/' . $s->fosterChild->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($s->fosterChild?->name ?? '-') . '&background=10b981&color=fff&rounded=true&bold=true' }}" alt="" class="object-cover">
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-bold text-base-content">{{ $s->fosterChild?->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <!-- Paket sponsorship yang dipilih (misal bulanan, per kuartal, dsb.) -->
                                            <td class="py-4 px-6">
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[0.6rem] font-bold bg-amber-50 text-amber-700 border border-amber-200">{{ $s->package ?? '-' }}</span>
                                            </td>
                                            <!-- Metode pembayaran -->
                                            <td class="py-4 px-6">
                                                <span class="inline-flex items-center gap-1.5 text-xs text-base-content/60">
                                                    <svg class="w-3.5 h-3.5 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                                                    {{ $s->payment_method ?? '-' }}
                                                </span>
                                            </td>
                                            <!-- Nominal pembayaran sponsorship -->
                                            <td class="py-4 px-6 text-right">
                                                <span class="font-black text-base-content text-lg">Rp {{ number_format($s->amount, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <!-- Periode mulai - berakhir; jika lewat masa berlaku tampilkan keterangan sisa/lewat hari -->
                                                <div class="text-xs text-base-content/60 whitespace-nowrap">
                                                    {{ $s->starts_at ? $s->starts_at->format('d/m/Y') : '-' }}
                                                    @if($s->expires_at) – {{ $s->expires_at->format('d/m/Y') }} @endif
                                                </div>
                                                @if($s->expires_at)
                                                    <div class="text-[0.55rem] font-bold mt-0.5 {{ $isExpired ? 'text-rose-500' : 'text-emerald-500' }}">
                                                        {{ $isExpired ? 'Lewat ' . now()->diffInDays($s->expires_at) . ' hari' : now()->diffInDays($s->expires_at) . ' hari lagi' }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6">
                                                <!-- Badge status sponsorship + alasan penolakan jika ditolak -->
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $sClass }}">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $sIcon }}"/></svg>
                                                    {{ $sText }}
                                                </span>
                                                @if($s->status === 'failed' && $s->rejection_reason)
                                                    <div class="mt-1.5 text-[0.6rem] text-rose-600 bg-rose-50 rounded-lg px-2.5 py-1.5 border border-rose-200 leading-relaxed max-w-[200px]">
                                                        <span class="font-bold">Alasan:</span> {{ $s->rejection_reason }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <!-- Kondisi if: tombol Invoice hanya untuk sponsorship aktif (success dan belum lewat) -->
                                                    @if($s->status === 'success' && !$isExpired)
                                                        <a href="{{ route('invoice.sponsorship', $s->id) }}" target="_blank" class="btn btn-ghost btn-xs text-emerald-600 hover:bg-emerald-50 rounded-lg gap-1.5 font-bold">
                                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                                            Invoice
                                                        </a>
                                                    @endif
                                                    <!-- Kondisi if: tombol "Perpanjang" muncul jika sponsorship sudah lewat masa berlakunya -->
                                                    @if($isExpired || $s->status === 'expired')
                                                        <a href="{{ route('sponsor.form', $s->foster_child_id) }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white btn-xs rounded-lg gap-1.5 font-bold shadow-sm">
                                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182"/></svg>
                                                            Perpanjang
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- State kosong: belum ada sponsorship, disertai tombol ajakan menjadi orang tua asuh -->
                        <div class="py-16 text-center">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-sky-100 to-sky-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                                <svg class="w-9 h-9 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <p class="font-black text-base-content text-lg">Belum ada sponsorship</p>
                            <p class="text-sm text-base-content/50 mt-1 max-w-sm mx-auto">Jadilah Orang Tua Asuh untuk anak-anak yatim dan dhuafa.</p>
                            <a href="{{ url('/#program-ota') }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl mt-4 gap-2 btn-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                Jadi Orang Tua Asuh
                            </a>
                        </div>
                    @endif
                </div>

                {{-- TAB PERKEMBANGAN --}}
                <!-- Panel tab Perkembangan Anak: tabel laporan perkembangan anak asuh dari yayasan -->
                <div id="tab-perkembangan" class="hidden p-0">
                    <!-- Kondisi if: tampilkan tabel jika ada laporan perkembangan, jika tidak tampilkan state kosong -->
                    @if($childDevelopments->isNotEmpty())
                        <div class="overflow-x-auto">
                            <!-- Tabel perkembangan: kolom Foto, Nama Anak, Umur, Keterangan, Tanggal, dan aksi PDF -->
                            <table class="table w-full">
                                <thead>
                                    <tr class="bg-base-50/80 border-b border-base-200">
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Foto</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Nama Anak</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Umur</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Keterangan</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Tanggal</th>
                                        <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-base-100">
                                    <!-- foreach: setiap laporan perkembangan menjadi satu baris -->
                                    @foreach($childDevelopments as $dev)
                                        <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                            <td class="py-4 px-6">
                                                <!-- Kondisi if: foto laporan ditampilkan sebagai thumbnail; diklik membuka lightbox fullscreen -->
                                                @if($dev->foto)
                                                    <div class="avatar cursor-pointer" @click="lightboxOpen = true; lightboxSrc = '{{ asset('storage/' . $dev->foto) }}'">
                                                        <div class="w-14 h-14 rounded-xl ring-2 ring-base-200">
                                                            <img src="{{ asset('storage/' . $dev->foto) }}" alt="{{ $dev->judul }}" class="object-cover w-full h-full">
                                                        </div>
                                                    </div>
                                                @else
                                                    <!-- Placeholder jika tidak ada foto -->
                                                    <div class="w-14 h-14 bg-base-100 rounded-xl flex items-center justify-center text-base-content/20">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                                                    </div>
                                                @endif
                                            </td>
                                            <!-- Nama anak asuh (relasi fosterChild) -->
                                            <td class="py-4 px-6 font-bold text-base-content">{{ $dev->fosterChild?->name ?? '-' }}</td>
                                            <td class="py-4 px-6">
                                                <span class="text-sm text-base-content/60">{{ $dev->fosterChild?->age ?? '-' }} Thn</span>
                                            </td>
                                            <!-- Keterangan laporan: judul dan deskripsi perkembangan -->
                                            <td class="py-4 px-6">
                                                <div class="font-bold text-sm text-emerald-700">{{ $dev->judul }}</div>
                                                <p class="text-xs text-base-content/50 mt-0.5 leading-relaxed line-clamp-2">{{ $dev->deskripsi }}</p>
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-2 text-xs text-base-content/60">
                                                    <svg class="w-3.5 h-3.5 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                                    {{ $dev->tanggal ? $dev->tanggal->format('d/m/Y') : '-' }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <!-- Tombol unduh laporan perkembangan dalam format PDF -->
                                                <a href="{{ route('invoice.child-development.pdf', $dev->id) }}" target="_blank" class="btn btn-ghost btn-xs text-amber-600 hover:bg-amber-50 rounded-lg gap-1.5 font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                                    PDF
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- State kosong: belum ada laporan perkembangan anak -->
                        <div class="py-16 text-center">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                                <svg class="w-9 h-9 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                            </div>
                            <p class="font-black text-base-content text-lg">Belum ada laporan perkembangan</p>
                            <p class="text-sm text-base-content/50 mt-1 max-w-sm mx-auto">Admin akan mengirimkan laporan perkembangan anak asuh Anda secara berkala.</p>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>

    {{-- LIGHTBOX — modal foto fullscreen --}}
    <!-- Lightbox Alpine.js: menampilkan foto laporan perkembangan secara fullscreen; ditutup lewat tombol X, klik di luar, atau tombol Escape -->
    <div x-data="{ lightboxOpen: false, lightboxSrc: '' }"
         x-show="lightboxOpen"
         x-cloak
         @keydown.escape.window="lightboxOpen = false"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
         @click.self="lightboxOpen = false">
        <button @click="lightboxOpen = false" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 text-white flex items-center justify-center transition-colors z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img :src="lightboxSrc" alt="Foto" class="max-w-[90vw] max-h-[90vh] object-contain rounded-xl shadow-2xl">
    </div>

    <!-- ========================================================== -->
    <!-- SKRIP JAVASCRIPT switchTab: memindahkan tampilan antar tab (Donasi / Sponsorship / Perkembangan) -->
    <!-- Alur: atur ulang kelas aktif pada tombol tab, lalu tampilkan panel sesuai data-tab dan sembunyikan panel lainnya -->
    <!-- ========================================================== -->
    <script>
        function switchTab(tab) {
            document.querySelectorAll('#tabNav .tab-btn').forEach(el => {
                el.classList.remove('border-emerald-600', 'text-emerald-700');
                el.classList.add('border-transparent', 'text-base-content/40', 'hover:text-emerald-600', 'hover:border-emerald-300');
            });
            const btn = document.querySelector('#tabNav [data-tab="' + tab + '"]');
            btn.classList.remove('border-transparent', 'text-base-content/40', 'hover:text-emerald-600', 'hover:border-emerald-300');
            btn.classList.add('border-emerald-600', 'text-emerald-700');

            document.querySelectorAll('#tab-donasi, #tab-sponsorship, #tab-perkembangan').forEach(el => el.classList.add('hidden'));
            document.getElementById('tab-' + tab).classList.remove('hidden');
        }
    </script>
</x-app-layout>
