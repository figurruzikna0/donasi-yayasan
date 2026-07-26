# Modul Donasi — Sistem Transaksi Manual (Transfer Bank)

## Alur Transaksi Donasi Campaign

Sistem menggunakan **transfer bank manual** (bukan payment gateway). Donatur upload bukti transfer, admin validasi secara manual.

```
DONATUR (login)               SERVER LARAVEL                    ADMIN
      │                             │                             │
      │  1. Lihat campaign          │                             │
      │  GET /campaign/{id}        │                             │
      │────────────────────────────>│                             │
      │                             │                             │
      │  2. Klik "Donasi Sekarang" │                             │
      │  GET /campaign/{id}/donate │                             │
      │────────────────────────────>│                             │
      │                             │                             │
      │  3. Form donasi tampil      │                             │
      │  - Nama, Email, No. WA     │                             │
      │  - Nominal (10k/20k/50k/   │                             │
      │    100k / manual)          │                             │
      │  - Info rekening BSI       │                             │
      │    7122-8023-98            │                             │
      │    a.n. Baitul Yatim       │                             │
      │  - Upload bukti transfer   │                             │
      │  - Tanggal transfer        │                             │
      │<────────────────────────────│                             │
      │                             │                             │
      │  4. Submit form             │                             │
      │  POST /campaign/{id}/donate│                             │
      │────────────────────────────>│                             │
      │                             │                             │
      │  5. Validasi:              │                             │
      │     donor_name, email,      │                             │
      │     phone, amount (min1000),│                             │
      │     payment_proof (file),   │                             │
      │     transfer_date (date)    │                             │
      │                             │                             │
      │  6. Upload payment_proof    │                             │
      │     ke storage/public/      │                             │
      │     payment-proofs/         │                             │
      │                             │                             │
      │  7. Donation::create(       │                             │
      │     order_id=DONASI-{uniqid},│                             │
      │     status=pending,         │                             │
      │     payment_method=         │                             │
      │       'Transfer Bank'       │                             │
      │   )                         │                             │
      │                             │                             │
      │  8. Redirect dashboard      │                             │
      │     + flash success         │                             │
      │<────────────────────────────│                             │
      │                             │                             │
      │                             │  9. Buka Riwayat Transaksi │
      │                             │  GET /admin/transactions    │
      │                             │<────────────────────────────│
      │                             │                             │
      │                             │  10. Lihat bukti transfer  │
      │                             │  Klik "Lihat Bukti"        │
      │                             │                             │
      │                             │  11. Approve donasi        │
      │                             │  PATCH /admin/transactions │
      │                             │  /{id}/approve             │
      │                             │────────────────────────────>│
      │                             │                             │
      │                             │  12. Update status:       │
      │                             │  → success                 │
      │                             │  → generate invoice_number │
      │                             │  → increment               │
      │                             │    collected_amount        │
      │                             │                             │
      │                             │  13. WA via Fonnte         │
      │                             │  "Donasi RpX untuk         │
      │                             │   {campaign} telah          │
      │                             │   dikonfirmasi"             │
      │<────────────────────────────│                             │
      │                             │                             │
      │  14. Donatur buka invoice   │                             │
      │  GET /donations/{id}/invoice│                             │
      │────────────────────────────>│                             │
      │                             │                             │
      │  15. Invoice HTML           │                             │
      │  - Logo yayasan             │                             │
      │  - Invoice kepada           │                             │
      │  - No. invoice              │                             │
      │  - Detail donasi            │                             │
      │  - Status LUNAS             │                             │
      │<────────────────────────────│                             │
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
 generate invoice_number
 WA ke donatur via Fonnte
```

## State Transaksi Donasi (dengan Reject)

```
     ┌──────────┐
     │ PENDING  │
     └────┬─────┘
          │
     ┌────┴────────────┐
     │                 │
     ▼                 ▼
 ┌───────┐     ┌──────────────┐
 │SUKSES │     │ FAILED       │
 └───┬───┘     │ (rejection   │
     │         │  reason)     │
     ▼         └──────────────┘
 collected_amount += amount
 invoice_number generated
 WA: konfirmasi       WA: tolak + alasan
```

## Order ID Format

| Tipe | Format | Contoh |
|------|--------|--------|
| Donasi | `DONASI-{uniqid}` | `DONASI-67c3f8a1b2c3d` |
| Sponsorship | `SPONSOR-{uniqid}` | `SPONSOR-67c3f8a1b2c3e` |

## Invoice Number Format

| Tipe | Format | Contoh |
|------|--------|--------|
| Donasi | `INV-DN-{tahun}{bulan}-{nomor urut}` | `INV-DN-202607-0001` |

## Notifikasi WhatsApp (via Fonnte)

| Event | Template |
|-------|----------|
| Donasi di-approve | "✅ *Donasi Berhasil Dikonfirmasi!* Donasi Anda sebesar *Rp{nominal}* untuk campaign *{judul}* telah dikonfirmasi. Terima kasih atas dukungan Anda. — Baitul Yatim Sukabumi" |
| Donasi ditolak | "✗ *Donasi Ditolak* Donasi Anda sebesar *Rp{nominal}* untuk campaign *{judul}* ditolak. Alasan: {alasan}. Silakan hubungi admin. — Baitul Yatim Sukabumi" |
| Sponsorship di-approve | Template serupa dengan konteks sponsorship |
| Laporan perkembangan anak | Teks deskripsi + foto anak asuh via `sendWithMedia()` |

## Error Handling

| Skenario | Penanganan |
|----------|-----------|
| Upload file gagal | Validasi file: max 5MB, format JPG/PNG/PDF → error flash ke donatur |
| WA gagal dikirim | Log error → transaksi tetap sukses (WA non-bloking) |
| Nomor WA tidak valid | Normalisasi ke 62xxx, jika tetap gagal → di-log |
| Duplikasi order_id | Kolom UNIQUE → exception → redirect back + error flash |
