<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Rekap Donasi</title>
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
table.data th.right { text-align: right; }
table.data td { padding: 5px 8px; border-bottom: 1px solid #d1fae5; }
table.data td.right { text-align: right; }
.status { display: inline-block; padding: 1px 6px; border-radius: 2px; font-size: 8px; font-weight: bold; }
.status-success { background: #d1fae5; color: #065f46; }
.status-pending { background: #fef3c7; color: #92400e; }
.status-failed { background: #fee2e2; color: #991b1b; }
.footer { border-top: 1px solid #d1fae5; padding-top: 10px; text-align: center; font-size: 8px; color: #888; margin-top: 20px; }
</style>
</head>
<body>
<h1>Rekap Data Donasi</h1>
<p class="sub">Periode: {{ request('start_date', 'Awal') }} — {{ request('end_date', 'Sekarang') }} | Dicetak: {{ now()->translatedFormat('d F Y H:i') }}</p>

<div class="summary">
<table>
<tr><td class="label">Total Dana Terkumpul</td><td class="value">Rp {{ number_format($totalAmount, 0, ',', '.') }}</td></tr>
<tr><td class="label">Jumlah Transaksi</td><td class="value">{{ $donations->count() }}</td></tr>
</table>
</div>

<table class="data">
<thead>
<tr>
<th>Order ID</th><th>Donatur</th><th>Email</th><th>Kampanye</th><th class="right">Nominal</th><th>Metode</th><th>Status</th><th>Tanggal</th>
</tr>
</thead>
<tbody>
@forelse($donations as $d)
<tr>
<td style="font-family:monospace;font-size:8px;">{{ $d->order_id ?? '-' }}</td>
<td><strong>{{ $d->donor_name }}</strong></td>
<td>{{ $d->donor_email }}</td>
<td>{{ $d->campaign?->title ?? '-' }}</td>
<td class="right">Rp {{ number_format($d->amount, 0, ',', '.') }}</td>
<td>{{ $d->payment_method ?? '-' }}</td>
<td>
@if($d->status == 'success') <span class="status status-success">Sukses</span>
@elseif($d->status == 'pending') <span class="status status-pending">Pending</span>
@else <span class="status status-failed">Gagal</span> @endif
</td>
<td>{{ $d->created_at ? $d->created_at->format('d/m/Y H:i') : '-' }}</td>
</tr>
@empty
<tr><td colspan="8" style="text-align:center;padding:30px;color:#888;">Tidak ada data donasi</td></tr>
@endforelse
</tbody>
</table>

<div class="footer">
<p>— Yayasan Baitul Yatim Sukabumi —</p>
</div>
</body>
</html>
