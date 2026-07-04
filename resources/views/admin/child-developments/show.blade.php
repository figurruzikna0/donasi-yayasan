<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Detail Laporan Perkembangan
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white text-lg">📈</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Detail Perkembangan</h3>
                        <p class="text-white/80 text-sm">{{ $childDevelopment->judul }}</p>
                    </div>
                </div>

                <div class="card-body p-8 space-y-6">

                    <div>
                        <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold">Judul Laporan</p>
                        <p class="text-lg font-bold text-emerald-700">{{ $childDevelopment->judul }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Anak Asuh</p>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="avatar">
                                    <div class="w-8 rounded-full ring ring-emerald-200">
                                        @if($childDevelopment->fosterChild?->photo)
                                            <img src="{{ asset('storage/' . $childDevelopment->fosterChild->photo) }}" alt="">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($childDevelopment->fosterChild?->name ?? '?') }}&background=b3e093&color=5c8148&bold=true" alt="">
                                        @endif
                                    </div>
                                </div>
                                <span class="font-bold text-emerald-700">{{ $childDevelopment->fosterChild?->name ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Tanggal</p>
                            <p class="font-bold text-emerald-700">{{ $childDevelopment->tanggal ? $childDevelopment->tanggal->format('d/m/Y') : '-' }}</p>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Ditulis oleh</p>
                            <p class="font-bold text-emerald-700">{{ $childDevelopment->user?->name ?? '-' }}</p>
                        </div>
                    </div>

                    @if($childDevelopment->foto)
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-2">Foto</p>
                            <a href="{{ asset('storage/' . $childDevelopment->foto) }}" target="_blank">
                                <img src="{{ asset('storage/' . $childDevelopment->foto) }}" class="w-full max-h-64 object-cover rounded-xl border border-emerald-200" alt="{{ $childDevelopment->judul }}">
                            </a>
                        </div>
                    @endif

                    <div>
                        <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-1">Deskripsi</p>
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100 text-sm text-base-content/70 leading-relaxed">
                            {{ $childDevelopment->deskripsi }}
                        </div>
                    </div>

                    @if($childDevelopment->sponsorship)
                        <div class="bg-amber-50 rounded-xl p-4 border border-amber-200 text-sm">
                            <p class="font-bold text-amber-700 mb-1">Informasi Sponsorship</p>
                            <p>Donatur: {{ $childDevelopment->sponsorship->donor_name }} · Paket: {{ $childDevelopment->sponsorship->package }}</p>
                        </div>
                    @endif

                    <div class="flex gap-3 pt-4 border-t border-emerald-100">
                        <a href="{{ route('admin.child-developments.edit', $childDevelopment) }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 font-bold">
                            ✏️ Edit Laporan
                        </a>
                        <a href="{{ route('admin.child-developments.index') }}" class="btn btn-outline border-emerald-300 text-emerald-600 font-bold">
                            ← Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>