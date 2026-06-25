<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mulai Berdonasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased py-10">
    <div class="max-w-xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-8">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Formulir Donasi</h2>
            <p class="text-center text-gray-500 mb-8 text-sm">Anda akan berdonasi untuk program: <br> <span class="font-bold text-blue-600 text-lg">"{{ $campaign->title }}"</span></p>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('donations.store', $campaign->id) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap (Atau Hamba Allah)</label>
                    <input type="text" name="donor_name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                    <input type="email" name="donor_email" required class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nominal Donasi (Rp)</label>
                    <input type="number" name="amount" min="1000" required class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none font-bold text-blue-600">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 uppercase tracking-wider">
                    Lanjut ke Pembayaran
                </button>
                
                <div class="mt-6 text-center">
                    <a href="/" class="text-gray-500 hover:text-blue-600 font-medium text-sm transition">← Batal dan Kembali</a>
                </div>
            </form>

        </div>
    </div>
</body>
</html>