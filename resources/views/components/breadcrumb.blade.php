@props(['items' => []])
<div class="breadcrumbs text-sm px-4 sm:px-6 lg:px-8 pt-4">
    <ul class="gap-1">
        <li>
            <a href="{{ url('/') }}" class="text-base-content/50 hover:text-primary transition-colors font-semibold">
                <svg class="w-3.5 h-3.5 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
        </li>
        @foreach($items as $label => $url)
            <li>
                @if(is_string($url))
                    <a href="{{ $url }}" class="text-base-content/50 hover:text-primary transition-colors font-semibold">{{ $label }}</a>
                @else
                    <span class="text-base-content/70 font-semibold">{{ $label }}</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
