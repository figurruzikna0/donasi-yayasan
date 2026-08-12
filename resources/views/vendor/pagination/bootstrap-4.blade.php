{{-- ====================================================================
     TEMPLATE PAGINATION BAWAAN LARAVEL - BOOTSTRAP 4 (LENGKAP)
     --------------------------------------------------------------------
     Template bawaan Laravel (hasil "php artisan vendor:publish --tag=laravel-pagination").
     Dipakai otomatis saat view memanggil {{ $data->links() }} pada data
     hasil paginate(). Variasi Bootstrap 4: menampilkan nomor halaman,
     tombol prev/next (simbol &lsaquo;/&rsaquo;), dan pemisah "...".
     ==================================================================== --}}
@if ($paginator->hasPages())
    {{-- $paginator: instance LengthAwarePaginator. hasPages() true bila total data > 1 halaman. --}}
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            {{-- Tombol Previous: nonaktif (class disabled) bila di halaman pertama --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            {{-- $elements: array berisi nomor-nomor halaman dan pemisah "..." --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                {{-- Elemen string (misal "...") ditampilkan sebagai pemisah non-aktif --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                {{-- Elemen array (nomor halaman => URL); nomor aktif diberi class 'active' --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            {{-- Tombol Next: nonaktif bila sudah berada di halaman terakhir --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
