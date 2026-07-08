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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Profil & Berkas Yayasan</h1>
                            <p class="text-sm text-base-content/50">Kelola informasi dasar, visi misi, dokumen resmi, dan data pendiri.</p>
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

        
        <div class="flex gap-1 bg-white rounded-xl p-1.5 shadow-sm border border-base-300 w-fit">
            <button class="px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200 bg-primary text-white shadow-sm" id="tab-profil" onclick="switchProfilTab('profil')">
                Profil Yayasan
            </button>
            <button class="px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200 text-base-content/50 hover:text-base-content hover:bg-base-200" id="tab-pendiri" onclick="switchProfilTab('pendiri')">
                Pendiri & Pengurus
                <span class="ml-1.5 px-2 py-0.5 rounded-full text-xs bg-base-300"><?php echo e($pendiris->count()); ?></span>
            </button>
        </div>

        
        <div id="panel-profil" class="tab-panel">
            <form action="<?php echo e(route('admin.profil.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <div class="bg-white rounded-xl shadow-sm border border-base-300 mb-5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">🏢</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Informasi Dasar</p>
                            <p class="text-xs text-base-content/50">Nama, kontak, logo, dan alamat yayasan</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Nama Yayasan</span></label>
                                <input type="text" name="nama_yayasan" class="input input-bordered w-full" required
                                       value="<?php echo e(old('nama_yayasan', $profil?->nama_yayasan)); ?>" placeholder="Yayasan Baitul Yatim">
                                <?php $__errorArgs = ['nama_yayasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Email Resmi</span></label>
                                <input type="email" name="email" class="input input-bordered w-full" required
                                       value="<?php echo e(old('email', $profil?->email)); ?>" placeholder="info@yayasan.org">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">No. Telepon / WhatsApp</span></label>
                                <input type="text" name="no_telp" class="input input-bordered w-full" required
                                       value="<?php echo e(old('no_telp', $profil?->no_telp)); ?>" placeholder="08123456789">
                                <?php $__errorArgs = ['no_telp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Logo Yayasan</span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="logo-input">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span id="logo-label" class="text-sm text-emerald-600 font-semibold">Pilih foto logo…</span>
                                    </label>
                                    <input type="file" name="logo" id="logo-input" accept="image/*" class="hidden" onchange="document.getElementById('logo-label').textContent=this.files[0]?.name||'Pilih foto logo…'">
                                </div>
                                <p class="text-xs text-emerald-400 mt-1">JPG/PNG · Maks 2MB</p>
                                <?php if($profil?->logo): ?>
                                    <div class="mt-2 p-2 border border-emerald-200 rounded-xl bg-emerald-50 inline-block">
                                        <img src="<?php echo e(asset('storage/' . $profil->logo) . '?v=' . now()->timestamp); ?>" class="max-h-16 rounded-lg" alt="Logo saat ini">
                                    </div>
                                <?php endif; ?>
                                <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Alamat Lengkap</span></label>
                            <textarea name="alamat" rows="2" class="textarea textarea-bordered w-full" required placeholder="Jl. Kebaikan No. 1, Kota..."><?php echo e(old('alamat', $profil?->alamat)); ?></textarea>
                            <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border border-base-300 mb-5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">📖</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Sejarah, Visi & Misi</p>
                            <p class="text-xs text-base-content/50">Narasi dan arah gerak yayasan</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-control mb-4">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Sejarah / Deskripsi Yayasan</span></label>
                            <textarea name="sejarah_yayasan" rows="5" class="textarea textarea-bordered w-full" required placeholder="Ceritakan bagaimana yayasan ini berdiri dan berkembang…"><?php echo e(old('sejarah_yayasan', $profil?->sejarah_yayasan)); ?></textarea>
                            <?php $__errorArgs = ['sejarah_yayasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Visi</span></label>
                                <textarea name="visi" rows="4" class="textarea textarea-bordered w-full" required placeholder="Menjadi lembaga amanah…"><?php echo e(old('visi', $profil?->visi)); ?></textarea>
                                <?php $__errorArgs = ['visi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Misi <span class="font-normal normal-case text-emerald-400">(gunakan Enter untuk poin baru)</span></span></label>
                                <textarea name="misi" rows="4" class="textarea textarea-bordered w-full" required placeholder="• Memberikan pendidikan terbaik&#10;• Mengelola amanah dengan transparan"><?php echo e(old('misi', $profil?->misi)); ?></textarea>
                                <?php $__errorArgs = ['misi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border border-base-300 mb-5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">📱</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">QRIS Pembayaran</p>
                            <p class="text-xs text-base-content/50">Upload QRIS yayasan untuk pembayaran donasi langsung</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Foto QRIS <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                            <div class="relative">
                                <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="qris-input">
                                    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    <span id="qris-label" class="text-sm text-emerald-600 font-semibold">Pilih foto QRIS…</span>
                                </label>
                                <input type="file" name="foto_qris" id="qris-input" accept="image/*" class="hidden" onchange="document.getElementById('qris-label').textContent=this.files[0]?.name||'Pilih foto QRIS…'">
                            </div>
                            <p class="text-xs text-emerald-400 mt-1">JPG / PNG · Maks 2MB</p>
                            <?php if($profil?->foto_qris): ?>
                                <div class="mt-2 p-2 border border-emerald-200 rounded-xl bg-emerald-50 inline-block">
                                    <p class="text-xs text-emerald-400 font-semibold text-center mb-1">QRIS saat ini</p>
                                    <img src="<?php echo e(asset('storage/' . $profil->foto_qris) . '?v=' . now()->timestamp); ?>" class="max-h-32 mx-auto rounded-lg" alt="QRIS">
                                </div>
                            <?php endif; ?>
                            <?php $__errorArgs = ['foto_qris'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border border-base-300 mb-5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">📂</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Berkas Resmi & Transparansi</p>
                            <p class="text-xs text-base-content/50">Dokumen legalitas dan bagan struktur organisasi</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Surat Legalitas Resmi <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="legalitas-input">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span id="legalitas-label" class="text-sm text-emerald-600 font-semibold">Pilih foto dokumen…</span>
                                    </label>
                                    <input type="file" name="foto_legalitas" id="legalitas-input" accept="image/*" class="hidden" onchange="document.getElementById('legalitas-label').textContent=this.files[0]?.name||'Pilih foto dokumen…'">
                                </div>
                                <p class="text-xs text-emerald-400 mt-1">JPG / PNG · Maks 2MB</p>
                                <?php if($profil?->foto_legalitas): ?>
                                    <div class="mt-2 p-2 border border-emerald-200 rounded-xl bg-emerald-50">
                                        <p class="text-xs text-emerald-400 font-semibold text-center mb-1">Berkas saat ini</p>
                                        <img src="<?php echo e(asset('storage/' . $profil->foto_legalitas) . '?v=' . now()->timestamp); ?>" class="max-h-36 mx-auto rounded-lg" alt="Legalitas">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Bagan Struktur Organisasi <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="struktur-input">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span id="struktur-label" class="text-sm text-emerald-600 font-semibold">Pilih foto bagan…</span>
                                    </label>
                                    <input type="file" name="foto_struktur" id="struktur-input" accept="image/*" class="hidden" onchange="document.getElementById('struktur-label').textContent=this.files[0]?.name||'Pilih foto bagan…'">
                                </div>
                                <p class="text-xs text-emerald-400 mt-1">JPG / PNG · Maks 2MB</p>
                                <?php if($profil?->foto_struktur): ?>
                                    <div class="mt-2 p-2 border border-emerald-200 rounded-xl bg-emerald-50">
                                        <p class="text-xs text-emerald-400 font-semibold text-center mb-1">Berkas saat ini</p>
                                        <img src="<?php echo e(asset('storage/' . $profil->foto_struktur) . '?v=' . now()->timestamp); ?>" class="max-h-36 mx-auto rounded-lg" alt="Struktur">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a href="<?php echo e(route('admin.profil.index')); ?>" class="btn btn-ghost font-bold">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 font-bold rounded-lg">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>

        
        <div id="panel-pendiri" class="tab-panel hidden">

            
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">👥</div>
                    <div>
                        <p class="font-extrabold text-sm text-base-content">Daftar Pendiri Saat Ini</p>
                        <p class="text-xs text-base-content/50"><?php echo e($pendiris->count()); ?> orang terdaftar dan tampil di halaman publik</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        <?php $__empty_1 = true; $__currentLoopData = $pendiris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendiri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="group bg-white rounded-xl shadow-sm border border-base-200 overflow-hidden hover:shadow-md transition-all duration-200">
                                <div class="px-5 pt-5 pb-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center gap-4">
                                            <?php if($pendiri->foto): ?>
                                                <img src="<?php echo e(asset('storage/' . $pendiri->foto) . '?v=' . now()->timestamp); ?>" class="w-14 h-14 rounded-xl object-cover shadow-sm ring-2 ring-base-300" alt="<?php echo e($pendiri->nama); ?>">
                                            <?php else: ?>
                                                <div class="w-14 h-14 rounded-xl bg-primary text-white font-extrabold text-lg flex items-center justify-center shadow-sm"><?php echo e(strtoupper(substr($pendiri->nama, 0, 1))); ?></div>
                                            <?php endif; ?>
                                            <div>
                                                <p class="font-bold text-sm text-base-content"><?php echo e($pendiri->nama); ?></p>
                                                <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-primary bg-primary/10 px-2 py-0.5 rounded-full mt-1"><?php echo e($pendiri->jabatan); ?></span>
                                            </div>
                                        </div>
                                        <form action="<?php echo e(route('admin.pendiri.destroy', $pendiri->id)); ?>" method="POST"
                                              x-data="{ open: false }" @submit.prevent="open = true">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="button" @click="open = true" class="btn btn-ghost btn-sm btn-circle text-base-content/20 hover:text-error hover:bg-error/5 opacity-0 group-hover:opacity-100 transition-all" title="Hapus">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                            </button>
                                            <?php if (isset($component)) { $__componentOriginal1978ea6189800d3ead8e1d285a55da54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1978ea6189800d3ead8e1d285a55da54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.confirm-delete-modal','data' => ['entityName' => ''.e($pendiri->nama).'','entityType' => 'pengurus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('confirm-delete-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['entity-name' => ''.e($pendiri->nama).'','entity-type' => 'pengurus']); ?>
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
                                </div>
                                <div class="px-5 pb-5 pt-3">
                                    <?php if($pendiri->deskripsi): ?>
                                        <div class="bg-base-200/50 rounded-lg p-3 border border-base-200">
                                            <svg class="w-3 h-3 text-base-content/30 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151C7.546 6.068 5.983 8.789 5.983 11H10v10H0z"/></svg>
                                            <p class="text-xs text-base-content/60 italic leading-relaxed">"<?php echo e($pendiri->deskripsi); ?>"</p>
                                        </div>
                                    <?php else: ?>
                                        <div class="bg-base-200/50 rounded-lg p-3 border border-base-200">
                                            <p class="text-xs text-base-content/40 italic">Tidak ada kata sambutan</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-span-full text-center py-12 border-2 border-dashed border-base-300 rounded-xl bg-base-100">
                                <div class="text-4xl mb-3">👥</div>
                                <p class="font-bold text-base-content">Belum Ada Data Pendiri</p>
                                <p class="text-sm text-base-content/50 mt-1">Tambahkan pendiri pertama lewat form di bawah.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <form action="<?php echo e(route('admin.pendiri.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden mb-10">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">➕</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Tambah Pendiri Baru</p>
                            <p class="text-xs text-base-content/50">Lengkapi data berikut untuk menambahkan pendiri atau pengurus baru</p>
                        </div>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Nama Lengkap</span></label>
                                <input type="text" name="nama" class="input input-bordered w-full focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200" required value="<?php echo e(old('nama')); ?>" placeholder="Nama lengkap">
                                <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Jabatan</span></label>
                                <input type="text" name="jabatan" class="input input-bordered w-full focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200" required value="<?php echo e(old('jabatan')); ?>" placeholder="Ketua Yayasan">
                                <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Kata Sambutan <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                            <textarea name="deskripsi" rows="3" class="textarea textarea-bordered w-full focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200" placeholder="Kata sambutan singkat…"><?php echo e(old('deskripsi')); ?></textarea>
                            <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Foto</span></label>
                            <div class="relative">
                                <label class="flex items-center gap-3 p-4 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50/50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all group" for="pendiri-foto-input">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-600"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </div>
                                    <div>
                                        <span id="pendiri-foto-label" class="text-sm font-semibold text-emerald-700">Pilih foto pendiri</span>
                                        <p class="text-xs text-emerald-400">JPG/PNG · Maks 1MB</p>
                                    </div>
                                </label>
                                <input type="file" name="foto" id="pendiri-foto-input" accept="image/*" class="hidden" onchange="document.getElementById('pendiri-foto-label').textContent=this.files[0]?.name||'Pilih foto pendiri'">
                            </div>
                            <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-3 border-t border-emerald-100">
                            <button type="reset" class="btn btn-outline btn-sm" onclick="document.getElementById('pendiri-foto-label').textContent='Pilih foto pendiri'">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-success btn-sm">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                                Tambah Pendiri
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script>
    function switchProfilTab(tab) {
        const tabs = ['profil', 'pendiri'];
        tabs.forEach(t => {
            document.getElementById('tab-' + t).classList.toggle('tab-active', t === tab);
            document.getElementById('panel-' + t).classList.toggle('hidden', t !== tab);
        });
    }

    <?php if($errors->has('nama') || $errors->has('jabatan') || $errors->has('foto')): ?>
        document.addEventListener('DOMContentLoaded', () => switchProfilTab('pendiri'));
    <?php endif; ?>
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
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/profil/index.blade.php ENDPATH**/ ?>