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
                        <h1 class="text-2xl sm:text-3xl font-black">🤝 Formulir Orang Tua Asuh</h1>
                        <p class="text-emerald-100 text-sm mt-1">Jadilah orang tua asuh untuk anak yatim</p>
                    </div>
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline border-white text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            
            <div class="card bg-emerald-50 border border-emerald-200 shadow-sm mb-6">
                <div class="card-body p-5 flex flex-row items-center gap-4">
                    <div class="avatar">
                        <div class="w-16 rounded-full ring ring-emerald-200">
                            <?php if($child->photo): ?>
                                <img src="<?php echo e(asset('storage/' . $child->photo)); ?>" alt="<?php echo e($child->name); ?>">
                            <?php else: ?>
                                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($child->name)); ?>&background=b3e093&color=5c8148&bold=true" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-emerald-500 uppercase tracking-wider font-bold">Anak Asuh</p>
                        <h3 class="font-bold text-emerald-700 text-lg"><?php echo e($child->name); ?></h3>
                        <p class="text-sm text-emerald-500"><?php echo e($child->age); ?> Tahun<?php echo e($child->jenis_kelamin ? ' · ' . $child->jenis_kelamin : ''); ?></p>
                    </div>
                    <?php if($child->description): ?>
                        <div class="ml-auto max-w-xs hidden sm:block">
                            <p class="text-xs text-emerald-600 italic">"<?php echo e(Str::limit($child->description, 80)); ?>"</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($errors->any()): ?>
                <div class="alert alert-error mb-6 shadow-md border-0">
                    <p class="text-sm font-bold mb-1">Harap perbaiki kesalahan berikut:</p>
                    <ul class="list-disc list-inside text-sm">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6 sm:p-8">

                    <form action="<?php echo e(route('sponsor.store', $child->id)); ?>" method="POST" id="sponsor-form">
                        <?php echo csrf_field(); ?>

                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-bold text-emerald-700">Nama Lengkap <span class="text-red-500">*</span></span>
                                </label>
                                <div class="join w-full">
                                    <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4 text-lg">👤</span>
                                    <input type="text" name="donor_name" required placeholder="Contoh: Budi Santoso"
                                           class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500" value="<?php echo e(old('donor_name')); ?>">
                                </div>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-bold text-emerald-700">Email <span class="text-red-500">*</span></span>
                                </label>
                                <div class="join w-full">
                                    <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4 text-lg">✉️</span>
                                    <input type="email" name="donor_email" required placeholder="email@anda.com"
                                           class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500" value="<?php echo e(old('donor_email')); ?>">
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">No. WhatsApp Aktif <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4 text-lg">📞</span>
                                <input type="text" name="donor_phone" required placeholder="081234567890"
                                       class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500" value="<?php echo e(old('donor_phone')); ?>">
                            </div>
                            <label class="label"><span class="label-text-alt text-emerald-500">Nomor ini dipakai untuk mengirim notifikasi jatuh tempo perpanjangan sponsorship</span></label>
                        </div>

                        
                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Pilih Paket Komitmen Bulanan <span class="text-red-500">*</span></span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
                                <?php
                                    $pakets = [
                                        'Bronze' => ['label' => 'Bronze', 'sub' => 'Pendidikan Dasar', 'nominal' => 1500000, 'icon' => '🥉', 'color' => 'amber'],
                                        'Silver' => ['label' => 'Silver', 'sub' => 'Pendidikan & Uang Saku', 'nominal' => 1750000, 'icon' => '🥈', 'color' => 'slate'],
                                        'Gold' => ['label' => 'Gold', 'sub' => 'Pendidikan, Gizi & Kesehatan', 'nominal' => 2500000, 'icon' => '🥇', 'color' => 'yellow'],
                                    ];
                                ?>
                                <?php $__currentLoopData = $pakets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button"
                                            class="paket-btn border-2 border-emerald-200 rounded-xl p-4 text-center hover:border-emerald-500 hover:bg-emerald-50 transition-all cursor-pointer <?php if(old('paket_komitmen') == $key): ?> border-emerald-600 bg-emerald-50 <?php endif; ?>"
                                            data-paket="<?php echo e($key); ?>"
                                            onclick="pilihPaket(this, '<?php echo e($key); ?>')">
                                        <div class="text-3xl mb-2"><?php echo e($p['icon']); ?></div>
                                        <div class="font-bold text-emerald-700"><?php echo e($p['label']); ?></div>
                                        <div class="text-xs text-slate-500 mt-1"><?php echo e($p['sub']); ?></div>
                                        <div class="font-bold text-emerald-600 mt-2">Rp<?php echo e(number_format($p['nominal'], 0, ',', '.')); ?></div>
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <select name="paket_komitmen" id="paket_komitmen" class="select select-bordered w-full border-emerald-200 focus:border-emerald-500 hidden" required onchange="updatePaketDetail()">
                                <option value="" disabled <?php echo e(old('paket_komitmen') ? '' : 'selected'); ?>>-- Pilih Paket --</option>
                                <option value="Bronze" <?php echo e(old('paket_komitmen') == 'Bronze' ? 'selected' : ''); ?>>Paket Bronze</option>
                                <option value="Silver" <?php echo e(old('paket_komitmen') == 'Silver' ? 'selected' : ''); ?>>Paket Silver</option>
                                <option value="Gold"   <?php echo e(old('paket_komitmen') == 'Gold'   ? 'selected' : ''); ?>>Paket Gold</option>
                            </select>

                            <input type="hidden" name="amount" id="amount-hidden">
                            <input type="hidden" name="description" id="description-hidden">

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                                    <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider mb-1">Nominal Komitmen</p>
                                    <p class="text-xl font-black text-emerald-700" id="amount-display">—</p>
                                </div>
                                <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                                    <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider mb-1">Peruntukan Dana</p>
                                    <p class="text-sm text-emerald-700" id="description-display">Pilih paket terlebih dahulu</p>
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Metode Pembayaran <span class="text-red-500">*</span></span>
                            </label>
                            <select name="payment_method" id="payment_method" class="select select-bordered w-full border-emerald-200 focus:border-emerald-500" required>
                                <option value="" disabled <?php echo e(old('payment_method') ? '' : 'selected'); ?>>-- Pilih Metode Pembayaran --</option>
                                <option value="BCA VA" <?php echo e(old('payment_method') == 'BCA VA' ? 'selected' : ''); ?>>🏦 Virtual Account BCA</option>
                                <option value="Mandiri Bill Payment" <?php echo e(old('payment_method') == 'Mandiri Bill Payment' ? 'selected' : ''); ?>>🏦 Mandiri Bill Payment</option>
                                <option value="BNI VA" <?php echo e(old('payment_method') == 'BNI VA' ? 'selected' : ''); ?>>🏦 Virtual Account BNI</option>
                                <option value="BRI VA" <?php echo e(old('payment_method') == 'BRI VA' ? 'selected' : ''); ?>>🏦 Virtual Account BRI</option>
                                <option value="CIMB NIAGA VA" <?php echo e(old('payment_method') == 'CIMB NIAGA VA' ? 'selected' : ''); ?>>🏦 Virtual Account CIMB Niaga</option>
                                <option value="Permata VA" <?php echo e(old('payment_method') == 'Permata VA' ? 'selected' : ''); ?>>🏦 Virtual Account Permata</option>
                                <option value="BSI VA" <?php echo e(old('payment_method') == 'BSI VA' ? 'selected' : ''); ?>>🏦 Virtual Account BSI</option>
                                <option value="GoPay" <?php echo e(old('payment_method') == 'GoPay' ? 'selected' : ''); ?>>📱 GoPay</option>
                                <option value="QRIS" <?php echo e(old('payment_method') == 'QRIS' ? 'selected' : ''); ?>>📱 QRIS</option>
                                <option value="ShopeePay" <?php echo e(old('payment_method') == 'ShopeePay' ? 'selected' : ''); ?>>📱 ShopeePay</option>
                            </select>
                        </div>

                        
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6 text-sm text-amber-800">
                            <p>📌 Komitmen ini berlaku untuk periode <strong>1 bulan</strong> sejak pembayaran berhasil. Kami akan mengirimkan pengingat via WhatsApp sebelum jatuh tempo.</p>
                        </div>

                        <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white font-bold w-full shadow-lg border-0 py-3 h-auto text-base" id="submit-btn">
                            🔐 Konfirmasi & Lanjutkan Pembayaran
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="text-center mt-6 text-xs text-slate-400">
                <p>🔒 Pembayaran diproses secara aman melalui <span class="font-semibold text-emerald-600">Midtrans</span></p>
            </div>
        </div>
    </div>

    <script>
        const dataPaket = {
            'Bronze': { nominal: 1500000, keterangan: 'Biaya SPP pendidikan dasar dan buku pelajaran bulanan.' },
            'Silver': { nominal: 1750000, keterangan: 'Biaya SPP pendidikan, buku pelajaran, dan alokasi uang saku harian.' },
            'Gold':   { nominal: 2500000, keterangan: 'Pembiayaan penuh (Pendidikan, uang saku, suplemen gizi, dan jaminan kesehatan bulanan).' }
        };

        function pilihPaket(btn, key) {
            document.querySelectorAll('.paket-btn').forEach(b => {
                b.classList.remove('border-emerald-600', 'bg-emerald-50');
                b.classList.add('border-emerald-200');
            });
            btn.classList.remove('border-emerald-200');
            btn.classList.add('border-emerald-600', 'bg-emerald-50');

            document.getElementById('paket_komitmen').value = key;
            updatePaketDetail();
        }

        function updatePaketDetail() {
            const pilihan       = document.getElementById('paket_komitmen').value;
            const hiddenAmount  = document.getElementById('amount-hidden');
            const hiddenDesc    = document.getElementById('description-hidden');
            const displayAmount = document.getElementById('amount-display');
            const displayDesc   = document.getElementById('description-display');

            if (dataPaket[pilihan]) {
                const paket = dataPaket[pilihan];
                hiddenAmount.value = paket.nominal;
                hiddenDesc.value   = paket.keterangan;
                displayAmount.textContent = 'Rp ' + paket.nominal.toLocaleString('id-ID');
                displayDesc.textContent   = paket.keterangan;
            } else {
                hiddenAmount.value = '';
                hiddenDesc.value   = '';
                displayAmount.textContent = '—';
                displayDesc.textContent   = 'Pilih paket terlebih dahulu';
            }
        }

        document.getElementById('sponsor-form').addEventListener('submit', function (e) {
            const amount = document.getElementById('amount-hidden').value;
            if (!amount) {
                e.preventDefault();
                alert('Harap pilih paket komitmen terlebih dahulu.');
                document.getElementById('paket_komitmen').focus();
                return;
            }
            document.getElementById('submit-btn').disabled = true;
            document.getElementById('submit-btn').textContent = 'Memproses...';
        });

        window.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('paket_komitmen');
            if (select.value) {
                updatePaketDetail();
                const btn = document.querySelector(`.paket-btn[data-paket="${select.value}"]`);
                if (btn) {
                    btn.classList.remove('border-emerald-200');
                    btn.classList.add('border-emerald-600', 'bg-emerald-50');
                }
            }
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
<?php endif; ?><?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/donations/sponsor.blade.php ENDPATH**/ ?>