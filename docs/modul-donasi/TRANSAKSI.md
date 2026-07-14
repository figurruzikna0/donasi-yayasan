# Modul Donasi — Sistem Transaksi & Integrasi Midtrans

## Alur Transaksi Donasi Campaign

```
DONATUR                   SERVER LARAVEL                      MIDTRANS
   │                            │                                 │
   │  1. Submit form donasi     │                                 │
   │  POST /campaign/{id}/donate│                                 │
   │───────────────────────────>│                                 │
   │                            │  2. Validasi:                  │
   │                            │     donor_name, email, phone    │
   │                            │     amount (min 1000)           │
   │                            │     payment_method              │
   │                            │                                 │
   │                            │  3. Donation::create(          │
   │                            │     order_id = DONASI-{uniqid}, │
   │                            │     status = pending            │
   │                            │   )                             │
   │                            │                                 │
   │                            │  4. initMidtrans()             │
   │                            │     Config::$serverKey          │
   │                            │                                 │
   │                            │  5. Snap::getSnapToken({        │
   │                            │     transaction_details,        │
   │                            │     customer_details            │
   │                            │   })                            │
   │                            │──────────────────────────────> │
   │                            │                                 │
   │                            │  6. Snap Token                 │
   │                            │<────────────────────────────── │
   │                            │                                 │
   │  7. View payment.blade.php │                                 │
   │     (Snap.js + token)     │                                 │
   │<───────────────────────────│                                 │
   │                            │                                 │
   │  8. Klik "Pilih Metode"   │                                 │
   │     Snap pop-up muncul    │                                 │
   │                            │                                 │
   │  9. Pilih channel bayar   │                                 │
   │     (VA BCA, QRIS, GoPay, │                                 │
   │      ShopeePay, dll)      │                                 │
   │───────────────────────────────────────────────────────────> │
   │                            │                                 │
   │ 10. Selesaikan pembayaran  │                                 │
   │     di luar sistem         │                                 │
   │                            │                                 │
   │                            │ 11. Webhook POST /midtrans/     │
   │                            │     callback (bypass CSRF)      │
   │                            │<────────────────────────────── │
   │                            │                                 │
   │                            │ 12. DonationController@callback │
   │                            │     → baca transaction_status   │
   │                            │     → settlement/capture        │
   │                            │       → status = success        │
   │                            │       → campaign->increment(    │
   │                            │           collected_amount      │
   │                            │         )                       │
   │                            │       → kirim WA + Email        │
   │                            │     → deny/cancel/expire        │
   │                            │       → status = failed         │
   │                            │                                 │
```

## State Transaksi Donasi

```
     ┌──────────┐
     │ PENDING  │
     └────┬─────┘
          │
     ┌────┴─────┐
     │          │
     ▼          ▼
 ┌───────┐ ┌───────┐
 │SUKSES │ │FAILED │
 └───┬───┘ └───────┘
     │
     ▼
 collected_amount += amount
 WA + Email ke donatur
```

## Detail Parameter Midtrans (Donasi)

```php
$params = [
    'transaction_details' => [
        'order_id'     => 'DONASI-6a564e2597f0d',
        'gross_amount' => 50000,
    ],
    'customer_details' => [
        'first_name' => 'Figur',
        'email'      => 'figur@example.com',
        'phone'      => '6281234567890',
    ],
];
```

## Callback Response Mapping

| `transaction_status` | Aksi Sistem | Status DB |
|---------------------|-------------|-----------|
| `settlement` / `capture` | Update success, increment collected_amount, kirim WA + Email | `success` |
| `pending` | Tidak ada perubahan | `pending` |
| `deny` / `cancel` / `expire` | Update failed | `failed` |

## Fallback Error Handling

| Skenario | Penanganan |
|----------|-----------|
| Midtrans down (Snap gagal) | Try-catch → log error → redirect back + flash *"Gerbang pembayaran sedang sibuk"* |
| Callback gagal diproses | Log error → tetap return 200 (biar Midtrans tidak retry) |
| Sync gagal (order_id tidak ditemukan) | `Transaction::status()` throw exception → flash error ke admin |
| Email gagal dikirim | Log error → transaksi tetap sukses (WA tetap jalan) |
| WA gagal dikirim | Log error → transaksi tetap sukses (email tetap jalan) |
