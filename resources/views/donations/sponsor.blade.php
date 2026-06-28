<x-guest-layout>
    <style>
        :root {
            --celadon:       #b3e093;
            --lime-cream:    #d6ec89;
            --muted-olive:   #a1c181;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
        }

        body { background-color: #f8fafc; }

        .sponsor-card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(92, 129, 72, 0.08);
            border-top: 6px solid var(--fern);
        }

        .custom-label {
            display: block;
            font-weight: 700;
            color: var(--fern);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .custom-input, .custom-select, .custom-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--muted-olive);
            border-radius: 8px;
            color: #334155;
            background-color: #fdfdfd;
            transition: all 0.3s ease;
        }

        .custom-input:focus, .custom-select:focus, .custom-textarea:focus {
            outline: none;
            border-color: var(--fern);
            box-shadow: 0 0 0 3px rgba(118, 164, 91, 0.2);
        }

        /* Tampilan display-only (bukan input asli, hanya untuk tampilan) */
        .display-box {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            color: #64748b;
            background-color: #f1f5f9;
            font-size: 0.95rem;
            min-height: 44px;
        }

        .display-box-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            color: #64748b;
            background-color: #f1f5f9;
            font-size: 0.875rem;
            min-height: 80px;
            line-height: 1.5;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--sage-green), var(--fern));
            color: white;
            font-weight: 800;
            width: 100%;
            padding: 1rem;
            border-radius: 8px;
            transition: transform 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(92, 129, 72, 0.25);
        }
        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
    </style>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <div class="sponsor-card p-8">
            <div class="text-center mb-8 border-b border-gray-100 pb-6">
                <h2 class="text-2xl font-extrabold" style="color: var(--fern);">Formulir Orang Tua Asuh</h2>
                <p class="text-gray-500 mt-2">
                    Anda akan menjadi orang tua asuh untuk
                    <strong>{{ $child->name }}</strong> ({{ $child->age }} Tahun)
                </p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
                    <p class="text-sm font-bold text-red-700 mb-1">Harap perbaiki kesalahan berikut:</p>
                    <ul class="list-disc list-inside text-sm text-red-600">
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
                        <label for="donor_name" class="custom-label">Nama Lengkap</label>
                        <input type="text" name="donor_name" id="donor_name"
                               class="custom-input" required
                               value="{{ old('donor_name') }}"
                               placeholder="Contoh: Budi Santoso">
                    </div>
                    <div>
                        <label for="donor_email" class="custom-label">Email</label>
                        <input type="email" name="donor_email" id="donor_email"
                               class="custom-input" required
                               value="{{ old('donor_email') }}"
                               placeholder="budi@email.com">
                    </div>
                    <div class="md:col-span-2">
                        <label for="donor_phone" class="custom-label">Nomor WhatsApp Aktif</label>
                        <input type="text" name="donor_phone" id="donor_phone"
                               class="custom-input" required
                               value="{{ old('donor_phone') }}"
                               placeholder="Contoh: 081234567890">
                        <p class="text-xs text-slate-400 mt-1">
                            Nomor ini dipakai untuk mengirim notifikasi jatuh tempo perpanjangan sponsorship.
                        </p>
                    </div>
                </div>

                {{-- Pilih Paket --}}
                <div class="mb-6">
                    <label for="paket_komitmen" class="custom-label">Pilih Paket Komitmen Bulanan</label>
                    <select name="paket_komitmen" id="paket_komitmen"
                            class="custom-select" required
                            onchange="updatePaketDetail()">
                        <option value="" disabled {{ old('paket_komitmen') ? '' : 'selected' }}>-- Pilih Paket --</option>
                        <option value="Bronze" {{ old('paket_komitmen') == 'Bronze' ? 'selected' : '' }}>Paket Bronze (Pendidikan Dasar)</option>
                        <option value="Silver" {{ old('paket_komitmen') == 'Silver' ? 'selected' : '' }}>Paket Silver (Pendidikan & Uang Saku)</option>
                        <option value="Gold"   {{ old('paket_komitmen') == 'Gold'   ? 'selected' : '' }}>Paket Gold (Pendidikan, Gizi & Kesehatan)</option>
                    </select>
                </div>

                {{-- ★ FIX UTAMA: hidden inputs untuk amount & description ★
                     Field readonly tidak ikut terkirim saat submit.
                     Solusi: pakai hidden input sebagai nilai asli,
                     tampilkan display-box hanya untuk UI. --}}

                {{-- Hidden inputs yang benar-benar dikirim ke server --}}
                <input type="hidden" name="amount"      id="amount-hidden">
                <input type="hidden" name="description" id="description-hidden">

                {{-- Tampilan amount (hanya untuk user, tidak dikirim) --}}
                <div class="mb-6">
                    <label class="custom-label">Nominal Komitmen (Rp)</label>
                    <div class="display-box font-bold text-lg" id="amount-display">
                        Otomatis terisi setelah pilih paket...
                    </div>
                </div>

                {{-- Tampilan description (hanya untuk user, tidak dikirim) --}}
                <div class="mb-6">
                    <label class="custom-label">Rincian Peruntukan Dana</label>
                    <div class="display-box-textarea" id="description-display">
                        Otomatis terisi berdasarkan paket yang dipilih...
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div class="mb-6">
                    <label for="payment_method" class="custom-label">Metode Pembayaran Transfer</label>
                    <select name="payment_method" id="payment_method" class="custom-select" required>
                        <option value="BCA"     {{ old('payment_method') == 'BCA'     ? 'selected' : '' }}>Bank BCA</option>
                        <option value="Mandiri" {{ old('payment_method') == 'Mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                        <option value="BSI"     {{ old('payment_method') == 'BSI'     ? 'selected' : '' }}>Bank Syariah Indonesia (BSI)</option>
                    </select>
                </div>

                <div class="mb-8 p-4 rounded-lg"
                     style="background-color: rgba(179, 224, 147, 0.15); border: 1px solid var(--celadon);">
                    <p class="text-sm" style="color: var(--fern);">
                        ℹ️ Komitmen ini berlaku untuk periode <strong>1 bulan</strong> sejak pembayaran berhasil.
                        Kami akan mengirimkan pengingat via WhatsApp sebelum jatuh tempo.
                    </p>
                </div>

                <button type="submit" class="btn-submit" id="submit-btn">
                    Konfirmasi & Lanjutkan Pembayaran
                </button>
            </form>
        </div>
    </div>

    <script>
        const dataPaket = {
            'Bronze': {
                nominal: 150000,
                keterangan: 'Biaya SPP pendidikan dasar dan buku pelajaran bulanan.'
            },
            'Silver': {
                nominal: 300000,
                keterangan: 'Biaya SPP pendidikan, buku pelajaran, dan alokasi uang saku harian.'
            },
            'Gold': {
                nominal: 500000,
                keterangan: 'Pembiayaan penuh (Pendidikan, uang saku, suplemen gizi, dan jaminan kesehatan bulanan).'
            }
        };

        function updatePaketDetail() {
            const pilihan       = document.getElementById('paket_komitmen').value;
            const hiddenAmount  = document.getElementById('amount-hidden');
            const hiddenDesc    = document.getElementById('description-hidden');
            const displayAmount = document.getElementById('amount-display');
            const displayDesc   = document.getElementById('description-display');

            if (dataPaket[pilihan]) {
                const paket = dataPaket[pilihan];

                // ★ Isi hidden input (yang dikirim ke server)
                hiddenAmount.value = paket.nominal;
                hiddenDesc.value   = paket.keterangan;

                // Perbarui tampilan untuk user
                displayAmount.textContent = 'Rp ' + paket.nominal.toLocaleString('id-ID');
                displayDesc.textContent   = paket.keterangan;
            } else {
                hiddenAmount.value = '';
                hiddenDesc.value   = '';
                displayAmount.textContent = 'Otomatis terisi setelah pilih paket...';
                displayDesc.textContent   = 'Otomatis terisi berdasarkan paket yang dipilih...';
            }
        }

        // Cegah submit kalau paket belum dipilih
        document.getElementById('sponsor-form').addEventListener('submit', function (e) {
            const amount = document.getElementById('amount-hidden').value;
            if (!amount) {
                e.preventDefault();
                alert('Harap pilih paket komitmen terlebih dahulu.');
                document.getElementById('paket_komitmen').focus();
                return;
            }
            // Disable tombol supaya tidak double submit
            document.getElementById('submit-btn').disabled = true;
            document.getElementById('submit-btn').textContent = 'Memproses...';
        });

        // Kalau ada old value (redirect balik karena error lain), restore tampilan
        window.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('paket_komitmen');
            if (select.value) updatePaketDetail();
        });
    </script>
</x-guest-layout>