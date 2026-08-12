{{-- ====================================================================
     TEMPLATE PAGINATION BAWAAN LARAVEL - SEMANTIC UI (LENGKAP)
     --------------------------------------------------------------------
     Template bawaan Laravel (hasil "php artisan vendor:publish --tag=laravel-pagination").
     Variasi untuk framework CSS Semantic UI (kelas "ui pagination menu").
     Menampilkan nomor halaman, tombol prev/next, dan pemisah "...".
     Template ini dipakai bila halaman memanggil {{ $data->links() }}
     dan aplikasi menggunakan pagination_view bertipe Semantic UI.
     ==================================================================== --}}
@if ($paginator->hasPages())
    {{-- $paginator: instance LengthAwarePaginator. hasPages() true bila total data > 1 halaman. --}}
    <div class="ui pagination menu" role="navigation">
        {{-- Previous Page Link --}}
        {{-- Tombol Previous (ikon chevron kiri): nonaktif bila di halaman pertama --}}
        @if ($paginator->onFirstPage())
            <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"> <i class="left chevron icon"></i> </a>
        @else
            <a class="icon item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"> <i class="left chevron icon"></i> </a>
        @endif

        {{-- Pagination Elements --}}
        {{-- $elements: array berisi nomor-nomor halaman dan pemisah "..." --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            {{-- Elemen string (misal "...") ditampilkan sebagai pemisah non-aktif --}}
            @if (is_string($element))
                <a class="icon item disabled" aria-disabled="true">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            {{-- Elemen array (nomor halaman => URL); nomor aktif diberi class 'active' --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="item active" href="{{ $url }}" aria-current="page">{{ $page }}</a>
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        {{-- Tombol Next (ikon chevron kanan): nonaktif bila sudah di halaman terakhir --}}
        @if ($paginator->hasMorePages())
            <a class="icon item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"> <i class="right chevron icon"></i> </a>
        @else
            <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.next')"> <i class="right chevron icon"></i> </a>
        @endif
    </div>
@endif
