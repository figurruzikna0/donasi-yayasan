{{--
    ============================================================
    admin\users\index.blade.php — Data Seluruh User
    ============================================================
    Halaman daftar seluruh user (donatur + admin) pada area admin.
    Data dikirim dari AdminUserController.index():
      - $donaturs → koleksi user ber-role 'donatur' (dengan paginasi)
      - $admins   → koleksi user ber-role 'admin'
    Alur halaman: tampilkan kartu statistik (total donatur, total admin,
    terverifikasi) → tabel donatur (nama, email, no HP, status, aksi
    edit/hapus) → tabel admin (nama, email, status, aksi edit).
--}}
<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

    {{-- Header halaman: judul dan deskripsi --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.12),transparent_70%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,rgba(16,185,129,0.2),transparent_60%)]"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <div class="flex items-center gap-2.5 mb-1">
                        <span class="w-8 h-0.5 rounded-full bg-emerald-300/60"></span>
                        <span class="text-emerald-200/80 text-xs font-bold uppercase tracking-widest">Konten</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Data Seluruh User</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Kelola data donatur dan admin yang terdaftar.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12 space-y-6">

        {{-- STAT CARDS --}}
        {{-- Kartu statistik ringkas: jumlah donatur, jumlah admin, dan
            jumlah user yang emailnya sudah terverifikasi. --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Kartu 1: Total donatur (menggunakan total() karena $donaturs di-paginate) --}}
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Donatur</p>
                    <p class="text-2xl font-black text-base-content">{{ $donaturs->total() }}</p>
                </div>
            </div>
            {{-- Kartu 2: Total admin --}}
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                </div>
                <div>
                    <p class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Admin</p>
                    <p class="text-2xl font-black text-base-content">{{ $admins->count() }}</p>
                </div>
            </div>
            {{-- Kartu 3: Jumlah user terverifikasi (donatur + admin) --}}
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Terverifikasi</p>
                    <p class="text-2xl font-black text-base-content">{{ $donaturs->where('email_verified_at', '!=', null)->count() + $admins->where('email_verified_at', '!=', null)->count() }}</p>
                </div>
            </div>
        </div>

        {{-- Donatur table --}}
        {{-- -----------------------------------------------------------
            TABEL DONATUR
            Kolom: Nama (avatar + nama), Email, No. HP, Status verifikasi,
            dan Aksi (Edit + Hapus).
            - forelse: menampilkan baris per donatur; jika kosong,
              tampilkan pesan "Belum ada donatur terdaftar".
            - Status verifikasi dibaca dari $user->email_verified_at.
            - Hapus memakai form DELETE dengan modal konfirmasi Alpine
              (x-confirm-delete-modal).
        ----------------------------------------------------------- --}}
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="font-extrabold text-sm text-base-content">Donatur Terdaftar</p>
                    <p class="text-xs text-base-content/50">Total: {{ $donaturs->total() }} akun</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-200/50">
                            <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Nama</th>
                            <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Email</th>
                            <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">No. HP</th>
                            <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Status</th>
                            <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200/60">
                        @forelse($donaturs as $user)
                            <tr class="hover:bg-base-200/30 transition-colors">
                                <td>
                                    <div class="flex items-center gap-3">
                                        {{-- Avatar: foto upload atau placeholder ui-avatars --}}
                                        <div class="avatar">
                                            <div class="w-9 rounded-full ring ring-base-300 ring-offset-1">
                                                @if($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="object-cover">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=b3e093&color=5c8148&bold=true" alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <span class="font-bold text-sm text-base-content whitespace-nowrap">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="text-sm text-base-content/60 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="text-sm text-base-content/60 whitespace-nowrap">{{ $user->phone ?? '-' }}</td>
                                <td class="text-center whitespace-nowrap">
                                    {{-- Badge status verifikasi email: hijau jika sudah verifikasi, kuning jika belum --}}
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Belum Verifikasi
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Tombol aksi: Edit (ke halaman edit user) dan Hapus (form DELETE + modal konfirmasi) --}}
                                    <div class="flex items-center justify-center gap-1 whitespace-nowrap">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-ghost text-base-content/50 hover:text-warning hover:bg-warning/5 rounded-lg font-bold">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                            @csrf @method('DELETE')
                                            <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold">
                                                Hapus
                                            </button>
                                            {{-- Modal konfirmasi hapus user (komponen Alpine) --}}
                                            <x-confirm-delete-modal entity-name="{{ $user->name }}" entity-type="user" />
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Kondisi saat belum ada donatur terdaftar --}}
                            <tr>
                                <td colspan="5">
                                    <div class="py-16 text-center">
                                        <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <p class="font-extrabold text-base-content">Belum ada donatur terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Navigasi paginasi tabel donatur (muncul jika lebih dari satu halaman) --}}
            @if($donaturs->hasPages())
                <div class="p-4 border-t border-base-200">
                    {{ $donaturs->links() }}
                </div>
            @endif
        </div>

        {{-- Admin table --}}
        {{-- -----------------------------------------------------------
            TABEL ADMIN
            Kolom: Nama, Email, Status verifikasi, dan Aksi (hanya Edit).
            forelse: perulangan data admin; jika kosong tampil pesan
            "Belum ada admin". Tidak ada aksi hapus untuk admin.
        ----------------------------------------------------------- --}}
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                </div>
                <div>
                    <p class="font-extrabold text-sm text-base-content">Admin</p>
                    <p class="text-xs text-base-content/50">Total: {{ $admins->count() }} akun</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-200/50">
                            <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Nama</th>
                            <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Email</th>
                            <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Status</th>
                            <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200/60">
                        @forelse($admins as $user)
                            <tr class="hover:bg-base-200/30 transition-colors">
                                <td>
                                    <div class="flex items-center gap-3">
                                        {{-- Avatar admin selalu placeholder ui-avatars --}}
                                        <div class="avatar">
                                            <div class="w-9 rounded-full">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=7c3aed&color=ffffff&bold=true" alt="">
                                            </div>
                                        </div>
                                        <span class="font-bold text-sm text-base-content whitespace-nowrap">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="text-sm text-base-content/60 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="text-center whitespace-nowrap">
                                    {{-- Badge status verifikasi email admin --}}
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Belum Verifikasi
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center whitespace-nowrap">
                                    {{-- Tombol aksi edit menuju halaman edit user --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-ghost text-base-content/50 hover:text-warning hover:bg-warning/5 rounded-lg font-bold">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            {{-- Kondisi saat belum ada admin --}}
                            <tr>
                                <td colspan="4">
                                    <div class="py-16 text-center">
                                        <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                                        </div>
                                        <p class="font-extrabold text-base-content">Belum ada admin</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</x-admin-layout>
