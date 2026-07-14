# Modul Donasi — Business Rules

## Aturan Khusus Donasi Campaign

| Kondisi | Tindakan Sistem | Otoritas |
|---------|----------------|----------|
| Donasi nominal < Rp 1.000 | Validasi `min:1000` → validation error | Tidak bisa submit |
| Order ID donasi (`DONASI-{uniqid}`) duplikat | Kolom UNIQUE → duplicate entry error | Sistem tolak |
| Midtrans Snap gagal generate token | Try-catch → log → redirect back + error flash | Donatur coba lagi |
| Callback status `settlement` / `capture` | Update `status → success`, `campaign.collected_amount += amount`, kirim WA + Email | Otomatis |
| Callback status `deny` / `cancel` / `expire` | Update `status → failed` | Otomatis |
| Admin approve donasi pending | `TransactionController@approve()` — sama seperti callback: success + increment + notifikasi | Admin |
| Campaign dihapus | Cascade hapus semua donasi terkait + hapus file gambar | Admin |
| Donatur submit donasi > 10x/menit | `throttle:10,1` → 429 | Diblokir sementara |
| Campaign status `completed` | Tidak tampil di campaign aktif halaman utama | Admin ubah manual |

## Entity Relationship (Donasi)

```
┌──────────┐       ┌────────────┐
│  USERS   │       │ CAMPAIGNS  │
├──────────┤       ├────────────┤
│ id (PK)  │<──┐   │ id (PK)    │<──┐
│ role     │   │   │ title      │   │
└──────────┘   │   │ slug (UQ)  │   │
               │   │ target_amt │   │
               │   │ collected  │   │
               │   │ image      │   │
               │   │ status     │   │
               │   └────────────┘   │
               │                    │
               │   ┌────────────┐   │
               │   │ DONATIONS  │   │
               │   ├────────────┤   │
               └──>│ user_id    │   │
                   │ campaign_id│───┘
                   │ order_id   │
                   │ amount     │
                   │ status     │
                   │ snap_token │
                   └────────────┘
```

**Foreign Keys:**
- `donations.campaign_id` → `campaigns.id` (CASCADE)
- `donations.user_id` → `users.id` (SET NULL)
