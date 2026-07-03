<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            {{ __('Tambah Data Anak Asuh') }}
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <svg viewBox="0 0 24 24" class="w-5 h-5 fill-white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C8.5 2 5 4.5 5 9c0 3.5 2 6.5 5.5 8L12 22l1.5-5C17 15.5 19 12.5 19 9c0-4.5-3.5-7-7-7zm0 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Data Anak Asuh Baru</h3>
                        <p class="text-white/80 text-sm">Lengkapi informasi di bawah dengan teliti</p>
                    </div>
                </div>

                <div class="card-body p-8">
                    <form action="{{ route('admin.foster-children.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Nama Lengkap Anak</span>
                            </label>
                            <input type="text" name="name" required placeholder="Masukkan nama lengkap anak..." class="input input-bordered w-full" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Umur (Tahun)</span>
                            </label>
                            <input type="number" name="age" required min="0" max="100" placeholder="0" class="input input-bordered w-full max-w-[160px]" value="{{ old('age') }}">
                            @error('age')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Jenis Kelamin</span>
                            </label>
                            <select name="jenis_kelamin" required class="select select-bordered w-full max-w-[220px]">
                                <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="divider"></div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Cerita / Latar Belakang</span>
                            </label>
                            <textarea name="description" rows="5" placeholder="Tuliskan latar belakang singkat anak..." class="textarea textarea-bordered w-full">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Foto Anak <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span>
                            </label>
                            <div class="file-input-wrapper">
                                <label class="file-input-label" id="file-label">
                                    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span id="file-label-text">Pilih foto untuk diunggah...</span>
                                </label>
                                <input type="file" name="photo" id="photo-input" accept="image/*" class="hidden-file">
                            </div>
                            <p class="text-xs text-emerald-500 mt-1">Format: JPG, PNG, WEBP &mdash; Maks. 2 MB</p>
                            @error('photo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="divider"></div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.foster-children.index') }}" class="btn btn-outline">
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
                                Simpan Data
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

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
            if (this.files && this.files.length > 0) {
                labelText.textContent = this.files[0].name;
            } else {
                labelText.textContent = 'Pilih foto untuk diunggah...';
            }
        });
    </script>
</x-app-layout>
