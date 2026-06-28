<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #5c8148;">
            {{ __('Edit Kampanye') }}
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

        /* ── Page background ── */
        .form-page-bg {
            background: linear-gradient(135deg, var(--lime-cream) 0%, var(--celadon) 60%, #e8f5d6 100%);
            min-height: 100%;
        }

        /* ── Card ── */
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
        }
        .form-card-header h3 {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.01em;
        }
        .form-card-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.82rem;
            margin: 2px 0 0;
        }

        /* ── Form body ── */
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

        /* ── Inputs & Textarea ── */
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

        /* ── Existing image preview ── */
        .preview-current {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px;
            background: #f9fef4;
            border: 1.5px solid #cde8b4;
            border-radius: 10px;
            margin-bottom: 16px;
        }
        .preview-current img {
            width: 96px;
            height: 64px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #cde8b4;
            flex-shrink: 0;
        }
        .preview-current-meta {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 2px;
        }
        .preview-current-meta span:first-child {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--fern);
        }
        .preview-current-meta span:last-child {
            font-size: 0.8rem;
            color: #8aaa72;
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

        /* ── Error messages ── */
        .field-error {
            font-size: 0.78rem;
            color: #e06b4f;
            margin-top: 4px;
        }

        /* ── Error alert block ── */
        .alert-error {
            background: #fff5f5;
            border: 1.5px solid #fca5a5;
            border-left: 4px solid #ef4444;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 20px;
        }
        .alert-error ul {
            list-style: disc;
            list-style-position: inside;
            font-size: 0.875rem;
            color: #991b1b;
            font-weight: 500;
            margin: 0;
            padding: 0;
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
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                  stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h3>Edit Kampanye</h3>
                        <p>{{ $campaign->title }}</p>
                    </div>
                </div>

                <div class="form-card-body">

                    {{-- Error alert --}}
                    @if($errors->any())
                        <div class="alert-error">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="field-group">
                            <label class="field-label" for="title">Judul Kampanye</label>
                            <input type="text" id="title" name="title"
                                   value="{{ old('title', $campaign->title) }}"
                                   required class="form-input"
                                   placeholder="Judul kampanye...">
                            @error('title')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="field-group">
                            <label class="field-label" for="description">Deskripsi</label>
                            <textarea id="description" name="description" rows="5"
                                      required class="form-textarea"
                                      placeholder="Jelaskan tujuan dan manfaat kampanye ini...">{{ old('description', $campaign->description) }}</textarea>
                            @error('description')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Target --}}
                        <div class="field-group">
                            <label class="field-label" for="target_amount">Target Dana (Rp)</label>
                            <input type="number" id="target_amount" name="target_amount"
                                   value="{{ old('target_amount', $campaign->target_amount) }}"
                                   required class="form-input" min="1"
                                   placeholder="5000000">
                            @error('target_amount')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-divider"></div>

                        {{-- Foto --}}
                        <span class="section-label">Foto Kampanye</span>

                        {{-- Existing image preview --}}
                        @if($campaign->image)
                            <div class="preview-current">
                                <img src="{{ asset('storage/' . $campaign->image) }}" alt="Foto saat ini">
                                <div class="preview-current-meta">
                                    <span>Foto saat ini</span>
                                    <span>Upload foto baru di bawah untuk mengganti.</span>
                                </div>
                            </div>
                        @endif

                        {{-- File upload --}}
                        <div class="field-group">
                            <label class="field-label">
                                Ganti Foto
                                <span style="font-weight:400; text-transform:none; color:#8aaa72;">(Opsional)</span>
                            </label>
                            <div class="file-input-wrapper">
                                <label class="file-input-label" id="image-label">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"
                                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span id="image-text">Pilih foto baru...</span>
                                </label>
                                <input type="file" name="image" id="image-input"
                                       accept="image/*" class="hidden-file">
                            </div>
                            <p class="file-hint">PNG, JPG, atau WEBP · Biarkan kosong jika tidak ingin ganti.</p>
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
                                Simpan Perubahan
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
            span.textContent = this.files.length > 0 ? this.files[0].name : 'Pilih foto baru...';
        });
    </script>

</x-app-layout>