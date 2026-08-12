{{-- ====================================================================
     TEMPLATE PAGINATION BAWAAN LARAVEL - BOOTSTRAP 5 (LENGKAP)
     --------------------------------------------------------------------
     Template bawaan Laravel (hasil "php artisan vendor:publish --tag=laravel-pagination").
     Dipakai otomatis saat view memanggil {{ $data->links() }} pada data
     hasil paginate(). Variasi Bootstrap 5 dengan kelas .pagination,
     menampilkan nomor halaman, tombol prev/next, pemisah "...",
     serta info "Showing X to Y of Z results".
     ==================================================================== --}}
@if ($paginator->hasPages())
    {{-- $paginator: instance LengthAwarePaginator. hasPages() true bila total data > 1 halaman. --}}
    <nav class="d-flex justify-items-center justify-content-between">
        {{-- Tampilan ringkas (prev/next) khusus layar kecil (mobile) --}}
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                {{-- Tombol Previous: nonaktif (class disabled) bila di halaman pertama --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                {{-- Tombol Next: nonaktif bila sudah di halaman terakhir --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>

        {{-- Tampilan lengkap untuk layar besar (sm ke atas) --}}
        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            {{-- Info jumlah data yang sedang ditampilkan --}}
            <div class="small text-muted">
                {!! __('Showing') !!}
                <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                {!! __('of') !!}
                <span class="fw-semibold">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </div>

            {{-- Deretan nomor halaman + tombol prev/next --}}
            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
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
            </div>
        </div>
    </nav>
@endif
