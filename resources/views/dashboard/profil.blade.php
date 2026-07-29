<x-app-layout>
    {{-- HERO --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-slate-50 via-white to-emerald-50 border-b border-slate-200">
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-72 h-72 bg-emerald-200/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-10 w-96 h-96 bg-emerald-300/10 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 relative">
            <div class="flex flex-col sm:flex-row items-center sm:items-end gap-5 text-center sm:text-left">
                @if($profil?->logo)
                    <div class="w-20 h-20 rounded-2xl bg-white backdrop-blur-sm p-1.5 ring-1 ring-slate-200 shadow-xl shrink-0">
                        <img src="{{ asset('storage/' . $profil->logo) . '?v=' . now()->timestamp }}" class="w-full h-full object-cover rounded-xl" alt="Logo">
                    </div>
                @else
                    <div class="w-20 h-20 rounded-2xl bg-emerald-50 ring-1 ring-emerald-200 flex items-center justify-center shrink-0 shadow-xl">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/></svg>
                    </div>
                @endif
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 border border-emerald-200 text-emerald-700 text-xs font-medium">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Info Lembaga
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $profil?->nama_yayasan ?? 'Yayasan Baitul Yatim Sukabumi' }}</h1>
                    <p class="text-slate-500 text-sm">Bersama Membangun Generasi Qur'ani Yang Mandiri & Berdaya Saing</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-3 relative z-10 pb-12 space-y-8">

        {{-- SEJARAH --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 lg:px-8 py-4 sm:py-5">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-white/15 flex items-center justify-center backdrop-blur-sm shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </span>
                    <div>
                        <h2 class="text-sm font-bold text-white">Sejarah & Rekam Jejak</h2>
                        <p class="text-emerald-200/70 text-xs">Perjalanan panjang penuh kebermanfaatan</p>
                    </div>
                </div>
            </div>
            <div class="px-6 lg:px-8 py-6 sm:py-8">
                <div class="flex gap-5">
                    <div class="hidden sm:flex flex-col items-center shrink-0">
                        <div class="w-3 h-3 rounded-full bg-emerald-500 ring-4 ring-emerald-100"></div>
                        <div class="w-0.5 flex-1 bg-gradient-to-b from-emerald-200 to-emerald-50"></div>
                    </div>
                    <div>
                        <p class="text-slate-600 leading-[1.9] whitespace-pre-line text-sm sm:text-base">{{ $profil?->sejarah_yayasan ?? 'Informasi sejarah belum diisi.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- VISI & MISI --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- VISI --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden group hover:shadow-md transition-shadow">
                <div class="h-2 bg-gradient-to-r from-emerald-500 to-emerald-400"></div>
                <div class="p-6 lg:p-7">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </span>
                        <div>
                            <h3 class="font-bold text-slate-800">Visi</h3>
                            <p class="text-xs text-slate-400">Tujuan utama yayasan</p>
                        </div>
                    </div>
                    <div class="pl-3 border-l-2 border-emerald-200">
                        <p class="text-sm text-slate-600 leading-relaxed italic">"{{ $profil?->visi ?? 'Belum diatur' }}"</p>
                    </div>
                </div>
            </div>
            {{-- MISI --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden group hover:shadow-md transition-shadow">
                <div class="h-2 bg-gradient-to-r from-emerald-600 to-emerald-500"></div>
                <div class="p-6 lg:p-7">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg>
                            </span>
                        <div>
                            <h3 class="font-bold text-slate-800">Misi</h3>
                            <p class="text-xs text-slate-400">Langkah nyata yayasan</p>
                        </div>
                    </div>
                    <ul class="text-sm text-slate-600 space-y-2.5">
                        @php $misiList = $profil?->misi ? explode("\n", $profil->misi) : []; @endphp
                        @foreach($misiList as $m)
                            <li class="flex items-start gap-3">
                                <span class="w-5 h-5 rounded-full bg-emerald-50 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg>
                                </span>
                                <span class="leading-relaxed">{{ ltrim($m, '• ') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- KONTAK --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 lg:px-8 py-4 sm:py-5">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-white/15 flex items-center justify-center backdrop-blur-sm shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                    </span>
                    <div>
                        <h2 class="text-sm font-bold text-white">Hubungi Kami</h2>
                        <p class="text-emerald-200/70 text-xs">Informasi kontak yayasan</p>
                    </div>
                </div>
            </div>
            <div class="p-6 lg:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <a href="https://www.google.com/maps/search/{{ urlencode($profil?->alamat ?? '') }}" target="_blank" class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 hover:bg-emerald-50 transition-colors group">
                        <span class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 text-base group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                        </span>
                        <div class="min-w-0">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Alamat</p>
                            <p class="text-sm text-slate-700 mt-0.5 leading-relaxed break-words">{{ $profil?->alamat ?? 'Alamat belum diatur' }}</p>
                        </div>
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil?->no_telp ?? '') }}" target="_blank" class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 hover:bg-emerald-50 transition-colors group">
                        <span class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 text-base group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/></svg>
                                        </span>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Telepon / WA</p>
                            <p class="text-sm text-slate-700 mt-0.5">{{ $profil?->no_telp ?? '-' }}</p>
                        </div>
                    </a>
                    <a href="mailto:{{ $profil?->email ?? '' }}" class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 hover:bg-emerald-50 transition-colors group">
                        <span class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 text-base group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                        </span>
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Email</p>
                            <p class="text-sm text-slate-700 mt-0.5">{{ $profil?->email ?? '-' }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
