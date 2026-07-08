<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Sponsorship - {{ $sponsorship->order_id }}</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body { background: white !important; }
            .no-print { display: none !important; }
            .print-only { display: block !important; }
        }
        .print-only { display: none; }
    </style>
</head>
<body class="bg-base-200 font-sans antialiased">
    <div class="max-w-3xl mx-auto p-6">
        <div class="no-print flex justify-end mb-4 gap-2">
            <a href="{{ route('invoice.sponsorship.pdf', $sponsorship->id) }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white font-bold border-0">
                ⬇️ Download PDF
            </a>
            <a href="{{ url('/dashboard') }}" class="btn btn-outline">
                ← Kembali
            </a>
        </div>

        <div class="card bg-base-100 shadow-lg border border-emerald-200">
            <div class="card-body p-8">
                {{-- Header --}}
                <div class="flex items-start justify-between border-b border-emerald-100 pb-6 mb-6">
                    <div>
                        <h1 class="text-2xl font-black text-emerald-700">INVOICE</h1>
                        <p class="text-sm text-emerald-500 mt-1">Bukti Sponsorship Orang Tua Asuh</p>
                    </div>
                    <div class="text-right">
                        @if($profil?->logo)
                            <img src="{{ asset('storage/' . $profil->logo) . '?v=' . now()->timestamp }}" class="h-12 w-12 rounded-full object-cover border border-emerald-200 ml-auto mb-2" alt="Logo">
                        @endif
                        <p class="font-bold text-emerald-700 text-sm">{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</p>
                        <p class="text-xs text-emerald-400">{{ $profil?->alamat ?? '-' }}</p>
                    </div>
                </div>

                {{-- Info --}}
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-xs text-emerald-600 font-bold uppercase tracking-wider mb-1">Invoice Kepada</p>
                        <p class="font-bold text-emerald-700">{{ $sponsorship->donor_name }}</p>
                        <p class="text-sm text-emerald-500">{{ $sponsorship->donor_email }}</p>
                        @if($sponsorship->donor_phone)
                            <p class="text-sm text-emerald-500">{{ $sponsorship->donor_phone }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-emerald-600 font-bold uppercase tracking-wider mb-1">Detail Invoice</p>
                        <p class="text-sm"><span class="text-emerald-500">Order ID:</span> <span class="font-mono font-bold text-emerald-700">{{ $sponsorship->order_id }}</span></p>
                        <p class="text-sm"><span class="text-emerald-500">Tanggal:</span> <span class="font-bold text-emerald-700">{{ $sponsorship->created_at ? $sponsorship->created_at->format('d M Y H:i') : '-' }}</span></p>
                        <p class="text-sm"><span class="text-emerald-500">Status:</span>
                            @php
                                $isExpired = $sponsorship->expires_at && $sponsorship->expires_at->isPast();
                                $sLabel = match(true) {
                                    $sponsorship->status === 'success' && !$isExpired => 'AKTIF',
                                    $sponsorship->status === 'pending' => 'TERTUNDA',
                                    $sponsorship->status === 'success' && $isExpired => 'KADALUARSA',
                                    default => 'GAGAL',
                                };
                                $sBadge = match(true) {
                                    $sponsorship->status === 'success' && !$isExpired => 'badge-success',
                                    $sponsorship->status === 'pending' => 'badge-warning',
                                    default => 'badge-error',
                                };
                            @endphp
                            <span class="badge {{ $sBadge }} badge-sm">{{ $sLabel }}</span>
                        </p>
                    </div>
                </div>

                {{-- Table --}}
                <table class="table w-full border border-emerald-100 mb-6">
                    <thead>
                        <tr class="bg-emerald-50">
                            <th class="text-emerald-700 text-sm">Deskripsi</th>
                            <th class="text-emerald-700 text-sm text-right">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p class="font-bold text-emerald-700">Sponsorship {{ $sponsorship->fosterChild?->name ?? 'Anak Asuh' }}</p>
                                <p class="text-xs text-emerald-400">Paket: {{ $sponsorship->package ?? '-' }}</p>
                                <p class="text-xs text-emerald-400">Metode Pembayaran: {{ $sponsorship->payment_method ?? '-' }}</p>
                                @if($sponsorship->starts_at && $sponsorship->expires_at)
                                    <p class="text-xs text-emerald-400">Periode: {{ $sponsorship->starts_at->format('d M Y') }} – {{ $sponsorship->expires_at->format('d M Y') }}</p>
                                @endif
                            </td>
                            <td class="text-right font-black text-emerald-700 text-lg">
                                Rp {{ number_format($sponsorship->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-emerald-50">
                            <th class="text-emerald-700">Total</th>
                            <th class="text-right text-emerald-700 text-lg">
                                Rp {{ number_format($sponsorship->amount, 0, ',', '.') }}
                            </th>
                        </tr>
                    </tfoot>
                </table>

                {{-- Footer --}}
                <div class="border-t border-emerald-100 pt-6 text-center text-sm text-emerald-400">
                    <p>Terima kasih telah menjadi Orang Tua Asuh. Keberkahan untuk Anda dan anak asuh.</p>
                    <p class="mt-1 font-semibold text-emerald-600">— {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }} —</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
