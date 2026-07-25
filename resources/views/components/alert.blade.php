@props(['type' => 'success', 'message' => '', 'title' => '', 'errors' => null])

@php
    $config = match($type) {
        'success' => [
            'bg' => 'bg-emerald-50 dark:bg-emerald-950/60',
            'border' => 'border-emerald-200 dark:border-emerald-800',
            'accent' => 'bg-emerald-500',
            'shadow' => 'shadow-lg shadow-emerald-500/20 dark:shadow-emerald-900/40',
            'icon' => 'text-emerald-600 dark:text-emerald-300',
            'iconBg' => 'bg-emerald-100 dark:bg-emerald-900/60',
            'textTitle' => 'text-emerald-900 dark:text-emerald-100',
            'textMsg' => 'text-emerald-700 dark:text-emerald-300',
            'title' => $title ?: 'Berhasil!',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        'error' => [
            'bg' => 'bg-rose-50 dark:bg-rose-950/60',
            'border' => 'border-rose-200 dark:border-rose-800',
            'accent' => 'bg-rose-500',
            'shadow' => 'shadow-lg shadow-rose-500/20 dark:shadow-rose-900/40',
            'icon' => 'text-rose-600 dark:text-rose-300',
            'iconBg' => 'bg-rose-100 dark:bg-rose-900/60',
            'textTitle' => 'text-rose-900 dark:text-rose-100',
            'textMsg' => 'text-rose-700 dark:text-rose-300',
            'title' => $title ?: 'Gagal!',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        'warning' => [
            'bg' => 'bg-amber-50 dark:bg-amber-950/60',
            'border' => 'border-amber-200 dark:border-amber-800',
            'accent' => 'bg-amber-500',
            'shadow' => 'shadow-lg shadow-amber-500/20 dark:shadow-amber-900/40',
            'icon' => 'text-amber-600 dark:text-amber-300',
            'iconBg' => 'bg-amber-100 dark:bg-amber-900/60',
            'textTitle' => 'text-amber-900 dark:text-amber-100',
            'textMsg' => 'text-amber-700 dark:text-amber-300',
            'title' => $title ?: 'Perhatian!',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>',
        ],
        'info' => [
            'bg' => 'bg-sky-50 dark:bg-sky-950/60',
            'border' => 'border-sky-200 dark:border-sky-800',
            'accent' => 'bg-sky-500',
            'shadow' => 'shadow-lg shadow-sky-500/20 dark:shadow-sky-900/40',
            'icon' => 'text-sky-600 dark:text-sky-300',
            'iconBg' => 'bg-sky-100 dark:bg-sky-900/60',
            'textTitle' => 'text-sky-900 dark:text-sky-100',
            'textMsg' => 'text-sky-700 dark:text-sky-300',
            'title' => $title ?: 'Informasi',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        default => [],
    };

    $hasErrors = $errors && count($errors) > 0;
@endphp

<div x-data="{ show: true }"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
     x-transition:leave="transition ease-in duration-250"
     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
     x-transition:leave-end="opacity-0 translate-y-3 scale-95"
     @if(!$hasErrors) x-init="setTimeout(() => show = false, 5000)" @endif
     class="relative w-full max-w-md {{ $config['bg'] }} {{ $config['border'] }} border-2 {{ $config['shadow'] }} rounded-2xl overflow-hidden backdrop-blur-sm">

    {{-- Accent bar kiri --}}
    <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $config['accent'] }}"></div>

    <div class="relative pl-6 pr-4 py-4">
        <div class="flex items-start gap-3.5">
            {{-- Icon --}}
            <div class="w-11 h-11 rounded-xl {{ $config['iconBg'] }} flex items-center justify-center flex-shrink-0 {{ $config['icon'] }} shadow-sm">
                {!! $config['svg'] !!}
            </div>

            {{-- Konten --}}
            <div class="flex-1 min-w-0 pt-0.5">
                <div class="flex items-center gap-2">
                    <p class="font-bold text-sm {{ $config['textTitle'] }}">{{ $hasErrors ? ($title ?: 'Harap perbaiki kesalahan berikut') : $config['title'] }}</p>
                </div>
                @if($hasErrors)
                    <ul class="mt-2 space-y-1.5">
                        @foreach($errors as $error)
                            <li class="text-xs {{ $config['textMsg'] }} flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full {{ $config['accent'] }} mt-1.5 flex-shrink-0"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-xs {{ $config['textMsg'] }} mt-0.5 leading-relaxed">{{ $message }}</p>
                @endif
            </div>

            {{-- Tombol tutup --}}
            <button @click="show = false" class="flex-shrink-0 w-7 h-7 rounded-lg hover:bg-black/5 dark:hover:bg-white/10 flex items-center justify-center text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition-all duration-200 -mr-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>

    {{-- Progress bar bawah (auto-dismiss) --}}
    @if(!$hasErrors)
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/5 dark:bg-white/5">
            <div class="h-full rounded-full {{ $config['accent'] }} transition-all duration-[5000ms] ease-linear"
                 style="width: 100%"
                 x-init="$el.style.width = '0%'">
            </div>
        </div>
    @endif
</div>
