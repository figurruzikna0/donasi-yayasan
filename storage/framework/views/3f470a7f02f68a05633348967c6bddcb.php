<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['entityName' => '', 'entityType' => 'data']));

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

foreach (array_filter((['entityName' => '', 'entityType' => 'data']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<dialog class="modal" :class="{ 'modal-open': open }">
    <div class="modal-box max-w-sm p-0 overflow-hidden">
        <div class="px-6 pt-8 pb-6 text-center">
            <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-rose-50 dark:bg-rose-900/40 flex items-center justify-center shadow-inner">
                <svg class="w-8 h-8 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            </div>
            <h3 class="text-lg font-black text-slate-800 dark:text-white mb-1">Konfirmasi Hapus</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 leading-relaxed">Yakin ingin menghapus <?php echo e($entityType); ?> <strong class="text-slate-800 dark:text-white"><?php echo e($entityName); ?></strong>? Tindakan ini tidak bisa dibatalkan.</p>
            <div class="flex gap-3 justify-center">
                <button type="button" @click="open = false" class="btn btn-ghost btn-sm font-semibold px-6 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">Batal</button>
                <button @click="open = false; $el.closest('form').submit()" class="btn btn-sm font-semibold px-6 text-white bg-rose-500 hover:bg-rose-600 border-none">Hapus</button>
            </div>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/components/confirm-delete-modal.blade.php ENDPATH**/ ?>