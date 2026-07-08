<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Perkembangan - {{ $development->fosterChild?->name ?? 'Anak Asuh' }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #333; margin: 0; padding: 30px; }
        .header { border-bottom: 2px solid #059669; padding-bottom: 20px; margin-bottom: 24px; }
        .header table { width: 100%; }
        .header h1 { color: #059669; margin: 0; font-size: 22px; }
        .header p { margin: 2px 0; color: #666; font-size: 11px; }
        .header .right { text-align: right; }
        .header .logo { max-height: 55px; max-width: 55px; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 3px 0; vertical-align: top; font-size: 11px; }
        .info-table .label { color: #888; width: 90px; }
        .info-table .value { font-weight: bold; color: #065f46; }
        .child-card { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; padding: 14px 18px; margin-bottom: 20px; }
        .child-card .child-name { font-size: 15px; font-weight: bold; color: #065f46; }
        .child-card .child-info { font-size: 11px; color: #666; margin-top: 2px; }
        .child-card .package-badge { background: #059669; color: #fff; padding: 3px 12px; border-radius: 3px; font-size: 10px; font-weight: bold; display: inline-block; }
        .photo-box { text-align: center; margin: 10px 0 20px 0; }
        .photo-box img { max-width: 380px; max-height: 480px; height: auto; width: auto; border-radius: 6px; border: 1px solid #d1fae5; }
        .detail-page { page-break-before: always; padding-top: 20px; }
        .detail-header { border-bottom: 2px solid #059669; padding-bottom: 12px; margin-bottom: 20px; }
        .detail-header h2 { color: #059669; margin: 0; font-size: 18px; }
        .detail-header .date { color: #888; font-size: 10px; margin-top: 2px; }
        .detail-body { line-height: 1.9; text-align: justify; font-size: 12px; color: #333; }
        .detail-body p { margin: 0 0 10px 0; }
        .footer { border-top: 1px solid #d1fae5; padding-top: 15px; text-align: center; font-size: 10px; color: #888; margin-top: 30px; }
        .footer strong { color: #059669; }
        .page-number { text-align: center; font-size: 9px; color: #bbb; margin-top: 40px; }
    </style>
</head>
<body>

    {{-- ═══════════ PAGE 1 — INFO & FOTO ═══════════ --}}
    <div class="header">
        <table>
            <tr>
                <td>
                    <h1>LAPORAN PERKEMBANGAN</h1>
                    <p>Anak Asuh Yayasan Baitul Yatim Sukabumi</p>
                </td>
                <td class="right">
                    @if($profil?->logo)
                        <img src="{{ public_path('storage/' . $profil->logo) }}" class="logo" alt="Logo">
                    @endif
                    <p style="font-weight:bold;color:#065f46;margin-top:4px;">{{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</p>
                    <p style="font-size:10px;color:#888;">{{ $profil?->alamat ?? '-' }}</p>
                </td>
            </tr>
        </table>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Kepada</td>
            <td class="value">{{ $development->sponsorship?->donor_name ?? '-' }}</td>
            <td class="label" style="padding-left:40px;">Tanggal Laporan</td>
            <td class="value">{{ $development->tanggal ? $development->tanggal->format('d M Y') : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Email</td>
            <td class="value">{{ $development->sponsorship?->donor_email ?? '-' }}</td>
            <td class="label" style="padding-left:40px;">Order ID</td>
            <td class="value">{{ $development->sponsorship?->order_id ?? '-' }}</td>
        </tr>
    </table>

    <div class="child-card">
        <table style="width:100%;">
            <tr>
                <td>
                    <div class="child-name">{{ $development->fosterChild?->name ?? 'Anak Asuh' }}</div>
                    <div class="child-info">
                        @if($development->fosterChild?->age) {{ $development->fosterChild->age }} Thn @endif
                        @if($development->fosterChild?->jenis_kelamin) &middot; {{ $development->fosterChild->jenis_kelamin }} @endif
                        @if($development->fosterChild?->status) &middot; {{ $development->fosterChild->status }} @endif
                    </div>
                </td>
                <td style="text-align:right; vertical-align:middle;">
                    <span class="package-badge">{{ $development->sponsorship?->package ?? 'Reguler' }}</span>
                </td>
            </tr>
        </table>
    </div>

    @if($fotoPath)
        <div class="photo-box">
            <img src="{{ $fotoPath }}" alt="{{ $development->judul }}">
        </div>
    @elseif($development->foto)
        <div class="photo-box">
            <img src="{{ public_path('storage/' . $development->foto) }}" alt="{{ $development->judul }}">
        </div>
    @endif

    <div style="text-align:center; margin-top:8px;">
        <div style="font-size:16px; font-weight:bold; color:#065f46;">{{ $development->judul }}</div>
    </div>

    <div class="page-number">— Halaman 1 —</div>

    {{-- ═══════════ PAGE 2 — RINCIAN LAPORAN ═══════════ --}}
    <div class="detail-page">
        <div class="detail-header">
            <h2>Rincian Laporan</h2>
            <div class="date">{{ $development->judul }} &middot; {{ $development->tanggal ? $development->tanggal->format('d M Y') : '-' }}</div>
        </div>

        <div class="detail-body">
            {!! nl2br(e($development->deskripsi)) !!}
        </div>

        <div class="footer">
            <p>Terima kasih telah menjadi bagian dari keluarga besar Baitul Yatim.</p>
            <p><strong>— {{ $profil?->nama_yayasan ?? 'Baitul Yatim Sukabumi' }} —</strong></p>
        </div>

        <div class="page-number">— Halaman 2 —</div>
    </div>

</body>
</html>
