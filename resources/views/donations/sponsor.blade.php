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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="label label-text font-semibold text-emerald-600">Nama Lengkap</label>
                                <input type="text" class="input input-bordered w-full bg-base-200" value="{{ $user->name }}" readonly>
                            </div>
                            <div>
                                <label class="label label-text font-semibold text-emerald-600">Email</label>
                                <input type="email" class="input input-bordered w-full bg-base-200" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="md:col-span-2">
                                <label class="label label-text font-semibold text-emerald-600">Nomor WhatsApp Aktif</label>
                                <input type="text" class="input input-bordered w-full bg-base-200" value="{{ $user->phone }}" readonly>
                                <p class="text-xs text-slate-400 mt-1">
                                    Nomor ini dipakai untuk mengirim notifikasi jatuh tempo perpanjangan sponsorship.
                                </p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="paket_komitmen" class="label label-text font-semibold text-emerald-600">Pilih Paket Komitmen Bulanan</label>
                            <select name="paket_komitmen" id="paket_komitmen" class="select select-bordered w-full" required onchange="updatePaketDetail()">
                                <option value="" disabled selected>-- Pilih Paket --</option>
                                <option value="Bronze">Paket Bronze (Pendidikan Dasar)</option>
                                <option value="Silver">Paket Silver (Pendidikan & Uang Saku)</option>
                                <option value="Gold">Paket Gold (Pendidikan, Gizi & Kesehatan)</option>
                            </select>
                        </div>

                        <input type="hidden" name="amount" id="amount-hidden">
                        <input type="hidden" name="description" id="description-hidden">

                        <div class="mb-6">
                            <label class="label label-text font-semibold text-emerald-600">Nominal Komitmen (Rp)</label>
                            <input type="text" class="input input-bordered w-full font-bold text-lg" id="amount-display" readonly value="Otomatis terisi setelah pilih paket...">
                        </div>

                        <div class="mb-6">
                            <label class="label label-text font-semibold text-emerald-600">Rincian Peruntukan Dana</label>
                            <textarea class="textarea textarea-bordered w-full" id="description-display" readonly>Otomatis terisi berdasarkan paket yang dipilih...</textarea>
                        </div>

                        <div class="mb-6">
                            <label for="payment_method" class="label label-text font-semibold text-emerald-600">Metode Pembayaran Transfer</label>
                            <select name="payment_method" id="payment_method" class="select select-bordered w-full" required>
                                <option value="BCA VA">Virtual Account BCA</option>
                                <option value="CIMB NIAGA VA">Virtual Account CIMB NIAGA</option>
                                <option value="Permata VA">Virtual Account PERMATA</option>
                                <option value="BNI VA">Virtual Account BNI</option>
                                <option value="BSI VA">Virtual Account BSI</option>
                                <option value="BRI VA">Virtual Account BRI</option>
                                <option value="Lainnya">Metode Lainnya</option>
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
    </script>
</x-app-layout>
