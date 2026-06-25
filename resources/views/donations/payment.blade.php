<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body class="bg-gray-100 font-sans antialiased flex items-center justify-center min-h-screen py-10">
    <div class="max-w-md w-full px-4">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden text-center p-8">
            
            <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>

            <h2 class="text-2xl font-extrabold text-gray-800 mb-2">Selesaikan Donasi</h2>
            <p class="text-gray-500 text-sm mb-6">Satu langkah lagi untuk berbagi kebaikan pada program <br> <span class="font-bold text-gray-700">"{{ $campaign->title }}"</span>.</p>
            
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 mb-8">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Nominal Donasi</p>
                <p class="text-3xl font-black text-blue-600">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
            </div>

            <button id="pay-button" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 uppercase tracking-wider mb-4">
                Pilih Metode Pembayaran
            </button>

            <a href="/" class="text-gray-500 hover:text-blue-600 text-sm transition">← Kembali ke Beranda</a>

        </div>
    </div>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran Berhasil! Terima kasih.");
                    window.location.href = "/";
                },
                onPending: function(result){
                    alert("Menunggu pembayaran Anda!");
                    window.location.href = "/";
                },
                onError: function(result){
                    alert("Pembayaran Gagal!");
                    window.location.href = "/";
                },
                onClose: function(){
                    alert('Anda menutup pop-up tanpa menyelesaikan pembayaran');
                }
            });
        });
    </script>
</body>
</html>