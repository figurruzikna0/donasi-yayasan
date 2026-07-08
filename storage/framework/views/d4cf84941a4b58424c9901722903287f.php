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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Kelola Data Pendiri Yayasan</h1>
                            <p class="text-sm text-base-content/50">Kelola data pendiri yayasan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-6 h-fit">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">➕</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Tambah Pendiri Baru</p>
                        </div>
                    </div>

                    <form action="<?php echo e(route('admin.pendiri.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-base-content/70 text-xs">Nama Lengkap</span>
                            </label>
                            <input type="text" name="nama" class="input input-bordered w-full input-sm" required>
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-base-content/70 text-xs">Jabatan</span>
                            </label>
                            <input type="text" name="jabatan" class="input input-bordered w-full input-sm" required>
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-base-content/70 text-xs">Kata Sambutan / Deskripsi</span>
                            </label>
                            <textarea name="deskripsi" rows="3" class="textarea textarea-bordered w-full text-sm" placeholder="Tulis visi atau kata sambutan pendiri..."></textarea>
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold text-base-content/70 text-xs">Foto Pendiri</span>
                            </label>
                            <input type="file" name="foto" class="file-input file-input-bordered w-full input-sm" required>
                        </div>

                        <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 w-full font-bold rounded-lg">
                            Simpan Data Pendiri
                        </button>
                    </form>
                </div>

                
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">👥</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Daftar Pendiri</p>
                            <p class="text-xs text-base-content/50">Seluruh data pendiri yayasan</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr class="bg-base-200/50">
                                    <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Foto</th>
                                    <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Profil</th>
                                    <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $pendiris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendiri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-base-200/30 transition-colors">
                                        <td>
                                            <?php if($pendiri->foto): ?>
                                                <div class="avatar">
                                                    <div class="w-12 h-12 rounded-lg ring ring-base-300 ring-offset-1">
                                                        <img src="<?php echo e(asset('storage/' . $pendiri->foto)); ?>" alt="Foto <?php echo e($pendiri->nama); ?>" class="object-cover">
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary font-extrabold text-lg flex items-center justify-center ring ring-base-300"><?php echo e(strtoupper(substr($pendiri->nama, 0, 1))); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="font-bold text-sm text-base-content"><?php echo e($pendiri->nama); ?></div>
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-primary/5 text-primary border border-primary/20 mt-1"><?php echo e($pendiri->jabatan); ?></span>
                                            <p class="text-sm text-base-content/50 mt-2 italic line-clamp-3">
                                                "<?php echo e($pendiri->deskripsi ?? 'Belum ada kata sambutan.'); ?>"
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <form action="<?php echo e(route('admin.pendiri.destroy', $pendiri->id)); ?>" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold mt-2">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    Hapus
                                                </button>
                                                <?php if (isset($component)) { $__componentOriginal1978ea6189800d3ead8e1d285a55da54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1978ea6189800d3ead8e1d285a55da54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.confirm-delete-modal','data' => ['entityName' => ''.e($pendiri->nama).'','entityType' => 'pengurus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirm-delete-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['entity-name' => ''.e($pendiri->nama).'','entity-type' => 'pengurus']); ?>
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
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="3">
                                            <div class="py-16 text-center">
                                                <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                    <svg class="w-8 h-8 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857"/></svg>
                                                </div>
                                                <p class="font-extrabold text-base-content">Belum ada data pendiri</p>
                                                <p class="text-sm text-base-content/50 mt-1">Tambahkan data pendiri yayasan menggunakan form di samping.</p>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/pendiri/index.blade.php ENDPATH**/ ?>