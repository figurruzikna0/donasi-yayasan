<x-guest-layout>
    <div class="bg-base-200 min-h-0 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-emerald-500 mb-4">
                <a href="{{ url('/') }}" class="link link-hover text-emerald-600">Beranda</a>
                <span class="mx-1">/</span>
                <span class="text-emerald-600">{{ $news->judul }}</span>
            </nav>

            <article class="card bg-base-100 shadow-md border border-emerald-200">
                @if($news->foto_utama)
                    <figure class="max-h-96 overflow-hidden rounded-t-2xl">
                        <img src="{{ asset('storage/' . $news->foto_utama) }}" class="w-full h-full object-cover" alt="{{ $news->judul }}">
                    </figure>
                @endif
                <div class="card-body p-6 sm:p-10">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        @if($news->kategori)
                            <span class="badge badge-success">{{ $news->kategori }}</span>
                        @endif
                        @if($news->tanggal_kegiatan)
                            <span class="text-sm text-emerald-400">{{ $news->tanggal_kegiatan->format('d M Y') }}</span>
                        @endif
                        @if($news->lokasi)
                            <span class="text-sm text-emerald-400">📍 {{ $news->lokasi }}</span>
                        @endif
                        @if($news->penyelenggara)
                            <span class="text-sm text-emerald-400">👤 {{ $news->penyelenggara }}</span>
                        @endif
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-black text-emerald-700 mb-4">{{ $news->judul }}</h1>

                    @if($news->ringkasan)
                        <div class="text-base text-emerald-600 font-semibold mb-6 p-4 bg-emerald-50 rounded-lg border border-emerald-100 italic">
                            {{ $news->ringkasan }}
                        </div>
                    @endif

                    <div class="prose prose-emerald max-w-none text-base-content/80 leading-relaxed">
                        {!! nl2br(e($news->konten)) !!}
                    </div>

                    <div class="mt-8 pt-6 border-t border-emerald-100">
                        <a href="{{ url('/') }}" class="btn btn-outline btn-success">
                            ← Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</x-guest-layout>
