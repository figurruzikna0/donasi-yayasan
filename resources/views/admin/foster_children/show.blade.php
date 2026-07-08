<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Detail Anak Asuh
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white text-lg">👶</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Detail Anak Asuh</h3>
                        <p class="text-white/80 text-sm">{{ $fosterChild->name }}</p>
                    </div>
                </div>

                <div class="card-body p-8 space-y-6">

                    <div class="flex flex-col sm:flex-row gap-6 items-start">
                        <div class="avatar">
                            <div class="w-28 rounded-full ring ring-emerald-200 ring-offset-2">
                                @if($fosterChild->photo)
                                    <img src="{{ asset('storage/' . $fosterChild->photo) }}" alt="{{ $fosterChild->name }}" class="object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($fosterChild->name) }}&background=b3e093&color=5c8148&bold=true&size=112" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 space-y-3">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h2 class="text-2xl font-black text-emerald-700">{{ $fosterChild->name }}</h2>
                                <span class="badge {{ $fosterChild->status == 'Tersedia' ? 'badge-success' : ($fosterChild->status == 'Diasuh' ? 'badge-info' : 'badge-ghost') }} badge-lg">
                                    {{ $fosterChild->status ?? 'Tidak Diketahui' }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-4 text-sm">
                                <span class="bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-100">🎂 {{ $fosterChild->age }} Tahun</span>
                                @if($fosterChild->jenis_kelamin)
                                    <span class="bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-100">⚧ {{ $fosterChild->jenis_kelamin }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($fosterChild->description)
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-1">Deskripsi</p>
                            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100 text-sm text-base-content/70 leading-relaxed">
                                {{ $fosterChild->description }}
                            </div>
                        </div>
                    @endif

                    <div class="text-sm text-base-content/50">
                        <p>Dibuat: {{ $fosterChild->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-emerald-100">
                        <a href="{{ route('admin.foster-children.edit', $fosterChild) }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 font-bold">
                            ✏️ Edit Data
                        </a>
                        <a href="{{ route('admin.foster-children.index') }}" class="btn btn-outline border-emerald-300 text-emerald-600 font-bold">
                            ← Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>