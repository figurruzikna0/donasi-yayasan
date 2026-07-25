# Catatan Basis Data — Modul Orang Tua Asuh (OTA)

Dokumen ini mencatat tabel-tabel yang berkaitan dengan **Modul Orang Tua Asuh (OTA)**.

---

## 1. Entity Relationship Diagram (ERD) — Modul OTA

| Entitas Asal | Nama Relasi | Entitas Tujuan | Kardinalitas |
|-------------|-------------|----------------|-------------|
| User (Admin) | Mengelola | Berita Kegiatan | 1 to M |
| User (Admin) | Mengelola | Profil Yayasan | 1 to 1 |
| User (Admin) | Mengelola | Pendiri Yayasan | 1 to M |
| User (Admin) | Mengisi | Perkembangan Anak | 1 to M |
| User (Admin) | Memvalidasi | Transaksi Komitmen Orang Tua Asuh | 1 to M |
| User (Donatur) | Melakukan | Transaksi Komitmen Orang Tua Asuh | 1 to M |
| Transaksi Sponsorship | Diterima | Anak Asuh | M to 1 |
| Anak Asuh | Memiliki | Perkembangan Anak | 1 to M |

**Catatan:** User (Admin) dan User (Donatur) disimpan dalam satu tabel `users` dengan kolom `role` membedakan 'admin' dan 'donatur'.

---

## 2. Logical Record Structure (LRS) — Modul OTA

> **Catatan:** `Admin` dan `Donatur` adalah entitas logis yang tersimpan dalam **1 tabel fisik `users`**, dibedakan oleh kolom `role` ('admin'/'donatur').

| No | Entitas Logis | Tabel Fisik | Primary Key | Foreign Key | Foreign Key ke Tabel |
|----|--------------|-------------|-------------|-------------|----------------------|
| 1 | **Admin** | users | id | — | — |
| 2 | **Donatur** | users | id | — | — |
| 3 | Profil Yayasan | profil_yayasan | id | — | — |
| 4 | Pendiri Yayasan | pendiris | id | — | — |
| 5 | Berita Kegiatan | news | id | — | — |
| 6 | Anak Asuh | foster_children | id | — | — |
| 7 | Transaksi Sponsorship | sponsorships | id | foster_child_id, user_id (Donatur) | foster_children, users |
| 8 | Perkembangan Anak | child_developments | id | sponsorship_id, foster_child_id, user_id (Admin) | sponsorships, foster_children, users |

---

## 3. Spesifikasi File Basis Data — Modul OTA

### a. Spesifikasi file users — Admin

> Entitas logis `Admin` menggunakan tabel fisik `users` dengan kolom `role = 'admin'`.

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama Lengkap Admin |
| 3 | email | VARCHAR | 255 | Email Login (Unique) |
| 4 | email_verified_at | TIMESTAMP | 19 | Nullable |
| 5 | role | VARCHAR | 20 | 'admin' |
| 6 | phone | VARCHAR | 20 | No. HP (nullable) |
| 7 | address | TEXT | - | Alamat (nullable) |
| 8 | avatar | VARCHAR | 255 | Foto Profil (nullable) |
| 9 | password | VARCHAR | 255 | Hash Password |
| 11 | remember_token | VARCHAR | 100 | Nullable |
| 12 | created_at | TIMESTAMP | 19 | - |
| 13 | updated_at | TIMESTAMP | 19 | - |

### b. Spesifikasi file users — Donatur

> Entitas logis `Donatur` menggunakan tabel fisik `users` dengan kolom `role = 'donatur'`.

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama Lengkap Donatur |
| 3 | email | VARCHAR | 255 | Email Login (Unique) |
| 4 | email_verified_at | TIMESTAMP | 19 | Nullable (verifikasi email wajib) |
| 5 | role | VARCHAR | 20 | 'donatur' |
| 6 | phone | VARCHAR | 20 | No. HP/WA (nullable) |
| 7 | address | TEXT | - | Alamat (nullable) |
| 8 | nik | VARCHAR | 20 | NIK (diisi saat registrasi) |
| 9 | avatar | VARCHAR | 255 | Foto Profil (nullable) |
| 10 | password | VARCHAR | 255 | Hash Password |
| 11 | remember_token | VARCHAR | 100 | Nullable |
| 12 | created_at | TIMESTAMP | 19 | - |
| 13 | updated_at | TIMESTAMP | 19 | - |

### c. Spesifikasi file profil_yayasan

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | nama_yayasan | VARCHAR | 255 | - |
| 3 | email | VARCHAR | 255 | - |
| 4 | no_telp | VARCHAR | 20 | - |
| 5 | alamat | TEXT | - | - |
| 6 | sejarah_yayasan | TEXT | - | Nullable |
| 7 | visi | TEXT | - | Nullable |
| 8 | misi | TEXT | - | Nullable |
| 9 | logo | VARCHAR | 255 | Nullable |
| 10 | legalitas | TEXT | - | Nullable |
| 11 | foto_legalitas | VARCHAR | 255 | Nullable |
| 12 | foto_struktur | VARCHAR | 255 | Nullable |
| 13 | created_at | TIMESTAMP | 19 | - |
| 14 | updated_at | TIMESTAMP | 19 | - |

