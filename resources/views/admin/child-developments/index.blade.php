<x-admin-layout>
    <div class="bg-base-200 min-h-screen">

        {{-- Page header --}}
        <div class="px-8 pt-8 pb-0">
            <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Laporan Perkembangan Anak Asuh</h1>
                            <p class="text-sm text-base-content/50">Catat update berkala untuk anak yang sedang disponsori orang tua asuh.</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.child-developments.create') }}" class="btn bg-primary hover:bg-primary/90 text-white border-0 font-bold shadow-sm rounded-lg gap-2">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah Laporan
                </a>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            {{-- Table Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-lg shrink-0">📈</div>
                    <div>
                        <p class="font-extrabold text-sm text-base-content">Daftar Laporan Perkembangan</p>
                        <p class="text-xs text-base-content/50">Catatan perkembangan untuk anak asuh</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Foto</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Judul &amp; Anak Asuh</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Tanggal</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Dibuat Oleh</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($developments as $item)
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <td>
                                        @if($item->foto)
                                            <div class="avatar">
                                                <div class="w-12 h-12 rounded-lg ring ring-base-300 ring-offset-1">
                                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="object-cover">
                                                </div>
                                            </div>
                                        @else
                                            <div class="w-12 h-12 rounded-lg bg-base-200 flex items-center justify-center ring ring-base-300">
                                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-base-content/30" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="font-bold text-sm text-base-content">{{ Str::limit($item->judul, 55) }}</span>
                                        <div class="mt-1">
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-primary/5 text-primary border border-primary/20">
                                                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                {{ $item->fosterChild->name ?? '-' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-base-content/60">
                                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-base-content/30" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            {{ $item->tanggal->translatedFormat('d M Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-semibold text-base-content/60 flex items-center gap-1.5">
                                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-base-content/30" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            {{ $item->user->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('admin.child-developments.show', $item->id) }}" class="btn btn-sm btn-ghost text-base-content/50 hover:text-primary hover:bg-primary/5 rounded-lg font-bold">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/></svg>
                                                Detail
                                            </a>
                                            <a href="{{ route('admin.child-developments.edit', $item->id) }}" class="btn btn-sm btn-ghost text-base-content/50 hover:text-warning hover:bg-warning/5 rounded-lg font-bold">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.child-developments.destroy', $item->id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                @csrf @method('DELETE')
                                                <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
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
                                            <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                                            </div>
                                            <p class="font-extrabold text-base-content">Belum ada laporan perkembangan</p>
                                            <p class="text-sm text-base-content/50 mt-1">Mulai dengan menambahkan laporan untuk anak yang sedang disponsori.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($developments->hasPages())
                    <div class="p-4 border-t border-base-200">
                        {{ $developments->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-admin-layout>
