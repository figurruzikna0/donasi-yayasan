<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Donasi - <?php echo e($donation->order_id); ?></title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #333; margin: 0; padding: 30px; }
        .header { border-bottom: 2px solid #059669; padding-bottom: 20px; margin-bottom: 20px; }
        .header table { width: 100%; }
        .header h1 { color: #059669; margin: 0; font-size: 24px; }
        .header p { margin: 2px 0; color: #666; }
        .header .right { text-align: right; }
        .header .logo { max-height: 60px; max-width: 60px; }
        .section { margin-bottom: 20px; }
        .section-title { color: #059669; font-weight: bold; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
        .info-table { width: 100%; }
        .info-table td { padding: 2px 0; vertical-align: top; }
        .info-table .label { color: #888; width: 100px; }
        .info-table .value { font-weight: bold; color: #065f46; }
        .invoice-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .invoice-table th { background: #ecfdf5; color: #065f46; padding: 8px 12px; text-align: left; font-size: 11px; border-bottom: 2px solid #059669; }
        .invoice-table th.right { text-align: right; }
        .invoice-table td { padding: 8px 12px; border-bottom: 1px solid #d1fae5; }
        .invoice-table td.right { text-align: right; font-weight: bold; }
        .invoice-table tfoot td { background: #ecfdf5; font-weight: bold; padding: 8px 12px; border-top: 2px solid #059669; }
        .invoice-table tfoot td.right { color: #059669; font-size: 14px; }
        .footer { border-top: 1px solid #d1fae5; padding-top: 15px; text-align: center; font-size: 10px; color: #888; }
        .footer strong { color: #059669; }
        .status { display: inline-block; padding: 2px 8px; border-radius: 3px; font-size: 10px; font-weight: bold; }
        .status-success { background: #d1fae5; color: #065f46; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-failed { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td>
                    <h1>INVOICE</h1>
                    <p>Bukti Donasi</p>
                </td>
                <td class="right">
                    <?php if($profil?->logo): ?>
                        <img src="<?php echo e(public_path('storage/' . $profil->logo)); ?>" class="logo" alt="Logo">
                    <?php endif; ?>
                    <p style="font-weight:bold;color:#065f46;margin-top:4px;"><?php echo e($profil?->nama_yayasan ?? 'Baitul Yatim'); ?></p>
                    <p style="font-size:10px;color:#888;"><?php echo e($profil?->alamat ?? '-'); ?></p>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <table class="info-table">
            <tr>
                <td class="label">Kepada</td>
                <td class="value"><?php echo e($donation->donor_name); ?></td>
                <td class="label" style="padding-left:40px;">Order ID</td>
                <td class="value"><?php echo e($donation->order_id); ?></td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td class="value"><?php echo e($donation->donor_email); ?></td>
                <td class="label" style="padding-left:40px;">Tanggal</td>
                <td class="value"><?php echo e($donation->created_at ? $donation->created_at->format('d M Y H:i') : '-'); ?></td>
            </tr>
            <tr>
                <td class="label"><?php echo e($donation->donor_phone ? 'No. WA' : ''); ?></td>
                <td class="value"><?php echo e($donation->donor_phone ?? ''); ?></td>
                <td class="label" style="padding-left:40px;">Status</td>
                <td>
                    <?php if($donation->status === 'success'): ?>
                        <span class="status status-success">LUNAS</span>
                    <?php elseif($donation->status === 'pending'): ?>
                        <span class="status status-pending">TERTUNDA</span>
                    <?php else: ?>
                        <span class="status status-failed">GAGAL</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th class="right">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Donasi <?php echo e($donation->campaign?->title ?? 'Program Donasi'); ?></strong><br>
                    <span style="color:#888;font-size:10px;">Metode: <?php echo e($donation->payment_method ?? '-'); ?></span>
                </td>
                <td class="right">Rp <?php echo e(number_format($donation->amount, 0, ',', '.')); ?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td class="right">Rp <?php echo e(number_format($donation->amount, 0, ',', '.')); ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Terima kasih atas donasi Anda. Setiap rupiah berarti bagi mereka yang membutuhkan.</p>
        <p><strong>— <?php echo e($profil?->nama_yayasan ?? 'Baitul Yatim'); ?> —</strong></p>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/invoices/donation_pdf.blade.php ENDPATH**/ ?>