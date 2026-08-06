<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Edit Data Pendiri Yayasan
        </h2>
    </x-slot>

    <x-admin-form-card
        icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>'
        title="Edit Data Pendiri Yayasan"
        subtitle="Perbarui data pendiri atau pengurus yayasan"
    >

        @if($errors->any())
            <x-alert type="error" :errors="$errors->all()" />
        @endif

        <form action="{{ route('admin.pendiri.update', $pendiri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-4 mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                @if($pendiri->foto)
                    <div class="avatar">
                        <div class="w-16 h-16 rounded-xl ring ring-emerald-300 ring-offset-1">
                            <img src="{{ asset('storage/' . $pendiri->foto) }}" alt="Foto {{ $pendiri->nama }}" class="object-cover">
                        </div>
                    </div>
                @else
                    <div class="w-16 h-16 rounded-xl bg-emerald-600/10 text-emerald-700 font-extrabold text-xl flex items-center justify-center ring ring-emerald-300">{{ strtoupper(substr($pendiri->nama, 0, 1)) }}</div>
                @endif
                <div>
                    <p class="font-bold text-emerald-700 text-sm">Foto saat ini</p>
                    <p class="text-xs text-emerald-700/60">Upload foto baru di bawah jika ingin mengganti</p>
                </div>
            </div>

            <div class="form-control mb-5">
                <label class="label">
                    <span class="label-text font-bold text-emerald-700 uppercase">Nama Lengkap</span>
                </label>
                <input type="text" name="nama" class="input input-bordered w-full" required
                       value="{{ old('nama', $pendiri->nama) }}"
                       placeholder="Nama lengkap pendiri">
                @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control mb-5">
                <label class="label">
                    <span class="label-text font-bold text-emerald-700 uppercase">Jabatan</span>
                </label>
                <input type="text" name="jabatan" class="input input-bordered w-full" required
                       value="{{ old('jabatan', $pendiri->jabatan) }}"
                       placeholder="Contoh: Ketua Yayasan">
                @error('jabatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control mb-5">
                <label class="label">
                    <span class="label-text font-bold text-emerald-700 uppercase">Kata Sambutan / Deskripsi</span>
                </label>
                <textarea name="deskripsi" rows="4" class="textarea textarea-bordered w-full"
                          placeholder="Tulis visi atau kata sambutan pendiri...">{{ old('deskripsi', $pendiri->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control mb-5">
                <label class="label">
                    <span class="label-text font-bold text-emerald-700 uppercase">Foto Pendiri <span class="normal-case font-normal text-emerald-700/60">(opsional — kosongkan jika tidak diganti)</span></span>
                </label>
                <input type="file" name="foto" class="file-input file-input-bordered w-full" accept="image/*">
                @error('foto') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="form-control mb-8">
                <label class="label">
                    <span class="label-text font-bold text-emerald-700 uppercase">Urutan Tampil</span>
                </label>
                <input type="number" name="urutan" class="input input-bordered w-full max-w-[220px]" min="0"
                       value="{{ old('urutan', $pendiri->urutan ?? 0) }}">
                @error('urutan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.pendiri.index') }}" class="btn btn-ghost font-semibold">Batal</a>
                <button type="submit" class="btn btn-success font-bold">Simpan Perubahan</button>
            </div>
        </form>
    </x-admin-form-card>
</x-admin-layout>
