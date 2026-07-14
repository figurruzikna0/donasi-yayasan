# Sprint — Sistem Transaksi & Integrasi Eksternal (Midtrans)

## Teknologi Integrasi

| Komponen | Implementasi |
|----------|-------------|
| **Payment Gateway** | Midtrans Snap (pop-up) |
| **SDK** | `midtrans/midtrans-php` |
| **Environment** | Sandbox / Production via `.env` (`MIDTRANS_IS_PRODUCTION`) |
| **Callback** | `POST /midtrans/callback` (bypass CSRF) |
| **Client Key** | `config/midtrans.client_key` → embedded di frontend Snap.js |
| **Server Key** | `config/midtrans.server_key` → digunakan di backend |

## Metode Pembayaran Tersedia (via Midtrans)

Virtual Account (BCA, BNI, BRI, Mandiri, CIMB, Permata, BSI), GoPay, QRIS, ShopeePay, Convenience Store, Kartu Kredit.

## Alur Transaksi Donasi Campaign

```
DONATUR                      SERVER LARAVEL                     MIDTRANS
   │                             │                                 │
   │  1. Submit form donasi      │                                 │
   │────────────────────────────>│                                 │
   │                             │  2. Validasi input              │
   │                             │  3. Donation::create(pending)   │
   │                             │  4. initMidtrans()             │
   │                             │  5. Snap::getSnapToken()       │
   │                             │───────────────────────────────>│
   │                             │                                 │
   │                             │  6. Snap Token                 │
   │                             │<───────────────────────────────│
   │                             │                                 │
   │  7. View payment.blade.php  │                                 │
   │  (embed Snap.js + token)   │                                 │
   │<────────────────────────────│                                 │
   │                             │                                 │
   │  8. Klik "Pilih Metode"    │                                 │
   │  Snap pop-up muncul        │                                 │
   │                             │                                 │
   │  9. Pilih VA / QRIS / dll  │                                 │
   │─────────────────────────────────────────────────────────────>│
   │                             │                                 │
   │ 10. Bayar via channel      │                                 │
   │     (transfer / scan / dll)│                                 │
   │                             │                                 │
   │                             │ 11. Webhook POST /midtrans/     │
   │                             │     callback                    │
   │                             │<───────────────────────────────│
   │                             │                                 │
   │                             │ 12. Update status              │
   │                             │     settlement → success       │
   │                             │     deny/fail    → failed       │
   │                             │                                 │
   │                             │ 13. WA + Email notifikasi      │
   │                             │     ke donatur                 │
   │                             │                                 │
```

### Tabel Tahapan — Donasi Campaign

| Tahapan | Eksekusi Sistem & Interaksi Aktor | Status Database |
|---------|----------------------------------|-----------------|
| **Inisiasi** | Donatur submit form donasi (`POST /campaign/{id}/donate`). Controller validasi input → `Donation::create(['status' => 'pending'])` → init Midtrans Config → kirim payload ke API Midtrans via `Snap::getSnapToken()` → simpan `snap_token` → return view `payment.blade.php`. | `pending` |
| **Pemrosesan** | Donatur melihat halaman pembayaran dengan tombol "Pilih Metode Pembayaran". Snap.js di-load dengan client key. Donatur klik tombol → pop-up Midtrans Snap muncul → donatur memilih channel (VA, QRIS, GoPay, dll) dan menyelesaikan pembayaran di luar sistem. | `pending` |
| **Callback Webhook** | Midtrans mengirim notifikasi HTTP POST ke `POST /midtrans/callback` (bypass CSRF). `DonationController@callback()` membaca `transaction_status` dan `order_id` → update `donations.status` → increment `campaigns.collected_amount` → kirim WA (Fonnte) + Email (SMTP) ke donatur. | `success` / `failed` |
| **Sync Manual (Admin)** | Admin di panel `/admin/transactions` klik **Sync All**. `TransactionController@syncAll()` loop semua order_id pending → panggil `Transaction::status()` ke Midtrans → update massal. Bisa juga **Sync** per-transaksi via `sync($id)` atau **Setujui** manual via `approve($id)`. | sesuai response Midtrans |

## Alur Transaksi Sponsorship (Orang Tua Asuh)

