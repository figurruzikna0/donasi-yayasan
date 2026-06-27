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

        /* Latar belakang halaman yang menenangkan */
        .page-wrapper {
            background: linear-gradient(135deg, #f0f7ec 0%, var(--celadon) 100%);
            min-height: 100vh;
        }

        /* Tipografi */
        .text-fern { color: var(--fern) !important; }
        .text-sage { color: var(--sage-green) !important; }

        /* Form Card dengan efek glassmorphism tipis */
        .form-card {
            background-color: #ffffff;
            border: 1px solid var(--celadon);
            box-shadow: 0 10px 30px rgba(92, 129, 72, 0.08);
            border-radius: 1.5rem;
        }

        /* Custom Label */
        .custom-label {
            color: var(--fern);
            font-weight: 700;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        /* Input Styling */
        .custom-input {
            width: 100%;
            border: 1.5px solid var(--muted-olive);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--fern);
            background-color: #fdfdfd;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            border-color: var(--fern);
            box-shadow: 0 0 0 4px rgba(118, 164, 91, 0.15);
            outline: none;
        }

        /* File Input Styling */
        .custom-file-input::file-selector-button {
            background-color: var(--celadon);
            color: var(--fern);
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 1rem;
        }
        
        .custom-file-input::file-selector-button:hover {
            background-color: var(--muted-olive-2);
            color: white;
        }

        /* Submit Button */
        .btn-submit {
            background: linear-gradient(135deg, var(--muted-olive-2), var(--fern));
            color: white;
            font-weight: bold;
            padding: 0.85rem 2rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: var(--fern);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(92, 129, 72, 0.3);
        }

        /* Alert Styling */
        .alert-success {
            background-color: #eafcd4;
            color: var(--fern);
            border: 1px solid var(--celadon);
        }
    </style>

    <div class="page-wrapper py-12">
        <x-slot name="header">
            <div>
                <h2 class="font-extrabold text-2xl text-fern leading-tight">
                    {{ __('Tambah Kampanye Donasi Baru') }}
                </h2>
                <p class="text-sm text-sage mt-1 font-medium">Isi detail di bawah untuk meluncurkan program kebaikan baru.</p>
            </div>
        </x-slot>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="alert-success mb-6 p-4 rounded-xl flex items-center font-semibold">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-card overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="title" class="custom-label">Judul Kampanye</label>
                            <input type="text" name="title" id="title" class="custom-input" placeholder="Contoh: Bantuan Sembako untuk Yatim Piatu" required>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="custom-label">Deskripsi Lengkap</label>
                            <textarea name="description" id="description" rows="5" class="custom-input" placeholder="Jelaskan secara detail tujuan kampanye ini..." required></textarea>
                        </div>

                        <div class="mb-6">
                            <label for="target_amount" class="custom-label">Target Dana (Rp)</label>
                            <input type="number" name="target_amount" id="target_amount" class="custom-input" placeholder="Contoh: 5000000" min="1" required>
                        </div>

                        <div class="mb-8">
                            <label for="image" class="custom-label">Foto Kampanye / Thumbnail</label>
                            <input type="file" name="image" id="image" class="custom-input custom-file-input text-sm p-1" accept="image/*" required>
                        </div>

                        <div class="flex items-center justify-end mt-4 border-t pt-6 border-gray-100">
                            <a href="{{ route('admin.campaigns.index') }}" class="mr-6 text-sm font-semibold text-gray-500 hover:text-fern transition">
                                Batal
                            </a>
                            <button type="submit" class="btn-submit flex items-center">
                                Simpan Kampanye
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>