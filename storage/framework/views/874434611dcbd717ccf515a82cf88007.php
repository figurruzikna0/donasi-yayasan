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
            Kelola Kampanye Donasi
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="bg-base-200 p-8">

        
        <div class="flex items-end justify-between gap-3 mb-7 flex-wrap">
            <div>
                <nav class="text-sm text-emerald-500 mb-1">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="link link-hover text-emerald-600">Dashboard</a>
                    <span class="mx-1">/</span>
                    <span class="text-emerald-600">Kelola Kampanye</span>
                </nav>
                <h1 class="text-2xl font-black text-emerald-700">Daftar Kampanye Donasi</h1>
                <p class="text-sm text-emerald-500 mt-1">Kelola program donasi untuk memberikan dampak lebih luas.</p>
            </div>
            <a href="<?php echo e(route('admin.campaigns.create')); ?>" class="btn btn-success">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kampanye
            </a>
        </div>

        
        <div class="grid grid-cols-3 gap-4 mb-6 max-sm:grid-cols-1">
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body flex-row items-center gap-3 p-5">
                    <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold uppercase tracking-wider text-emerald-500">Total Kampanye</div>
                        <div class="text-2xl font-black text-emerald-700"><?php echo e($campaigns->count()); ?></div>
                    </div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body flex-row items-center gap-3 p-5">
                    <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold uppercase tracking-wider text-emerald-500">Aktif</div>
                        <div class="text-2xl font-black text-emerald-700"><?php echo e($campaigns->where('status', 'active')->count()); ?></div>
                    </div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body flex-row items-center gap-3 p-5">
                    <div class="w-11 h-11 rounded-xl bg-emerald-600 text-white flex items-center justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold uppercase tracking-wider text-emerald-500">Tidak Aktif</div>
                        <div class="text-2xl font-black text-emerald-700"><?php echo e($campaigns->where('status', '!=', 'active')->count()); ?></div>
                    </div>
                </div>
            </div>
        </div>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success mb-5">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="card bg-base-100 shadow-md border border-emerald-200">
            <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-4 flex items-center gap-3">
                <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center text-lg">📢</div>
                <div>
                    <p class="text-white font-extrabold text-sm">Daftar Kampanye Donasi</p>
                    <p class="text-white/75 text-xs">Seluruh kampanye donasi yang terdaftar di sistem</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Detail Kampanye</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <div class="w-[76px] h-14 rounded-lg overflow-hidden border border-emerald-200 flex-shrink-0">
                                        <img src="<?php echo e(asset('storage/' . $campaign->image)); ?>" alt="<?php echo e($campaign->title); ?>" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td>
                                    <div class="font-extrabold text-emerald-700 text-sm mb-1"><?php echo e($campaign->title); ?></div>
                                    <div class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-500">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Target: <strong class="text-emerald-700 font-extrabold">Rp <?php echo e(number_format($campaign->target_amount, 0, ',', '.')); ?></strong>
                                    </div>
                                </td>
                                <td>
                                    <?php if($campaign->status == 'active'): ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-ghost">Tidak Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="<?php echo e(route('admin.campaigns.show', $campaign->id)); ?>" class="btn btn-sm btn-ghost text-emerald-600">
                                            👁 Detail
                                        </a>
                                        <a href="<?php echo e(route('admin.campaigns.edit', $campaign->id)); ?>" class="btn btn-sm btn-ghost">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                            Edit
                                        </a>
                                        <form action="<?php echo e(route('admin.campaigns.destroy', $campaign->id)); ?>" method="POST"
                                              x-data="{ open: false }" @submit.prevent="open = true">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" @click="open = true" class="btn btn-sm btn-error">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                Hapus
                                            </button>
                                            <dialog class="modal" :class="{ 'modal-open': open }">
                                                <div class="modal-box"><h3 class="font-bold text-lg">Konfirmasi Hapus</h3><p class="py-4">Yakin ingin menghapus kampanye <strong><?php echo e($campaign->title); ?></strong>?</p>
                                                    <div class="modal-action">
                                                        <button type="button" @click="open = false" class="btn btn-ghost">Batal</button>
                                                        <button @click="open = false; $el.closest('form').submit()" class="btn btn-error">Hapus</button>
                                                    </div>
                                                </div>
                                            </dialog>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4">
                                    <div class="py-14 text-center">
                                        <div class="w-13 h-13 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" class="w-6 h-6 text-emerald-400"><path d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <p class="font-extrabold text-emerald-700">Belum ada kampanye donasi</p>
                                        <p class="text-sm text-emerald-500">Mulai dengan membuat kampanye donasi pertama untuk yayasan.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
<?php endif; ?><?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/campaigns/index.blade.php ENDPATH**/ ?>