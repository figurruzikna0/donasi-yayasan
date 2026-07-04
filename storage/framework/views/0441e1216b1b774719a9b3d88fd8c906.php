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
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Tambah Laporan Perkembangan
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-lg">📈</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Laporan Perkembangan Baru</h3>
                        <p class="text-white/80 text-sm">Catat update terbaru untuk anak yang sedang disponsori</p>
                    </div>
                </div>

                <div class="card-body p-8">
                    <form action="<?php echo e(route('admin.child-developments.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Pilih Anak Asuh</span>
                            </label>
                            <select name="foster_child_id" class="select select-bordered w-full" required>
                                <option value="">— Pilih anak asuh yang sedang disponsori —</option>
                                <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($child->id); ?>" <?php if(old('foster_child_id') == $child->id): echo 'selected'; endif; ?>>
                                        <?php echo e($child->name); ?> (<?php echo e($child->age); ?> tahun)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['foster_child_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-xs text-emerald-500 mt-1">Hanya anak yang memiliki sponsorship aktif yang muncul di daftar ini.</p>
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Tanggal Laporan</span>
                            </label>
                            <input type="date" name="tanggal" class="input input-bordered w-full" required
                                   value="<?php echo e(old('tanggal', date('Y-m-d'))); ?>">
                            <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Judul Laporan</span>
                            </label>
                            <input type="text" name="judul" class="input input-bordered w-full" required
                                   value="<?php echo e(old('judul')); ?>"
                                   placeholder="Contoh: Naik ke Kelas 5, Nilai Rapor Membaik">
                            <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="divider"></div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Deskripsi Perkembangan</span>
                            </label>
                            <textarea name="deskripsi" rows="6" class="textarea textarea-bordered w-full" required
                                      placeholder="Ceritakan perkembangan anak: akademik, kesehatan, sikap, atau hal lain yang relevan untuk orang tua asuh ketahui..."><?php echo e(old('deskripsi')); ?></textarea>
                            <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-control mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700 uppercase">Foto <span class="font-normal normal-case text-emerald-400">(Opsional, Maks. 3MB)</span></span>
                            </label>
                            <div class="file-input-wrapper">
                                <label class="file-input-label" id="file-label">
                                    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span id="file-label-text">Pilih foto untuk diunggah...</span>
                                </label>
                                <input type="file" name="foto" id="photo-input" accept="image/*" class="hidden-file">
                            </div>
                            <p class="text-xs text-emerald-500 mt-1">Format: JPG, PNG, WEBP</p>
                            <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="divider"></div>

                        <div class="flex items-center justify-end gap-3">
                            <a href="<?php echo e(route('admin.child-developments.index')); ?>" class="btn btn-outline">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                    <polyline points="17 21 17 13 7 13 7 21"/>
                                    <polyline points="7 3 7 8 15 8"/>
                                </svg>
                                Simpan Laporan
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <style>
        .file-input-wrapper { position: relative; }
        .file-input-label {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px;
            border: 1.5px dashed oklch(var(--bc)/0.3);
            border-radius: 10px;
            background: oklch(var(--b2)/0.5);
            cursor: pointer;
            font-size: 0.88rem;
            font-weight: 600;
            transition: border-color 0.2s, background 0.2s;
        }
        .file-input-label:hover { border-color: oklch(var(--p)); background: oklch(var(--p)/0.1); }
        input[type="file"].hidden-file {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
    </style>

    <script>
        document.getElementById('photo-input').addEventListener('change', function () {
            const labelText = document.getElementById('file-label-text');
            labelText.textContent = this.files.length > 0 ? this.files[0].name : 'Pilih foto untuk diunggah...';
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/child-developments/create.blade.php ENDPATH**/ ?>