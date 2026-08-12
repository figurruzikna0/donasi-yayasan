<!-- ============================================ -->
<!-- donations\create.blade.php — form donasi (infak) -->
<!-- ============================================ -->
<!-- Peran     : form donasi langsung ke program/kampanye yayasan (infak umum). -->
<!-- Controller: DonationController@store — route('donations.store') metode POST. -->
<!-- Alur      : isi nama, email, WA, nominal + upload bukti transfer -> POST -> divalidasi -->
<!--             (amount min 1000, bukti jpg/jpeg/png/pdf maks 5MB) -> disimpan status 'pending' -->
<!--             -> redirect dashboard -> admin memverifikasi bukti via TransactionController. -->
{{--
    ========================================================
    FORM DONASI KAMPANYE (resources/views/donations/create.blade.php)
    ========================================================
    Halaman ini ditampilkan saat donatur ingin donasi ke campaign.
    Data:
      - $campaign (Campaign) — campaign yang akan didonasi
      - $profil (ProfilYayasan) — data yayasan (rekening, dll) — global view composer

    Alur:
      Donatur lihat campaign → klik "Donasi Sekarang"
      → Form ini tampil → isi data + upload bukti transfer
      → Submit → DonationController.store() → simpan status 'pending'
      → Redirect ke dashboard dengan pesan sukses
      → Admin approve/tolak lewat TransactionController
    ========================================================
--}}
<x-app-layout>
    <div class="bg-base-200 min-h-0">

        <!-- BANNER ATAS: judul halaman dan tombol kembali ke dashboard -->
        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-500 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">Formulir Donasi</h1>
                        <p class="text-emerald-100 text-sm mt-1">Lengkapi data diri untuk melanjutkan donasi</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline border-white text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- KONDISI GAGAL AMAN: bila $campaign tidak ditemukan (id salah/berubah), -->
            <!-- tampilkan peringatan alih-alih error fatal -->
            @if(!$campaign)
                <div class="card bg-base-100 shadow-lg border border-red-200">
                    <div class="card-body text-center py-12">
                        <p class="text-red-500 font-bold text-lg">Program donasi tidak ditemukan</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline border-emerald-300 text-emerald-600 font-bold mt-4">← Kembali ke Dashboard</a>
                    </div>
                </div>
            @else

            {{-- Campaign Info --}}
            <!-- KARTU INFO CAMPAIGN: ringkasan program donasi tujuan (nama & target dana) -->
            <div class="card bg-emerald-50 border border-emerald-200 shadow-sm mb-6">
                <div class="card-body p-5 flex flex-row items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-200 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
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

            <!-- ALERT ERROR: menampilkan seluruh pesan validasi yang gagal sekaligus -->
            @if ($errors->any())
                <x-alert type="error" :errors="$errors->all()" />
            @endif

            {{-- Form --}}
            <!-- FORM DONASI: POST ke route('donations.store'); enctype multipart untuk upload bukti transfer -->
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6 sm:p-8">

                    <form action="{{ route('donations.store', $campaign->id) }}" method="POST" id="donation-form" enctype="multipart/form-data">
                        @csrf

                        {{-- Nama --}}
                        <!-- FIELD NAMA LENGKAP: wajib diisi; data donatur yang ditampilkan pada invoice -->
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Nama Lengkap <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                </span>
                                <input type="text" name="donor_name" required placeholder="Contoh: Budi Santoso"
                                       class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500" value="{{ old('donor_name') }}">
                            </div>
                        </div>

                        {{-- Email --}}
                        <!-- FIELD EMAIL: wajib diisi; dipakai untuk pengiriman invoice & notifikasi -->
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Alamat Email <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                </span>
                                <input type="email" name="donor_email" required placeholder="email@anda.com"
                                       class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500" value="{{ old('donor_email') }}">
                            </div>
                        </div>

                        {{-- Phone --}}
                        <!-- FIELD NO. WHATSAPP: wajib diisi; dipakai untuk notifikasi donasi via WA -->
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">No. WhatsApp Aktif <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/></svg>
                                </span>
                                <input type="text" name="donor_phone" required placeholder="081234567890"
                                       class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500" value="{{ old('donor_phone') }}">
                            </div>
                            <label class="label"><span class="label-text-alt text-emerald-500">Digunakan untuk notifikasi donasi via WhatsApp</span></label>
                        </div>

                        {{-- Nominal --}}
                        <!-- FIELD NOMINAL DONASI: tombol cepat + input manual; di sisi server divalidasi -->
                        <!-- 'amount' => required|numeric|min:1000 (DonationController@store) -->
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Nominal Donasi <span class="text-red-500">*</span></span>
                            </label>
                            <!-- TOMBOL NOMINAL CEPAT: pilihan Rp10.000, Rp20.000, Rp50.000, Rp100.000 -->
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
                            <!-- INPUT NOMINAL MANUAL: nilai minimum di form 1000; nilai asli dikirim ke server -->
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 font-bold px-4">Rp</span>
                                <input type="number" name="amount" id="amount-input" min="1000" required
                                       placeholder="Isi nominal lainnya"
                                       class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500 font-bold text-emerald-700"
                                       oninput="resetNominalPills()">
                            </div>
                        </div>

                        {{-- Info Rekening Tujuan --}}
                        <!-- INFO REKENING: rekening resmi yayasan untuk transfer manual (bukti diunggah di bawah) -->
                        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 mb-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-full bg-emerald-200 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0112 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-emerald-700 text-sm">Transfer ke Rekening Tujuan</p>
                                    <p class="text-xs text-emerald-500">Gunakan rekening berikut untuk melakukan pembayaran</p>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-emerald-200 space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-emerald-600 font-medium">Bank</span>
                                    <span class="text-sm font-bold text-emerald-800">Bank Syariah Indonesia (BSI)</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-emerald-600 font-medium">No. Rekening</span>
                                    <span class="text-sm font-bold text-emerald-800 tracking-wider">7122-8023-98</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-emerald-600 font-medium">Atas Nama</span>
                                    <span class="text-sm font-bold text-emerald-800">Baitul Yatim Sukabumi</span>
                                </div>
                            </div>
                        </div>

                        {{-- Upload Bukti Transfer --}}
                        <!-- UPLOAD BUKTI TRANSFER: wajib; format JPG/JPEG/PNG (server juga menerima PDF) -->
                        <!-- validasi controller: payment_proof required|file|mimes:jpg,jpeg,png,pdf|max:5120 -->
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Upload Bukti Transfer <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg>
                                </span>
                                <input type="file" name="payment_proof" accept="image/jpg,image/jpeg,image/png" required
                                    class="file-input file-input-bordered w-full join-item border-emerald-200 focus:border-emerald-500">
                            </div>
                            <label class="label"><span class="label-text-alt text-emerald-500">Format: JPG/JPEG/PNG, maks 2MB</span></label>
                            <!-- BAR PROGRESS UPLOAD (simulasi): diperbarui oleh JS saat file dipilih -->
                            <div class="upload-progress-container" id="upload-progress-donasi">
                                <div class="upload-progress-bar-bg">
                                    <div class="upload-progress-bar-fill" id="upload-fill-donasi"></div>
                                </div>
                                <div class="upload-progress-text">
                                    <span id="upload-name-donasi"></span>
                                    <span id="upload-pct-donasi">0%</span>
                                </div>
                            </div>
                        </div>

                        {{-- Tanggal Transfer --}}
                        <!-- FIELD TANGGAL TRANSFER: wajib; nilai default = tanggal hari ini -->
                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-bold text-emerald-700">Tanggal Transfer <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-emerald-50 text-emerald-600 px-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                </span>
                                <input type="date" name="transfer_date" required
                                    class="input input-bordered w-full join-item border-emerald-200 focus:border-emerald-500" value="{{ old('transfer_date', date('Y-m-d')) }}">
                            </div>
                        </div>

                        <!-- TOMBOL SUBMIT: mengirim form donasi ke server -->
                        <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white font-bold w-full shadow-lg border-0 py-3 h-auto text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            Kirim Donasi
                        </button>

                        <div class="mt-6 text-center">
                            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-emerald-600 font-medium text-sm transition-colors">
                                ← Kembali ke Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info --}}
            <div class="text-center mt-6 text-xs text-slate-400">
                <svg class="w-4 h-4 inline-block -mt-0.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0112 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg> Setiap rupiah donasi Anda akan disalurkan untuk program kebaikan
            </div>
            @endif
        </div>
    </div>

    <!-- SCRIPT JS FORM DONASI: -->
    <script>
        let activeNominal = null;

        <!-- pilihNominal(): menandai tombol nominal yang dipilih dan mengisi input amount -->
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

        <!-- resetNominalPills(): bila user mengetik nominal manual, tanda pada tombol cepat dihapus -->
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

        <!-- Saat file bukti transfer dipilih: tampilkan nama file dan simulasi progress upload -->
        document.querySelector('input[name="payment_proof"]').addEventListener('change', function () {
            const file = this.files[0];
            const container = document.getElementById('upload-progress-donasi');
            const fill = document.getElementById('upload-fill-donasi');
            const nameEl = document.getElementById('upload-name-donasi');
            const pctEl = document.getElementById('upload-pct-donasi');

            if (!file) { container.classList.remove('active'); return; }

            container.classList.add('active');
            nameEl.textContent = file.name;
            fill.style.width = '0%';
            pctEl.textContent = '0%';

            let pct = 0;
            if (window._uploadIntervalDonasi) clearInterval(window._uploadIntervalDonasi);
            window._uploadIntervalDonasi = setInterval(() => {
                pct += Math.random() * 25;
                if (pct > 90) pct = 90;
                fill.style.width = pct + '%';
                pctEl.textContent = Math.round(pct) + '%';
            }, 200);
        });

        <!-- Saat form disubmit: hentikan simulasi progress dan set bar menjadi 100% -->
        document.getElementById('donation-form').addEventListener('submit', function () {
            if (window._uploadIntervalDonasi) clearInterval(window._uploadIntervalDonasi);
            const fill = document.getElementById('upload-fill-donasi');
            const pctEl = document.getElementById('upload-pct-donasi');
            fill.style.width = '100%';
            pctEl.textContent = '100%';
        });
    </script>
</x-app-layout>