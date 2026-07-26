# Modul Donasi — Black-Box Testing

## Campaign (CRUD)

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Buat Campaign | Judul, deskripsi, target, gambar | Campaign tersimpan, gambar terupload | ✅ |
| Edit Campaign | Data baru + ganti gambar | Campaign terupdate, gambar lama terhapus | ✅ |
| Hapus Campaign | Klik hapus | Campaign + donasi terkait terhapus, gambar terhapus | ✅ |
| Lihat Campaign Publik | Akses halaman utama | Card campaign + progress bar tampil | ✅ |
| Campaign Completed | Admin ubah status | Tidak muncul di daftar publik | ✅ |

## Transaksi Donasi (Manual Transfer)

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Submit Donasi Valid | Nominal Rp50.000, upload bukti JPG, transfer_date diisi | Donation record `pending`, file tersimpan, redirect dashboard | ✅ |
| Submit Donasi < Min | Nominal Rp500 | Error validasi amount min 1000 | ✅ |
| Submit Donasi tanpa Login | Akses form tanpa session | Redirect ke `/login` | ✅ |
| Submit tanpa bukti transfer | File tidak dipilih | Error validasi payment_proof required | ✅ |
| Upload progress bar | Pilih file bukti | Progress bar muncul, persentase berjalan | ✅ |
| Loading spinner | Klik "Kirim Donasi" | Tombol berubah jadi spinner + "Memproses..." | ✅ |
| Approve Manual (Admin) | Klik "Konfirmasi" di transaksi pending | Status → success, invoice_number ter-generate, collected_amount bertambah, WA terkirim | ✅ |
| Reject Manual (Admin) | Klik "Tolak" + isi alasan | Status → failed, rejection_reason terisi, WA tolak terkirim | ✅ |
| Hapus Transaksi | Klik "Hapus" | Data donasi + file bukti terhapus | ✅ |
| Invoice HTML | Akses URL invoice | Detail donasi + logo yayasan tampil | ✅ |
| Invoice PDF | Klik download PDF | File PDF terdownload | ✅ |
| Invoice akses bukan pemilik | Donatur A coba lihat invoice Donatur B | 404 / forbidden | ✅ |

## Rekap Donasi

| Skenario | Input | Hasil Diharapkan | Hasil |
|----------|-------|-----------------|-------|
| Filter Rekap | Pilih status, date range | Tabel difilter, count + total amount sesuai | ✅ |
| Export CSV Donasi | Klik export CSV | File CSV terdownload | ✅ |
| Export PDF Donasi | Klik export PDF | File PDF landscape A4 dengan kop yayasan | ✅ |
| Export Donatur | Klik export | CSV/PDF data donatur | ✅ |
