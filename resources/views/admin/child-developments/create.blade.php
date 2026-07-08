<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Tambah Laporan Perkembangan
        </h2>
    </x-slot>

    <x-admin-form-card
        icon="📈"
        title="Tambah Laporan Perkembangan"
        subtitle="Catat perkembangan terbaru anak asuh"
    >
                    <form action="{{ route('admin.child-developments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Pilih Anak Asuh</span>
                            </label>
                            <select name="foster_child_id" class="select select-bordered w-full" required>
                                <option value="">— Pilih anak asuh yang sedang disponsori —</option>
                                @foreach($children as $child)
                                    <option value="{{ $child->id }}" @selected(old('foster_child_id') == $child->id)>
                                        {{ $child->name }} ({{ $child->age }} tahun)
                                    </option>
                                @endforeach
                            </select>
                            @error('foster_child_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            <p class="text-xs text-emerald-500 mt-1">Hanya anak yang memiliki sponsorship aktif yang muncul di daftar ini.</p>
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Tanggal Laporan</span>
                            </label>
                            <input type="date" name="tanggal" class="input input-bordered w-full" required
                                   value="{{ old('tanggal', date('Y-m-d')) }}">
                            @error('tanggal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Judul Laporan</span>
                            </label>
                            <input type="text" name="judul" class="input input-bordered w-full" required
                                   value="{{ old('judul') }}"
                                   placeholder="Contoh: Naik ke Kelas 5, Nilai Rapor Membaik">
                            @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="divider"></div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Deskripsi Perkembangan</span>
                            </label>
                            <textarea name="deskripsi" rows="6" class="textarea textarea-bordered w-full" required
                                      placeholder="Ceritakan perkembangan anak: akademik, kesehatan, sikap, atau hal lain yang relevan untuk orang tua asuh ketahui...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Foto <span class="font-normal normal-case text-emerald-400">(Opsional, Maks. 3MB)</span></span>
                            </label>
                            <div class="file-input-wrapper">
                                <label class="file-input-label" id="file-label">
                                    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span id="file-label-text">Pilih foto untuk diunggah...</span>
                                </label>
                                <input type="file" name="foto" id="photo-input" accept="image/*" class="hidden-file">
                            </div>
                            <p class="text-xs text-emerald-500 mt-1">Format: JPG, PNG, WEBP</p>
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
                                Simpan Laporan
                            </button>
                        </div>

                    </form>
    </x-admin-form-card>

    <style>
        .file-input-wrapper { position: relative; }
        .file-input-label {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px;
            border: 1.5px dashed oklch(var(--bc)/0.3);
            border-radius: 10px;
            background: oklch(var(--b2)/0.5);
            cursor: pointer;
            font-size: 0.88rem;
            font-weight: 600;
            transition: border-color 0.2s, background 0.2s;
        }
        .file-input-label:hover { border-color: oklch(var(--p)); background: oklch(var(--p)/0.1); }
        input[type="file"].hidden-file {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
    </style>

    <script>
        document.getElementById('photo-input').addEventListener('change', function () {
            const labelText = document.getElementById('file-label-text');
            labelText.textContent = this.files.length > 0 ? this.files[0].name : 'Pilih foto untuk diunggah...';
        });
    </script>
</x-admin-layout>
