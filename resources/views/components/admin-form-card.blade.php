@props([
    'icon' => null,
    'title' => '',
    'subtitle' => '',
    'maxWidth' => '3xl',
])

@php
    $maxWidthClass = match($maxWidth) {
        '2xl' => 'max-w-2xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
        'full' => 'max-w-full',
        default => 'max-w-3xl',
    };
@endphp

<div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
    <div class="{{ $maxWidthClass }} mx-auto sm:px-6 lg:px-8">
        <div class="card bg-base-100 shadow-lg border border-emerald-200">
            <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                @if($icon)
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                    {!! $icon !!}
                </div>
                @endif
                <div>
                    <h3 class="text-white font-bold text-lg">{{ $title }}</h3>
                    @if($subtitle)
                    <p class="text-white/80 text-sm">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
            <div class="card-body p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
