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
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Edit Data Profil</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Perbarui informasi, visi misi, dan berkas resmi yayasan</p>
                </div>
                <a href="{{ route('admin.profil.index') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-4 h-4"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12">

        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="px-8 py-6">
                <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-base-content">Nama Yayasan</span></label>
                            <input type="text" name="nama_yayasan" class="input input-bordered w-full" required
                                   value="{{ old('nama_yayasan', $profil?->nama_yayasan) }}" placeholder="Baitul Yatim...">
                            @error('nama_yayasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-base-content">Email Resmi</span></label>
                            <input type="email" name="email" class="input input-bordered w-full" required
                                   value="{{ old('email', $profil?->email) }}" placeholder="info@yayasan.id">
                            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-base-content">No. Telepon / WhatsApp</span></label>
                            <input type="text" name="no_telp" class="input input-bordered w-full" required
                                   value="{{ old('no_telp', $profil?->no_telp) }}" placeholder="08xx-xxxx-xxxx">
                            @error('no_telp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label"><span class="label-text font-bold text-base-content">Alamat Lengkap Kantor</span></label>
                        <textarea name="alamat" rows="2" class="textarea textarea-bordered w-full" required placeholder="Jl. ...">{{ old('alamat', $profil?->alamat) }}</textarea>
                        @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-control mt-4">
                        <label class="label"><span class="label-text font-bold text-base-content">Sejarah / Deskripsi Yayasan</span></label>
                        <textarea name="sejarah_yayasan" rows="4" class="textarea textarea-bordered w-full" required placeholder="Ceritakan latar belakang dan perjalanan yayasan...">{{ old('sejarah_yayasan', $profil?->sejarah_yayasan) }}</textarea>
                        @error('sejarah_yayasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-base-content">Visi</span></label>
                            <textarea name="visi" rows="3" class="textarea textarea-bordered w-full" required placeholder="Visi jangka panjang yayasan...">{{ old('visi', $profil?->visi) }}</textarea>
                            @error('visi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-base-content">Misi</span></label>
                            <textarea name="misi" rows="3" class="textarea textarea-bordered w-full" required placeholder="Langkah-langkah konkret yayasan...">{{ old('misi', $profil?->misi) }}</textarea>
                            @error('misi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="divider my-6"></div>

                    <p class="font-bold text-base-content mb-4">Upload Berkas &amp; Gambar</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-base-content">Surat Legalitas <span class="font-normal normal-case text-base-content/40">(Opsional)</span></span></label>
                            <div class="relative">
                                <label class="flex items-center gap-2 p-3 border-2 border-dashed border-base-300 rounded-xl bg-base-100 cursor-pointer hover:border-primary hover:bg-primary/5 transition-all" id="legal-label">
                                    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-current text-base-content/40"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    <span id="legal-text" class="text-sm text-base-content/60 font-semibold">Pilih foto legalitas...</span>
                                </label>
                                <input type="file" name="foto_legalitas" id="legal-input" accept="image/*" class="hidden">
                            </div>
                            <p class="text-xs text-base-content/40 mt-1">Foto SK / Akta Notaris</p>
                            @if($profil?->foto_legalitas)
                                <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" class="mt-2 max-h-20 rounded-lg border border-base-200">
                            @endif
                            @error('foto_legalitas') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-base-content">Struktur Pengurus <span class="font-normal normal-case text-base-content/40">(Opsional)</span></span></label>
                            <div class="relative">
                                <label class="flex items-center gap-2 p-3 border-2 border-dashed border-base-300 rounded-xl bg-base-100 cursor-pointer hover:border-primary hover:bg-primary/5 transition-all" id="struktur-label">
                                    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-current text-base-content/40"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    <span id="struktur-text" class="text-sm text-base-content/60 font-semibold">Pilih foto struktur...</span>
                                </label>
                                <input type="file" name="foto_struktur" id="struktur-input" accept="image/*" class="hidden">
                            </div>
                            <p class="text-xs text-base-content/40 mt-1">Bagan / foto bersama pengurus</p>
                            @if($profil?->foto_struktur)
                                <img src="{{ asset('storage/' . $profil->foto_struktur) }}" class="mt-2 max-h-20 rounded-lg border border-base-200">
                            @endif
                            @error('foto_struktur') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="divider my-6"></div>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.profil.index') }}" class="btn btn-outline">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function bindFile(inputId, textId) {
        document.getElementById(inputId).addEventListener('change', function () {
            const span = document.getElementById(textId);
            span.textContent = this.files.length > 0 ? this.files[0].name : span.dataset.default || span.textContent;
        });
    }
    bindFile('legal-input',    'legal-text');
    bindFile('struktur-input', 'struktur-text');
</script>
</x-admin-layout>
