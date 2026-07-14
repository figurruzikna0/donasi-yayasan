<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'success', 'message' => '', 'title' => '', 'errors' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['type' => 'success', 'message' => '', 'title' => '', 'errors' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $config = match($type) {
        'success' => [
            'bg' => 'bg-white dark:bg-slate-800',
            'border' => 'border-emerald-200 dark:border-emerald-700',
            'accent' => 'bg-emerald-500',
            'shadow' => 'shadow-lg shadow-emerald-500/15 dark:shadow-emerald-900/30',
            'icon' => 'text-emerald-600 dark:text-emerald-300',
            'iconBg' => 'bg-emerald-100 dark:bg-emerald-900/60',
            'textTitle' => 'text-emerald-800 dark:text-emerald-200',
            'textMsg' => 'text-emerald-700/80 dark:text-emerald-300/70',
            'title' => $title ?: 'Berhasil',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        'error' => [
            'bg' => 'bg-white dark:bg-slate-800',
            'border' => 'border-rose-200 dark:border-rose-700',
            'accent' => 'bg-rose-500',
            'shadow' => 'shadow-lg shadow-rose-500/15 dark:shadow-rose-900/30',
            'icon' => 'text-rose-600 dark:text-rose-300',
            'iconBg' => 'bg-rose-100 dark:bg-rose-900/60',
            'textTitle' => 'text-rose-800 dark:text-rose-200',
            'textMsg' => 'text-rose-700/80 dark:text-rose-300/70',
            'title' => $title ?: 'Gagal',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        'warning' => [
            'bg' => 'bg-white dark:bg-slate-800',
            'border' => 'border-amber-200 dark:border-amber-700',
            'accent' => 'bg-amber-500',
            'shadow' => 'shadow-lg shadow-amber-500/15 dark:shadow-amber-900/30',
            'icon' => 'text-amber-600 dark:text-amber-300',
            'iconBg' => 'bg-amber-100 dark:bg-amber-900/60',
            'textTitle' => 'text-amber-800 dark:text-amber-200',
            'textMsg' => 'text-amber-700/80 dark:text-amber-300/70',
            'title' => $title ?: 'Perhatian',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>',
        ],
        'info' => [
            'bg' => 'bg-white dark:bg-slate-800',
            'border' => 'border-sky-200 dark:border-sky-700',
            'accent' => 'bg-sky-500',
            'shadow' => 'shadow-lg shadow-sky-500/15 dark:shadow-sky-900/30',
            'icon' => 'text-sky-600 dark:text-sky-300',
            'iconBg' => 'bg-sky-100 dark:bg-sky-900/60',
            'textTitle' => 'text-sky-800 dark:text-sky-200',
            'textMsg' => 'text-sky-700/80 dark:text-sky-300/70',
            'title' => $title ?: 'Informasi',
            'svg' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        ],
        default => [],
    };

    $hasErrors = $errors && count($errors) > 0;
?>

<div x-data="{ show: true }"
     x-show="show"
     x-transition:enter="transition ease-out duration-400"
     x-transition:enter-start="opacity-0 -translate-y-6 scale-95"
     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
     x-transition:leave-end="opacity-0 translate-y-4 scale-95"
     <?php if(!$hasErrors): ?> x-init="setTimeout(() => show = false, 5000)" <?php endif; ?>
     class="relative w-full max-w-md <?php echo e($config['bg']); ?> <?php echo e($config['border']); ?> border <?php echo e($config['shadow']); ?> shadow-lg rounded-xl overflow-hidden">

    
    <div class="absolute left-0 top-0 bottom-0 w-1 <?php echo e($config['accent']); ?>"></div>

    <div class="relative pl-5 pr-4 py-4">
        <div class="flex items-start gap-3.5">
            <div class="w-10 h-10 rounded-xl <?php echo e($config['iconBg']); ?> flex items-center justify-center flex-shrink-0 <?php echo e($config['icon']); ?>">
                <?php echo $config['svg']; ?>

            </div>
            <div class="flex-1 min-w-0 pt-0.5">
                <div class="flex items-center gap-2">
                    <p class="font-bold text-sm <?php echo e($config['textTitle']); ?>"><?php echo e($hasErrors ? ($title ?: 'Harap perbaiki kesalahan berikut') : $config['title']); ?></p>
                </div>
                <?php if($hasErrors): ?>
                    <ul class="mt-2 space-y-1.5">
                        <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="text-xs <?php echo e($config['textMsg']); ?> flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo e($config['accent']); ?> mt-1 flex-shrink-0"></span>
                                <?php echo e($error); ?>

                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-xs <?php echo e($config['textMsg']); ?> mt-0.5 leading-relaxed"><?php echo e($message); ?></p>
                <?php endif; ?>
            </div>
            <button @click="show = false" class="flex-shrink-0 w-7 h-7 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 flex items-center justify-center text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition-all duration-200 -mr-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>

    
    <?php if(!$hasErrors): ?>
        <div class="absolute bottom-0 left-1 right-0 h-0.5 bg-slate-100 dark:bg-slate-700">
            <div class="h-full rounded-full <?php echo e($config['accent']); ?> transition-all duration-[5000ms] ease-linear"
                 style="width: 100%"
                 x-init="$el.style.width = '0%'">
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/components/alert.blade.php ENDPATH**/ ?>