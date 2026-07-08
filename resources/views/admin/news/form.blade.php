<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            {{ $pageTitle }}
        </h2>
    </x-slot>

    <x-admin-form-card
        icon="📰"
        :title="$pageTitle"
        :subtitle="$headerSub"
    >
                    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($formMethod === 'PUT') @method('PUT') @endif

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Judul Berita / Kegiatan</span>
                            </label>
                            <input type="text" name="judul" class="input input-bordered w-full" required
                                   value="{{ old('judul', $news?->judul) }}"
                                   placeholder="Contoh: Santunan Anak Yatim Bersama Donatur Peduli Bandung">
                            @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="form-control mb-5">
                                <label class="label">
                                    <span class="label-text font-bold text-emerald-700 uppercase">Kategori</span>
                                </label>
                                <select name="kategori" class="select select-bordered w-full" required>
                                    @php
                                        $kategoriList = ['Kegiatan Umum','Santunan','Pendidikan','Kesehatan','Ramadan','Hari Besar','Kunjungan','Lainnya'];
                                        $selectedKat  = old('kategori', $news?->kategori ?? 'Kegiatan Umum');
                                    @endphp
                                    @foreach($kategoriList as $k)
                                        <option value="{{ $k }}" @selected($selectedKat === $k)>{{ $k }}</option>
                                    @endforeach
                                </select>
                                @error('kategori') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control mb-5">
                                <label class="label">
                                    <span class="label-text font-bold text-emerald-700 uppercase">Tanggal Kegiatan</span>
                                </label>
                                <input type="date" name="tanggal_kegiatan" class="input input-bordered w-full" required
                                       value="{{ old('tanggal_kegiatan', $news?->tanggal_kegiatan?->format('Y-m-d')) }}">
                                @error('tanggal_kegiatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control mb-5">
                                <label class="label">
                                    <span class="label-text font-bold text-emerald-700 uppercase">Lokasi <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span>
                                </label>
                                <input type="text" name="lokasi" class="input input-bordered w-full"
                                       value="{{ old('lokasi', $news?->lokasi) }}"
                                       placeholder="Contoh: Aula Yayasan, Bandung">
                                @error('lokasi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Penyelenggara / Panitia <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span>
                            </label>
                            <input type="text" name="penyelenggara" class="input input-bordered w-full"
                                   value="{{ old('penyelenggara', $news?->penyelenggara) }}"
                                   placeholder="Contoh: Divisi Humas Baitul Yatim">
                            @error('penyelenggara') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Ringkasan <span class="font-normal normal-case text-emerald-400">(Opsional, maks. 500 karakter)</span></span>
                            </label>
                            <textarea name="ringkasan" rows="2" class="textarea textarea-bordered w-full" maxlength="500"
                                      placeholder="Tuliskan ringkasan singkat yang menarik...">{{ old('ringkasan', $news?->ringkasan) }}</textarea>
                            @error('ringkasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="divider"></div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Narasi Lengkap / Press Release</span>
                            </label>
                            <textarea name="konten" rows="14" class="textarea textarea-bordered w-full min-h-[320px]" required
                                      placeholder="Tulis narasi lengkap kegiatan di sini...">{{ old('konten', $news?->konten) }}</textarea>
                            @error('konten') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            <p class="text-xs text-emerald-400 mt-1">Tip: tekan Enter dua kali untuk membuat paragraf baru.</p>
                        </div>

                        <div class="divider"></div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="form-control mb-5">
                                <label class="label">
                                    <span class="label-text font-bold text-emerald-700 uppercase">Foto Utama <span class="font-normal normal-case text-emerald-400">(Opsional, maks. 3MB)</span></span>
                                </label>
                                <input type="file" name="foto_utama" id="foto-input" accept="image/*" class="file-input file-input-bordered w-full">
                                <p class="text-xs text-emerald-500 mt-1">JPG, PNG, WEBP — Landscape lebih baik</p>
                                @if($news?->foto_utama)
                                    <img src="{{ asset('storage/' . $news->foto_utama) }}" class="mt-2 max-h-44 rounded-lg border border-emerald-200">
                                @endif
                                @error('foto_utama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="form-control mb-5">
                                <label class="label">
                                    <span class="label-text font-bold text-emerald-700 uppercase">Status Publikasi</span>
                                </label>
                                <div class="flex gap-3 flex-wrap">
                                    <label class="flex items-center gap-2 p-2.5 rounded-xl border border-emerald-200 bg-emerald-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-gray-100 cursor-pointer transition-all">
                                        <input type="radio" name="status" value="draft" class="radio radio-sm"
                                               @checked(old('status', $news?->status ?? 'draft') === 'draft')>
                                        ○ Simpan sebagai Draft
                                    </label>
                                    <label class="flex items-center gap-2 p-2.5 rounded-xl border border-emerald-200 bg-emerald-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-100 has-[:checked]:text-emerald-700 cursor-pointer transition-all">
                                        <input type="radio" name="status" value="published" class="radio radio-sm"
                                               @checked(old('status', $news?->status) === 'published')>
                                        ● Tayangkan Sekarang
                                    </label>
                                </div>
                                <p class="text-xs text-emerald-400 mt-2">Draft tidak akan tampil di halaman publik.</p>
                                @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                        </div>

                        <div class="divider"></div>

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
    </x-admin-form-card>
</x-admin-layout>
