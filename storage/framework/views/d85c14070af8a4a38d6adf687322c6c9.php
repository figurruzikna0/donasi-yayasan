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
    <div class="bg-base-200 p-7">

        
        <div class="flex items-end justify-between gap-3 mb-6 flex-wrap">
            <div>
                <nav class="text-sm text-emerald-500 mb-1">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="link link-hover text-emerald-600">Dashboard</a>
                    <span class="mx-1">/</span>
                    <span class="text-emerald-600">Profil Yayasan</span>
                </nav>
                <h1 class="text-2xl font-black text-emerald-700">Profil & Berkas Yayasan</h1>
                <p class="text-sm text-emerald-500 mt-1">Kelola informasi dasar, visi misi, dokumen resmi, dan data pendiri.</p>
            </div>
        </div>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success mb-5">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-error mb-5">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        
        <div class="tabs tabs-box bg-base-100 border border-emerald-200 mb-5 w-fit">
            <button class="tab tab-active font-bold text-emerald-700" id="tab-profil" onclick="switchProfilTab('profil')">
                Profil Yayasan
            </button>
            <button class="tab font-bold text-emerald-600" id="tab-pendiri" onclick="switchProfilTab('pendiri')">
                Pendiri & Pengurus
                <span class="badge badge-sm ml-1"><?php echo e($pendiris->count()); ?></span>
            </button>
        </div>

        
        <div id="panel-profil" class="tab-panel">
            <form action="<?php echo e(route('admin.profil.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <div class="card bg-base-100 shadow-md border border-emerald-200 mb-5">
                    <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">🏢</div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Informasi Dasar</h3>
                            <p class="text-white/80 text-sm">Nama, kontak, dan alamat yayasan</p>
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

                
                <div class="card bg-base-100 shadow-md border border-emerald-200 mb-5">
                    <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">📖</div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Sejarah, Visi & Misi</h3>
                            <p class="text-white/80 text-sm">Narasi dan arah gerak yayasan</p>
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

                
                <div class="card bg-base-100 shadow-md border border-emerald-200 mb-5">
                    <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">📂</div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Berkas Resmi & Transparansi</h3>
                            <p class="text-white/80 text-sm">Dokumen legalitas dan bagan struktur organisasi</p>
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
                                        <img src="<?php echo e(asset('storage/' . $profil->foto_legalitas)); ?>" class="max-h-36 mx-auto rounded-lg" alt="Legalitas">
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
                                        <img src="<?php echo e(asset('storage/' . $profil->foto_struktur)); ?>" class="max-h-36 mx-auto rounded-lg" alt="Struktur">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mb-10">
                    <a href="<?php echo e(route('admin.profil.index')); ?>" class="btn btn-outline">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>

        
        <div id="panel-pendiri" class="tab-panel hidden">

            
            <div class="card bg-base-100 shadow-md border border-emerald-200 mb-5">
                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">👥</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Daftar Pendiri Saat Ini</h3>
                        <p class="text-white/80 text-sm"><?php echo e($pendiris->count()); ?> orang terdaftar dan tampil di halaman publik</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        <?php $__empty_1 = true; $__currentLoopData = $pendiris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendiri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="group bg-white rounded-xl shadow-sm border border-emerald-100 overflow-hidden hover:shadow-lg hover:border-emerald-300 transition-all duration-200">
                                <div class="bg-gradient-to-r from-emerald-50 to-white px-5 pt-5 pb-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center gap-4">
                                            <?php if($pendiri->foto): ?>
                                                <img src="<?php echo e(asset('storage/' . $pendiri->foto)); ?>" class="w-14 h-14 rounded-xl object-cover shadow-sm ring-2 ring-emerald-200" alt="<?php echo e($pendiri->nama); ?>">
                                            <?php else: ?>
                                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 text-white font-extrabold text-lg flex items-center justify-center shadow-sm"><?php echo e(strtoupper(substr($pendiri->nama, 0, 1))); ?></div>
                                            <?php endif; ?>
                                            <div>
                                                <p class="font-bold text-emerald-800 text-sm"><?php echo e($pendiri->nama); ?></p>
                                                <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-full mt-1"><?php echo e($pendiri->jabatan); ?></span>
                                            </div>
                                        </div>
                                        <form action="<?php echo e(route('admin.pendiri.destroy', $pendiri->id)); ?>" method="POST"
                                              x-data="{ open: false }" @submit.prevent="open = true">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="button" @click="open = true" class="btn btn-ghost btn-sm btn-circle text-gray-300 hover:text-red-500 hover:bg-red-50 opacity-0 group-hover:opacity-100 transition-all" title="Hapus">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                            <dialog class="modal" :class="{ 'modal-open': open }">
                                                <div class="modal-box">
                                                    <h3 class="font-bold text-lg text-emerald-800">Konfirmasi Hapus</h3>
                                                    <p class="py-4 text-gray-600">Hapus data pendiri <strong class="text-emerald-700"><?php echo e($pendiri->nama); ?></strong>?</p>
                                                    <div class="modal-action">
                                                        <button type="button" @click="open = false" class="btn btn-outline btn-sm">Batal</button>
                                                        <button @click="open = false; $el.closest('form').submit()" class="btn btn-error btn-sm">Ya, Hapus</button>
                                                    </div>
                                                </div>
                                            </dialog>
                                        </form>
                                    </div>
                                </div>
                                <div class="px-5 pb-5 pt-3">
                                    <?php if($pendiri->deskripsi): ?>
                                        <div class="bg-emerald-50/70 rounded-lg p-3 border border-emerald-100">
                                            <svg class="w-3 h-3 text-emerald-400 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151C7.546 6.068 5.983 8.789 5.983 11H10v10H0z"/></svg>
                                            <p class="text-xs text-gray-600 italic leading-relaxed">"<?php echo e($pendiri->deskripsi); ?>"</p>
                                        </div>
                                    <?php else: ?>
                                        <div class="bg-gray-50 rounded-lg p-3 border border-gray-100">
                                            <p class="text-xs text-gray-400 italic">Tidak ada kata sambutan</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-span-full text-center py-12 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50">
                                <div class="text-4xl mb-3">👥</div>
                                <p class="font-bold text-emerald-700">Belum Ada Data Pendiri</p>
                                <p class="text-sm text-emerald-500 mt-1">Tambahkan pendiri pertama lewat form di bawah.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <form action="<?php echo e(route('admin.pendiri.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="card bg-base-100 shadow-md border border-emerald-200 mb-10">
                    <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">➕</div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Tambah Pendiri Baru</h3>
                            <p class="text-white/80 text-sm">Lengkapi data berikut untuk menambahkan pendiri atau pengurus baru</p>
                        </div>
                    </div>
                    <div class="card-body space-y-5">
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
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/admin/profil/index.blade.php ENDPATH**/ ?>