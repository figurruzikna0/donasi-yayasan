<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #5c8148;">
            {{ __('Edit Profil Yayasan') }}
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

        /* Gradient header strip */
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

        /* Section sub-heading (untuk grup berkas) */
        .section-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--fern);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 14px;
            display: block;
        }

        /* Input & textarea */
        .form-input,
        .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #cde8b4;
            border-radius: 10px;
            font-size: 0.95rem;
            color: #1a2e12;
            -webkit-text-fill-color: #1a2e12;
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
            color: #1a2e12;
            -webkit-text-fill-color: #1a2e12;
        }
        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #8aaa72;
            -webkit-text-fill-color: #8aaa72;
            opacity: 1;
        }
        .form-textarea {
            resize: vertical;
        }

        /* File input */
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
            font-size: 0.88rem;
            color: var(--fern);
            font-weight: 600;
        }
        .file-input-label:hover {
            border-color: var(--sage-green);
            background: #edfae0;
        }
        .file-input-label svg {
            width: 18px;
            height: 18px;
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
            color: var(--sage-green);
            font-weight: 500;
            margin-top: 5px;
        }
        .preview-img {
            margin-top: 8px;
            height: 72px;
            width: auto;
            object-fit: contain;
            border: 1.5px solid #cde8b4;
            border-radius: 8px;
            padding: 4px;
            background: #f9fef4;
            display: block;
        }

        /* Divider */
        .form-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--celadon), transparent);
            margin: 24px 0;
        }

        /* Field spacing */
        .field-group {
            margin-bottom: 20px;
        }

        /* Error */
        .field-error {
            font-size: 0.78rem;
            color: #e06b4f;
            margin-top: 4px;
        }

        /* Buttons */
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
    </style>

    <div class="form-page-bg py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="form-card">

                {{-- Header strip --}}
                <div class="form-card-header">
                    <div class="header-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <h3>Pengaturan Profil Yayasan</h3>
                        <p>Perbarui informasi, visi misi, dan berkas resmi yayasan</p>
                    </div>
                </div>

                <div class="form-card-body">
                    <form action="{{ route('admin.profil.update') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Baris 1: Nama, Email, Telp --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="field-group">
                                <label class="field-label" for="nama_yayasan">Nama Yayasan</label>
                                <input type="text" id="nama_yayasan" name="nama_yayasan"
                                       value="{{ old('nama_yayasan', $profil?->nama_yayasan) }}"
                                       required class="form-input"
                                       placeholder="Baitul Yatim...">
                                @error('nama_yayasan')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="email">Email Resmi</label>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email', $profil?->email) }}"
                                       required class="form-input"
                                       placeholder="info@yayasan.id">
                                @error('email')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="no_telp">No. Telepon / WhatsApp</label>
                                <input type="text" id="no_telp" name="no_telp"
                                       value="{{ old('no_telp', $profil?->no_telp) }}"
                                       required class="form-input"
                                       placeholder="08xx-xxxx-xxxx">
                                @error('no_telp')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="field-group">
                            <label class="field-label" for="alamat">Alamat Lengkap Kantor</label>
                            <textarea id="alamat" name="alamat" rows="2"
                                      required class="form-textarea"
                                      placeholder="Jl. ...">{{ old('alamat', $profil?->alamat) }}</textarea>
                            @error('alamat')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Sejarah --}}
                        <div class="field-group">
                            <label class="field-label" for="sejarah_yayasan">Sejarah / Deskripsi Yayasan</label>
                            <textarea id="sejarah_yayasan" name="sejarah_yayasan" rows="4"
                                      required class="form-textarea"
                                      placeholder="Ceritakan latar belakang dan perjalanan yayasan...">{{ old('sejarah_yayasan', $profil?->sejarah_yayasan) }}</textarea>
                            @error('sejarah_yayasan')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Visi & Misi --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="field-group">
                                <label class="field-label" for="visi">Visi</label>
                                <textarea id="visi" name="visi" rows="3"
                                          required class="form-textarea"
                                          placeholder="Visi jangka panjang yayasan...">{{ old('visi', $profil?->visi) }}</textarea>
                                @error('visi')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="misi">Misi</label>
                                <textarea id="misi" name="misi" rows="3"
                                          required class="form-textarea"
                                          placeholder="Langkah-langkah konkret yayasan...">{{ old('misi', $profil?->misi) }}</textarea>
                                @error('misi')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-divider"></div>

                        {{-- Upload Berkas --}}
                        <span class="section-label">Upload Berkas &amp; Gambar</span>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                            {{-- Logo --}}
                            <div class="field-group">
                                <label class="field-label">
                                    Logo Utama
                                    <span style="font-weight:400;text-transform:none;color:#8aaa72;">(Opsional)</span>
                                </label>
                                <div class="file-input-wrapper">
                                    <label class="file-input-label" id="logo-label">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span id="logo-text">Pilih file logo...</span>
                                    </label>
                                    <input type="file" name="logo" id="logo-input"
                                           accept="image/*" class="hidden-file">
                                </div>
                                <p class="file-hint">PNG transparan lebih baik</p>
                                @if($profil?->logo)
                                    <img src="{{ asset('storage/' . $profil->logo) }}" class="preview-img">
                                @endif
                                @error('logo')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Legalitas --}}
                            <div class="field-group">
                                <label class="field-label">
                                    Surat Legalitas
                                    <span style="font-weight:400;text-transform:none;color:#8aaa72;">(Opsional)</span>
                                </label>
                                <div class="file-input-wrapper">
                                    <label class="file-input-label" id="legal-label">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span id="legal-text">Pilih foto legalitas...</span>
                                    </label>
                                    <input type="file" name="foto_legalitas" id="legal-input"
                                           accept="image/*" class="hidden-file">
                                </div>
                                <p class="file-hint">Foto SK / Akta Notaris</p>
                                @if($profil?->foto_legalitas)
                                    <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" class="preview-img">
                                @endif
                                @error('foto_legalitas')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Struktur --}}
                            <div class="field-group">
                                <label class="field-label">
                                    Struktur Pengurus
                                    <span style="font-weight:400;text-transform:none;color:#8aaa72;">(Opsional)</span>
                                </label>
                                <div class="file-input-wrapper">
                                    <label class="file-input-label" id="struktur-label">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span id="struktur-text">Pilih foto struktur...</span>
                                    </label>
                                    <input type="file" name="foto_struktur" id="struktur-input"
                                           accept="image/*" class="hidden-file">
                                </div>
                                <p class="file-hint">Bagan / foto bersama pengurus</p>
                                @if($profil?->foto_struktur)
                                    <img src="{{ asset('storage/' . $profil->foto_struktur) }}" class="preview-img">
                                @endif
                                @error('foto_struktur')
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="form-divider"></div>

                        {{-- Actions --}}
                        <div style="display:flex; align-items:center; justify-content:flex-end; gap:12px;">
                            <a href="{{ route('admin.profil.index') }}" class="btn-cancel">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" class="btn-submit">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
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
        function bindFile(inputId, textId) {
            document.getElementById(inputId).addEventListener('change', function () {
                const span = document.getElementById(textId);
                span.textContent = this.files.length > 0 ? this.files[0].name : span.dataset.default || span.textContent;
            });
        }
        bindFile('logo-input',     'logo-text');
        bindFile('legal-input',    'legal-text');
        bindFile('struktur-input', 'struktur-text');
    </script>
</x-app-layout>