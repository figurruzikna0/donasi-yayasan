<x-admin-layout>
    <div class="bg-base-200 min-h-screen">

        <div class="px-8 pt-8 pb-0">
            <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Data Seluruh User</h1>
                            <p class="text-sm text-base-content/50">Kelola data donatur dan admin yang terdaftar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            {{-- STAT CARDS: ringkasan total donatur, admin, dan user terverifikasi — data dari $donaturs & $admins --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Donatur</p>
                        <p class="text-2xl font-black text-base-content">{{ $donaturs->total() }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                    </div>
                    <div>
                        <p class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Admin</p>
                        <p class="text-2xl font-black text-base-content">{{ $admins->count() }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Terverifikasi</p>
                        <p class="text-2xl font-black text-base-content">{{ $donaturs->where('email_verified_at', '!=', null)->count() + $admins->where('email_verified_at', '!=', null)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p class="font-extrabold text-sm text-base-content">Donatur Terdaftar</p>
                        <p class="text-xs text-base-content/50">Total: {{ $donaturs->total() }} akun</p>
                    </div>
                </div>
                {{-- TABEL DONATUR: daftar donatur, bisa edit (admin.users.edit) & hapus (admin.users.destroy) --}}
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="w-[180px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nama</th>
                                <th class="w-[200px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Email</th>
                                <th class="w-[130px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">No. HP</th>
                                <th class="w-[130px] text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                <th class="w-[110px] text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-200/60">
                            @forelse($donaturs as $user)
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="w-9 rounded-full ring ring-base-300 ring-offset-1">
                                                    @if($user->avatar)
                                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="object-cover">
                                                    @else
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=b3e093&color=5c8148&bold=true" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="font-bold text-sm text-base-content">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-sm text-base-content/60">{{ $user->email }}</td>
                                    <td class="text-sm text-base-content/60">{{ $user->phone ?? '-' }}</td>
                                    <td class="text-center">
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
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-ghost text-base-content/50 hover:text-warning hover:bg-warning/5 rounded-lg font-bold">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                @csrf @method('DELETE')
                                                <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    Hapus
                                                </button>
                                                <x-confirm-delete-modal entity-name="{{ $user->name }}" entity-type="user" />
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
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
                @if($donaturs->hasPages())
                    <div class="p-4 border-t border-base-200">
                        {{ $donaturs->links() }}
                    </div>
                @endif
            </div>

            {{-- TABEL ADMIN: daftar admin, bisa edit (admin.users.edit) — data dari $admins --}}
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
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
                                <th class="w-[180px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nama</th>
                                <th class="w-[200px] text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Email</th>
                                <th class="w-[130px] text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                <th class="w-[110px] text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-200/60">
                            @forelse($admins as $user)
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="w-9 rounded-full">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=7c3aed&color=ffffff&bold=true" alt="">
                                                </div>
                                            </div>
                                            <span class="font-bold text-sm text-base-content">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-sm text-base-content/60">{{ $user->email }}</td>
                                    <td class="text-center">
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
                                    <td class="text-center">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-ghost text-base-content/50 hover:text-warning hover:bg-warning/5 rounded-lg font-bold">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
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
