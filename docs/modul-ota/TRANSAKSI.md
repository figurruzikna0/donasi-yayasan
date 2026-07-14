# Modul Orang Tua Asuh (OTA) — Sistem Transaksi & Integrasi Midtrans

## Alur Transaksi Sponsorship

```
DONATUR                   SERVER LARAVEL                      MIDTRANS
   │                            │                                 │
   │  1. Pilih anak + paket     │                                 │
   │  POST /foster-children/    │                                 │
   │        {id}/sponsor        │                                 │
   │───────────────────────────>│                                 │
   │                            │  2. Validasi:                  │
   │                            │     donor_name, email, phone    │
   │                            │     amount (100rb–500rb)        │
   │                            │     paket_komitmen (required)   │
   │                            │     payment_method              │
   │                            │                                 │
   │                            │  3. Sponsorship::create(       │
   │                            │     order_id = SPONSOR-{uniqid} │
   │                            │     status = pending            │
   │                            │     starts_at = null            │
   │                            │     expires_at = null           │
   │                            │   )                             │
   │                            │                                 │
   │                            │  4. initMidtrans()             │
   │                            │                                 │
   │                            │  5. Snap::getSnapToken({...})  │
   │                            │──────────────────────────────> │
   │                            │                                 │
   │                            │  6. Snap Token                 │
   │                            │<────────────────────────────── │
   │                            │                                 │
   │  7. View sponsor_payment   │                                 │
   │<───────────────────────────│                                 │
   │                            │                                 │
   │  8. Snap pop-up → bayar   │                                 │
   │───────────────────────────────────────────────────────────> │
   │                            │                                 │
   │                            │ 9. Webhook callback            │
   │                            │<────────────────────────────── │
   │                            │                                 │
   │                            │ 10. DonationController@callback│
   │                            │     → deteksi prefix SPONSOR-  │
   │                            │     → settlement/capture       │
   │                            │       ├ status = success       │
   │                            │       ├ starts_at = now()      │
   │                            │       ├ expires_at = now()+1bln │
   │                            │       ├ anak.status = Diasuh   │
   │                            │       ├ kirim WA (dgn detail   │
   │                            │       │   anak asuh)           │
   │                            │       └ kirim Email sukses     │
```

## Siklus Hidup Sponsorship

```
REGISTRASI                      AKTIF                      EXPIRED
   │                              │                          │
   ▼                              ▼                          ▼
┌─────────┐   callback/approve  ┌────────┐   cronjob       ┌─────────┐
│ PENDING │ ──────────────────> │ SUCCESS│ ──────────────> │ EXPIRED │
└─────────┘                     └───┬────┘                  └────┬────┘
       │                            │                           │
       │ callback deny/fail         │ H-7: Email reminder       │ anak → Tersedia
       ▼                            │ H-3: WA reminder         ▼
   ┌───────┐                       │                        (siap disponsori
   │ FAILED│                       ▼                          ulang)
   └───────┘            ┌──────────────────┐
                        │ starts_at terisi │
                        │ expires_at terisi│
                        │ anak → Diasuh    │
                        └──────────────────┘
```

## Detail Parameter Midtrans (Sponsorship)

```php
$params = [
    'transaction_details' => [
        'order_id'     => 'SPONSOR-6a564e2597f0d',
        'gross_amount' => 200000,
    ],
    'customer_details' => [
        'first_name' => 'Donatur',
        'email'      => 'donatur@example.com',
        'phone'      => '6281234567890',
    ],
];
```

## Callback Response Mapping

| `transaction_status` | Aksi Sistem | Status DB |
|---------------------|-------------|-----------|
| `settlement` / `capture` | Update success, set starts_at/expires_at (+1 bln), anak → Diasuh, WA + Email | `success` |
| `pending` | Tidak ada perubahan | `pending` |
| `deny` / `cancel` / `expire` | Update failed | `failed` |

## Notifikasi Khusus OTA

| Trigger | Channel | Isi |
|---------|---------|-----|
| Sponsorship sukses | WA | Nama anak asuh, usia, JK, paket, nominal, masa berlaku, order ID |
| Sponsorship sukses | Email | Data sponsorship + anak asuh |
| Laporan perkembangan | WA + Foto | Judul laporan, deskripsi, foto anak via `sendWithMedia()` |
| H-7 expired | Email | Pengingat perpanjangan sponsorship |
| H-3 expired | WA | Pengingat perpanjangan via WA |

## Fallback Error Handling

| Skenario | Penanganan |
|----------|-----------|
| Midtrans down (Snap gagal) | Try-catch → log error → redirect back + flash error |
| Anak tanpa sponsorship aktif di form perkembangan | Controller filter `whereHas('sponsorships', success)` — anak tidak muncul |
| Submit perkembangan tanpa sponsorship aktif | Redirect back + error *"Anak ini belum memiliki sponsorship aktif."* |
| WA laporan gagal (Fonnte free plan) | `sendWithMedia()` hanya untuk paket berbayar → log error |
