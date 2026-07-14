# Modul Orang Tua Asuh (OTA) — Business Rules

## Aturan Khusus Sponsorship & Perkembangan Anak

### A. Transaksi Sponsorship

| Kondisi | Tindakan Sistem | Otoritas |
|---------|----------------|----------|
| Nominal sponsor < Rp 100.000 | Validasi `min:100000` → validation error | Tidak bisa submit |
| Nominal sponsor > Rp 500.000 | Validasi `max:500000` → validation error | Tidak bisa submit |
| Paket komitmen tidak diisi | Validasi `required` → validation error | Tidak bisa submit |
| Order ID (`SPONSOR-{uniqid}`) duplikat | Kolom UNIQUE → duplicate entry error | Sistem tolak |
| Callback settlement/capture pertama | `status → success`, `starts_at = now()`, `expires_at = now() + 1 bulan`, anak → `Diasuh` | Otomatis |
| Callback deny/cancel/expire | `status → failed` | Otomatis |
| Callback settlement lanjutan (perpanjangan) | `status → success`, `starts_at = now()`, `expires_at = now() + 1 bulan` (reset masa berlaku) | Otomatis |
| Admin approve sponsorship | `TransactionController@approve()` — sama seperti callback | Admin |

### B. Masa Berlaku & Expired

| Kondisi | Tindakan Sistem | Otoritas |
|---------|----------------|----------|
| H-7 sebelum expired | Cronjob `sponsorships:send-email-reminders` → kirim email → set `reminder_sent_at` | Otomatis |
| H-3 sebelum expired | Cronjob `sponsorships:check-due.sendReminders()` → kirim WA reminder | Otomatis |
| `expires_at` sudah lewat | Cronjob `sponsorships:check-due.expireOverdue()` → status `expired` | Otomatis |
| Sponsorship expired, anak masih Diasuh | Cek apakah masih ada sponsorship aktif lain → jika tidak, anak → `Tersedia` | Otomatis |
| Tidak ada sponsorship aktif | Anak tampil dengan status `Tersedia` di publik | - |

### C. Perkembangan Anak

| Kondisi | Tindakan Sistem | Otoritas |
|---------|----------------|----------|
| Status sponsorship `pending` / `failed` / `expired` | `ChildDevelopmentController@create()` filter → anak tidak muncul di daftar form | Admin tidak bisa akses |
| Status sponsorship `success` & belum expired | Anak tampil di form perkembangan | Admin bisa isi |
| Submit perkembangan tanpa sponsorship aktif | `store()` redirect back + error *"Anak ini belum memiliki sponsorship aktif."* | Tidak bisa submit |
| Laporan perkembangan berhasil dibuat | Kirim WA + foto via `FonnteService::sendWithMedia()` ke nomor sponsor | Otomatis |
| Hapus laporan perkembangan | Hapus file foto dari storage | Admin |

### D. Normalisasi Nomor HP

| Kondisi | Tindakan Sistem |
|---------|----------------|
| Donatur input `081234567890` | Mutator `setDonorPhoneAttribute()` → `6281234567890` |
| Donatur input `+6281234567890` | Strip non-digit → `6281234567890` |

## Entity Relationship (OTA)

```
┌──────────┐       ┌──────────────────┐       ┌──────────────────┐
│  USERS   │       │ FOSTER_CHILDREN  │       │  SPONSORSHIPS    │
├──────────┤       ├──────────────────┤       ├──────────────────┤
│ id (PK)  │<──┐   │ id (PK)          │<──┐   │ id (PK)          │
│ role     │   │   │ name             │   │   │ order_id (UQ)    │
└──────────┘   │   │ age              │   │   │ foster_child_id  │──┘
               │   │ jenis_kelamin    │   │   │ user_id          │──┐
               │   │ status           │   │   │ amount           │   │
               │   │ (Tersedia/       │   │   │ package          │   │
               │   │  Diasuh)         │   │   │ status           │   │
               │   └──────────────────┘   │   │ starts_at        │   │
               │                          │   │ expires_at       │   │
               │                          │   └──────────────────┘   │
               │                          │                          │
               │   ┌──────────────────┐   │                          │
               │   │CHILD_DEVELOPMENTS│   │                          │
               │   ├──────────────────┤   │                          │
               └──>│ user_id          │   │                          │
                   │ sponsorship_id   │───┘                          │
                   │ foster_child_id  │──┘                            │
                   │ tanggal          │                               │
                   │ judul            │                               │
                   │ foto             │                               │
                   └──────────────────┘                               │
```

**Foreign Keys:**
- `sponsorships.foster_child_id` → `foster_children.id` (CASCADE)
- `sponsorships.user_id` → `users.id` (SET NULL)
- `child_developments.sponsorship_id` → `sponsorships.id` (CASCADE)
- `child_developments.foster_child_id` → `foster_children.id` (CASCADE)
- `child_developments.user_id` → `users.id` (SET NULL)
