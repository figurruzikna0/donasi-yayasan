<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            {{ __('Edit Kampanye') }}
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Edit Kampanye</h3>
                        <p class="text-white/80 text-sm">{{ $campaign->title }}</p>
                    </div>
                </div>

                <div class="card-body p-8">

                    @if($errors->any())
                        <div class="alert alert-error mb-5">
                            <ul class="list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Judul Kampanye</span>
                            </label>
                            <input type="text" name="title"
                                   value="{{ old('title', $campaign->title) }}"
                                   required class="input input-bordered w-full"
                                   placeholder="Judul kampanye...">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Deskripsi</span>
                            </label>
                            <textarea name="description" rows="5"
                                      required class="textarea textarea-bordered w-full"
                                      placeholder="Jelaskan tujuan dan manfaat kampanye ini...">{{ old('description', $campaign->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Target Dana (Rp)</span>
                            </label>
                            <input type="number" name="target_amount"
                                   value="{{ old('target_amount', $campaign->target_amount) }}"
                                   required class="input input-bordered w-full" min="1"
                                   placeholder="5000000">
                            @error('target_amount')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="divider"></div>

                        <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block mb-3">Foto Kampanye</span>

                        @if($campaign->image)
                            <div class="flex items-start gap-3 p-3 bg-emerald-50 border border-emerald-200 rounded-lg mb-4">
                                <img src="{{ asset('storage/' . $campaign->image) }}" alt="Foto saat ini" class="w-24 h-16 object-cover rounded border border-emerald-200">
                                <div>
                                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block">Foto saat ini</span>
                                    <span class="text-xs text-emerald-400">Upload foto baru di bawah untuk mengganti.</span>
                                </div>
                            </div>
                        @endif

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Ganti Foto <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span>
                            </label>
                            <div class="file-input-wrapper">
                                <label class="file-input-label" id="image-label">
                                    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span id="image-text">Pilih foto baru...</span>
                                </label>
                                <input type="file" name="image" id="image-input"
                                       accept="image/*" class="hidden-file">
                            </div>
                            <p class="text-xs text-emerald-500 mt-1">PNG, JPG, atau WEBP · Biarkan kosong jika tidak ingin ganti.</p>
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="divider"></div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline">
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
        document.getElementById('image-input').addEventListener('change', function () {
            const span = document.getElementById('image-text');
            span.textContent = this.files.length > 0 ? this.files[0].name : 'Pilih foto baru...';
        });
    </script>

</x-app-layout>
