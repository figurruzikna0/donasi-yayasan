<x-app-layout>
    <div class="bg-base-200 min-h-0">
        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-500 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">📋 Rekap Transaksi</h1>
                        <p class="text-emerald-100 text-sm mt-1">Riwayat donasi, sponsorship, dan perkembangan anak asuh</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline border-white text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- ════════════════ STATS ════════════════ --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 text-xl shrink-0">💰</div>
                    <div>
                        <div class="text-emerald-600 text-xs uppercase tracking-wider font-bold">Total Donasi</div>
                        <div class="text-emerald-700 text-2xl font-black">Rp {{ number_format($donations->where('status', 'success')->sum('amount'), 0, ',', '.') }}</div>
                        <div class="text-gray-400 text-xs">{{ $donations->count() }} transaksi</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 text-xl shrink-0">🤝</div>
                    <div>
                        <div class="text-emerald-600 text-xs uppercase tracking-wider font-bold">Sponsorship Aktif</div>
                        <div class="text-emerald-700 text-2xl font-black">{{ $sponsorships->where('status', 'success')->count() }}</div>
                        <div class="text-gray-400 text-xs">{{ $sponsorships->count() }} total sponsorship</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 text-xl shrink-0">📈</div>
                    <div>
                        <div class="text-emerald-600 text-xs uppercase tracking-wider font-bold">Laporan Perkembangan</div>
                        <div class="text-emerald-700 text-2xl font-black">{{ $childDevelopments->count() }}</div>
                        <div class="text-gray-400 text-xs">update dari yayasan</div>
                    </div>
                </div>
            </div>

            {{-- ════════════════ TAB NAV ════════════════ --}}
            <div class="border-b border-emerald-200" id="tabNav">
                <div class="flex gap-0 -mb-px">
                    <button class="tab-btn px-5 py-3.5 text-sm sm:text-base font-bold transition-all duration-200 border-b-2 border-emerald-600 text-emerald-700" data-tab="donasi" onclick="switchTab('donasi')">
                        💰 Donasi
                    </button>
                    <button class="tab-btn px-5 py-3.5 text-sm sm:text-base font-bold transition-all duration-200 border-b-2 border-transparent text-gray-400 hover:text-emerald-600 hover:border-emerald-300" data-tab="sponsorship" onclick="switchTab('sponsorship')">
                        🤝 Sponsorship &amp; Anak Asuh
                    </button>
                    <button class="tab-btn px-5 py-3.5 text-sm sm:text-base font-bold transition-all duration-200 border-b-2 border-transparent text-gray-400 hover:text-emerald-600 hover:border-emerald-300" data-tab="perkembangan" onclick="switchTab('perkembangan')">
                        📈 Perkembangan Anak
                    </button>
                </div>
            </div>

            {{-- ═══════════ TAB: DONASI ═══════════ --}}
            <div id="tab-donasi" class="bg-white rounded-b-xl shadow-sm border border-t-0 border-emerald-200">
                <div class="p-6">
                    @if($donations->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <thead>
                                    <tr class="bg-emerald-50">
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Tanggal</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Program</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Metode</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600 text-right">Nominal</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Status</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donations as $d)
                                        <tr class="hover:bg-emerald-50/50 transition-colors">
                                            <td class="text-xs text-gray-500 whitespace-nowrap">{{ $d->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-sm font-semibold text-emerald-700">{{ $d->campaign?->title ?? '-' }}</td>
                                            <td class="text-xs text-gray-500">{{ $d->payment_method ?? '-' }}</td>
                                            <td class="font-bold text-emerald-600 text-right whitespace-nowrap">Rp {{ number_format($d->amount, 0, ',', '.') }}</td>
                                            <td>
                                                @php
                                                    $bc = $d->status == 'success' ? 'badge-success' : ($d->status == 'pending' ? 'badge-warning' : 'badge-error');
                                                    $bt = $d->status == 'success' ? 'Sukses' : ($d->status == 'pending' ? 'Pending' : 'Gagal');
                                                @endphp
                                                <span class="badge {{ $bc }} badge-sm">{{ $bt }}</span>
                                            </td>
                                            <td>
                                                @if($d->status === 'success')
                                                    <a href="{{ route('invoice.donation', $d->id) }}" target="_blank" class="btn btn-ghost btn-xs text-emerald-600 hover:bg-emerald-50">📄 Invoice</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 bg-emerald-50 rounded-lg border border-emerald-100">
                            <div class="text-3xl mb-2">💰</div>
                            <p class="font-semibold text-emerald-700">Belum ada riwayat donasi</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ═══════════ TAB: SPONSORSHIP & ANAK ASUH ═══════════ --}}
            <div id="tab-sponsorship" class="hidden bg-white rounded-b-xl shadow-sm border border-t-0 border-emerald-200">
                <div class="p-6">
                    @if($sponsorships->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <thead>
                                    <tr class="bg-emerald-50">
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Anak Asuh</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Paket</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Metode</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600 text-right">Nominal</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Periode</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Status</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sponsorships as $s)
                                        @php
                                            $isExpired = $s->expires_at && $s->expires_at->isPast();
                                            $sClass = $s->status == 'success' && !$isExpired ? 'badge-success' : ($s->status == 'pending' ? 'badge-warning' : ($isExpired || $s->status == 'expired' ? 'badge-ghost' : 'badge-error'));
                                            $sText = $s->status == 'success' && !$isExpired ? 'Aktif' : ($s->status == 'pending' ? 'Pending' : ($isExpired ? 'Kadaluarsa' : 'Gagal'));
                                        @endphp
                                        <tr class="hover:bg-emerald-50/50 transition-colors">
                                            <td class="text-sm font-semibold text-emerald-700">{{ $s->fosterChild?->name ?? '-' }}</td>
                                            <td><span class="badge badge-warning badge-sm">{{ $s->package ?? '-' }}</span></td>
                                            <td class="text-xs text-gray-500">{{ $s->payment_method ?? '-' }}</td>
                                            <td class="font-bold text-emerald-600 text-right whitespace-nowrap">Rp {{ number_format($s->amount, 0, ',', '.') }}</td>
                                            <td class="text-xs text-gray-500 whitespace-nowrap">
                                                {{ $s->starts_at ? $s->starts_at->format('d/m/Y') : '-' }}
                                                @if($s->expires_at) – {{ $s->expires_at->format('d/m/Y') }} @endif
                                            </td>
                                            <td><span class="badge {{ $sClass }} badge-sm">{{ $sText }}</span></td>
                                            <td>
                                                @if($s->status === 'success')
                                                    <a href="{{ route('invoice.sponsorship', $s->id) }}" target="_blank" class="btn btn-ghost btn-xs text-emerald-600 hover:bg-emerald-50">📄 Invoice</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 bg-emerald-50 rounded-lg border border-emerald-100">
                            <div class="text-3xl mb-2">🤝</div>
                            <p class="font-semibold text-emerald-700">Belum ada sponsorship</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ═══════════ TAB: PERKEMBANGAN ANAK ═══════════ --}}
            <div id="tab-perkembangan" class="hidden bg-white rounded-b-xl shadow-sm border border-t-0 border-emerald-200">
                <div class="p-6">
                    @if($childDevelopments->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <thead>
                                    <tr class="bg-emerald-50">
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Foto</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Nama Anak</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Umur</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Keterangan</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600">Tanggal</th>
                                        <th class="text-xs uppercase tracking-wider text-emerald-600"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($childDevelopments as $dev)
                                        <tr class="hover:bg-emerald-50/50 transition-colors">
                                            <td>
                                                @if($dev->foto)
                                                    <div class="avatar">
                                                        <div class="w-14 rounded-lg ring ring-emerald-100">
                                                            <a href="{{ asset('storage/' . $dev->foto) }}" target="_blank">
                                                                <img src="{{ asset('storage/' . $dev->foto) }}" alt="{{ $dev->judul }}" class="object-cover">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="w-14 h-14 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-400 text-xs">No</div>
                                                @endif
                                            </td>
                                            <td class="font-semibold text-emerald-700">{{ $dev->fosterChild?->name ?? '-' }}</td>
                                            <td class="text-sm text-gray-500">{{ $dev->fosterChild?->age ?? '-' }} Thn</td>
                                            <td>
                                                <div class="text-sm font-semibold text-emerald-700">{{ $dev->judul }}</div>
                                                <p class="text-xs text-gray-500">{{ $dev->deskripsi }}</p>
                                            </td>
                                            <td class="text-xs text-gray-500 whitespace-nowrap">{{ $dev->tanggal ? $dev->tanggal->format('d/m/Y') : '-' }}</td>
                                            <td>
                                                <a href="{{ route('invoice.child-development.pdf', $dev->id) }}" class="btn btn-ghost btn-xs text-emerald-600 hover:bg-emerald-50">
                                                    📄 Unduh
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 bg-emerald-50 rounded-lg border border-emerald-100">
                            <div class="text-3xl mb-2">📈</div>
                            <p class="font-semibold text-emerald-700">Belum ada laporan perkembangan</p>
                            <p class="text-sm text-emerald-500 mt-1">Admin akan mengirimkan laporan perkembangan anak asuh Anda secara berkala.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>
        function switchTab(tab) {
            document.querySelectorAll('#tabNav .tab-btn').forEach(el => {
                el.classList.remove('border-emerald-600', 'text-emerald-700');
                el.classList.add('border-transparent', 'text-gray-400', 'hover:text-emerald-600', 'hover:border-emerald-300');
            });
            const btn = document.querySelector('#tabNav [data-tab="' + tab + '"]');
            btn.classList.remove('border-transparent', 'text-gray-400', 'hover:text-emerald-600', 'hover:border-emerald-300');
            btn.classList.add('border-emerald-600', 'text-emerald-700');

            document.querySelectorAll('#tab-donasi, #tab-sponsorship, #tab-perkembangan').forEach(el => el.classList.add('hidden'));
            document.getElementById('tab-' + tab).classList.remove('hidden');
        }
    </script>
</x-app-layout>
