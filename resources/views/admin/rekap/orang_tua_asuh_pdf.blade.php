<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Rekap Sponsorship</title>
<style>
body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #333; margin: 20px; }
h1 { color: #059669; font-size: 18px; margin: 0 0 4px; }
.sub { color: #888; font-size: 10px; margin-bottom: 16px; }
.summary { margin-bottom: 16px; }
.summary table { width: auto; }
.summary td { padding: 4px 16px 4px 0; }
.summary .label { color: #888; font-size: 9px; text-transform: uppercase; letter-spacing: 1px; }
.summary .value { font-weight: bold; font-size: 14px; color: #059669; }
table.data { width: 100%; border-collapse: collapse; }
table.data th { background: #ecfdf5; color: #065f46; padding: 6px 8px; text-align: left; font-size: 8px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #059669; }
table.data td { padding: 5px 8px; border-bottom: 1px solid #d1fae5; }
table.data td.right { text-align: right; }
.status { display: inline-block; padding: 1px 6px; border-radius: 2px; font-size: 8px; font-weight: bold; }
.status-aktif { background: #d1fae5; color: #065f46; }
.status-pending { background: #fef3c7; color: #92400e; }
.status-kadaluarsa { background: #f3f4f6; color: #6b7280; }
.status-gagal { background: #fee2e2; color: #991b1b; }
.footer { border-top: 1px solid #d1fae5; padding-top: 10px; text-align: center; font-size: 8px; color: #888; margin-top: 20px; }
</style>
</head>
<body>
<h1>Rekap Data Sponsorship (Orang Tua Asuh)</h1>
<p class="sub">Periode: {{ request('start_date', 'Awal') }} — {{ request('end_date', 'Sekarang') }} | Dicetak: {{ now()->translatedFormat('d F Y H:i') }}</p>

<div class="summary">
<table>
<tr><td class="label">Total Dana Terkumpul</td><td class="value">Rp {{ number_format($totalAmount, 0, ',', '.') }}</td></tr>
<tr><td class="label">Jumlah Sponsorship</td><td class="value">{{ $sponsorships->count() }}</td></tr>
</table>
</div>

<table class="data">
<thead>
<tr>
<th>Donatur</th><th>Email</th><th>No. HP</th><th>Anak Asuh</th><th>Paket</th><th class="right">Nominal</th><th>Metode</th><th>Periode Mulai</th><th>Periode Berakhir</th><th>Status</th>
</tr>
</thead>
<tbody>
@forelse($sponsorships as $s)
@php
$isExpired = $s->expires_at && $s->expires_at->isPast();
$statusKey = match(true) {
$s->status === 'pending' => 'pending',
$s->status === 'success' && !$isExpired => 'aktif',
$s->status === 'success' && $isExpired => 'kadaluarsa',
$s->status === 'expired' => 'kadaluarsa',
default => 'gagal',
};
$statusLabel = match($statusKey) { 'aktif' => 'Aktif', 'pending' => 'Pending', 'kadaluarsa' => 'Kadaluarsa', default => 'Gagal' };
@endphp
<tr>
<td><strong>{{ $s->donor_name }}</strong></td>
<td style="font-family:monospace;font-size:8px;">{{ $s->donor_email }}</td>
<td>{{ $s->donor_phone ?? '-' }}</td>
<td>{{ $s->fosterChild?->name ?? '-' }}</td>
<td>{{ $s->package ?? '-' }}</td>
<td class="right">Rp {{ number_format($s->amount, 0, ',', '.') }}</td>
<td>{{ $s->payment_method ?? '-' }}</td>
<td>{{ $s->starts_at ? $s->starts_at->format('d/m/Y') : '-' }}</td>
<td>{{ $s->expires_at ? $s->expires_at->format('d/m/Y') : '-' }}</td>
<td><span class="status status-{{ $statusKey }}">{{ $statusLabel }}</span></td>
</tr>
@empty
<tr><td colspan="10" style="text-align:center;padding:30px;color:#888;">Tidak ada data sponsorship</td></tr>
@endforelse
</tbody>
</table>

<div class="footer">
<p>— Yayasan Baitul Yatim Sukabumi —</p>
</div>
</body>
</html>
