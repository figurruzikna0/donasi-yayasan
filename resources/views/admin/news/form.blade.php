{{-- 
    Partial reusable: dipakai oleh create.blade.php dan edit.blade.php
    Variable yang dibutuhkan:
      $news       → object News (untuk edit) | null (untuk create)
      $formAction → string URL action form
      $formMethod → 'POST' | 'PUT'
      $pageTitle  → string judul halaman
      $headerSub  → string subjudul header strip
--}}

<x-app-layout>
    <style>
        :root {
            --celadon:       #b3e093;
            --lime-cream:    #d6ec89;
            --muted-olive:   #a1c181;
            --muted-olive-2: #8bb650;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
        }

        .form-page-bg {
            background: linear-gradient(135deg, var(--lime-cream) 0%, var(--celadon) 60%, #e8f5d6 100%);
            min-height: 100%;
        }

        .form-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(92, 129, 72, 0.13);
            overflow: hidden;
        }

        .form-card-header {
            background: linear-gradient(90deg, var(--fern) 0%, var(--sage-green) 50%, var(--muted-olive) 100%);
            padding: 20px 28px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .form-card-header .header-icon {
            width: 40px; height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .form-card-header h3 { color: #fff; font-size: 1.1rem; font-weight: 700; margin: 0; }
        .form-card-header p  { color: rgba(255,255,255,0.8); font-size: 0.8rem; margin: 2px 0 0; }

        .form-card-body { padding: 28px 32px 36px; }

        /* Labels */
        .field-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--fern);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 6px;
        }
        .field-label .optional {
            font-weight: 400;
            text-transform: none;
            color: #8aaa72;
            font-size: 0.75rem;
        }

        /* Inputs */
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #cde8b4;
            border-radius: 10px;
            font-size: 0.92rem;
            color: #1a2e12;
            -webkit-text-fill-color: #1a2e12;
            background: #f9fef4;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
            box-sizing: border-box;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--muted-olive-2);
            box-shadow: 0 0 0 3px rgba(139,182,80,0.2);
            background: #ffffff;
        }
        .form-input::placeholder, .form-textarea::placeholder {
            color: #8aaa72;
            -webkit-text-fill-color: #8aaa72;
            opacity: 1;
        }
        .form-textarea { resize: vertical; }
        .form-select { appearance: none; cursor: pointer; }

        /* Konten textarea khusus — lebih tinggi untuk press release */
        .form-textarea-lg { min-height: 320px; font-size: 0.9rem; line-height: 1.7; }

        /* Section heading */
        .section-heading {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--fern);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 14px;
        }

        /* File input */
        .file-input-wrapper { position: relative; }
        .file-input-label {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px;
            border: 1.5px dashed var(--muted-olive);
            border-radius: 10px;
            background: #f5fded;
            cursor: pointer;
            font-size: 0.88rem;
            color: var(--fern);
            font-weight: 600;
            transition: border-color 0.2s, background 0.2s;
        }
        .file-input-label:hover { border-color: var(--sage-green); background: #edfae0; }
        .file-input-label svg { width: 18px; height: 18px; stroke: var(--sage-green); flex-shrink: 0; }
        input[type="file"].hidden-file {
            position: absolute; inset: 0; opacity: 0;
            cursor: pointer; width: 100%; height: 100%;
        }
        .file-hint { font-size: 0.72rem; color: var(--sage-green); font-weight: 500; margin-top: 5px; }
        .preview-img {
            margin-top: 10px; max-height: 180px; width: auto;
            object-fit: contain;
            border: 1.5px solid #cde8b4;
            border-radius: 10px; padding: 4px;
            background: #f9fef4; display: block;
        }

        /* Status toggle */
        .status-group { display: flex; gap: 10px; flex-wrap: wrap; }
        .status-option { position: relative; }
        .status-option input[type="radio"] { position: absolute; opacity: 0; width: 0; height: 0; }
        .status-label {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 0.85rem; font-weight: 700;
            cursor: pointer;
            border: 1.5px solid #cde8b4;
            color: #6b7280;
            background: #f9fef4;
            transition: all 0.2s;
        }
        .status-option input:checked + .status-label {
            border-color: var(--muted-olive-2);
            box-shadow: 0 0 0 3px rgba(139,182,80,0.18);
        }
        .status-option input[value="published"]:checked + .status-label {
            background: var(--celadon);
            color: var(--fern);
            border-color: var(--muted-olive);
        }
        .status-option input[value="draft"]:checked + .status-label {
            background: #f3f4f6;
            color: #374151;
            border-color: #d1d5db;
        }

        /* Divider */
        .form-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--celadon), transparent);
            margin: 24px 0;
        }

        /* Field spacing */
        .field-group { margin-bottom: 20px; }
        .field-error  { font-size: 0.78rem; color: #e06b4f; margin-top: 4px; }

        /* Buttons */
        .btn-cancel {
            padding: 10px 20px; border-radius: 10px; font-size: 0.875rem; font-weight: 600;
            color: var(--fern); background: transparent; border: 1.5px solid var(--muted-olive);
            text-decoration: none; transition: background 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-cancel:hover { background: var(--celadon); }
        .btn-submit {
            padding: 10px 28px; border-radius: 10px; font-size: 0.875rem; font-weight: 700;
            color: #ffffff;
            background: linear-gradient(135deg, var(--muted-olive-2) 0%, var(--sage-green) 100%);
            border: none; cursor: pointer;
            box-shadow: 0 3px 12px rgba(92,129,72,0.28);
            transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, var(--sage-green) 0%, var(--fern) 100%);
            box-shadow: 0 5px 18px rgba(92,129,72,0.38);
            transform: translateY(-1px);
        }
        .btn-submit:active { transform: translateY(0); }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: var(--fern);">
            {{ $pageTitle }}
        </h2>
    </x-slot>

    <div class="form-page-bg py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="form-card">

                {{-- Header strip --}}
                <div class="form-card-header">
                    <div class="header-icon">📰</div>
                    <div>
                        <h3>{{ $pageTitle }}</h3>
                        <p>{{ $headerSub }}</p>
                    </div>
                </div>

                <div class="form-card-body">
                    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($formMethod === 'PUT') @method('PUT') @endif

                        {{-- Judul --}}
                        <div class="field-group">
                            <label class="field-label" for="judul">Judul Berita / Kegiatan</label>
                            <input type="text" id="judul" name="judul" class="form-input" required
                                   value="{{ old('judul', $news?->judul) }}"
                                   placeholder="Contoh: Santunan Anak Yatim Bersama Donatur Peduli Bandung">
                            @error('judul') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- Kategori + Tanggal + Lokasi --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="field-group">
                                <label class="field-label" for="kategori">Kategori</label>
                                <select id="kategori" name="kategori" class="form-select" required>
                                    @php
                                        $kategoriList = ['Kegiatan Umum','Santunan','Pendidikan','Kesehatan','Ramadan','Hari Besar','Kunjungan','Lainnya'];
                                        $selectedKat  = old('kategori', $news?->kategori ?? 'Kegiatan Umum');
                                    @endphp
                                    @foreach($kategoriList as $k)
                                        <option value="{{ $k }}" @selected($selectedKat === $k)>{{ $k }}</option>
                                    @endforeach
                                </select>
                                @error('kategori') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan"
                                       class="form-input" required
                                       value="{{ old('tanggal_kegiatan', $news?->tanggal_kegiatan?->format('Y-m-d')) }}">
                                @error('tanggal_kegiatan') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="lokasi">
                                    Lokasi <span class="optional">(Opsional)</span>
                                </label>
                                <input type="text" id="lokasi" name="lokasi" class="form-input"
                                       value="{{ old('lokasi', $news?->lokasi) }}"
                                       placeholder="Contoh: Aula Yayasan, Bandung">
                                @error('lokasi') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Penyelenggara --}}
                        <div class="field-group">
                            <label class="field-label" for="penyelenggara">
                                Penyelenggara / Panitia <span class="optional">(Opsional)</span>
                            </label>
                            <input type="text" id="penyelenggara" name="penyelenggara" class="form-input"
                                   value="{{ old('penyelenggara', $news?->penyelenggara) }}"
                                   placeholder="Contoh: Divisi Humas Baitul Yatim">
                            @error('penyelenggara') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- Ringkasan --}}
                        <div class="field-group">
                            <label class="field-label" for="ringkasan">
                                Ringkasan / Lead Paragraph <span class="optional">(Opsional, maks. 500 karakter)</span>
                            </label>
                            <textarea id="ringkasan" name="ringkasan" rows="2"
                                      class="form-textarea" maxlength="500"
                                      placeholder="Tuliskan ringkasan singkat yang menarik — tampil sebagai preview di daftar berita...">{{ old('ringkasan', $news?->ringkasan) }}</textarea>
                            @error('ringkasan') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-divider"></div>

                        {{-- Konten / Narasi --}}
                        <div class="field-group">
                            <label class="field-label" for="konten">Narasi Lengkap / Press Release</label>
                            <textarea id="konten" name="konten" rows="14"
                                      class="form-textarea form-textarea-lg" required
                                      placeholder="Tulis narasi lengkap kegiatan di sini. Gunakan paragraf yang jelas: latar belakang, jalannya acara, kutipan narasumber, dan penutup yang menginspirasi...">{{ old('konten', $news?->konten) }}</textarea>
                            @error('konten') <p class="field-error">{{ $message }}</p> @enderror
                            <p class="file-hint" style="margin-top:6px;">💡 Tip: tekan Enter dua kali untuk membuat paragraf baru.</p>
                        </div>

                        <div class="form-divider"></div>

                        {{-- Foto + Status --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Foto utama --}}
                            <div class="field-group">
                                <label class="field-label">
                                    Foto Utama <span class="optional">(Opsional, maks. 3MB)</span>
                                </label>
                                <div class="file-input-wrapper">
                                    <label class="file-input-label" id="foto-label">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"
                                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span id="foto-label-text">Pilih foto kegiatan...</span>
                                    </label>
                                    <input type="file" name="foto_utama" id="foto-input"
                                           accept="image/*" class="hidden-file">
                                </div>
                                <p class="file-hint">JPG, PNG, WEBP — Landscape lebih baik</p>
                                @if($news?->foto_utama)
                                    <img src="{{ asset('storage/' . $news->foto_utama) }}" class="preview-img">
                                @endif
                                @error('foto_utama') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            {{-- Status --}}
                            <div class="field-group">
                                <label class="field-label">Status Publikasi</label>
                                <div class="status-group">
                                    <div class="status-option">
                                        <input type="radio" id="status-draft" name="status" value="draft"
                                               @checked(old('status', $news?->status ?? 'draft') === 'draft')>
                                        <label for="status-draft" class="status-label">
                                            ○ Simpan sebagai Draft
                                        </label>
                                    </div>
                                    <div class="status-option">
                                        <input type="radio" id="status-published" name="status" value="published"
                                               @checked(old('status', $news?->status) === 'published')>
                                        <label for="status-published" class="status-label">
                                            ● Tayangkan Sekarang
                                        </label>
                                    </div>
                                </div>
                                <p class="file-hint" style="margin-top:8px;">Draft tidak akan tampil di halaman publik.</p>
                                @error('status') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                        </div>

                        <div class="form-divider"></div>

                        {{-- Actions --}}
                        <div style="display:flex; align-items:center; justify-content:flex-end; gap:12px;">
                            <a href="{{ route('admin.news.index') }}" class="btn-cancel">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" class="btn-submit">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round">
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

    <script>
        document.getElementById('foto-input').addEventListener('change', function () {
            const span = document.getElementById('foto-label-text');
            span.textContent = this.files.length > 0 ? this.files[0].name : 'Pilih foto kegiatan...';
        });
    </script>
</x-app-layout>