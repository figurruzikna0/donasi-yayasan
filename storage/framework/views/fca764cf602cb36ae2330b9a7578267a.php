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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Sponsorship Orang Tua Asuh</h1>
                            <p class="text-sm text-base-content/50">Pantau status sponsorship anak asuh, masa aktif, dan jatuh tempo perpanjangan.</p>
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

            
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex flex-wrap gap-3 items-center justify-between">
                    <div class="relative w-full max-w-[300px]">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-base-content/30">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" id="tableSearch" class="input input-bordered input-sm w-full pl-8" placeholder="Cari nama, anak asuh, order ID…">
                    </div>
                    <div>
                        <select id="statusFilter" class="select select-bordered select-sm">
                            <option value="all">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="pending">Menunggu Bayar</option>
                            <option value="kadaluarsa">Kadaluarsa</option>
                            <option value="gagal">Gagal</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Penyandang Dana &amp; Anak Asuh</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Paket &amp; Nominal</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Periode</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php $__empty_1 = true; $__currentLoopData = $sponsorships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsorship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $isExpiredPeriod = $sponsorship->expires_at && $sponsorship->expires_at->isPast();
                                    $remainingDays = $sponsorship->expires_at ? now()->diffInDays($sponsorship->expires_at) : null;

                                    $statusKey = match(true) {
                                        $sponsorship->status === 'pending' => 'pending',
                                        $sponsorship->status === 'success' && !$isExpiredPeriod => 'aktif',
                                        $sponsorship->status === 'success' && $isExpiredPeriod => 'kadaluarsa',
                                        $sponsorship->status === 'expired' => 'kadaluarsa',
                                        default => 'gagal',
                                    };
                                ?>
                                <tr class="data-row hover:bg-base-200/30 transition-colors"
                                    data-search="<?php echo e(strtolower($sponsorship->donor_name . ' ' . ($sponsorship->fosterChild->name ?? '') . ' ' . $sponsorship->order_id)); ?>"
                                    data-status="<?php echo e($statusKey); ?>">

                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-primary/10 text-primary font-bold text-sm flex items-center justify-center uppercase shrink-0"><?php echo e(substr($sponsorship->donor_name, 0, 1)); ?></div>
                                            <div>
                                                <div class="font-bold text-sm text-base-content"><?php echo e($sponsorship->donor_name); ?></div>
                                                <div class="text-xs text-base-content/40"><?php echo e($sponsorship->donor_email); ?></div>
                                                <div class="text-xs text-base-content/40">📱 <?php echo e($sponsorship->donor_phone ?? '-'); ?></div>
                                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-primary/5 text-primary border border-primary/20 mt-1"><?php echo e($sponsorship->fosterChild->name ?? 'Anak Dihapus'); ?></span>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.6rem] font-bold bg-amber-50 text-amber-700 border border-amber-200"><?php echo e($sponsorship->package ?? '-'); ?></span>
                                        <div class="font-black text-base-content mt-1">Rp <?php echo e(number_format($sponsorship->amount, 0, ',', '.')); ?></div>
                                        <div class="text-xs text-base-content/30 font-mono"><?php echo e($sponsorship->order_id); ?></div>
                                        <?php if($sponsorship->payment_method): ?>
                                            <div class="text-xs text-base-content/40">via <?php echo e($sponsorship->payment_method); ?></div>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if($sponsorship->starts_at && $sponsorship->expires_at): ?>
                                            <div class="text-sm font-bold text-base-content whitespace-nowrap"><?php echo e($sponsorship->starts_at->format('d M Y')); ?> – <?php echo e($sponsorship->expires_at->format('d M Y')); ?></div>
                                            <div class="text-xs mt-1">
                                                <?php if($statusKey === 'aktif'): ?>
                                                    <span class="text-emerald-600"><?php echo e($remainingDays); ?> hari lagi</span>
                                                <?php elseif($statusKey === 'kadaluarsa'): ?>
                                                    <span class="text-rose-600">Lewat <?php echo e($remainingDays); ?> hari</span>
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

                                    <td class="text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            <?php if($sponsorship->status === 'pending'): ?>
                                                <form action="<?php echo e(route('admin.sponsorships.approve', $sponsorship->order_id)); ?>" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                    <button type="button" @click="open = true" class="btn btn-sm bg-emerald-600 hover:bg-emerald-700 text-white border-0 rounded-lg font-bold" title="Setujui">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/></svg>
                                                        Setujui
                                                    </button>
                                                    <dialog class="modal" :class="{ 'modal-open': open }">
                                                        <div class="modal-box max-w-sm">
                                                            <div class="text-center">
                                                                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center">
                                                                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                                </div>
                                                                <h3 class="text-lg font-black text-base-content mb-1">Konfirmasi</h3>
                                                                <p class="text-sm text-base-content/60 mb-6">Setujui sponsorship ini secara manual?</p>
                                                            </div>
                                                            <div class="flex gap-2 justify-center">
                                                                <button type="button" @click="open = false" class="btn btn-ghost btn-sm font-bold px-6">Batal</button>
                                                                <button @click="open = false; $el.closest('form').submit()" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 btn-sm font-bold px-6">Setujui</button>
                                                            </div>
                                                        </div>
                                                        <form method="dialog" class="modal-backdrop"><button>close</button></form>
                                                    </dialog>
                                                </form>
                                            <?php endif; ?>
                                            <form action="<?php echo e(route('admin.sponsorships.destroy', $sponsorship->order_id)); ?>" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold" title="Hapus">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    Hapus
                                                </button>
                                                <?php if (isset($component)) { $__componentOriginal1978ea6189800d3ead8e1d285a55da54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1978ea6189800d3ead8e1d285a55da54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.confirm-delete-modal','data' => ['entityName' => ''.e($sponsorship->donor_name).'','entityType' => 'sponsorship']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirm-delete-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['entity-name' => ''.e($sponsorship->donor_name).'','entity-type' => 'sponsorship']); ?>
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
                                <tr id="emptyInitRow">
                                    <td colspan="5">
                                        <div class="py-16 text-center">
                                            <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-base-content">Belum Ada Sponsorship</p>
                                            <p class="text-sm text-base-content/50 mt-1">Sponsorship anak asuh yang masuk lewat Midtrans akan tampil di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <tr id="noResultRow" class="hidden">
                                <td colspan="5">
                                    <div class="py-16 text-center">
                                        <p class="font-extrabold text-base-content">Tidak Ditemukan</p>
                                        <p class="text-sm text-base-content/50">Coba kata kunci pencarian yang berbeda.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-base-200 flex flex-wrap items-center justify-between gap-3">
                    <div class="text-sm text-base-content/50" id="paginationInfo">Menampilkan <strong>0</strong> hasil</div>
                    <div class="flex items-center gap-2">
                        <button id="prevBtn" class="btn btn-sm btn-ghost font-bold" disabled>← Prev</button>
                        <div id="pageNumbers" class="flex items-center gap-1"></div>
                        <button id="nextBtn" class="btn btn-sm btn-ghost font-bold" disabled>Next →</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rowsPerPage = 5;
            let currentPage = 1;

            const searchInput  = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const allRows      = Array.from(document.querySelectorAll('.data-row'));
            const noResultRow  = document.getElementById('noResultRow');
            const prevBtn      = document.getElementById('prevBtn');
            const nextBtn      = document.getElementById('nextBtn');
            const pageNums     = document.getElementById('pageNumbers');
            const pageInfo     = document.getElementById('paginationInfo');

            let filteredRows = [...allRows];

            function render() {
                const total = filteredRows.length;

                if (total === 0) {
                    noResultRow.classList.remove('hidden');
                    allRows.forEach(r => r.classList.add('hidden'));
                    pageInfo.innerHTML = "Menampilkan <strong>0</strong> hasil";
                    prevBtn.disabled = nextBtn.disabled = true;
                    pageNums.innerHTML = '';
                    return;
                }

                noResultRow.classList.add('hidden');
                const totalPages = Math.ceil(total / rowsPerPage);
                currentPage = Math.min(Math.max(currentPage, 1), totalPages);
                const start = (currentPage - 1) * rowsPerPage;
                const end   = Math.min(start + rowsPerPage, total);

                allRows.forEach(r => r.classList.add('hidden'));
                for (let i = start; i < end; i++) filteredRows[i].classList.remove('hidden');

                pageInfo.innerHTML = `Menampilkan <strong>${start + 1}–${end}</strong> dari <strong>${total}</strong> sponsorship`;
                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages;

                pageNums.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const b = document.createElement('button');
                    b.textContent = i;
                    b.className = 'btn btn-sm' + (i === currentPage ? ' bg-primary text-white border-0' : ' btn-ghost');
                    b.addEventListener('click', () => { currentPage = i; render(); });
                    pageNums.appendChild(b);
                }
            }

            function filter() {
                const q    = searchInput.value.toLowerCase().trim();
                const stat = statusFilter.value;

                filteredRows = allRows.filter(row =>
                    row.dataset.search.includes(q) &&
                    (stat === 'all' || row.dataset.status === stat)
                );

                currentPage = 1;
                render();
            }

            searchInput.addEventListener('input', filter);
            statusFilter.addEventListener('change', filter);
            prevBtn.addEventListener('click', () => { currentPage--; render(); });
            nextBtn.addEventListener('click', () => { currentPage++; render(); });

            render();
        });
    </script>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/sponsorships/index.blade.php ENDPATH**/ ?>