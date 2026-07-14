@props(['type' => 'success', 'message' => '', 'title' => '', 'errors' => null])

@php
    $config = match($type) {
        'success' => [
            'bg' => 'bg-emerald-50/95 dark:bg-emerald-950/90',
            'border' => 'border-emerald-200 dark:border-emerald-800',
            'ring' => 'ring-emerald-500/20 dark:ring-emerald-400/20',
            'shadow' => 'shadow-emerald-500/10 dark:shadow-emerald-900/30',
            'icon' => 'text-emerald-600 dark:text-emerald-400',
            'iconBg' => 'bg-emerald-100 dark:bg-emerald-900/60',
            'badge' => 'bg-emerald-500',
            'accent' => 'from-emerald-500 to-teal-500',
            'title' => $title ?: 'Berhasil',
            'glow' => 'shadow-emerald-500/20',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        'error' => [
            'bg' => 'bg-rose-50/95 dark:bg-rose-950/90',
            'border' => 'border-rose-200 dark:border-rose-800',
            'ring' => 'ring-rose-500/20 dark:ring-rose-400/20',
            'shadow' => 'shadow-rose-500/10 dark:shadow-rose-900/30',
            'icon' => 'text-rose-600 dark:text-rose-400',
            'iconBg' => 'bg-rose-100 dark:bg-rose-900/60',
            'badge' => 'bg-rose-500',
            'accent' => 'from-rose-500 to-pink-500',
            'title' => $title ?: 'Gagal',
            'glow' => 'shadow-rose-500/20',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        'warning' => [
            'bg' => 'bg-amber-50/95 dark:bg-amber-950/90',
            'border' => 'border-amber-200 dark:border-amber-800',
            'ring' => 'ring-amber-500/20 dark:ring-amber-400/20',
            'shadow' => 'shadow-amber-500/10 dark:shadow-amber-900/30',
            'icon' => 'text-amber-600 dark:text-amber-400',
            'iconBg' => 'bg-amber-100 dark:bg-amber-900/60',
            'badge' => 'bg-amber-500',
            'accent' => 'from-amber-500 to-orange-500',
            'title' => $title ?: 'Perhatian',
            'glow' => 'shadow-amber-500/20',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>',
        ],
        'info' => [
            'bg' => 'bg-sky-50/95 dark:bg-sky-950/90',
            'border' => 'border-sky-200 dark:border-sky-800',
            'ring' => 'ring-sky-500/20 dark:ring-sky-400/20',
            'shadow' => 'shadow-sky-500/10 dark:shadow-sky-900/30',
            'icon' => 'text-sky-600 dark:text-sky-400',
            'iconBg' => 'bg-sky-100 dark:bg-sky-900/60',
            'badge' => 'bg-sky-500',
            'accent' => 'from-sky-500 to-blue-500',
            'title' => $title ?: 'Informasi',
            'glow' => 'shadow-sky-500/20',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        default => [],
    };

    $hasErrors = $errors && count($errors) > 0;

    $enterAnimation = match($type) {
        'success' => 'x-transition:enter-start="opacity-0 translate-x-8 scale-95"',
        'error' => 'x-transition:enter-start="opacity-0 -translate-x-8 scale-95"',
        'warning' => 'x-transition:enter-start="opacity-0 translate-y-4 scale-95"',
        'info' => 'x-transition:enter-start="opacity-0 translate-x-8"',
        default => 'x-transition:enter-start="opacity-0 translate-y-4"',
    };
@endphp

<div x-data="{ show: true }"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     {!! $enterAnimation !!}
     x-transition:enter-end="opacity-100 translate-x-0 translate-y-0 scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-x-0 scale-100"
     x-transition:leave-end="opacity-0 translate-x-8 scale-95"
     @if(!$hasErrors) x-init="setTimeout(() => show = false, 5000)" @endif
     class="relative w-full max-w-md backdrop-blur-xl {{ $config['bg'] }} {{ $config['border'] }} border {{ $config['ring'] }} ring-1 rounded-2xl {{ $config['shadow'] }} shadow-lg overflow-hidden group">

    <div class="absolute inset-0 bg-gradient-to-br from-white/40 to-transparent dark:from-white/5 pointer-events-none"></div>

    <div class="relative px-4 py-3.5">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl {{ $config['iconBg'] }} flex items-center justify-center flex-shrink-0 {{ $config['icon'] }} shadow-inner">
                {!! $config['svg'] !!}
            </div>
            <div class="flex-1 min-w-0 pt-0.5">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-1.5 h-1.5 rounded-full {{ $config['badge'] }} animate-pulse"></span>
                    <p class="font-bold text-sm text-base-content dark:text-white">{{ $hasErrors ? ($title ?: 'Harap perbaiki kesalahan berikut') : $config['title'] }}</p>
                </div>
                @if($hasErrors)
                    <ul class="mt-2 space-y-1.5">
                        @foreach($errors as $error)
                            <li class="text-xs text-base-content/70 dark:text-white/60 flex items-start gap-2">
                                <span class="w-1 h-1 rounded-full {{ $config['badge'] }} mt-1.5 flex-shrink-0"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-xs text-base-content/60 dark:text-white/50 mt-0.5 leading-relaxed">{{ $message }}</p>
                @endif
            </div>
            <button @click="show = false" class="flex-shrink-0 w-7 h-7 rounded-xl hover:bg-base-300/40 dark:hover:bg-white/10 flex items-center justify-center text-base-content/30 dark:text-white/30 hover:text-base-content/50 dark:hover:text-white/50 transition-all duration-200 opacity-0 group-hover:opacity-100 -mr-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>

    @if(!$hasErrors)
        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-base-300/20 dark:bg-white/10">
            <div class="h-full rounded-full {{ $config['badge'] }} transition-all duration-[5000ms] ease-linear"
                 style="width: 100%"
                 x-init="$el.style.width = '0%'">
            </div>
        </div>
    @endif
</div>
