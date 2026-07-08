<x-admin-layout>
    <div class="bg-base-200 min-h-screen">

        {{-- Page header --}}
        <div class="px-8 pt-8 pb-0">
            <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Kelola Data Pendiri Yayasan</h1>
                            <p class="text-sm text-base-content/50">Kelola data pendiri yayasan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            @if(session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Add form card --}}
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-6 h-fit">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">➕</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Tambah Pendiri Baru</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.pendiri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-base-content/70 text-xs">Nama Lengkap</span>
                            </label>
                            <input type="text" name="nama" class="input input-bordered w-full input-sm" required>
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-base-content/70 text-xs">Jabatan</span>
                            </label>
                            <input type="text" name="jabatan" class="input input-bordered w-full input-sm" required>
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-base-content/70 text-xs">Kata Sambutan / Deskripsi</span>
                            </label>
                            <textarea name="deskripsi" rows="3" class="textarea textarea-bordered w-full text-sm" placeholder="Tulis visi atau kata sambutan pendiri..."></textarea>
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-base-content/70 text-xs">Foto Pendiri</span>
                            </label>
                            <input type="file" name="foto" class="file-input file-input-bordered w-full input-sm" required>
                        </div>

                        <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 w-full font-bold rounded-lg">
                            Simpan Data Pendiri
                        </button>
                    </form>
                </div>

                {{-- List card --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">👥</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Daftar Pendiri</p>
                            <p class="text-xs text-base-content/50">Seluruh data pendiri yayasan</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr class="bg-base-200/50">
                                    <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Foto</th>
                                    <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Profil</th>
                                    <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendiris as $pendiri)
                                    <tr class="hover:bg-base-200/30 transition-colors">
                                        <td>
                                            @if($pendiri->foto)
                                                <div class="avatar">
                                                    <div class="w-12 h-12 rounded-lg ring ring-base-300 ring-offset-1">
                                                        <img src="{{ asset('storage/' . $pendiri->foto) }}" alt="Foto {{ $pendiri->nama }}" class="object-cover">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary font-extrabold text-lg flex items-center justify-center ring ring-base-300">{{ strtoupper(substr($pendiri->nama, 0, 1)) }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="font-bold text-sm text-base-content">{{ $pendiri->nama }}</div>
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-primary/5 text-primary border border-primary/20 mt-1">{{ $pendiri->jabatan }}</span>
                                            <p class="text-sm text-base-content/50 mt-2 italic line-clamp-3">
                                                "{{ $pendiri->deskripsi ?? 'Belum ada kata sambutan.' }}"
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.pendiri.destroy', $pendiri->id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                @csrf @method('DELETE')
                                                <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold mt-2">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    Hapus
                                                </button>
                                                <x-confirm-delete-modal entity-name="{{ $pendiri->nama }}" entity-type="pengurus" />
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <div class="py-16 text-center">
                                                <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                    <svg class="w-8 h-8 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857"/></svg>
                                                </div>
                                                <p class="font-extrabold text-base-content">Belum ada data pendiri</p>
                                                <p class="text-sm text-base-content/50 mt-1">Tambahkan data pendiri yayasan menggunakan form di samping.</p>
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
    </div>
</x-admin-layout>
