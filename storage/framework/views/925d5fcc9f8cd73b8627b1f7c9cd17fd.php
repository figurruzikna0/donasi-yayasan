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
    <div class="bg-base-200 min-h-0">

        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-500 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">💳 Manajemen Transaksi</h1>
                        <p class="text-emerald-100 text-sm mt-1">Kelola semua transaksi donasi kampanye & sponsorship orang tua asuh</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            
            <?php if(session('success')): ?>
                <div class="alert alert-success mb-6 shadow-md border-0">
                    <span><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-error mb-6 shadow-md border-0">
                    <span><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?>
            <?php if(session('info')): ?>
                <div class="alert alert-info mb-6 shadow-md border-0">
                    <span><?php echo e(session('info')); ?></span>
                </div>
            <?php endif; ?>

            
            <div class="tabs tabs-boxed bg-emerald-50 border border-emerald-200 p-1 gap-0 flex-wrap mb-6" id="tabNav">
                <button class="tab tab-active text-emerald-700 font-bold text-sm px-5 py-3" data-tab="donasi" onclick="switchTab('donasi')">
                    💰 Donasi Kampanye
                    <span class="badge badge-sm ml-2"><?php echo e($donations->count()); ?></span>
                    <?php if($donations->where('status','pending')->count() > 0): ?>
                        <span class="badge badge-warning badge-sm ml-1"><?php echo e($donations->where('status','pending')->count()); ?> pending</span>
                    <?php endif; ?>
                </button>
                <button class="tab text-emerald-600 font-bold text-sm px-5 py-3 hover:bg-emerald-100 transition-colors" data-tab="sponsor" onclick="switchTab('sponsor')">
                    🤝 Orang Tua Asuh
                    <span class="badge badge-sm ml-2"><?php echo e($sponsorships->count()); ?></span>
                    <?php if($sponsorships->where('status','pending')->count() > 0): ?>
                        <span class="badge badge-warning badge-sm ml-1"><?php echo e($sponsorships->where('status','pending')->count()); ?> pending</span>
                    <?php endif; ?>
                </button>
            </div>

            
            <div id="panel-donasi" class="tab-content">
                <div class="card bg-base-100 shadow-md border border-emerald-200">
                    <div class="p-4 border-b border-emerald-100 bg-emerald-50 flex flex-wrap gap-3 items-center justify-between rounded-t-lg">
                        <input type="text" id="searchDonasi" class="input input-bordered input-sm w-full max-w-xs border-emerald-200" placeholder="🔍 Cari nama, email, order ID…">
                        <div class="flex gap-1" id="filterDonasi">
                            <button class="btn btn-xs btn-success text-white font-bold filter-btn-donasi" data-status="all">Semua</button>
                            <button class="btn btn-xs btn-outline btn-success filter-btn-donasi" data-status="success">Sukses</button>
                            <button class="btn btn-xs btn-outline btn-warning filter-btn-donasi" data-status="pending">Tertunda</button>
                            <button class="btn btn-xs btn-outline btn-error filter-btn-donasi" data-status="gagal">Gagal</button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr class="bg-emerald-50/50">
                                    <th class="text-xs uppercase tracking-wider text-emerald-600">Donatur</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600">Kampanye</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600 text-right">Nominal</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600 text-center">Status</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600 text-right">Tanggal</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bodyDonasi">
                                <?php $__empty_1 = true; $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php $sk = match($item->status) { 'success'=>'success','pending'=>'pending',default=>'gagal' }; ?>
                                    <tr class="data-row-donasi hover:bg-emerald-50/50 transition-colors"
                                        data-search="<?php echo e(strtolower($item->donor_name.' '.$item->donor_email.' '.$item->order_id)); ?>"
                                        data-status="<?php echo e($sk); ?>">
                                        <td>
                                            <div class="font-semibold text-emerald-700 text-sm"><?php echo e($item->donor_name); ?></div>
                                            <div class="text-xs text-gray-500"><?php echo e($item->donor_email); ?></div>
                                        </td>
                                        <td>
                                            <span class="badge badge-ghost badge-sm"><?php echo e($item->target); ?></span>
                                        </td>
                                        <td class="text-right">
                                            <div class="font-bold text-emerald-600 whitespace-nowrap">Rp <?php echo e(number_format($item->amount, 0, ',', '.')); ?></div>
                                            <div class="text-xs text-gray-400 font-mono"><?php echo e($item->order_id); ?></div>
                                            <?php if($item->payment_method): ?>
                                                <div class="text-xs text-gray-400"><?php echo e($item->payment_method); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($item->status=='success'): ?>
                                                <span class="badge badge-success badge-sm">Sukses</span>
                                            <?php elseif($item->status=='pending'): ?>
                                                <span class="badge badge-warning badge-sm">Tertunda</span>
                                            <?php else: ?>
                                                <span class="badge badge-error badge-sm">Gagal</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-right whitespace-nowrap">
                                            <div class="text-sm font-semibold text-emerald-700"><?php echo e($item->created_at?->format('d/m/Y') ?? '-'); ?></div>
                                            <div class="text-xs text-gray-400"><?php echo e($item->created_at?->format('H:i')); ?> WIB</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="flex items-center justify-center gap-1">
                                                <?php if($item->status==='pending'): ?>
                                                    <form action="<?php echo e(route('admin.transactions.sync', $item->order_id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="btn btn-sm btn-warning font-bold" title="Sync status dari Midtrans">🔄 Sync</button>
                                                    </form>
                                                <?php endif; ?>
                                                <form action="<?php echo e(route('admin.transactions.destroy', $item->order_id)); ?>" method="POST"
                                                      x-data="{ open: false }" @submit.prevent="open = true">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-error" title="Hapus">🗑</button>
                                                    <dialog class="modal" :class="{ 'modal-open': open }">
                                                        <div class="modal-box">
                                                            <h3 class="font-bold text-lg">Hapus Transaksi</h3>
                                                            <p class="py-4">Yakin ingin menghapus transaksi <strong><?php echo e($item->order_id); ?></strong>?</p>
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
                                    <tr><td colspan="6"><div class="py-16 text-center text-sm text-gray-400">Belum ada data donasi.</div></td></tr>
                                <?php endif; ?>
                                <tr id="noResultDonasi" class="hidden"><td colspan="6"><div class="py-16 text-center text-sm text-gray-400">Tidak ditemukan.</div></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-emerald-100 bg-emerald-50 flex flex-wrap items-center justify-between gap-3 rounded-b-lg">
                        <div class="text-sm text-gray-500" id="infoDonasi">—</div>
                        <div class="flex items-center gap-2">
                            <button id="prevDonasi" class="btn btn-sm btn-outline border-emerald-300 text-emerald-600" disabled>←</button>
                            <div id="pagesDonasi" class="flex items-center gap-1"></div>
                            <button id="nextDonasi" class="btn btn-sm btn-outline border-emerald-300 text-emerald-600" disabled>→</button>
                        </div>
                    </div>
                </div>
            </div>

            
            <div id="panel-sponsor" class="tab-content hidden">
                <div class="card bg-base-100 shadow-md border border-emerald-200">
                    <div class="p-4 border-b border-emerald-100 bg-emerald-50 flex flex-wrap gap-3 items-center justify-between rounded-t-lg">
                        <input type="text" id="searchSponsor" class="input input-bordered input-sm w-full max-w-xs border-emerald-200" placeholder="🔍 Cari nama, email, order ID…">
                        <div class="flex gap-1" id="filterSponsor">
                            <button class="btn btn-xs btn-success text-white font-bold filter-btn-sponsor" data-status="all">Semua</button>
                            <button class="btn btn-xs btn-outline btn-success filter-btn-sponsor" data-status="success">Sukses</button>
                            <button class="btn btn-xs btn-outline btn-warning filter-btn-sponsor" data-status="pending">Tertunda</button>
                            <button class="btn btn-xs btn-outline btn-error filter-btn-sponsor" data-status="gagal">Gagal</button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr class="bg-emerald-50/50">
                                    <th class="text-xs uppercase tracking-wider text-emerald-600">Donatur</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600">Anak Asuh</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600">Paket</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600 text-right">Nominal</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600 text-center">Status</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600 text-right">Tanggal</th>
                                    <th class="text-xs uppercase tracking-wider text-emerald-600 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bodySponsor">
                                <?php $__empty_1 = true; $__currentLoopData = $sponsorships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php $sk = match($item->status) { 'success'=>'success','pending'=>'pending',default=>'gagal' }; ?>
                                    <tr class="data-row-sponsor hover:bg-emerald-50/50 transition-colors"
                                        data-search="<?php echo e(strtolower($item->donor_name.' '.$item->donor_email.' '.$item->order_id.' '.$item->target)); ?>"
                                        data-status="<?php echo e($sk); ?>">
                                        <td>
                                            <div class="font-semibold text-emerald-700 text-sm"><?php echo e($item->donor_name); ?></div>
                                            <div class="text-xs text-gray-500"><?php echo e($item->donor_email); ?></div>
                                            <?php if(isset($item->donor_phone)): ?>
                                                <div class="text-xs text-gray-400">📱 <?php echo e($item->donor_phone); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td><span class="badge badge-ghost badge-sm"><?php echo e($item->target); ?></span></td>
                                        <td><span class="badge badge-warning badge-sm"><?php echo e($item->package ?? '-'); ?></span></td>
                                        <td class="text-right">
                                            <div class="font-bold text-emerald-600 whitespace-nowrap">Rp <?php echo e(number_format($item->amount, 0, ',', '.')); ?></div>
                                            <div class="text-xs text-gray-400 font-mono"><?php echo e($item->order_id); ?></div>
                                            <?php if($item->payment_method): ?>
                                                <div class="text-xs text-gray-400"><?php echo e($item->payment_method); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($item->status=='success'): ?>
                                                <span class="badge badge-success badge-sm">Sukses</span>
                                            <?php elseif($item->status=='pending'): ?>
                                                <span class="badge badge-warning badge-sm">Tertunda</span>
                                            <?php else: ?>
                                                <span class="badge badge-error badge-sm">Gagal</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-right whitespace-nowrap">
                                            <div class="text-sm font-semibold text-emerald-700"><?php echo e($item->created_at?->format('d/m/Y') ?? '-'); ?></div>
                                            <div class="text-xs text-gray-400"><?php echo e($item->created_at?->format('H:i')); ?> WIB</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="flex items-center justify-center gap-1">
                                                <?php if($item->status==='pending'): ?>
                                                    <form action="<?php echo e(route('admin.transactions.sync', $item->order_id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="btn btn-sm btn-warning font-bold" title="Sync status dari Midtrans">🔄 Sync</button>
                                                    </form>
                                                <?php endif; ?>
                                                <form action="<?php echo e(route('admin.transactions.destroy', $item->order_id)); ?>" method="POST"
                                                      x-data="{ open: false }" @submit.prevent="open = true">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-error" title="Hapus">🗑</button>
                                                    <dialog class="modal" :class="{ 'modal-open': open }">
                                                        <div class="modal-box">
                                                            <h3 class="font-bold text-lg">Hapus Transaksi</h3>
                                                            <p class="py-4">Yakin ingin menghapus transaksi <strong><?php echo e($item->order_id); ?></strong>?</p>
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
                                    <tr><td colspan="7"><div class="py-16 text-center text-sm text-gray-400">Belum ada data sponsorship.</div></td></tr>
                                <?php endif; ?>
                                <tr id="noResultSponsor" class="hidden"><td colspan="7"><div class="py-16 text-center text-sm text-gray-400">Tidak ditemukan.</div></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-emerald-100 bg-emerald-50 flex flex-wrap items-center justify-between gap-3 rounded-b-lg">
                        <div class="text-sm text-gray-500" id="infoSponsor">—</div>
                        <div class="flex items-center gap-2">
                            <button id="prevSponsor" class="btn btn-sm btn-outline border-emerald-300 text-emerald-600" disabled>←</button>
                            <div id="pagesSponsor" class="flex items-center gap-1"></div>
                            <button id="nextSponsor" class="btn btn-sm btn-outline border-emerald-300 text-emerald-600" disabled>→</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
    function switchTab(tab) {
        document.querySelectorAll('#tabNav .tab').forEach(el => {
            el.classList.remove('tab-active');
            el.classList.add('text-emerald-600');
        });
        const btn = document.querySelector('#tabNav [data-tab="' + tab + '"]');
        btn.classList.add('tab-active');
        btn.classList.remove('text-emerald-600');
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.getElementById('panel-' + tab).classList.remove('hidden');
    }

    function makePaginator(opts) {
        const { rowSelector, searchId, filterId, suffix, noResultId, infoId, prevId, nextId, pagesId } = opts;
        const PER_PAGE = 8;
        let currentPage = 1;
        const allRows = Array.from(document.querySelectorAll(rowSelector));
        const noResult = document.getElementById(noResultId);
        const info = document.getElementById(infoId);
        const prevBtn = document.getElementById(prevId);
        const nextBtn = document.getElementById(nextId);
        const pagesWrap = document.getElementById(pagesId);

        function getStatus() {
            const active = document.querySelector(`#${filterId} .filter-btn-${suffix}.btn-success.text-white`);
            return active ? active.dataset.status : 'all';
        }

        function filterRows() {
            const q = document.getElementById(searchId).value.toLowerCase().trim();
            const stat = getStatus();
            return allRows.filter(r =>
                r.dataset.search.includes(q) && (stat === 'all' || r.dataset.status === stat)
            );
        }

        function render(filtered) {
            const total = filtered.length;
            allRows.forEach(r => r.classList.add('hidden'));
            if (total === 0) {
                noResult.classList.remove('hidden');
                info.textContent = '0 hasil';
                prevBtn.disabled = nextBtn.disabled = true;
                pagesWrap.innerHTML = '';
                return;
            }
            noResult.classList.add('hidden');
            const totalPages = Math.ceil(total / PER_PAGE);
            currentPage = Math.min(Math.max(currentPage, 1), totalPages);
            const start = (currentPage - 1) * PER_PAGE;
            const end = Math.min(start + PER_PAGE, total);
            for (let i = start; i < end; i++) filtered[i].classList.remove('hidden');
            info.textContent = `${start+1}–${end} dari ${total}`;
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages;
            pagesWrap.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                const b = document.createElement('button');
                b.textContent = i;
                b.className = 'btn btn-xs' + (i === currentPage ? ' btn-success text-white' : ' btn-ghost');
                b.addEventListener('click', () => { currentPage = i; render(filtered); });
                pagesWrap.appendChild(b);
            }
        }

        function doFilter() { currentPage = 1; render(filterRows()); }

        document.getElementById(searchId).addEventListener('input', doFilter);
        prevBtn.addEventListener('click', () => { currentPage--; render(filterRows()); });
        nextBtn.addEventListener('click', () => { currentPage++; render(filterRows()); });

        document.querySelectorAll(`.filter-btn-${suffix}`).forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll(`.filter-btn-${suffix}`).forEach(b => {
                    b.classList.remove('btn-success', 'text-white');
                    b.classList.add('btn-outline');
                });
                this.classList.remove('btn-outline');
                this.classList.add('btn-success', 'text-white');
                doFilter();
            });
        });

        render(filterRows());
    }

    document.addEventListener('DOMContentLoaded', function () {
        makePaginator({ rowSelector: '.data-row-donasi', searchId: 'searchDonasi', filterId: 'filterDonasi', suffix: 'donasi', noResultId: 'noResultDonasi', infoId: 'infoDonasi', prevId: 'prevDonasi', nextId: 'nextDonasi', pagesId: 'pagesDonasi' });
        makePaginator({ rowSelector: '.data-row-sponsor', searchId: 'searchSponsor', filterId: 'filterSponsor', suffix: 'sponsor', noResultId: 'noResultSponsor', infoId: 'infoSponsor', prevId: 'prevSponsor', nextId: 'nextSponsor', pagesId: 'pagesSponsor' });
    });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/transactions/index.blade.php ENDPATH**/ ?>