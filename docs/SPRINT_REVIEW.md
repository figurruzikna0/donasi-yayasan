# Sprint — Review dan Retrospeksi

## A. Pengujian Sistem (Black-Box Testing)

### Modul Autentikasi

| Skenario Pengujian | Input yang Diberikan | Hasil yang Diharapkan | Hasil Pengujian |
|--------------------|---------------------|----------------------|-----------------|
| Login Admin | Email + password admin valid | Masuk ke Dashboard Admin (`/admin/dashboard`) | Sesuai (Valid) |
| Login Donatur | Email + password donatur valid | Masuk ke Dashboard Donatur (`/dashboard`) | Sesuai (Valid) |
| Login Gagal | Email tidak terdaftar / password salah | Tampil error validasi, tetap di halaman login | Sesuai (Valid) |
| Register Donatur | Nama, email, password, no HP, alamat, NIK valid | Akun terdaftar, redirect ke dashboard, email verifikasi terkirim | Sesuai (Valid) |
| Register dengan Email Duplikat | Email yang sudah terdaftar | Error validasi `email already exists` | Sesuai (Valid) |
| Logout | Klik tombol logout | Session dihapus, redirect ke halaman utama | Sesuai (Valid) |
| Lupa Password | Email terdaftar | Link reset password terkirim ke email | Sesuai (Valid) |
| Reset Password | Token + password baru valid | Password berubah, redirect ke login | Sesuai (Valid) |

### Modul Master Data (Admin)

| Skenario Pengujian | Input yang Diberikan | Hasil yang Diharapkan | Hasil Pengujian |
|--------------------|---------------------|----------------------|-----------------|
| CRUD Campaign | Judul, deskripsi, target, gambar | Campaign tersimpan/ditampilkan/dihapus di database | Sesuai (Valid) |
| CRUD Berita | Judul, konten, foto, kategori, status draft/publish | Berita tersimpan, slug auto-generate, foto terupload | Sesuai (Valid) |
| CRUD Anak Asuh | Nama, usia, JK, foto, deskripsi | Anak asuh tersimpan, foto di storage | Sesuai (Valid) |
| Edit Profil Yayasan | Nama yayasan, logo, alamat, kontak, visi-misi, legalitas | Data profil yayasan terupdate | Sesuai (Valid) |
| Tambah/Hapus Pendiri | Nama, jabatan, deskripsi, foto | Pendiri tersimpan/dihapus termasuk foto dari storage | Sesuai (Valid) |
| CRUD Perkembangan Anak | Anak asuh (dengan sponsorship aktif), judul, deskripsi, foto | Laporan tersimpan, WA + foto terkirim ke sponsor | Sesuai (Valid) |
| Akses Perkembangan (Pending) | Klik "Isi Perkembangan" untuk anak dengan status sponsorship pending | Anak tidak muncul di daftar form (filter otomatis) | Sesuai (Valid) |
| Akses Perkembangan (Success) | Klik "Isi Perkembangan" untuk anak dengan sponsorship success | Form input berhasil dibuka | Sesuai (Valid) |

### Modul Transaksi Donasi Campaign

| Skenario Pengujian | Input yang Diberikan | Hasil yang Diharapkan | Hasil Pengujian |
|--------------------|---------------------|----------------------|-----------------|
| Submit Donasi | Pilih campaign, isi nominal min Rp 1.000, pilih metode bayar | Donation record terbuat (status pending), redirect ke halaman pembayaran Midtrans | Sesuai (Valid) |
| Midtrans Snap Pop-up | Klik "Pilih Metode Pembayaran" | Pop-up Midtrans muncul dengan berbagai channel pembayaran | Sesuai (Valid) |
| Pembayaran Sukses (Callback) | Midtrans kirim webhook `settlement` | Status → `success`, `collected_amount` terincrement, WA + Email terkirim | Sesuai (Valid) |
| Pembayaran Gagal (Callback) | Midtrans kirim webhook `deny`/`cancel`/`expire` | Status → `failed` | Sesuai (Valid) |
| Invoice HTML | Akses URL invoice donasi | Tampil detail donasi + data yayasan | Sesuai (Valid) |
| Invoice PDF | Klik download PDF donasi | File PDF terdownload dengan format yang benar | Sesuai (Valid) |

### Modul Transaksi Sponsorship (Orang Tua Asuh)

