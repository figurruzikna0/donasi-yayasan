<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="px-4 sm:px-0">
                <h2 class="text-2xl font-extrabold text-emerald-700 leading-tight">
                    Dashboard Donatur {{ $profil->nama_yayasan ?? 'Yayasan' }}
                </h2>
                <p class="text-sm mt-1 text-emerald-500">Pantau riwayat sedekah dan kontribusi Anda.</p>
            </div>

            <div class="card bg-base-100 shadow-md border border-emerald-100">
                <div class="card-body">
                    <h3 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>Riwayat Sedekah</span>
                    </h3>

                    @if($donations->isEmpty())
                        <div class="text-center py-14">
                            <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <p class="font-semibold text-emerald-700 mb-1">Belum ada catatan sedekah</p>
                            <p class="text-sm text-emerald-500 mb-5">Yuk, mulai donasi pertamamu dan ukir kebaikan hari ini!</p>
                            <a href="/#kampanye" class="btn btn-success">Mulai Donasi</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kampanye</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donations as $donasi)
                                        <tr>
                                            <td class="text-emerald-500">{{ $donasi->created_at->format('d M Y') }}</td>
                                            <td class="font-semibold text-emerald-700">{{ $donasi->campaign->title ?? 'Donasi Umum' }}</td>
                                            <td class="font-bold text-emerald-600">Rp {{ number_format($donasi->amount, 0, ',', '.') }}</td>
                                            <td>
                                                @if($donasi->status == 'Sukses')
                                                    <span class="badge badge-success gap-1.5">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>Sukses
                                                    </span>
                                                @elseif($donasi->status == 'Tertunda')
                                                    <span class="badge badge-warning gap-1.5">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>Tertunda
                                                    </span>
                                                @else
                                                    <span class="badge badge-soft gap-1.5">{{ $donasi->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>