<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($news->judul); ?> - <?php echo e($profil?->nama_yayasan ?? 'Baitul Yatim'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans antialiased">

    
    <nav id="navbar" class="navbar bg-base-100/90 backdrop-blur-lg sticky top-0 z-50 shadow-sm transition-all duration-300">
        <div class="navbar-start">
            <a href="/" class="flex items-center gap-3">
                <?php if($profil && $profil->logo): ?>
                    <img src="<?php echo e(asset('storage/' . $profil->logo)); ?>" alt="Logo" class="h-9 w-9 rounded-full object-cover border border-emerald-200 shadow-sm">
                <?php else: ?>
                    <span class="text-2xl">🌿</span>
                <?php endif; ?>
                <span class="text-xl font-extrabold tracking-wide text-emerald-700">
                    <?php echo e($profil?->nama_yayasan ?? 'Baitul Yatim'); ?>

                </span>
            </a>
        </div>

        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal gap-1">
                <li><a href="<?php echo e(url('/')); ?>" class="font-bold text-emerald-700">Beranda</a></li>
                <li class="dropdown dropdown-hover">
                    <a tabindex="0" class="font-bold text-emerald-700">
                        Tentang Kami
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </a>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-xl min-w-[200px] z-[100] border border-emerald-200">
                        <li><a href="<?php echo e(url('/#tentang-kami')); ?>" class="font-bold text-emerald-700">📖 Profil Yayasan</a></li>
                        <li><a href="<?php echo e(url('/#pendiri')); ?>" class="font-bold text-emerald-700">👤 Pengurus</a></li>
                        <li><a href="<?php echo e(url('/#legalitas')); ?>" class="font-bold text-emerald-700">📑 Legalitas & Struktur</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo e(url('/#kampanye')); ?>" class="font-bold text-emerald-700">❤️ Program Donasi</a></li>
                <li><a href="<?php echo e(url('/#program-ota')); ?>" class="font-bold text-emerald-700">🤝 Orang Tua Asuh</a></li>
                <li><a href="<?php echo e(url('/#berita-kegiatan')); ?>" class="font-bold text-emerald-700">📰 Berita</a></li>
            </ul>
        </div>

        <div class="navbar-end gap-2">
            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline btn-success btn-sm font-bold hidden sm:inline-flex">Daftar</a>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-success btn-sm font-bold text-white hidden sm:inline-flex">Masuk</a>
            <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="btn btn-ghost btn-square lg:hidden">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden absolute top-full left-0 right-0 bg-base-100 border-t border-emerald-100 shadow-lg lg:hidden">
            <ul class="menu menu-md p-4">
                <li><a href="<?php echo e(url('/')); ?>" class="font-bold text-emerald-800">🏠 Beranda</a></li>
                <li class="menu-title text-xs"><span>Tentang</span></li>
                <li><a href="<?php echo e(url('/#tentang-kami')); ?>" class="text-emerald-700">📖 Profil Yayasan</a></li>
                <li><a href="<?php echo e(url('/#pendiri')); ?>" class="text-emerald-700">👤 Pengurus</a></li>
                <li><a href="<?php echo e(url('/#legalitas')); ?>" class="text-emerald-700">📑 Legalitas & Struktur</a></li>
                <li class="menu-title text-xs"><span>Program</span></li>
                <li><a href="<?php echo e(url('/#kampanye')); ?>" class="text-emerald-700">❤️ Program Donasi</a></li>
                <li><a href="<?php echo e(url('/#program-ota')); ?>" class="text-emerald-700">🤝 Orang Tua Asuh</a></li>
                <li><a href="<?php echo e(url('/#berita-kegiatan')); ?>" class="text-emerald-700">📰 Berita</a></li>
                <li class="menu-divider"></li>
                <li><a href="<?php echo e(route('register')); ?>" class="font-bold text-emerald-700">📝 Daftar Donatur</a></li>
                <li><a href="<?php echo e(route('login')); ?>" class="font-bold text-emerald-700">🔑 Masuk</a></li>
            </ul>
        </div>
    </nav>

    
    <?php if($news->foto_utama): ?>
    <div class="w-full h-64 sm:h-80 md:h-[450px] overflow-hidden relative">
        <img src="<?php echo e(asset('storage/' . $news->foto_utama)); ?>" alt="<?php echo e($news->judul); ?>" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 px-4 sm:px-8 lg:px-12 pb-8 sm:pb-12 max-w-5xl mx-auto">
            <div class="flex flex-wrap items-center gap-2 mb-3">
                <?php if($news->kategori): ?>
                    <span class="text-xs font-bold uppercase tracking-wider bg-emerald-500 text-white px-3 py-1 rounded-full"><?php echo e($news->kategori); ?></span>
                <?php endif; ?>
                <?php if($news->tanggal_kegiatan): ?>
                    <span class="text-xs text-white/70">📅 <?php echo e($news->tanggal_kegiatan->format('d M Y')); ?></span>
                <?php endif; ?>
            </div>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-white leading-tight max-w-3xl"><?php echo e($news->judul); ?></h1>
        </div>
    </div>
    <?php else: ?>
    <div class="bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-500 py-16 sm:py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-8 lg:px-12">
            <div class="flex flex-wrap items-center gap-2 mb-3">
                <?php if($news->kategori): ?>
                    <span class="text-xs font-bold uppercase tracking-wider bg-white/20 text-white px-3 py-1 rounded-full"><?php echo e($news->kategori); ?></span>
                <?php endif; ?>
                <?php if($news->tanggal_kegiatan): ?>
                    <span class="text-xs text-white/70">📅 <?php echo e($news->tanggal_kegiatan->format('d M Y')); ?></span>
                <?php endif; ?>
            </div>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-white leading-tight max-w-3xl"><?php echo e($news->judul); ?></h1>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 py-8 sm:py-12 lg:py-16">

            <nav class="text-sm text-gray-400 mb-8">
                <a href="<?php echo e(url('/')); ?>" class="hover:text-emerald-600 transition-colors">Beranda</a>
                <span class="mx-2">/</span>
                <a href="<?php echo e(url('/#berita-kegiatan')); ?>" class="hover:text-emerald-600 transition-colors">Berita</a>
                <span class="mx-2">/</span>
                <span class="text-gray-600"><?php echo e(Str::limit($news->judul, 40)); ?></span>
            </nav>

            <div class="lg:grid lg:grid-cols-3 lg:gap-14">
                <article class="lg:col-span-2">
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6 pb-6 border-b border-gray-100">
                        <?php if($news->lokasi): ?>
                            <span class="flex items-center gap-1.5">📍 <?php echo e($news->lokasi); ?></span>
                        <?php endif; ?>
                        <?php if($news->penyelenggara): ?>
                            <span class="flex items-center gap-1.5">👤 <?php echo e($news->penyelenggara); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php if($news->ringkasan): ?>
                        <div class="text-base text-emerald-700 font-medium mb-8 p-5 bg-emerald-50 rounded-xl border-l-4 border-emerald-500 leading-relaxed">
                            <?php echo e($news->ringkasan); ?>

                        </div>
                    <?php endif; ?>

                    <div class="text-gray-700 leading-relaxed text-base space-y-4">
                        <?php echo nl2br(e($news->konten)); ?>

                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <a href="<?php echo e(url('/#berita-kegiatan')); ?>" class="text-gray-500 hover:text-emerald-600 transition-colors text-sm flex items-center gap-1.5 font-medium">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                            Kembali ke Berita
                        </a>
                    </div>
                </article>

                <aside class="mt-10 lg:mt-0">
                    <div class="sticky top-24 space-y-6">
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">Informasi Kegiatan</h3>
                            <ul class="space-y-3 text-sm">
                                <?php if($news->tanggal_kegiatan): ?>
                                <li class="flex items-start gap-3">
                                    <span class="text-base flex-shrink-0 w-5 text-center">📅</span>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase">Tanggal</p>
                                        <p class="text-gray-700"><?php echo e($news->tanggal_kegiatan->format('d F Y')); ?></p>
                                    </div>
                                </li>
                                <?php endif; ?>
                                <?php if($news->lokasi): ?>
                                <li class="flex items-start gap-3">
                                    <span class="text-base flex-shrink-0 w-5 text-center">📍</span>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase">Lokasi</p>
                                        <p class="text-gray-700"><?php echo e($news->lokasi); ?></p>
                                    </div>
                                </li>
                                <?php endif; ?>
                                <?php if($news->penyelenggara): ?>
                                <li class="flex items-start gap-3">
                                    <span class="text-base flex-shrink-0 w-5 text-center">👤</span>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase">Penyelenggara</p>
                                        <p class="text-gray-700"><?php echo e($news->penyelenggara); ?></p>
                                    </div>
                                </li>
                                <?php endif; ?>
                                <?php if($news->kategori): ?>
                                <li class="flex items-start gap-3">
                                    <span class="text-base flex-shrink-0 w-5 text-center">🏷️</span>
                                    <div>
                                        <p class="text-xs text-gray-400 font-semibold uppercase">Kategori</p>
                                        <p class="text-gray-700"><?php echo e($news->kategori); ?></p>
                                    </div>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-xl p-5 text-white">
                            <p class="text-sm font-bold mb-1">💚 Dukung Program Kami</p>
                            <p class="text-xs text-emerald-100 mb-4">Setiap donasi Anda berarti bagi mereka yang membutuhkan.</p>
                            <a href="<?php echo e(url('/#kampanye')); ?>" class="inline-block bg-white text-emerald-700 text-xs font-bold px-4 py-2 rounded-lg hover:bg-emerald-50 transition-colors">Donasi Sekarang</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/news/show.blade.php ENDPATH**/ ?>