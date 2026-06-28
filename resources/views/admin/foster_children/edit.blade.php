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

        .field-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--fern);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 6px;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #cde8b4;
            border-radius: 10px;
            font-size: 0.92rem;
            color: #1a2e12;
            background: #f9fef4;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            box-sizing: border-box;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--muted-olive-2);
            box-shadow: 0 0 0 3px rgba(139,182,80,0.2);
            background: #ffffff;
        }
        .form-textarea { resize: vertical; }

        .field-group { margin-bottom: 20px; }
        .field-error  { font-size: 0.78rem; color: #e06b4f; margin-top: 4px; }

        .form-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--celadon), transparent);
            margin: 24px 0;
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
        .file-hint { font-size: 0.72rem; color: var(--sage-green); font-weight: 500; margin-top: 5px; }
        .preview-img {
            margin-top: 10px; max-height: 160px; width: auto;
            object-fit: contain;
            border: 1.5px solid #cde8b4;
            border-radius: 10px; padding: 4px;
            background: #f9fef4; display: block;
        }
        input[type="file"].hidden-file {
            position: absolute; inset: 0; opacity: 0;
            cursor: pointer; width: 100%; height: 100%;
        }

        /* Status radio */
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
        .status-option input[value="Tersedia"]:checked + .status-label {
            background: var(--celadon); color: var(--fern); border-color: var(--muted-olive);
        }
        .status-option input[value="Diasuh"]:checked + .status-label {
            background: #f3f4f6; color: #374151; border-color: #d1d5db;
        }

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
            transform: translateY(-1px);
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: var(--fern);">
            Edit Data Anak Asuh
        </h2>
    </x-slot>

    <div class="form-page-bg py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="form-card">

                <div class="form-card-header">
                    <div class="header-icon">👦</div>
                    <div>
                        <h3>Edit Data Anak Asuh</h3>
                        <p>Perbarui informasi profil {{ $fosterChild->name }}</p>
                    </div>
                </div>

                <div class="form-card-body">

                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-lg" style="background:#fef2f2; border:1px solid #fecaca;">
                            <p class="text-sm font-bold text-red-700 mb-1">Harap perbaiki kesalahan berikut:</p>
                            <ul class="list-disc list-inside text-sm text-red-600">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.foster-children.update', $fosterChild->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="field-group">
                            <label class="field-label" for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-input" required
                                   value="{{ old('name', $fosterChild->name) }}"
                                   placeholder="Nama lengkap anak asuh">
                            @error('name') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- Usia --}}
                        <div class="field-group">
                            <label class="field-label" for="age">Usia (Tahun)</label>
                            <input type="number" id="age" name="age" class="form-input" required
                                   min="0" max="25"
                                   value="{{ old('age', $fosterChild->age) }}">
                            @error('age') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="field-group">
                            <label class="field-label" for="description">Cerita / Deskripsi Singkat</label>
                            <textarea id="description" name="description" rows="4"
                                      class="form-textarea"
                                      placeholder="Cerita singkat tentang anak asuh ini...">{{ old('description', $fosterChild->description) }}</textarea>
                            @error('description') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-divider"></div>

                        {{-- Status --}}
                        <div class="field-group">
                            <label class="field-label">Status</label>
                            <div class="status-group">
                                <div class="status-option">
                                    <input type="radio" id="status-tersedia" name="status" value="Tersedia"
                                           @checked(old('status', $fosterChild->status ?? 'Tersedia') === 'Tersedia')>
                                    <label for="status-tersedia" class="status-label">● Tersedia</label>
                                </div>
                                <div class="status-option">
                                    <input type="radio" id="status-diasuh" name="status" value="Diasuh"
                                           @checked(old('status', $fosterChild->status) === 'Diasuh')>
                                    <label for="status-diasuh" class="status-label">✓ Sedang Diasuh</label>
                                </div>
                            </div>
                            @error('status') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        {{-- Foto --}}
                        <div class="field-group">
                            <label class="field-label">Foto Profil <span style="font-weight:400;text-transform:none;color:#8aaa72;">(Opsional — biarkan kosong jika tidak ingin mengganti)</span></label>
                            <div class="file-input-wrapper">
                                <label class="file-input-label" id="foto-label">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                         stroke="var(--sage-green)" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/>
                                    </svg>
                                    <span id="foto-label-text">Pilih foto baru…</span>
                                </label>
                                <input type="file" name="photo" id="foto-input"
                                       accept="image/*" class="hidden-file">
                            </div>
                            <p class="file-hint">JPG, PNG, WEBP — Maks 2MB</p>

                            {{-- Foto saat ini --}}
                            @if($fosterChild->photo)
                                <p class="file-hint" style="margin-top:10px;">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $fosterChild->photo) }}"
                                     alt="{{ $fosterChild->name }}"
                                     class="preview-img"
                                     id="preview-current">
                            @endif

                            {{-- Preview foto baru --}}
                            <img id="preview-new" class="preview-img" style="display:none;" alt="Preview">
                            @error('photo') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-divider"></div>

                        {{-- Actions --}}
                        <div style="display:flex; align-items:center; justify-content:flex-end; gap:12px;">
                            <a href="{{ route('admin.foster-children.index') }}" class="btn-cancel">
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
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('foto-input').addEventListener('change', function () {
            const span      = document.getElementById('foto-label-text');
            const previewN  = document.getElementById('preview-new');
            const previewC  = document.getElementById('preview-current');

            if (this.files && this.files[0]) {
                span.textContent = this.files[0].name;
                const reader = new FileReader();
                reader.onload = e => {
                    previewN.src = e.target.result;
                    previewN.style.display = 'block';
                    // Sembunyikan foto lama kalau ada foto baru
                    if (previewC) previewC.style.display = 'none';
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                span.textContent = 'Pilih foto baru…';
                previewN.style.display = 'none';
                if (previewC) previewC.style.display = 'block';
            }
        });
    </script>
</x-app-layout>