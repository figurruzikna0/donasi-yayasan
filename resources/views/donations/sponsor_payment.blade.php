{{-- resources/views/donations/sponsor_payment.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sponsor - {{ $child->name }}</title>

    {{-- Midtrans Snap.js --}}
    @if(config('midtrans.is_production'))
        <script src="https://app.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endif

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f3f4f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
            max-width: 480px;
            width: 100%;
            padding: 40px;
        }

        .badge {
            display: inline-block;
            background: #ecfdf5;
            color: #059669;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .6px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 999px;
            margin-bottom: 16px;
        }

        h1 {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
        }

        .subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 28px;
        }

        .divider {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 20px 0;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .detail-row .label {
            color: #6b7280;
            flex-shrink: 0;
            margin-right: 12px;
        }

        .detail-row .value {
            color: #111827;
            font-weight: 500;
            text-align: right;
        }

        .amount-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 16px 20px;
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .amount-box .amount-label {
            font-size: 13px;
            color: #065f46;
        }

        .amount-box .amount-value {
            font-size: 22px;
            font-weight: 700;
            color: #065f46;
        }

        .order-id {
            font-size: 12px;
            color: #9ca3af;
            font-family: monospace;
            margin-top: 4px;
        }

        .btn-pay {
            display: block;
            width: 100%;
            padding: 14px;
            background: #16a34a;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background .2s;
            margin-top: 24px;
        }

        .btn-pay:hover { background: #15803d; }
        .btn-pay:disabled { background: #86efac; cursor: not-allowed; }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 14px;
            font-size: 14px;
            color: #6b7280;
            text-decoration: none;
        }

        .btn-back:hover { color: #374151; }

        .info-note {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            color: #92400e;
            margin-top: 20px;
            line-height: 1.5;
        }
    </style>
</head>
<body>

<div class="card">
    <span class="badge">Sponsorship</span>
    <h1>Konfirmasi Pembayaran</h1>
    <p class="subtitle">Silakan periksa detail sponsorship sebelum melanjutkan pembayaran.</p>

    <div class="detail-row">
        <span class="label">Anak Asuh</span>
        <span class="value">{{ $child->name }}</span>
    </div>
    <div class="detail-row">
        <span class="label">Donatur</span>
        <span class="value">{{ $sponsorship->donor_name }}</span>
    </div>
    <div class="detail-row">
        <span class="label">Email</span>
        <span class="value">{{ $sponsorship->donor_email }}</span>
    </div>
    <div class="detail-row">
        <span class="label">Paket</span>
        <span class="value">{{ $sponsorship->package }}</span>
    </div>
    <div class="detail-row">
        <span class="label">Keterangan</span>
        <span class="value" style="max-width:240px;">{{ $sponsorship->package_description }}</span>
    </div>
    <div class="detail-row">
        <span class="label">Metode Bayar</span>
        <span class="value">{{ $sponsorship->payment_method }}</span>
    </div>

    <hr class="divider">

    <div class="amount-box">
        <div>
            <div class="amount-label">Total Pembayaran</div>
            <div class="order-id">{{ $sponsorship->order_id }}</div>
        </div>
        <div class="amount-value">
            Rp {{ number_format($sponsorship->amount, 0, ',', '.') }}
        </div>
    </div>

    <div class="info-note">
        💳 Anda akan diarahkan ke halaman pembayaran Midtrans. Selesaikan pembayaran dalam batas waktu yang ditentukan.
    </div>

    <button class="btn-pay" id="pay-btn" onclick="startPayment()">
        Bayar Sekarang
    </button>

    <a href="{{ route('sponsor.form', $child->id) }}" class="btn-back">
        ← Kembali
    </a>
</div>

<script>
    function startPayment() {
        const btn = document.getElementById('pay-btn');
        btn.disabled = true;
        btn.textContent = 'Memproses...';

        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert('Pembayaran berhasil! Terima kasih atas dukungan Anda.');
                window.location.href = '{{ route('dashboard') }}';
            },
            onPending: function(result) {
                alert('Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.');
                window.location.href = '{{ route('dashboard') }}';
            },
            onError: function(result) {
                alert('Pembayaran gagal. Silakan coba lagi.');
                btn.disabled = false;
                btn.textContent = 'Bayar Sekarang';
            },
            onClose: function() {
                btn.disabled = false;
                btn.textContent = 'Bayar Sekarang';
            }
        });
    }
</script>

</body>
</html>