<x-admin-layout>

    <div class="p-8 space-y-6">

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-xl flex-shrink-0">💰</div>
                    <div class="min-w-0">
                        <p class="text-[0.6rem] font-bold uppercase tracking-widest text-base-content/40">Total Dana Terkumpul</p>
                        <p class="text-lg font-black text-primary truncate">Rp {{ number_format($totalFunds ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-xl flex-shrink-0">📣</div>
                    <div class="min-w-0">
                        <p class="text-[0.6rem] font-bold uppercase tracking-widest text-base-content/40">Kampanye Aktif</p>
                        <p class="text-2xl font-black text-emerald-700">{{ $activeCampaigns ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-xl flex-shrink-0">👦</div>
                    <div class="min-w-0">
                        <p class="text-[0.6rem] font-bold uppercase tracking-widest text-base-content/40">Total Anak Asuh</p>
                        <p class="text-2xl font-black text-amber-700">{{ $fosterChildren ?? 0 }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center text-xl flex-shrink-0">📥</div>
                    <div class="min-w-0">
                        <p class="text-[0.6rem] font-bold uppercase tracking-widest text-base-content/40">Donasi Hari Ini</p>
                        <p class="text-lg font-black text-sky-700 truncate">Rp {{ number_format($todayDonasi ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-xl flex-shrink-0">🤝</div>
                    <div class="min-w-0">
                        <p class="text-[0.6rem] font-bold uppercase tracking-widest text-base-content/40">Sponsor Baru (Bln Ini)</p>
                        <p class="text-2xl font-black text-purple-700">{{ $monthSponsor ?? 0 }}</p>
                    </div>
                </div>
            </div>

            {{-- Charts --}}
            <div class="grid grid-cols-[2fr_1fr] gap-4 max-lg:grid-cols-1">

                {{-- Cashflow Chart --}}
                <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                            <div>
                                <div class="font-extrabold text-base-content">📈 Cashflow Donasi</div>
                                <div class="text-xs text-base-content/40 font-semibold mt-0.5">Total dana masuk per bulan (Rp)</div>
                            </div>
                            <div class="flex gap-1">
                                <button class="btn btn-xs bg-primary/10 text-primary border-0 hover:bg-primary/20 font-bold cashflow-btn" onclick="setCashflowPeriod('6', this)">6 Bln</button>
                                <button class="btn btn-xs btn-ghost text-base-content/40 cashflow-btn" onclick="setCashflowPeriod('12', this)">12 Bln</button>
                            </div>
                        </div>
                        <canvas id="cashflowChart" height="200"></canvas>
                    </div>
                </div>

                {{-- Donut: Status Anak --}}
                <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                            <div>
                                <div class="font-extrabold text-base-content">👦 Status Anak Asuh</div>
                                <div class="text-xs text-base-content/40 font-semibold mt-0.5">Distribusi status saat ini</div>
                            </div>
                        </div>
                        <canvas id="childDonut" height="170"></canvas>
                        <div class="mt-3" id="donut-legend"></div>
                    </div>
                </div>

            </div>

            {{-- Top Campaigns --}}
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="font-extrabold text-base-content">🏆 Kampanye Terpopuler</div>
                        <a href="{{ route('admin.campaigns.index') }}" class="link link-hover text-xs font-bold text-primary ml-auto flex items-center gap-1 hover:gap-1.5 transition-all">
                            Kelola Kampanye
                            <span class="text-xs">→</span>
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($topCampaigns as $camp)
                        @php $progress = $camp->target_amount > 0 ? min(100, round($camp->collected_amount / $camp->target_amount * 100)) : 0; @endphp
                        <div class="bg-base-200/40 rounded-lg px-4 py-3">
                            <div class="flex items-center justify-between mb-1">
                                <div class="text-sm font-bold text-base-content truncate flex-1">{{ $camp->title }}</div>
                                <span class="text-xs font-black text-primary ml-2">{{ $progress }}%</span>
                            </div>
                            <div class="w-full h-2.5 bg-base-300 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-400 rounded-full transition-all" style="width: {{ $progress }}%"></div>
                            </div>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-[0.6rem] text-base-content/40">Rp {{ number_format($camp->collected_amount, 0, ',', '.') }} / Rp {{ number_format($camp->target_amount, 0, ',', '.') }}</span>
                                @if($progress >= 100)
                                <span class="text-[0.55rem] font-bold bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full">Tercapai ✅</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-base-content/40 py-6 text-sm">Belum ada kampanye aktif</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Bottom Row --}}
            <div class="grid grid-cols-2 gap-4 max-lg:grid-cols-1">

                {{-- Recent Transactions --}}
                <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="font-extrabold text-base-content">🧾 Transaksi Terbaru</div>
                            <a href="{{ route('admin.transactions.index') }}" class="link link-hover text-xs font-bold text-primary ml-auto flex items-center gap-1 hover:gap-1.5 transition-all">
                                Lihat Semua
                                <span class="text-xs">→</span>
                            </a>
                        </div>

                        <div class="divide-y divide-base-200/60">
                            @forelse($recentDonations as $txn)
                            <div class="flex items-center gap-3 py-3 first:pt-0 last:pb-0">
                                <div class="w-8 h-8 rounded-full bg-primary/10 text-primary font-bold text-xs flex items-center justify-center flex-shrink-0 uppercase">{{ substr($txn->donor_name, 0, 1) }}</div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold text-sm text-base-content truncate">{{ $txn->donor_name }}</div>
                                    <div class="text-xs text-base-content/40 truncate">{{ $txn->campaign->title ?? '-' }}</div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <div class="font-bold text-primary text-sm">Rp {{ number_format($txn->amount, 0, ',', '.') }}</div>
                                    @php
                                        $badgeClass = $txn->status === 'success' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($txn->status === 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-rose-50 text-rose-700 border-rose-200');
                                        $badgeText = $txn->status === 'success' ? 'Sukses' : ($txn->status === 'pending' ? 'Tertunda' : 'Gagal');
                                    @endphp
                                    <span class="inline-block text-[0.6rem] font-bold px-2 py-0.5 rounded-full border {{ $badgeClass }} mt-0.5">{{ $badgeText }}</span>
                                </div>
                            </div>
                            @empty
                            <div class="text-center text-base-content/40 py-8 text-sm">Belum ada transaksi</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Child Status Detail --}}
                <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                    <div class="p-5">
                        <div class="font-extrabold text-base-content mb-4">📊 Rincian Anak Asuh</div>

                        <div class="space-y-3">
                            <div class="bg-base-200/50 rounded-lg px-4 py-3">
                                <div class="flex items-center justify-between mb-1.5">
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="w-2.5 h-2.5 rounded-full bg-brand-500"></span>
                                        <span class="font-bold text-base-content">Tersedia</span>
                                    </div>
                                    <span class="font-black text-brand-600">{{ $tersedia }}</span>
                                </div>
                                <div class="w-full h-2 bg-base-300 rounded-full overflow-hidden">
                                    <div class="h-full bg-brand-500 rounded-full transition-all" style="width: {{ $totalAnak > 0 ? ($tersedia/$totalAnak)*100 : 0 }}%"></div>
                                </div>
                                <div class="text-[0.6rem] text-base-content/30 mt-1">{{ $totalAnak > 0 ? round($tersedia/$totalAnak*100) : 0 }}% dari total</div>
                            </div>

                            <div class="bg-base-200/50 rounded-lg px-4 py-3">
                                <div class="flex items-center justify-between mb-1.5">
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="w-2.5 h-2.5 rounded-full bg-primary"></span>
                                        <span class="font-bold text-base-content">Sedang Diasuh</span>
                                    </div>
                                    <span class="font-black text-primary">{{ $diasuh }}</span>
                                </div>
                                <div class="w-full h-2 bg-base-300 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full transition-all" style="width: {{ $totalAnak > 0 ? ($diasuh/$totalAnak)*100 : 0 }}%"></div>
                                </div>
                                <div class="text-[0.6rem] text-base-content/30 mt-1">{{ $totalAnak > 0 ? round($diasuh/$totalAnak*100) : 0 }}% dari total</div>
                            </div>

                            @if($lainnya > 0)
                            <div class="bg-base-200/50 rounded-lg px-4 py-3">
                                <div class="flex items-center justify-between mb-1.5">
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="w-2.5 h-2.5 rounded-full bg-brand-300"></span>
                                        <span class="font-bold text-base-content">Status Lainnya</span>
                                    </div>
                                    <span class="font-black text-brand-500">{{ $lainnya }}</span>
                                </div>
                                <div class="w-full h-2 bg-base-300 rounded-full overflow-hidden">
                                    <div class="h-full bg-brand-300 rounded-full transition-all" style="width: {{ $totalAnak > 0 ? ($lainnya/$totalAnak)*100 : 0 }}%"></div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="mt-4 pt-4 border-t border-base-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-[0.65rem] font-bold text-base-content/40 uppercase tracking-wider">Transaksi Pending</div>
                                    <div class="text-xl font-black text-base-content mt-0.5">{{ $pendingCount ?? 0 }} <span class="text-xs font-bold text-base-content/30">transaksi</span></div>
                                </div>
                                @if($pendingCount > 0)
                                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm bg-primary text-white hover:bg-primary/90 border-0 font-bold rounded-lg shadow-sm">Proses Sekarang →</a>
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
        gradient.addColorStop(0, 'rgba(45,125,98,0.18)');
        gradient.addColorStop(1, 'rgba(45,125,98,0)');

        cashflowChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Dana Masuk (Rp)',
                    data,
                    borderColor: '#2d7d62',
                    borderWidth: 2.5,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.42,
                    pointBackgroundColor: '#2d7d62',
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
                        grid: { color: '#f0f4f2' },
                        ticks: { color: '#2d7d62', font: { size: 11, weight: '600' } }
                    },
                    y: {
                        grid: { color: '#f0f4f2' },
                        ticks: {
                            color: '#2d7d62',
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
            b.classList.remove('bg-primary/10', 'text-primary');
            b.classList.add('btn-ghost', 'text-base-content/40');
        });
        btn.classList.remove('btn-ghost', 'text-base-content/40');
        btn.classList.add('bg-primary/10', 'text-primary');
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
                    backgroundColor: ['#89b5a1', '#2d7d62', '#b8d5c8'],
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
            { label: 'Tersedia', count: tersedia, color: '#89b5a1' },
            { label: 'Diasuh',   count: diasuh,   color: '#2d7d62' },
        ];
        if (lainnya > 0) items.push({ label: 'Lainnya', count: lainnya, color: '#b8d5c8' });

        const legend = document.getElementById('donut-legend');
        items.forEach(item => {
            const pct = total > 0 ? Math.round(item.count / total * 100) : 0;
            legend.innerHTML += `
                <div class="flex items-center gap-2.5 py-2 border-b border-base-200 text-sm">
                    <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background:${item.color};"></span>
                    <span class="font-bold text-base-content flex-1">${item.label}</span>
                    <span class="font-black text-base-content">${item.count}</span>
                    <span class="text-xs text-base-content/40 ml-1">(${pct}%)</span>
                </div>`;
        });
    })();

    // ── Init cashflow ──
    buildCashflow(6);
    </script>
</x-admin-layout>
