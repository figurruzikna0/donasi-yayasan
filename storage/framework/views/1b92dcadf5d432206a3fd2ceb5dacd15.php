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
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">Rekap Data Donatur</h2>
     <?php $__env->endSlot(); ?>

    <div class="bg-base-200 p-8">
        <div class="max-w-7xl mx-auto">
            <nav class="text-sm text-emerald-500 mb-1">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="link link-hover text-emerald-600">Dashboard</a>
                <span class="mx-1">/</span>
                <span class="text-emerald-600">Rekap Donatur</span>
            </nav>
            <h1 class="text-2xl font-black text-emerald-700 mb-1">Data Seluruh Donatur</h1>
            <p class="text-sm text-emerald-500 mb-6">Rekap lengkap user donatur terdaftar beserta data registrasi.</p>

            <div class="stats shadow w-full mb-6">
                <div class="stat">
                    <div class="stat-figure text-2xl">👥</div>
                    <div class="stat-title">Total Donatur Terdaftar</div>
                    <div class="stat-value text-emerald-700"><?php echo e($totalDonatur); ?></div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">💰</div>
                    <div class="stat-title">Total Donasi Sukses</div>
                    <div class="stat-value text-emerald-700">Rp <?php echo e(number_format($totalDonasiAll, 0, ',', '.')); ?></div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">🤝</div>
                    <div class="stat-title">Total Sponsorship Aktif</div>
                    <div class="stat-value text-emerald-700"><?php echo e($totalSponsorshipAll); ?></div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-0">
                    <div class="p-4 border-b border-emerald-100 flex flex-wrap items-center justify-between gap-3">
                        <form method="GET" class="flex flex-wrap items-center gap-2">
                            <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="input input-bordered input-sm">
                            <span class="text-xs text-emerald-500">s/d</span>
                            <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="input input-bordered input-sm">
                            <input type="text" name="search" placeholder="Cari nama/email/HP/NIK..." class="input input-bordered input-sm"
                                   value="<?php echo e(request('search')); ?>">
                            <button type="submit" class="btn btn-success btn-sm text-white">Cari</button>
                            <a href="<?php echo e(route('admin.rekap.donatur')); ?>" class="btn btn-ghost btn-sm">Reset</a>
                        </form>
                        <a href="<?php echo e(route('admin.rekap.donatur.export')); ?>?<?php echo e(request()->getQueryString()); ?>" class="btn btn-outline btn-sm btn-info">
                            Export CSV
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username (Email)</th>
                                    <th>Password</th>
                                    <th>No. HP</th>
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>Aktivitas</th>
                                    <th>Verifikasi</th>
                                    <th>Terdaftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $donaturs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="avatar">
                                                <div class="w-7 rounded-full">
                                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($u->name)); ?>&background=b3e093&color=5c8148" alt="">
                                                </div>
                                            </div>
                                            <span class="text-sm font-semibold"><?php echo e($u->name); ?></span>
                                        </div>
                                    </td>
                                    <td class="text-sm font-mono"><?php echo e($u->email); ?></td>
                                    <td>
                                        <span class="badge badge-success badge-sm">Tersimpan</span>
                                    </td>
                                    <td class="text-sm"><?php echo e($u->phone ?? '-'); ?></td>
                                    <td class="text-sm font-mono"><?php echo e($u->nik ?? '-'); ?></td>
                                    <td class="text-sm max-w-[200px] truncate" title="<?php echo e($u->address); ?>"><?php echo e($u->address ?? '-'); ?></td>
                                    <td>
                                        <div class="text-xs">
                                            <span class="font-semibold"><?php echo e($u->donations_count); ?></span> donasi
                                            <br><span class="font-semibold"><?php echo e($u->sponsorships_count); ?></span> sponsorship
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($u->email_verified_at): ?>
                                            <span class="badge badge-success badge-sm">Terverifikasi</span>
                                        <?php else: ?>
                                            <span class="badge badge-ghost badge-sm">Belum</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-xs"><?php echo e($u->created_at->format('d/m/Y')); ?><br><?php echo e($u->created_at->format('H:i')); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="9" class="text-center py-10 text-base-content/60">Belum ada donatur terdaftar.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if($donaturs->hasPages()): ?>
                        <div class="p-4 border-t border-emerald-100"><?php echo e($donaturs->links()); ?></div>
                    <?php endif; ?>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/rekap/donatur.blade.php ENDPATH**/ ?>