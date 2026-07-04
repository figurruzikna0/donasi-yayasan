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
            Berita Kegiatan
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="bg-base-200 p-8">

        
        <div class="flex items-end justify-between gap-3 mb-7 flex-wrap">
            <div>
                <nav class="text-sm text-emerald-500 mb-1">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="link link-hover text-emerald-600">Dashboard</a>
                    <span class="mx-1">/</span>
                    <span class="text-emerald-600">Berita Kegiatan</span>
                </nav>
                <h1 class="text-2xl font-black text-emerald-700">Kelola Berita & Kegiatan</h1>
                <p class="text-sm text-emerald-500 mt-1">Publikasikan narasi kegiatan, press release, dan laporan acara yayasan.</p>
            </div>
            <a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-success">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Berita
            </a>
        </div>

        
        <div class="grid grid-cols-3 gap-4 mb-6 max-sm:grid-cols-1">
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body flex-row items-center gap-3 p-5">
                    <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"/></svg>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold uppercase tracking-wider text-emerald-500">Total Berita</div>
                        <div class="text-2xl font-black text-emerald-700"><?php echo e($newsList->total()); ?></div>
                    </div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body flex-row items-center gap-3 p-5">
                    <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold uppercase tracking-wider text-emerald-500">Tayang</div>
                        <div class="text-2xl font-black text-emerald-700"><?php echo e($newsList->getCollection()->where('status', 'published')->count()); ?></div>
                    </div>
                </div>
            </div>
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body flex-row items-center gap-3 p-5">
                    <div class="w-11 h-11 rounded-xl bg-emerald-600 text-white flex items-center justify-center">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold uppercase tracking-wider text-emerald-500">Draft</div>
                        <div class="text-2xl font-black text-emerald-700"><?php echo e($newsList->getCollection()->where('status', 'draft')->count()); ?></div>
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
                <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center text-lg">📰</div>
                <div>
                    <p class="text-white font-extrabold text-sm">Daftar Berita & Kegiatan</p>
                    <p class="text-white/75 text-xs">Seluruh artikel dan laporan kegiatan yang terdaftar di sistem</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th class="w-[76px]">Foto</th>
                            <th>Judul & Kategori</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $newsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <?php if($item->foto_utama): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->foto_utama)); ?>"
                                             alt="<?php echo e($item->judul); ?>" class="w-[60px] h-11 object-cover rounded border border-emerald-200">
                                    <?php else: ?>
                                        <div class="w-[60px] h-11 bg-emerald-100 rounded border border-emerald-200 flex items-center justify-center">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" class="w-5 h-5 stroke-emerald-400">
                                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                                <path d="m21 15-5-5L5 21"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="font-extrabold text-emerald-700 text-sm max-w-[280px]">
                                        <?php echo e(Str::limit($item->judul, 55)); ?>

                                    </div>
                                    <span class="badge badge-ghost badge-sm"><?php echo e($item->kategori); ?></span>
                                </td>

                                <td class="whitespace-nowrap text-sm font-semibold text-emerald-500">
                                    <?php echo e($item->tanggal_kegiatan->translatedFormat('d M Y')); ?>

                                </td>

                                <td class="text-sm font-semibold text-emerald-500 max-w-[160px]">
                                    <?php echo e($item->lokasi ?? '-'); ?>

                                </td>

                                <td>
                                    <?php if($item->status === 'published'): ?>
                                        <span class="badge badge-success">Tayang</span>
                                    <?php else: ?>
                                        <span class="badge badge-ghost">Draft</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="<?php echo e(route('admin.news.edit', $item->id)); ?>" class="btn btn-sm btn-ghost">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                            Edit
                                        </a>
                                        <form action="<?php echo e(route('admin.news.destroy', $item->id)); ?>"
                                              method="POST"
                                              x-data="{ open: false }" @submit.prevent="open = true">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" @click="open = true" class="btn btn-sm btn-error">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                                Hapus
                                            </button>
                                            <dialog class="modal" :class="{ 'modal-open': open }">
                                                <div class="modal-box"><h3 class="font-bold text-lg">Konfirmasi Hapus</h3><p class="py-4">Hapus berita <strong><?php echo e($item->judul); ?></strong>?</p>
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
                                <td colspan="6">
                                    <div class="py-14 text-center">
                                        <div class="w-13 h-13 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" class="w-6 h-6 text-emerald-400"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                        </div>
                                        <p class="font-extrabold text-emerald-700">Belum ada berita kegiatan</p>
                                        <p class="text-sm text-emerald-500">Mulai dengan menambahkan berita atau laporan kegiatan pertama.</p>
                                        <a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-success mt-3">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M12 4v16m8-8H4"/></svg>
                                            Tambah Sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($newsList->hasPages()): ?>
                <div class="p-4 border-t border-emerald-100">
                    <?php echo e($newsList->links()); ?>

                </div>
            <?php endif; ?>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/news/index.blade.php ENDPATH**/ ?>