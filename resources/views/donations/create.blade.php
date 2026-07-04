<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">Formulir Donasi</h2>
    </x-slot>

    <div class="py-10 px-4">
        <div class="max-w-xl mx-auto">
            <div class="card bg-base-100 shadow-xl border-t-4 border-t-emerald-600">
                <div class="card-body p-8">
                    <div class="text-center mb-6">
                        <p class="text-slate-500 text-sm">Anda akan berdonasi untuk program:</p>
                        <p class="font-bold text-emerald-600 text-lg">{{ $campaign->title }}</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-error mb-6">
                            <ul class="text-sm font-semibold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('donations.store', $campaign->id) }}" method="POST" id="donation-form">
                        @csrf

                        <div class="mb-5">
                            <label class="label label-text font-semibold text-emerald-600">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="donor_name" required placeholder="Contoh: Budi Santoso"
                                   class="input input-bordered w-full" value="{{ old('donor_name') }}">
                        </div>

                        <div class="mb-5">
                            <label class="label label-text font-semibold text-emerald-600">Alamat Email <span class="text-red-500">*</span></label>
                            <input type="email" name="donor_email" required placeholder="email@anda.com"
                                   class="input input-bordered w-full" value="{{ old('donor_email') }}">
                        </div>

                        <div class="mb-5">
                            <label class="label label-text font-semibold text-emerald-600">No. WhatsApp Aktif <span class="text-red-500">*</span></label>
                            <input type="text" name="donor_phone" required placeholder="081234567890"
                                   class="input input-bordered w-full" value="{{ old('donor_phone') }}">
                            <label class="label"><span class="label-text-alt text-emerald-500">Digunakan untuk notifikasi donasi</span></label>
                        </div>

                        <div class="mb-5">
                            <label class="label label-text font-semibold text-emerald-600">Nominal Donasi (Rp) <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mb-3">
                                @php $nominals = [10000, 20000, 50000, 100000]; @endphp
                                @foreach($nominals as $nom)
                                    <button type="button"
                                            class="btn btn-outline btn-success btn-sm nominal-btn"
                                            data-nominal="{{ $nom }}"
                                            onclick="pilihNominal(this, {{ $nom }})">
                                        Rp {{ number_format($nom, 0, ',', '.') }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-base-200 font-bold text-emerald-600 px-4">Rp</span>
                                <input type="number" name="amount" id="amount-input" min="1000" required
                                       placeholder="Atau isi nominal lainnya..."
                                       class="input input-bordered w-full join-item font-bold text-emerald-600"
                                       oninput="resetNominalPills()">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="label label-text font-semibold text-emerald-600">Metode Pembayaran <span class="text-red-500">*</span></label>
                            <select name="payment_method" class="select select-bordered w-full" required>
                                <option value="" disabled {{ old('payment_method') ? '' : 'selected' }}>-- Pilih Metode --</option>
                                <option value="BCA VA" {{ old('payment_method') == 'BCA VA' ? 'selected' : '' }}>Virtual Account BCA</option>
                                <option value="Mandiri Bill Payment" {{ old('payment_method') == 'Mandiri Bill Payment' ? 'selected' : '' }}>Mandiri Bill Payment</option>
                                <option value="BNI VA" {{ old('payment_method') == 'BNI VA' ? 'selected' : '' }}>Virtual Account BNI</option>
                                <option value="BRI VA" {{ old('payment_method') == 'BRI VA' ? 'selected' : '' }}>Virtual Account BRI</option>
                                <option value="CIMB NIAGA VA" {{ old('payment_method') == 'CIMB NIAGA VA' ? 'selected' : '' }}>Virtual Account CIMB Niaga</option>
                                <option value="Permata VA" {{ old('payment_method') == 'Permata VA' ? 'selected' : '' }}>Virtual Account Permata</option>
                                <option value="BSI VA" {{ old('payment_method') == 'BSI VA' ? 'selected' : '' }}>Virtual Account BSI</option>
                                <option value="GoPay" {{ old('payment_method') == 'GoPay' ? 'selected' : '' }}>GoPay</option>
                                <option value="QRIS" {{ old('payment_method') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                <option value="ShopeePay" {{ old('payment_method') == 'ShopeePay' ? 'selected' : '' }}>ShopeePay</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success text-white font-bold w-full shadow-lg">
                            Lanjut ke Pembayaran
                        </button>

                        <div class="mt-6 text-center">
                            <a href="{{ route('dashboard') }}" class="link link-hover text-slate-400 font-medium text-sm">Kembali ke Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let activeNominal = null;

        function pilihNominal(btn, nominal) {
            document.querySelectorAll('.nominal-btn').forEach(b => {
                b.classList.remove('btn-success', 'text-white');
                b.classList.add('btn-outline');
            });
            btn.classList.remove('btn-outline');
            btn.classList.add('btn-success', 'text-white');

            document.getElementById('amount-input').value = nominal;
            activeNominal = nominal;
        }

        function resetNominalPills() {
            const input = document.getElementById('amount-input');
            const val = input.value ? parseInt(input.value) : 0;

            if (val !== activeNominal) {
                document.querySelectorAll('.nominal-btn').forEach(b => {
                    b.classList.remove('btn-success', 'text-white');
                    b.classList.add('btn-outline');
                });
                activeNominal = null;
            }
        }
    </script>
</x-app-layout>
