<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran Sponsor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    
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

        .icon-box { background-color: var(--celadon); color: var(--fern); }
        .text-accent { color: var(--fern); }
        .bg-accent-light { background-color: rgba(179, 224, 147, 0.2); }
    </style>
</head>
<body class="font-sans antialiased flex items-center justify-center min-h-screen py-10">
    <div class="max-w-md w-full px-4">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden text-center p-8 border border-white">
            
            <div class="w-20 h-20 icon-box rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>

            <h2 class="text-2xl font-extrabold text-slate-800 mb-2">Selesaikan Sponsorship</h2>
            <p class="text-slate-500 text-sm mb-6">Satu langkah lagi untuk menjadi orang tua asuh bagi <br> <span class="font-bold text-accent">{{ $child->name }}</span>.</p>
            
            <div class="bg-accent-light rounded-2xl p-6 mb-8 border border-celadon">
                <p class="text-xs text-fern uppercase tracking-widest font-bold mb-1">Nominal Sponsorship</p>
                <p class="text-4xl font-black text-fern">Rp {{ number_format($sponsorship->amount, 0, ',', '.') }}</p>
            </div>

            <button id="pay-button" class="w-full btn-pay text-white font-bold py-4 rounded-2xl shadow-lg uppercase tracking-wider mb-4">
                Pilih Metode Pembayaran
            </button>

            <a href="/" class="text-slate-400 hover:text-fern font-medium text-sm transition">← Kembali ke Beranda</a>
        </div>
    </div>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran Berhasil! Terima kasih telah menjadi orang tua asuh.");
                    window.location.href = "/";
                },
                onPending: function(result){
                    alert("Menunggu pembayaran Anda!");
                    window.location.href = "/";
                },
                onError: function(result){
                    alert("Pembayaran Gagal!");
                },
                onClose: function(){
                    // User menutup pop-up
                }
            });
        });
    </script>
</body>
</html>