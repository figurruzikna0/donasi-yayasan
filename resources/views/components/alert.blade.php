@props(['type' => 'success', 'message' => '', 'title' => '', 'errors' => null])

@php
    $config = match($type) {
        'success' => [
            'bg' => 'bg-emerald-50',
            'border' => 'border-emerald-200',
            'icon' => 'text-emerald-500',
            'badge' => 'bg-emerald-500',
            'title' => $title ?: 'Berhasil',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        'error' => [
            'bg' => 'bg-rose-50',
            'border' => 'border-rose-200',
            'icon' => 'text-rose-500',
            'badge' => 'bg-rose-500',
            'title' => $title ?: 'Gagal',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        'warning' => [
            'bg' => 'bg-amber-50',
            'border' => 'border-amber-200',
            'icon' => 'text-amber-500',
            'badge' => 'bg-amber-500',
            'title' => $title ?: 'Perhatian',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>',
        ],
        'info' => [
            'bg' => 'bg-sky-50',
            'border' => 'border-sky-200',
            'icon' => 'text-sky-500',
            'badge' => 'bg-sky-500',
            'title' => $title ?: 'Informasi',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        default => [],
    };

    $hasErrors = $errors && count($errors) > 0;
@endphp

<div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 -translate-y-2"
     @if(!$hasErrors) x-init="setTimeout(() => show = false, 5000)" @endif
     class="{{ $config['bg'] }} {{ $config['border'] }} border-l-4 rounded-xl px-4 py-3.5 shadow-sm {{ $hasErrors ? 'border-2' : '' }} relative overflow-hidden group">
    <div class="flex items-start gap-3">
        <div class="w-9 h-9 rounded-full {{ $config['bg'] }} flex items-center justify-center flex-shrink-0 {{ $config['icon'] }}">
            {!! $config['svg'] !!}
        </div>
        <div class="flex-1 min-w-0 pt-0.5">
            <p class="font-bold text-sm text-base-content">{{ $hasErrors ? ($title ?: 'Harap perbaiki kesalahan berikut') : $config['title'] }}</p>
            @if($hasErrors)
                <ul class="mt-2 space-y-1">
                    @foreach($errors as $error)
                        <li class="text-xs text-base-content/60 flex items-start gap-1.5">
                            <span class="text-rose-400 mt-0.5 flex-shrink-0">•</span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-xs text-base-content/60 mt-0.5">{{ $message }}</p>
            @endif
        </div>
        <button @click="show = false" class="flex-shrink-0 w-6 h-6 rounded-full hover:bg-base-300/50 flex items-center justify-center text-base-content/30 hover:text-base-content/60 transition-colors mt-0.5 opacity-0 group-hover:opacity-100">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    @if(!$hasErrors)
        <div class="absolute bottom-0 left-0 h-1 {{ $config['badge'] }} transition-all duration-[5000ms] ease-linear"
             style="width: 100%"
             x-init="$el.style.width = '0%'">
        </div>
    @endif
</div>
