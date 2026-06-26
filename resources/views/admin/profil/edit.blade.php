<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profil Yayasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <h3 class="text-lg font-bold text-gray-700">⚙️ Form Pengaturan Profil & Berkas</h3>
                </div>

                <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Baris 1: Nama, Email, Telp --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Yayasan</label>
                            <input type="text" name="nama_yayasan" value="{{ old('nama_yayasan', $profil?->nama_yayasan) }}" required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Resmi</label>
                            <input type="email" name="email" value="{{ old('email', $profil?->email) }}" required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon / WhatsApp</label>
                            <input type="text" name="no_telp" value="{{ old('no_telp', $profil?->no_telp) }}" required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    {{-- Baris 2: Alamat --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Kantor</label>
                        <textarea name="alamat" rows="2" required
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('alamat', $profil?->alamat) }}</textarea>
                    </div>

                    {{-- Baris 3: Sejarah --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sejarah / Deskripsi Yayasan</label>
                        <textarea name="sejarah_yayasan" rows="4" required
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('sejarah_yayasan', $profil?->sejarah_yayasan) }}</textarea>
                    </div>

                    {{-- Baris 4: Visi & Misi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Visi</label>
                            <textarea name="visi" rows="3" required
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('visi', $profil?->visi) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Misi</label>
                            <textarea name="misi" rows="3" required
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('misi', $profil?->misi) }}</textarea>
                        </div>
                    </div>

                    {{-- Baris 5: Upload File & Gambar --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-t pt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Logo Utama</label>
                            <input type="file" name="logo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @if($profil?->logo)
                                <img src="{{ asset('storage/' . $profil->logo) }}" class="mt-2 h-20 w-20 object-contain border rounded p-1 bg-gray-50">
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Surat Legalitas</label>
                            <input type="file" name="foto_legalitas" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @if($profil?->foto_legalitas)
                                <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" class="mt-2 h-20 w-auto object-contain border rounded p-1 bg-gray-50">
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Struktur Pengurus</label>
                            <input type="file" name="foto_struktur" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @if($profil?->foto_struktur)
                                <img src="{{ asset('storage/' . $profil->foto_struktur) }}" class="mt-2 h-20 w-auto object-contain border rounded p-1 bg-gray-50">
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-end gap-3 border-t pt-4">
                        <a href="{{ route('admin.profil.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow-sm text-sm transition">
                            Batal
                        </a>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-sm text-sm transition">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>