{{--
    ========================================================
    ADMIN DASHBOARD (resources/views/admin/dashboard.blade.php)
    ========================================================
    Halaman utama admin setelah login.
    Data dikirim dari DashboardController.index():
      - $totalFunds       → total dana terkumpul (donasi sukses)
      - $activeCampaigns  → jumlah campaign aktif
      - $fosterChildren   → total anak asuh
      - $topCampaigns     → 5 campaign dgn donasi terbanyak
      - $todayDonasi      → donasi masuk hari ini
      - $monthSponsor     → sponsorship baru bulan ini
      - $pendingCount     → transaksi pending (donasi + sponsorship)
      - $recentDonations  → 4 transaksi terbaru
      - $totalAnak, $tersedia, $diasuh, $lainnya → statistik anak
      - $labels12, $cashflow12 → grafik cashflow 12 bulan (Chart.js)
    ========================================================
--}}
<x-admin-layout>

    <div class="p-6 lg:p-8 space-y-6">

        {{-- Stat Cards --}}
        {{-- -----------------------------------------------------------
            Seksi kartu statistik (grid 5 kolom): menampilkan ringkasan
            angka penting yayasan. Data berasal dari DashboardController:
            $totalFunds (dana terkumpul), $activeCampaigns (kampanye aktif),
            $fosterChildren (anak asuh), $todayDonasi (donasi hari ini),
            $monthSponsor (sponsor baru bulan ini).
            Setiap kartu memakai number_format() agar nominal rupiah
            tampil dengan titik ribuan (contoh: 1.500.000).
        ----------------------------------------------------------- --}}
        <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
            {{-- Kartu 1: Total Dana Terkumpul --}}
            <div class="relative rounded-xl p-5 flex items-center gap-4 overflow-hidden group cursor-default" style="background: linear-gradient(135deg, #0f3b2c 0%, #1a6b4a 100%);">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl flex-shrink-0 backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    <div class="min-w-0 relative">
                        <p class="text-[0.55rem] font-bold uppercase tracking-[0.15em] text-white/60">Total Dana Terkumpul</p>
                        <p class="text-lg font-black text-white truncate mt-0.5">Rp {{ number_format($totalFunds ?? 0, 0, ',', '.') }}</p>
                    </div>
            </div>
            {{-- Kartu 2: Jumlah Kampanye Aktif --}}
            <div class="relative rounded-xl p-5 flex items-center gap-4 overflow-hidden group cursor-default" style="background: linear-gradient(135deg, #0e5e3a 0%, #1e8b57 100%);">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl flex-shrink-0 backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.496.496 0 01-.661-.19 12.813 12.813 0 01-1.127-3.626m2.923-2.858a9.292 9.292 0 00-2.923 2.858m2.923-2.858a9.538 9.538 0 012.645-2.077 9.118 9.118 0 013.424-1.003M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    <div class="min-w-0 relative">
                        <p class="text-[0.55rem] font-bold uppercase tracking-[0.15em] text-white/60">Kampanye Aktif</p>
                        <p class="text-2xl font-black text-white mt-0.5">{{ $activeCampaigns ?? 0 }}</p>
                    </div>
            </div>
            {{-- Kartu 3: Total Anak Asuh --}}
            <div class="relative rounded-xl p-5 flex items-center gap-4 overflow-hidden group cursor-default" style="background: linear-gradient(135deg, #7c4f1a 0%, #b87d2e 100%);">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl flex-shrink-0 backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                    <div class="min-w-0 relative">
                        <p class="text-[0.55rem] font-bold uppercase tracking-[0.15em] text-white/60">Total Anak Asuh</p>
                        <p class="text-2xl font-black text-white mt-0.5">{{ $fosterChildren ?? 0 }}</p>
                    </div>
            </div>
            {{-- Kartu 4: Donasi Masuk Hari Ini --}}
            <div class="relative rounded-xl p-5 flex items-center gap-4 overflow-hidden group cursor-default" style="background: linear-gradient(135deg, #155e75 0%, #1d8db3 100%);">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl flex-shrink-0 backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                        </div>
                    <div class="min-w-0 relative">
                        <p class="text-[0.55rem] font-bold uppercase tracking-[0.15em] text-white/60">Donasi Hari Ini</p>
                        <p class="text-lg font-black text-white truncate mt-0.5">Rp {{ number_format($todayDonasi ?? 0, 0, ',', '.') }}</p>
                    </div>
            </div>
            {{-- Kartu 5: Sponsor Baru Bulan Ini --}}
            <div class="relative rounded-xl p-5 flex items-center gap-4 overflow-hidden group cursor-default" style="background: linear-gradient(135deg, #4a236e 0%, #7c3aae 100%);">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl flex-shrink-0 backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
                        </div>
                    <div class="min-w-0 relative">
                        <p class="text-[0.55rem] font-bold uppercase tracking-[0.15em] text-white/60">Sponsor Baru (Bln Ini)</p>
                        <p class="text-2xl font-black text-white mt-0.5">{{ $monthSponsor ?? 0 }}</p>
                    </div>
            </div>
        </div>

        {{-- Charts --}}
        {{-- -----------------------------------------------------------
            Seksi grafik: layout dua kolom (2fr : 1fr).
            Kiri = grafik garis cashflow donasi 12 bulan (Chart.js).
            Kanan = grafik donut distribusi status anak asuh.
        ----------------------------------------------------------- --}}
        <div class="grid grid-cols-[2fr_1fr] gap-4 max-lg:grid-cols-1">

            {{-- Cashflow Chart --}}
            {{-- Grafik garis "Cashflow Donasi": total dana masuk per bulan.
                Data $labels12 (nama bulan) dan $cashflow12 (nominal) dikirim
                dari DashboardController lalu diteruskan ke JS lewat json.
                Tombol "6 Bln" / "12 Bln" memanggil setCashflowPeriod(). --}}
            <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                        <div>
                            <div class="font-extrabold text-slate-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                            Cashflow Donasi
                        </div>
                            <div class="text-xs text-slate-400 font-semibold mt-0.5">Total dana masuk per bulan (Rp)</div>
                        </div>
                        {{-- Tombol pengatur periode tampilan grafik: 6 atau 12 bulan terakhir --}}
                        <div class="flex gap-1 bg-slate-100 rounded-lg p-0.5">
                            <button class="btn btn-xs bg-emerald-700 text-white border-0 hover:bg-emerald-800 font-bold cashflow-btn rounded-md" onclick="setCashflowPeriod('6', this)">6 Bln</button>
                            <button class="btn btn-xs btn-ghost text-slate-500 cashflow-btn rounded-md" onclick="setCashflowPeriod('12', this)">12 Bln</button>
                        </div>
                    </div>
                    {{-- Kanvas tempat Chart.js menggambar grafik garis cashflow --}}
                    <canvas id="cashflowChart" height="200"></canvas>
                </div>
            </div>

            {{-- Donut: Status Anak --}}
            {{-- Grafik donut distribusi status anak asuh: Tersedia, Diasuh,
                dan Lainnya. Data $tersedia, $diasuh, $lainnya dipakai langsung
                oleh skrip JS di bawah. Legenda dibuat dinamis di div #donut-legend. --}}
            <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                        <div>
                            <div class="font-extrabold text-slate-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                            Status Anak Asuh
                        </div>
                            <div class="text-xs text-slate-400 font-semibold mt-0.5">Distribusi status saat ini</div>
                        </div>
                    </div>
                    <canvas id="childDonut" height="170"></canvas>
                    {{-- Tempat legenda donut (diisi lewat JavaScript) --}}
                    <div class="mt-3" id="donut-legend"></div>
                </div>
            </div>

        </div>

        {{-- Top Campaigns --}}
        {{-- -----------------------------------------------------------
            Daftar 5 kampanye dengan donasi terbanyak ($topCampaigns).
            forelse: jika tidak ada kampanye, tampilkan pesan kosong.
            Progress bar dihitung dari collected_amount / target_amount,
            dibatasi maksimal 100%. Jika sudah 100%+ muncul badge "Tercapai".
        ----------------------------------------------------------- --}}
        <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
            <div class="p-5">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                    <div class="font-extrabold text-slate-800">Kampanye Terpopuler</div>
                    {{-- Tautan cepat menuju halaman kelola kampanye --}}
                    <a href="{{ route('admin.campaigns.index') }}" class="link link-hover text-xs font-bold text-emerald-700 ml-auto flex items-center gap-1 hover:gap-1.5 transition-all">
                        Kelola Kampanye
                        <span class="text-xs">→</span>
                    </a>
                </div>

                <div class="space-y-3">
                    {{-- Perulangan setiap kampanye top 5 --}}
                    @forelse($topCampaigns as $camp)
                    {{-- Perhitungan persentase pencapaian target donasi kampanye --}}
                    @php $progress = $camp->target_amount > 0 ? min(100, round($camp->collected_amount / $camp->target_amount * 100)) : 0; @endphp
                    <div class="bg-slate-50 rounded-lg px-4 py-3 hover:bg-slate-100 transition-colors">
                        <div class="flex items-center justify-between mb-1.5">
                            {{-- Judul kampanye dan persentase progres --}}
                            <div class="text-sm font-bold text-slate-800 truncate flex-1">{{ $camp->title }}</div>
                            <span class="text-xs font-black text-emerald-700 ml-2">{{ $progress }}%</span>
                        </div>
                        {{-- Baris progress bar: lebar diisi sesuai nilai $progress --}}
                        <div class="w-full h-2.5 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full transition-all" style="width: {{ $progress }}%"></div>
                        </div>
                        <div class="flex items-center justify-between mt-1.5">
                            {{-- Nominal terkumpul dibanding target --}}
                            <span class="text-[0.55rem] text-slate-500 font-medium">Rp {{ number_format($camp->collected_amount, 0, ',', '.') }} / Rp {{ number_format($camp->target_amount, 0, ',', '.') }}</span>
                            {{-- Badge "Tercapai" hanya muncul jika progres sudah 100% --}}
                            @if($progress >= 100)
                            <span class="text-[0.55rem] font-bold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full border border-emerald-200 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Tercapai</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    {{-- Kondisi saat tidak ada kampanye sama sekali --}}
                    <div class="text-center text-slate-400 py-6 text-sm">Belum ada kampanye aktif</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Bottom Row --}}
        <div class="grid grid-cols-2 gap-4 max-lg:grid-cols-1">

            {{-- Recent Transactions --}}
            {{-- -----------------------------------------------------------
                Daftar 4 transaksi donasi terbaru ($recentDonations).
                Badge status dibuat dinamis di php: sukses (hijau),
                pending (kuning), selain itu ditolak (merah).
                Klik "Lihat Semua" menuju halaman riwayat transaksi.
            ----------------------------------------------------------- --}}
            <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                        <div class="font-extrabold text-slate-800">Transaksi Terbaru</div>
                        <a href="{{ route('admin.transactions.index') }}" class="link link-hover text-xs font-bold text-emerald-700 ml-auto flex items-center gap-1 hover:gap-1.5 transition-all">
                            Lihat Semua
                            <span class="text-xs">→</span>
                        </a>
                    </div>

                    <div class="divide-y divide-slate-100">
                        /* Perulangan daftar donasi terbaru */
                        @forelse($recentDonations as $txn)
                        <div class="flex items-center gap-3 py-3 first:pt-0 last:pb-0">
                            /* Avatar lingkaran berisi huruf pertama nama donatur */
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xs flex items-center justify-center flex-shrink-0 uppercase">{{ substr($txn->donor_name, 0, 1) }}</div>
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-sm text-slate-800 truncate">{{ $txn->donor_name }}</div>
                                /* Judul kampanye terkait transaksi (fallback "-" jika kampanye dihapus) */
                                <div class="text-xs text-slate-400 truncate">{{ $txn->campaign->title ?? '-' }}</div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <div class="font-bold text-emerald-700 text-sm">Rp {{ number_format($txn->amount, 0, ',', '.') }}</div>
                                /* Penentuan warna & teks badge status transaksi */
                                @php
                                    $badgeClass = $txn->status === 'success' ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : ($txn->status === 'pending' ? 'bg-amber-50 text-amber-800 border-amber-200' : 'bg-rose-50 text-rose-800 border-rose-200');
                                    $badgeText = $txn->status === 'success' ? 'Sukses' : ($txn->status === 'pending' ? 'Tertunda' : 'Ditolak');
                                @endphp
                                <span class="inline-block text-[0.55rem] font-bold px-2 py-0.5 rounded-full border {{ $badgeClass }} mt-0.5">{{ $badgeText }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-slate-400 py-8 text-sm">Belum ada transaksi</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Child Status Detail --}}
            {{-- -----------------------------------------------------------
                Rincian status anak asuh dalam bentuk bar + persentase:
                Tersedia ($tersedia), Sedang Diasuh ($diasuh), dan
                Status Lainnya ($lainnya, hanya tampil jika > 0).
                Di bagian bawah ada jumlah transaksi pending beserta tombol
                "Proses Sekarang" yang mengarah ke halaman transaksi.
            ----------------------------------------------------------- --}}
            <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="p-5">
                    <div class="font-extrabold text-slate-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                            Rincian Anak Asuh
                        </div>

                    <div class="space-y-3">
                        {{-- Bar status: anak tersedia (belum diasuh) --}}
                        <div class="bg-slate-50 rounded-lg px-4 py-3">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                                    <span class="font-bold text-slate-800">Tersedia</span>
                                </div>
                                <span class="font-black text-emerald-700">{{ $tersedia }}</span>
                            </div>
                            <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-600 rounded-full transition-all" style="width: {{ $totalAnak > 0 ? ($tersedia/$totalAnak)*100 : 0 }}%"></div>
                            </div>
                            <div class="text-[0.6rem] text-slate-400 mt-1">{{ $totalAnak > 0 ? round($tersedia/$totalAnak*100) : 0 }}% dari total</div>
                        </div>

                        {{-- Bar status: anak sedang diasuh --}}
                        <div class="bg-slate-50 rounded-lg px-4 py-3">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                                    <span class="font-bold text-slate-800">Sedang Diasuh</span>
                                </div>
                                <span class="font-black text-emerald-700">{{ $diasuh }}</span>
                            </div>
                            <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-400 rounded-full transition-all" style="width: {{ $totalAnak > 0 ? ($diasuh/$totalAnak)*100 : 0 }}%"></div>
                            </div>
                            <div class="text-[0.6rem] text-slate-400 mt-1">{{ $totalAnak > 0 ? round($diasuh/$totalAnak*100) : 0 }}% dari total</div>
                        </div>

                        {{-- Bar status lain-lain; hanya dirender jika jumlahnya lebih dari 0 --}}
                        @if($lainnya > 0)
                        <div class="bg-slate-50 rounded-lg px-4 py-3">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-300"></span>
                                    <span class="font-bold text-slate-800">Status Lainnya</span>
                                </div>
                                <span class="font-black text-emerald-600">{{ $lainnya }}</span>
                            </div>
                            <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-300 rounded-full transition-all" style="width: {{ $totalAnak > 0 ? ($lainnya/$totalAnak)*100 : 0 }}%"></div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="mt-4 pt-4 border-t border-slate-100">
                        {{-- Ringkasan transaksi pending + tombol aksi ke halaman transaksi --}}
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-[0.6rem] font-bold text-slate-400 uppercase tracking-wider">Transaksi Pending</div>
                                <div class="text-xl font-black text-slate-800 mt-0.5">{{ $pendingCount ?? 0 }} <span class="text-xs font-bold text-slate-400">transaksi</span></div>
                            </div>
                            {{-- Tombol proses muncul hanya jika ada transaksi pending --}}
                            @if($pendingCount > 0)
                                <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm bg-emerald-700 text-white hover:bg-emerald-800 border-0 font-bold rounded-lg shadow-sm">Proses Sekarang →</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    {{-- Chart.js --}}
    {{-- Pustaka grafik Chart.js dimuat dari CDN jsDelivr --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    {{-- ------------------------------------------------------------------
        SEKSI JAVASCRIPT HALAMAN DASHBOARD
        - Sapaan dinamis pada judul halaman (pagi/siang/sore/malam).
        - Grafik cashflow garis dengan data dari backend.
        - Grafik donut status anak asuh + legenda dinamis.
    ------------------------------------------------------------------ --}}
    <script>
    // ── Greeting & date ──
    // Menampilkan sapaan sesuai jam saat ini (pagi, siang, sore, malam)
    document.addEventListener('DOMContentLoaded', function () {
        const h = new Date().getHours();
        const g = h < 5 ? 'Selamat Malam' : h < 12 ? 'Selamat Pagi' : h < 15 ? 'Selamat Siang' : h < 18 ? 'Selamat Sore' : 'Selamat Malam';
        document.getElementById('page-title-text').textContent = g;
    });

    // ── Cashflow data dari backend (PHP → JS) ──
    // Label bulan dan nominal dana masuk diubah jadi array JavaScript
    const allLabels   = @json($labels12);
    const allData     = @json($cashflow12);

    let cashflowChart;

    // Membangun ulang grafik cashflow untuk periode tertentu (6/12 bulan)
    function buildCashflow(period) {
        const labels = allLabels.slice(-period);
        const data   = allData.slice(-period);

        if (cashflowChart) cashflowChart.destroy();

        const ctx = document.getElementById('cashflowChart').getContext('2d');

        // Gradien warna di bawah garis grafik agar lebih menarik
        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, 'rgba(15,59,44,0.15)');
        gradient.addColorStop(1, 'rgba(15,59,44,0)');

        cashflowChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Dana Masuk (Rp)',
                    data,
                    borderColor: '#0f3b2c',
                    borderWidth: 2.5,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.42,
                    pointBackgroundColor: '#0f3b2c',
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
                        grid: { color: '#f1f5f9' },
                        ticks: { color: '#0f3b2c', font: { size: 11, weight: '600' } }
                    },
                    y: {
                        grid: { color: '#f1f5f9' },
                        ticks: {
                            color: '#0f3b2c',
                            font: { size: 11 },
                            // Format label sumbu Y: jutaan (jt) atau ribuan (rb)
                            callback: v => 'Rp ' + (v >= 1e6 ? (v/1e6).toFixed(1)+'jt' : v >= 1e3 ? (v/1e3).toFixed(0)+'rb' : v)
                        }
                    }
                }
            }
        });
    }

    // Mengganti periode tampilan grafik dan memperbarui gaya tombol aktif
    function setCashflowPeriod(p, btn) {
        document.querySelectorAll('.cashflow-btn').forEach(b => {
            b.classList.remove('bg-emerald-700', 'text-white');
            b.classList.add('btn-ghost', 'text-slate-500');
        });
        btn.classList.remove('btn-ghost', 'text-slate-500');
        btn.classList.add('bg-emerald-700', 'text-white');
        buildCashflow(parseInt(p));
    }

    // ── Donut chart: status anak asuh ──
    // IIFE (langsung dieksekusi): membuat grafik donut & legenda status anak
    (function () {
        const tersedia = {{ $tersedia }};
        const diasuh   = {{ $diasuh }};
        const lainnya  = {{ $lainnya }};
        const total    = tersedia + diasuh + lainnya;

        const ctx = document.getElementById('childDonut').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Tersedia', 'Diasuh', 'Lainnya'],
                datasets: [{
                    data: [tersedia, diasuh, lainnya > 0 ? lainnya : 0],
                    backgroundColor: ['#0f3b2c', '#059669', '#a7f3d0'],
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
        // Membangun legenda di bawah grafik beserta persentasenya
        const items = [
            { label: 'Tersedia', count: tersedia, color: '#0f3b2c' },
            { label: 'Diasuh',   count: diasuh,   color: '#059669' },
        ];
        if (lainnya > 0) items.push({ label: 'Lainnya', count: lainnya, color: '#a7f3d0' });

        const legend = document.getElementById('donut-legend');
        items.forEach(item => {
            const pct = total > 0 ? Math.round(item.count / total * 100) : 0;
            legend.innerHTML += `
                <div class="flex items-center gap-2.5 py-2 border-b border-slate-100 text-sm">
                    <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background:${item.color};"></span>
                    <span class="font-bold text-slate-800 flex-1">${item.label}</span>
                    <span class="font-black text-slate-800">${item.count}</span>
                    <span class="text-xs text-slate-400 ml-1">(${pct}%)</span>
                </div>`;
        });
    })();

    // ── Init cashflow ──
    // Inisialisasi pertama: tampilkan grafik 6 bulan terakhir
    buildCashflow(6);
    </script>
</x-admin-layout>
