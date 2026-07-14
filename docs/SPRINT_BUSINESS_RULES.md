# Sprint — Manajemen Aturan Bisnis (Business Rule)

## A. Validasi Perkembangan Anak (Referensi Utama)

| Kondisi Transaksi | Tindakan Sistem Otomatis | Otoritas Admin |
|------------------|-------------------------|----------------|
| Status Sponsorship `pending` / `failed` / `expired` | Sistem menyembunyikan anak dari daftar form perkembangan. Controller `ChildDevelopmentController@create()` hanya menampilkan anak dengan `whereHas('sponsorships', fn => status = 'success')`. | Tidak dapat mengisi |
| Status Sponsorship `success` & belum expired | Sistem menampilkan anak pada form perkembangan. Saat submit, controller mencari sponsorship aktif terakhir. | Dapat mengisi data + upload foto |
| Tidak ada sponsorship aktif | `store()` redirect back dengan error: *"Anak ini belum memiliki sponsorship aktif."* | Form tidak bisa disubmit |

## B. Role & Access Control

| Kondisi | Tindakan Sistem | Otoritas |
|---------|----------------|----------|
| User mengakses `/admin/*` | `AdminMiddleware` cek `role === 'admin'` | Hanya Admin |
| User belum login mencoba donasi/sponsor | Middleware `auth` → redirect ke `/login` | Tamuu tidak bisa |
| Email belum diverifikasi | Middleware `verified` → redirect ke `/verify-email` | Donatur tidak bisa donasi |
| Admin mencoba menghapus admin lain | `UserController@destroy()` → abort dengan error *"Tidak bisa menghapus akun admin."* | Tidak bisa |
| User update role | Validasi `in:admin,donatur` — hanya 2 role yang valid | Admin |
| Donatur hapus akun sendiri | `ProfileController@destroy()` → required password confirmation | Hanya pemilik akun |

## C. Transaksi & Pembayaran

| Kondisi | Tindakan Sistem Otomatis | Otoritas |
|---------|-------------------------|----------|
| Donasi nominal < Rp 1.000 | Validasi `min:1000` → validation error | Tidak bisa submit |
| Sponsor nominal < Rp 100.000 | Validasi `min:100000` → validation error | Tidak bisa submit |
| Sponsor nominal > Rp 500.000 | Validasi `max:500000` → validation error | Tidak bisa submit |
| Order ID sudah ada di database | Kolom `order_id` UNIQUE — duplicate entry error | Sistem tolak duplikat |
| Midtrans Snap gagal generate | Try-catch → log error → redirect back + flash error | Donatur disuruh coba lagi |
| Callback Midtrans status `settlement` / `capture` | Update status → `success` → increment `collected_amount` (donasi) / set anak `Diasuh` (sponsor) → kirim WA + Email | Otomatis |
| Callback Midtrans status `deny` / `cancel` / `expire` | Update status → `failed` | Otomatis |
| Admin approve transaksi pending | `TransactionController@approve()` → status → `success` → increment / anak Diasuh → WA + Email | Admin |
| Sync transaksi ke Midtrans | `Transaction::status()` → update sesuai response Midtrans | Admin (Sync All / per-item) |
| Donatur pilih metode bayar | Daftar metode dari Midtrans (VA, QRIS, GoPay, ShopeePay, dll) — tidak terbatas | Donatur |
| Form donasi/sponsor disubmit berulang dalam 1 menit | `throttle:10,1` → 429 Too Many Requests | Diblokir sementara |

## D. Sponsorship & Masa Berlaku

