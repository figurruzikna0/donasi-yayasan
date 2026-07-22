<x-app-layout>
    <div class="bg-base-200 min-h-0">
        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-500 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">Rekap Transaksi</h1>
                        <p class="text-emerald-100 text-sm mt-1">Riwayat donasi, sponsorship, dan perkembangan anak asuh</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline border-white text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Kartu statistik: total donasi success ($donations), sponsorship aktif ($sponsorships), laporan perkembangan ($childDevelopments) --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                    </div>
                    <div>
                        <div class="text-emerald-600 text-xs uppercase tracking-wider font-bold">Total Donasi</div>
                        <div class="text-emerald-700 text-2xl font-black">Rp {{ number_format($donations->where('status', 'success')->sum('amount'), 0, ',', '.') }}</div>
                        <div class="text-gray-400 text-xs">{{ $donations->count() }} transaksi</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-emerald-600 text-xs uppercase tracking-wider font-bold">Sponsorship Aktif</div>
                        <div class="text-emerald-700 text-2xl font-black">{{ $sponsorships->where('status', 'success')->count() }}</div>
                        <div class="text-gray-400 text-xs">{{ $sponsorships->count() }} total sponsorship</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                    </div>
                    <div>
                        <div class="text-emerald-600 text-xs uppercase tracking-wider font-bold">Laporan Perkembangan</div>
                        <div class="text-emerald-700 text-2xl font-black">{{ $childDevelopments->count() }}</div>
                        <div class="text-gray-400 text-xs">update dari yayasan</div>
                    </div>
                </div>
            </div>

            {{-- Navigasi tab: Donasi | Sponsorship & Anak Asuh | Perkembangan Anak --}}
            <div class="border-b border-emerald-200" id="tabNav">
                <div class="flex gap-0 -mb-px">
                    <button class="tab-btn px-5 py-3.5 text-sm sm:text-base font-bold transition-all duration-200 border-b-2 border-emerald-600 text-emerald-700" data-tab="donasi" onclick="switchTab('donasi')">
                        Donasi
                    </button>
                    <button class="tab-btn px-5 py-3.5 text-sm sm:text-base font-bold transition-all duration-200 border-b-2 border-transparent text-gray-400 hover:text-emerald-600 hover:border-emerald-300" data-tab="sponsorship" onclick="switchTab('sponsorship')">
                        Sponsorship &amp; Anak Asuh
                    </button>
                    <button class="tab-btn px-5 py-3.5 text-sm sm:text-base font-bold transition-all duration-200 border-b-2 border-transparent text-gray-400 hover:text-emerald-600 hover:border-emerald-300" data-tab="perkembangan" onclick="switchTab('perkembangan')">
                        Perkembangan Anak
                    </button>
                </div>
            </div>

            {{-- Tab Donasi: tabel riwayat donasi user (tanggal, program, metode, nominal, status, link invoice) --}}
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
                                                    <a href="{{ route('invoice.donation', $d->id) }}" target="_blank" class="btn btn-ghost btn-xs text-emerald-600 hover:bg-emerald-50">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                                        Invoice
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 bg-emerald-50 rounded-lg border border-emerald-100">
                            <p class="font-semibold text-emerald-700">Belum ada riwayat donasi</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Tab Sponsorship: tabel sponsorship user (anak asuh, paket, nominal, periode, status, link invoice) --}}
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
                                                    <a href="{{ route('invoice.sponsorship', $s->id) }}" target="_blank" class="btn btn-ghost btn-xs text-emerald-600 hover:bg-emerald-50">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                                        Invoice
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 bg-emerald-50 rounded-lg border border-emerald-100">
                            <p class="font-semibold text-emerald-700">Belum ada sponsorship</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Tab Perkembangan: tabel laporan perkembangan anak asuh (foto, nama, umur, deskripsi, unduh PDF) --}}
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
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                                    Unduh
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12 bg-emerald-50 rounded-lg border border-emerald-100">
                            <p class="font-semibold text-emerald-700">Belum ada laporan perkembangan</p>
                            <p class="text-sm text-emerald-500 mt-1">Admin akan mengirimkan laporan perkembangan anak asuh Anda secara berkala.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- Fungsi switchTab: toggle tab Donasi / Sponsorship / Perkembangan Anak --}}
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
