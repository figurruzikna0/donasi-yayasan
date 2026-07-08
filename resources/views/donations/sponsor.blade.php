<x-app-layout>
    <div class="bg-base-200 min-h-0">

        <div class="bg-gradient-to-r from-primary via-primary to-secondary text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">🤝 Formulir Orang Tua Asuh</h1>
                        <p class="text-primary-content/70 text-sm mt-1">Jadilah orang tua asuh untuk anak yatim</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline border-white text-white hover:bg-white hover:text-primary btn-sm font-bold">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Anak Info --}}
            <div class="card bg-primary/10 border border-base-300 shadow-sm mb-6">
                <div class="card-body p-5 flex flex-row items-center gap-4">
                    <div class="avatar">
                        <div class="w-16 rounded-full ring ring-base-300">
                            @if($child->photo)
                                <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->name }}">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($child->name) }}&background=b3e093&color=5c8148&bold=true" alt="">
                            @endif
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-primary uppercase tracking-wider font-bold">Anak Asuh</p>
                        <h3 class="font-bold text-primary text-lg">{{ $child->name }}</h3>
                        <p class="text-sm text-base-content/60">{{ $child->age }} Tahun{{ $child->jenis_kelamin ? ' · ' . $child->jenis_kelamin : '' }}</p>
                    </div>
                    @if($child->description)
                        <div class="ml-auto max-w-xs hidden sm:block">
                            <p class="text-xs text-base-content/50 italic">"{{ Str::limit($child->description, 80) }}"</p>
                        </div>
                    @endif
                </div>
            </div>

            @if($errors->any())
                <x-alert type="error" :errors="$errors->all()" />
            @endif

            {{-- Form --}}
            <div class="card bg-base-100 shadow-md border border-base-300">
                <div class="card-body p-6 sm:p-8">

                    <form action="{{ route('sponsor.store', $child->id) }}" method="POST" id="sponsor-form">
                        @csrf

                        {{-- Nama & Email --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-bold text-primary">Nama Lengkap <span class="text-red-500">*</span></span>
                                </label>
                                <div class="join w-full">
                                    <span class="join-item btn btn-ghost bg-base-200 text-base-content/60 px-4 text-lg">👤</span>
                                    <input type="text" name="donor_name" required placeholder="Contoh: Budi Santoso"
                                           class="input input-bordered w-full join-item border-base-300 focus:border-primary" value="{{ old('donor_name') }}">
                                </div>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-bold text-primary">Email <span class="text-red-500">*</span></span>
                                </label>
                                <div class="join w-full">
                                    <span class="join-item btn btn-ghost bg-base-200 text-base-content/60 px-4 text-lg">✉️</span>
                                    <input type="email" name="donor_email" required placeholder="email@anda.com"
                                           class="input input-bordered w-full join-item border-base-300 focus:border-primary" value="{{ old('donor_email') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-primary">No. WhatsApp Aktif <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-base-200 text-base-content/60 px-4 text-lg">📞</span>
                                <input type="text" name="donor_phone" required placeholder="081234567890"
                                       class="input input-bordered w-full join-item border-base-300 focus:border-primary" value="{{ old('donor_phone') }}">
                            </div>
                            <label class="label"><span class="label-text-alt text-base-content/50">Nomor ini dipakai untuk mengirim notifikasi jatuh tempo perpanjangan sponsorship</span></label>
                        </div>

                        {{-- Paket --}}
                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-bold text-primary">Pilih Paket Komitmen Bulanan <span class="text-red-500">*</span></span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
                                @php
                                    $pakets = [
                                        'Bronze' => ['label' => 'Bronze', 'sub' => 'Buku & Alat Tulis', 'nominal' => 100000, 'icon' => '🥉', 'color' => 'amber'],
                                        'Silver' => ['label' => 'Silver', 'sub' => 'Pendidikan & Uang Saku', 'nominal' => 250000, 'icon' => '🥈', 'color' => 'slate'],
                                        'Gold' => ['label' => 'Gold', 'sub' => 'Pendidikan, Buku & Alat Tulis', 'nominal' => 500000, 'icon' => '🥇', 'color' => 'yellow'],
                                    ];
                                @endphp
                                @foreach($pakets as $key => $p)
                                    <button type="button"
                                            class="paket-btn border-2 border-base-300 rounded-xl p-4 text-center hover:border-primary hover:bg-primary/5 transition-all cursor-pointer @if(old('paket_komitmen') == $key) border-primary bg-primary/10 @endif"
                                            data-paket="{{ $key }}"
                                            onclick="pilihPaket(this, '{{ $key }}')">
                                        <div class="text-3xl mb-2">{{ $p['icon'] }}</div>
                                        <div class="font-bold text-primary">{{ $p['label'] }}</div>
                                        <div class="text-xs text-base-content/50 mt-1">{{ $p['sub'] }}</div>
                                        <div class="font-bold text-primary mt-2">Rp{{ number_format($p['nominal'], 0, ',', '.') }}</div>
                                    </button>
                                @endforeach
                            </div>
                            <select name="paket_komitmen" id="paket_komitmen" class="select select-bordered w-full border-base-300 focus:border-primary hidden" required onchange="updatePaketDetail()">
                                <option value="" disabled {{ old('paket_komitmen') ? '' : 'selected' }}>-- Pilih Paket --</option>
                                <option value="Bronze" {{ old('paket_komitmen') == 'Bronze' ? 'selected' : '' }}>Paket Bronze</option>
                                <option value="Silver" {{ old('paket_komitmen') == 'Silver' ? 'selected' : '' }}>Paket Silver</option>
                                <option value="Gold"   {{ old('paket_komitmen') == 'Gold'   ? 'selected' : '' }}>Paket Gold</option>
                            </select>

                            <input type="hidden" name="amount" id="amount-hidden">
                            <input type="hidden" name="description" id="description-hidden">

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                <div class="bg-base-200 rounded-xl p-4 border border-base-300">
                                    <p class="text-xs text-base-content/50 font-bold uppercase tracking-wider mb-1">Nominal Komitmen</p>
                                    <p class="text-xl font-black text-primary" id="amount-display">—</p>
                                </div>
                                <div class="bg-base-200 rounded-xl p-4 border border-base-300">
                                    <p class="text-xs text-base-content/50 font-bold uppercase tracking-wider mb-1">Peruntukan Dana</p>
                                    <p class="text-sm text-base-content/70" id="description-display">Pilih paket terlebih dahulu</p>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-bold text-primary">Metode Pembayaran <span class="text-red-500">*</span></span>
                            </label>
                            <select name="payment_method" id="payment_method" class="select select-bordered w-full border-base-300 focus:border-primary" required>
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

                        {{-- Info Commitment --}}
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6 text-sm text-amber-800">
                            <p>📌 Komitmen ini berlaku untuk periode <strong>1 bulan</strong> sejak pembayaran berhasil. Kami akan mengirimkan pengingat via WhatsApp sebelum jatuh tempo.</p>
                        </div>

                        <button type="submit" class="btn btn-primary text-white font-bold w-full shadow-lg border-0 py-3 h-auto text-base" id="submit-btn">
                            🔐 Konfirmasi & Lanjutkan Pembayaran
                        </button>
                    </form>
                </div>
            </div>

            {{-- Trust Badge --}}
            <div class="text-center mt-6 text-xs text-base-content/40">
                <p>🔒 Pembayaran diproses secara aman melalui <span class="font-semibold text-primary">Midtrans</span></p>
            </div>
        </div>
    </div>

    <script>
        const dataPaket = {
            'Bronze': { nominal: 100000, keterangan: 'Paket buku pelajaran dan alat tulis sekolah bulanan.' },
            'Silver': { nominal: 250000, keterangan: 'Biaya SPP pendidikan dan uang saku harian.' },
            'Gold':   { nominal: 500000, keterangan: 'Pembiayaan penuh: SPP pendidikan, uang saku, buku pelajaran, dan alat tulis sekolah.' }
        };

        function pilihPaket(btn, key) {
            document.querySelectorAll('.paket-btn').forEach(b => {
                b.classList.remove('border-primary', 'bg-primary/10');
                b.classList.add('border-base-300');
            });
            btn.classList.remove('border-base-300');
            btn.classList.add('border-primary', 'bg-primary/10');

            document.getElementById('paket_komitmen').value = key;
            updatePaketDetail();
        }

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
                displayAmount.textContent = 'Rp ' + paket.nominal.toLocaleString('id-ID');
                displayDesc.textContent   = paket.keterangan;
            } else {
                hiddenAmount.value = '';
                hiddenDesc.value   = '';
                displayAmount.textContent = '—';
                displayDesc.textContent   = 'Pilih paket terlebih dahulu';
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
            if (select.value) {
                updatePaketDetail();
                const btn = document.querySelector(`.paket-btn[data-paket="${select.value}"]`);
                if (btn) {
                    btn.classList.remove('border-base-300');
                    btn.classList.add('border-primary', 'bg-primary/10');
                }
            }
        });
    </script>
</x-app-layout>
