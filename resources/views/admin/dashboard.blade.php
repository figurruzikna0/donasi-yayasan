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
        <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
            <div class="relative rounded-xl p-5 flex items-center gap-4 overflow-hidden group cursor-default" style="background: linear-gradient(135deg, #0f3b2c 0%, #1a6b4a 100%);">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl flex-shrink-0 backdrop-blur-sm">💰</div>
                    <div class="min-w-0 relative">
                        <p class="text-[0.55rem] font-bold uppercase tracking-[0.15em] text-white/60">Total Dana Terkumpul</p>
                        <p class="text-lg font-black text-white truncate mt-0.5">Rp {{ number_format($totalFunds ?? 0, 0, ',', '.') }}</p>
                    </div>
            </div>
            <div class="relative rounded-xl p-5 flex items-center gap-4 overflow-hidden group cursor-default" style="background: linear-gradient(135deg, #0e5e3a 0%, #1e8b57 100%);">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl flex-shrink-0 backdrop-blur-sm">📣</div>
                    <div class="min-w-0 relative">
                        <p class="text-[0.55rem] font-bold uppercase tracking-[0.15em] text-white/60">Kampanye Aktif</p>
                        <p class="text-2xl font-black text-white mt-0.5">{{ $activeCampaigns ?? 0 }}</p>
                    </div>
            </div>
            <div class="relative rounded-xl p-5 flex items-center gap-4 overflow-hidden group cursor-default" style="background: linear-gradient(135deg, #7c4f1a 0%, #b87d2e 100%);">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl flex-shrink-0 backdrop-blur-sm">👦</div>
                    <div class="min-w-0 relative">
                        <p class="text-[0.55rem] font-bold uppercase tracking-[0.15em] text-white/60">Total Anak Asuh</p>
                        <p class="text-2xl font-black text-white mt-0.5">{{ $fosterChildren ?? 0 }}</p>
                    </div>
            </div>
            <div class="relative rounded-xl p-5 flex items-center gap-4 overflow-hidden group cursor-default" style="background: linear-gradient(135deg, #155e75 0%, #1d8db3 100%);">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl flex-shrink-0 backdrop-blur-sm">📥</div>
                    <div class="min-w-0 relative">
                        <p class="text-[0.55rem] font-bold uppercase tracking-[0.15em] text-white/60">Donasi Hari Ini</p>
                        <p class="text-lg font-black text-white truncate mt-0.5">Rp {{ number_format($todayDonasi ?? 0, 0, ',', '.') }}</p>
                    </div>
            </div>
            <div class="relative rounded-xl p-5 flex items-center gap-4 overflow-hidden group cursor-default" style="background: linear-gradient(135deg, #4a236e 0%, #7c3aae 100%);">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/5"></div>
                    <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center text-xl flex-shrink-0 backdrop-blur-sm">🤝</div>
                    <div class="min-w-0 relative">
                        <p class="text-[0.55rem] font-bold uppercase tracking-[0.15em] text-white/60">Sponsor Baru (Bln Ini)</p>
                        <p class="text-2xl font-black text-white mt-0.5">{{ $monthSponsor ?? 0 }}</p>
                    </div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="grid grid-cols-[2fr_1fr] gap-4 max-lg:grid-cols-1">

            {{-- Cashflow Chart --}}
            <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                        <div>
                            <div class="font-extrabold text-slate-800">📈 Cashflow Donasi</div>
                            <div class="text-xs text-slate-400 font-semibold mt-0.5">Total dana masuk per bulan (Rp)</div>
                        </div>
                        <div class="flex gap-1 bg-slate-100 rounded-lg p-0.5">
                            <button class="btn btn-xs bg-emerald-700 text-white border-0 hover:bg-emerald-800 font-bold cashflow-btn rounded-md" onclick="setCashflowPeriod('6', this)">6 Bln</button>
                            <button class="btn btn-xs btn-ghost text-slate-500 cashflow-btn rounded-md" onclick="setCashflowPeriod('12', this)">12 Bln</button>
                        </div>
                    </div>
                    <canvas id="cashflowChart" height="200"></canvas>
                </div>
            </div>

            {{-- Donut: Status Anak --}}
            <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                        <div>
                            <div class="font-extrabold text-slate-800">👦 Status Anak Asuh</div>
                            <div class="text-xs text-slate-400 font-semibold mt-0.5">Distribusi status saat ini</div>
                        </div>
                    </div>
                    <canvas id="childDonut" height="170"></canvas>
                    <div class="mt-3" id="donut-legend"></div>
                </div>
            </div>

        </div>

        {{-- Top Campaigns --}}
        <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
            <div class="p-5">
                <div class="flex items-center gap-2 mb-4">
                    <div class="font-extrabold text-slate-800">🏆 Kampanye Terpopuler</div>
                    <a href="{{ route('admin.campaigns.index') }}" class="link link-hover text-xs font-bold text-emerald-700 ml-auto flex items-center gap-1 hover:gap-1.5 transition-all">
                        Kelola Kampanye
                        <span class="text-xs">→</span>
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($topCampaigns as $camp)
                    @php $progress = $camp->target_amount > 0 ? min(100, round($camp->collected_amount / $camp->target_amount * 100)) : 0; @endphp
                    <div class="bg-slate-50 rounded-lg px-4 py-3 hover:bg-slate-100 transition-colors">
                        <div class="flex items-center justify-between mb-1.5">
                            <div class="text-sm font-bold text-slate-800 truncate flex-1">{{ $camp->title }}</div>
                            <span class="text-xs font-black text-emerald-700 ml-2">{{ $progress }}%</span>
                        </div>
                        <div class="w-full h-2.5 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-600 to-emerald-400 rounded-full transition-all" style="width: {{ $progress }}%"></div>
                        </div>
                        <div class="flex items-center justify-between mt-1.5">
                            <span class="text-[0.55rem] text-slate-500 font-medium">Rp {{ number_format($camp->collected_amount, 0, ',', '.') }} / Rp {{ number_format($camp->target_amount, 0, ',', '.') }}</span>
                            @if($progress >= 100)
                            <span class="text-[0.55rem] font-bold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full border border-emerald-200">Tercapai ✅</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-slate-400 py-6 text-sm">Belum ada kampanye aktif</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Bottom Row --}}
        <div class="grid grid-cols-2 gap-4 max-lg:grid-cols-1">

            {{-- Recent Transactions --}}
            <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="font-extrabold text-slate-800">🧾 Transaksi Terbaru</div>
                        <a href="{{ route('admin.transactions.index') }}" class="link link-hover text-xs font-bold text-emerald-700 ml-auto flex items-center gap-1 hover:gap-1.5 transition-all">
                            Lihat Semua
                            <span class="text-xs">→</span>
                        </a>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @forelse($recentDonations as $txn)
                        <div class="flex items-center gap-3 py-3 first:pt-0 last:pb-0">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xs flex items-center justify-center flex-shrink-0 uppercase">{{ substr($txn->donor_name, 0, 1) }}</div>
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-sm text-slate-800 truncate">{{ $txn->donor_name }}</div>
                                <div class="text-xs text-slate-400 truncate">{{ $txn->campaign->title ?? '-' }}</div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <div class="font-bold text-emerald-700 text-sm">Rp {{ number_format($txn->amount, 0, ',', '.') }}</div>
                                @php
                                    $badgeClass = $txn->status === 'success' ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : ($txn->status === 'pending' ? 'bg-amber-50 text-amber-800 border-amber-200' : 'bg-rose-50 text-rose-800 border-rose-200');
                                    $badgeText = $txn->status === 'success' ? 'Sukses' : ($txn->status === 'pending' ? 'Tertunda' : 'Gagal');
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
            <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="p-5">
                    <div class="font-extrabold text-slate-800 mb-4">📊 Rincian Anak Asuh</div>

                    <div class="space-y-3">
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
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-[0.6rem] font-bold text-slate-400 uppercase tracking-wider">Transaksi Pending</div>
                                <div class="text-xl font-black text-slate-800 mt-0.5">{{ $pendingCount ?? 0 }} <span class="text-xs font-bold text-slate-400">transaksi</span></div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
    // ── Greeting & date ──
    document.addEventListener('DOMContentLoaded', function () {
        const h = new Date().getHours();
        const g = h < 5 ? 'Selamat Malam' : h < 12 ? 'Selamat Pagi' : h < 15 ? 'Selamat Siang' : h < 18 ? 'Selamat Sore' : 'Selamat Malam';
        document.getElementById('page-title-text').textContent = g + ' 👋';
    });

    // ── Cashflow data dari backend (PHP → JS) ──
    const allLabels   = @json($labels12);
    const allData     = @json($cashflow12);

    let cashflowChart;

    function buildCashflow(period) {
        const labels = allLabels.slice(-period);
        const data   = allData.slice(-period);

        if (cashflowChart) cashflowChart.destroy();

        const ctx = document.getElementById('cashflowChart').getContext('2d');

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
                            callback: v => 'Rp ' + (v >= 1e6 ? (v/1e6).toFixed(1)+'jt' : v >= 1e3 ? (v/1e3).toFixed(0)+'rb' : v)
                        }
                    }
                }
            }
        });
    }

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
    buildCashflow(6);
    </script>
</x-admin-layout>
