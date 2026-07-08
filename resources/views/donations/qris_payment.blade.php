<x-app-layout>
    <div class="bg-base-200 min-h-0">

        <div class="bg-gradient-to-r from-primary via-primary to-secondary text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">📱 Pembayaran via QRIS Yayasan</h1>
                        <p class="text-primary-content/70 text-sm mt-1">Scan QRIS dan upload bukti pembayaran</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline border-white text-white hover:bg-white hover:text-primary btn-sm font-bold">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Flash --}}
            @if(session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif
            @if(session('error'))
                <x-alert type="error" message="{{ session('error') }}" />
            @endif

            @php
                $isSponsor = isset($sponsorship);
                $donation = $isSponsor ? $sponsorship : $donation;
                $orderId = $donation->order_id;
            @endphp

            {{-- Ringkasan --}}
            <div class="card bg-base-100 shadow-md border border-base-300 mb-6">
                <div class="card-body p-6">
                    <h2 class="card-title text-primary border-b border-base-300 pb-3 mb-4">📋 Ringkasan Transaksi</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-base-content/50">ID Transaksi</span>
                            <span class="font-mono font-bold text-base-content">{{ $orderId }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-base-content/50">Nominal</span>
                            <span class="font-bold text-primary text-lg">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                        </div>
                        @if($isSponsor)
                            <div class="flex justify-between">
                                <span class="text-base-content/50">Anak Asuh</span>
                                <span class="font-bold text-base-content">{{ $child->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-base-content/50">Paket</span>
                                <span class="font-bold text-base-content">{{ $donation->package }}</span>
                            </div>
                        @else
                            <div class="flex justify-between">
                                <span class="text-base-content/50">Program</span>
                                <span class="font-bold text-base-content">{{ $campaign->title }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-base-content/50">Status</span>
                            <span class="badge badge-warning badge-sm">Menunggu Pembayaran</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- QRIS --}}
            @if($profil && $profil->foto_qris)
                <div class="card bg-base-100 shadow-md border border-base-300 mb-6">
                    <div class="card-body p-6 text-center">
                        <h2 class="card-title text-primary border-b border-base-300 pb-3 mb-4 justify-center">📱 Scan QRIS Yayasan</h2>
                        <img src="{{ asset('storage/' . $profil->foto_qris) . '?v=' . now()->timestamp }}"
                             class="max-w-[250px] mx-auto rounded-xl shadow-sm border border-base-300 mb-4" alt="QRIS Yayasan">
                        <p class="text-sm text-base-content/60">Scan kode QRIS di atas menggunakan aplikasi <strong class="text-primary">GoPay</strong>, <strong class="text-primary">ShopeePay</strong>, <strong class="text-primary">Mobile Banking</strong>, atau <strong class="text-primary">E-Wallet</strong> lainnya.</p>
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 mt-4 text-sm text-amber-800 text-left">
                            <p class="font-bold mb-1">📌 Langkah Pembayaran:</p>
                            <ol class="list-decimal list-inside space-y-1 text-xs text-amber-700">
                                <li>Buka aplikasi pembayaran (GoPay / M-Banking / ShopeePay / dll)</li>
                                <li>Pilih menu <strong>Scan QR / QRIS</strong></li>
                                <li>Scan kode QRIS yayasan di atas</li>
                                <li>Masukkan nominal <strong>Rp {{ number_format($donation->amount, 0, ',', '.') }}</strong></li>
                                <li>Konfirmasi pembayaran</li>
                                <li><strong>Screenshot</strong> bukti pembayaran</li>
                                <li>Upload bukti pembayaran di form bawah ini</li>
                            </ol>
                        </div>
                    </div>
                </div>
            @else
                <div class="card bg-base-100 shadow-md border border-base-300 mb-6">
                    <div class="card-body p-6 text-center">
                        <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center text-3xl mx-auto mb-3">📱</div>
                        <h2 class="font-bold text-primary">QRIS Belum Tersedia</h2>
                        <p class="text-sm text-base-content/60 mt-2">Admin yayasan belum mengupload QRIS. Silakan hubungi admin atau pilih metode pembayaran lain.</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm text-white font-bold mt-4">← Kembali</a>
                    </div>
                </div>
            @endif

            {{-- Upload Bukti --}}
            @if($profil && $profil->foto_qris)
                <div class="card bg-base-100 shadow-md border border-base-300 mb-6">
                    <div class="card-body p-6">
                        <h2 class="card-title text-primary border-b border-base-300 pb-3 mb-4">📤 Upload Bukti Pembayaran</h2>
                        <p class="text-sm text-base-content/60 mb-4">Setelah melakukan pembayaran, upload screenshot bukti transfer untuk diverifikasi oleh admin.</p>

                        <form action="{{ route('qris.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $orderId }}">

                            <div class="form-control mb-4">
                                <label class="label">
                                    <span class="label-text font-bold text-primary">Screenshot Bukti Bayar <span class="text-red-500">*</span></span>
                                </label>
                                <div class="relative">
                                    <label class="flex items-center gap-3 p-4 border-2 border-dashed border-base-300 rounded-xl bg-base-200 cursor-pointer hover:border-primary hover:bg-primary/5 transition-all" for="payment-proof-input">
                                        <div class="w-10 h-10 bg-base-300 rounded-lg flex items-center justify-center text-xl">📷</div>
                                        <div>
                                            <span id="proof-label" class="text-sm font-semibold text-base-content/70">Pilih file bukti pembayaran</span>
                                            <p class="text-xs text-base-content/40">JPG/PNG · Maks 2MB</p>
                                        </div>
                                    </label>
                                    <input type="file" name="payment_proof" id="payment-proof-input" accept="image/*" class="hidden" required onchange="document.getElementById('proof-label').textContent=this.files[0]?.name||'Pilih file bukti pembayaran'">
                                </div>
                                @error('payment_proof') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary text-white font-bold w-full">
                                📤 Upload & Konfirmasi Pembayaran
                            </button>
                        </form>

                        <div class="bg-base-200 border border-base-300 rounded-xl p-4 mt-4 text-sm text-base-content/60">
                            <p>✅ Setelah upload, admin akan memverifikasi pembayaran Anda. Status akan berubah menjadi <strong class="text-primary">Sukses</strong> setelah dikonfirmasi.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
