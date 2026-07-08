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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Data Seluruh Donasi</h1>
                            <p class="text-sm text-base-content/50">Rekap lengkap transaksi donasi kampanye.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 max-sm:grid-cols-1">
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 text-2xl">💰</div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Dana Terkumpul</div>
                        <div class="text-lg font-black text-base-content mt-0.5">Rp <?php echo e(number_format($totalAmount, 0, ',', '.')); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 text-2xl">📋</div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Transaksi</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($totalCount); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0 text-2xl">✅</div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Sukses</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($successCount); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center shrink-0 text-2xl">⏳</div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Pending</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($pendingCount); ?></div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex flex-wrap items-center justify-between gap-3">
                    <form method="GET" class="flex flex-wrap items-center gap-2">
                        <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="input input-bordered input-sm">
                        <span class="text-xs text-base-content/50">s/d</span>
                        <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="input input-bordered input-sm">
                        <input type="text" name="search" placeholder="Cari nama/email/order..." class="input input-bordered input-sm" value="<?php echo e(request('search')); ?>">
                        <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 btn-sm font-bold rounded-lg">Filter</button>
                        <a href="<?php echo e(route('admin.rekap.donasi')); ?>" class="btn btn-ghost btn-sm font-bold">Reset</a>
                    </form>
                    <div class="flex gap-2">
                        <a href="<?php echo e(route('admin.rekap.donasi.export')); ?>?<?php echo e(request()->getQueryString()); ?>" class="btn btn-sm bg-primary/10 hover:bg-primary/20 text-primary border-0 font-bold rounded-lg">
                            Export CSV
                        </a>
                        <a href="<?php echo e(route('admin.rekap.donasi.export-pdf')); ?>?<?php echo e(request()->getQueryString()); ?>" class="btn btn-sm bg-error/10 hover:bg-error/20 text-error border-0 font-bold rounded-lg">
                            Export PDF
                        </a>
                    </div>
                </div>

                <div class="px-6 py-3 border-b border-base-200 bg-base-100/50 flex flex-wrap items-center gap-1.5">
                    <span class="text-[11px] font-semibold text-base-content/50 mr-1">Status:</span>
                    <?php $curStatus = request('status'); ?>
                    <a href="<?php echo e(route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => '']))); ?>"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all <?php echo e(!$curStatus ? 'bg-primary text-white shadow-sm' : 'bg-base-200 text-base-content/60 hover:bg-base-300'); ?>">Semua</a>
                    <a href="<?php echo e(route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => 'success']))); ?>"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all <?php echo e($curStatus === 'success' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100'); ?>">Sukses</a>
                    <a href="<?php echo e(route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => 'pending']))); ?>"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all <?php echo e($curStatus === 'pending' ? 'bg-amber-500 text-white shadow-sm' : 'bg-amber-50 text-amber-600 border border-amber-200 hover:bg-amber-100'); ?>">Pending</a>
                    <a href="<?php echo e(route('admin.rekap.donasi', array_merge(request()->except(['status', 'page']), ['status' => 'failed']))); ?>"
                       class="px-3 py-1 text-xs font-bold rounded-full transition-all <?php echo e($curStatus === 'failed' ? 'bg-red-500 text-white shadow-sm' : 'bg-red-50 text-red-600 border border-red-200 hover:bg-red-100'); ?>">Gagal</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Order ID</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Donatur</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Kampanye</th>
                                <th class="text-right text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nominal</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Metode</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-base-200/30 transition-colors">
                                <td class="font-mono text-xs text-base-content/60"><?php echo e($d->order_id ?? '-'); ?></td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-primary/10 text-primary font-bold text-xs flex items-center justify-center uppercase"><?php echo e(substr($d->donor_name, 0, 1)); ?></div>
                                        <span class="text-sm font-semibold text-base-content"><?php echo e($d->donor_name); ?></span>
                                    </div>
                                </td>
                                <td class="text-sm text-base-content/60"><?php echo e($d->campaign?->title ?? '-'); ?></td>
                                <td class="text-right font-bold text-primary">Rp <?php echo e(number_format($d->amount, 0, ',', '.')); ?></td>
                                <td class="text-sm text-base-content/60"><?php echo e($d->payment_method ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php if($d->status == 'success'): ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Sukses
                                        </span>
                                    <?php elseif($d->status == 'pending'): ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Pending
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Gagal
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-xs text-base-content/60 whitespace-nowrap"><?php echo e($d->created_at ? $d->created_at->format('d/m/Y H:i') : '-'); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="7"><div class="py-16 text-center"><p class="font-extrabold text-base-content">Belum ada data donasi</p></div></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($donations->hasPages()): ?>
                    <div class="p-4 border-t border-base-200"><?php echo e($donations->links()); ?></div>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/rekap/donasi.blade.php ENDPATH**/ ?>