| Skenario Pengujian | Input yang Diberikan | Hasil yang Diharapkan | Hasil Pengujian |
|--------------------|---------------------|----------------------|-----------------|
| Submit Sponsorship | Pilih anak asuh, nominal Rp 100.000–500.000, pilih paket + metode bayar | Sponsorship record terbuat (status pending), redirect ke halaman pembayaran Midtrans | Sesuai (Valid) |
| Pembayaran Sukses (Callback) | Midtrans kirim webhook `settlement` | Status → `success`, `starts_at`/`expires_at` terisi (+1 bulan), anak → `Diasuh`, WA + Email terkirim | Sesuai (Valid) |
| Invoice + PDF | Akses invoice sponsorship | HTML + PDF sponsorship tampil benar | Sesuai (Valid) |
| Expired Otomatis | `expires_at` sudah lewat (cronjob) | Status → `expired`, anak → `Tersedia` (jika tidak ada sponsor aktif lain) | Sesuai (Valid) |
| Reminder H-7 | Sponsorship akan expired dalam 7 hari | Email reminder terkirim | Sesuai (Valid) |
| Reminder H-3 | Sponsorship akan expired dalam 3 hari | WA reminder terkirim | Sesuai (Valid) |

### Modul Manajemen Transaksi (Admin)

| Skenario Pengujian | Input yang Diberikan | Hasil yang Diharapkan | Hasil Pengujian |
|--------------------|---------------------|----------------------|-----------------|
| Lihat Riwayat Transaksi | Akses `/admin/transactions` | Tabel donasi + sponsorship dengan stat cards (total, sukses, pending) | Sesuai (Valid) |
| Approve Transaksi | Klik "Konfirmasi" pada transaksi pending | Status → `success`, notifikasi WA + Email terkirim | Sesuai (Valid) |
| Hapus Transaksi | Klik "Hapus" pada transaksi | Data transaksi terhapus dari database | Sesuai (Valid) |
| Sync All | Klik "Sync All" | Semua transaksi pending dicek ke Midtrans, status diupdate massal | Sesuai (Valid) |

### Modul Dashboard & Rekap

| Skenario Pengujian | Input yang Diberikan | Hasil yang Diharapkan | Hasil Pengujian |
|--------------------|---------------------|----------------------|-----------------|
| Dashboard Admin | Akses `/admin/dashboard` | Total dana, campaign aktif, stat anak, top 5 campaign, cashflow 12 bulan (chart) | Sesuai (Valid) |
| Dashboard Donatur | Akses `/dashboard` | Daftar campaign, berita, anak asuh, riwayat donasi/sponsor user | Sesuai (Valid) |
| Rekap Donasi (Admin) | Filter status, search, date range | Tabel donasi difilter, count + total amount | Sesuai (Valid) |
| Ekspor CSV Donasi | Klik export CSV | File CSV terdownload | Sesuai (Valid) |
| Ekspor PDF Donasi | Klik export PDF | File PDF landscape A4 terdownload | Sesuai (Valid) |
| Rekap Donatur | Search + filter | Tabel donatur | Sesuai (Valid) |
| Rekap Orang Tua Asuh | Filter status | Tabel sponsorship + status | Sesuai (Valid) |

### Modul Manajemen User

| Skenario Pengujian | Input yang Diberikan | Hasil yang Diharapkan | Hasil Pengujian |
|--------------------|---------------------|----------------------|-----------------|
| Lihat Daftar User | Akses `/admin/users` | Tabel donatur (paginated) + daftar admin | Sesuai (Valid) |
| Edit User | Ubah nama, email, role | Data user terupdate | Sesuai (Valid) |
| Hapus Donatur | Hapus user dengan role donatur | User terhapus, data transaksi tetap ada (user_id → null) | Sesuai (Valid) |
| Hapus Admin | Coba hapus user dengan role admin | Error *"Tidak bisa menghapus akun admin."* | Sesuai (Valid) |

### Modul Notifikasi

| Skenario Pengujian | Input yang Diberikan | Hasil yang Diharapkan | Hasil Pengujian |
|--------------------|---------------------|----------------------|-----------------|
| WA Donasi Sukses | Donasi settlement via callback/approve | WA konfirmasi diterima nomor donatur | Sesuai (Valid) |
| WA Sponsor Sukses | Sponsorship settlement via callback/approve | WA konfirmasi + detail anak asuh diterima | Sesuai (Valid) |
| WA Laporan Perkembangan | Admin input laporan + upload foto | WA + foto diterima nomor sponsor | Sesuai (Valid) |
| Email Donasi Sukses | Donasi settlement | Email konfirmasi diterima email donatur | Sesuai (Valid) |
| Email Sponsor Sukses | Sponsorship settlement | Email konfirmasi diterima | Sesuai (Valid) |

### Modul Access Control & Keamanan

| Skenario Pengujian | Input yang Diberikan | Hasil yang Diharapkan | Hasil Pengujian |
|--------------------|---------------------|----------------------|-----------------|
| Akses Admin tanpa Login | Akses `/admin/dashboard` tanpa session | Redirect ke `/login` | Sesuai (Valid) |
| Akses Admin sebagai Donatur | Login donatur, akses `/admin/dashboard` | Error 403 *"Akses ditolak"* | Sesuai (Valid) |
| Akses Donasi tanpa Login | Akses `/campaign/{id}/donate` tanpa session | Redirect ke `/login` | Sesuai (Valid) |
| Akses Invoice Milik Orang Lain | Donatur A akses invoice donasi Donatur B | Error 403 | Sesuai (Valid) |
| Form Donasi Spam | Submit >10x dalam 1 menit | 429 Too Many Requests | Sesuai (Valid) |
| Register Berulang | Register >5x dalam 30 detik | 429 Too Many Requests | Sesuai (Valid) |

