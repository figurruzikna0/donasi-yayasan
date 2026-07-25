# Catatan Basis Data — Modul Donasi

Dokumen ini mencatat tabel-tabel yang berkaitan dengan **Modul Donasi**.

---

## 1. Entity Relationship Diagram (ERD) — Modul Donasi

| Entitas Asal | Nama Relasi | Entitas Tujuan | Kardinalitas |
|-------------|-------------|----------------|-------------|
| User (Admin) | Mengelola | Berita Kegiatan | 1 to M |
| User (Admin) | Mengelola | Profil Yayasan | 1 to 1 |
| User (Admin) | Mengelola | Pendiri Yayasan | 1 to M |
| User (Admin) | Mengelola | Campaign | 1 to M |
| User (Admin) | Mengelola | Transaksi Donasi | 1 to M |
| User (Donatur) | Melakukan | Transaksi Donasi | 1 to M |
| Campaign | Menerima | Transaksi Donasi | 1 to M |

**Catatan:** User (Admin) dan User (Donatur) disimpan dalam satu tabel `users` dengan kolom `role` membedakan 'admin' dan 'donatur'. Laporan donasi merupakan hasil agregasi dari tabel `donations` (bukan tabel fisik terpisah).

---

## 2. Logical Record Structure (LRS) — Modul Donasi

| No | Nama Tabel | Primary Key | Foreign Key | Foreign Key ke Tabel |
|----|-----------|-------------|-------------|----------------------|
| 1 | users | id | - | - |
| 2 | profil_yayasan | id | - | - |
| 3 | pendiris | id | - | - |
| 4 | news | id | - | - |
| 5 | campaigns | id | - | - |
| 6 | donations | id | campaign_id, user_id | campaigns, users |

---

## 3. Spesifikasi File Basis Data — Modul Donasi

### a. Spesifikasi file users

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama Lengkap |
| 3 | email | VARCHAR | 255 | Email Login (Unique) |
| 4 | email_verified_at | TIMESTAMP | 19 | Nullable |
| 5 | role | VARCHAR | 20 | 'admin' atau 'donatur', default 'donatur' |
| 6 | phone | VARCHAR | 20 | No. HP (nullable) |
| 7 | address | TEXT | - | Alamat (nullable) |
| 8 | nik | VARCHAR | 20 | NIK (nullable) |
| 9 | avatar | VARCHAR | 255 | Foto Profil (nullable) |
| 10 | password | VARCHAR | 255 | Hash Password |
| 11 | remember_token | VARCHAR | 100 | Nullable |
| 12 | created_at | TIMESTAMP | 19 | - |
| 13 | updated_at | TIMESTAMP | 19 | - |

### b. Spesifikasi file profil_yayasan

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

### c. Spesifikasi file pendiris (Pendiri Yayasan)

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

### d. Spesifikasi file news (Berita Kegiatan)

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

### e. Spesifikasi file campaigns (Campaign)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | title | VARCHAR | 255 | Judul campaign |
| 3 | slug | VARCHAR | 255 | Slug URL (Unique) |
| 4 | description | TEXT | - | Deskripsi campaign |
| 5 | target_amount | DECIMAL | 15,2 | Target donasi |
| 6 | collected_amount | DECIMAL | 15,2 | Terkumpul, default 0 |
| 7 | image | VARCHAR | 255 | Gambar (nullable) |
| 8 | status | ENUM | 10 | 'active' atau 'completed', default 'active' |
| 9 | created_at | TIMESTAMP | 19 | - |
| 10 | updated_at | TIMESTAMP | 19 | - |

### f. Spesifikasi file donations (Transaksi Donasi)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | campaign_id | BIGINT | 20 | Campaign terkait (FK) |
| 3 | user_id | BIGINT | 20 | Donatur (FK, nullable) |
| 4 | donor_name | VARCHAR | 255 | Nama donatur |
| 5 | donor_email | VARCHAR | 255 | Email donatur |
| 6 | donor_phone | VARCHAR | 20 | No. HP (nullable) |
| 7 | amount | BIGINT | 20 | Nominal donasi |
| 8 | payment_method | VARCHAR | 50 | Metode bayar (nullable) |
| 9 | payment_proof | VARCHAR | 255 | Bukti transfer (nullable) |
| 10 | transfer_date | DATE | 10 | Tanggal transfer (nullable) |
| 11 | status | VARCHAR | 20 | 'pending', 'success', atau 'failed', default 'pending' |
| 12 | rejection_reason | TEXT | - | Alasan penolakan (nullable) |
| 13 | order_id | VARCHAR | 100 | ID transaksi (Unique, nullable) |
| 14 | snap_token | VARCHAR | 255 | Token Snap Midtrans (nullable) |
| 15 | created_at | TIMESTAMP | 19 | - |
| 16 | updated_at | TIMESTAMP | 19 | - |

---

## 4. Tabel di Luar Modul Donasi

Tabel berikut digunakan oleh modul lain di luar Donasi:

| Tabel | Modul | Keterangan |
|-------|-------|------------|
| foster_children | Modul OTA | Data anak asuh |
| sponsorships | Modul OTA | Transaksi sponsorship |
| child_developments | Modul OTA | Laporan perkembangan anak |
