<x-app-layout>
    <style>
        :root {
            --celadon:       #b3e093;
            --muted-olive:   #a1c181;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
            --honeydew:      #f0f7ec;
        }

        .page-wrapper { background-color: var(--honeydew); min-height: 100vh; }
        
        .form-card {
            background-color: #ffffff;
            border: 1px solid var(--celadon);
            box-shadow: 0 10px 30px rgba(92, 129, 72, 0.08);
            border-radius: 1.5rem;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #f87171;
        }

        .custom-label {
            color: var(--fern);
            font-weight: 700;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            display: block;
        }

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

        .btn-submit {
            background: linear-gradient(135deg, var(--muted-olive), var(--fern));
            color: white;
            font-weight: 800;
            padding: 0.85rem 2rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background: var(--fern);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(92, 129, 72, 0.3);
        }
    </style>

    <div class="page-wrapper py-12">
        <x-slot name="header">
            <div>
                <h2 class="font-extrabold text-2xl text-fern leading-tight">
                    {{ __('Edit Kampanye: ') }} <span class="text-sage">{{ $campaign->title }}</span>
                </h2>
                <p class="text-sm text-sage mt-1 font-medium">Perbarui detail informasi kampanye di bawah ini.</p>
            </div>
        </x-slot>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if($errors->any())
                <div class="alert-error mb-6 p-5 rounded-xl border text-sm shadow-sm">
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

                        <div class="mb-8 border-t pt-6 border-gray-100">
                            <label class="custom-label">Foto Saat Ini</label>
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $campaign->image) }}" alt="Foto Kampanye" class="w-40 h-24 object-cover rounded-xl shadow-sm border border-gray-100">
                            </div>
                            
                            <label for="image" class="custom-label">Ganti Foto (Biarkan kosong jika tidak ingin ganti)</label>
                            <input type="file" name="image" id="image" class="custom-input p-1" accept="image/*">
                        </div>

                        <div class="flex items-center justify-end mt-4 border-t pt-6 border-gray-100">
                            <a href="{{ route('admin.campaigns.index') }}" class="mr-6 text-sm font-bold text-gray-500 hover:text-fern transition">
                                Batal
                            </a>
                            <button type="submit" class="btn-submit">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>