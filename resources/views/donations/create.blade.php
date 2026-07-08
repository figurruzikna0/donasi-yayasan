<x-app-layout>
    <div class="bg-base-200 min-h-0">

        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-500 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">💰 Formulir Donasi</h1>
                        <p class="text-emerald-100 text-sm mt-1">Lengkapi data diri untuk melanjutkan donasi</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline border-white text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Campaign Info --}}
            <div class="card bg-emerald-50 border border-emerald-200 shadow-sm mb-6">
                <div class="card-body p-5 flex flex-row items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-200 rounded-xl flex items-center justify-center text-2xl shrink-0">🎯</div>
                    <div>
                        <p class="text-xs text-emerald-500 uppercase tracking-wider font-bold">Program Donasi</p>
                        <h3 class="font-bold text-emerald-700 text-lg">{{ $campaign->title }}</h3>
                    </div>
                    <div class="ml-auto text-right">
                        <p class="text-xs text-emerald-500">Target</p>
                        <p class="font-bold text-emerald-700">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <x-alert type="error" :errors="$errors->all()" />
            @endif

            {{-- Form --}}
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6 sm:p-8">

                    <form action="{{ route('donations.store', $campaign->id) }}" method="POST" id="donation-form">
                        @csrf

                        {{-- Nama --}}
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Nama Lengkap <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4 text-lg">👤</span>
                                <input type="text" name="donor_name" required placeholder="Contoh: Budi Santoso"
                                       class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500" value="{{ old('donor_name') }}">
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Alamat Email <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4 text-lg">✉️</span>
                                <input type="email" name="donor_email" required placeholder="email@anda.com"
                                       class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500" value="{{ old('donor_email') }}">
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">No. WhatsApp Aktif <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4 text-lg">📞</span>
                                <input type="text" name="donor_phone" required placeholder="081234567890"
                                       class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500" value="{{ old('donor_phone') }}">
                            </div>
                            <label class="label"><span class="label-text-alt text-emerald-500">Digunakan untuk notifikasi donasi via WhatsApp</span></label>
                        </div>

                        {{-- Nominal --}}
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Nominal Donasi <span class="text-red-500">*</span></span>
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mb-3">
                                @php $nominals = [10000, 20000, 50000, 100000]; @endphp
                                @foreach($nominals as $nom)
                                    <button type="button"
                                            class="btn btn-outline border-emerald-300 text-emerald-600 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 btn-sm nominal-btn font-bold"
                                            data-nominal="{{ $nom }}"
                                            onclick="pilihNominal(this, {{ $nom }})">
                                        Rp{{ number_format($nom, 0, ',', '.') }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 font-bold px-4">Rp</span>
                                <input type="number" name="amount" id="amount-input" min="1000" required
                                       placeholder="Isi nominal lainnya"
                                       class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500 font-bold text-emerald-700"
                                       oninput="resetNominalPills()">
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Metode Pembayaran <span class="text-red-500">*</span></span>
                            </label>
                            <select name="payment_method" class="select select-bordered w-full border-emerald-200 focus:border-emerald-500" required>
                                <option value="" disabled {{ old('payment_method') ? '' : 'selected' }}>-- Pilih Metode Pembayaran --</option>
                                <option value="BCA VA" {{ old('payment_method') == 'BCA VA' ? 'selected' : '' }}>🏦 Virtual Account BCA</option>
                                <option value="Mandiri Bill Payment" {{ old('payment_method') == 'Mandiri Bill Payment' ? 'selected' : '' }}>🏦 Mandiri Bill Payment</option>
                                <option value="BNI VA" {{ old('payment_method') == 'BNI VA' ? 'selected' : '' }}>🏦 Virtual Account BNI</option>
                                <option value="BRI VA" {{ old('payment_method') == 'BRI VA' ? 'selected' : '' }}>🏦 Virtual Account BRI</option>
                                <option value="CIMB NIAGA VA" {{ old('payment_method') == 'CIMB NIAGA VA' ? 'selected' : '' }}>🏦 Virtual Account CIMB Niaga</option>
                                <option value="Permata VA" {{ old('payment_method') == 'Permata VA' ? 'selected' : '' }}>🏦 Virtual Account Permata</option>
                                <option value="BSI VA" {{ old('payment_method') == 'BSI VA' ? 'selected' : '' }}>🏦 Virtual Account BSI</option>
                                <option value="GoPay" {{ old('payment_method') == 'GoPay' ? 'selected' : '' }}>📱 GoPay</option>
                                <option value="QRIS" {{ old('payment_method') == 'QRIS' ? 'selected' : '' }}>📱 QRIS (Midtrans)</option>
                                <option value="QRIS Yayasan" {{ old('payment_method') == 'QRIS Yayasan' ? 'selected' : '' }}>📱 QRIS Yayasan (Manual)</option>
                                <option value="ShopeePay" {{ old('payment_method') == 'ShopeePay' ? 'selected' : '' }}>📱 ShopeePay</option>
                            </select>
                        </div>

                        <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white font-bold w-full shadow-lg border-0 py-3 h-auto text-base">
                            🔐 Lanjut ke Pembayaran
                        </button>

                        <div class="mt-6 text-center">
                            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-emerald-600 font-medium text-sm transition-colors">
                                ← Kembali ke Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Trust Badge --}}
            <div class="text-center mt-6 text-xs text-slate-400">
                <p>🔒 Pembayaran diproses secara aman melalui <span class="font-semibold text-emerald-600">Midtrans</span></p>
            </div>
        </div>
    </div>

    <script>
        let activeNominal = null;

        function pilihNominal(btn, nominal) {
            document.querySelectorAll('.nominal-btn').forEach(b => {
                b.classList.remove('bg-emerald-600', 'text-white', 'border-emerald-600');
                b.classList.add('btn-outline', 'border-emerald-300', 'text-emerald-600', 'hover:bg-emerald-600', 'hover:text-white', 'hover:border-emerald-600');
            });
            btn.classList.remove('btn-outline', 'border-emerald-300', 'text-emerald-600', 'hover:bg-emerald-600', 'hover:text-white', 'hover:border-emerald-600');
            btn.classList.add('bg-emerald-600', 'text-white', 'border-emerald-600');

            document.getElementById('amount-input').value = nominal;
            activeNominal = nominal;
        }

        function resetNominalPills() {
            const input = document.getElementById('amount-input');
            const val = input.value ? parseInt(input.value) : 0;

            if (val !== activeNominal) {
                document.querySelectorAll('.nominal-btn').forEach(b => {
                    b.classList.remove('bg-emerald-600', 'text-white', 'border-emerald-600');
                    b.classList.add('btn-outline', 'border-emerald-300', 'text-emerald-600', 'hover:bg-emerald-600', 'hover:text-white', 'hover:border-emerald-600');
                });
                activeNominal = null;
            }
        }
    </script>
</x-app-layout>