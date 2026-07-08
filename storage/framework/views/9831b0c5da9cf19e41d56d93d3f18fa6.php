<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3 = $attributes; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdminLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Detail Kampanye
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white text-lg">💰</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Detail Kampanye</h3>
                        <p class="text-white/80 text-sm"><?php echo e($campaign->title); ?></p>
                    </div>
                </div>

                <div class="card-body p-8 space-y-6">

                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold">Judul Kampanye</p>
                            <p class="text-lg font-bold text-emerald-700"><?php echo e($campaign->title); ?></p>
                        </div>
                        <span class="badge <?php echo e($campaign->status == 'active' ? 'badge-success' : 'badge-ghost'); ?> badge-lg">
                            <?php echo e($campaign->status == 'active' ? 'Aktif' : 'Nonaktif'); ?>

                        </span>
                    </div>

                    <?php if($campaign->image): ?>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-2">Gambar</p>
                            <img src="<?php echo e(asset('storage/' . $campaign->image)); ?>" class="w-full max-h-64 object-cover rounded-xl border border-emerald-200" alt="<?php echo e($campaign->title); ?>">
                        </div>
                    <?php endif; ?>

                    <div>
                        <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-1">Deskripsi</p>
                        <div class="text-sm text-base-content/70 bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <?php echo e($campaign->description); ?>

                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Target Dana</p>
                            <p class="text-xl font-black text-emerald-700">Rp <?php echo e(number_format($campaign->target_amount, 0, ',', '.')); ?></p>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Terkumpul</p>
                            <p class="text-xl font-black text-emerald-700">Rp <?php echo e(number_format($campaign->collected_amount, 0, ',', '.')); ?></p>
                            <?php if($campaign->target_amount > 0): ?>
                                <progress class="progress progress-success w-full mt-2" value="<?php echo e($campaign->collected_amount); ?>" max="<?php echo e($campaign->target_amount); ?>"></progress>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold">Slug</p>
                            <p class="text-base-content/70"><?php echo e($campaign->slug); ?></p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold">Dibuat</p>
                            <p class="text-base-content/70"><?php echo e($campaign->created_at->format('d/m/Y H:i')); ?></p>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-emerald-100">
                        <a href="<?php echo e(route('admin.campaigns.edit', $campaign)); ?>" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 font-bold">
                            ✏️ Edit Kampanye
                        </a>
                        <a href="<?php echo e(route('admin.campaigns.index')); ?>" class="btn btn-outline border-emerald-300 text-emerald-600 font-bold">
                            ← Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $attributes = $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/campaigns/show.blade.php ENDPATH**/ ?>