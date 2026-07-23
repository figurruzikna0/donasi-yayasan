<x-app-layout>
    <div class="bg-base-200 min-h-0">

        <div class="bg-gradient-to-r from-primary via-primary to-secondary text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">Profil Anak Asuh</h1>
                        <p class="text-primary-content/70 text-sm mt-1">Informasi lengkap anak yatim yang siap diasuh</p>
                    </div>
                    <a href="{{ route('dashboard') }}#program-ota" class="btn btn-outline border-white text-white hover:bg-white hover:text-primary btn-sm font-bold">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="card bg-base-100 shadow-md border border-base-300">
                <div class="card-body p-6 sm:p-8">

                    <div class="flex flex-col sm:flex-row gap-6 items-start mb-6">
                        <div class="avatar">
                            <div class="w-28 rounded-full ring ring-primary/20 ring-offset-2">
                                @if($child->photo)
                                    <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->name }}" class="object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($child->name) }}&background=b3e093&color=5c8148&bold=true&size=112" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 space-y-3">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h2 class="text-2xl font-black text-primary">{{ $child->name }}</h2>
                                <span class="badge {{ $child->status == 'Tersedia' ? 'badge-success' : 'badge-info' }} badge-lg font-bold">
                                    {{ $child->status ?? 'Tidak Diketahui' }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-3 text-sm">
                                <span class="bg-base-200 px-3 py-1.5 rounded-lg border border-base-300 font-semibold text-base-content/70">
                                    🎂 {{ $child->age }} Tahun
                                </span>
                                @if($child->jenis_kelamin)
                                    <span class="bg-base-200 px-3 py-1.5 rounded-lg border border-base-300 font-semibold text-base-content/70">
                                        {{ $child->jenis_kelamin == 'Laki-laki' ? '👦' : '👧' }} {{ $child->jenis_kelamin }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($child->description)
                        <div class="mb-6">
                            <p class="text-xs uppercase tracking-wider text-primary font-bold mb-2">Tentang {{ $child->name }}</p>
                            <div class="bg-base-200 rounded-xl p-5 border border-base-300 text-sm text-base-content/70 leading-relaxed">
                                {{ $child->description }}
                            </div>
                        </div>
                    @endif

                    @if($child->sponsorships->where('status', 'success')->count())
                        <div class="bg-brand-500/5 border border-brand-200 rounded-xl p-4 mb-6">
                            <div class="flex items-center gap-2 text-brand-700 text-sm font-bold">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Anda sedang menjadi orang tua asuh untuk {{ $child->name }}
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-base-200">
                        @if($child->status == 'Tersedia')
                            <a href="{{ route('sponsor.form', $child->id) }}" class="btn bg-primary hover:bg-primary/90 text-white border-0 rounded-lg font-bold flex-1 shadow-lg shadow-primary/20">
                                Asuh {{ $child->name }} Sekarang
                            </a>
                        @else
                            <span class="btn bg-brand-500/10 text-brand-700 border-brand-200 rounded-lg font-bold flex-1 cursor-default">
                                Anak sudah diasuh
                            </span>
                        @endif
                        <a href="{{ route('dashboard') }}#program-ota" class="btn btn-outline border-base-300 text-base-content/70 hover:bg-base-200 rounded-lg font-bold">
                            ← Kembali ke Daftar
                        </a>
                    </div>

                </div>
            </div>

            <div class="text-center mt-6 text-xs text-base-content/40">
                <p>Yayasan Baitul Yatim Sukabumi — Setiap anak berhak mendapatkan masa depan yang cerah</p>
            </div>
        </div>
    </div>
</x-app-layout>
