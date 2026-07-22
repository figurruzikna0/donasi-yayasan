# Modul Donasi — Black-Box Testing

## Campaign (CRUD)

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Buat Campaign | Judul, deskripsi, target, gambar | Campaign tersimpan, gambar terupload | ✅ |
| Edit Campaign | Data baru + ganti gambar | Campaign terupdate, gambar lama terhapus | ✅ |
| Hapus Campaign | Klik hapus | Campaign + donasi terkait terhapus, gambar terhapus | ✅ |
| Lihat Campaign Publik | Akses halaman utama | Card campaign + progress bar tampil | ✅ |
| Campaign Completed | Admin ubah status | Tidak muncul di daftar aktif | ✅ |

## Transaksi Donasi

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Submit Donasi Valid | Nominal Rp 50.000, pilih metode bayar | Donation record `pending`, redirect ke payment view | ✅ |
| Submit Donasi < Min | Nominal Rp 500 | Error validasi amount | ✅ |
| Submit Donasi tanpa Login | Akses form tanpa session | Redirect ke `/login` | ✅ |
| Snap Pop-up Muncul | Klik "Pilih Metode Pembayaran" | Pop-up Midtrans dengan channel bayar | ✅ |
| Callback Settlement | Midtrans kirim `settlement` | Status → `success`, collected_amount bertambah | ✅ |
| Callback Deny | Midtrans kirim `deny` | Status → `failed` | ✅ |
| Invoice HTML | Akses URL invoice | Detail donasi + data yayasan tampil | ✅ |
| Invoice PDF | Klik download PDF | File PDF terdownload | ✅ |
| Approve Manual (Admin) | Klik "Konfirmasi" di transaksi pending | Status → success, WA terkirim | ✅ |
| Hapus Transaksi | Klik "Hapus" | Data donasi terhapus | ✅ |
| Sync All | Klik "Sync All" | Semua donasi pending dicek ke Midtrans | ✅ |

## Rekap Donasi

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Filter Rekap | Pilih status, date range | Tabel difilter, count + total amount sesuai | ✅ |
| Export CSV Donasi | Klik export CSV | File CSV terdownload | ✅ |
| Export PDF Donasi | Klik export PDF | File PDF landscape A4 | ✅ |
