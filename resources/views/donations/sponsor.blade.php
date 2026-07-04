<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">Formulir Orang Tua Asuh</h2>
    </x-slot>

    <div class="py-10 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="card bg-base-100 shadow-xl border-t-4 border-t-emerald-600">
                <div class="card-body p-8">
                    <div class="text-center mb-8 border-b border-gray-100 pb-6">
                        <p class="text-gray-500 mt-2">
                            Anda akan menjadi orang tua asuh untuk
                            <strong>{{ $child->name }}</strong> ({{ $child->age }} Tahun)
                        </p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-error mb-6">
                            <p class="text-sm font-bold mb-1">Harap perbaiki kesalahan berikut:</p>
                            <ul class="list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('sponsor.store', $child->id) }}" method="POST" id="sponsor-form">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                            <div>
                                <label class="label label-text font-semibold text-emerald-600">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="donor_name" required placeholder="Contoh: Budi Santoso"
                                       class="input input-bordered w-full" value="{{ old('donor_name') }}">
                            </div>
                            <div>
                                <label class="label label-text font-semibold text-emerald-600">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="donor_email" required placeholder="email@anda.com"
                                       class="input input-bordered w-full" value="{{ old('donor_email') }}">
                            </div>
                            <div class="md:col-span-2">
                                <label class="label label-text font-semibold text-emerald-600">No. WhatsApp Aktif <span class="text-red-500">*</span></label>
                                <input type="text" name="donor_phone" required placeholder="081234567890"
                                       class="input input-bordered w-full" value="{{ old('donor_phone') }}">
                                <p class="text-xs text-slate-400 mt-1">
                                    Nomor ini dipakai untuk mengirim notifikasi jatuh tempo perpanjangan sponsorship.
                                </p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="paket_komitmen" class="label label-text font-semibold text-emerald-600">Pilih Paket Komitmen Bulanan <span class="text-red-500">*</span></label>
                            <select name="paket_komitmen" id="paket_komitmen" class="select select-bordered w-full" required onchange="updatePaketDetail()">
                                <option value="" disabled {{ old('paket_komitmen') ? '' : 'selected' }}>-- Pilih Paket --</option>
                                <option value="Bronze" {{ old('paket_komitmen') == 'Bronze' ? 'selected' : '' }}>Paket Bronze (Pendidikan Dasar)</option>
                                <option value="Silver" {{ old('paket_komitmen') == 'Silver' ? 'selected' : '' }}>Paket Silver (Pendidikan & Uang Saku)</option>
                                <option value="Gold"   {{ old('paket_komitmen') == 'Gold'   ? 'selected' : '' }}>Paket Gold (Pendidikan, Gizi & Kesehatan)</option>
                            </select>
                        </div>

                        <input type="hidden" name="amount" id="amount-hidden">
                        <input type="hidden" name="description" id="description-hidden">

                        <div class="mb-6">
                            <label class="label label-text font-semibold text-emerald-600">Nominal Komitmen (Rp)</label>
                            <input type="text" class="input input-bordered w-full font-bold text-lg bg-base-200" id="amount-display" readonly value="Otomatis terisi setelah pilih paket...">
                        </div>

                        <div class="mb-6">
                            <label class="label label-text font-semibold text-emerald-600">Rincian Peruntukan Dana</label>
                            <textarea class="textarea textarea-bordered w-full bg-base-200" id="description-display" readonly>Otomatis terisi berdasarkan paket yang dipilih...</textarea>
                        </div>

                        <div class="mb-6">
                            <label for="payment_method" class="label label-text font-semibold text-emerald-600">Metode Pembayaran <span class="text-red-500">*</span></label>
                            <select name="payment_method" id="payment_method" class="select select-bordered w-full" required>
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

                        <div class="alert alert-info mb-8">
                            <p class="text-sm">
                                Komitmen ini berlaku untuk periode <strong>1 bulan</strong> sejak pembayaran berhasil.
                                Kami akan mengirimkan pengingat via WhatsApp sebelum jatuh tempo.
                            </p>
                        </div>

                        <button type="submit" class="btn btn-success text-white font-bold w-full" id="submit-btn">
                            Konfirmasi & Lanjutkan Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dataPaket = {
            'Bronze': { nominal: 1500000, keterangan: 'Biaya SPP pendidikan dasar dan buku pelajaran bulanan.' },
            'Silver': { nominal: 1750000, keterangan: 'Biaya SPP pendidikan, buku pelajaran, dan alokasi uang saku harian.' },
            'Gold':   { nominal: 2500000, keterangan: 'Pembiayaan penuh (Pendidikan, uang saku, suplemen gizi, dan jaminan kesehatan bulanan).' }
        };

        function updatePaketDetail() {
            const pilihan       = document.getElementById('paket_komitmen').value;
            const hiddenAmount  = document.getElementById('amount-hidden');
            const hiddenDesc    = document.getElementById('description-hidden');
            const displayAmount = document.getElementById('amount-display');
            const displayDesc   = document.getElementById('description-display');

            if (dataPaket[pilihan]) {
                const paket = dataPaket[pilihan];
                hiddenAmount.value = paket.nominal;
                hiddenDesc.value   = paket.keterangan;
                displayAmount.value = 'Rp ' + paket.nominal.toLocaleString('id-ID');
                displayDesc.value   = paket.keterangan;
            } else {
                hiddenAmount.value = '';
                hiddenDesc.value   = '';
                displayAmount.value = 'Otomatis terisi setelah pilih paket...';
                displayDesc.value   = 'Otomatis terisi berdasarkan paket yang dipilih...';
            }
        }

        document.getElementById('sponsor-form').addEventListener('submit', function (e) {
            const amount = document.getElementById('amount-hidden').value;
            if (!amount) {
                e.preventDefault();
                alert('Harap pilih paket komitmen terlebih dahulu.');
                document.getElementById('paket_komitmen').focus();
                return;
            }
            document.getElementById('submit-btn').disabled = true;
            document.getElementById('submit-btn').textContent = 'Memproses...';
        });

        window.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('paket_komitmen');
            if (select.value) updatePaketDetail();
        });
    </script>
</x-app-layout>
