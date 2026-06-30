<x-app-layout>
    <div class="container mx-auto p-6" style="background-color: #f3fbea;">
        <h1 class="text-2xl font-bold mb-6 text-[#354a2b]">Kelola Data Pendiri Yayasan</h1>

        @if(session('success'))
            <div class="bg-[#d6ec89] border-l-4 border-[#76a45b] text-[#47623a] p-4 mb-6 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="bg-white p-6 rounded-lg shadow-md h-fit border border-[#b3e093]">
                <h2 class="text-xl font-semibold mb-4 text-[#47623a]">Tambah Pendiri Baru</h2>
                
                <form action="{{ route('admin.pendiri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#76a45b]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Jabatan</label>
                        <input type="text" name="jabatan" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#76a45b]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kata Sambutan / Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#76a45b]" placeholder="Tulis visi atau kata sambutan pendiri..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Foto Pendiri</label>
                        <input type="file" name="foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#f3fbea] file:text-[#5c8148] hover:file:bg-[#d6ec89]" required>
                    </div>

                    <button type="submit" class="w-full bg-[#5c8148] hover:bg-[#47623a] text-white font-bold py-2 px-4 rounded-lg transition duration-200 shadow">
                        Simpan Data Pendiri
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md border border-[#b3e093]">
                <h2 class="text-xl font-semibold mb-4 text-[#47623a]">Daftar Pendiri</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-[#f3fbea] text-[#354a2b] uppercase text-sm leading-normal border-b border-[#b3e093]">
                                <th class="py-3 px-6 text-left">Foto</th>
                                <th class="py-3 px-6 text-left">Profil</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse($pendiris as $pendiri)
                                <tr class="border-b border-gray-200 hover:bg-[#f3fbea]/50">
                                    <td class="py-3 px-6 text-left whitespace-nowrap align-top">
                                        @if($pendiri->foto)
                                            <img src="{{ asset('storage/' . $pendiri->foto) }}" alt="Foto {{ $pendiri->nama }}" class="w-16 h-16 rounded-lg object-cover border border-[#a1c181]">
                                        @else
                                            <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center text-xs">No Pic</div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-left align-top">
                                        <div class="font-bold text-gray-800 text-base">{{ $pendiri->nama }}</div>
                                        <div class="text-[#5c8148] font-medium text-xs mb-2">{{ $pendiri->jabatan }}</div>
                                        <p class="text-gray-500 text-xs italic line-clamp-3">
                                            "{{ $pendiri->deskripsi ?? 'Belum ada kata sambutan.' }}"
                                        </p>
                                    </td>
                                    <td class="py-3 px-6 text-center align-top">
                                        <form action="{{ route('admin.pendiri.destroy', $pendiri->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data pendiri ini, bro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-200 mt-2">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-gray-400 font-medium">Belum ada data pendiri yayasan yang diinput.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>