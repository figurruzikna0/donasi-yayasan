<!-- ============================================ -->
<!-- admin\news\form.blade.php                    -->
<!-- Form bersama untuk tambah & edit berita      -->
<!-- Dipakai oleh Admin\NewsController via        -->
<!-- include pada create.blade.php & edit.blade. -->
<!-- php. Variabel yang dipakai: $formAction,      -->
<!-- $formMethod, $pageTitle, $headerSub, $news    -->
<!-- Alur: kirim data POST/PUT, lalu simpan ke DB  -->
<!-- ============================================ -->
<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

    <!-- Header halaman: judul dinamis sesuai mode create/edit -->
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
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">{{ $pageTitle }}</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">{{ $headerSub }}</p>
                </div>
                <!-- Tombol kembali ke daftar berita -->
                <a href="{{ route('admin.news.index') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-4 h-4"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12">

        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="px-8 py-6">
                <!-- ============================================ -->
                <!-- Form berita: enctype multipart karena ada    -->
                <!-- upload file foto. Action & method dinamis     -->
                <!-- ($formAction / $formMethod). Mode edit        -->
                <!-- memakai method('PUT') untuk spoofing method  -->
                <!-- ============================================ -->
                <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                    <!-- Token CSRF wajib untuk keamanan form Laravel -->
                    @csrf
                    @if($formMethod === 'PUT') @method('PUT') @endif

                    <!-- Input judul berita/kegiatan (wajib). old() -->
                    <!-- menjaga nilai lama saat validasi gagal      -->
                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-bold text-base-content">Judul Berita / Kegiatan</span>
                        </label>
                        <input type="text" name="judul" class="input input-bordered w-full" required
                               value="{{ old('judul', $news?->judul) }}"
                               placeholder="Contoh: Santunan Anak Yatim Bersama Donatur Peduli Bandung">
                        @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Baris tiga kolom: Kategori, Tanggal Kegiatan, Lokasi -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-base-content">Kategori</span>
                            </label>
                            <!-- Dropdown kategori dengan daftar kategori tetap yang didefinisikan di php -->
                            <select name="kategori" class="select select-bordered w-full" required>
                                @php
                                    $kategoriList = ['Kegiatan Umum','Santunan','Pendidikan','Kesehatan','Ramadan','Hari Besar','Kunjungan','Lainnya'];
                                    $selectedKat  = old('kategori', $news?->kategori ?? 'Kegiatan Umum');
                                @endphp
                                <!-- Looping opsi kategori; selected menandai nilai yang terpilih -->
                                @foreach($kategoriList as $k)
                                    <option value="{{ $k }}" @selected($selectedKat === $k)>{{ $k }}</option>
                                @endforeach
                            </select>
                            @error('kategori') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-base-content">Tanggal Kegiatan</span>
                            </label>
                            <!-- Input tanggal kegiatan (wajib); format Y-m-d untuk input type=date -->
                            <input type="date" name="tanggal_kegiatan" class="input input-bordered w-full" required
                                   value="{{ old('tanggal_kegiatan', $news?->tanggal_kegiatan?->format('Y-m-d')) }}">
                            @error('tanggal_kegiatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-base-content">Lokasi <span class="font-normal normal-case text-base-content/40">(Opsional)</span></span>
                            </label>
                            <!-- Input lokasi kegiatan (opsional) -->
                            <input type="text" name="lokasi" class="input input-bordered w-full"
                                   value="{{ old('lokasi', $news?->lokasi) }}"
                                   placeholder="Contoh: Aula Yayasan, Bandung">
                            @error('lokasi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Input penyelenggara/panitia kegiatan (opsional) -->
                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-bold text-base-content">Penyelenggara / Panitia <span class="font-normal normal-case text-base-content/40">(Opsional)</span></span>
                        </label>
                        <input type="text" name="penyelenggara" class="input input-bordered w-full"
                               value="{{ old('penyelenggara', $news?->penyelenggara) }}"
                               placeholder="Contoh: Divisi Humas Baitul Yatim">
                        @error('penyelenggara') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Input ringkasan singkat (opsional, maks. 500 karakter) -->
                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-bold text-base-content">Ringkasan <span class="font-normal normal-case text-base-content/40">(Opsional, maks. 500 karakter)</span></span>
                        </label>
                        <textarea name="ringkasan" rows="2" class="textarea textarea-bordered w-full" maxlength="500"
                                  placeholder="Tuliskan ringkasan singkat yang menarik...">{{ old('ringkasan', $news?->ringkasan) }}</textarea>
                        @error('ringkasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="divider"></div>

                    <!-- Textarea isi/narasi lengkap berita (wajib) -->
                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-bold text-base-content">Narasi Lengkap / Press Release</span>
                        </label>
                        <textarea name="konten" rows="14" class="textarea textarea-bordered w-full min-h-[320px]" required
                                  placeholder="Tulis narasi lengkap kegiatan di sini...">{{ old('konten', $news?->konten) }}</textarea>
                        @error('konten') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="divider"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Upload foto utama berita dengan pratinjau -->
                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-base-content">Foto Utama <span class="font-normal normal-case text-base-content/40">(Opsional, maks. 3MB)</span></span>
                            </label>
                            <!-- Input file foto; onchange memanggil fungsi previewFoto untuk pratinjau -->
                            <input type="file" name="foto_utama" id="foto-input" accept="image/*" class="file-input file-input-bordered w-full" onchange="previewFoto(event)">
                            <p class="text-xs text-base-content/40 mt-1">JPG, PNG, WEBP — Landscape lebih baik</p>
                            <!-- Elemen img pratinjau; pada mode edit menampilkan foto lama, -->
                            <!-- hidden jika tidak ada foto -->
                            <div class="mt-2 relative">
                                <img id="foto-preview" src="{{ $news?->foto_utama ? asset('storage/' . $news->foto_utama) : '' }}"
                                     class="max-h-44 rounded-lg border border-base-200 {{ $news?->foto_utama ? '' : 'hidden' }}">
                            </div>
                            @error('foto_utama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <!-- Skrip JS: menampilkan pratinjau gambar yang dipilih -->
                        <!-- menggunakan URL.createObjectURL sebelum form dikirim -->
                        <script>
                        function previewFoto(event) {
                            const file = event.target.files[0];
                            const img = document.getElementById('foto-preview');
                            if (file) {
                                img.src = URL.createObjectURL(file);
                                img.classList.remove('hidden');
                            }
                        }
                        </script>

                        <!-- Pilihan status publikasi: draft atau published -->
                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-base-content">Status Publikasi</span>
                            </label>
                            <div class="flex gap-3 flex-wrap">
                                <!-- Radio "Simpan sebagai Draft" (status draft) -->
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-base-300 bg-base-100 has-[:checked]:border-primary has-[:checked]:bg-primary/5 cursor-pointer transition-all">
                                    <input type="radio" name="status" value="draft" class="radio radio-sm"
                                           @checked(old('status', $news?->status ?? 'draft') === 'draft')>
                                    Simpan sebagai Draft
                                </label>
                                <!-- Radio "Tayangkan Sekarang" (status published) -->
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-base-300 bg-base-100 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 cursor-pointer transition-all">
                                    <input type="radio" name="status" value="published" class="radio radio-sm"
                                           @checked(old('status', $news?->status) === 'published')>
                                    Tayangkan Sekarang
                                </label>
                            </div>
                            <p class="text-xs text-base-content/40 mt-2">Draft tidak akan tampil di halaman publik.</p>
                            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <div class="divider"></div>

                    <!-- Tombol aksi bawah: Batal dan Simpan. Label tombol -->
                    <!-- simpan berubah sesuai mode (Terbitkan Berita / Simpan Perubahan) -->
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-outline">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 12H5M12 5l-7 7 7 7"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/>
                                <polyline points="7 3 7 8 15 8"/>
                            </svg>
                            {{ $formMethod === 'PUT' ? 'Simpan Perubahan' : 'Terbitkan Berita' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
</x-admin-layout>
