<x-app-layout>

    <div class="flex bg-base-200 min-h-0">

        {{-- ══ SIDEBAR ══ --}}
        <aside class="w-60 shrink-0 bg-emerald-700 flex flex-col sticky top-0 h-dvh overflow-y-auto">
            <div class="px-8 py-9 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    @if($profil && $profil->logo)
                        <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo" class="h-9 w-9 rounded-lg object-cover ring-2 ring-emerald-400/50">
                    @else
                        <div class="h-9 w-9 rounded-lg bg-emerald-500 flex items-center justify-center text-white font-black text-base">BY</div>
                    @endif
                    <div>
                        <div class="text-base font-black text-white tracking-tight leading-tight">Baitul<span class="text-emerald-300">Yatim</span></div>
                        <div class="text-[0.65rem] text-white/45 font-semibold uppercase tracking-widest mt-0.5">Panel Administrasi</div>
                    </div>
                </a>
            </div>

            <div class="px-4 pt-6 pb-1">
                <div class="text-[0.62rem] font-extrabold uppercase tracking-widest text-white/38 px-2 mb-1.5">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white transition-all duration-150 relative mb-0.5 bg-white/13 before:absolute before:left-0 before:top-[22%] before:bottom-[22%] before:w-[3px] before:bg-emerald-300 before:rounded-r-sm">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>
            </div>

            <div class="px-4 pt-3 pb-1">
                <div class="text-[0.62rem] font-extrabold uppercase tracking-widest text-white/38 px-2 mb-1">Akun</div>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Edit Profil
                </a>
            </div>

            <div class="px-4 pt-5 pb-1">
                <div class="text-[0.62rem] font-extrabold uppercase tracking-widest text-white/38 px-2 mb-1">Konten</div>

                <a href="{{ route('admin.profil.index') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Profil Yayasan
                </a>

                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"/></svg>
                    Berita Kegiatan
                </a>

                <a href="{{ route('admin.campaigns.index') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Kelola Kampanye
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Kelola User
                </a>
            </div>

            {{-- ✅ Section Program OTA — lengkap dengan 4 menu --}}
            <div class="px-4 pt-5 pb-1">
                <div class="text-[0.62rem] font-extrabold uppercase tracking-widest text-white/38 px-2 mb-1">Program</div>

                <a href="{{ route('admin.foster-children.index') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Data Anak Asuh
                </a>

                <a href="{{ route('admin.sponsorships.index') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Orang Tua Asuh
                </a>

                <a href="{{ route('admin.child-developments.index') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                    Isi Perkembangan Anak
                </a>

                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Riwayat Transaksi
                    @php
                        $pendingCount = \App\Models\Donation::where('status','pending')->count()
                                      + \App\Models\Sponsorship::where('status','pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="ml-auto bg-emerald-300 text-emerald-700 text-[0.6rem] font-extrabold px-1.5 py-0.5 rounded-full">{{ $pendingCount }}</span>
                    @endif
                </a>
            </div>

            <div class="px-4 pt-5 pb-1">
                <div class="text-[0.62rem] font-extrabold uppercase tracking-widest text-white/38 px-2 mb-1">Rekap Data</div>

                <a href="{{ route('admin.rekap.donasi') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Data Donasi
                </a>

                <a href="{{ route('admin.rekap.donatur') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Data Donatur
                </a>

                <a href="{{ route('admin.rekap.orang-tua-asuh') }}" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-semibold text-white/62 hover:bg-white/10 hover:text-white transition-all duration-150 relative mb-0.5">
                    <svg class="w-4 h-4 shrink-0 opacity-65" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Data Orang Tua Asuh
                </a>
            </div>

            <div class="mt-auto px-4 py-4 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-2.5 py-2 rounded-lg text-xs font-bold text-white/50 hover:bg-white/10 hover:text-white transition-all duration-150 cursor-pointer w-full bg-transparent border-none">
                        <svg class="w-[15px] h-[15px] opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- ══ MAIN CONTENT ══ --}}
        <main class="flex-1 overflow-x-hidden min-w-0">

            {{-- Topbar --}}
            <div class="bg-white border-b border-emerald-100 px-8 py-4 flex items-center justify-between">
                <div>
                    <h1 id="greeting-text" class="text-xl font-black text-emerald-800">Selamat Datang 👋</h1>
                </div>
                <div class="flex items-center gap-4">
                    @php $adminUser = Auth::user(); @endphp
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg hover:bg-emerald-50 transition-colors">
                        @if($adminUser->avatar)
                            <img src="{{ asset('storage/' . $adminUser->avatar) }}" class="w-9 h-9 rounded-full object-cover ring-2 ring-emerald-200">
                        @else
                            <div class="w-9 h-9 rounded-full bg-emerald-200 text-emerald-700 font-extrabold text-sm flex items-center justify-center ring-2 ring-emerald-200">
                                {{ strtoupper(substr($adminUser->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="text-sm font-bold text-emerald-700 hidden sm:inline">{{ $adminUser->name }}</span>
                    </a>
                    <div class="w-px h-7 bg-emerald-200"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-semibold text-emerald-500 hover:text-red-500 hover:bg-red-50 transition-colors" title="Keluar">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span class="hidden sm:inline">Keluar</span>
                        </button>
                    </form>
                    <div id="topbar-date" class="text-sm font-bold text-emerald-500 bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-2 hidden sm:block">—</div>
                </div>
            </div>

            <div class="p-8">

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">💰</div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-500">Total Dana Terkumpul</p>
                        <p class="text-2xl font-black text-emerald-700">Rp {{ number_format($totalFunds ?? 0, 0, ',', '.') }}</p>
                        <p class="text-[11px] text-emerald-400 mt-0.5">Dari donasi yang berhasil</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">📣</div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-500">Kampanye Aktif</p>
                        <p class="text-2xl font-black text-emerald-700">{{ $activeCampaigns ?? 0 }}</p>
                        <p class="text-[11px] text-emerald-400 mt-0.5">Sedang berjalan saat ini</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">👦</div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-500">Total Anak Asuh</p>
                        <p class="text-2xl font-black text-emerald-700">{{ $fosterChildren ?? 0 }}</p>
                        <p class="text-[11px] text-emerald-400 mt-0.5">Terdaftar dalam sistem</p>
                    </div>
                </div>
            </div>

            {{-- Charts --}}
            <div class="grid grid-cols-[2fr_1fr] gap-4 mb-6 max-lg:grid-cols-1">

                {{-- Cashflow Chart --}}
                <div class="card bg-base-100 shadow-md border">
                    <div class="card-body p-5">
                        <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                            <div>
                                <div class="font-extrabold text-emerald-900">📈 Cashflow Donasi</div>
                                <div class="text-xs text-emerald-500 font-semibold mt-0.5">Total dana masuk per bulan (Rp)</div>
                            </div>
                            <div class="flex gap-1">
                                <button class="btn btn-success btn-xs cashflow-btn" onclick="setCashflowPeriod('6', this)">6 Bln</button>
                                <button class="btn btn-ghost btn-xs cashflow-btn" onclick="setCashflowPeriod('12', this)">12 Bln</button>
                            </div>
                        </div>
                        <canvas id="cashflowChart" height="200"></canvas>
                    </div>
                </div>

                {{-- Donut: Status Anak --}}
                <div class="card bg-base-100 shadow-md border">
                    <div class="card-body p-5">
                        <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                            <div>
                                <div class="font-extrabold text-emerald-900">👦 Status Anak Asuh</div>
                                <div class="text-xs text-emerald-500 font-semibold mt-0.5">Distribusi status saat ini</div>
                            </div>
                        </div>
                        <canvas id="childDonut" height="170"></canvas>
                        <div class="mt-3" id="donut-legend"></div>
                    </div>
                </div>

            </div>

            {{-- Bottom Row --}}
            <div class="grid grid-cols-2 gap-4 max-lg:grid-cols-1">

                {{-- Recent Transactions --}}
                <div class="card bg-base-100 shadow-md border">
                    <div class="card-body p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="font-extrabold text-emerald-900">🧾 Transaksi Terbaru</div>
                            <a href="{{ route('admin.transactions.index') }}" class="link link-hover text-xs font-bold text-emerald-600 ml-auto">
                                Lihat Semua →
                            </a>
                        </div>

                        @php
                            $recentDonations = \App\Models\Donation::with('campaign')
                                ->latest()->take(4)->get();
                        @endphp

                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>Donatur</th>
                                    <th>Kampanye</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentDonations as $txn)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="w-8 rounded-full">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($txn->donor_name) }}&background=b3e093&color=5c8148&rounded=true&bold=true" alt="">
                                                </div>
                                            </div>
                                            <div class="font-bold text-sm">{{ $txn->donor_name }}</div>
                                        </div>
                                    </td>
                                    <td class="text-sm text-base-content/70">{{ $txn->campaign->title ?? '-' }}</td>
                                    <td class="font-bold text-emerald-700">Rp {{ number_format($txn->amount, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $badgeClass = $txn->status === 'success' ? 'badge-success' : ($txn->status === 'pending' ? 'badge-warning' : 'badge-error');
                                            $badgeText = $txn->status === 'success' ? 'Sukses' : ($txn->status === 'pending' ? 'Tertunda' : 'Gagal');
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $badgeText }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-base-content/60 py-8">Belum ada transaksi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Child Status Detail --}}
                <div class="card bg-base-100 shadow-md border">
                    <div class="card-body p-5">
                        <div class="font-extrabold text-emerald-900 mb-3">📊 Rincian Anak Asuh</div>

                        @php
                            $totalAnak    = \App\Models\FosterChild::count();
                            $tersedia     = \App\Models\FosterChild::where('status','Tersedia')->count();
                            $diasuh       = \App\Models\FosterChild::where('status','Diasuh')->count();
                            $lainnya      = $totalAnak - $tersedia - $diasuh;
                        @endphp

                        <div class="flex items-center gap-2.5 py-2 border-b border-emerald-100 text-sm">
                            <span class="w-2.5 h-2.5 rounded-full shrink-0 bg-emerald-600"></span>
                            <span class="font-bold text-emerald-900 flex-1">Tersedia / Menunggu OTA</span>
                            <span class="font-black text-emerald-700">{{ $tersedia }}</span>
                            <span class="text-xs text-emerald-500 ml-1">({{ $totalAnak > 0 ? round($tersedia/$totalAnak*100) : 0 }}%)</span>
                        </div>
                        <div class="flex items-center gap-2.5 py-2 border-b border-emerald-100 text-sm">
                            <span class="w-2.5 h-2.5 rounded-full shrink-0 bg-emerald-700"></span>
                            <span class="font-bold text-emerald-900 flex-1">Sedang Diasuh</span>
                            <span class="font-black text-emerald-700">{{ $diasuh }}</span>
                            <span class="text-xs text-emerald-500 ml-1">({{ $totalAnak > 0 ? round($diasuh/$totalAnak*100) : 0 }}%)</span>
                        </div>
                        @if($lainnya > 0)
                        <div class="flex items-center gap-2.5 py-2 border-b border-emerald-100 text-sm">
                            <span class="w-2.5 h-2.5 rounded-full shrink-0 bg-emerald-400"></span>
                            <span class="font-bold text-emerald-900 flex-1">Status Lainnya</span>
                            <span class="font-black text-emerald-700">{{ $lainnya }}</span>
                            <span class="text-xs text-emerald-500 ml-1">({{ $totalAnak > 0 ? round($lainnya/$totalAnak*100) : 0 }}%)</span>
                        </div>
                        @endif

                        <div class="mt-4 pt-3.5 border-t border-emerald-100">
                            <div class="text-[0.7rem] font-bold text-emerald-500 uppercase tracking-wider mb-1.5">
                                Sponsorship Pending
                            </div>
                            @php
                                $pendingSpons = \App\Models\Sponsorship::where('status','pending')->count();
                            @endphp
                            <div class="text-[1.3rem] font-black text-emerald-700">
                                {{ $pendingSpons }}
                                <span class="text-xs font-bold text-emerald-500 ml-1">transaksi</span>
                            </div>
                            @if($pendingSpons > 0)
                                <a href="{{ route('admin.transactions.index') }}" class="btn btn-success btn-sm mt-2">
                                    Proses Sekarang →
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
        </main>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
    // ── Greeting & date ──
    document.addEventListener('DOMContentLoaded', function () {
        const h = new Date().getHours();
        const g = h < 5 ? 'Selamat Malam' : h < 12 ? 'Selamat Pagi' : h < 15 ? 'Selamat Siang' : h < 18 ? 'Selamat Sore' : 'Selamat Malam';
        document.getElementById('greeting-text').textContent = g + ' 👋';

        const now = new Date();
        const opts = { weekday:'long', day:'numeric', month:'long', year:'numeric' };
        document.getElementById('topbar-date').textContent = now.toLocaleDateString('id-ID', opts);
    });

    // ── Cashflow data dari backend (PHP → JS) ──
    @php
        $cashflow12 = [];
        $labels12   = [];
        for ($i = 11; $i >= 0; $i--) {
            $date  = now()->subMonths($i);
            $total = \App\Models\Donation::where('status','success')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('amount');
            $cashflow12[] = (int) $total;
            $labels12[]   = $date->locale('id')->isoFormat('MMM YY');
        }
    @endphp

    const allLabels   = @json($labels12);
    const allData     = @json($cashflow12);

    let cashflowChart;

    function buildCashflow(period) {
        const labels = allLabels.slice(-period);
        const data   = allData.slice(-period);

        if (cashflowChart) cashflowChart.destroy();

        const ctx = document.getElementById('cashflowChart').getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, 'rgba(92,129,72,0.22)');
        gradient.addColorStop(1, 'rgba(92,129,72,0)');

        cashflowChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Dana Masuk (Rp)',
                    data,
                    borderColor: '#5c8148',
                    borderWidth: 2.5,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.42,
                    pointBackgroundColor: '#5c8148',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ' Rp ' + ctx.raw.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: '#edf7e2' },
                        ticks: { color: '#a1c181', font: { size: 11, weight: '600' } }
                    },
                    y: {
                        grid: { color: '#edf7e2' },
                        ticks: {
                            color: '#a1c181',
                            font: { size: 11 },
                            callback: v => 'Rp ' + (v >= 1e6 ? (v/1e6).toFixed(1)+'jt' : v >= 1e3 ? (v/1e3).toFixed(0)+'rb' : v)
                        }
                    }
                }
            }
        });
    }

    function setCashflowPeriod(p, btn) {
        document.querySelectorAll('.cashflow-btn').forEach(b => {
            b.classList.remove('btn-success');
            b.classList.add('btn-ghost');
        });
        btn.classList.remove('btn-ghost');
        btn.classList.add('btn-success');
        buildCashflow(parseInt(p));
    }

    // ── Donut chart: status anak asuh ──
    @php
        $tersediaJs = \App\Models\FosterChild::where('status','Tersedia')->count();
        $diasuhJs   = \App\Models\FosterChild::where('status','Diasuh')->count();
        $lainnyaJs  = \App\Models\FosterChild::count() - $tersediaJs - $diasuhJs;
    @endphp

    (function () {
        const tersedia = {{ $tersediaJs }};
        const diasuh   = {{ $diasuhJs }};
        const lainnya  = {{ $lainnyaJs }};
        const total    = tersedia + diasuh + lainnya;

        const ctx = document.getElementById('childDonut').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Tersedia', 'Diasuh', 'Lainnya'],
                datasets: [{
                    data: [tersedia, diasuh, lainnya > 0 ? lainnya : 0],
                    backgroundColor: ['#76a45b', '#5c8148', '#a1c181'],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ' ' + ctx.label + ': ' + ctx.raw + ' anak'
                        }
                    }
                }
            }
        });

        // Legend
        const items = [
            { label: 'Tersedia', count: tersedia, color: '#76a45b' },
            { label: 'Diasuh',   count: diasuh,   color: '#5c8148' },
        ];
        if (lainnya > 0) items.push({ label: 'Lainnya', count: lainnya, color: '#a1c181' });

        const legend = document.getElementById('donut-legend');
        items.forEach(item => {
            const pct = total > 0 ? Math.round(item.count / total * 100) : 0;
            legend.innerHTML += `
                <div class="flex items-center gap-2.5 py-2 border-b border-emerald-100 text-sm">
                    <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background:${item.color};"></span>
                    <span class="font-bold text-emerald-900 flex-1">${item.label}</span>
                    <span class="font-black text-emerald-700">${item.count}</span>
                    <span class="text-xs text-emerald-500 ml-1">(${pct}%)</span>
                </div>`;
        });
    })();

    // ── Init cashflow ──
    buildCashflow(6);
    </script>
</x-app-layout>
