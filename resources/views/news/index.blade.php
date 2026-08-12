<!DOCTYPE html>
<!-- ============================================ -->
<!-- news\index.blade.php — halaman daftar berita & kegiatan -->
<!-- ============================================ -->
<!-- Peran     : halaman publik (tanpa layout autentikasi) menampilkan daftar berita dengan -->
<!--             pencarian (search), filter kategori, dan paginasi. -->
<!-- Controller: NewsController@index — variabel $newsList (paginated), $kategoriList, $profil. -->
<!-- Alur      : halaman utama -> klik menu Berita -> daftar berita tampil -> bisa dicari/ -->
<!--             difilter -> klik kartu berita menuju halaman detail (news\show.blade.php). -->
<html lang="id" data-theme="baitul">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Kegiatan - {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">

    <!-- NAVBAR PUBLIK: komponen bersama halaman publik (beranda, berita, dsb.) -->
    @include('partials.public-navbar', ['useRouteLinks' => true, 'scrollEffect' => true])

    <div class="bg-gradient-to-b from-emerald-50 to-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

            <!-- BREADCRUMB: navigasi posisi halaman (Beranda / Berita & Kegiatan) -->
            <nav class="text-sm text-gray-400 mb-8">
                <a href="{{ url('/') }}" class="hover:text-emerald-600 transition-colors">Beranda</a>
                <span class="mx-1.5">/</span>
                <span class="text-gray-600">Berita & Kegiatan</span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-2">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-black text-emerald-800">Berita & Kegiatan</h1>
                    <p class="text-sm text-gray-500 mt-1">Informasi terbaru seputar kegiatan Yayasan Baitul Yatim</p>
                </div>
            </div>

            <!-- FORM FILTER/PENCARIAN: metode GET (query string) ke route news.index -->
            <form method="GET" action="{{ route('news.index') }}" class="flex flex-col sm:flex-row gap-3 mb-10 mt-4">
                <!-- KOLOM PENCARIAN: filter berita berdasarkan kata kunci judul/isi -->
                <div class="relative flex-1">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari berita..." autocomplete="off"
                           class="input input-bordered w-full pl-10 pr-4 h-10 text-sm rounded-xl">
                </div>
                <div class="flex gap-2">
                    <!-- SELECT KATEGORI: otomatis submit form ketika kategori diganti; -->
                    <!-- pilihan berasal dari $kategoriList, nilai aktif dipertahankan via request('kategori') -->
                    <select name="kategori" onchange="this.form.submit()" class="select select-bordered h-10 min-w-[150px] text-sm rounded-xl">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriList as $k)
                            <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                    <!-- TOMBOL RESET FILTER: hanya tampil bila search/kategori sedang terisi -->
                    @if(request()->anyFilled(['search', 'kategori']))
                        <a href="{{ route('news.index') }}" class="btn btn-ghost h-10 rounded-xl text-sm font-bold">✕</a>
                    @endif
                </div>
            </form>

            <!-- KONDISI: daftar berita KOSONG (tidak ada hasil pencarian) -->
            @if($newsList->isEmpty())
                <div class="text-center py-20">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                    </div>
                    <p class="font-bold text-gray-500">Belum ada berita ditemukan</p>
                    <!-- SARAN PERBAIKAN: hanya tampil bila ada filter aktif -->
                    @if(request()->anyFilled(['search', 'kategori']))
                        <p class="text-sm text-gray-400 mt-1">Coba ubah kata kunci atau filter kategori</p>
                    @endif
                </div>
            @else
                <!-- GRID KARTU BERITA: satu kartu untuk setiap item di $newsList -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($newsList as $item)
                        <!-- KARTU BERITA: klik mengarah ke halaman detail berita (route news.show, parameter slug) -->
                        <a href="{{ route('news.show', $item->slug) }}" class="group bg-white rounded-2xl border border-emerald-100 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex flex-col">
                            <!-- FOTO UTAMA: tampil bila berita punya foto; bila tidak, tampil placeholder -->
                            @if($item->foto_utama)
                                <div class="aspect-[16/9] overflow-hidden">
                                    <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="{{ $item->judul }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @else
                                <div class="aspect-[16/9] bg-emerald-50 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                                </div>
                            @endif
                            <div class="p-5 flex-1 flex flex-col">
                                <!-- META BERITA: badge kategori dan tanggal kegiatan (bila diisi) -->
                                <div class="flex items-center gap-2 mb-2">
                                    @if($item->kategori)
                                        <span class="text-[0.6rem] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full">{{ $item->kategori }}</span>
                                    @endif
                                    @if($item->tanggal_kegiatan)
                                        <span class="text-[0.6rem] text-gray-400 font-medium">{{ $item->tanggal_kegiatan->format('d M Y') }}</span>
                                    @endif
                                </div>
                                <!-- JUDUL BERITA: dibatasi 2 baris (line-clamp-2) -->
                                <h3 class="font-bold text-base text-emerald-800 group-hover:text-emerald-600 transition-colors leading-snug mb-2 line-clamp-2">{{ $item->judul }}</h3>
                                <!-- RINGKASAN: cuplikan singkat berita (bila diisi) -->
                                @if($item->ringkasan)
                                    <p class="text-sm text-gray-500 line-clamp-2 flex-1">{{ $item->ringkasan }}</p>
                                @endif
                                <!-- TAUTAN BACA SELENGKAPNYA -->
                                <div class="mt-4 pt-3 border-t border-gray-100">
                                    <span class="text-xs font-bold text-emerald-600 group-hover:text-emerald-500 inline-flex items-center gap-1">
                                        Baca Selengkapnya
                                        <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- PAGINASI: tampil bila hasil lebih dari satu halaman (laravel pagination links) -->
            @if($newsList->hasPages())
                <div class="mt-10">
                    {{ $newsList->links() }}
                </div>
            @endif

        </div>
    </div>

    <!-- FOOTER PUBLIK: komponen bersama bagian bawah halaman -->
    @include('partials.footer')

</body>
</html>