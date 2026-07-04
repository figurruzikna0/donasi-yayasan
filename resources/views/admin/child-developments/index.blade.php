<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Perkembangan Anak Asuh
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-md border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-4 flex items-center justify-between gap-3 flex-wrap">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center text-lg">📈</div>
                        <div>
                            <h3 class="text-white font-extrabold text-sm">Laporan Perkembangan Anak Asuh</h3>
                            <p class="text-white/78 text-xs">Catat update berkala untuk anak yang sedang disponsori orang tua asuh</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.child-developments.create') }}" class="btn btn-success btn-sm">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Tambah Laporan
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mx-6 mt-5">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error mx-6 mt-5">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th class="w-[76px]">Foto</th>
                                <th>Judul & Anak Asuh</th>
                                <th>Tanggal</th>
                                <th>Dibuat Oleh</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($developments as $item)
                                <tr>
                                    <td>
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-14 h-14 object-cover rounded border border-emerald-200">
                                        @else
                                            <div class="w-14 h-14 bg-emerald-200 rounded flex items-center justify-center">
                                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" class="stroke-emerald-700 opacity-50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                                    <path d="m21 15-5-5L5 21"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="font-bold text-emerald-700 max-w-[280px]">
                                            {{ Str::limit($item->judul, 55) }}
                                        </div>
                                        <span class="badge badge-ghost badge-sm mt-1">{{ $item->fosterChild->name ?? '-' }}</span>
                                    </td>
                                    <td class="whitespace-nowrap text-emerald-500">
                                        {{ $item->tanggal->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="text-emerald-500">
                                        {{ $item->user->name ?? '-' }}
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.child-developments.show', $item->id) }}" class="btn btn-sm btn-ghost text-emerald-600">
                                                👁 Detail
                                            </a>
                                            <a href="{{ route('admin.child-developments.edit', $item->id) }}" class="btn btn-sm btn-ghost">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.child-developments.destroy', $item->id) }}" method="POST"
                                                  x-data="{ open: false }" @submit.prevent="open = true">
                                                @csrf @method('DELETE')
                                                <button type="button" @click="open = true" class="btn btn-sm btn-error">
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                                                        <polyline points="3 6 5 6 21 6"/>
                                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                        <path d="M10 11v6M14 11v6"/>
                                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                                    <dialog class="modal" :class="{ 'modal-open': open }">
                                                        <div class="modal-box"><h3 class="font-bold text-lg">Konfirmasi Hapus</h3><p class="py-4">Hapus laporan '{{ $item->judul }}'?</p>
                                                            <div class="modal-action">
                                                                <button type="button" @click="open = false" class="btn btn-ghost">Batal</button>
                                                                <button @click="open = false; $el.closest('form').submit()" class="btn btn-error">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </dialog>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-16">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-14 h-14 bg-emerald-200 rounded-xl flex items-center justify-center mx-auto">
                                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" class="stroke-emerald-700" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                                    <circle cx="9" cy="7" r="4"/>
                                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                                </svg>
                                            </div>
                                            <p class="font-bold text-emerald-700">Belum ada laporan perkembangan</p>
                                            <p class="text-sm text-emerald-500">Mulai dengan menambahkan laporan untuk anak yang sedang disponsori.</p>
                                            <a href="{{ route('admin.child-developments.create') }}" class="btn btn-success btn-sm mt-1">
                                                + Tambah Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($developments->hasPages())
                    <div class="p-4 border-t border-emerald-100">
                        {{ $developments->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
