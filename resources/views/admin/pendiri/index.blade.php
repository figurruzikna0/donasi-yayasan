<x-app-layout>
    <div class="bg-base-200 p-7">

        {{-- Page header --}}
        <div class="flex items-end justify-between gap-3 mb-6 flex-wrap">
            <div>
                <nav class="text-sm text-emerald-500 mb-1">
                    <a href="{{ route('admin.dashboard') }}" class="link link-hover text-emerald-600">Dashboard</a>
                    <span class="mx-1">/</span>
                    <span class="text-emerald-600">Kelola Pendiri</span>
                </nav>
                <h1 class="text-2xl font-black text-emerald-700">Kelola Data Pendiri Yayasan</h1>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-6">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Add form card --}}
            <div class="card bg-base-100 shadow-md border border-emerald-200 h-fit">
                <div class="card-body">
                    <h2 class="card-title text-emerald-700">Tambah Pendiri Baru</h2>

                    <form action="{{ route('admin.pendiri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Nama Lengkap</span>
                            </label>
                            <input type="text" name="nama" class="input input-bordered w-full" required>
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Jabatan</span>
                            </label>
                            <input type="text" name="jabatan" class="input input-bordered w-full" required>
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Kata Sambutan / Deskripsi</span>
                            </label>
                            <textarea name="deskripsi" rows="3" class="textarea textarea-bordered w-full" placeholder="Tulis visi atau kata sambutan pendiri..."></textarea>
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Foto Pendiri</span>
                            </label>
                            <input type="file" name="foto" class="file-input file-input-bordered w-full" required>
                        </div>

                        <button type="submit" class="btn btn-success w-full">
                            Simpan Data Pendiri
                        </button>
                    </form>
                </div>
            </div>

            {{-- List card --}}
            <div class="lg:col-span-2 card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body">
                    <h2 class="card-title text-emerald-700">Daftar Pendiri</h2>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Profil</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendiris as $pendiri)
                                    <tr>
                                        <td class="align-top">
                                            @if($pendiri->foto)
                                                <img src="{{ asset('storage/' . $pendiri->foto) }}" alt="Foto {{ $pendiri->nama }}" class="w-16 h-16 rounded-lg object-cover border border-emerald-300">
                                            @else
                                                <div class="w-16 h-16 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold">No Pic</div>
                                            @endif
                                        </td>
                                        <td class="align-top">
                                            <div class="font-bold text-emerald-700">{{ $pendiri->nama }}</div>
                                            <div class="text-emerald-500 font-medium text-xs mb-2">{{ $pendiri->jabatan }}</div>
                                            <p class="text-emerald-400 text-xs italic line-clamp-3">
                                                "{{ $pendiri->deskripsi ?? 'Belum ada kata sambutan.' }}"
                                            </p>
                                        </td>
                                        <td class="text-center align-top">
                                            <form action="{{ route('admin.pendiri.destroy', $pendiri->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data pendiri ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-error mt-2">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-8 text-center text-emerald-400 font-medium">Belum ada data pendiri yayasan yang diinput.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
