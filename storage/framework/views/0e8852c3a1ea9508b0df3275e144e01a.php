<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Donasi Berhasil</title></head>
<body style="margin:0;padding:0;background:#f0fdf4;font-family:'Segoe UI',Tahoma,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0"><tr><td align="center" style="padding:40px 16px;">
<table width="560" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);">
<tr><td style="background:linear-gradient(135deg,#047857,#10b981);padding:36px 32px;text-align:center;">
<div style="width:56px;height:56px;background:rgba(255,255,255,.2);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin-bottom:12px;">
<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
</div>
<h1 style="margin:0;color:#fff;font-size:22px;font-weight:800;">Donasi Berhasil</h1>
<p style="margin:6px 0 0;color:rgba(255,255,255,.85);font-size:14px;">Terima kasih atas kebaikan Anda</p>
</td></tr>
<tr><td style="padding:32px;">
<p style="margin:0 0 6px;color:#374151;font-size:15px;">Assalamu'alaikum, <strong><?php echo e($donation->donor_name); ?></strong></p>
<p style="margin:0 0 20px;color:#6b7280;font-size:14px;line-height:1.6;">Alhamdulillah, pembayaran donasi Anda telah kami terima. Semoga menjadi amal jariyah yang tak terputus pahalanya.</p>
<table width="100%" cellpadding="12" cellspacing="0" style="background:#f9fafb;border-radius:12px;margin-bottom:20px;">
<tr><td style="border-bottom:1px solid #e5e7eb;color:#6b7280;font-size:13px;width:110px;">Program</td><td style="border-bottom:1px solid #e5e7eb;color:#111827;font-size:14px;font-weight:600;"><?php echo e($donation->campaign?->title ?? 'Program Donasi'); ?></td></tr>
<tr><td style="border-bottom:1px solid #e5e7eb;color:#6b7280;font-size:13px;">Nominal</td><td style="border-bottom:1px solid #e5e7eb;color:#059669;font-size:16px;font-weight:700;">Rp <?php echo e(number_format($donation->amount, 0, ',', '.')); ?></td></tr>
<tr><td style="border-bottom:1px solid #e5e7eb;color:#6b7280;font-size:13px;">Metode</td><td style="border-bottom:1px solid #e5e7eb;color:#111827;font-size:14px;"><?php echo e($donation->payment_method ?? '-'); ?></td></tr>
<tr><td style="color:#6b7280;font-size:13px;">ID Transaksi</td><td style="color:#111827;font-size:13px;font-family:monospace;"><?php echo e($donation->order_id); ?></td></tr>
</table>
<p style="margin:0 0 4px;color:#374151;font-size:14px;">Semoga Allah SWT membalas kebaikan Anda dengan berlipat ganda. Aamiin.</p>
<p style="margin:0;color:#6b7280;font-size:13px;">— <em>Baitul Yatim</em></p>
</td></tr>
<tr><td style="background:#f9fafb;padding:16px 32px;text-align:center;border-top:1px solid #e5e7eb;">
<p style="margin:0;color:#9ca3af;font-size:12px;">Yayasan Baitul Yatim Sukabumi &bull; baitulyatim.org</p>
</td></tr>
</table>
</td></tr></table>
</body>
</html>
<?php /**PATH C:\laragon\www\donasi-yayasan\resources\views/emails/donations/success.blade.php ENDPATH**/ ?>