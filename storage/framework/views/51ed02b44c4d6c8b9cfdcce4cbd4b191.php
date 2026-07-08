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
    <div class="bg-base-200 min-h-screen">

        
        <div class="px-8 pt-8 pb-0">
            <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Kelola Data Anak Asuh</h1>
                            <p class="text-sm text-base-content/50">Pantau dan kelola daftar seluruh anak asuh yayasan.</p>
                        </div>
                    </div>
                </div>
                <a href="<?php echo e(route('admin.foster-children.create')); ?>" class="btn bg-primary hover:bg-primary/90 text-white border-0 font-bold shadow-sm rounded-lg gap-2">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah Anak Asuh
                </a>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            
            <div class="grid grid-cols-4 gap-4 max-lg:grid-cols-2 max-sm:grid-cols-1">
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Anak Asuh</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($children->count()); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 3h5m0 0v5m0-5l-6 6M12 12a5 5 0 100-10 5 5 0 000 10zm0 0v9"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Laki-laki</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($children->where('jenis_kelamin', 'Laki-laki')->count()); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-pink-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14a5 5 0 100-10 5 5 0 000 10zm0 0v4m-3 2h6"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Perempuan</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($children->where('jenis_kelamin', 'Perempuan')->count()); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-rose-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Sedang Diasuh</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($children->where('status', '!=', 'Tersedia')->count()); ?></div>
                    </div>
                </div>
            </div>

            
            <?php if(session('success')): ?>
                <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'success','message' => ''.e(session('success')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'success','message' => ''.e(session('success')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
            <?php endif; ?>

            
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-lg shrink-0">👶</div>
                    <div>
                        <p class="font-extrabold text-sm text-base-content">Daftar Anak Asuh</p>
                        <p class="text-xs text-base-content/50">Seluruh data anak yang terdaftar dalam program OTA</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Foto</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nama</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Umur</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Jenis Kelamin</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <td>
                                        <?php if($child->photo): ?>
                                            <div class="avatar">
                                                <div class="w-11 h-11 rounded-lg ring ring-base-300 ring-offset-1">
                                                    <img src="<?php echo e(asset('storage/' . $child->photo)); ?>" alt="Foto <?php echo e($child->name); ?>" class="object-cover">
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="w-11 h-11 rounded-lg bg-base-200 flex items-center justify-center ring ring-base-300">
                                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-base-content/30"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <span class="font-bold text-sm text-base-content"><?php echo e($child->name); ?></span>
                                    </td>

                                    <td>
                                        <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-base-content/60">
                                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-base-content/30" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <?php echo e($child->age); ?> Thn
                                        </span>
                                    </td>

                                    <td>
                                        <?php if($child->jenis_kelamin === 'Laki-laki'): ?>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 3h5m0 0v5m0-5l-6 6M12 12a5 5 0 100-10 5 5 0 000 10zm0 0v9"/></svg>
                                                Laki-laki
                                            </span>
                                        <?php elseif($child->jenis_kelamin === 'Perempuan'): ?>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-pink-100 text-pink-700">
                                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14a5 5 0 100-10 5 5 0 000 10zm0 0v4m-3 2h6"/></svg>
                                                Perempuan
                                            </span>
                                        <?php else: ?>
                                            <span class="text-base-content/30 text-xs">—</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if($child->status == 'Tersedia'): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Tersedia
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary">
                                                <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                                Diasuh
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="<?php echo e(route('admin.foster-children.show', $child->id)); ?>" class="btn btn-sm btn-ghost text-base-content/50 hover:text-primary hover:bg-primary/5 rounded-lg font-bold">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/></svg>
                                                Detail
                                            </a>
                                            <a href="<?php echo e(route('admin.foster-children.edit', $child->id)); ?>" class="btn btn-sm btn-ghost text-base-content/50 hover:text-warning hover:bg-warning/5 rounded-lg font-bold">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            <form action="<?php echo e(route('admin.foster-children.destroy', $child->id)); ?>" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    Hapus
                                                </button>

                                                <?php if (isset($component)) { $__componentOriginal1978ea6189800d3ead8e1d285a55da54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1978ea6189800d3ead8e1d285a55da54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.confirm-delete-modal','data' => ['entityName' => ''.e($child->name).'','entityType' => 'anak asuh']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirm-delete-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['entity-name' => ''.e($child->name).'','entity-type' => 'anak asuh']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1978ea6189800d3ead8e1d285a55da54)): ?>
<?php $attributes = $__attributesOriginal1978ea6189800d3ead8e1d285a55da54; ?>
<?php unset($__attributesOriginal1978ea6189800d3ead8e1d285a55da54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1978ea6189800d3ead8e1d285a55da54)): ?>
<?php $component = $__componentOriginal1978ea6189800d3ead8e1d285a55da54; ?>
<?php unset($__componentOriginal1978ea6189800d3ead8e1d285a55da54); ?>
<?php endif; ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="py-16 text-center">
                                            <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-base-content">Belum ada data anak asuh</p>
                                            <p class="text-sm text-base-content/50 mt-1">Mulai dengan menambahkan data anak asuh baru ke sistem.</p>
                                        </div>
                                    </td>
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
<?php if (isset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $attributes = $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/foster_children/index.blade.php ENDPATH**/ ?>