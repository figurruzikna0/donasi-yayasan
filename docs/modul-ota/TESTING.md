# Modul Orang Tua Asuh (OTA) — Black-Box Testing

## Anak Asuh (CRUD)

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Buat Anak Asuh | Nama, usia, JK, foto | Anak asuh tersimpan, foto terupload | ✅ |
| Edit Anak Asuh | Data baru + ganti foto | Data terupdate, foto lama terhapus | ✅ |
| Hapus Anak Asuh | Klik hapus | Anak + sponsorship + perkembangan terhapus cascade, foto terhapus | ✅ |
| Status Anak Berubah | Approve sponsor | Anak otomatis → `Diasuh` | ✅ |
| Status Anak Kembali | Sponsorship expired, tidak ada yg aktif | Anak otomatis → `Tersedia` | ✅ |

## Transaksi Sponsorship

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Submit Sponsor Valid | Nominal Rp 200.000, paket Reguler, metode bayar | Sponsorship record `pending`, redirect ke payment view | ✅ |
| Submit Sponsor < Min | Nominal Rp 50.000 | Error validasi amount | ✅ |
| Submit Sponsor > Max | Nominal Rp 1.000.000 | Error validasi amount | ✅ |
| Submit tanpa Paket | Paket kosong | Error validasi paket_komitmen | ✅ |
| Callback Settlement | Midtrans kirim `settlement` | Status → `success`, starts_at/expires_at terisi, anak → Diasuh | ✅ |
| Callback Deny | Midtrans kirim `deny` | Status → `failed` | ✅ |
| Invoice HTML Sponsor | Akses URL invoice | Detail sponsorship + anak + yayasan | ✅ |
| Invoice PDF Sponsor | Klik download PDF | File PDF terdownload | ✅ |

## Perkembangan Anak

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Akses Form (Sponsor Pending) | Anak dgn sponsorship pending | Anak tidak muncul di daftar form | ✅ |
| Akses Form (Sponsor Success) | Anak dgn sponsorship success | Form bisa diakses, anak muncul di pilihan | ✅ |
| Buat Laporan Valid | Anak + sponsorship aktif, tanggal, judul, deskripsi, foto | Laporan tersimpan, WA + foto ke sponsor | ✅ |
| Buat Laporan tanpa Sponsor Aktif | Anak tanpa sponsorship success | Redirect back + error *"belum memiliki sponsorship aktif"* | ✅ |
| Edit Laporan | ID + data baru | Laporan terupdate | ✅ |
| Hapus Laporan | ID | Laporan + foto terhapus | ✅ |
| PDF Laporan | Klik download PDF | File PDF laporan + foto terdownload | ✅ |

## Manajemen Sponsor (Admin)

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Approve Sponsor | Klik "Konfirmasi" di pending | Status → success, starts_at/expires_at, anak → Diasuh, WA + Email | ✅ |
| Hapus Sponsor | Klik "Hapus" | Sponsorship terhapus | ✅ |
| Lihat Kontak | Akses `/admin/sponsorships/contacts` | Daftar anak + info sponsor aktif | ✅ |

## Expired & Reminder (Cronjob)

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Reminder H-7 | Expires_at dalam 7 hari | Email reminder terkirim, `reminder_sent_at` terisi | ✅ |
| Reminder H-3 | Expires_at dalam 3 hari | WA reminder terkirim | ✅ |
| Expired Otomatis | Expires_at sudah lewat | Status → `expired`, anak → `Tersedia` (jika tdk ada sponsor aktif lain) | ✅ |
| Tidak Reminder Ulang | Reminder sudah dikirim < 7 hari lalu | Tidak ada email/WA duplikat | ✅ |

## Rekap Orang Tua Asuh

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Filter Rekap OTA | Filter status, search | Tabel sponsorship difilter | ✅ |
| Export CSV OTA | Klik export CSV | File CSV terdownload | ✅ |
| Export PDF OTA | Klik export PDF | File PDF landscape A4 | ✅ |
