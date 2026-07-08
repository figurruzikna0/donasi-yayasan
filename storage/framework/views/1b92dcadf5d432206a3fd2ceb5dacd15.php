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
                            <h1 class="text-2xl font-black text-base-content">Data Seluruh Donatur</h1>
                            <p class="text-sm text-base-content/50">Rekap lengkap user donatur terdaftar beserta data registrasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            
            <div class="grid grid-cols-3 gap-4 max-sm:grid-cols-1">
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 text-2xl">👥</div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Donatur Terdaftar</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($totalDonatur); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-2xl">💰</div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Donasi Sukses</div>
                        <div class="text-lg font-black text-base-content mt-0.5">Rp <?php echo e(number_format($totalDonasiAll, 0, ',', '.')); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 text-2xl">🤝</div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Sponsorship Aktif</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($totalSponsorshipAll); ?></div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex flex-wrap items-center justify-between gap-3">
                    <form method="GET" class="flex flex-wrap items-center gap-2">
                        <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="input input-bordered input-sm">
                        <span class="text-xs text-base-content/50">s/d</span>
                        <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="input input-bordered input-sm">
                        <input type="text" name="search" placeholder="Cari nama/email/HP/NIK..." class="input input-bordered input-sm" value="<?php echo e(request('search')); ?>">
                        <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 btn-sm font-bold rounded-lg">Cari</button>
                        <a href="<?php echo e(route('admin.rekap.donatur')); ?>" class="btn btn-ghost btn-sm font-bold">Reset</a>
                    </form>
                    <div class="flex gap-2">
                        <a href="<?php echo e(route('admin.rekap.donatur.export')); ?>?<?php echo e(request()->getQueryString()); ?>" class="btn btn-sm bg-primary/10 hover:bg-primary/20 text-primary border-0 font-bold rounded-lg">
                            Export CSV
                        </a>
                        <a href="<?php echo e(route('admin.rekap.donatur.export-pdf')); ?>?<?php echo e(request()->getQueryString()); ?>" class="btn btn-sm bg-error/10 hover:bg-error/20 text-error border-0 font-bold rounded-lg">
                            Export PDF
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nama</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Username (Email)</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Password</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">No. HP</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">NIK</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Alamat</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aktivitas</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Verifikasi</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $donaturs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-base-200/30 transition-colors">
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-primary/10 text-primary font-bold text-xs flex items-center justify-center uppercase"><?php echo e(substr($u->name, 0, 1)); ?></div>
                                        <span class="text-sm font-semibold text-base-content"><?php echo e($u->name); ?></span>
                                    </div>
                                </td>
                                <td class="text-sm font-mono text-base-content/60"><?php echo e($u->email); ?></td>
                                <td>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-emerald-100 text-emerald-700">Tersimpan</span>
                                </td>
                                <td class="text-sm text-base-content/60"><?php echo e($u->phone ?? '-'); ?></td>
                                <td class="text-sm font-mono text-base-content/60"><?php echo e($u->nik ?? '-'); ?></td>
                                <td class="text-sm text-base-content/60 max-w-[200px] truncate" title="<?php echo e($u->address); ?>"><?php echo e($u->address ?? '-'); ?></td>
                                <td>
                                    <div class="text-xs text-base-content/60">
                                        <span class="font-semibold"><?php echo e($u->donations_count); ?></span> donasi
                                        <br><span class="font-semibold"><?php echo e($u->sponsorships_count); ?></span> sponsorship
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php if($u->email_verified_at): ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Terverifikasi
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Belum
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-xs text-base-content/60 whitespace-nowrap"><?php echo e($u->created_at->format('d/m/Y')); ?><br><?php echo e($u->created_at->format('H:i')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="9"><div class="py-16 text-center"><p class="font-extrabold text-base-content">Belum ada donatur terdaftar</p></div></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($donaturs->hasPages()): ?>
                    <div class="p-4 border-t border-base-200"><?php echo e($donaturs->links()); ?></div>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/rekap/donatur.blade.php ENDPATH**/ ?>