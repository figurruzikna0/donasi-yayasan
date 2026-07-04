<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sponsor - {{ $child->name }}</title>

    @if(config('midtrans.is_production'))
        <script src="https://app.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<div class="bg-white rounded-2xl shadow-lg max-w-md w-full p-8">
    <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full mb-4">Sponsorship</span>
    <h1 class="text-2xl font-bold text-gray-900 mb-1">Konfirmasi Pembayaran</h1>
    <p class="text-sm text-gray-500 mb-6">Silakan periksa detail sponsorship sebelum melanjutkan pembayaran.</p>

    <div class="flex justify-between items-start mb-3 text-sm">
        <span class="text-gray-500 flex-shrink-0 mr-3">Anak Asuh</span>
        <span class="text-gray-900 font-medium text-right">{{ $child->name }}</span>
    </div>
    <div class="flex justify-between items-start mb-3 text-sm">
        <span class="text-gray-500 flex-shrink-0 mr-3">Donatur</span>
        <span class="text-gray-900 font-medium text-right">{{ $sponsorship->donor_name }}</span>
    </div>
    <div class="flex justify-between items-start mb-3 text-sm">
        <span class="text-gray-500 flex-shrink-0 mr-3">Email</span>
        <span class="text-gray-900 font-medium text-right">{{ $sponsorship->donor_email }}</span>
    </div>
    <div class="flex justify-between items-start mb-3 text-sm">
        <span class="text-gray-500 flex-shrink-0 mr-3">Paket</span>
        <span class="text-gray-900 font-medium text-right">{{ $sponsorship->package }}</span>
    </div>
    <div class="flex justify-between items-start mb-3 text-sm">
        <span class="text-gray-500 flex-shrink-0 mr-3">Keterangan</span>
        <span class="text-gray-900 font-medium text-right max-w-[240px]">{{ $sponsorship->package_description }}</span>
    </div>
    <div class="flex justify-between items-start mb-3 text-sm">
        <span class="text-gray-500 flex-shrink-0 mr-3">Metode Bayar</span>
        <span class="text-gray-900 font-medium text-right">{{ $sponsorship->payment_method }}</span>
    </div>

    <div class="border-t border-gray-200 my-4"></div>

    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 my-5 flex justify-between items-center">
        <div>
            <div class="text-xs font-semibold text-emerald-700">Total Pembayaran</div>
            <div class="text-xs font-mono text-emerald-600 mt-1">{{ $sponsorship->order_id }}</div>
        </div>
        <div class="text-xl font-bold text-emerald-700">
            Rp {{ number_format($sponsorship->amount, 0, ',', '.') }}
        </div>
    </div>

    <div class="bg-amber-50 border border-amber-200 text-amber-800 text-sm rounded-xl p-4">
        💳 Anda akan diarahkan ke halaman pembayaran Midtrans. Selesaikan pembayaran dalam batas waktu yang ditentukan.
    </div>

    <button class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl w-full mt-5 transition-colors" id="pay-btn" onclick="startPayment()">
        Bayar Sekarang
    </button>

    <a href="{{ route('sponsor.form', $child->id) }}" class="text-gray-500 hover:text-gray-700 text-sm text-center block mt-4 underline underline-offset-2">
        ← Kembali
    </a>
</div>

<script>
    function startPayment() {
        const btn = document.getElementById('pay-btn');
        btn.disabled = true;
        btn.textContent = 'Memproses...';

        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert('Pembayaran berhasil! Terima kasih atas dukungan Anda.');
                window.location.href = '{{ route("invoice.sponsorship", $sponsorship->id) }}';
            },
            onPending: function(result) {
                alert('Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.');
                window.location.href = '{{ route("invoice.sponsorship", $sponsorship->id) }}';
            },
            onError: function(result) {
                alert('Pembayaran gagal. Silakan coba lagi.');
                btn.disabled = false;
                btn.textContent = 'Bayar Sekarang';
            },
            onClose: function() {
                btn.disabled = false;
                btn.textContent = 'Bayar Sekarang';
            }
        });
    }
</script>

</body>
</html>
