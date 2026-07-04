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
            Kelola Data User
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="bg-base-200 p-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-end justify-between gap-3 mb-7 flex-wrap">
                <div>
                    <nav class="text-sm text-emerald-500 mb-1">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="link link-hover text-emerald-600">Dashboard</a>
                        <span class="mx-1">/</span>
                        <span class="text-emerald-600">Data User</span>
                    </nav>
                    <h1 class="text-2xl font-black text-emerald-700">Data Seluruh User</h1>
                    <p class="text-sm text-emerald-500 mt-1">Kelola data donatur dan admin yang terdaftar.</p>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success mb-5">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-error mb-5">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            
            <div class="card bg-base-100 shadow-md border border-emerald-200 mb-8">
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 p-4 flex items-center gap-3">
                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center text-lg">👥</div>
                    <div>
                        <p class="text-white font-extrabold text-sm">Donatur Terdaftar</p>
                        <p class="text-white/75 text-xs">Total: <?php echo e($donaturs->total()); ?> akun</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $donaturs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="w-9 rounded-full">
                                                    <?php if($user->avatar): ?>
                                                        <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" alt="<?php echo e($user->name); ?>" class="object-cover">
                                                    <?php else: ?>
                                                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=b3e093&color=5c8148&bold=true" alt="">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="font-bold text-sm text-emerald-700"><?php echo e($user->name); ?></div>
                                        </div>
                                    </td>
                                    <td class="text-sm"><?php echo e($user->email); ?></td>
                                    <td class="text-sm"><?php echo e($user->phone ?? '-'); ?></td>
                                    <td>
                                        <?php if($user->email_verified_at): ?>
                                            <span class="badge badge-success badge-sm">Terverifikasi</span>
                                        <?php else: ?>
                                            <span class="badge badge-ghost badge-sm">Belum Verifikasi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-sm btn-ghost">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-3.5 h-3.5"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                Edit
                                            </a>
                                            <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST"
                                                  x-data="{ open: false }" @submit.prevent="open = true">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" @click="open = true" class="btn btn-sm btn-error">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-3.5 h-3.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    Hapus
                                                </button>
                                                <dialog class="modal" :class="{ 'modal-open': open }">
                                                    <div class="modal-box">
                                                        <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                                                        <p class="py-4">Yakin ingin menghapus user <strong><?php echo e($user->name); ?></strong>?</p>
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
                                    <td colspan="5" class="text-center py-10 text-base-content/60">Belum ada donatur terdaftar.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if($donaturs->hasPages()): ?>
                    <div class="p-4 border-t border-emerald-100">
                        <?php echo e($donaturs->links()); ?>

                    </div>
                <?php endif; ?>
            </div>

            
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-500 p-4 flex items-center gap-3">
                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center text-lg">🔐</div>
                    <div>
                        <p class="text-white font-extrabold text-sm">Admin</p>
                        <p class="text-white/75 text-xs">Total: <?php echo e($admins->count()); ?> akun</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="w-9 rounded-full">
                                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=7c3aed&color=ffffff&bold=true" alt="">
                                                </div>
                                            </div>
                                            <div class="font-bold text-sm text-emerald-700"><?php echo e($user->name); ?></div>
                                        </div>
                                    </td>
                                    <td class="text-sm"><?php echo e($user->email); ?></td>
                                    <td>
                                        <?php if($user->email_verified_at): ?>
                                            <span class="badge badge-success badge-sm">Terverifikasi</span>
                                        <?php else: ?>
                                            <span class="badge badge-ghost badge-sm">Belum Verifikasi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-sm btn-ghost">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-3.5 h-3.5"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-10 text-base-content/60">Belum ada admin.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/users/index.blade.php ENDPATH**/ ?>