---

## B. User Acceptance Test (UAT)

### Hasil UAT oleh Admin Yayasan

| No | Modul | Penguji | Tanggal | Status | Catatan |
|----|-------|---------|---------|--------|---------|
| 1 | Autentikasi (Login/Register) | Admin Yayasan | Juli 2026 | ✅ Lolos | - |
| 2 | Profil Yayasan & Pendiri | Admin Yayasan | Juli 2026 | ✅ Lolos | - |
| 3 | Berita Kegiatan (CRUD) | Admin Yayasan | Juli 2026 | ✅ Lolos | - |
| 4 | Campaign Donasi (CRUD) | Admin Yayasan | Juli 2026 | ✅ Lolos | - |
| 5 | Data Anak Asuh (CRUD) | Admin Yayasan | Juli 2026 | ✅ Lolos | - |
| 6 | Donasi Campaign + Midtrans | Admin Yayasan | Juli 2026 | ✅ Lolos | - |
| 7 | Sponsorship OTA + Midtrans | Admin Yayasan | Juli 2026 | ✅ Lolos | - |
| 8 | Perkembangan Anak + WA | Admin Yayasan | Juli 2026 | ✅ Lolos | - |
| 9 | Manajemen Transaksi | Admin Yayasan | Juli 2026 | ✅ Lolos | Sync All berfungsi |
| 10 | Dashboard & Statistik | Admin Yayasan | Juli 2026 | ✅ Lolos | Cashflow chart sesuai |
| 11 | Rekap & Ekspor (CSV/PDF) | Admin Yayasan | Juli 2026 | ✅ Lolos | - |
| 12 | Manajemen User | Admin Yayasan | Juli 2026 | ✅ Lolos | Proteksi hapus admin ok |
| 13 | Notifikasi WA & Email | Admin Yayasan | Juli 2026 | ✅ Lolos | - |
| 14 | Akses Kontrol (Role/Verified) | Admin Yayasan | Juli 2026 | ✅ Lolos | - |

**Kesimpulan UAT:** Seluruh modul dinyatakan **lolos uji tanpa perbaikan mayor**. Sistem siap diimplementasikan.

---

## C. Serah Terima (BAST)

### Berita Acara Serah Terima (BAST)

**Nomor:** BAST/BY/2026/001

Pada hari ini, \_\_\_\_ Juli 2026, bertempat di Sekretariat Yayasan Baitul Yatim Sukabumi, telah dilakukan serah terima sistem informasi donasi dan sponsorship sebagai berikut:

**Pihak Pertama (Pengembang):**
- Nama: \_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_
- Jabatan: \_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_
- Bertindak sebagai: Developer / Tim Teknis

**Pihak Kedua (Pengguna):**
- Nama: \_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_
- Jabatan: \_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_
- Bertindak sebagai: Pimpinan Yayasan Baitul Yatim Sukabumi / Product Owner

**Ruang Lingkup Serah Terima:**

| No | Item | Keterangan |
|----|------|------------|
| 1 | Source Code | Aplikasi Laravel + database migration |
| 2 | Database | MySQL dengan 18 tabel |
| 3 | Dokumentasi | File map, data flow, risk map, change guide |
| 4 | Product Backlog | 41 item backlog (prioritas tinggi/sedang/rendah) |
| 5 | ERD & LRS | 9 entitas utama dengan relasi lengkap |
| 6 | HIPO | 13 modul dengan input-proses-output |
| 7 | Integrasi Eksternal | Midtrans Snap (sandbox/production) + Fonnte WA |
| 8 | Business Rules | 49 aturan bisnis terdokumentasi |

**Hasil Pengujian:**
- Black-box Testing: ✅ Seluruh skenario valid
- User Acceptance Test: ✅ Lolos 14 modul tanpa perbaikan mayor

Demikian Berita Acara Serah Terima ini dibuat untuk digunakan sebagaimana mestinya.

| | Pihak Pertama (Pengembang) | Pihak Kedua (Pengguna) |
|--|---------------------------|------------------------|
| Tanda Tangan | \_\_\_\_\_\_\_\_\_\_\_\_\_ | \_\_\_\_\_\_\_\_\_\_\_\_\_ |
| Nama | \_\_\_\_\_\_\_\_\_\_\_\_\_ | \_\_\_\_\_\_\_\_\_\_\_\_\_ |
| Tanggal | \_\_\_\_ Juli 2026 | \_\_\_\_ Juli 2026 |
