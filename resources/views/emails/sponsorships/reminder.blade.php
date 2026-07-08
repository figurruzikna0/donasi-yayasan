<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Pengingat Perpanjangan Sponsorship</title></head>
<body style="margin:0;padding:0;background:#f0fdf4;font-family:'Segoe UI',Tahoma,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0"><tr><td align="center" style="padding:40px 16px;">
<table width="560" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);">
<tr><td style="background:linear-gradient(135deg,#d97706,#f59e0b);padding:36px 32px;text-align:center;">
<div style="width:56px;height:56px;background:rgba(255,255,255,.2);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin-bottom:12px;">
<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg>
</div>
<h1 style="margin:0;color:#fff;font-size:20px;font-weight:800;">Sponsorship Akan Berakhir</h1>
<p style="margin:6px 0 0;color:rgba(255,255,255,.85);font-size:14px;">Jangan lewatkan kesempatan untuk melanjutkan kebaikan</p>
</td></tr>
<tr><td style="padding:32px;">
<p style="margin:0 0 6px;color:#374151;font-size:15px;">Assalamu'alaikum, <strong>{{ $sponsorship->donor_name }}</strong></p>
<p style="margin:0 0 16px;color:#6b7280;font-size:14px;line-height:1.6;">Kami ingin mengingatkan bahwa masa sponsorship Anda untuk:</p>

<table width="100%" cellpadding="12" cellspacing="0" style="background:#f9fafb;border-radius:12px;margin-bottom:16px;">
<tr><td colspan="2" style="border-bottom:1px solid #e5e7eb;color:#d97706;font-size:13px;font-weight:700;padding-bottom:8px;">DATA ANAK ASUH</td></tr>
<tr><td style="border-bottom:1px solid #e5e7eb;color:#6b7280;font-size:13px;width:110px;">Nama</td><td style="border-bottom:1px solid #e5e7eb;color:#111827;font-size:14px;font-weight:600;">{{ $sponsorship->fosterChild?->name ?? 'Anak Asuh' }}</td></tr>
<tr><td style="border-bottom:1px solid #e5e7eb;color:#6b7280;font-size:13px;">Paket</td><td style="border-bottom:1px solid #e5e7eb;color:#111827;font-size:14px;">{{ $sponsorship->package ?? '-' }}</td></tr>
<tr><td style="color:#6b7280;font-size:13px;">Berakhir</td><td style="color:#dc2626;font-size:14px;font-weight:700;">{{ $sponsorship->expires_at ? \Carbon\Carbon::parse($sponsorship->expires_at)->translatedFormat('d F Y') : '-' }}</td></tr>
</table>

<p style="margin:0 0 20px;color:#6b7280;font-size:14px;line-height:1.6;">Untuk memperpanjang masa sponsorship, silakan login ke akun Anda dan lakukan perpanjangan sebelum tanggal tersebut.</p>

<div style="text-align:center;margin-bottom:20px;">
<a href="{{ url('/login') }}" style="display:inline-block;padding:12px 28px;background:linear-gradient(135deg,#047857,#10b981);color:#fff;border-radius:10px;font-weight:700;font-size:14px;text-decoration:none;">Login & Perpanjang →</a>
</div>

<p style="margin:0 0 4px;color:#374151;font-size:14px;">Terima kasih atas kebaikan dan kepedulian Anda selama ini.</p>
<p style="margin:0;color:#6b7280;font-size:13px;">— <em>Baitul Yatim</em></p>
</td></tr>
<tr><td style="background:#f9fafb;padding:16px 32px;text-align:center;border-top:1px solid #e5e7eb;">
<p style="margin:0;color:#9ca3af;font-size:12px;">Yayasan Baitul Yatim Sukabumi &bull; baitulyatim.org</p>
</td></tr>
</table>
</td></tr></table>
</body>
</html>
