# Modul Donasi — Business Rules

## Aturan Khusus Donasi Campaign

| Kondisi | Tindakan Sistem | Otoritas |
|---------|----------------|----------|
| Donasi nominal < Rp 1.000 | Validasi `min:1000` → validation error | Tidak bisa submit |
| Order ID donasi (`DONASI-{uniqid}`) duplikat | Kolom UNIQUE → duplicate entry error | Sistem tolak |
| Donatur belum login akses form donasi | Redirect ke `/login` (middleware `auth`) | Sistem |
| File bukti > 5MB atau bukan JPG/PNG/PDF | Validasi `max:5120` + `mimes:jpg,jpeg,png,pdf` → error | Tidak bisa submit |
| Admin approve donasi pending | `TransactionController@approve()` — status→success, increment collected_amount, generate invoice_number, kirim WA via Fonnte | Admin |
| Admin reject donasi pending | `TransactionController@reject()` — status→failed, isi rejection_reason, kirim WA tolak | Admin |
| Campaign dihapus (admin) | Cascade hapus donasi terkait + hapus file gambar | Admin |
| Donatur submit donasi > 10x/menit | `throttle:10,1` → 429 Too Many Requests | Diblokir sementara |
| Campaign status `completed` (collected >= target) | Tetap tampil di publik dengan label "Tercapai" | Sistem (otomatis) |
| Invoice diakses bukan pemilik | Cek `user_id` vs `Auth::id()` → 404 | Sistem |
| Invoice diakses untuk status pending/failed | Cek `status === 'success'` → 404 | Sistem |
| WA Fonnte gagal | Try-catch → log error → transaksi tetap sukses | Sistem (non-bloking) |

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
                   │ payment_prf│
                   │ trf_date   │
                   └────────────┘
```

**Foreign Keys:**
- `donations.campaign_id` → `campaigns.id` (ON DELETE CASCADE)
- `donations.user_id` → `users.id` (ON DELETE SET NULL)
