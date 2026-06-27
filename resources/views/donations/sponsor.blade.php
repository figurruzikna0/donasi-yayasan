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

        .custom-input[readonly], .custom-textarea[readonly] {
            background-color: #f1f5f9;
            cursor: not-allowed;
            border-color: #cbd5e1;
            color: #64748b;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--sage-green), var(--fern));
            color: white;
            font-weight: 800;
            width: 100%;
            padding: 1rem;
            border-radius: 8px;
            transition: transform 0.2s;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 15px rgba(92, 129, 72, 0.25); }
    </style>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <div class="sponsor-card p-8">
            <div class="text-center mb-8 border-b border-gray-100 pb-6">
                <h2 class="text-2xl font-extrabold" style="color: var(--fern);">Formulir Orang Tua Asuh</h2>
                <p class="text-gray-500 mt-2">Anda akan menjadi orang tua asuh untuk <strong>{{ $child->name }}</strong> ({{ $child->age }} Tahun)</p>
            </div>

            <form action="{{ route('sponsor.store', $child->id) }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="donor_name" class="custom-label">Nama Lengkap</label>
                        <input type="text" name="donor_name" id="donor_name" class="custom-input" required placeholder="Contoh: Budi Santoso">
                    </div>
                    <div>
                        <label for="donor_email" class="custom-label">Email</label>
                        <input type="email" name="donor_email" id="donor_email" class="custom-input" required placeholder="budi@email.com">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="paket_komitmen" class="custom-label">Pilih Paket Komitmen Bulanan</label>
                    <select name="paket_komitmen" id="paket_komitmen" class="custom-select" required onchange="updatePaketDetail()">
                        <option value="" disabled selected>-- Pilih Paket --</option>
                        <option value="Bronze">Paket Bronze (Pendidikan Dasar)</option>
                        <option value="Silver">Paket Silver (Pendidikan & Uang Saku)</option>
                        <option value="Gold">Paket Gold (Pendidikan, Gizi & Kesehatan)</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="amount" class="custom-label">Nominal Komitmen (Rp)</label>
                    <input type="number" name="amount" id="amount" class="custom-input font-bold text-lg" readonly required placeholder="Otomatis terisi...">
                </div>

                <div class="mb-6">
                    <label for="description" class="custom-label">Rincian Peruntukan Dana</label>
                    <textarea name="description" id="description" rows="3" class="custom-textarea" readonly required placeholder="Otomatis terisi berdasarkan paket yang dipilih..."></textarea>
                </div>

                <div class="mb-8">
                    <label for="payment_method" class="custom-label">Metode Pembayaran Transfer</label>
                    <select name="payment_method" id="payment_method" class="custom-select" required>
                        <option value="BCA">Bank BCA</option>
                        <option value="Mandiri">Bank Mandiri</option>
                        <option value="BSI">Bank Syariah Indonesia (BSI)</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">
                    Konfirmasi & Lanjutkan Pembayaran
                </button>
            </form>
        </div>
    </div>

    <script>
        // Database sementara (Kamus Data) untuk paket
        const dataPaket = {
            'Bronze': {
                nominal: 150000,
                keterangan: "Biaya SPP pendidikan dasar dan buku pelajaran bulanan."
            },
            'Silver': {
                nominal: 300000,
                keterangan: "Biaya SPP pendidikan, buku pelajaran, dan alokasi uang saku harian."
            },
            'Gold': {
                nominal: 500000,
                keterangan: "Pembiayaan penuh (Pendidikan, uang saku, suplemen gizi, dan jaminan kesehatan bulanan)."
            }
        };

        function updatePaketDetail() {
            // Ambil elemen HTML
            const pilihanPaket = document.getElementById('paket_komitmen').value;
            const inputNominal = document.getElementById('amount');
            const inputKeterangan = document.getElementById('description');

            // Cek apakah paket yang dipilih ada di dalam Kamus Data
            if (dataPaket[pilihanPaket]) {
                // Isi otomatis value dari input tersebut
                inputNominal.value = dataPaket[pilihanPaket].nominal;
                inputKeterangan.value = dataPaket[pilihanPaket].keterangan;
            } else {
                // Kosongkan jika tidak ada yang dipilih
                inputNominal.value = '';
                inputKeterangan.value = '';
            }
        }
    </script>
</x-guest-layout>