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
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">Rekap Data Orang Tua Asuh</h2>
     <?php $__env->endSlot(); ?>

    <div class="bg-base-200 p-8">
        <div class="max-w-7xl mx-auto">
            <nav class="text-sm text-emerald-500 mb-1">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="link link-hover text-emerald-600">Dashboard</a>
                <span class="mx-1">/</span>
                <span class="text-emerald-600">Rekap Orang Tua Asuh</span>
            </nav>
            <h1 class="text-2xl font-black text-emerald-700 mb-1">Data Seluruh Sponsorship</h1>
            <p class="text-sm text-emerald-500 mb-6">Rekap lengkap data orang tua asuh (sponsorship).</p>

            <div class="stats shadow w-full mb-6">
                <div class="stat">
                    <div class="stat-figure text-2xl">🤝</div>
                    <div class="stat-title">Total Sponsorship</div>
                    <div class="stat-value text-emerald-700"><?php echo e($totalCount); ?></div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">✅</div>
                    <div class="stat-title">Aktif</div>
                    <div class="stat-value text-emerald-700"><?php echo e($activeCount); ?></div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-2xl">💰</div>
                    <div class="stat-title">Total Dana Sponsorship</div>
                    <div class="stat-value text-emerald-700">Rp <?php echo e(number_format($totalAmount, 0, ',', '.')); ?></div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-md border border-emerald-200">
                    <div class="p-4 border-b border-emerald-100 bg-emerald-50 flex flex-wrap gap-2 items-center justify-between">
                        <form method="GET" class="flex flex-wrap items-center gap-2">
                            <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="input input-bordered input-sm">
                            <span class="text-xs text-emerald-500">s/d</span>
                            <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="input input-bordered input-sm">
                            <input type="text" name="search" placeholder="Cari donor/email/order/anak..." class="input input-bordered input-sm"
                                   value="<?php echo e(request('search')); ?>">
                            <select name="status" class="select select-bordered select-sm">
                                <option value="">Semua Status</option>
                                <option value="aktif" <?php echo e(request('status') == 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Menunggu Bayar</option>
                                <option value="kadaluarsa" <?php echo e(request('status') == 'kadaluarsa' ? 'selected' : ''); ?>>Kadaluarsa</option>
                                <option value="gagal" <?php echo e(request('status') == 'gagal' ? 'selected' : ''); ?>>Gagal</option>
                            </select>
                            <button type="submit" class="btn btn-success btn-sm text-white">Filter</button>
                            <a href="<?php echo e(route('admin.rekap.orang-tua-asuh')); ?>" class="btn btn-ghost btn-sm">Reset</a>
                        </form>
                        <a href="<?php echo e(route('admin.rekap.orang-tua-asuh.export')); ?>?<?php echo e(request()->getQueryString()); ?>" class="btn btn-outline btn-sm btn-info">
                            Export CSV
                        </a>
                    </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Penyandang Dana &amp; Anak Asuh</th>
                                <th>Paket &amp; Nominal</th>
                                <th>Periode</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $sponsorships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $isExpiredPeriod = $s->expires_at && $s->expires_at->isPast();
                                    $remainingDays   = $s->expires_at ? now()->diffInDays($s->expires_at) : null;

                                    $statusKey = match(true) {
                                        $s->status === 'pending'                => 'pending',
                                        $s->status === 'success' && !$isExpiredPeriod => 'aktif',
                                        $s->status === 'success' && $isExpiredPeriod  => 'kadaluarsa',
                                        $s->status === 'expired'                => 'kadaluarsa',
                                        default                                 => 'gagal',
                                    };
                                ?>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img class="w-9 h-9 rounded-full border-2 border-emerald-200 object-cover flex-shrink-0"
                                                 src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($s->donor_name)); ?>&background=b3e093&color=5c8148&rounded=true&bold=true"
                                                 alt="<?php echo e($s->donor_name); ?>">
                                            <div>
                                                <div class="font-extrabold text-emerald-700 text-sm"><?php echo e($s->donor_name); ?></div>
                                                <div class="text-xs text-emerald-400"><?php echo e($s->donor_email); ?></div>
                                                <div class="text-xs text-emerald-400">📱 <?php echo e($s->donor_phone ?? '-'); ?></div>
                                                <span class="badge badge-ghost badge-sm mt-1"><?php echo e($s->fosterChild?->name ?? 'Anak Dihapus'); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning badge-sm"><?php echo e($s->package ?? '-'); ?></span>
                                        <div class="font-black text-emerald-700 mt-1">Rp <?php echo e(number_format($s->amount, 0, ',', '.')); ?></div>
                                        <div class="text-xs text-emerald-400 font-mono"><?php echo e($s->order_id); ?></div>
                                        <?php if($s->payment_method): ?>
                                            <div class="text-xs text-emerald-400">via <?php echo e($s->payment_method); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($s->starts_at && $s->expires_at): ?>
                                            <div class="text-sm font-bold text-emerald-700"><?php echo e($s->starts_at->format('d M Y')); ?> – <?php echo e($s->expires_at->format('d M Y')); ?></div>
                                            <div class="text-xs mt-1">
                                                <?php if($statusKey === 'aktif'): ?>
                                                    <span class="text-emerald-500"><?php echo e($remainingDays); ?> hari lagi</span>
                                                <?php elseif($statusKey === 'kadaluarsa'): ?>
                                                    <span class="text-red-500">Lewat <?php echo e(abs($remainingDays)); ?> hari</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="text-sm font-bold text-emerald-700">-</div>
                                            <div class="text-xs text-emerald-400">Belum dibayar</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($statusKey === 'aktif'): ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php elseif($statusKey === 'pending'): ?>
                                            <span class="badge badge-warning">Menunggu</span>
                                        <?php elseif($statusKey === 'kadaluarsa'): ?>
                                            <span class="badge badge-ghost">Kadaluarsa</span>
                                        <?php else: ?>
                                            <span class="badge badge-error">Gagal</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="py-16 text-center">
                                            <div class="w-14 h-14 bg-emerald-100 border border-emerald-200 rounded-xl flex items-center justify-center mx-auto mb-3">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6 text-emerald-400"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-emerald-700">Belum Ada Sponsorship</p>
                                            <p class="text-sm text-emerald-500">Sponsorship anak asuh yang masuk akan tampil di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($sponsorships->hasPages()): ?>
                    <div class="p-4 border-t border-emerald-100"><?php echo e($sponsorships->links()); ?></div>
                <?php endif; ?>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/rekap/orang_tua_asuh.blade.php ENDPATH**/ ?>