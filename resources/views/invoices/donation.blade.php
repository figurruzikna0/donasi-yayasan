<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Donasi - {{ $donation->order_id }}</title>
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
            <button onclick="window.print()" class="btn btn-success text-white font-bold">
                🖨️ Cetak / Simpan PDF
            </button>
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
                        <p class="text-sm text-emerald-500 mt-1">Bukti Donasi</p>
                    </div>
                    <div class="text-right">
                        @if($profil?->logo)
                            <img src="{{ asset('storage/' . $profil->logo) }}" class="h-12 w-12 rounded-full object-cover border border-emerald-200 ml-auto mb-2" alt="Logo">
                        @endif
                        <p class="font-bold text-emerald-700 text-sm">{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</p>
                        <p class="text-xs text-emerald-400">{{ $profil?->alamat ?? '-' }}</p>
                    </div>
                </div>

                {{-- Info --}}
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-xs text-emerald-600 font-bold uppercase tracking-wider mb-1">Invoice Kepada</p>
                        <p class="font-bold text-emerald-700">{{ $donation->donor_name }}</p>
                        <p class="text-sm text-emerald-500">{{ $donation->donor_email }}</p>
                        @if($donation->donor_phone)
                            <p class="text-sm text-emerald-500">{{ $donation->donor_phone }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-emerald-600 font-bold uppercase tracking-wider mb-1">Detail Invoice</p>
                        <p class="text-sm"><span class="text-emerald-500">Order ID:</span> <span class="font-mono font-bold text-emerald-700">{{ $donation->order_id }}</span></p>
                        <p class="text-sm"><span class="text-emerald-500">Tanggal:</span> <span class="font-bold text-emerald-700">{{ $donation->created_at ? $donation->created_at->format('d M Y H:i') : '-' }}</span></p>
                        <p class="text-sm"><span class="text-emerald-500">Status:</span>
                            @if($donation->status === 'success')
                                <span class="badge badge-success badge-sm">LUNAS</span>
                            @elseif($donation->status === 'pending')
                                <span class="badge badge-warning badge-sm">TERTUNDA</span>
                            @else
                                <span class="badge badge-error badge-sm">GAGAL</span>
                            @endif
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
                                <p class="font-bold text-emerald-700">Donasi {{ $donation->campaign?->title ?? 'Program Donasi' }}</p>
                                <p class="text-xs text-emerald-400">Metode Pembayaran: {{ $donation->payment_method ?? '-' }}</p>
                            </td>
                            <td class="text-right font-black text-emerald-700 text-lg">
                                Rp {{ number_format($donation->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-emerald-50">
                            <th class="text-emerald-700">Total</th>
                            <th class="text-right text-emerald-700 text-lg">
                                Rp {{ number_format($donation->amount, 0, ',', '.') }}
                            </th>
                        </tr>
                    </tfoot>
                </table>

                {{-- Footer --}}
                <div class="border-t border-emerald-100 pt-6 text-center text-sm text-emerald-400">
                    <p>Terima kasih atas donasi Anda. Setiap rupiah berarti bagi mereka yang membutuhkan.</p>
                    <p class="mt-1 font-semibold text-emerald-600">— {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }} —</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
