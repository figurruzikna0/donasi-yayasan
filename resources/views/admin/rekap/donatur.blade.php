{{--
    ============================================================
    admin\rekap\donatur.blade.php — Rekap Donatur
    ============================================================
    Halaman rekap lengkap seluruh user donatur terdaftar beserta
    data registrasinya. Data dikirim dari RekapController:
      - $totalDonatur, $totalDonasiAll, $totalSponsorshipAll
        → kartu statistik
      - $donaturs (paginate) → daftar donatur
    Alur halaman: header + tombol export CSV/PDF → kartu statistik
    (total donatur, total donasi sukses, total sponsorship aktif) →
    form filter (rentang tanggal & kata kunci) → tabel donatur
    (nama, email, password tersimpan, no HP, NIK, alamat, jumlah
    donasi, jumlah sponsorship, verifikasi, tanggal terdaftar) →
    paginasi.
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
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Data Seluruh Donatur</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Rekap lengkap user donatur terdaftar beserta data registrasi</p>
                </div>
                {{-- Tombol export: menyertakan query string filter saat ini --}}
                <div class="flex gap-2">
                    <a href="{{ route('admin.rekap.donatur.export') }}?{{ request()->getQueryString() }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        CSV
                    </a>
                    <a href="{{ route('admin.rekap.donatur.export-pdf') }}?{{ request()->getQueryString() }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-12 space-y-6">

        {{-- Kartu statistik rekap donatur --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            {{-- Kartu 1: Total donatur terdaftar --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Donatur Terdaftar</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $totalDonatur }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 2: Total nilai donasi sukses semua donatur --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center text-white shadow-lg shadow-sky-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Donasi Sukses</div>
                        <div class="text-xl font-black text-base-content mt-0.5">Rp {{ number_format($totalDonasiAll, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            {{-- Kartu 3: Total sponsorship aktif --}}
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white shadow-lg shadow-amber-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Sponsorship Aktif</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $totalSponsorshipAll }}</div>
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
                    {{-- Pencarian: nama / email / HP / NIK --}}
                    <input type="text" name="search" placeholder="Cari nama/email/HP/NIK..." class="input input-bordered input-sm rounded-xl" value="{{ request('search') }}">
                    {{-- Tombol terapkan filter dan reset --}}
                    <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 btn-sm font-bold rounded-xl">Cari</button>
                    <a href="{{ route('admin.rekap.donatur') }}" class="btn btn-ghost btn-sm font-bold rounded-xl">Reset</a>
                </form>
            </div>

            @if($donaturs->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        {{-- Kolom tabel rekap donatur: Nama, Username (Email), Password,
                            No. HP, NIK, Alamat, Donasi, Sponsorship, Verifikasi, Terdaftar --}}
                        <thead>
                            <tr class="bg-base-50/80 border-b border-base-200">
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Nama</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Username (Email)</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Password</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">No. HP</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">NIK</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Alamat</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Donasi</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Sponsorship</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Verifikasi</th>
                                <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-100">
                            {{-- Perulangan setiap donatur --}}
                            @foreach($donaturs as $u)
                                <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                    <td class="py-4 px-6">
                                        {{-- Nama donatur dengan avatar inisial --}}
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 font-bold text-xs flex items-center justify-center uppercase shrink-0">{{ substr($u->name, 0, 1) }}</div>
                                            <span class="text-sm font-bold text-base-content">{{ $u->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-mono text-base-content/60">{{ $u->email }}</td>
                                    <td class="py-4 px-6 text-center">
                                        {{-- Indikator password tersimpan (tidak menampilkan isi password) --}}
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[0.6rem] font-bold bg-emerald-100 text-emerald-700">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Tersimpan
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{-- Nomor HP donatur --}}
                                        <span class="inline-flex items-center gap-1.5 text-sm text-base-content/60">
                                            <svg class="w-3.5 h-3.5 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                            {{ $u->phone ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-mono text-base-content/60">{{ $u->nik ?? '-' }}</td>
                                    <td class="py-4 px-6 text-sm text-base-content/60 max-w-[200px] truncate" title="{{ $u->address }}">{{ $u->address ?? '-' }}</td>
                                    <td class="py-4 px-6 text-center">
                                        {{-- Jumlah donasi kampanye yang dilakukan donatur --}}
                                        <span class="inline-flex items-center justify-center min-w-[32px] px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">{{ $u->donations_count ?? 0 }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        {{-- Jumlah sponsorship orang tua asuh yang diikuti donatur --}}
                                        <span class="inline-flex items-center justify-center min-w-[32px] px-2.5 py-1 rounded-full text-xs font-bold bg-sky-100 text-sky-700">{{ $u->sponsorships_count ?? 0 }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        {{-- Badge status verifikasi email donatur --}}
                                        @if($u->email_verified_at)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Terverifikasi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Belum
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        {{-- Tanggal & jam donatur terdaftar --}}
                                        <div class="flex items-center gap-2 text-xs text-base-content/60 whitespace-nowrap">
                                            <svg class="w-3.5 h-3.5 text-base-content/30 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                            {{ $u->created_at->format('d/m/Y') }} <span class="text-base-content/30">{{ $u->created_at->format('H:i') }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                {{-- Kondisi saat belum ada donatur terdaftar --}}
                <div class="py-16 text-center">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                        <svg class="w-9 h-9 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <p class="font-black text-base-content text-lg">Belum ada donatur terdaftar</p>
                </div>
            @endif
        </div>

        {{-- Paginasi tabel rekap --}}
        <div class="flex justify-center">
            {{ $donaturs->links() }}
        </div>
    </div>
</div>
</x-admin-layout>