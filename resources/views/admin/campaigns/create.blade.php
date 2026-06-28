<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #5c8148;">
            {{ __('Tambah Kampanye Donasi Baru') }}
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

        /* ── Gradient header strip ── */
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
            background: rgba(255, 255, 255, 0.2);
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
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.82rem;
            margin: 2px 0 0;
        }

        .form-card-body {
            padding: 28px 32px 32px;
        }

        /* ── Labels ── */
        .field-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--fern);
            margin-bottom: 6px;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .section-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--fern);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 14px;
            display: block;
        }

        /* ── Input & Textarea ── */
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

        /* ── File input ── */
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

        /* ── Divider ── */
        .form-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--celadon), transparent);
            margin: 24px 0;
        }

        /* ── Field spacing ── */
        .field-group {
            margin-bottom: 20px;
        }

        /* ── Error ── */
        .field-error {
            font-size: 0.78rem;
            color: #e06b4f;
            margin-top: 4px;
        }

        /* ── Success alert ── */
        .alert-success {
            background: #eafcd4;
            border: 1.5px solid var(--celadon);
            border-left: 4px solid var(--sage-green);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--fern);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        .alert-success svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            stroke: var(--sage-green);
        }

        /* ── Buttons ── */
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
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="form-card">

                {{-- Header strip --}}
                <div class="form-card-header">
                    <div class="header-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                        </svg>
                    </div>
                    <div>
                        <h3>Kampanye Donasi Baru</h3>
                        <p>Isi detail di bawah untuk meluncurkan program kebaikan baru</p>
                    </div>
                </div>

                <div class="form-card-body">

                    @if(session('success'))
                        <div class="alert-success">
                            <svg fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="field-group">
                            <label class="field-label" for="title">Judul Kampanye</label>
                            <input type="text" id="title" name="title"
                                   class="form-input" required
                                   placeholder="mis. Bantuan Sembako untuk Yatim Piatu">
                            @error('title')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="field-group">
                            <label class="field-label" for="description">Deskripsi Lengkap</label>
                            <textarea id="description" name="description" rows="5"
                                      class="form-textarea" required
                                      placeholder="Jelaskan secara detail tujuan kampanye ini..."></textarea>
                            @error('description')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Target --}}
                        <div class="field-group">
                            <label class="field-label" for="target_amount">Target Dana (Rp)</label>
                            <input type="number" id="target_amount" name="target_amount"
                                   class="form-input" min="1" required
                                   placeholder="5000000">
                            @error('target_amount')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-divider"></div>

                        {{-- Image Upload --}}
                        <span class="section-label">Foto Kampanye</span>

                        <div class="field-group">
                            <div class="file-input-wrapper">
                                <label class="file-input-label" id="image-label">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span id="image-text">Pilih foto kampanye...</span>
                                </label>
                                <input type="file" name="image" id="image-input"
                                       accept="image/*" class="hidden-file" required>
                            </div>
                            <p class="file-hint">PNG, JPG, atau WEBP · Maks. 2 MB</p>
                            @error('image')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-divider"></div>

                        {{-- Actions --}}
                        <div style="display:flex; align-items:center; justify-content:flex-end; gap:12px;">
                            <a href="{{ route('admin.campaigns.index') }}" class="btn-cancel">
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
                                Simpan Kampanye
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image-input').addEventListener('change', function () {
            const span = document.getElementById('image-text');
            span.textContent = this.files.length > 0 ? this.files[0].name : 'Pilih foto kampanye...';
        });
    </script>

</x-app-layout>