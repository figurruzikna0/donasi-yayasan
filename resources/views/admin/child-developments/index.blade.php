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
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Laporan Perkembangan Anak Asuh</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Catat update berkala untuk anak yang sedang disponsori orang tua asuh</p>
                </div>
                <a href="{{ route('admin.child-developments.create') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-4 h-4"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah Laporan
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12 space-y-6">

        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-50/80 border-b border-base-200">
                            <th class="py-3 px-4 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 whitespace-nowrap">Foto</th>
                            <th class="py-3 px-4 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 whitespace-nowrap">Judul &amp; Anak Asuh</th>
                            <th class="py-3 px-4 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 whitespace-nowrap">Tanggal</th>
                            <th class="py-3 px-4 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 whitespace-nowrap">Dibuat Oleh</th>
                            <th class="py-3 px-4 text-[0.6rem] uppercase tracking-widest font-bold text-base-content/40 whitespace-nowrap text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-100">
                        @forelse($developments as $item)
                            <tr class="hover:bg-emerald-50/40 transition-colors duration-150">
                                <td class="py-3 px-4 whitespace-nowrap">
                                    @if($item->foto)
                                        <div class="avatar">
                                            <div class="w-10 h-10 rounded-xl ring-2 ring-base-200">
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="object-cover">
                                            </div>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-xl bg-base-100 flex items-center justify-center ring-2 ring-base-200">
                                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-base-content/30" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="font-bold text-sm text-base-content whitespace-nowrap">{{ Str::limit($item->judul, 40) }}</span>
                                    <div class="mt-1">
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-emerald-100 text-emerald-700 whitespace-nowrap">
                                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            {{ $item->fosterChild->name ?? '-' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-base-content/60">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-base-content/30" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $item->tanggal->translatedFormat('d M Y') }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <span class="text-sm font-semibold text-base-content/60 flex items-center gap-1.5">
                                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-base-content/30" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        {{ $item->user->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('admin.child-developments.show', $item->id) }}" class="btn btn-ghost btn-xs text-base-content/50 hover:text-primary hover:bg-primary/5 rounded-lg font-bold gap-1">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/></svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.child-developments.edit', $item->id) }}" class="btn btn-ghost btn-xs text-base-content/50 hover:text-amber-600 hover:bg-amber-50 rounded-lg font-bold gap-1">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.child-developments.destroy', $item->id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                            @csrf @method('DELETE')
                                            <button type="button" @click="open = true" class="btn btn-ghost btn-xs text-base-content/50 hover:text-rose-600 hover:bg-rose-50 rounded-lg font-bold gap-1">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                Hapus
                                            </button>
                                            <x-confirm-delete-modal entity-name="{{ $item->judul }}" entity-type="laporan perkembangan" />
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="py-16 text-center">
                                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center mx-auto mb-4 shadow-inner">
                                            <svg class="w-9 h-9 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                                        </div>
                                        <p class="font-black text-base-content text-lg">Belum ada laporan perkembangan</p>
                                        <p class="text-sm text-base-content/50 mt-1">Mulai dengan menambahkan laporan untuk anak yang sedang disponsori.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($developments->hasPages())
                <div class="p-4 border-t border-base-200 flex justify-center">
                    {{ $developments->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
</x-admin-layout>
