# Backlog, HIPO, Aturan & Pengujian — Modul Bersama

Bagian ini mencakup fitur-fitur yang digunakan bersama oleh **Modul Donasi** dan **Modul Orang Tua Asuh (OTA)**. Detail spesifik masing-masing modul ada di folder `modul-donasi/` dan `modul-ota/`.

---

## 1. Product Backlog — Bersama

| ID | User Story | Prioritas |
|----|-----------|-----------|
| PB-B-01 | Sebagai Admin, saya ingin login ke dashboard dengan aman untuk mengelola sistem. | Tinggi |
| PB-B-02 | Sebagai Admin, saya ingin melihat dashboard ringkasan (total dana, campaign aktif, statistik anak asuh, cashflow 12 bulan) untuk memantau kinerja yayasan. | Tinggi |
| PB-B-03 | Sebagai Admin, saya ingin mengelola profil yayasan (nama, logo, alamat, kontak, visi-misi, legalitas) agar informasi yayasan selalu terkini. | Tinggi |
| PB-B-04 | Sebagai Admin, saya ingin mengelola pendiri yayasan (tambah/hapus) untuk menampilkan struktur pengurus. | Tinggi |
| PB-B-05 | Sebagai Admin, saya ingin mengelola berita/kegiatan (CRUD + upload foto, draft/publish) untuk menginformasikan kegiatan yayasan. | Tinggi |
| PB-B-06 | Sebagai Admin, saya ingin mengelola data pengguna (lihat, edit, hapus donatur) untuk memelihara data user. | Tinggi |
| PB-B-07 | Sebagai Donatur, saya ingin mendaftar akun (nama, email, password, no HP, alamat, NIK) untuk dapat menggunakan sistem. | Tinggi |
| PB-B-08 | Sebagai Donatur, saya ingin login ke akun saya dengan aman. | Tinggi |
| PB-B-09 | Sebagai Donatur, saya ingin melihat dashboard berisi campaign, berita, anak asuh, dan riwayat transaksi saya. | Tinggi |
| PB-B-10 | Sebagai Donatur, saya ingin melihat riwayat dan rekap transaksi saya. | Sedang |
| PB-B-11 | Sebagai Donatur, saya ingin mengedit profil akun saya (termasuk upload avatar). | Sedang |
| PB-B-12 | Sebagai Donatur, saya ingin mengubah password akun saya. | Sedang |
| PB-B-13 | Sebagai Donatur, saya ingin menghapus akun saya sendiri. | Rendah |
| PB-B-14 | Sebagai Tamuu, saya ingin melihat halaman utama yayasan (campaign aktif, berita terbaru, statistik) untuk mengetahui program yayasan. | Tinggi |
| PB-B-15 | Sebagai Tamuu, saya ingin melihat profil yayasan (sejarah, visi-misi, legalitas). | Tinggi |
| PB-B-16 | Sebagai Tamuu, saya ingin melihat daftar pengurus/pendiri yayasan. | Tinggi |
| PB-B-17 | Sebagai Tamuu, saya ingin membaca berita/kegiatan yayasan. | Tinggi |
| PB-B-18 | Sebagai Tamuu, saya ingin mendaftar menjadi donatur. | Tinggi |
| PB-B-19 | Sebagai Tamuu, saya ingin mereset password jika lupa. | Sedang |
| PB-B-20 | Sebagai Sistem, saya menerima notifikasi pembayaran dari Midtrans (callback) dan memperbarui status transaksi secara otomatis. | Tinggi |
| PB-B-21 | Sebagai Sistem, saya mengirim notifikasi WhatsApp ke donatur saat transaksi berhasil dikonfirmasi. | Tinggi |
| PB-B-22 | Sebagai Sistem, saya mengirim WA pengingat untuk sponsorship yang akan kadaluwarsa (H-7 & H-3). | Sedang |
| PB-B-24 | Sebagai Sistem, saya memperbarui status sponsorship menjadi expired dan mengembalikan status anak menjadi Tersedia jika masa berlaku habis. | Sedang |

---

