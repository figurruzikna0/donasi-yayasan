# Revisi Skenario Black-Box Testing — Modul OTA

Perbaikan berdasarkan kondisi aktual sistem per Juli 2026.

---

## Transaksi Sponsorship ( sebelum → sesudah )

| Skenario | Input | Hasil Diharapkan (Revisi) | Hasil |
|----------|-------|--------------------------|-------|
| Submit Sponsor Valid | Nominal Rp 200.000, paket Reguler, upload bukti transfer | Sponsorship record `pending`, redirect ke dashboard | ✅ |
| Submit Sponsor < Min | Nominal Rp 50.000 | Error validasi amount | ✅ |
| Submit Sponsor > Max | Nominal Rp 1.000.000 | Error validasi amount | ✅ |
| Submit tanpa Paket | Paket kosong | Error validasi paket_komitmen | ✅ |
| ~~Callback Settlement~~ | ~~Midtrans kirim settlement~~ | *Diganti:* | |
| **Konfirmasi Admin** | Admin klik "Konfirmasi" di sponsorship pending | Status → `success`, `starts_at`/`expires_at` terisi, anak → `Diasuh`, WA terkirim | ✅ |
| ~~Callback Deny~~ | ~~Midtrans kirim deny~~ | *Diganti:* | |
| **Tolak Admin** | Admin klik "Tolak" + isi alasan | Status → `failed`, WA penolakan terkirim | ✅ |
| Invoice HTML Sponsor | Akses URL invoice | Detail sponsorship + anak + yayasan | ✅ |
| Invoice PDF Sponsor | Klik download PDF | File PDF terdownload | ✅ |

---

## Perkembangan Anak ( sebelum → sesudah )

| Skenario | Input | Hasil Diharapkan (Revisi) | Hasil |
|----------|-------|--------------------------|-------|
| Akses Form (Sponsor Pending) | Anak dgn sponsorship pending | Anak tidak muncul di daftar form | ✅ |
| Akses Form (Sponsor Success) | Anak dgn sponsorship success | Form bisa diakses, anak muncul di pilihan | ✅ |
| Buat Laporan Valid | Anak + sponsorship aktif, tanggal, judul, deskripsi, foto | Laporan tersimpan, notifikasi WA terkirim, foto bisa diakses via dashboard | ✅ |
| Buat Laporan tanpa Sponsor Aktif | Anak tanpa sponsorship success | Redirect back + error *"belum memiliki sponsorship aktif"* | ✅ |
| Edit Laporan | ID + data baru | Laporan terupdate | ✅ |
| Hapus Laporan | ID | Laporan + foto terhapus | ✅ |
| PDF Laporan | Klik download PDF | File PDF laporan + foto terdownload | ✅ |

---

## Expired & Reminder (Cronjob) — H-7 dihapus

| Skenario | Input | Hasil Diharapkan (Revisi) | Hasil |
|----------|-------|--------------------------|-------|
| ~~Reminder H-7~~ | ~~Expires_at dalam 7 hari~~ | ~~WA reminder terkirim~~ | ❌ *Dihapus — tidak ada di sistem* |
| Reminder H-3 | Expires_at dalam 3 hari | WA reminder terkirim, `reminder_sent_at` terisi | ✅ |
| Expired Otomatis | Expires_at sudah lewat | Status → `expired`, anak → `Tersedia` (jika tdk ada sponsor aktif lain) | ✅ |
| Tidak Reminder Ulang | Reminder sudah dikirim < 7 hari lalu | Tidak ada WA duplikat | ✅ |

---

## Ringkasan Perubahan

| Baris | Sebelum | Sesudah | Alasan |
|-------|---------|---------|--------|
| Transaksi — Callback Settlement | Midtrans settlement → success | **Konfirmasi Admin** → success + WA | Midtrans dinonaktifkan, semua via upload bukti + konfirmasi admin |
| Transaksi — Callback Deny | Midtrans deny → failed | **Tolak Admin** + alasan → failed + WA | Midtrans dinonaktifkan |
| Transaksi — Submit Valid | "redirect ke payment view" | "redirect ke dashboard" | Tidak ada payment view, langsung pending |
| Perkembangan — Laporan Valid | "WA + foto ke sponsor" | "notifikasi WA terkirim, foto via dashboard" | Foto tidak dikirim via WA |
| Reminder H-7 | WA reminder H-7 | **Dihapus** | Hanya H-3 yang diimplementasikan di cronjob |
