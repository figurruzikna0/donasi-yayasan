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
            Edit Data User
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-lg border border-emerald-200">
                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-lg">👤</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Edit User: <?php echo e($user->name); ?></h3>
                        <p class="text-white/75 text-sm">Perbarui informasi data user</p>
                    </div>
                </div>

                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-error mb-4">
                            <ul class="text-sm">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>• <?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="flex items-center gap-4 mb-5 pb-4 border-b border-emerald-100">
                            <div class="avatar">
                                <div class="w-16 h-16 rounded-full ring ring-emerald-200 ring-offset-2">
                                    <?php if($user->avatar): ?>
                                        <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" alt="<?php echo e($user->name); ?>" class="object-cover">
                                    <?php else: ?>
                                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=b3e093&color=5c8148&bold=true&size=64" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div>
                                <p class="font-bold text-emerald-700"><?php echo e($user->name); ?></p>
                                <p class="text-sm text-emerald-500"><?php echo e($user->email); ?></p>
                                <p class="text-xs text-emerald-400">Bergabung <?php echo e($user->created_at->format('d M Y')); ?></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">Nama Lengkap</span></label>
                                <input type="text" name="name" class="input input-bordered" value="<?php echo e(old('name', $user->name)); ?>" required>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">Email</span></label>
                                <input type="email" name="email" class="input input-bordered" value="<?php echo e(old('email', $user->email)); ?>" required>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">No. HP / WA</span></label>
                                <input type="text" name="phone" class="input input-bordered" value="<?php echo e(old('phone', $user->phone)); ?>" placeholder="081234567890">
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">NIK</span></label>
                                <input type="text" name="nik" class="input input-bordered" value="<?php echo e(old('nik', $user->nik)); ?>" placeholder="16 digit NIK">
                            </div>
                        </div>

                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-semibold text-emerald-700">Alamat Lengkap</span></label>
                            <textarea name="address" class="textarea textarea-bordered" rows="3" placeholder="Alamat lengkap..."><?php echo e(old('address', $user->address)); ?></textarea>
                        </div>

                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-semibold text-emerald-700">Role</span></label>
                            <select name="role" class="select select-bordered">
                                <option value="donatur" <?php echo e($user->role == 'donatur' ? 'selected' : ''); ?>>Donatur</option>
                                <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-between mt-8 pt-4 border-t border-emerald-100">
                            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline">← Kembali</a>
                            <button type="submit" class="btn btn-success text-white font-bold">Simpan Perubahan</button>
                        </div>
                    </form>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>