| Kondisi | Tindakan Sistem Otomatis | Otoritas |
|---------|-------------------------|----------|
| Sponsorship success pertama | Set `starts_at = now()`, `expires_at = now() + 1 bulan` | Otomatis via callback |
| H-7 sebelum expired | Cronjob `sponsorships:send-email-reminders` → kirim email reminder → set `reminder_sent_at` | Otomatis |
| H-3 sebelum expired | Cronjob `sponsorships:check-due` → kirim WA reminder | Otomatis |
| `expires_at` sudah lewat | Cronjob `sponsorships:check-due` → set status `expired` | Otomatis |
| Sponsorship expired, anak masih Diasuh | Cronjob cek apakah masih ada sponsorship aktif lain → jika tidak ada, reset anak ke `Tersedia` | Otomatis |
| Admin approve sponsorship | Set `starts_at` / `expires_at` (default +1 bulan), anak → `Diasuh` | Admin |

## E. Manajemen Data

| Kondisi | Tindakan Sistem | Otoritas |
|---------|----------------|----------|
| Campaign dihapus | Cascade hapus semua donasi terkait + hapus file gambar dari storage | Admin |
| News dihapus | Hapus file `foto_utama` dari storage | Admin |
| Anak asuh dihapus | Cascade hapus sponsorship + perkembangan terkait + hapus file foto | Admin |
| Donatur dihapus | `user_id` di donations/sponsorships → `NULL` (data transaksi tetap ada) | Admin / Diri sendiri |
| File upload > 2MB | Validasi `max:2048` → validation error | Tidak bisa upload |
| File selain gambar (jpg/png/webp) | Validasi `mimes:jpeg,png,jpg,webp` → validation error | Tidak bisa upload |
| News status `draft` | Hanya muncul di admin, tidak tampil di publik (via `scopePublished()`) | Hanya Admin lihat |
| Campaign status `completed` | Tidak tampil di daftar campaign aktif di halaman utama | Admin ubah manual |

## F. Notifikasi

| Kondisi | Tindakan Sistem | Via |
|---------|----------------|-----|
| Donasi sukses (callback/approve/sync) | Kirim pesan WA + Email konfirmasi ke donatur | Fonnte + SMTP |
| Sponsorship sukses (callback/approve/sync) | Kirim pesan WA + Email konfirmasi ke donatur | Fonnte + SMTP |
| Admin input laporan perkembangan | Kirim WA + foto ke nomor sponsor | Fonnte (sendWithMedia) |
| Sponsorship mau expired (H-7) | Kirim email pengingat | SMTP |
| Sponsorship mau expired (H-3) | Kirim WA pengingat | Fonnte |
| Nomor HP donatur mulai `0` | Mutator otomatis ganti `0` → `62` (contoh: `0812...` → `62812...`) | Model Sponsorship |
| Token Fonnte kosong | `RuntimeException` di konstruktor | Sistem mati |

## G. Database Integrity (Referential Action)

| Tabel Anak | Foreign Key | Saat Parent Dihapus |
|-----------|-------------|-------------------|
| `donations` | `campaign_id` → `campaigns` | ✅ **CASCADE** — donasi ikut terhapus |
| `donations` | `user_id` → `users` | ⚠️ **SET NULL** — donasi tetap ada, user_id jadi null |
| `sponsorships` | `foster_child_id` → `foster_children` | ✅ **CASCADE** — sponsorship ikut terhapus |
| `sponsorships` | `user_id` → `users` | ⚠️ **SET NULL** — sponsorship tetap ada |
| `child_developments` | `sponsorship_id` → `sponsorships` | ✅ **CASCADE** — laporan ikut terhapus |
| `child_developments` | `foster_child_id` → `foster_children` | ✅ **CASCADE** — laporan ikut terhapus |
| `child_developments` | `user_id` → `users` | ⚠️ **SET NULL** — laporan tetap ada |

---

## Ringkasan

| Kategori | Jumlah Aturan |
|----------|--------------|
| Perkembangan Anak | 3 |
| Role & Access Control | 6 |
| Transaksi & Pembayaran | 11 |
| Sponsorship & Masa Berlaku | 6 |
| Manajemen Data | 9 |
| Notifikasi | 7 |
| Database Integrity | 7 |
| **Total** | **49 aturan bisnis** |
