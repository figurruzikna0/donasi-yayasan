<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Rekap Donatur</title>
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
.status-verified { background: #d1fae5; color: #065f46; }
.status-unverified { background: #fef3c7; color: #92400e; }
.footer { border-top: 1px solid #d1fae5; padding-top: 10px; text-align: center; font-size: 8px; color: #888; margin-top: 20px; }
</style>
</head>
<body>
<h1>Rekap Data Donatur</h1>
<p class="sub">Periode: {{ request('start_date', 'Awal') }} — {{ request('end_date', 'Sekarang') }} | Dicetak: {{ now()->translatedFormat('d F Y H:i') }}</p>

<div class="summary">
<table>
<tr><td class="label">Total Donatur Terdaftar</td><td class="value">{{ $donaturs->count() }}</td></tr>
<tr><td class="label">Total Donasi Sukses</td><td class="value">Rp {{ number_format($totalDonasiAll, 0, ',', '.') }}</td></tr>
<tr><td class="label">Total Sponsorship Aktif</td><td class="value">{{ $totalSponsorshipAll }}</td></tr>
</table>
</div>

<table class="data">
<thead>
<tr>
<th>Nama</th><th>Email</th><th>No. HP</th><th>NIK</th><th>Alamat</th><th class="right">Donasi</th><th class="right">Sponsor</th><th>Verifikasi</th><th>Terdaftar</th>
</tr>
</thead>
<tbody>
@forelse($donaturs as $u)
<tr>
<td><strong>{{ $u->name }}</strong></td>
<td style="font-family:monospace;font-size:8px;">{{ $u->email }}</td>
<td>{{ $u->phone ?? '-' }}</td>
<td>{{ $u->nik ?? '-' }}</td>
<td style="max-width:120px;">{{ $u->address ?? '-' }}</td>
<td class="right">{{ $u->donations_count }}</td>
<td class="right">{{ $u->sponsorships_count }}</td>
<td>
@if($u->email_verified_at)
<span class="status status-verified">Terverifikasi</span>
@else
<span class="status status-unverified">Belum</span>
@endif
</td>
<td>{{ $u->created_at->format('d/m/Y') }}</td>
</tr>
@empty
<tr><td colspan="9" style="text-align:center;padding:30px;color:#888;">Tidak ada donatur terdaftar</td></tr>
@endforelse
</tbody>
</table>

<div class="footer">
<p>— Yayasan Baitul Yatim Sukabumi —</p>
</div>
</body>
</html>
