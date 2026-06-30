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
        .form-card-header h3 { color: #ffffff; font-size: 1.1rem; font-weight: 700; margin: 0; }
        .form-card-header p  { color: rgba(255,255,255,0.8); font-size: 0.8rem; margin: 2px 0 0; }

        .form-card-body { padding: 28px 32px 36px; }

        .field-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--fern);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 6px;
        }
        .field-label .opt {
            font-weight: 400; text-transform: none; color: #8aaa72; font-size: 0.75rem;
        }

        .form-input, .form-textarea {
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
        .form-input:focus, .form-textarea:focus {
            border-color: var(--muted-olive-2);
            box-shadow: 0 0 0 3px rgba(139,182,80,0.2);
            background: #ffffff;
        }
        .form-input::placeholder, .form-textarea::placeholder {
            color: #8aaa72;
            -webkit-text-fill-color: #8aaa72;
            opacity: 1;
        }
        .form-textarea { resize: vertical; min-height: 140px; }

        /* Info anak (read-only, tidak bisa diganti di edit) */
        .child-readonly-box {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: var(--celadon);
            border: 1.5px solid var(--muted-olive);
            border-radius: 10px;
            color: var(--fern);
            font-weight: 700;
            font-size: 0.92rem;
        }
        .child-readonly-box svg { width: 18px; height: 18px; flex-shrink: 0; }

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
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .file-hint { font-size: 0.75rem; color: var(--sage-green); font-weight: 500; margin-top: 5px; }
        .preview-img {
            margin-top: 10px; max-height: 200px; width: auto;
            object-fit: contain;
            border: 1.5px solid #cde8b4;
            border-radius: 10px; padding: 4px;
            background: #f9fef4; display: block;
        }

        .form-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--celadon), transparent);
            margin: 24px 0;
        }

        .field-group { margin-bottom: 20px; }
        .field-error { font-size: 0.78rem; color: #e06b4f; margin-top: 4px; }

        .btn-cancel {
            padding: 10px 20px; border-radius: 10px; font-size: 0.9rem; font-weight: 600;
            color: var(--fern); background: transparent; border: 1.5px solid var(--muted-olive);
            text-decoration: none; transition: background 0.2s, color 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-cancel:hover { background: var(--celadon); color: var(--fern); }

        .btn-submit {
            padding: 10px 28px; border-radius: 10px; font-size: 0.9rem; font-weight: 700;
            color: #ffffff;
            background: linear-gradient(135deg, var(--muted-olive-2) 0%, var(--sage-green) 100%);
            border: none; cursor: pointer;
            box-shadow: 0 3px 12px rgba(92, 129, 72, 0.3);
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, var(--sage-green) 0%, var(--fern) 100%);
            box-shadow: 0 5px 18px rgba(92, 129, 72, 0.4);
            transform: translateY(-1px);
        }
        .btn-submit:active { transform: translateY(0); }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: var(--fern);">
            Edit Laporan Perkembangan
        </h2>
    </x-slot>

    <div class="form-page-bg py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="form-card">

                <div class="form-card-header">
                    <div class="header-icon">📈</div>
                    <div>
                        <h3>Edit Laporan Perkembangan</h3>
                        <p>Perbarui laporan yang sudah ada</p>
                    </div>
                </div>

                <div class="form-card-body">
                    <form action="{{ route('admin.child-developments.update', $development->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="field-group">
                            <label class="field-label">Anak Asuh</label>
                            <div class="child-readonly-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                {{ $development->fosterChild->name ?? '-' }}
                            </div>
                            <p class="file-hint">Anak asuh tidak dapat diubah saat edit. Hapus laporan dan buat baru jika salah pilih.</p>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="tanggal">Tanggal Laporan</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-input" required
                                   value="{{ old('tanggal', $development->tanggal->format('Y-m-d')) }}">
                            @error('tanggal') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="judul">Judul Laporan</label>
                            <input type="text" id="judul" name="judul" class="form-input" required
                                   value="{{ old('judul', $development->judul) }}"
                                   placeholder="Contoh: Naik ke Kelas 5, Nilai Rapor Membaik">
                            @error('judul') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-divider"></div>

                        <div class="field-group">
                            <label class="field-label" for="deskripsi">Deskripsi Perkembangan</label>
                            <textarea id="deskripsi" name="deskripsi" rows="6"
                                      class="form-textarea" required
                                      placeholder="Ceritakan perkembangan anak...">{{ old('deskripsi', $development->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label">Foto <span class="opt">(Opsional, Maks. 3MB)</span></label>
                            <div class="file-input-wrapper">
                                <label class="file-input-label" id="file-label">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span id="file-label-text">Pilih foto baru (opsional)...</span>
                                </label>
                                <input type="file" name="foto" id="photo-input" accept="image/*" class="hidden-file">
                            </div>
                            <p class="file-hint">Kosongkan jika tidak ingin mengganti foto.</p>
                            @if($development->foto)
                                <img src="{{ asset('storage/' . $development->foto) }}" class="preview-img" alt="Foto saat ini">
                            @endif
                            @error('foto') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-divider"></div>

                        <div style="display:flex; align-items:center; justify-content:flex-end; gap:12px;">
                            <a href="{{ route('admin.child-developments.index') }}" class="btn-cancel">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" class="btn-submit">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                    <polyline points="17 21 17 13 7 13 7 21"/>
                                    <polyline points="7 3 7 8 15 8"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('photo-input').addEventListener('change', function () {
            const labelText = document.getElementById('file-label-text');
            labelText.textContent = this.files.length > 0 ? this.files[0].name : 'Pilih foto baru (opsional)...';
        });
    </script>
</x-app-layout>