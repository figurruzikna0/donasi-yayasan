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
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-4">
                        <div class="avatar">
                            <div class="w-16 h-16 rounded-full ring ring-white/30 ring-offset-2 ring-offset-emerald-700">
                                <?php if($user->avatar): ?>
                                    <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" alt="<?php echo e($user->name); ?>">
                                <?php else: ?>
                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=b3e093&color=5c8148&bold=true&size=64" alt="">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-black">🌿 Selamat Datang, <?php echo e($user->name); ?></h1>
                            <p class="text-emerald-100 text-sm mt-1"><?php echo e($profil->nama_yayasan ?? 'Baitul Yatim'); ?> — Dashboard Donatur</p>
                            <div class="flex flex-wrap gap-3 mt-2 text-xs text-emerald-200">
                                <?php if($user->phone): ?><span>📞 <?php echo e($user->phone); ?></span><?php endif; ?>
                                <?php if($user->email): ?><span>✉️ <?php echo e($user->email); ?></span><?php endif; ?>
                                <?php if($user->address): ?><span class="max-w-xs truncate">📍 <?php echo e($user->address); ?></span><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if($profil?->logo): ?>
                        <img src="<?php echo e(asset('storage/' . $profil->logo)); ?>" class="h-14 w-14 rounded-xl object-cover border-2 border-white/20 hidden sm:block" alt="Logo">
                    <?php endif; ?>
                </div>

                <div class="stats bg-white/10 text-white shadow-none mt-6 flex-wrap">
                    <div class="stat">
                        <div class="stat-title text-emerald-200">Total Donasi Saya</div>
                        <div class="stat-value text-white">Rp <?php echo e(number_format($totalDonated, 0, ',', '.')); ?></div>
                    </div>
                    <div class="stat">
                        <div class="stat-title text-emerald-200">Sponsorship Aktif</div>
                        <div class="stat-value text-white"><?php echo e($activeSponsorships); ?></div>
                    </div>
                    <div class="stat">
                        <div class="stat-title text-emerald-200">Transaksi Donasi</div>
                        <div class="stat-value text-white"><?php echo e($donations->count()); ?></div>
                    </div>
                    <div class="stat">
                        <div class="stat-title text-emerald-200">Rincian Transaksi</div>
                        <div class="stat-value text-white text-lg">
                            <a href="<?php echo e(route('dashboard.rekap')); ?>" class="btn btn-sm bg-white text-emerald-700 border-0 hover:bg-emerald-100 font-bold">📋 Lihat Rekap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="#kampanye-donasi" class="card bg-base-100 shadow-md border border-emerald-200 hover:shadow-lg transition-all">
                    <div class="card-body flex-row items-center gap-4 p-5">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">💰</div>
                        <div>
                            <h3 class="font-bold text-emerald-700">Donasi Sekarang</h3>
                            <p class="text-sm text-emerald-500">Salurkan donasi ke program pilihan</p>
                        </div>
                    </div>
                </a>
                <a href="#program-ota" class="card bg-base-100 shadow-md border border-emerald-200 hover:shadow-lg transition-all">
                    <div class="card-body flex-row items-center gap-4 p-5">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">🤝</div>
                        <div>
                            <h3 class="font-bold text-emerald-700">Jadi Orang Tua Asuh</h3>
                            <p class="text-sm text-emerald-500">Sponsorship anak asuh yatim</p>
                        </div>
                    </div>
                </a>
                <a href="<?php echo e(route('profile.edit')); ?>" class="card bg-base-100 shadow-md border border-emerald-200 hover:shadow-lg transition-all">
                    <div class="card-body flex-row items-center gap-4 p-5">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">⚙️</div>
                        <div>
                            <h3 class="font-bold text-emerald-700">Edit Profil</h3>
                            <p class="text-sm text-emerald-500">Ubah data diri & password</p>
                        </div>
                    </div>
                </a>
            </div>

            
            <div id="profil-yayasan" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>🏛️ Profil Yayasan</span>
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-4">
                            <?php if($profil): ?>
                                <div>
                                    <h3 class="font-bold text-emerald-700 text-lg"><?php echo e($profil->nama_yayasan); ?></h3>
                                    <p class="text-sm text-emerald-500 mt-1"><?php echo e($profil->alamat); ?></p>
                                </div>
                                <div class="flex flex-wrap gap-4 text-sm">
                                    <?php if($profil->no_telp): ?><span class="badge badge-ghost">📞 <?php echo e($profil->no_telp); ?></span><?php endif; ?>
                                    <?php if($profil->email): ?><span class="badge badge-ghost">✉️ <?php echo e($profil->email); ?></span><?php endif; ?>
                                </div>
                                <?php if($profil->sejarah_yayasan): ?>
                                    <div>
                                        <h4 class="font-bold text-emerald-600 text-sm uppercase tracking-wider mb-1">Sejarah</h4>
                                        <p class="text-sm text-base-content/70"><?php echo e(Str::limit($profil->sejarah_yayasan, 300)); ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <?php if($profil->visi): ?>
                                        <div class="bg-emerald-50 rounded-lg p-4 border border-emerald-100">
                                            <h4 class="font-bold text-emerald-700 text-sm mb-1">Visi</h4>
                                            <p class="text-sm text-base-content/70"><?php echo e($profil->visi); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($profil->misi): ?>
                                        <div class="bg-emerald-50 rounded-lg p-4 border border-emerald-100">
                                            <h4 class="font-bold text-emerald-700 text-sm mb-1">Misi</h4>
                                            <p class="text-sm text-base-content/70"><?php echo e($profil->misi); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-base-content/60 text-sm">Data profil yayasan belum tersedia.</p>
                            <?php endif; ?>
                        </div>
                        <?php if($profil?->logo): ?>
                            <div class="flex items-center justify-center">
                                <img src="<?php echo e(asset('storage/' . $profil->logo)); ?>" class="max-h-40 rounded-xl shadow" alt="Logo Yayasan">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div id="berita-kegiatan" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>📰 Berita &amp; Kegiatan</span>
                    </h2>

                    <?php if($newsList->isNotEmpty()): ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php $__currentLoopData = $newsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('news.show', $news->slug)); ?>" class="card bg-base-100 border border-emerald-100 shadow-sm hover:shadow-lg transition-all group">
                                    <?php if($news->foto_utama): ?>
                                        <figure class="h-40 overflow-hidden">
                                            <img src="<?php echo e(asset('storage/' . $news->foto_utama)); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="<?php echo e($news->judul); ?>">
                                        </figure>
                                    <?php endif; ?>
                                    <div class="card-body p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <?php if($news->kategori): ?><span class="badge badge-success badge-sm"><?php echo e($news->kategori); ?></span><?php endif; ?>
                                            <?php if($news->tanggal_kegiatan): ?><span class="text-xs text-emerald-400"><?php echo e($news->tanggal_kegiatan->format('d M Y')); ?></span><?php endif; ?>
                                        </div>
                                        <h3 class="font-bold text-sm text-emerald-700 group-hover:text-emerald-500 transition-colors"><?php echo e($news->judul); ?></h3>
                                        <?php if($news->ringkasan): ?><p class="text-xs text-base-content/60 mt-1"><?php echo e(Str::limit($news->ringkasan, 100)); ?></p><?php endif; ?>
                                        <?php if($news->lokasi): ?><p class="text-xs text-emerald-400 mt-2">📍 <?php echo e($news->lokasi); ?></p><?php endif; ?>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-base-content/60 text-sm text-center py-6">Belum ada berita kegiatan.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div id="legalitas-struktur" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>📜 Legalitas &amp; Struktur Organisasi</span>
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <?php if($profil): ?>
                            <div class="space-y-3">
                                <h3 class="font-bold text-emerald-600 text-sm uppercase tracking-wider">Dokumen Legalitas</h3>
                                <?php if($profil->legalitas): ?>
                                    <p class="text-sm text-base-content/70"><?php echo e($profil->legalitas); ?></p>
                                <?php endif; ?>
                                <?php if($profil->foto_legalitas): ?>
                                    <a href="<?php echo e(asset('storage/' . $profil->foto_legalitas)); ?>" target="_blank" class="block">
                                        <img src="<?php echo e(asset('storage/' . $profil->foto_legalitas)); ?>" class="max-h-48 rounded-lg border border-emerald-200 shadow-sm" alt="Dokumen Legalitas">
                                    </a>
                                <?php else: ?>
                                    <p class="text-sm text-base-content/60 italic">Dokumen legalitas belum diupload.</p>
                                <?php endif; ?>
                            </div>
                            <div class="space-y-3">
                                <h3 class="font-bold text-emerald-600 text-sm uppercase tracking-wider">Struktur Organisasi</h3>
                                <?php if($profil->foto_struktur): ?>
                                    <a href="<?php echo e(asset('storage/' . $profil->foto_struktur)); ?>" target="_blank" class="block">
                                        <img src="<?php echo e(asset('storage/' . $profil->foto_struktur)); ?>" class="max-h-48 rounded-lg border border-emerald-200 shadow-sm" alt="Struktur Organisasi">
                                    </a>
                                <?php else: ?>
                                    <p class="text-sm text-base-content/60 italic">Bagan struktur belum diupload.</p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div id="pengurus" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>👥 Pengurus Yayasan</span>
                    </h2>

                    <?php if($pendiris->isNotEmpty()): ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php $__currentLoopData = $pendiris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card bg-base-100 border border-emerald-100 shadow-sm">
                                    <div class="card-body items-center text-center p-5">
                                        <div class="avatar">
                                            <div class="w-20 rounded-full ring ring-emerald-200 ring-offset-2">
                                                <?php if($p->foto): ?>
                                                    <img src="<?php echo e(asset('storage/' . $p->foto)); ?>" alt="<?php echo e($p->nama); ?>">
                                                <?php else: ?>
                                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($p->nama)); ?>&background=b3e093&color=5c8148&bold=true" alt="">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <h3 class="font-bold text-emerald-700 mt-3"><?php echo e($p->nama); ?></h3>
                                        <span class="badge badge-success badge-sm"><?php echo e($p->jabatan); ?></span>
                                        <?php if($p->deskripsi): ?>
                                            <p class="text-xs text-base-content/60 mt-2"><?php echo e(Str::limit($p->deskripsi, 100)); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-base-content/60 text-sm text-center py-6">Data pengurus belum tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div id="kampanye-donasi" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>💰 Kampanye Donasi &amp; Transaksi Saya</span>
                    </h2>

                    
                    <?php if($campaigns->isNotEmpty()): ?>
                        <h3 class="font-bold text-emerald-600 text-sm uppercase tracking-wider mb-3">Program Donasi Aktif</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $camp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card bg-base-100 border border-emerald-100 shadow-sm">
                                    <?php if($camp->image): ?>
                                        <figure class="h-36 overflow-hidden">
                                            <img src="<?php echo e(asset('storage/' . $camp->image)); ?>" class="w-full h-full object-cover" alt="<?php echo e($camp->title); ?>">
                                        </figure>
                                    <?php endif; ?>
                                    <div class="card-body p-4">
                                        <h3 class="font-bold text-sm text-emerald-700"><?php echo e($camp->title); ?></h3>
                                        <p class="text-xs text-base-content/60 mt-1"><?php echo e(Str::limit($camp->description, 80)); ?></p>
                                        <div class="mt-3">
                                            <div class="flex justify-between text-xs text-emerald-500 mb-1">
                                                <span>Terkumpul</span>
                                                <span class="font-bold">Rp <?php echo e(number_format($camp->collected_amount, 0, ',', '.')); ?> / Rp <?php echo e(number_format($camp->target_amount, 0, ',', '.')); ?></span>
                                            </div>
                                            <progress class="progress progress-success w-full" value="<?php echo e($camp->collected_amount); ?>" max="<?php echo e($camp->target_amount); ?>"></progress>
                                        </div>
                                        <a href="<?php echo e(route('donations.create', $camp->id)); ?>" class="btn btn-success btn-sm text-white font-bold mt-3 w-full">Donasi Sekarang</a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-6 mb-4 bg-emerald-50 rounded-lg border border-emerald-100">
                            <p class="font-semibold text-emerald-700">Belum ada program donasi aktif</p>
                            <p class="text-sm text-emerald-500 mt-1">Nantikan program donasi terbaru dari yayasan.</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            
            <div id="program-ota" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>🤝 Program Orang Tua Asuh</span>
                    </h2>

                    
                    <div class="stats shadow mb-6 w-full">
                        <div class="stat">
                            <div class="stat-title">Total Anak Asuh</div>
                            <div class="stat-value text-emerald-700"><?php echo e($totalFoster); ?></div>
                        </div>
                        <div class="stat">
                            <div class="stat-title">Tersedia</div>
                            <div class="stat-value text-emerald-700"><?php echo e($tersediaFoster); ?></div>
                        </div>
                        <div class="stat">
                            <div class="stat-title">Anda Asuh</div>
                            <div class="stat-value text-emerald-700"><?php echo e($diasuhFoster); ?></div>
                        </div>
                    </div>

                    
                    <?php if($fosterChildren->isNotEmpty()): ?>
                        <?php
                            $chunks = $fosterChildren->chunk(3);
                        ?>
                        <div class="relative mb-4" x-data="{ slide: 0, total: <?php echo e($chunks->count()); ?> }">
                            <div class="overflow-hidden">
                                <?php $__currentLoopData = $chunks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div x-show="slide === <?php echo e($i); ?>" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="card bg-base-100 border border-emerald-100 shadow-sm">
                                                <div class="card-body p-4">
                                                    <div class="flex items-center gap-3 mb-3">
                                                        <div class="avatar">
                                                            <div class="w-14 rounded-full ring ring-emerald-100">
                                                                <?php if($child->photo): ?>
                                                                    <img src="<?php echo e(asset('storage/' . $child->photo)); ?>" alt="<?php echo e($child->name); ?>">
                                                                <?php else: ?>
                                                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($child->name)); ?>&background=b3e093&color=5c8148&bold=true" alt="">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h3 class="font-bold text-emerald-700"><?php echo e($child->name); ?></h3>
                                                            <div class="flex gap-1 mt-1">
                                                                <span class="badge badge-ghost badge-xs"><?php echo e($child->age); ?> Thn</span>
                                                                <?php if($child->jenis_kelamin): ?>
                                                                    <span class="badge badge-ghost badge-xs"><?php echo e($child->jenis_kelamin); ?></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if($child->description): ?>
                                                        <p class="text-xs text-base-content/60 mb-3"><?php echo e(Str::limit($child->description, 100)); ?></p>
                                                    <?php endif; ?>
                                                    <?php if($child->status == 'Tersedia'): ?>
                                                        <a href="<?php echo e(route('sponsor.form', $child->id)); ?>" class="btn btn-success btn-sm text-white font-bold w-full">🤝 Asuh Sekarang</a>
                                                    <?php else: ?>
                                                        <span class="btn btn-success btn-sm text-white font-bold w-full opacity-70">✓ Anak Asuh Anda</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="flex items-center justify-center gap-4 mt-5">
                                <button @click="slide = slide > 0 ? slide - 1 : total - 1" class="btn btn-circle btn-sm btn-success text-white">‹</button>
                                <template x-for="i in total" :key="i">
                                    <button @click="slide = i - 1" class="w-2.5 h-2.5 rounded-full transition-all duration-200" :class="slide === i - 1 ? 'bg-emerald-600 scale-125' : 'bg-emerald-200 hover:bg-emerald-400'" :aria-label="'Halaman ' + i"></button>
                                </template>
                                <button @click="slide = slide < total - 1 ? slide + 1 : 0" class="btn btn-circle btn-sm btn-success text-white">›</button>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8 bg-emerald-50 rounded-lg border border-emerald-100 mb-6">
                            <p class="font-semibold text-emerald-700">Belum ada data anak asuh</p>
                        </div>
                    <?php endif; ?>

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
<?php endif; ?><?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/dashboard.blade.php ENDPATH**/ ?>