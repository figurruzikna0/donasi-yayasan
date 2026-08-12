{{-- ====================================================================
     TEMPLATE PAGINATION BAWAAN LARAVEL - SIMPLE BOOTSTRAP 3
     --------------------------------------------------------------------
     Template bawaan Laravel (hasil "php artisan vendor:publish --tag=laravel-pagination").
     Versi "simple" hanya menampilkan tombol Previous/Next (tanpa nomor
     halaman), cocok untuk navigasi data yang ringkas dengan gaya Bootstrap 3.
     ==================================================================== --}}
@if ($paginator->hasPages())
    {{-- $paginator: instance Paginator (simplePaginate). hasPages() true bila ada > 1 halaman. --}}
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            {{-- Tombol Previous: nonaktif (class disabled) bila di halaman pertama --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true"><span>@lang('pagination.previous')</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
            @endif

            {{-- Next Page Link --}}
            {{-- Tombol Next: nonaktif bila sudah berada di halaman terakhir --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
            @else
                <li class="disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>
            @endif
        </ul>
    </nav>
@endif
