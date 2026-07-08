<x-admin-layout>
    <x-admin-form-card
        icon='<svg viewBox="0 0 24 24" fill="white" class="w-5 h-5"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'
        title="Edit Data Profil"
        subtitle="Perbarui informasi, visi misi, dan berkas resmi yayasan"
    >
                    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        {{-- Baris 1: Nama, Email, Telp --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700 uppercase text-xs">Nama Yayasan</span></label>
                                <input type="text" name="nama_yayasan" class="input input-bordered w-full" required
                                       value="{{ old('nama_yayasan', $profil?->nama_yayasan) }}" placeholder="Baitul Yatim...">
                                @error('nama_yayasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700 uppercase text-xs">Email Resmi</span></label>
                                <input type="email" name="email" class="input input-bordered w-full" required
                                       value="{{ old('email', $profil?->email) }}" placeholder="info@yayasan.id">
                                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700 uppercase text-xs">No. Telepon / WhatsApp</span></label>
                                <input type="text" name="no_telp" class="input input-bordered w-full" required
                                       value="{{ old('no_telp', $profil?->no_telp) }}" placeholder="08xx-xxxx-xxxx">
                                @error('no_telp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-bold text-emerald-700 uppercase text-xs">Alamat Lengkap Kantor</span></label>
                            <textarea name="alamat" rows="2" class="textarea textarea-bordered w-full" required placeholder="Jl. ...">{{ old('alamat', $profil?->alamat) }}</textarea>
                            @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Sejarah --}}
                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-bold text-emerald-700 uppercase text-xs">Sejarah / Deskripsi Yayasan</span></label>
                            <textarea name="sejarah_yayasan" rows="4" class="textarea textarea-bordered w-full" required placeholder="Ceritakan latar belakang dan perjalanan yayasan...">{{ old('sejarah_yayasan', $profil?->sejarah_yayasan) }}</textarea>
                            @error('sejarah_yayasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Visi & Misi --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700 uppercase text-xs">Visi</span></label>
                                <textarea name="visi" rows="3" class="textarea textarea-bordered w-full" required placeholder="Visi jangka panjang yayasan...">{{ old('visi', $profil?->visi) }}</textarea>
                                @error('visi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700 uppercase text-xs">Misi</span></label>
                                <textarea name="misi" rows="3" class="textarea textarea-bordered w-full" required placeholder="Langkah-langkah konkret yayasan...">{{ old('misi', $profil?->misi) }}</textarea>
                                @error('misi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="divider my-6"></div>

                        {{-- Upload Berkas --}}
                        <span class="font-bold text-emerald-700 uppercase text-xs block mb-4">Upload Berkas &amp; Gambar</span>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Legalitas --}}
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700 uppercase text-xs">Surat Legalitas <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" id="legal-label">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span id="legal-text" class="text-sm text-emerald-600 font-semibold">Pilih foto legalitas...</span>
                                    </label>
                                    <input type="file" name="foto_legalitas" id="legal-input" accept="image/*" class="hidden">
                                </div>
                                <p class="text-xs text-emerald-400 mt-1">Foto SK / Akta Notaris</p>
                                @if($profil?->foto_legalitas)
                                    <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" class="mt-2 max-h-20 rounded-lg border border-emerald-200">
                                @endif
                                @error('foto_legalitas') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Struktur --}}
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700 uppercase text-xs">Struktur Pengurus <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" id="struktur-label">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span id="struktur-text" class="text-sm text-emerald-600 font-semibold">Pilih foto struktur...</span>
                                    </label>
                                    <input type="file" name="foto_struktur" id="struktur-input" accept="image/*" class="hidden">
                                </div>
                                <p class="text-xs text-emerald-400 mt-1">Bagan / foto bersama pengurus</p>
                                @if($profil?->foto_struktur)
                                    <img src="{{ asset('storage/' . $profil->foto_struktur) }}" class="mt-2 max-h-20 rounded-lg border border-emerald-200">
                                @endif
                                @error('foto_struktur') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="divider my-6"></div>

                        {{-- Actions --}}
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
    </x-admin-form-card>

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
