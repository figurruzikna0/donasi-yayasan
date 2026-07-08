<footer class="bg-brand-950">
    <div class="max-w-7xl mx-auto px-4 py-12">

        
        <div class="flex items-center gap-3 mb-10">
            <?php if($profil && $profil->logo): ?>
                <img src="<?php echo e(asset('storage/' . $profil->logo) . '?v=' . now()->timestamp); ?>" class="w-10 h-10 rounded-lg object-cover flex-shrink-0 ring-2 ring-brand-800" alt="Logo">
            <?php else: ?>
                <span class="w-10 h-10 rounded-lg bg-brand-900 flex items-center justify-center flex-shrink-0 ring-2 ring-brand-800 text-lg">🌿</span>
            <?php endif; ?>
            <div>
                <p class="text-base font-bold text-brand-100"><?php echo e($profil?->nama_yayasan ?? 'Yayasan Baitul Yatim Sukabumi'); ?></p>
                <p class="text-xs text-brand-300">Lembaga Sosial Amanah</p>
            </div>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-12 gap-y-10">

            
            <div class="space-y-6">
                <div>
                    <p class="text-xs font-semibold text-brand-300 uppercase tracking-wider mb-3">📑 Menu</p>
                    <ul class="space-y-3">
                        <li><a href="<?php echo e(route('profil')); ?>" class="text-xs text-brand-400 hover:text-brand-200 transition-colors">📖 Tentang Kami</a></li>
                        <li><a href="<?php echo e(url('/#kampanye')); ?>" class="text-xs text-brand-400 hover:text-brand-200 transition-colors">❤️ Program Donasi</a></li>
                        <li><a href="<?php echo e(url('/#program-ota')); ?>" class="text-xs text-brand-400 hover:text-brand-200 transition-colors">🤝 Orang Tua Asuh</a></li>
                        <li><a href="<?php echo e(url('/#berita-kegiatan')); ?>" class="text-xs text-brand-400 hover:text-brand-200 transition-colors">📰 Berita</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-xs font-semibold text-brand-300 uppercase tracking-wider mb-3">📞 Kontak</p>
                    <ul class="space-y-3">
                        <li><a href="tel:<?php echo e($profil?->no_telp); ?>" class="text-xs text-brand-400 hover:text-brand-200 transition-colors">📞 <?php echo e($profil?->no_telp ?? '0812-3456-7890'); ?></a></li>
                        <li><a href="mailto:<?php echo e($profil?->email); ?>" class="text-xs text-brand-400 hover:text-brand-200 transition-colors">✉️ <?php echo e($profil?->email ?? 'info@baitulyatim.or.id'); ?></a></li>
                    </ul>
                </div>
            </div>

            
            <div>
                <p class="text-xs font-semibold text-brand-300 uppercase tracking-wider mb-3">📋 Program</p>
                <ul class="space-y-3">
                    <li class="text-xs text-brand-400">📦 Santunan Bulanan</li>
                    <li class="text-xs text-brand-400">🎓 Beasiswa Yatim</li>
                    <li class="text-xs text-brand-400">👨‍👩‍👧‍👦 Orang Tua Asuh</li>
                    <li class="text-xs text-brand-400">🔨 Renovasi Rumah</li>
                </ul>
            </div>

            
            <div>
                <p class="text-xs font-semibold text-brand-300 uppercase tracking-wider mb-3">🗺️ Buka Google Maps</p>
                <div class="rounded-lg overflow-hidden border border-brand-800 mb-4">
                    <iframe src="https://www.google.com/maps?q=Kp.+Babakan+Cimenteng,+Gunung+Guruh,+Sukabumi&output=embed"
                            width="100%" height="160" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="block w-full"></iframe>
                </div>
                <p class="text-xs font-semibold text-brand-300 uppercase tracking-wider mb-3">Lokasi & Keterangan</p>
                <div class="bg-brand-900/40 rounded-lg p-3 mb-3 border border-brand-800/50">
                    <p class="text-xs text-brand-300 leading-relaxed"><?php echo e($profil?->alamat ?? 'Kp. Babakan Cimenteng Rt 37/07, Ds. Gunung Guruh, Kec. Gunung Guruh - Sukabumi'); ?></p>
                </div>
                <a href="https://maps.app.goo.gl/FQatKLZU39dm6zNr7?g_st=aw" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-xs font-semibold text-brand-300 bg-brand-900/60 hover:bg-brand-800/60 border border-brand-800/50 px-3.5 py-2 rounded-lg transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Buka Google Maps
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>
        </div>

        
        <div class="mt-10 pt-5 border-t border-brand-900 text-center">
            <p class="text-xs text-brand-500">&copy; <?php echo e(date('Y')); ?> <?php echo e($profil?->nama_yayasan ?? 'Yayasan Baitul Yatim Sukabumi'); ?>. Dikelola dengan penuh amanah & transparansi.</p>
        </div>
    </div>
</footer>
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/partials/footer.blade.php ENDPATH**/ ?>