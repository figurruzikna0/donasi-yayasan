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
                        <h1 class="text-2xl sm:text-3xl font-black">⚙️ Edit Profil</h1>
                        <p class="text-emerald-100 text-sm mt-1">Kelola data diri dan pengaturan akun</p>
                    </div>
                    <a href="<?php echo e(Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard')); ?>" class="btn btn-outline border-white text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

            
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>👤 Data Diri</span>
                    </h2>

                    <form method="post" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data" class="space-y-5">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('patch'); ?>

                        <div class="flex flex-col sm:flex-row gap-6 items-start">
                            <div class="flex-shrink-0 text-center">
                                <div class="avatar">
                                    <div class="w-24 h-24 rounded-full ring ring-emerald-200 ring-offset-2">
                                        <?php if($user->avatar): ?>
                                            <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" id="preview-avatar" alt="Avatar" class="object-cover">
                                        <?php else: ?>
                                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=b3e093&color=5c8148&bold=true&size=96" id="preview-avatar" alt="" class="object-cover">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="flex gap-2 justify-center mt-3">
                                    <label for="avatar" class="btn btn-sm btn-success text-white font-bold cursor-pointer">
                                        📷 Ganti
                                    </label>
                                    <?php if($user->avatar): ?>
                                        <button type="button" id="btn-hapus-foto" class="btn btn-sm btn-outline btn-error font-bold">
                                            🗑 Hapus
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden">
                                <input type="hidden" name="remove_avatar" id="remove_avatar" value="0">
                                <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="flex-1 space-y-4 w-full">
                                <div class="form-control w-full">
                                    <label class="label"><span class="label-text font-semibold text-emerald-700">Nama Lengkap</span></label>
                                    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500" required>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-control w-full">
                                    <label class="label"><span class="label-text font-semibold text-emerald-700">Email</span></label>
                                    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500" required>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <?php if($user->role !== 'admin'): ?>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="form-control w-full">
                                        <label class="label"><span class="label-text font-semibold text-emerald-700">No. WhatsApp</span></label>
                                        <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500" placeholder="08xxxx">
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-control w-full">
                                        <label class="label"><span class="label-text font-semibold text-emerald-700">NIK</span></label>
                                        <input type="text" name="nik" value="<?php echo e(old('nik', $user->nik)); ?>" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500" placeholder="Nomor Induk Kependudukan">
                                        <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="form-control w-full">
                                    <label class="label"><span class="label-text font-semibold text-emerald-700">Alamat</span></label>
                                    <textarea name="address" rows="3" class="textarea textarea-bordered w-full border-emerald-200 focus:border-emerald-500" placeholder="Alamat lengkap"><?php echo e(old('address', $user->address)); ?></textarea>
                                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-3 border-t border-emerald-100">
                            <button type="submit" class="btn btn-success text-white font-bold">💾 Simpan Data</button>
                            <?php if(session('status') === 'profile-updated'): ?>
                                <span class="text-emerald-600 font-semibold text-sm">✓ Data berhasil disimpan</span>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>🔒 Ubah Password</span>
                    </h2>

                    <form method="post" action="<?php echo e(route('password.update')); ?>" class="space-y-4 max-w-lg">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-semibold text-emerald-700">Password Saat Ini</span></label>
                            <div class="join w-full">
                                <input type="password" name="current_password" id="current_password" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500 join-item" required>
                                <button type="button" class="btn btn-outline border-emerald-200 join-item toggle-pw" data-target="current_password">👁</button>
                            </div>
                            <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="form-control w-full">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">Password Baru</span></label>
                                <div class="join w-full">
                                    <input type="password" name="password" id="new_password" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500 join-item" required>
                                    <button type="button" class="btn btn-outline border-emerald-200 join-item toggle-pw" data-target="new_password">👁</button>
                                </div>
                                <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-xs text-red-500 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-control w-full">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">Konfirmasi Password</span></label>
                                <div class="join w-full">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500 join-item" required>
                                    <button type="button" class="btn btn-outline border-emerald-200 join-item toggle-pw" data-target="password_confirmation">👁</button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-3">
                            <button type="submit" class="btn btn-success text-white font-bold">🔑 Ubah Password</button>
                            <?php if(session('status') === 'password-updated'): ?>
                                <span class="text-emerald-600 font-semibold text-sm">✓ Password berhasil diubah</span>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('avatar')?.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                document.getElementById('preview-avatar').src = URL.createObjectURL(this.files[0]);
                document.getElementById('remove_avatar').value = '0';
            }
        });

        document.getElementById('btn-hapus-foto')?.addEventListener('click', function() {
            document.getElementById('preview-avatar').src = 'https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=b3e093&color=5c8148&bold=true&size=96';
            document.getElementById('remove_avatar').value = '1';
            document.getElementById('avatar').value = '';
        });

        document.querySelectorAll('.toggle-pw').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var input = document.getElementById(this.dataset.target);
                if (input.type === 'password') {
                    input.type = 'text';
                    this.textContent = '🙈';
                } else {
                    input.type = 'password';
                    this.textContent = '👁';
                }
            });
        });

        document.querySelector('form[action="<?php echo e(route('password.update')); ?>"]')?.addEventListener('submit', function(e) {
            var pw = document.getElementById('new_password');
            var confirm = document.getElementById('password_confirmation');
            var err = document.getElementById('pw-confirm-error');
            if (pw.value !== confirm.value) {
                e.preventDefault();
                if (!err) {
                    err = document.createElement('p');
                    err.id = 'pw-confirm-error';
                    err.className = 'text-xs text-red-500 mt-1';
                    confirm.closest('.form-control').appendChild(err);
                }
                err.textContent = 'Konfirmasi password tidak cocok dengan password baru.';
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
<?php endif; ?><?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/profile/edit.blade.php ENDPATH**/ ?>