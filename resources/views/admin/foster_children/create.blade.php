<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #5c8148;">
            {{ __('Tambah Data Anak Asuh') }}
        </h2>
    </x-slot>

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

        /* Signature element: gradient header strip */
        .form-card-header {
            background: linear-gradient(90deg, var(--fern) 0%, var(--sage-green) 50%, var(--muted-olive) 100%);
            padding: 20px 28px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-card-header .header-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .form-card-header .header-icon svg {
            width: 22px;
            height: 22px;
            fill: #ffffff;
        }

        .form-card-header h3 {
            color: #ffffff;
            font-size: 1.15rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.01em;
        }

        .form-card-header p {
            color: rgba(255,255,255,0.8);
            font-size: 0.82rem;
            margin: 2px 0 0;
        }

        .form-card-body {
            padding: 28px 32px 32px;
        }

        /* Field label */
        .field-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--fern);
            margin-bottom: 6px;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        /* Input & textarea base */
        .form-input,
        .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #cde8b4;
            border-radius: 10px;
            font-size: 0.95rem;
            color: #374151;
            background: #f9fef4;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
            box-sizing: border-box;
        }

        .form-input:focus,
        .form-textarea:focus {
            border-color: var(--muted-olive-2);
            box-shadow: 0 0 0 3px rgba(139, 182, 80, 0.2);
            background: #ffffff;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #b0c8a0;
        }

        .form-textarea {
            resize: vertical;
            min-height: 110px;
        }

        /* File input wrapper */
        .file-input-wrapper {
            position: relative;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border: 1.5px dashed var(--muted-olive);
            border-radius: 10px;
            background: #f5fded;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            font-size: 0.9rem;
            color: var(--sage-green);
            font-weight: 500;
        }

        .file-input-label:hover {
            border-color: var(--sage-green);
            background: #edfae0;
        }

        .file-input-label svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            stroke: var(--sage-green);
        }

        input[type="file"].hidden-file {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-hint {
            font-size: 0.75rem;
            color: #9ab87a;
            margin-top: 5px;
        }

        /* Divider */
        .form-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--celadon), transparent);
            margin: 28px 0;
        }

        /* Action buttons */
        .btn-cancel {
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--fern);
            background: transparent;
            border: 1.5px solid var(--muted-olive);
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-cancel:hover {
            background: var(--celadon);
            color: var(--fern);
        }

        .btn-submit {
            padding: 10px 28px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            color: #ffffff;
            background: linear-gradient(135deg, var(--muted-olive-2) 0%, var(--sage-green) 100%);
            border: none;
            cursor: pointer;
            box-shadow: 0 3px 12px rgba(92, 129, 72, 0.3);
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--sage-green) 0%, var(--fern) 100%);
            box-shadow: 0 5px 18px rgba(92, 129, 72, 0.4);
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Field row spacing */
        .field-group {
            margin-bottom: 20px;
        }

        /* Validation error style (for future use) */
        .field-error {
            font-size: 0.78rem;
            color: #e06b4f;
            margin-top: 4px;
        }
    </style>

    <div class="form-page-bg py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="form-card">

                {{-- Signature header strip --}}
                <div class="form-card-header">
                    <div class="header-icon">
                        {{-- Leaf / child icon --}}
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C8.5 2 5 4.5 5 9c0 3.5 2 6.5 5.5 8L12 22l1.5-5C17 15.5 19 12.5 19 9c0-4.5-3.5-7-7-7zm0 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                        </svg>
                    </div>
                    <div>
                        <h3>Data Anak Asuh Baru</h3>
                        <p>Lengkapi informasi di bawah dengan teliti</p>
                    </div>
                </div>

                <div class="form-card-body">
                    <form action="{{ route('admin.foster-children.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Nama Lengkap --}}
                        <div class="field-group">
                            <label class="field-label" for="name">Nama Lengkap Anak</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                required
                                placeholder="Masukkan nama lengkap anak..."
                                class="form-input"
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>




                        {{-- Umur --}}
                        <div class="field-group">
                            <label class="field-label" for="age">Umur (Tahun)</label>
                            <input
                                type="number"
                                id="age"
                                name="age"
                                required
                                min="0"
                                max="100"
                                placeholder="0"
                                class="form-input"
                                style="max-width: 160px;"
                                value="{{ old('age') }}"
                            >
                            @error('age')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="field-group">
                            <label class="field-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <select
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                required
                                class="form-input"
                                style="max-width: 220px; appearance: none; background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2376a45b' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;"
                            >
                                <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-divider"></div>

                        <div class="form-divider"></div>

                        {{-- Cerita / Latar Belakang --}}
                        <div class="field-group">
                            <label class="field-label" for="description">Cerita / Latar Belakang</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Tuliskan latar belakang singkat anak, kondisi keluarga, atau hal penting lainnya..."
                                class="form-textarea"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Upload Foto --}}
                        <div class="field-group">
                            <label class="field-label">Foto Anak <span style="font-weight:400;text-transform:none;color:#9ab87a;">(Opsional)</span></label>
                            <div class="file-input-wrapper">
                                <label class="file-input-label" id="file-label">
                                    {{-- Upload icon --}}
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span id="file-label-text">Pilih foto untuk diunggah...</span>
                                </label>
                                <input
                                    type="file"
                                    name="photo"
                                    id="photo-input"
                                    accept="image/*"
                                    class="hidden-file"
                                >
                            </div>
                            <p class="file-hint">Format: JPG, PNG, WEBP &mdash; Maks. 2 MB</p>
                            @error('photo')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-divider"></div>

                        {{-- Actions --}}
                        <div style="display:flex; align-items:center; justify-content:flex-end; gap:12px;">
                            <a href="{{ route('admin.foster-children.index') }}" class="btn-cancel">
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
                                Simpan Data
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Update file label when file is selected
        document.getElementById('photo-input').addEventListener('change', function () {
            const labelText = document.getElementById('file-label-text');
            if (this.files && this.files.length > 0) {
                labelText.textContent = this.files[0].name;
            } else {
                labelText.textContent = 'Pilih foto untuk diunggah...';
            }
        });
    </script>
</x-app-layout>