{{-- ====================================================================
     TEMPLATE PAGINATION BAWAAN LARAVEL - SIMPLE TAILWIND
     --------------------------------------------------------------------
     Template bawaan Laravel (hasil "php artisan vendor:publish --tag=laravel-pagination").
     Versi "simple" hanya menampilkan tombol Previous/Next (tanpa nomor
     halaman), cocok untuk navigasi data yang ringkas.
     ==================================================================== --}}
@if ($paginator->hasPages())
    {{-- $paginator: instance Paginator (paginate sederhana / simplePaginate).
        hasPages() bernilai true bila ada lebih dari satu halaman. --}}
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex gap-2 items-center justify-between">

        {{-- Tombol Previous: nonaktif bila berada di halaman pertama --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Tombol Next: nonaktif bila sudah berada di halaman terakhir --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
                {!! __('pagination.next') !!}
            </span>
        @endif

    </nav>
@endif
