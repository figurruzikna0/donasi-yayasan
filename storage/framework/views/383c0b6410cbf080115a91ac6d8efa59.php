<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Detail Laporan Perkembangan
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white text-lg">📈</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Detail Perkembangan</h3>
                        <p class="text-white/80 text-sm"><?php echo e($childDevelopment->judul); ?></p>
                    </div>
                </div>

                <div class="card-body p-8 space-y-6">

                    <div>
                        <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold">Judul Laporan</p>
                        <p class="text-lg font-bold text-emerald-700"><?php echo e($childDevelopment->judul); ?></p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Anak Asuh</p>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="avatar">
                                    <div class="w-8 rounded-full ring ring-emerald-200">
                                        <?php if($childDevelopment->fosterChild?->photo): ?>
                                            <img src="<?php echo e(asset('storage/' . $childDevelopment->fosterChild->photo)); ?>" alt="">
                                        <?php else: ?>
                                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($childDevelopment->fosterChild?->name ?? '?')); ?>&background=b3e093&color=5c8148&bold=true" alt="">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <span class="font-bold text-emerald-700"><?php echo e($childDevelopment->fosterChild?->name ?? '-'); ?></span>
                            </div>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Tanggal</p>
                            <p class="font-bold text-emerald-700"><?php echo e($childDevelopment->tanggal ? $childDevelopment->tanggal->format('d/m/Y') : '-'); ?></p>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Ditulis oleh</p>
                            <p class="font-bold text-emerald-700"><?php echo e($childDevelopment->user?->name ?? '-'); ?></p>
                        </div>
                    </div>

                    <?php if($childDevelopment->foto): ?>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-2">Foto</p>
                            <a href="<?php echo e(asset('storage/' . $childDevelopment->foto)); ?>" target="_blank">
                                <img src="<?php echo e(asset('storage/' . $childDevelopment->foto)); ?>" class="w-full max-h-64 object-cover rounded-xl border border-emerald-200" alt="<?php echo e($childDevelopment->judul); ?>">
                            </a>
                        </div>
                    <?php endif; ?>

                    <div>
                        <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-1">Deskripsi</p>
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100 text-sm text-base-content/70 leading-relaxed">
                            <?php echo e($childDevelopment->deskripsi); ?>

                        </div>
                    </div>

                    <?php if($childDevelopment->sponsorship): ?>
                        <div class="bg-amber-50 rounded-xl p-4 border border-amber-200 text-sm">
                            <p class="font-bold text-amber-700 mb-1">Informasi Sponsorship</p>
                            <p>Donatur: <?php echo e($childDevelopment->sponsorship->donor_name); ?> · Paket: <?php echo e($childDevelopment->sponsorship->package); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="flex gap-3 pt-4 border-t border-emerald-100">
                        <a href="<?php echo e(route('admin.child-developments.edit', $childDevelopment)); ?>" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 font-bold">
                            ✏️ Edit Laporan
                        </a>
                        <a href="<?php echo e(route('admin.child-developments.index')); ?>" class="btn btn-outline border-emerald-300 text-emerald-600 font-bold">
                            ← Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/child-developments/show.blade.php ENDPATH**/ ?>