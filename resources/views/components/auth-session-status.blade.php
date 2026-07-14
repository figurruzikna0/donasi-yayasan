@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'relative w-full bg-white dark:bg-slate-800 border border-emerald-200 dark:border-emerald-700 rounded-xl shadow-sm shadow-emerald-500/10 overflow-hidden']) }}>
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500"></div>
        <div class="relative pl-5 pr-4 py-3.5">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-100 dark:bg-emerald-900/60 flex items-center justify-center flex-shrink-0 text-emerald-600 dark:text-emerald-300">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-sm text-emerald-800 dark:text-emerald-200 font-medium pt-1">{{ $status }}</p>
            </div>
        </div>
    </div>
@endif
