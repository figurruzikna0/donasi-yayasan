{{-- ====================================================================
     TEMPLATE PAGINATION BAWAAN LARAVEL - SIMPLE BOOTSTRAP 5
     --------------------------------------------------------------------
     Template bawaan Laravel (hasil "php artisan vendor:publish --tag=laravel-pagination").
     Versi "simple" hanya menampilkan tombol Previous/Next (tanpa nomor
     halaman), cocok untuk navigasi data yang ringkas dengan gaya Bootstrap 5.
     ==================================================================== --}}
@if ($paginator->hasPages())
    {{-- $paginator: instance Paginator (simplePaginate). hasPages() true bila ada > 1 halaman. --}}
    <nav role="navigation" aria-label="{!! __('Pagination Navigation') !!}">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            {{-- Tombol Previous: nonaktif (class disabled) bila di halaman pertama --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{!! __('pagination.previous') !!}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        {!! __('pagination.previous') !!}
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            {{-- Tombol Next: nonaktif bila sudah berada di halaman terakhir --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">{!! __('pagination.next') !!}</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{!! __('pagination.next') !!}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
