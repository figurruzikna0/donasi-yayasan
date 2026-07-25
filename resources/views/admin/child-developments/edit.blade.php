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
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Edit Laporan Perkembangan</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Perbarui laporan perkembangan yang sudah ada</p>
                </div>
                <a href="{{ route('admin.child-developments.index') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-4 h-4"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12">

        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="px-8 py-6">
                <form action="{{ route('admin.child-developments.update', $development->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-bold text-base-content">Anak Asuh</span>
                        </label>
                        <div class="flex items-center gap-2 p-3 bg-base-200 border border-base-300 rounded-xl text-base-content font-bold">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            {{ $development->fosterChild->name ?? '-' }}
                        </div>
                        <p class="text-xs text-base-content/40 mt-1">Anak asuh tidak dapat diubah saat edit. Hapus laporan dan buat baru jika salah pilih.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-base-content">Tanggal Laporan</span>
                            </label>
                            <input type="date" name="tanggal" class="input input-bordered w-full" required
                                   value="{{ old('tanggal', $development->tanggal->format('Y-m-d')) }}">
                            @error('tanggal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-base-content">Judul Laporan</span>
                            </label>
                            <input type="text" name="judul" class="input input-bordered w-full" required
                                   value="{{ old('judul', $development->judul) }}"
                                   placeholder="Contoh: Naik ke Kelas 5, Nilai Rapor Membaik">
                            @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-bold text-base-content">Deskripsi Perkembangan</span>
                        </label>
                        <textarea name="deskripsi" rows="6" class="textarea textarea-bordered w-full" required
                                  placeholder="Ceritakan perkembangan anak...">{{ old('deskripsi', $development->deskripsi) }}</textarea>
                        @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-bold text-base-content">Foto <span class="font-normal normal-case text-base-content/40">(Opsional, Maks. 3MB)</span></span>
                        </label>
                        <input type="file" name="foto" id="photo-input" accept="image/*" class="file-input file-input-bordered w-full">
                        <p class="text-xs text-base-content/40 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                        @if($development->foto)
                            <img src="{{ asset('storage/' . $development->foto) }}" class="mt-2 max-h-48 rounded-lg border border-base-300" alt="Foto saat ini">
                        @endif
                        @error('foto') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="divider"></div>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.child-developments.index') }}" class="btn btn-outline">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 12H5M12 5l-7 7 7 7"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/>
                                <polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
</x-admin-layout>
