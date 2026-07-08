<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'icon' => null,
    'title' => '',
    'subtitle' => '',
    'maxWidth' => '3xl',
]));

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

foreach (array_filter(([
    'icon' => null,
    'title' => '',
    'subtitle' => '',
    'maxWidth' => '3xl',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $maxWidthClass = match($maxWidth) {
        '2xl' => 'max-w-2xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
        'full' => 'max-w-full',
        default => 'max-w-3xl',
    };
?>

<div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
    <div class="<?php echo e($maxWidthClass); ?> mx-auto sm:px-6 lg:px-8">
        <div class="card bg-base-100 shadow-lg border border-emerald-200">
            <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                <?php if($icon): ?>
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                    <?php echo $icon; ?>

                </div>
                <?php endif; ?>
                <div>
                    <h3 class="text-white font-bold text-lg"><?php echo e($title); ?></h3>
                    <?php if($subtitle): ?>
                    <p class="text-white/80 text-sm"><?php echo e($subtitle); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body p-8">
                <?php echo e($slot); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/components/admin-form-card.blade.php ENDPATH**/ ?>