## 2. HIPO — Bersama

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Registrasi | Nama, email, password, no HP, alamat, NIK | `RegisteredUserController@store()` — validasi → create user → auto-login | Redirect ke dashboard |
| Login | Email & password | `AuthenticatedSessionController@store()` — autentikasi → cek role → redirect | Redirect ke `/admin/dashboard` (admin) atau `/dashboard` (donatur) |
| Lupa Password | Email | `PasswordResetLinkController@store()` — kirim link reset via email (nonaktif, hanya tercatat di log) | Log tercatat |
| Profil Yayasan | Logo, alamat, kontak, visi-misi, legalitas | `ProfilYayasanController@update()` — validasi → upload file → update | Data profil tersimpan |
| Pendiri | Nama, jabatan, foto | `PendiriController@store()` / `destroy()` | Pendiri tersimpan/dihapus |
| Berita | Judul, konten, foto, status | `NewsController` CRUD | Berita tampil di publik |
| Dashboard Admin | - | `DashboardController@index()` — query total funds, cashflow 12 bulan, dll | View dashboard + chart |
| Dashboard Donatur | - | `DonorController@dashboard()` — query data user | View dashboard donatur |
| Manajemen User | Data user | `UserController@index()/edit()/update()/destroy()` | Data user terkelola |
| Rekap & Ekspor | Filter + search | `RekapController@donasi()/donatur()/orangTuaAsuh()` + export CSV/PDF | Tabel + file download |
| Notifikasi WA | Data transaksi | `FonnteService::send()` / `sendWithMedia()` | WA terkirim |


---

## 3. Business Rules — Bersama

| Kondisi | Tindakan Sistem | Otoritas |
|---------|----------------|----------|
| User akses `/admin/*` | `AdminMiddleware` cek `role === 'admin'` | Hanya Admin |
| User belum login | Middleware `auth` → redirect ke `/login` | Tamuu tidak bisa |
| Email belum diverifikasi | Middleware `verified` → redirect ke `/verify-email` (email nonaktif, verifikasi tidak berfungsi) | Donatur tetap bisa akses |
| Admin hapus admin lain | `UserController@destroy()` → error *"Tidak bisa menghapus akun admin."* | Tidak bisa |
| Donatur hapus akun sendiri | `ProfileController@destroy()` → required password confirmation | Hanya pemilik |
| File upload > 2MB / 3MB | Validasi `max:2048`/`max:3072` → validation error | Tidak bisa upload |
| File bukan gambar | Validasi `mimes:jpeg,png,jpg,webp` → validation error | Tidak bisa upload |
| News status `draft` | `scopePublished()` — tidak tampil di publik | Hanya Admin |
| Campaign dihapus | Cascade hapus semua donasi + hapus gambar | Admin |
| Donatur dihapus | `user_id` di transaksi → `NULL` (data tetap ada) | Admin / Diri sendiri |
| Form submit > 10x/menit | `throttle:10,1` → 429 Too Many Requests | Diblokir sementara |

---

## 4. Black-Box Testing — Bersama

| Skenario Pengujian | Input | Hasil Diharapkan | Hasil |
|--------------------|-------|-----------------|-------|
| Login Admin | Email + password admin valid | Masuk ke `/admin/dashboard` | ✅ |
| Login Donatur | Email + password donatur valid | Masuk ke `/dashboard` | ✅ |
| Login Gagal | Email/password salah | Error validasi, tetap di login | ✅ |
| Register Donatur | Data valid | Akun terdaftar (email nonaktif, verifikasi tidak terkirim) | ✅ |
| Logout | Klik logout | Session dihapus, redirect ke home | ✅ |
| Lupa + Reset Password | Email terdaftar | Link reset tercatat di log (email nonaktif), password berubah | ✅ |
| CRUD Profil Yayasan | Logo, teks, legalitas | Data profil terupdate | ✅ |
| CRUD Pendiri | Nama, jabatan, foto | Pendiri tersimpan/dihapus | ✅ |
| CRUD Berita | Judul, konten, foto, status | Berita tersimpan, slug auto | ✅ |
| Dashboard Admin | Akses `/admin/dashboard` | Stat + chart cashflow tampil | ✅ |
| Dashboard Donatur | Akses `/dashboard` | Riwayat + daftar campaign tampil | ✅ |
| Rekap Donasi | Filter, search, date range | Tabel + count + total amount | ✅ |
| Ekspor CSV/PDF | Klik export | File terdownload | ✅ |
| Manajemen User | Edit/hapus user | Data terupdate, admin tidak bisa dihapus | ✅ |
| Akses Admin tanpa Login | Akses `/admin/*` | Redirect ke `/login` | ✅ |
| Akses Admin sbg Donatur | Login donatur, akses admin | 403 Forbidden | ✅ |
| Akses Invoice Orang Lain | Donatur A akses invoice B | 403 Forbidden | ✅ |
| Throttle Donasi | Submit >10x/menit | 429 Too Many Requests | ✅ |
| Notifikasi WA | Transaksi sukses | WA konfirmasi terkirim | ✅ |
