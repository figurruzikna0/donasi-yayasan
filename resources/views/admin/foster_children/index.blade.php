<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-indigo-700 -mx-4 -my-4 px-6 py-5 rounded-xl">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    Kelola Data Anak Asuh
                </h2>
                <p class="text-sm text-indigo-200 mt-0.5">Daftar seluruh anak asuh yang terdaftar</p>
            </div>
            <a href="{{ route('admin.foster-children.create') }}"
               class="inline-flex items-center gap-2 bg-white hover:bg-indigo-50 text-indigo-700 font-semibold py-2.5 px-5 rounded-xl shadow-md transition-all duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Anak Asuh
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                {{-- Card Total --}}
                <div class="bg-indigo-600 rounded-2xl p-5 shadow-md flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-indigo-100">Total Anak Asuh</p>
                        <p class="text-3xl font-bold text-white">{{ $children->count() }}</p>
                    </div>
                </div>

                {{-- Card Tersedia --}}
                <div class="bg-emerald-600 rounded-2xl p-5 shadow-md flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-emerald-100">Tersedia</p>
                        <p class="text-3xl font-bold text-white">{{ $children->where('status', 'Tersedia')->count() }}</p>
                    </div>
                </div>

                {{-- Card Diasuh --}}
                <div class="bg-violet-600 rounded-2xl p-5 shadow-md flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-violet-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-violet-100">Sedang Diasuh</p>
                        <p class="text-3xl font-bold text-white">{{ $children->where('status', '!=', 'Tersedia')->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="flex items-center gap-3 bg-emerald-600 text-white px-5 py-4 rounded-2xl shadow-sm" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Table Card --}}
            <div class="bg-white overflow-hidden shadow-md rounded-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-indigo-700">
                                <th scope="col" class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider">Foto</th>
                                <th scope="col" class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider">Umur</th>
                                <th scope="col" class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-xs font-bold text-white uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($children as $child)
                                <tr class="bg-white hover:bg-indigo-50 transition-colors duration-100">
                                    <td class="px-6 py-4">
                                        @if($child->photo)
                                            <img src="{{ asset('storage/' . $child->photo) }}"
                                                 alt="Foto {{ $child->name }}"
                                                 class="w-14 h-14 object-cover rounded-2xl shadow border-2 border-indigo-200">
                                        @else
                                            <div class="w-14 h-14 bg-indigo-200 rounded-2xl flex items-center justify-center border-2 border-indigo-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-slate-800 text-base">{{ $child->name }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="inline-flex items-center gap-1.5 font-semibold text-slate-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $child->age }} Tahun
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($child->status == 'Tersedia')
                                            <span class="inline-flex items-center gap-1.5 bg-emerald-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                                Tersedia
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 bg-violet-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                                Diasuh
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.foster-children.edit', $child->id) }}"
                                               class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-indigo-500 hover:bg-indigo-600 px-3 py-1.5 rounded-lg shadow-sm transition-colors duration-150">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.foster-children.destroy', $child->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data {{ $child->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-rose-500 hover:bg-rose-600 px-3 py-1.5 rounded-lg shadow-sm transition-colors duration-150">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center bg-slate-50">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-2xl bg-indigo-200 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/>
                                                </svg>
                                            </div>
                                            <p class="font-bold text-slate-700 text-base">Belum ada data anak asuh</p>
                                            <p class="text-sm text-slate-500">Mulai dengan menambahkan data anak asuh baru.</p>
                                            <a href="{{ route('admin.foster-children.create') }}"
                                               class="mt-2 inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2 px-5 rounded-xl shadow transition-all duration-150">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Tambah Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>