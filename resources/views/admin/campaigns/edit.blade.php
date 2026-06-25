<x-app-layout>
    <style>
        :root {
            --honeydew: #f1faeeff;
            --frosted-blue: #a8dadcff;
            --cerulean: #457b9dff;
            --oxford-navy: #1d3557ff;
        }

        .page-wrapper { background-color: var(--honeydew); min-height: 100vh; }
        .text-navy { color: var(--oxford-navy) !important; }
        .text-cerulean { color: var(--cerulean) !important; }
        
        .form-card {
            background-color: #a8dadcff;
            border: 1px solid var(--frosted-blue);
            box-shadow: 0 10px 25px rgba(69, 123, 157, 0.08);
            border-radius: 1rem;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #f87171;
        }

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

        .btn-submit {
            background-color: var(--cerulean);
            color: var(--honeydew);
            font-weight: bold;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background-color: var(--oxford-navy);
            transform: translateY(-2px);
        }
    </style>

    <div class="page-wrapper py-12">
        <x-slot name="header">
            <div>
                <h2 class="font-extrabold text-2xl text-navy leading-tight">
                    {{ __('Edit Kampanye: ') }} <span class="text-cerulean">{{ $campaign->title }}</span>
                </h2>
                <p class="text-sm text-cerulean mt-1 font-medium">Perbarui detail informasi kampanye di bawah ini.</p>
            </div>
        </x-slot>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if($errors->any())
                <div class="alert-error mb-6 p-5 rounded-lg border text-sm">
                    <ul class="list-disc list-inside font-semibold">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-card overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <label for="title" class="custom-label">Judul Kampanye</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $campaign->title) }}" class="custom-input" required>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="custom-label">Deskripsi Lengkap</label>
                            <textarea name="description" id="description" rows="5" class="custom-input" required>{{ old('description', $campaign->description) }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label for="target_amount" class="custom-label">Target Dana (Rp)</label>
                            <input type="number" name="target_amount" id="target_amount" value="{{ old('target_amount', $campaign->target_amount) }}" class="custom-input" min="1" required>
                        </div>

                        <div class="mb-8 border-t pt-6" style="border-color: var(--frosted-blue);">
                            <label class="custom-label">Foto Saat Ini</label>
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $campaign->image) }}" alt="Foto Kampanye" class="w-40 h-24 object-cover rounded-lg shadow-sm border" style="border-color: var(--frosted-blue);">
                            </div>
                            
                            <label for="image" class="custom-label">Ganti Foto (Biarkan kosong jika tidak ingin ganti)</label>
                            <input type="file" name="image" id="image" class="custom-input p-1" accept="image/*">
                        </div>

                        <div class="flex items-center justify-end mt-4 border-t pt-6" style="border-color: var(--frosted-blue);">
                            <a href="{{ route('admin.campaigns.index') }}" class="mr-6 text-sm font-bold text-gray-500 hover:text-navy transition">
                                Batal
                            </a>
                            <button type="submit" class="btn-submit flex items-center">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>