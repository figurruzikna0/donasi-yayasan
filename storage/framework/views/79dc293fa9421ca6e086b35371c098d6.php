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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Berita & Kegiatan</h1>
                            <p class="text-sm text-base-content/50">Publikasikan narasi kegiatan, press release, dan laporan acara yayasan.</p>
                        </div>
                    </div>
                </div>
                <a href="<?php echo e(route('admin.news.create')); ?>" class="btn bg-primary hover:bg-primary/90 text-white border-0 font-bold shadow-sm rounded-lg gap-2">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah Berita
                </a>
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

            
            <div class="grid grid-cols-3 gap-4 max-sm:grid-cols-1">
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-primary" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Berita</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($newsList->total()); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-emerald-700" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Tayang</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($newsList->getCollection()->where('status', 'published')->count()); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-amber-700" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Draft</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($newsList->getCollection()->where('status', 'draft')->count()); ?></div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-lg shrink-0">📰</div>
                    <div>
                        <p class="font-extrabold text-sm text-base-content">Daftar Berita & Kegiatan</p>
                        <p class="text-xs text-base-content/50">Seluruh publikasi kegiatan yayasan</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Foto</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Judul & Kategori</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Tanggal</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Lokasi</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $newsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <td>
                                        <?php if($item->foto_utama): ?>
                                            <div class="avatar">
                                                <div class="w-14 h-10 rounded-lg ring ring-base-300 ring-offset-1">
                                                    <img src="<?php echo e(asset('storage/' . $item->foto_utama)); ?>" alt="<?php echo e($item->judul); ?>" class="object-cover">
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="w-14 h-10 rounded-lg bg-base-200 flex items-center justify-center ring ring-base-300">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" class="w-5 h-5 text-base-content/30">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                                    <path d="m21 15-5-5L5 21"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="font-bold text-sm text-base-content"><?php echo e(Str::limit($item->judul, 55)); ?></span>
                                        <div class="mt-1">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-primary/5 text-primary border border-primary/20">
                                                <?php echo e($item->kategori); ?>

                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm font-semibold text-base-content"><?php echo e($item->tanggal_kegiatan->translatedFormat('d M Y')); ?></div>
                                        <?php if($item->created_at): ?>
                                            <div class="text-xs text-base-content/40 mt-0.5">Dibuat <?php echo e($item->created_at->diffForHumans()); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($item->lokasi): ?>
                                            <span class="inline-flex items-center gap-1.5 text-sm text-base-content/60">
                                                <svg class="w-3.5 h-3.5 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                <?php echo e($item->lokasi); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-sm text-base-content/30">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($item->status === 'published'): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Tayang
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                Draft
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="<?php echo e(route('admin.news.show', $item->id)); ?>" class="btn btn-sm btn-ghost text-base-content/50 hover:text-primary hover:bg-primary/5 rounded-lg font-bold">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/></svg>
                                                Detail
                                            </a>
                                            <a href="<?php echo e(route('admin.news.edit', $item->id)); ?>" class="btn btn-sm btn-ghost text-base-content/50 hover:text-warning hover:bg-warning/5 rounded-lg font-bold">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            <form action="<?php echo e(route('admin.news.destroy', $item->id)); ?>" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    Hapus
                                                </button>

                                                <?php if (isset($component)) { $__componentOriginal1978ea6189800d3ead8e1d285a55da54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1978ea6189800d3ead8e1d285a55da54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.confirm-delete-modal','data' => ['entityName' => ''.e($item->judul).'','entityType' => 'berita']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirm-delete-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['entity-name' => ''.e($item->judul).'','entity-type' => 'berita']); ?>
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
                                                <svg class="w-8 h-8 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                            </div>
                                            <p class="font-extrabold text-base-content">Belum ada berita kegiatan</p>
                                            <p class="text-sm text-base-content/50 mt-1">Mulai dengan menambahkan berita atau laporan pertama.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($newsList->hasPages()): ?>
                    <div class="p-4 border-t border-base-200">
                        <?php echo e($newsList->links()); ?>

                    </div>
                <?php endif; ?>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/news/index.blade.php ENDPATH**/ ?>