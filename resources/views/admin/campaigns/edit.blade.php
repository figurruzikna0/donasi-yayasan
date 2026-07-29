<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.12),transparent_70%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,rgba(16,185,129,0.2),transparent_60%)]"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <div class="flex items-center gap-2.5 mb-1">
                        <span class="w-8 h-0.5 rounded-full bg-emerald-300/60"></span>
                        <span class="text-emerald-200/80 text-xs font-bold uppercase tracking-widest">Konten</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Edit Kampanye</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Perbarui detail kampanye donasi</p>
                </div>
                <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-4 h-4"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12">

        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="px-8 py-6">
                @if($errors->any())
                    <x-alert type="error" :errors="$errors->all()" />
                @endif

                <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-bold text-base-content">Judul Kampanye</span>
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
                            <span class="label-text font-bold text-base-content">Deskripsi</span>
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
                            <span class="label-text font-bold text-base-content">Target Dana (Rp)</span>
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

                    <p class="font-bold text-base-content mb-3">Foto Kampanye</p>

                    @if($campaign->image)
                        <div class="flex items-start gap-3 p-3 bg-base-200 border border-base-200 rounded-lg mb-4">
                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="Foto saat ini" class="w-24 h-16 object-cover rounded border border-base-300">
                            <div>
                                <span class="text-xs font-bold text-base-content/70">Foto saat ini</span>
                                <span class="text-xs text-base-content/40 block">Upload foto baru di bawah untuk mengganti.</span>
                            </div>
                        </div>
                    @endif

                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-bold text-base-content">Ganti Foto <span class="font-normal normal-case text-base-content/40">(Opsional)</span></span>
                        </label>
                        <div class="file-input-wrapper">
                            <label class="file-input-label" id="image-label">
                                <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-current text-base-content/40">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span id="image-text" class="text-base-content/50">Pilih foto baru...</span>
                            </label>
                            <input type="file" name="image" id="image-input"
                                   accept="image/*" class="hidden-file">
                        </div>
                        <p class="text-xs text-base-content/40 mt-1">PNG, JPG, atau WEBP · Biarkan kosong jika tidak ingin ganti.</p>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-bold text-base-content">Status Kampanye</span>
                        </label>
                        <select name="status" class="select select-bordered w-full">
                            <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="completed" {{ old('status', $campaign->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')
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
</x-admin-layout>
