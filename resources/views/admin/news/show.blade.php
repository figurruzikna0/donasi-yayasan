<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Detail Berita
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white text-lg">📰</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Detail Berita</h3>
                        <p class="text-white/80 text-sm">{{ $news->judul }}</p>
                    </div>
                </div>

                <div class="card-body p-8 space-y-6">

                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold">Judul</p>
                            <p class="text-lg font-bold text-emerald-700">{{ $news->judul }}</p>
                        </div>
                        <span class="badge {{ $news->status == 'published' ? 'badge-success' : 'badge-warning' }} badge-lg">
                            {{ $news->status == 'published' ? 'Published' : 'Draft' }}
                        </span>
                    </div>

                    @if($news->foto_utama)
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-2">Foto Utama</p>
                            <img src="{{ asset('storage/' . $news->foto_utama) }}" class="w-full max-h-64 object-cover rounded-xl border border-emerald-200" alt="{{ $news->judul }}">
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Kategori</p>
                            <p class="font-bold text-emerald-700">{{ $news->kategori ?? '-' }}</p>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Tanggal</p>
                            <p class="font-bold text-emerald-700">{{ $news->tanggal_kegiatan ? $news->tanggal_kegiatan->format('d/m/Y') : '-' }}</p>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Lokasi</p>
                            <p class="font-bold text-emerald-700">{{ $news->lokasi ?? '-' }}</p>
                        </div>
                    </div>

                    @if($news->penyelenggara)
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold">Penyelenggara</p>
                            <p class="text-sm text-base-content/70">{{ $news->penyelenggara }}</p>
                        </div>
                    @endif

                    @if($news->ringkasan)
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-1">Ringkasan</p>
                            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100 text-sm text-base-content/70 italic">
                                "{{ $news->ringkasan }}"
                            </div>
                        </div>
                    @endif

                    <div>
                        <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-1">Konten</p>
                        <div class="bg-base-100 rounded-xl p-4 border border-emerald-100 text-sm leading-relaxed prose max-w-none">
                            {!! nl2br(e($news->konten)) !!}
                        </div>
                    </div>

                    <div class="text-sm text-base-content/50">
                        <p>Slug: {{ $news->slug }} · Dibuat: {{ $news->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-emerald-100">
                        <a href="{{ route('admin.news.edit', $news) }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 font-bold">
                            ✏️ Edit Berita
                        </a>
                        <a href="{{ route('admin.news.index') }}" class="btn btn-outline border-emerald-300 text-emerald-600 font-bold">
                            ← Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>