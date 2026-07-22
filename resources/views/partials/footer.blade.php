{{-- PARTIALS_FOOTER: footer halaman publik -- logo yayasan, navigasi, program, kontak, lokasi (Google Maps), dan copyright --}}
<footer class="relative overflow-hidden" style="background-color:#091f19">
    {{-- Garis dekoratif gradasi di tepi atas footer --}}
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-brand-500/40 to-transparent"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">

        {{-- Bagian atas: logo & nama yayasan, data dari $profil --}}
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 pb-10 border-b border-brand-800/60">
            <div class="flex items-center gap-4">
                <div class="relative">
                    @if($profil && $profil->logo)
                        <img src="{{ asset('storage/' . $profil->logo) . '?v=' . now()->timestamp }}"
                             class="w-12 h-12 rounded-xl object-cover ring-2 ring-brand-600/30" alt="Logo">
                    @else
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-600 to-brand-800 flex items-center justify-center ring-2 ring-brand-600/30">
                            <span class="text-brand-200 font-black text-lg">BY</span>
                        </div>
                    @endif
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-brand-400 rounded-full ring-2 ring-brand-950"></span>
                </div>
                <div>
                    <p class="text-base font-bold text-brand-100">{{ $profil?->nama_yayasan ?? 'Yayasan Baitul Yatim Sukabumi' }}</p>
                    <p class="text-xs text-brand-400 font-medium tracking-wide">Lembaga Sosial Amanah & Terpercaya</p>
                </div>
            </div>
        </div>

        {{-- Grid utama 4 kolom: Navigasi, Program, Kontak, Lokasi --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 py-12">

            {{-- Kolom 1 - Navigasi: tautan ke profil, donasi, OTA, berita, legalitas --}}
            <div>
                <p class="text-xs font-bold text-brand-300 uppercase tracking-widest mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                    Navigasi
                </p>
                <ul class="space-y-3.5">
                    <li>
                        <a href="{{ route('profil') }}"
                           class="group inline-flex items-center gap-2 text-sm text-brand-400 hover:text-brand-200 transition-all duration-200">
                            <svg class="w-4 h-4 text-brand-500 group-hover:text-brand-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                            Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/#kampanye') }}"
                           class="group inline-flex items-center gap-2 text-sm text-brand-400 hover:text-brand-200 transition-all duration-200">
                            <svg class="w-4 h-4 text-brand-500 group-hover:text-brand-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                            Program Donasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/#program-ota') }}"
                           class="group inline-flex items-center gap-2 text-sm text-brand-400 hover:text-brand-200 transition-all duration-200">
                            <svg class="w-4 h-4 text-brand-500 group-hover:text-brand-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                            Orang Tua Asuh
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/#berita-kegiatan') }}"
                           class="group inline-flex items-center gap-2 text-sm text-brand-400 hover:text-brand-200 transition-all duration-200">
                            <svg class="w-4 h-4 text-brand-500 group-hover:text-brand-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                            Berita & Kegiatan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('legalitas') }}"
                           class="group inline-flex items-center gap-2 text-sm text-brand-400 hover:text-brand-200 transition-all duration-200">
                            <svg class="w-4 h-4 text-brand-500 group-hover:text-brand-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            Legalitas
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Kolom 2 - Program: daftar program yayasan (informasi statis) --}}
            <div>
                <p class="text-xs font-bold text-brand-300 uppercase tracking-widest mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                    Program Kami
                </p>
                <ul class="space-y-3.5">
                    <li class="group flex items-center gap-3 text-sm text-brand-400">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-all duration-200" style="background-color:rgba(45,125,98,0.15);color:#4a9a7b">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
                        </span>
                        <span>Santunan Bulanan</span>
                    </li>
                    <li class="group flex items-center gap-3 text-sm text-brand-400">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-all duration-200" style="background-color:rgba(45,125,98,0.15);color:#4a9a7b">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg>
                        </span>
                        <span>Beasiswa Yatim</span>
                    </li>
                    <li class="group flex items-center gap-3 text-sm text-brand-400">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-all duration-200" style="background-color:rgba(45,125,98,0.15);color:#4a9a7b">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                        </span>
                        <span>Orang Tua Asuh</span>
                    </li>
                    <li class="group flex items-center gap-3 text-sm text-brand-400">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-all duration-200" style="background-color:rgba(45,125,98,0.15);color:#4a9a7b">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"/></svg>
                        </span>
                        <span>Renovasi Rumah</span>
                    </li>
                </ul>
            </div>

            {{-- Kolom 3 - Kontak: telepon, email, alamat dari $profil --}}
            <div>
                <p class="text-xs font-bold text-brand-300 uppercase tracking-widest mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                    Kontak
                </p>
                <ul class="space-y-4">
                    <li>
                        <a href="tel:{{ $profil?->no_telp }}" class="group flex items-center gap-3 text-sm text-brand-400 hover:text-brand-200 transition-all duration-200">
                            <span class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0 transition-all" style="background-color:rgba(45,125,98,0.15);color:#4a9a7b">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-brand-500 font-medium">Telepon</p>
                                <p class="text-sm text-brand-300 group-hover:text-brand-200 transition-colors">{{ $profil?->no_telp ?? '0812-3456-7890' }}</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $profil?->email }}" class="group flex items-center gap-3 text-sm text-brand-400 hover:text-brand-200 transition-all duration-200">
                            <span class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0 transition-all" style="background-color:rgba(45,125,98,0.15);color:#4a9a7b">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-brand-500 font-medium">Email</p>
                                <p class="text-sm text-brand-300 group-hover:text-brand-200 transition-colors">{{ $profil?->email ?? 'info@baitulyatim.or.id' }}</p>
                            </div>
                        </a>
                    </li>
                    <li class="flex items-start gap-3 text-sm text-brand-400">
                        <span class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" style="background-color:rgba(45,125,98,0.15);color:#4a9a7b">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        </span>
                        <div>
                            <p class="text-xs text-brand-500 font-medium">Alamat</p>
                            <p class="text-sm text-brand-300 leading-relaxed">{{ $profil?->alamat ?? 'Kp. Babakan Cimenteng Rt 37/07, Ds. Gunung Guruh, Kec. Gunung Guruh - Sukabumi' }}</p>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- Kolom 4 - Lokasi: embed Google Maps iframe + tombol buka Google Maps --}}
            <div>
                <p class="text-xs font-bold text-brand-300 uppercase tracking-widest mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span>
                    Lokasi
                </p>
                <div class="rounded-xl overflow-hidden border border-brand-800/60 mb-4">
                    <iframe src="https://www.google.com/maps?q=Kp.+Babakan+Cimenteng,+Gunung+Guruh,+Sukabumi&output=embed"
                            width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="block w-full"></iframe>
                </div>
                <a href="https://maps.app.goo.gl/FQatKLZU39dm6zNr7?g_st=aw" target="_blank" rel="noopener noreferrer"
                   class="group inline-flex items-center justify-center gap-2 w-full text-xs font-bold px-4 py-2.5 rounded-xl transition-all duration-200 border"
                   style="border-color:rgba(45,125,98,0.25);color:#75b89b"
                   onmouseover="this.style.borderColor='#2d7d62';this.style.backgroundColor='rgba(45,125,98,0.1)';this.style.color='#d4e9df'"
                   onmouseout="this.style.borderColor='rgba(45,125,98,0.25)';this.style.backgroundColor='transparent';this.style.color='#75b89b'">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z"/></svg>
                    Buka Google Maps
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>
        </div>

        {{-- Baris bawah: copyright otomatis & nama yayasan dari $profil --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8 border-t border-brand-800/60">
            <p class="text-xs text-brand-500 text-center sm:text-left">&copy; {{ date('Y') }} {{ $profil?->nama_yayasan ?? 'Yayasan Baitul Yatim Sukabumi' }}. Dikelola dengan penuh amanah &amp; transparansi.</p>
        </div>
    </div>
</footer>
