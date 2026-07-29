<x-app-layout>
    <div class="bg-base-200 min-h-0">

        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-500 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.1),transparent_60%)]"></div>
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-center text-xl shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-black">Detail Program Donasi</h1>
                            <p class="text-emerald-100/70 text-sm mt-0.5">Informasi lengkap program donasi yayasan</p>
                        </div>
                    </div>
                    <a href="{{ url('/') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold rounded-xl backdrop-blur-sm bg-white/5">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

                @if($campaign->image)
                    <div class="bg-slate-50 p-4 sm:p-6 border-b border-slate-100 flex justify-center">
                        <div class="relative group cursor-pointer" onclick="window.open('{{ asset('storage/' . $campaign->image) }}', '_blank')">
                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="w-full max-w-lg h-auto max-h-[400px] object-contain rounded-xl shadow-sm group-hover:opacity-90 transition-opacity mx-auto">
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="bg-black/50 text-white text-xs font-bold px-3 py-1.5 rounded-full backdrop-blur-sm">Klik perbesar</span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="p-6 sm:p-8 lg:p-10">

                    <div class="flex items-start justify-between flex-wrap gap-4 mb-6">
                        <div>
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold mb-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Program Donasi
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight">{{ $campaign->title }}</h2>
                        </div>
                    </div>

                    <div class="bg-emerald-50 rounded-xl p-5 sm:p-6 mb-8">
                        <div class="flex justify-between items-end mb-2">
                            <div>
                                <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Terkumpul</p>
                                <p class="text-2xl font-black text-emerald-800">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Target</p>
                                <p class="text-lg font-bold text-emerald-700">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="w-full h-3 bg-white rounded-full overflow-hidden mt-3 border border-emerald-200">
                            <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full transition-all" style="width: {{ $campaign->target_amount > 0 ? min(($campaign->collected_amount / $campaign->target_amount) * 100, 100) : 0 }}%"></div>
                        </div>
                        <p class="text-xs text-emerald-600/60 mt-2 font-medium">
                            {{ $campaign->target_amount > 0 ? number_format(($campaign->collected_amount / $campaign->target_amount) * 100, 1) : 0 }}% dari target tercapai
                        </p>
                    </div>

                    @if($campaign->description)
                        <div class="mb-8">
                            <h3 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                Deskripsi Program
                            </h3>
                            <div class="bg-slate-50 rounded-xl p-5 border border-slate-200 text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                                {{ $campaign->description }}
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-slate-200">
                        @auth
                            <a href="{{ route('donations.create', $campaign->id) }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 rounded-xl font-bold flex-1 shadow-lg shadow-emerald-200 py-3 h-auto text-base gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                                Donasi Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 rounded-xl font-bold flex-1 shadow-lg shadow-emerald-200 py-3 h-auto text-base gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                                Login untuk Donasi
                            </a>
                        @endauth
                        <a href="{{ url('/') }}" class="btn btn-outline border-slate-300 text-slate-600 hover:bg-slate-100 rounded-xl font-bold">
                            ← Kembali
                        </a>
                    </div>

                </div>
            </div>

            <div class="text-center mt-6 text-xs text-slate-400">
                <p><svg class="w-4 h-4 inline-block -mt-0.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0112 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg> Setiap rupiah donasi Anda akan disalurkan untuk program kebaikan Yayasan Baitul Yatim Sukabumi</p>
            </div>
        </div>
    </div>
</x-app-layout>
