<x-app-layout>
    <!-- Custom CSS Palet Warna Fresh -->
    <style>
        :root {
            --honeydew: #f1faeeff;
            --frosted-blue: #a8dadcff;
            --cerulean: #457b9dff;
            --oxford-navy: #1d3557ff;
        }

        /* Timpa background utama aplikasi agar senada */
        .page-wrapper {
            background-color: var(--honeydew);
            min-height: 100vh;
        }

        /* Tipografi */
        .text-navy { color: var(--oxford-navy) !important; }
        .text-cerulean { color: var(--cerulean) !important; }

        /* Form Container */
        .form-card {
            background-color: #ffffff;
            border: 1px solid var(--frosted-blue);
            box-shadow: 0 10px 25px rgba(69, 123, 157, 0.08);
            border-radius: 1rem;
        }

        /* Alerts */
        .alert-success {
            background-color: var(--frosted-blue);
            color: var(--oxford-navy);
            border: 1px solid var(--cerulean);
            box-shadow: 0 4px 6px rgba(69, 123, 157, 0.1);
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #f87171;
            box-shadow: 0 4px 6px rgba(248, 113, 113, 0.1);
        }

        /* Input & Label Styling */
        .custom-label {
            color: var(--oxford-navy);
            font-weight: 700;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .custom-input {
            width: 100%;
            border: 1px solid var(--frosted-blue);
            border-radius: 0.5rem;
            padding: 0.6rem 1rem;
            color: var(--oxford-navy);
            background-color: #ffffff;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            border-color: var(--cerulean);
            box-shadow: 0 0 0 3px rgba(69, 123, 157, 0.2);
            outline: none;
        }

        /* File Input Styling Custom */
        .custom-file-input::file-selector-button {
            background-color: var(--frosted-blue);
            color: var(--oxford-navy);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 1rem;
        }
        
        .custom-file-input::file-selector-button:hover {
            background-color: var(--cerulean);
            color: var(--honeydew);
        }

        /* Submit Button */
        .btn-submit {
            background-color: var(--cerulean);
            color: var(--honeydew);
            font-weight: bold;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: var(--oxford-navy);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(29, 53, 87, 0.2);
        }
    </style>

    <div class="page-wrapper py-12">
        <x-slot name="header">
            <div>
                <h2 class="font-extrabold text-2xl text-navy leading-tight">
                    {{ __('Tambah Kampanye Donasi Baru') }}
                </h2>
                <p class="text-sm text-cerulean mt-1 font-medium">Lengkapi detail di bawah untuk meluncurkan program donasi baru.</p>
            </div>
        </x-slot>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Session Success -->
            @if(session('success'))
                <div class="alert-success mb-6 p-4 rounded-lg flex items-center font-semibold">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Alert Validation Errors -->
            @if($errors->any())
                <div class="alert-error mb-6 p-5 rounded-lg relative">
                    <div class="flex items-center mb-2 font-bold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Terdapat kesalahan pada input Anda:
                    </div>
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Card -->
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
                            <p class="mt-2 text-xs text-gray-500">Format yang didukung: JPG, PNG. Ukuran maksimal 2MB.</p>
                        </div>

                        <div class="flex items-center justify-end mt-4 border-t pt-6" style="border-color: var(--frosted-blue);">
                            <a href="{{ route('admin.campaigns.index') }}" class="mr-4 text-sm font-semibold text-gray-500 hover:text-gray-800 transition">
                                Batal
                            </a>
                            <button type="submit" class="btn-submit flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Simpan Kampanye
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>