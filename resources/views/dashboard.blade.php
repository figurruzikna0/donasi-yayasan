<x-app-layout>
    <div class="bg-base-200 min-h-0">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-500 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">🌿 Selamat Datang, {{ $user->name }}</h1>
                        <p class="text-emerald-100 text-sm mt-1">{{ $profil->nama_yayasan ?? 'Baitul Yatim' }} — Dashboard Donatur</p>
                    </div>
                    @if($profil?->logo)
                        <img src="{{ asset('storage/' . $profil->logo) }}" class="h-14 w-14 rounded-xl object-cover border-2 border-white/20" alt="Logo">
                    @endif
                </div>

                <div class="stats bg-white/10 text-white shadow-none mt-6 flex-wrap">
                    <div class="stat">
                        <div class="stat-title text-emerald-200">Total Donasi Saya</div>
                        <div class="stat-value text-white">Rp {{ number_format($totalDonated, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat">
                        <div class="stat-title text-emerald-200">Sponsorship Aktif</div>
                        <div class="stat-value text-white">{{ $activeSponsorships }}</div>
                    </div>
                    <div class="stat">
                        <div class="stat-title text-emerald-200">Transaksi Donasi</div>
                        <div class="stat-value text-white">{{ $donations->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="#kampanye-donasi" class="card bg-base-100 shadow-md border border-emerald-200 hover:shadow-lg transition-all">
                    <div class="card-body flex-row items-center gap-4 p-5">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">💰</div>
                        <div>
                            <h3 class="font-bold text-emerald-700">Donasi Sekarang</h3>
                            <p class="text-sm text-emerald-500">Salurkan donasi ke program pilihan</p>
                        </div>
                    </div>
                </a>
                <a href="#program-ota" class="card bg-base-100 shadow-md border border-emerald-200 hover:shadow-lg transition-all">
                    <div class="card-body flex-row items-center gap-4 p-5">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">🤝</div>
                        <div>
                            <h3 class="font-bold text-emerald-700">Jadi Orang Tua Asuh</h3>
                            <p class="text-sm text-emerald-500">Sponsorship anak asuh yatim</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- ════════════════ 1. PROFIL YAYASAN ════════════════ --}}
            <div id="profil-yayasan" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>🏛️ Profil Yayasan</span>
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-4">
                            @if($profil)
                                <div>
                                    <h3 class="font-bold text-emerald-700 text-lg">{{ $profil->nama_yayasan }}</h3>
                                    <p class="text-sm text-emerald-500 mt-1">{{ $profil->alamat }}</p>
                                </div>
                                <div class="flex flex-wrap gap-4 text-sm">
                                    @if($profil->no_telp)<span class="badge badge-ghost">📞 {{ $profil->no_telp }}</span>@endif
                                    @if($profil->email)<span class="badge badge-ghost">✉️ {{ $profil->email }}</span>@endif
                                </div>
                                @if($profil->sejarah_yayasan)
                                    <div>
                                        <h4 class="font-bold text-emerald-600 text-sm uppercase tracking-wider mb-1">Sejarah</h4>
                                        <p class="text-sm text-base-content/70">{{ Str::limit($profil->sejarah_yayasan, 300) }}</p>
                                    </div>
                                @endif
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @if($profil->visi)
                                        <div class="bg-emerald-50 rounded-lg p-4 border border-emerald-100">
                                            <h4 class="font-bold text-emerald-700 text-sm mb-1">Visi</h4>
                                            <p class="text-sm text-base-content/70">{{ $profil->visi }}</p>
                                        </div>
                                    @endif
                                    @if($profil->misi)
                                        <div class="bg-emerald-50 rounded-lg p-4 border border-emerald-100">
                                            <h4 class="font-bold text-emerald-700 text-sm mb-1">Misi</h4>
                                            <p class="text-sm text-base-content/70">{{ $profil->misi }}</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <p class="text-base-content/60 text-sm">Data profil yayasan belum tersedia.</p>
                            @endif
                        </div>
                        @if($profil?->logo)
                            <div class="flex items-center justify-center">
                                <img src="{{ asset('storage/' . $profil->logo) }}" class="max-h-40 rounded-xl shadow" alt="Logo Yayasan">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ════════════════ 2. BERITA KEGIATAN ════════════════ --}}
            <div id="berita-kegiatan" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>📰 Berita &amp; Kegiatan</span>
                    </h2>

                    @if($newsList->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($newsList as $news)
                                <a href="{{ route('news.show', $news->slug) }}" class="card bg-base-100 border border-emerald-100 shadow-sm hover:shadow-lg transition-all group">
                                    @if($news->foto_utama)
                                        <figure class="h-40 overflow-hidden">
                                            <img src="{{ asset('storage/' . $news->foto_utama) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $news->judul }}">
                                        </figure>
                                    @endif
                                    <div class="card-body p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            @if($news->kategori)<span class="badge badge-success badge-sm">{{ $news->kategori }}</span>@endif
                                            @if($news->tanggal_kegiatan)<span class="text-xs text-emerald-400">{{ $news->tanggal_kegiatan->format('d M Y') }}</span>@endif
                                        </div>
                                        <h3 class="font-bold text-sm text-emerald-700 group-hover:text-emerald-500 transition-colors">{{ $news->judul }}</h3>
                                        @if($news->ringkasan)<p class="text-xs text-base-content/60 mt-1">{{ Str::limit($news->ringkasan, 100) }}</p>@endif
                                        @if($news->lokasi)<p class="text-xs text-emerald-400 mt-2">📍 {{ $news->lokasi }}</p>@endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-base-content/60 text-sm text-center py-6">Belum ada berita kegiatan.</p>
                    @endif
                </div>
            </div>

            {{-- ════════════════ 3. LEGALITAS & STRUKTUR ════════════════ --}}
            <div id="legalitas-struktur" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>📜 Legalitas &amp; Struktur Organisasi</span>
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        @if($profil)
                            <div class="space-y-3">
                                <h3 class="font-bold text-emerald-600 text-sm uppercase tracking-wider">Dokumen Legalitas</h3>
                                @if($profil->legalitas)
                                    <p class="text-sm text-base-content/70">{{ $profil->legalitas }}</p>
                                @endif
                                @if($profil->foto_legalitas)
                                    <a href="{{ asset('storage/' . $profil->foto_legalitas) }}" target="_blank" class="block">
                                        <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" class="max-h-48 rounded-lg border border-emerald-200 shadow-sm" alt="Dokumen Legalitas">
                                    </a>
                                @else
                                    <p class="text-sm text-base-content/60 italic">Dokumen legalitas belum diupload.</p>
                                @endif
                            </div>
                            <div class="space-y-3">
                                <h3 class="font-bold text-emerald-600 text-sm uppercase tracking-wider">Struktur Organisasi</h3>
                                @if($profil->foto_struktur)
                                    <a href="{{ asset('storage/' . $profil->foto_struktur) }}" target="_blank" class="block">
                                        <img src="{{ asset('storage/' . $profil->foto_struktur) }}" class="max-h-48 rounded-lg border border-emerald-200 shadow-sm" alt="Struktur Organisasi">
                                    </a>
                                @else
                                    <p class="text-sm text-base-content/60 italic">Bagan struktur belum diupload.</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ════════════════ 4. PENGURUS YAYASAN ════════════════ --}}
            <div id="pengurus" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>👥 Pengurus Yayasan</span>
                    </h2>

                    @if($pendiris->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($pendiris as $p)
                                <div class="card bg-base-100 border border-emerald-100 shadow-sm">
                                    <div class="card-body items-center text-center p-5">
                                        <div class="avatar">
                                            <div class="w-20 rounded-full ring ring-emerald-200 ring-offset-2">
                                                @if($p->foto)
                                                    <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($p->nama) }}&background=b3e093&color=5c8148&bold=true" alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <h3 class="font-bold text-emerald-700 mt-3">{{ $p->nama }}</h3>
                                        <span class="badge badge-success badge-sm">{{ $p->jabatan }}</span>
                                        @if($p->deskripsi)
                                            <p class="text-xs text-base-content/60 mt-2">{{ Str::limit($p->deskripsi, 100) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-base-content/60 text-sm text-center py-6">Data pengurus belum tersedia.</p>
                    @endif
                </div>
            </div>

            {{-- ════════════════ 5. KAMPANYE DONASI & TRANSAKSI ════════════════ --}}
            <div id="kampanye-donasi" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>💰 Kampanye Donasi &amp; Transaksi Saya</span>
                    </h2>

                    {{-- Active Campaigns --}}
                    @if($campaigns->isNotEmpty())
                        <h3 class="font-bold text-emerald-600 text-sm uppercase tracking-wider mb-3">Program Donasi Aktif</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            @foreach($campaigns as $camp)
                                <div class="card bg-base-100 border border-emerald-100 shadow-sm">
                                    @if($camp->image)
                                        <figure class="h-36 overflow-hidden">
                                            <img src="{{ asset('storage/' . $camp->image) }}" class="w-full h-full object-cover" alt="{{ $camp->title }}">
                                        </figure>
                                    @endif
                                    <div class="card-body p-4">
                                        <h3 class="font-bold text-sm text-emerald-700">{{ $camp->title }}</h3>
                                        <p class="text-xs text-base-content/60 mt-1">{{ Str::limit($camp->description, 80) }}</p>
                                        <div class="mt-3">
                                            <div class="flex justify-between text-xs text-emerald-500 mb-1">
                                                <span>Terkumpul</span>
                                                <span class="font-bold">Rp {{ number_format($camp->collected_amount, 0, ',', '.') }} / Rp {{ number_format($camp->target_amount, 0, ',', '.') }}</span>
                                            </div>
                                            <progress class="progress progress-success w-full" value="{{ $camp->collected_amount }}" max="{{ $camp->target_amount }}"></progress>
                                        </div>
                                        <a href="{{ route('donations.create', $camp->id) }}" class="btn btn-success btn-sm text-white font-bold mt-3 w-full">Donasi Sekarang</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6 mb-4 bg-emerald-50 rounded-lg border border-emerald-100">
                            <p class="font-semibold text-emerald-700">Belum ada program donasi aktif</p>
                            <p class="text-sm text-emerald-500 mt-1">Nantikan program donasi terbaru dari yayasan.</p>
                        </div>
                    @endif

                    {{-- My Donation History --}}
                    <h3 class="font-bold text-emerald-600 text-sm uppercase tracking-wider mb-3">Riwayat Donasi Saya</h3>
                    @if($donations->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kampanye</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donations as $d)
                                        <tr>
                                            <td class="text-xs">{{ $d->created_at->format('d M Y H:i') }}</td>
                                            <td class="text-sm font-semibold text-emerald-700">{{ $d->campaign?->title ?? '-' }}</td>
                                            <td class="font-bold text-emerald-600">Rp {{ number_format($d->amount, 0, ',', '.') }}</td>
                                            <td>
                                                @php
                                                    $bClass = $d->status == 'success' ? 'badge-success' : ($d->status == 'pending' ? 'badge-warning' : 'badge-error');
                                                    $bText = $d->status == 'success' ? 'Sukses' : ($d->status == 'pending' ? 'Tertunda' : 'Gagal');
                                                @endphp
                                                <span class="badge {{ $bClass }} badge-sm">{{ $bText }}</span>
                                            </td>
                                            <td>
                                                @if($d->status === 'success')
                                                    <a href="{{ route('invoice.donation', $d->id) }}" target="_blank" class="btn btn-ghost btn-xs text-emerald-600 hover:bg-emerald-50">
                                                        📄 Invoice
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 bg-emerald-50 rounded-lg border border-emerald-100">
                            <p class="font-semibold text-emerald-700 mb-1">Belum ada riwayat donasi</p>
                            <p class="text-sm text-emerald-500">Yuk, mulai donasi pertamamu dari program di atas!</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ════════════════ 6. ANAK ASUH & SPONSOR ════════════════ --}}
            <div id="program-ota" class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>🤝 Program Orang Tua Asuh</span>
                    </h2>

                    {{-- Stats --}}
                    <div class="stats shadow mb-6 w-full">
                        <div class="stat">
                            <div class="stat-title">Total Anak Asuh</div>
                            <div class="stat-value text-emerald-700">{{ $totalFoster }}</div>
                        </div>
                        <div class="stat">
                            <div class="stat-title">Tersedia</div>
                            <div class="stat-value text-emerald-700">{{ $tersediaFoster }}</div>
                        </div>
                        <div class="stat">
                            <div class="stat-title">Sedang Diasuh</div>
                            <div class="stat-value text-emerald-700">{{ $diasuhFoster }}</div>
                        </div>
                    </div>

                    {{-- Available children --}}
                    @if($fosterChildren->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            @foreach($fosterChildren as $child)
                                <div class="card bg-base-100 border border-emerald-100 shadow-sm">
                                    <div class="card-body p-4">
                                        <div class="flex items-center gap-3 mb-3">
                                            <div class="avatar">
                                                <div class="w-14 rounded-full ring ring-emerald-100">
                                                    @if($child->photo)
                                                        <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->name }}">
                                                    @else
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($child->name) }}&background=b3e093&color=5c8148&bold=true" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <h3 class="font-bold text-emerald-700">{{ $child->name }}</h3>
                                                <div class="flex gap-1 mt-1">
                                                    <span class="badge badge-ghost badge-xs">{{ $child->age }} Thn</span>
                                                    @if($child->jenis_kelamin)
                                                        <span class="badge badge-ghost badge-xs">{{ $child->jenis_kelamin }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if($child->description)
                                            <p class="text-xs text-base-content/60 mb-3">{{ Str::limit($child->description, 100) }}</p>
                                        @endif
                                        @if($child->status == 'Tersedia')
                                            <a href="{{ route('sponsor.form', $child->id) }}" class="btn btn-success btn-sm text-white font-bold w-full">🤝 Asuh Sekarang</a>
                                        @else
                                            <span class="btn btn-disabled btn-sm w-full">✓ Sudah Diasuh</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($fosterChildren->hasPages())
                            <div class="mt-4">{{ $fosterChildren->links() }}</div>
                        @endif
                    @else
                        <div class="text-center py-8 bg-emerald-50 rounded-lg border border-emerald-100 mb-6">
                            <p class="font-semibold text-emerald-700">Belum ada data anak asuh</p>
                        </div>
                    @endif

                    {{-- My Sponsorship History --}}
                    <h3 class="font-bold text-emerald-600 text-sm uppercase tracking-wider mb-3">Sponsorship Saya</h3>
                    @if($sponsorships->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>Anak Asuh</th>
                                        <th>Paket</th>
                                        <th>Nominal</th>
                                        <th>Periode</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sponsorships as $s)
                                        @php
                                            $isExpired = $s->expires_at && $s->expires_at->isPast();
                                            $sClass = $s->status == 'success' && !$isExpired ? 'badge-success' : ($s->status == 'pending' ? 'badge-warning' : ($isExpired || $s->status == 'expired' ? 'badge-ghost' : 'badge-error'));
                                            $sText = $s->status == 'success' && !$isExpired ? 'Aktif' : ($s->status == 'pending' ? 'Pending' : ($isExpired ? 'Kadaluarsa' : 'Gagal'));
                                        @endphp
                                        <tr>
                                            <td class="text-sm font-semibold text-emerald-700">{{ $s->fosterChild?->name ?? '-' }}</td>
                                            <td><span class="badge badge-warning badge-sm">{{ $s->package ?? '-' }}</span></td>
                                            <td class="font-bold text-emerald-600">Rp {{ number_format($s->amount, 0, ',', '.') }}</td>
                                            <td class="text-xs">
                                                {{ $s->starts_at ? $s->starts_at->format('d/m/Y') : '-' }}
                                                @if($s->expires_at) – {{ $s->expires_at->format('d/m/Y') }} @endif
                                            </td>
                                            <td><span class="badge {{ $sClass }} badge-sm">{{ $sText }}</span></td>
                                            <td>
                                                @if($s->status === 'success')
                                                    <a href="{{ route('invoice.sponsorship', $s->id) }}" target="_blank" class="btn btn-ghost btn-xs text-emerald-600 hover:bg-emerald-50">
                                                        📄 Invoice
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 bg-emerald-50 rounded-lg border border-emerald-100">
                            <p class="font-semibold text-emerald-700 mb-1">Belum ada sponsorship</p>
                            <p class="text-sm text-emerald-500">Pilih anak asuh di atas untuk menjadi Orang Tua Asuh.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ════════════════════ LAPORAN PERKEMBANGAN ANAK ════════════════════ --}}
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>📈 Laporan Perkembangan Anak</span>
                    </h2>

                    @if($childDevelopments->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach($childDevelopments as $dev)
                                <div class="border border-emerald-100 rounded-xl overflow-hidden bg-white hover:shadow-md transition-shadow">
                                    @if($dev->foto)
                                        <img src="{{ asset('storage/' . $dev->foto) }}" alt="{{ $dev->judul }}" class="w-full h-48 object-cover">
                                    @endif
                                    <div class="p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="badge badge-success badge-sm">{{ $dev->fosterChild?->name ?? '-' }}</span>
                                            <span class="text-xs text-emerald-400">{{ $dev->tanggal ? $dev->tanggal->format('d M Y') : '-' }}</span>
                                        </div>
                                        <h3 class="font-bold text-emerald-700 text-sm mb-1">{{ $dev->judul }}</h3>
                                        <p class="text-xs text-gray-500 leading-relaxed">{{ $dev->deskripsi }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($childDevelopments->hasPages())
                            <div class="mt-5">{{ $childDevelopments->links() }}</div>
                        @endif
                    @else
                        <div class="text-center py-8 bg-emerald-50 rounded-lg border border-emerald-100">
                            <p class="font-semibold text-emerald-700 mb-1">Belum ada laporan perkembangan</p>
                            <p class="text-sm text-emerald-500">Admin akan mengirimkan laporan perkembangan anak asuh Anda secara berkala.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