### d. Spesifikasi file pendiris (Pendiri Yayasan)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | nama | VARCHAR | 255 | Nama Pengurus |
| 3 | jabatan | VARCHAR | 255 | Jabatan |
| 4 | deskripsi | TEXT | - | Kata sambutan (nullable) |
| 5 | foto | VARCHAR | 255 | Foto (nullable) |
| 6 | urutan | INTEGER | 11 | Urutan tampil, default 0 |
| 7 | created_at | TIMESTAMP | 19 | - |
| 8 | updated_at | TIMESTAMP | 19 | - |

### e. Spesifikasi file news (Berita Kegiatan)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | judul | VARCHAR | 255 | Judul berita |
| 3 | slug | VARCHAR | 255 | Slug URL (Unique) |
| 4 | kategori | VARCHAR | 50 | Kategori, default 'Kegiatan Umum' |
| 5 | tanggal_kegiatan | DATE | 10 | Tanggal pelaksanaan |
| 6 | lokasi | VARCHAR | 100 | Tempat (nullable) |
| 7 | penyelenggara | VARCHAR | 100 | Penyelenggara (nullable) |
| 8 | ringkasan | TEXT | - | Cuplikan singkat (nullable) |
| 9 | konten | LONGTEXT | - | Isi berita lengkap |
| 10 | foto_utama | VARCHAR | 255 | Gambar sampul (nullable) |
| 11 | status | VARCHAR | 20 | 'draft' atau 'published', default 'draft' |
| 12 | created_at | TIMESTAMP | 19 | - |
| 13 | updated_at | TIMESTAMP | 19 | - |

### f. Spesifikasi file foster_children (Anak Asuh)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama Anak |
| 3 | age | VARCHAR | 10 | Usia (string, bisa "-" jika belum diketahui) |
| 4 | jenis_kelamin | ENUM | 10 | 'Laki-laki' atau 'Perempuan' |
| 5 | description | TEXT | - | Deskripsi (nullable) |
| 6 | photo | VARCHAR | 255 | Foto anak (nullable) |
| 7 | status | ENUM | 8 | 'Tersedia' atau 'Diasuh', default 'Tersedia' |
| 8 | created_at | TIMESTAMP | 19 | - |
| 9 | updated_at | TIMESTAMP | 19 | - |

### g. Spesifikasi file sponsorships (Transaksi Sponsorship)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | foster_child_id | BIGINT | 20 | Anak asuh yang dipilih (FK) |
| 3 | user_id | BIGINT | 20 | Donatur (FK, nullable) |
| 4 | order_id | VARCHAR | 255 | ID transaksi (Unique) |
| 5 | snap_token | VARCHAR | 255 | Token Snap Midtrans (nullable) |
| 6 | donor_name | VARCHAR | 255 | Nama donatur |
| 7 | donor_email | VARCHAR | 255 | Email donatur |
| 8 | donor_phone | VARCHAR | 20 | No. HP donatur (nullable) |
| 9 | amount | DECIMAL | 12,2 | Nominal donasi |
| 10 | package | VARCHAR | 100 | Paket komitmen (nullable) |
| 11 | package_description | TEXT | - | Deskripsi paket (nullable) |
| 12 | payment_method | VARCHAR | 50 | Metode bayar (nullable) |
| 13 | payment_proof | VARCHAR | 255 | Bukti transfer (nullable) |
| 14 | transfer_date | DATE | 10 | Tanggal transfer (nullable) |
| 15 | status | ENUM | 12 | 'pending', 'success', 'failed', 'expired', default 'pending' |
| 16 | starts_at | TIMESTAMP | 19 | Tanggal mulai (nullable) |
| 17 | expires_at | TIMESTAMP | 19 | Tanggal berakhir (nullable) |
| 18 | reminder_sent_at | TIMESTAMP | 19 | Waktu notif H-3 dikirim (nullable) |
| 19 | rejection_reason | TEXT | - | Alasan penolakan (nullable) |
| 20 | created_at | TIMESTAMP | 19 | - |
| 21 | updated_at | TIMESTAMP | 19 | - |

### h. Spesifikasi file child_developments (Perkembangan Anak)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | sponsorship_id | BIGINT | 20 | Sponsorship terkait (FK) |
| 3 | foster_child_id | BIGINT | 20 | Anak Asuh (FK) |
| 4 | user_id | BIGINT | 20 | Admin pengisi (FK, nullable) |
| 5 | tanggal | DATE | 10 | Tanggal laporan |
| 6 | judul | VARCHAR | 255 | Judul laporan |
| 7 | deskripsi | TEXT | - | Isi laporan |
| 8 | foto | VARCHAR | 255 | Foto perkembangan (nullable) |
| 9 | created_at | TIMESTAMP | 19 | - |
| 10 | updated_at | TIMESTAMP | 19 | - |

---

## 4. Tabel di Luar Modul OTA

Tabel berikut digunakan oleh modul lain di luar OTA:

| Tabel | Modul | Keterangan |
|-------|-------|------------|
| campaigns | Modul Donasi | Campaign donasi |
| donations | Modul Donasi | Transaksi donasi campaign |
