<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Edit Laporan Perkembangan
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-lg">📈</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Edit Laporan Perkembangan</h3>
                        <p class="text-white/80 text-sm">Perbarui laporan yang sudah ada</p>
                    </div>
                </div>

                <div class="card-body p-8">
                    <form action="{{ route('admin.child-developments.update', $development->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Anak Asuh</span>
                            </label>
                            <div class="flex items-center gap-2 p-3 bg-emerald-100 border border-emerald-300 rounded-xl text-emerald-700 font-bold">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                {{ $development->fosterChild->name ?? '-' }}
                            </div>
                            <p class="text-xs text-emerald-500 mt-1">Anak asuh tidak dapat diubah saat edit. Hapus laporan dan buat baru jika salah pilih.</p>
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Tanggal Laporan</span>
                            </label>
                            <input type="date" name="tanggal" class="input input-bordered w-full" required
                                   value="{{ old('tanggal', $development->tanggal->format('Y-m-d')) }}">
                            @error('tanggal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Judul Laporan</span>
                            </label>
                            <input type="text" name="judul" class="input input-bordered w-full" required
                                   value="{{ old('judul', $development->judul) }}"
                                   placeholder="Contoh: Naik ke Kelas 5, Nilai Rapor Membaik">
                            @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="divider"></div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Deskripsi Perkembangan</span>
                            </label>
                            <textarea name="deskripsi" rows="6" class="textarea textarea-bordered w-full" required
                                      placeholder="Ceritakan perkembangan anak...">{{ old('deskripsi', $development->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Foto <span class="font-normal normal-case text-emerald-400">(Opsional, Maks. 3MB)</span></span>
                            </label>
                            <input type="file" name="foto" id="photo-input" accept="image/*" class="file-input file-input-bordered w-full">
                            <p class="text-xs text-emerald-500 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                            @if($development->foto)
                                <img src="{{ asset('storage/' . $development->foto) }}" class="mt-2 max-h-48 rounded-lg border border-emerald-200" alt="Foto saat ini">
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
</x-app-layout>
