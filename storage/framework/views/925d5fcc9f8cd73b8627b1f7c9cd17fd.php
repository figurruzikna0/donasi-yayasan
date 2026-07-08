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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Riwayat Transaksi</h1>
                            <p class="text-sm text-base-content/50">Ringkasan donasi kampanye & sponsorship orang tua asuh.</p>
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
            <?php if(session('error')): ?>
                <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'error','message' => ''.e(session('error')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'error','message' => ''.e(session('error')).'']); ?>
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
            <?php if(session('info')): ?>
                <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'info','message' => ''.e(session('info')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'info','message' => ''.e(session('info')).'']); ?>
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

            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 max-sm:grid-cols-1">
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Donasi</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($donations->count()); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Sponsorship</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($sponsorships->count()); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Sukses</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($donations->where('status','success')->count() + $sponsorships->where('status','success')->count()); ?></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Tertunda</div>
                        <div class="text-2xl font-black text-base-content mt-0.5"><?php echo e($donations->where('status','pending')->count() + $sponsorships->where('status','pending')->count()); ?></div>
                    </div>
                </div>
            </div>

            
            <div x-data="{ tab: 'donasi' }" class="space-y-4">

                
                <div class="flex gap-1 bg-white rounded-xl p-1.5 shadow-sm border border-base-300 w-fit">
                    <button @click="tab = 'donasi'"
                            :class="tab === 'donasi' ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-base-content/50 hover:text-base-content hover:bg-base-200'"
                            class="px-5 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Donasi Kampanye
                        <span class="ml-0.5 px-2 py-0.5 rounded-full text-xs font-bold" :class="tab === 'donasi' ? 'bg-white/20' : 'bg-base-300'"><?php echo e($donations->count()); ?></span>
                    </button>
                    <button @click="tab = 'sponsor'"
                            :class="tab === 'sponsor' ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-base-content/50 hover:text-base-content hover:bg-base-200'"
                            class="px-5 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Orang Tua Asuh
                        <span class="ml-0.5 px-2 py-0.5 rounded-full text-xs font-bold" :class="tab === 'sponsor' ? 'bg-white/20' : 'bg-base-300'"><?php echo e($sponsorships->count()); ?></span>
                    </button>
                </div>

                
                <div x-show="tab === 'donasi'" x-transition:enter.duration.200ms>
                    <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <thead>
                                    <tr class="bg-base-200/50">
                                        <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Donatur</th>
                                        <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Kampanye</th>
                                        <th class="text-right text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nominal</th>
                                        <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                        <th class="text-right text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Tanggal</th>
                                        <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-base-200/60">
                                    <?php $__empty_1 = true; $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover:bg-base-200/30 transition-colors group">
                                            <td>
                                                <div class="flex items-center gap-3">
                                                    <div class="w-9 h-9 rounded-full bg-primary/10 text-primary font-bold text-sm flex items-center justify-center flex-shrink-0 uppercase"><?php echo e(substr($item->donor_name, 0, 1)); ?></div>
                                                    <div class="min-w-0">
                                                        <div class="font-semibold text-sm text-base-content truncate max-w-[160px]"><?php echo e($item->donor_name); ?></div>
                                                        <div class="text-xs text-base-content/40 truncate max-w-[160px]"><?php echo e($item->donor_email); ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-base-100 border border-base-200 text-base-content/60">
                                                    <svg class="w-3 h-3 text-base-content/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                                    <?php echo e($item->target); ?>

                                                </span>
                                            </td>
                                            <td class="text-right">
                                                <div class="font-bold text-primary text-sm">Rp <?php echo e(number_format($item->amount, 0, ',', '.')); ?></div>
                                                <div class="flex items-center justify-end gap-1 mt-1">
                                                    <div class="text-[0.6rem] text-base-content/30 font-mono bg-base-200/70 px-1.5 py-0.5 rounded"><?php echo e($item->order_id); ?></div>
                                                </div>
                                                <?php if($item->payment_method): ?>
                                                    <?php
                                                        $pmt = $item->payment_method;
                                                        $pmClass = match(true) {
                                                            str_contains($pmt, 'BRI') => 'bg-blue-50 text-blue-700 border-blue-200',
                                                            str_contains($pmt, 'BCA') => 'bg-red-50 text-red-700 border-red-200',
                                                            str_contains($pmt, 'Mandiri') => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                                            str_contains($pmt, 'BNI') => 'bg-orange-50 text-orange-700 border-orange-200',
                                                            default => 'bg-base-200/70 text-base-content/50 border-base-300'
                                                        };
                                                    ?>
                                                    <div class="inline-flex items-center gap-1 text-[0.6rem] font-bold px-2 py-0.5 rounded-full border <?php echo e($pmClass); ?> mt-1">
                                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                                        <?php echo e($pmt); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($item->status=='success'): ?>
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                        Sukses
                                                    </span>
                                                <?php elseif($item->status=='pending'): ?>
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                        Tertunda
                                                    </span>
                                                <?php else: ?>
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-600">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                        Gagal
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-right whitespace-nowrap">
                                                <div class="text-sm font-semibold text-base-content"><?php echo e($item->created_at?->format('d M Y') ?? '-'); ?></div>
                                                <div class="text-xs text-base-content/40 flex items-center justify-end gap-1 mt-0.5">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <?php echo e($item->created_at?->format('H:i')); ?> WIB
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                    <?php if($item->status==='pending'): ?>
                                                        <form action="<?php echo e(route('admin.transactions.sync', $item->order_id)); ?>" method="POST" class="inline">
                                                            <?php echo csrf_field(); ?>
                                                            <button type="submit" class="btn btn-xs bg-amber-50 hover:bg-amber-100 text-amber-700 border-amber-200 rounded-lg font-bold flex items-center gap-1" title="Sync Midtrans">
                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                                Sync
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <form action="<?php echo e(route('admin.transactions.destroy', $item->order_id)); ?>" method="POST" class="inline" x-data="{ open: false }" @submit.prevent="open = true">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button type="button" @click="open = true" class="btn btn-xs btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold" title="Hapus">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                        </button>
                                                        <?php if (isset($component)) { $__componentOriginal1978ea6189800d3ead8e1d285a55da54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1978ea6189800d3ead8e1d285a55da54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.confirm-delete-modal','data' => ['entityName' => ''.e($item->donor_name).'','entityType' => 'transaksi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirm-delete-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['entity-name' => ''.e($item->donor_name).'','entity-type' => 'transaksi']); ?>
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
                                                        <svg class="w-8 h-8 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    </div>
                                                    <p class="font-extrabold text-base-content">Belum ada donasi kampanye</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                
                <div x-show="tab === 'sponsor'" x-transition:enter.duration.200ms>
                    <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <thead>
                                    <tr class="bg-base-200/50">
                                        <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Donatur</th>
                                        <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Anak Asuh</th>
                                        <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Paket</th>
                                        <th class="text-right text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Nominal</th>
                                        <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                        <th class="text-right text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Tanggal</th>
                                        <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-base-200/60">
                                    <?php $__empty_1 = true; $__currentLoopData = $sponsorships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover:bg-base-200/30 transition-colors group">
                                            <td>
                                                <div class="flex items-center gap-3">
                                                    <div class="w-9 h-9 rounded-full bg-primary/10 text-primary font-bold text-sm flex items-center justify-center flex-shrink-0 uppercase"><?php echo e(substr($item->donor_name, 0, 1)); ?></div>
                                                    <div class="min-w-0">
                                                        <div class="font-semibold text-sm text-base-content truncate max-w-[160px]"><?php echo e($item->donor_name); ?></div>
                                                        <div class="text-xs text-base-content/40 truncate max-w-[160px]"><?php echo e($item->donor_email); ?></div>
                                                        <?php if(isset($item->donor_phone)): ?>
                                                            <div class="text-xs text-base-content/30 truncate max-w-[160px]"><?php echo e($item->donor_phone); ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-base-100 border border-base-200 text-base-content/60">
                                                    <svg class="w-3 h-3 text-base-content/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                    <?php echo e($item->target); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <?php if($item->package): ?>
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold
                                                        <?php switch($item->package):
                                                            case ('Bronze'): ?> bg-amber-50 text-amber-700 border border-amber-200 <?php break; ?>
                                                            <?php case ('Silver'): ?> bg-slate-100 text-slate-700 border border-slate-300 <?php break; ?>
                                                            <?php case ('Gold'): ?> bg-yellow-50 text-yellow-700 border border-yellow-300 <?php break; ?>
                                                            <?php default: ?> bg-base-200 text-base-content/60 border border-base-300
                                                        <?php endswitch; ?>
                                                    ">
                                                        <?php echo e($item->package); ?>

                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-base-content/30 text-xs">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-right">
                                                <div class="font-bold text-primary text-sm">Rp <?php echo e(number_format($item->amount, 0, ',', '.')); ?></div>
                                                <div class="flex items-center justify-end gap-1 mt-1">
                                                    <div class="text-[0.6rem] text-base-content/30 font-mono bg-base-200/70 px-1.5 py-0.5 rounded"><?php echo e($item->order_id); ?></div>
                                                </div>
                                                <?php if($item->payment_method): ?>
                                                    <?php
                                                        $pmt = $item->payment_method;
                                                        $pmClass = match(true) {
                                                            str_contains($pmt, 'BRI') => 'bg-blue-50 text-blue-700 border-blue-200',
                                                            str_contains($pmt, 'BCA') => 'bg-red-50 text-red-700 border-red-200',
                                                            str_contains($pmt, 'Mandiri') => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                                            str_contains($pmt, 'BNI') => 'bg-orange-50 text-orange-700 border-orange-200',
                                                            default => 'bg-base-200/70 text-base-content/50 border-base-300'
                                                        };
                                                    ?>
                                                    <div class="inline-flex items-center gap-1 text-[0.6rem] font-bold px-2 py-0.5 rounded-full border <?php echo e($pmClass); ?> mt-1">
                                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                                        <?php echo e($pmt); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($item->status=='success'): ?>
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                        Sukses
                                                    </span>
                                                <?php elseif($item->status=='pending'): ?>
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                        Tertunda
                                                    </span>
                                                <?php else: ?>
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-600">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                        Gagal
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-right whitespace-nowrap">
                                                <div class="text-sm font-semibold text-base-content"><?php echo e($item->created_at?->format('d M Y') ?? '-'); ?></div>
                                                <div class="text-xs text-base-content/40 flex items-center justify-end gap-1 mt-0.5">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <?php echo e($item->created_at?->format('H:i')); ?> WIB
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                    <?php if($item->status==='pending'): ?>
                                                        <form action="<?php echo e(route('admin.transactions.sync', $item->order_id)); ?>" method="POST" class="inline">
                                                            <?php echo csrf_field(); ?>
                                                            <button type="submit" class="btn btn-xs bg-amber-50 hover:bg-amber-100 text-amber-700 border-amber-200 rounded-lg font-bold flex items-center gap-1" title="Sync Midtrans">
                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                                Sync
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <form action="<?php echo e(route('admin.transactions.destroy', $item->order_id)); ?>" method="POST" class="inline" x-data="{ open: false }" @submit.prevent="open = true">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button type="button" @click="open = true" class="btn btn-xs btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold" title="Hapus">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                        </button>
                                                        <?php if (isset($component)) { $__componentOriginal1978ea6189800d3ead8e1d285a55da54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1978ea6189800d3ead8e1d285a55da54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.confirm-delete-modal','data' => ['entityName' => ''.e($item->donor_name).'','entityType' => 'transaksi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirm-delete-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['entity-name' => ''.e($item->donor_name).'','entity-type' => 'transaksi']); ?>
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
                                            <td colspan="7">
                                                <div class="py-16 text-center">
                                                    <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                        <svg class="w-8 h-8 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                    </div>
                                                    <p class="font-extrabold text-base-content">Belum ada sponsorship</p>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/transactions/index.blade.php ENDPATH**/ ?>