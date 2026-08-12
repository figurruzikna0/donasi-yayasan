<!-- ============================================ -->
<!-- admin\foster_children\show.blade.php         -->
<!-- Halaman detail satu anak asuh                -->
<!-- Dipakai oleh Admin\FosterChildControllershow -->
<!-- Alur: menampilkan profil $fosterChild (foto, -->
<!-- nama, status, umur, JK, deskripsi, dibuat)   -->
<!-- plus tombol Edit Data & Kembali              -->
<!-- ============================================ -->
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Detail Anak Asuh
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Kartu utama detail anak asuh -->
            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <!-- Bagian atas kartu: judul detail dan nama anak -->
                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white text-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Detail Anak Asuh</h3>
                        <p class="text-white/80 text-sm">{{ $fosterChild->name }}</p>
                    </div>
                </div>

                <div class="card-body p-8 space-y-6">

                    <!-- Baris foto profil dan identitas singkat anak -->
                    <div class="flex flex-col sm:flex-row gap-6 items-start">
                        <div class="avatar">
                            <div class="w-28 rounded-full ring ring-emerald-200 ring-offset-2">
                                <!-- Jika ada foto, tampilkan foto tersimpan; -->
                                <!-- jika tidak, tampilkan avatar placeholder dari ui-avatars.com -->
                                @if($fosterChild->photo)
                                    <img src="{{ asset('storage/' . $fosterChild->photo) }}" alt="{{ $fosterChild->name }}" class="object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($fosterChild->name) }}&background=b3e093&color=5c8148&bold=true&size=112" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 space-y-3">
                            <!-- Nama anak dan badge status: hijau 'Tersedia', -->
                            <!-- biru 'Diasuh', abu-abu bila nilai lain        -->
                            <div class="flex items-center gap-3 flex-wrap">
                                <h2 class="text-2xl font-black text-emerald-700">{{ $fosterChild->name }}</h2>
                                <span class="badge {{ $fosterChild->status == 'Tersedia' ? 'badge-success' : ($fosterChild->status == 'Diasuh' ? 'badge-info' : 'badge-ghost') }} badge-lg">
                                    {{ $fosterChild->status ?? 'Tidak Diketahui' }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-4 text-sm">
                                <!-- Umur anak (string) -->
                                <span class="bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-100 flex items-center gap-1"><svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg> {{ $fosterChild->age }} Tahun</span>
                                <!-- Jenis kelamin (tampil bila terisi) -->
                                @if($fosterChild->jenis_kelamin)
                                    <span class="bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-100 flex items-center gap-1"><svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7.5l3 4.5m0 0l3-4.5M12 12v5.25M15 12H9m11 3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $fosterChild->jenis_kelamin }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi / cerita anak (tampil bila ada) -->
                    @if($fosterChild->description)
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-1">Deskripsi</p>
                            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100 text-sm text-base-content/70 leading-relaxed">
                                {{ $fosterChild->description }}
                            </div>
                        </div>
                    @endif

                    <!-- Metadata waktu pembuatan data -->
                    <div class="text-sm text-base-content/50">
                        <p>Dibuat: {{ $fosterChild->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <!-- Tombol aksi: Edit Data dan Kembali -->
                    <div class="flex gap-3 pt-4 border-t border-emerald-100">
                        <a href="{{ route('admin.foster-children.edit', $fosterChild) }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 font-bold gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                            Edit Data
                        </a>
                        <a href="{{ route('admin.foster-children.index') }}" class="btn btn-outline border-emerald-300 text-emerald-600 font-bold">
                            ← Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
