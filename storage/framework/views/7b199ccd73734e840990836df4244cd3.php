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
                            <h1 class="text-2xl font-black text-base-content">Data Seluruh Sponsorship</h1>
                            <p class="text-sm text-base-content/50">Rekap lengkap data orang tua asuh (sponsorship).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            
            <div class="grid grid-cols-3 gap-4 max-sm:grid-cols-1">
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 text-2xl">🤝</div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Sponsorship</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($totalCount); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-2xl">✅</div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Aktif</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($activeCount); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 text-2xl">💰</div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Dana</div>
                        <div class="text-lg font-black text-base-content mt-0.5">Rp <?php echo e(number_format($totalAmount, 0, ',', '.')); ?></div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex flex-wrap items-center justify-between gap-3">
                    <form method="GET" class="flex flex-wrap items-end gap-x-3 gap-y-2">
                        <div>
                            <label class="text-[11px] font-semibold text-base-content/50 block mb-0.5">Dari Tanggal</label>
                            <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="input input-bordered input-sm w-40">
                        </div>
                        <div>
                            <label class="text-[11px] font-semibold text-base-content/50 block mb-0.5">Sampai</label>
                            <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="input input-bordered input-sm w-40">
                        </div>
                        <div>
                            <label class="text-[11px] font-semibold text-base-content/50 block mb-0.5">Cari</label>
                            <input type="text" name="search" placeholder="Cari donor/email/order/anak..." class="input input-bordered input-sm w-40" value="<?php echo e(request('search')); ?>">
                        </div>
                        <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 btn-sm font-bold rounded-lg">Filter</button>
                        <a href="<?php echo e(route('admin.rekap.orang-tua-asuh')); ?>" class="btn btn-ghost btn-sm font-bold">Reset</a>
                    </form>
                    <div class="flex gap-2">
                        <a href="<?php echo e(route('admin.rekap.orang-tua-asuh.export')); ?>?<?php echo e(request()->getQueryString()); ?>" class="btn btn-sm bg-primary/10 hover:bg-primary/20 text-primary border-0 font-bold rounded-lg">
                            Export CSV
                        </a>
                        <a href="<?php echo e(route('admin.rekap.orang-tua-asuh.export-pdf')); ?>?<?php echo e(request()->getQueryString()); ?>" class="btn btn-sm bg-error/10 hover:bg-error/20 text-error border-0 font-bold rounded-lg">
                            Export PDF
                        </a>
                    </div>
                </div>

                <div class="px-6 py-3 border-b border-base-200 bg-base-100/50 flex flex-wrap items-center gap-1.5">
                    <span class="text-[11px] font-semibold text-base-content/50 mr-1">Status:</span>
                    <?php $curStatus = request('status'); ?>
                    <a href="<?php echo e(route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => '']))); ?>"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all <?php echo e(!$curStatus ? 'bg-primary text-white shadow-sm' : 'bg-base-200 text-base-content/60 hover:bg-base-300'); ?>">Semua</a>
                    <a href="<?php echo e(route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'aktif']))); ?>"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all <?php echo e($curStatus === 'aktif' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100'); ?>">Aktif</a>
                    <a href="<?php echo e(route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'pending']))); ?>"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all <?php echo e($curStatus === 'pending' ? 'bg-amber-500 text-white shadow-sm' : 'bg-amber-50 text-amber-600 border border-amber-200 hover:bg-amber-100'); ?>">Menunggu</a>
                    <a href="<?php echo e(route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'kadaluarsa']))); ?>"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all <?php echo e($curStatus === 'kadaluarsa' ? 'bg-gray-500 text-white shadow-sm' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100'); ?>">Kadaluarsa</a>
                    <a href="<?php echo e(route('admin.rekap.orang-tua-asuh', array_merge(request()->except(['status', 'page']), ['status' => 'gagal']))); ?>"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all <?php echo e($curStatus === 'gagal' ? 'bg-red-500 text-white shadow-sm' : 'bg-red-50 text-red-600 border border-red-200 hover:bg-red-100'); ?>">Gagal</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Penyandang Dana &amp; Anak Asuh</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Paket &amp; Nominal</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Periode</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $sponsorships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $isExpiredPeriod = $s->expires_at && $s->expires_at->isPast();
                                    $remainingDays   = $s->expires_at ? (int) now()->diffInDays($s->expires_at) : null;

                                    $statusKey = match(true) {
                                        $s->status === 'pending'                => 'pending',
                                        $s->status === 'success' && !$isExpiredPeriod => 'aktif',
                                        $s->status === 'success' && $isExpiredPeriod  => 'kadaluarsa',
                                        $s->status === 'expired'                => 'kadaluarsa',
                                        default                                 => 'gagal',
                                    };
                                ?>
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-primary/10 text-primary font-bold text-sm flex items-center justify-center uppercase shrink-0"><?php echo e(substr($s->donor_name, 0, 1)); ?></div>
                                            <div>
                                                <div class="font-bold text-sm text-base-content"><?php echo e($s->donor_name); ?></div>
                                                <div class="text-xs text-base-content/40"><?php echo e($s->donor_email); ?></div>
                                                <div class="text-xs text-base-content/40">📱 <?php echo e($s->donor_phone ?? '-'); ?></div>
                                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-primary/5 text-primary border border-primary/20 mt-1"><?php echo e($s->fosterChild?->name ?? 'Anak Dihapus'); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-amber-50 text-amber-700 border border-amber-200"><?php echo e($s->package ?? '-'); ?></span>
                                        <div class="font-black text-base-content mt-1">Rp <?php echo e(number_format($s->amount, 0, ',', '.')); ?></div>
                                        <div class="text-xs text-base-content/30 font-mono"><?php echo e($s->order_id); ?></div>
                                        <?php if($s->payment_method): ?>
                                            <div class="text-xs text-base-content/40">via <?php echo e($s->payment_method); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($s->starts_at && $s->expires_at): ?>
                                            <div class="text-sm font-bold text-base-content whitespace-nowrap"><?php echo e($s->starts_at->format('d M Y')); ?> – <?php echo e($s->expires_at->format('d M Y')); ?></div>
                                            <div class="text-xs mt-1">
                                                <?php if($statusKey === 'aktif'): ?>
                                                    <span class="text-emerald-600">⏱ <?php echo e($remainingDays); ?> hari lagi</span>
                                                <?php elseif($statusKey === 'kadaluarsa'): ?>
                                                    <span class="text-rose-600">Lewat <?php echo e(abs($remainingDays)); ?> hari</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="text-sm font-bold text-base-content">-</div>
                                            <div class="text-xs text-base-content/40">Belum dibayar</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($statusKey === 'aktif'): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Aktif
                                            </span>
                                        <?php elseif($statusKey === 'pending'): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                Menunggu
                                            </span>
                                        <?php elseif($statusKey === 'kadaluarsa'): ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-base-200 text-base-content/50">
                                                <span class="w-1.5 h-1.5 rounded-full bg-base-content/20"></span>
                                                Kadaluarsa
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-600">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                Gagal
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="py-16 text-center">
                                            <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-base-content">Belum Ada Sponsorship</p>
                                            <p class="text-sm text-base-content/50 mt-1">Sponsorship anak asuh yang masuk akan tampil di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($sponsorships->hasPages()): ?>
                    <div class="p-4 border-t border-base-200"><?php echo e($sponsorships->links()); ?></div>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/rekap/orang_tua_asuh.blade.php ENDPATH**/ ?>