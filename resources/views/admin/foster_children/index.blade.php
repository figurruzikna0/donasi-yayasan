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
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Kelola Data Anak Asuh</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Pantau dan kelola daftar seluruh anak asuh yayasan</p>
                </div>
                <a href="{{ route('admin.foster-children.create') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-4 h-4"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah Anak Asuh
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-12 space-y-6">

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 max-sm:grid-cols-1">
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Total Anak Asuh</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $allChildren->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center text-white shadow-lg shadow-sky-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 3h5m0 0v5m0-5l-6 6M12 12a5 5 0 100-10 5 5 0 000 10zm0 0v9"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Laki-laki</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $allChildren->where('jenis_kelamin', 'Laki-laki')->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-pink-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white shadow-lg shadow-pink-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14a5 5 0 100-10 5 5 0 000 10zm0 0v4m-3 2h6"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Perempuan</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $allChildren->where('jenis_kelamin', 'Perempuan')->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="relative bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-6 overflow-hidden group hover:-translate-y-0.5 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-bl-[4rem] -mr-8 -mt-8 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-400 to-rose-600 flex items-center justify-center text-white shadow-lg shadow-rose-200 shrink-0">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base-content/50 text-[0.65rem] uppercase tracking-widest font-bold">Sedang Diasuh</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $allChildren->where('status', '!=', 'Tersedia')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-50/80 border-b border-base-200">
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Foto</th>
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Nama</th>
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Umur</th>
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Jenis Kelamin</th>
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40">Status</th>
                            <th class="py-4 px-6 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-100">
                        @forelse($children as $child)
                            <tr class="hover:bg-emerald-50/40 transition-colors duration-150 group">
                                <td class="py-4 px-6">
                                    @if($child->photo)
                                        <div class="avatar">
                                            <div class="w-11 h-11 rounded-xl ring-2 ring-base-200">
                                                <img src="{{ asset('storage/' . $child->photo) }}" alt="Foto {{ $child->name }}" class="object-cover">
                                            </div>
                                        </div>
                                    @else
                                        <div class="w-11 h-11 rounded-xl bg-base-100 flex items-center justify-center ring-2 ring-base-200">
                                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-base-content/30" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2.5">
                                        <span class="text-sm font-bold text-base-content">{{ $child->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-base-content/60">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-base-content/30" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $child->age }} Thn
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    @if($child->jenis_kelamin === 'Laki-laki')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-sky-100 text-sky-700">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 3h5m0 0v5m0-5l-6 6M12 12a5 5 0 100-10 5 5 0 000 10zm0 0v9"/></svg>
                                            Laki-laki
                                        </span>
                                    @elseif($child->jenis_kelamin === 'Perempuan')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-pink-100 text-pink-700">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14a5 5 0 100-10 5 5 0 000 10zm0 0v4m-3 2h6"/></svg>
                                            Perempuan
                                        </span>
                                    @else
                                        <span class="text-base-content/30 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    @php
                                        $sIcon = $child->status == 'Tersedia' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z';
                                        $sClass = $child->status == 'Tersedia' ? 'text-emerald-700 bg-emerald-100 border-emerald-200' : 'text-primary bg-primary/10 border-primary/20';
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $sClass }}">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $sIcon }}"/></svg>
                                        {{ $child->status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('admin.foster-children.show', $child->id) }}" class="btn btn-ghost btn-xs text-base-content/50 hover:text-primary hover:bg-primary/5 rounded-lg font-bold gap-1">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/></svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.foster-children.edit', $child->id) }}" class="btn btn-ghost btn-xs text-base-content/50 hover:text-amber-600 hover:bg-amber-50 rounded-lg font-bold gap-1">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.foster-children.destroy', $child->id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                            @csrf @method('DELETE')
                                            <button type="button" @click="open = true" class="btn btn-ghost btn-xs text-base-content/50 hover:text-rose-600 hover:bg-rose-50 rounded-lg font-bold gap-1">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                Hapus
                                            </button>
                                            <x-confirm-delete-modal entity-name="{{ $child->name }}" entity-type="anak asuh" />
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="py-16 text-center">
                                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                                            <svg class="w-9 h-9 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/></svg>
                                        </div>
                                        <p class="font-black text-base-content text-lg">Belum ada data anak asuh</p>
                                        <p class="text-sm text-base-content/50 mt-1">Mulai dengan menambahkan data anak asuh baru ke sistem.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($children->hasPages())
                <div class="p-4 border-t border-base-200 flex justify-center">
                    {{ $children->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
</x-admin-layout>
