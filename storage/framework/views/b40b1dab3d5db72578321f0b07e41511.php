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
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">Rekap Data Donasi</h2>
     <?php $__env->endSlot(); ?>

    <div class="bg-base-200 p-8">
        <div class="max-w-7xl mx-auto">
            <nav class="text-sm text-emerald-500 mb-1">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="link link-hover text-emerald-600">Dashboard</a>
                <span class="mx-1">/</span>
                <span class="text-emerald-600">Rekap Donasi</span>
            </nav>
            <h1 class="text-2xl font-black text-emerald-700 mb-1">Data Seluruh Donasi</h1>
            <p class="text-sm text-emerald-500 mb-6">Rekap lengkap transaksi donasi kampanye.</p>

            <div class="stats shadow w-full mb-6">
                <div class="stat">
                    <div class="stat-figure text-2xl">💰</div>
                    <div class="stat-title">Total Dana Terkumpul</div>
                    <div class="stat-value text-emerald-700">Rp <?php echo e(number_format($totalAmount, 0, ',', '.')); ?></div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">📋</div>
                    <div class="stat-title">Total Transaksi</div>
                    <div class="stat-value text-emerald-700"><?php echo e($totalCount); ?></div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">✅</div>
                    <div class="stat-title">Sukses</div>
                    <div class="stat-value text-emerald-700"><?php echo e($successCount); ?></div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">⏳</div>
                    <div class="stat-title">Pending</div>
                    <div class="stat-value text-emerald-700"><?php echo e($pendingCount); ?></div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-0">
                    <div class="p-4 border-b border-emerald-100 flex flex-wrap items-center justify-between gap-3">
                        <form method="GET" class="flex flex-wrap items-center gap-2">
                            <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="input input-bordered input-sm">
                            <span class="text-xs text-emerald-500">s/d</span>
                            <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="input input-bordered input-sm">
                            <input type="text" name="search" placeholder="Cari nama/email/order..." class="input input-bordered input-sm"
                                   value="<?php echo e(request('search')); ?>">
                            <select name="status" class="select select-bordered select-sm">
                                <option value="">Semua Status</option>
                                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="success" <?php echo e(request('status') == 'success' ? 'selected' : ''); ?>>Sukses</option>
                                <option value="failed" <?php echo e(request('status') == 'failed' ? 'selected' : ''); ?>>Gagal</option>
                            </select>
                            <button type="submit" class="btn btn-success btn-sm text-white">Filter</button>
                            <a href="<?php echo e(route('admin.rekap.donasi')); ?>" class="btn btn-ghost btn-sm">Reset</a>
                        </form>
                        <a href="<?php echo e(route('admin.rekap.donasi.export')); ?>?<?php echo e(request()->getQueryString()); ?>" class="btn btn-outline btn-sm btn-info">
                            Export CSV
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Donatur</th>
                                    <th>Email</th>
                                    <th>Kampanye</th>
                                    <th>Nominal</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="font-mono text-xs"><?php echo e($d->order_id ?? '-'); ?></td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="avatar">
                                                <div class="w-7 rounded-full">
                                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($d->donor_name)); ?>&background=b3e093&color=5c8148" alt="">
                                                </div>
                                            </div>
                                            <span class="text-sm font-semibold"><?php echo e($d->donor_name); ?></span>
                                        </div>
                                    </td>
                                    <td class="text-sm"><?php echo e($d->donor_email); ?></td>
                                    <td class="text-sm"><?php echo e($d->campaign?->title ?? '-'); ?></td>
                                    <td class="font-bold text-emerald-700">Rp <?php echo e(number_format($d->amount, 0, ',', '.')); ?></td>
                                    <td class="text-sm"><?php echo e($d->payment_method ?? '-'); ?></td>
                                    <td>
                                        <?php $c = $d->status == 'success' ? 'badge-success' : ($d->status == 'pending' ? 'badge-warning' : 'badge-error') ?>
                                        <span class="badge <?php echo e($c); ?> badge-sm"><?php echo e($d->status); ?></span>
                                    </td>
                                    <td class="text-xs"><?php echo e($d->created_at ? $d->created_at->format('d/m/Y H:i') : '-'); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="8" class="text-center py-10 text-base-content/60">Belum ada data donasi.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if($donations->hasPages()): ?>
                        <div class="p-4 border-t border-emerald-100"><?php echo e($donations->links()); ?></div>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/rekap/donasi.blade.php ENDPATH**/ ?>