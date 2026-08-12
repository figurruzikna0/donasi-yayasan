<!-- ============================================ -->
<!-- donations\sponsor.blade.php — form sponsorship anak asuh -->
<!-- ============================================ -->
<!-- Peran     : form pendaftaran orang tua asuh (sponsorship) untuk anak yatim tertentu. -->
<!-- Controller: DonationController@sponsorStore — route('sponsor.store') metode POST. -->
<!-- Alur      : pilih paket komitmen bulanan (Bronze/Silver/Gold) -> isi data diri -> -->
<!--             upload bukti transfer -> POST -> divalidasi (amount min 100000 max 500000 + -->
<!--             paket_komitmen wajib) -> disimpan status 'pending' -> admin memverifikasi. -->
{{--
    ========================================================
    FORM SPONSORSHIP (resources/views/donations/sponsor.blade.php)
    ========================================================
    Halaman untuk donatur mendaftar sebagai orang tua asuh.
    Data:
      - $child (FosterChild) — anak asuh yang akan disponsori
      - $profil (ProfilYayasan) — data rekening yayasan untuk transfer

    Alur:
      Donatur lihat anak asuh → klik "Jadi Orang Tua Asuh"
      → Form ini tampil → pilih paket komitmen + upload bukti transfer
      → Submit → DonationController.sponsorStore() → simpan status 'pending'
      → Redirect ke dashboard
      → Admin approve/tolak lewat SponsorshipController / TransactionController
    ========================================================
--}}
<x-app-layout>
    <div class="bg-base-200 min-h-0">

        <!-- BANNER ATAS: judul halaman dan tombol kembali ke dashboard -->
        <div class="bg-gradient-to-r from-primary via-primary to-secondary text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">Formulir Orang Tua Asuh</h1>
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
            <!-- KARTU INFO ANAK: foto, nama, usia, jenis kelamin, dan deskripsi singkat anak yang diasuh -->
            <div class="card bg-primary/10 border border-base-300 shadow-sm mb-6">
                <div class="card-body p-5 flex flex-row items-center gap-4">
                    <div class="avatar">
                        <div class="w-16 rounded-full ring ring-base-300">
                            <!-- KONDISI: tampil foto anak dari storage; bila tidak ada, gunakan avatar cari (ui-avatars.com) -->
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
                    <!-- KONDISI: tampilkan cuplikan deskripsi anak di samping (hanya layar besar) -->
                    @if($child->description)
                        <div class="ml-auto max-w-xs hidden sm:block">
                            <p class="text-xs text-base-content/50 italic">"{{ Str::limit($child->description, 80) }}"</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- ALERT ERROR: menampilkan seluruh pesan validasi bila ada yang gagal -->
            @if($errors->any())
                <x-alert type="error" :errors="$errors->all()" />
            @endif

            {{-- Form --}}
            <!-- FORM SPONSORSHIP: POST ke route('sponsor.store'); enctype multipart untuk upload bukti transfer -->
            <div class="card bg-base-100 shadow-md border border-base-300">
                <div class="card-body p-6 sm:p-8">

                    <form action="{{ route('sponsor.store', $child->id) }}" method="POST" id="sponsor-form" enctype="multipart/form-data">
                        @csrf

                        {{-- Nama & Email --}}
                        <!-- FIELD NAMA & EMAIL DONATUR: wajib diisi, menjadi identitas pada invoice/notifikasi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-bold text-primary">Nama Lengkap <span class="text-red-500">*</span></span>
                                </label>
                                <div class="join w-full">
                                    <span class="join-item btn btn-ghost bg-base-200 text-base-content/60 px-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                    </span>
                                    <input type="text" name="donor_name" required placeholder="Contoh: Budi Santoso"
                                           class="input input-bordered w-full join-item border-base-300 focus:border-primary" value="{{ old('donor_name') }}">
                                </div>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-bold text-primary">Email <span class="text-red-500">*</span></span>
                                </label>
                                <div class="join w-full">
                                    <span class="join-item btn btn-ghost bg-base-200 text-base-content/60 px-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                    </span>
                                    <input type="email" name="donor_email" required placeholder="email@anda.com"
                                           class="input input-bordered w-full join-item border-base-300 focus:border-primary" value="{{ old('donor_email') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <!-- FIELD NO. WHATSAPP: wajib diisi; dipakai untuk notifikasi jatuh tempo perpanjangan sponsorship -->
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-primary">No. WhatsApp Aktif <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-base-200 text-base-content/60 px-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/></svg>
                                </span>
                                <input type="text" name="donor_phone" required placeholder="081234567890"
                                       class="input input-bordered w-full join-item border-base-300 focus:border-primary" value="{{ old('donor_phone') }}">
                            </div>
                            <label class="label"><span class="label-text-alt text-base-content/50">Nomor ini dipakai untuk mengirim notifikasi jatuh tempo perpanjangan sponsorship</span></label>
                        </div>

                        {{-- Paket --}}
                        <!-- PEMILIHAN PAKET KOMITMEN BULANAN: Bronze/Silver/Gold; -->
                        <!-- pilihan tersimpan ke select tersembunyi 'paket_komitmen' dan hidden input amount + description -->
                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-bold text-primary">Pilih Paket Komitmen Bulanan <span class="text-red-500">*</span></span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
                                <!-- DEKLARASI PAKET: daftar paket beserta nominal masing-masing -->
                                @php
                                    $pakets = [
                                        'Bronze' => ['label' => 'Bronze', 'sub' => 'Buku & Alat Tulis', 'nominal' => 100000, 'color' => 'amber'],
                                        'Silver' => ['label' => 'Silver', 'sub' => 'Pendidikan & Uang Saku', 'nominal' => 250000, 'color' => 'slate'],
                                        'Gold' => ['label' => 'Gold', 'sub' => 'Pendidikan, Buku & Alat Tulis', 'nominal' => 500000, 'color' => 'yellow'],
                                    ];
                                @endphp
                                <!-- LOOPING PAKET: render satu kartu tombol untuk setiap paket -->
                                @foreach($pakets as $key => $p)
                                    <button type="button"
                                            class="paket-btn border-2 border-base-300 rounded-xl p-4 text-center hover:border-primary hover:bg-primary/5 transition-all cursor-pointer @if(old('paket_komitmen') == $key) border-primary bg-primary/10 @endif"
                                            data-paket="{{ $key }}"
                                            onclick="pilihPaket(this, '{{ $key }}')">
                                        <div class="mb-2">
                                            <!-- IKON PAKET: warna ikon berbeda untuk tiap paket (amber/slate/yellow) -->
                                            @if($p['label'] == 'Bronze')
                                                <svg class="w-8 h-8 mx-auto text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                                            @elseif($p['label'] == 'Silver')
                                                <svg class="w-8 h-8 mx-auto text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                                            @else
                                                <svg class="w-8 h-8 mx-auto text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                                            @endif
                                        </div>
                                        <div class="font-bold text-primary">{{ $p['label'] }}</div>
                                        <div class="text-xs text-base-content/50 mt-1">{{ $p['sub'] }}</div>
                                        <div class="font-bold text-primary mt-2">Rp{{ number_format($p['nominal'], 0, ',', '.') }}</div>
                                    </button>
                                @endforeach
                            </div>
                            <!-- SELECT TERSEMBUNYI: menyimpan pilihan paket; value diisi otomatis oleh JS pilihPaket() -->
                            <select name="paket_komitmen" id="paket_komitmen" class="select select-bordered w-full border-base-300 focus:border-primary hidden" required onchange="updatePaketDetail()">
                                <option value="" disabled {{ old('paket_komitmen') ? '' : 'selected' }}>-- Pilih Paket --</option>
                                <option value="Bronze" {{ old('paket_komitmen') == 'Bronze' ? 'selected' : '' }}>Paket Bronze</option>
                                <option value="Silver" {{ old('paket_komitmen') == 'Silver' ? 'selected' : '' }}>Paket Silver</option>
                                <option value="Gold"   {{ old('paket_komitmen') == 'Gold'   ? 'selected' : '' }}>Paket Gold</option>
                            </select>

                            <!-- INPUT HIDDEN: nominal & keterangan paket terpilih, dikirim bersama form -->
                            <input type="hidden" name="amount" id="amount-hidden">
                            <input type="hidden" name="description" id="description-hidden">

                            <!-- RINGKASAN PAKET TERPILIH: tampilan nominal & peruntukan dana yang diperbarui JS -->
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

                        {{-- Info Rekening Tujuan --}}
                        <!-- INFO REKENING: rekening resmi yayasan untuk transfer pembayaran sponsorship -->
                        <div class="bg-primary/5 border border-primary/20 rounded-xl p-5 mb-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0112 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-primary text-sm">Transfer ke Rekening Tujuan</p>
                                    <p class="text-xs text-base-content/50">Gunakan rekening berikut untuk melakukan pembayaran</p>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-base-300 space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-base-content/60 font-medium">Bank</span>
                                    <span class="text-sm font-bold text-primary">Bank Syariah Indonesia (BSI)</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-base-content/60 font-medium">No. Rekening</span>
                                    <span class="text-sm font-bold text-primary tracking-wider">7122-8023-98</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-base-content/60 font-medium">Atas Nama</span>
                                    <span class="text-sm font-bold text-primary">Baitul Yatim Sukabumi</span>
                                </div>
                            </div>
                        </div>

                        {{-- Upload Bukti Transfer --}}
                        <!-- UPLOAD BUKTI TRANSFER: wajib; format JPG/JPEG/PNG (server menerima jpg/jpeg/png/pdf, maks 5MB) -->
                        <div class="form-control w-full mb-5">
                            <label class="label">
                                <span class="label-text font-bold text-primary">Upload Bukti Transfer <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-base-200 text-base-content/60 px-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg>
                                </span>
                                <input type="file" name="payment_proof" accept="image/jpg,image/jpeg,image/png" required
                                    class="file-input file-input-bordered w-full join-item border-base-300 focus:border-primary">
                            </div>
                            <label class="label"><span class="label-text-alt text-base-content/50">Format: JPG/JPEG/PNG, maks 2MB</span></label>
                            <!-- BAR PROGRESS UPLOAD (simulasi): diperbarui oleh JS saat file dipilih -->
                            <div class="upload-progress-container" id="upload-progress-sponsor">
                                <div class="upload-progress-bar-bg">
                                    <div class="upload-progress-bar-fill" id="upload-fill-sponsor"></div>
                                </div>
                                <div class="upload-progress-text">
                                    <span id="upload-name-sponsor"></span>
                                    <span id="upload-pct-sponsor">0%</span>
                                </div>
                            </div>
                        </div>

                        {{-- Tanggal Transfer --}}
                        <!-- FIELD TANGGAL TRANSFER: wajib; nilai default = tanggal hari ini -->
                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-bold text-primary">Tanggal Transfer <span class="text-red-500">*</span></span>
                            </label>
                            <div class="join w-full">
                                <span class="join-item btn btn-ghost bg-base-200 text-base-content/60 px-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                </span>
                                <input type="date" name="transfer_date" required
                                    class="input input-bordered w-full join-item border-base-300 focus:border-primary" value="{{ old('transfer_date', date('Y-m-d')) }}">
                            </div>
                        </div>

                        {{-- Info Commitment --}}
                        <!-- INFO KOMITMEN: penjelasan periode berlaku sponsorship (1 bulan) -->
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6 text-sm text-amber-800">
                            <p>Komitmen ini berlaku untuk periode <strong>1 bulan</strong> sejak pembayaran berhasil. Kami akan mengirimkan pengingat via WhatsApp sebelum jatuh tempo.</p>
                        </div>

                        <!-- TOMBOL SUBMIT: mengirim form sponsorship -->
                        <button type="submit" class="btn btn-primary text-white font-bold w-full shadow-lg border-0 py-3 h-auto text-base" id="submit-btn" data-no-loading>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            <span class="btn-text">Kirim Sponsorship</span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Info --}}
            <div class="text-center mt-6 text-xs text-base-content/40">
                <svg class="w-4 h-4 inline-block -mt-0.5 text-primary-content/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0112 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg> Setiap donasi Anda akan menjadi amal jariyah yang tak terputus pahalanya
            </div>
        </div>
    </div>

    <!-- SCRIPT JS FORM SPONSORSHIP: -->
    <script>
        <!-- DATA PAKET di sisi klien: nominal & keterangan untuk tiap paket (dipakai fungsi updatePaketDetail) -->
        const dataPaket = {
            'Bronze': { nominal: 100000, keterangan: 'Paket buku pelajaran dan alat tulis sekolah bulanan.' },
            'Silver': { nominal: 250000, keterangan: 'Biaya SPP pendidikan dan uang saku harian.' },
            'Gold':   { nominal: 500000, keterangan: 'Pembiayaan penuh: SPP pendidikan, uang saku, buku pelajaran, dan alat tulis sekolah.' }
        };

        <!-- pilihPaket(): menandai kartu paket yang diklik dan menyimpan pilihan ke select tersembunyi -->
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

        <!-- updatePaketDetail(): mengisi hidden input amount/description dan memperbarui tampilan ringkasan -->
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

        <!-- Validasi submit: form ditolak bila paket belum dipilih; jika valid, tombol dinonaktifkan -->
        <!-- dan progress upload diset 100% sebelum form dikirim -->
        document.getElementById('sponsor-form').addEventListener('submit', function (e) {
            const amount = document.getElementById('amount-hidden').value;
            if (!amount) {
                e.preventDefault();
                window.dispatchEvent(new CustomEvent('toast-show', { detail: { message: 'Harap pilih paket komitmen terlebih dahulu.', type: 'warning' } }));
                document.getElementById('paket_komitmen').focus();
                return;
            }
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.innerHTML = '<span class="btn-spinner" style="display:flex;align-items:center;justify-content:center;gap:8px"><span class="spinner-ring-sm"></span> Memproses...</span>';

            if (window._uploadIntervalSponsor) clearInterval(window._uploadIntervalSponsor);
            const fill = document.getElementById('upload-fill-sponsor');
            const pctEl = document.getElementById('upload-pct-sponsor');
            if (fill) { fill.style.width = '100%'; pctEl.textContent = '100%'; }
        });

        <!-- Saat file bukti transfer dipilih: tampilkan nama file dan simulasi progress upload -->
        document.querySelector('input[name="payment_proof"]').addEventListener('change', function () {
            const file = this.files[0];
            const container = document.getElementById('upload-progress-sponsor');
            const fill = document.getElementById('upload-fill-sponsor');
            const nameEl = document.getElementById('upload-name-sponsor');
            const pctEl = document.getElementById('upload-pct-sponsor');

            if (!file) { container.classList.remove('active'); return; }

            container.classList.add('active');
            nameEl.textContent = file.name;
            fill.style.width = '0%';
            pctEl.textContent = '0%';

            let pct = 0;
            if (window._uploadIntervalSponsor) clearInterval(window._uploadIntervalSponsor);
            window._uploadIntervalSponsor = setInterval(() => {
                pct += Math.random() * 25;
                if (pct > 90) pct = 90;
                fill.style.width = pct + '%';
                pctEl.textContent = Math.round(pct) + '%';
            }, 200);
        });

        <!-- Saat halaman dimuat: pulihkan pilihan paket bila sebelumnya ada error validasi (old('paket_komitmen')) -->
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