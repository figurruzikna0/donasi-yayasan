<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Profil & Berkas Yayasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 p-6 sm:p-8 text-white">
                    <h1 class="text-2xl font-bold tracking-tight">⚙️ Edit Data Profil</h1>
                    <p class="text-emerald-100 text-sm mt-1">Kelola data informasi dasar, visi misi, surat legalitas resmi, dan bagan struktur organisasi.</p>
                </div>

                <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- Info Dasar --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Yayasan</label>
                            <input type="text" name="nama_yayasan" value="{{ old('nama_yayasan', $profil?->nama_yayasan) }}" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Resmi</label>
                            <input type="email" name="email" value="{{ old('email', $profil?->email) }}" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon / WhatsApp</label>
                            <input type="text" name="no_telp" value="{{ old('no_telp', $profil?->no_telp) }}" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Logo Utama</label>
                            <input type="file" name="logo" accept="image/*"
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            @if($profil?->logo)
                                <img src="{{ asset('storage/' . $profil->logo) }}" class="mt-2 h-12 w-12 rounded-full object-cover border border-emerald-200">
                            @endif
                        </div>
                    </div>

                    {{-- Tentang Kami (Sejarah, Visi, Misi, Alamat) --}}
                    <div class="space-y-6 border-t border-gray-100 pt-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap Kantor</label>
                            <textarea name="alamat" rows="2" required
                                      class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition shadow-sm">{{ old('alamat', $profil?->alamat) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Sejarah / Deskripsi Yayasan</label>
                            <textarea name="sejarah_yayasan" rows="5" required placeholder="Ceritakan bagaimana yayasan ini berdiri..."
                                      class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition shadow-sm">{{ old('sejarah_yayasan', $profil?->sejarah_yayasan) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Visi</label>
                                <textarea name="visi" rows="4" required placeholder="Tuliskan visi yayasan..."
                                          class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition shadow-sm">{{ old('visi', $profil?->visi) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Misi (Gunakan enter/bullet)</label>
                                <textarea name="misi" rows="4" required placeholder="Tuliskan misi yayasan..."
                                          class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition shadow-sm">{{ old('misi', $profil?->misi) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Berkas Visual --}}
                    <div class="space-y-6 border-t border-gray-100 pt-6">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">📂 Upload Berkas Visual</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-200/60 flex flex-col justify-between">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">📜 Foto Surat Legalitas Resmi</label>
                                    <span class="text-xs text-gray-400 block mb-3">Format JPG/PNG, Maks 2MB.</span>
                                    <input type="file" name="foto_legalitas" accept="image/*" class="text-sm text-gray-500 file:py-2 file:px-4 file:rounded-xl file:bg-white file:border file:border-gray-300 file:text-gray-700 w-full">
                                </div>
                                @if($profil?->foto_legalitas)
                                    <div class="mt-4 p-2 bg-white rounded-lg border">
                                        <span class="text-xs text-gray-400 block mb-1">Preview Berkas Saat Ini:</span>
                                        <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" class="max-h-40 w-auto mx-auto rounded object-contain">
                                    </div>
                                @endif
                            </div>

                            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-200/60 flex flex-col justify-between">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">📊 Foto Bagan Struktur Pengurus</label>
                                    <span class="text-xs text-gray-400 block mb-3">Format JPG/PNG, Maks 2MB.</span>
                                    <input type="file" name="foto_struktur" accept="image/*" class="text-sm text-gray-500 file:py-2 file:px-4 file:rounded-xl file:bg-white file:border file:border-gray-300 file:text-gray-700 w-full">
                                </div>
                                @if($profil?->foto_struktur)
                                    <div class="mt-4 p-2 bg-white rounded-lg border">
                                        <span class="text-xs text-gray-400 block mb-1">Preview Berkas Saat Ini:</span>
                                        <img src="{{ asset('storage/' . $profil->foto_struktur) }}" class="max-h-40 w-auto mx-auto rounded object-contain">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 border-t border-gray-100 pt-6">
                        <a href="{{ route('admin.profil.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-6 py-3 rounded-xl transition shadow-sm text-sm">
                            Batal
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold px-6 py-3 rounded-xl transition shadow-md hover:shadow-lg text-sm">
                            💾 Simpan Perubahan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>