```
DONATUR                      SERVER LARAVEL                     MIDTRANS
   │                             │                                 │
   │  1. Submit form sponsor     │                                 │
   │────────────────────────────>│                                 │
   │                             │  2. Validasi input              │
   │                             │  3. Sponsorship::create(pending)│
   │                             │  4. initMidtrans()             │
   │                             │  5. Snap::getSnapToken()       │
   │                             │───────────────────────────────>│
   │                             │                                 │
   │                             │  6. Snap Token                 │
   │                             │<───────────────────────────────│
   │                             │                                 │
   │  7. View sponsor_payment    │                                 │
   │<────────────────────────────│                                 │
   │                             │                                 │
   │  (sama seperti alur donasi) │                                 │
   │                             │                                 │
   │                             │  Webhook callback              │
   │                             │<───────────────────────────────│
   │                             │                                 │
   │  Hasil:                     │                                 │
   │  - status → success         │                                 │
   │  - starts_at / expires_at   │                                 │
   │  - anak → Diasuh            │                                 │
   │  - WA + Email ke donatur    │                                 │
```

### Tabel Tahapan — Sponsorship

| Tahapan | Eksekusi Sistem & Interaksi Aktor | Status Database |
|---------|----------------------------------|-----------------|
| **Inisiasi** | Donatur submit form sponsor (`POST /foster-children/{id}/sponsor`). Validasi (nominal min 100rb, maks 500rb, paket komitmen required) → `Sponsorship::create(['status' => 'pending'])` → init Midtrans → `Snap::getSnapToken()` → simpan snap_token → return view `sponsor_payment.blade.php`. | `pending` |
| **Pemrosesan** | Donatur memilih metode bayar via Snap pop-up dan membayar. | `pending` |
| **Callback Webhook** | Midtrans callback → `DonationController@callback()` deteksi `SPONSOR-` prefix → update `sponsorships.status` → set `starts_at` / `expires_at` (+1 bulan) → update `foster_children.status = 'Diasuh'` → kirim WA + Email. | `success` / `failed` |
| **Expired Otomatis** | Cronjob harian `sponsorships:check-due` — ubah sponsorship `expired` + reset anak ke `Tersedia` jika tidak ada sponsorship aktif lain. | `expired` |
| **Sync / Approve Admin** | Sama seperti donasi: Sync All via Midtrans, atau Setujui manual via `approve($id)`. | sesuai aksi admin |

## Detail Callback Midtrans

| Aspek | Implementasi |
|-------|-------------|
| **Endpoint** | `POST /midtrans/callback` |
| **CSRF** | Bypass (didaftarkan di `VerifyCsrfToken` exception) |
| **Library** | `\Midtrans\Notification()` — parse notifikasi otomatis |
| **Status mapping** | `settlement` / `capture` → `success`; `deny` / `cancel` / `expire` → `failed`; `pending` → tetap `pending` |
| **Order ID prefix** | `SPONSOR-` → sponsorship; selain itu → donasi campaign |
| **Notifikasi pasca-sukses** | WA via FonnteService + Email via Mail (DonationSuccessMail / SponsorshipSuccessMail) |

### Contoh Payload Callback

```json
{
  "transaction_status": "settlement",
  "order_id": "DONASI-67e4a1f2c3d4e",
  "payment_type": "bank_transfer",
  "va_numbers": [{"bank": "bca", "va_number": "1234567890"}],
  "gross_amount": "50000.00"
}
```

## Fallback & Error Handling

| Skenario | Penanganan | Output |
|----------|-----------|--------|
| Midtrans down (Snap gagal) | Try-catch `Snap::getSnapToken()` → log error → redirect back + error message | Donatur disuruh coba lagi nanti |
| Callback gagal diproses | Try-catch di callback → log error → tetap return 200 (biar Midtrans gak retry forever) | Response JSON 200 |
| Sync gagal (order_id tidak ditemukan di Midtrans) | `Transaction::status()` throw exception → catch → flash error | Admin lihat pesan error |
| Email gagal dikirim | Try-catch `Mail::send()` → log error → transaksi tetap sukses | WA tetap terkirim |
| WA gagal dikirim | Try-catch `FonnteService::send()` → log error → transaksi tetap sukses | Email tetap terkirim |

## Diagram State Transaksi

```
                    ┌─────────┐
                    │ PENDING │
                    └────┬────┘
                         │
              ┌──────────┼──────────┐
              │          │          │
              ▼          ▼          ▼
          ┌──────┐  ┌───────┐  ┌──────┐
          │SUKSES│  │FAILED │  │EXPIRED│
          └──┬───┘  └───────┘  └──────┘
             │
             ▼
    ┌──────────────────┐
    │ collected_amount │
    │ + = amount       │
    │ anak → Diasuh    │
    └──────────────────┘
```

> **Catatan:** Status `expired` hanya berlaku untuk sponsorship (bukan donasi). Donasi hanya punya 3 status: `pending`, `success`, `failed`.
