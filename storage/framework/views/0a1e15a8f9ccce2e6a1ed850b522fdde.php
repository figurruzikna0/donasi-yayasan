<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran Donasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="<?php echo e(config('midtrans.client_key')); ?>"></script>
</head>
<body class="font-sans antialiased flex items-center justify-center min-h-screen py-10 bg-gradient-to-br from-emerald-50 via-emerald-100 to-emerald-200">

    <div class="max-w-md w-full px-4">
        <div class="bg-white rounded-2xl shadow-lg">
            <div class="text-center p-8">

                <div class="w-20 h-20 bg-emerald-200 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-extrabold text-slate-800 mb-2">Selesaikan Donasi</h2>
                <p class="text-slate-500 text-sm mb-1">
                    Donasi untuk program
                </p>
                <p class="font-bold text-emerald-600 mb-6"><?php echo e($campaign->title); ?></p>

                <div class="bg-emerald-50 rounded-2xl p-6 mb-4 border border-emerald-200">
                    <p class="text-xs uppercase tracking-widest font-bold mb-1 text-emerald-600">
                        Nominal Donasi
                    </p>
                    <p class="text-4xl font-black text-emerald-600">
                        Rp <?php echo e(number_format($donation->amount, 0, ',', '.')); ?>

                    </p>
                </div>

                <div class="text-left rounded-2xl p-4 mb-6 text-sm bg-emerald-50 border border-emerald-200">
                    <div class="flex justify-between mb-1">
                        <span class="text-slate-500">Donatur</span>
                        <span class="font-semibold text-slate-700"><?php echo e($donation->donor_name); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Order ID</span>
                        <span class="font-mono text-xs text-slate-500"><?php echo e($donation->order_id); ?></span>
                    </div>
                </div>

                <button id="pay-button"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl w-full shadow-lg mb-4 transition-colors">
                    Pilih Metode Pembayaran
                </button>

                <a href="/" class="text-slate-400 hover:text-slate-600 font-medium text-sm text-center block underline underline-offset-2">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay('<?php echo e($snapToken); ?>', {
                onSuccess: function (result) {
                    alert('Donasi berhasil! Terima kasih atas kebaikan Anda.');
                    window.location.href = '<?php echo e(route("invoice.donation", $donation->id)); ?>';
                },
                onPending: function (result) {
                    alert('Menunggu pembayaran Anda. Silakan selesaikan sesuai instruksi.');
                    window.location.href = '<?php echo e(route("invoice.donation", $donation->id)); ?>';
                },
                onError: function (result) {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                },
                onClose: function () {
                }
            });
        });
    </script>

</body>
</html>
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/donations/payment.blade.php ENDPATH**/ ?>