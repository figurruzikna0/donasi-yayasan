<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran Donasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>

    <style>
        :root {
            --celadon:       #b3e093;
            --lime-cream:    #d6ec89;
            --muted-olive:   #a1c181;
            --muted-olive-2: #8bb650;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
        }

        body {
            background: linear-gradient(135deg, #f0f7ec 0%, var(--celadon) 100%);
        }

        .btn-pay {
            background: linear-gradient(135deg, var(--muted-olive-2), var(--fern));
            transition: all 0.3s ease;
        }
        .btn-pay:hover {
            background: linear-gradient(135deg, var(--fern), #4a683a);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(92, 129, 72, 0.3);
        }

        .icon-box        { background-color: var(--celadon); color: var(--fern); }
        .text-accent     { color: var(--fern); }
        .bg-accent-light { background-color: rgba(179, 224, 147, 0.2); }
    </style>
</head>
<body class="font-sans antialiased flex items-center justify-center min-h-screen py-10">

    <div class="max-w-md w-full px-4">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden text-center p-8 border border-white">

            {{-- Icon --}}
            <div class="w-20 h-20 icon-box rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>

            {{-- Judul --}}
            <h2 class="text-2xl font-extrabold text-slate-800 mb-2">Selesaikan Donasi</h2>
            <p class="text-slate-500 text-sm mb-1">
                Donasi untuk program
            </p>
            <p class="font-bold text-accent mb-6">{{ $campaign->title }}</p>

            {{-- Nominal --}}
            <div class="bg-accent-light rounded-2xl p-6 mb-4 border" style="border-color: var(--celadon);">
                <p class="text-xs uppercase tracking-widest font-bold mb-1" style="color: var(--fern);">
                    Nominal Donasi
                </p>
                <p class="text-4xl font-black" style="color: var(--fern);">
                    Rp {{ number_format($donation->amount, 0, ',', '.') }}
                </p>
            </div>

            {{-- Info donatur --}}
            <div class="text-left rounded-2xl p-4 mb-6 text-sm" style="background:#f9fef4; border: 1px solid var(--celadon);">
                <div class="flex justify-between mb-1">
                    <span class="text-slate-500">Donatur</span>
                    <span class="font-semibold text-slate-700">{{ $donation->donor_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Order ID</span>
                    <span class="font-mono text-xs text-slate-500">{{ $donation->order_id }}</span>
                </div>
            </div>

            {{-- Tombol bayar --}}
            <button id="pay-button"
                    class="w-full btn-pay text-white font-bold py-4 rounded-2xl shadow-lg uppercase tracking-wider mb-4">
                Pilih Metode Pembayaran
            </button>

            <a href="/" class="text-slate-400 hover:text-fern font-medium text-sm transition">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    alert('Donasi berhasil! Terima kasih atas kebaikan Anda.');
                    window.location.href = '/';
                },
                onPending: function (result) {
                    alert('Menunggu pembayaran Anda. Silakan selesaikan sesuai instruksi.');
                    window.location.href = '/';
                },
                onError: function (result) {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                },
                onClose: function () {
                    // user menutup popup tanpa bayar
                }
            });
        });
    </script>

</body>
</html>