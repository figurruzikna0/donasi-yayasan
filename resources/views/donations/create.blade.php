<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mulai Berdonasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --celadon:       #b3e093;
            --muted-olive:   #a1c181;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
            --honeydew:      #f0f7ec;
        }
        body { background: linear-gradient(135deg, #f0f7ec 0%, #e8f3e3 100%); }
        
        .custom-input:focus {
            border-color: var(--fern) !important;
            box-shadow: 0 0 0 3px rgba(118, 164, 91, 0.2);
        }
        
        .btn-donate {
            background: linear-gradient(135deg, var(--muted-olive), var(--fern));
            transition: all 0.3s ease;
        }
        .btn-donate:hover {
            background: var(--fern);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(92, 129, 72, 0.3);
        }
    </style>
</head>
<body class="font-sans antialiased py-10">
    <div class="max-w-xl mx-auto px-4">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-8 border border-white">
            
            <h2 class="text-2xl font-extrabold text-slate-800 mb-2 text-center">Formulir Donasi</h2>
            <p class="text-center text-slate-500 mb-8 text-sm">Anda akan berdonasi untuk program: <br> 
                <span class="font-bold text-fern text-lg">"{{ $campaign->title }}"</span>
            </p>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl mb-6">
                    <ul class="text-sm font-semibold">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('donations.store', $campaign->id) }}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="donor_name" required 
                           class="custom-input w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none transition">
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                    <input type="email" name="donor_email" required 
                           class="custom-input w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none transition">
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nominal Donasi (Rp)</label>
                    <input type="number" name="amount" min="1000" required 
                           class="custom-input w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none font-bold text-fern transition">
                </div>

                <button type="submit" class="btn-donate w-full text-white font-bold py-4 rounded-2xl shadow-lg uppercase tracking-wider">
                    Lanjut ke Pembayaran
                </button>
                
                <div class="mt-6 text-center">
                    <a href="/" class="text-slate-400 hover:text-fern font-medium text-sm transition">← Batal dan Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>