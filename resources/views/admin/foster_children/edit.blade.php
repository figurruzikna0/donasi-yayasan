<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Edit Data Anak Asuh
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-lg">👦</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Edit Data Anak Asuh</h3>
                        <p class="text-white/80 text-sm">Perbarui informasi profil {{ $fosterChild->name }}</p>
                    </div>
                </div>

                <div class="card-body p-8">

                    @if($errors->any())
                        <div class="alert alert-error mb-5">
                            <p class="text-sm font-bold mb-1">Harap perbaiki kesalahan berikut:</p>
                            <ul class="list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.foster-children.update', $fosterChild->id) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Nama Lengkap</span>
                            </label>
                            <input type="text" name="name" class="input input-bordered w-full" required
                                   value="{{ old('name', $fosterChild->name) }}"
                                   placeholder="Nama lengkap anak asuh">
                            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Usia (Tahun)</span>
                            </label>
                            <input type="number" name="age" class="input input-bordered w-full max-w-[160px]" required
                                   min="0" max="25"
                                   value="{{ old('age', $fosterChild->age) }}">
                            @error('age') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Jenis Kelamin</span>
                            </label>
                            <div class="flex gap-3 flex-wrap">
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-emerald-200 bg-emerald-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-blue-50 has-[:checked]:text-blue-700 cursor-pointer transition-all">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" class="radio radio-sm"
                                           @checked(old('jenis_kelamin', $fosterChild->jenis_kelamin) === 'Laki-laki')>
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 3h5m0 0v5m0-5l-6 6M12 12a5 5 0 100-10 5 5 0 000 10zm0 0v9"/></svg>
                                    Laki-laki
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-emerald-200 bg-emerald-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-pink-50 has-[:checked]:text-pink-700 cursor-pointer transition-all">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" class="radio radio-sm"
                                           @checked(old('jenis_kelamin', $fosterChild->jenis_kelamin) === 'Perempuan')>
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14a5 5 0 100-10 5 5 0 000 10zm0 0v4m-3 2h6"/></svg>
                                    Perempuan
                                </label>
                            </div>
                            @error('jenis_kelamin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Cerita / Deskripsi Singkat</span>
                            </label>
                            <textarea name="description" rows="4" class="textarea textarea-bordered w-full"
                                      placeholder="Cerita singkat tentang anak asuh ini...">{{ old('description', $fosterChild->description) }}</textarea>
                            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="divider"></div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Status</span>
                            </label>
                            <div class="flex gap-3 flex-wrap">
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-emerald-200 bg-emerald-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-100 has-[:checked]:text-emerald-700 cursor-pointer transition-all">
                                    <input type="radio" name="status" value="Tersedia" class="radio radio-sm"
                                           @checked(old('status', $fosterChild->status ?? 'Tersedia') === 'Tersedia')>
                                    ● Tersedia
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-emerald-200 bg-emerald-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-gray-100 cursor-pointer transition-all">
                                    <input type="radio" name="status" value="Diasuh" class="radio radio-sm"
                                           @checked(old('status', $fosterChild->status) === 'Diasuh')>
                                    ✓ Sedang Diasuh
                                </label>
                            </div>
                            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Foto Profil <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span>
                            </label>
                            <div class="file-input-wrapper">
                                <label class="file-input-label" id="foto-label">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-emerald-500">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/>
                                    </svg>
                                    <span id="foto-label-text">Pilih foto baru…</span>
                                </label>
                                <input type="file" name="photo" id="foto-input" accept="image/*" class="hidden-file">
                            </div>
                            <p class="text-xs text-emerald-500 mt-1">JPG, PNG, WEBP — Maks 2MB</p>

                            @if($fosterChild->photo)
                                <p class="text-xs text-emerald-500 mt-2">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $fosterChild->photo) }}"
                                     alt="{{ $fosterChild->name }}" class="preview-img" id="preview-current">
                            @endif
                            <img id="preview-new" class="preview-img" style="display:none;" alt="Preview">
                            @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="divider"></div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.foster-children.index') }}" class="btn btn-outline">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
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
        .preview-img {
            margin-top: 10px; max-height: 160px; width: auto;
            object-fit: contain;
            border: 1.5px solid oklch(var(--p)/0.3);
            border-radius: 10px; padding: 4px;
            background: oklch(var(--b2)/0.5); display: block;
        }
    </style>

    <script>
        document.getElementById('foto-input').addEventListener('change', function () {
            const span      = document.getElementById('foto-label-text');
            const previewN  = document.getElementById('preview-new');
            const previewC  = document.getElementById('preview-current');

            if (this.files && this.files[0]) {
                span.textContent = this.files[0].name;
                const reader = new FileReader();
                reader.onload = e => {
                    previewN.src = e.target.result;
                    previewN.style.display = 'block';
                    if (previewC) previewC.style.display = 'none';
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                span.textContent = 'Pilih foto baru…';
                previewN.style.display = 'none';
                if (previewC) previewC.style.display = 'block';
            }
        });
    </script>
</x-app-layout>
