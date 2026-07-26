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

**Catatan:** User (Admin) dan User (Donatur) disimpan dalam satu tabel `users` dengan kolom `role` membedakan 'admin' dan 'donatur'. Laporan donasi merupakan hasil agregasi dari tabel `donations` (bukan tabel fisik terpisah). **Midtrans nonaktif** — semua donasi via transfer bank + upload bukti manual.

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
| 4 | email_verified_at | TIMESTAMP | - | Waktu verifikasi email (nullable) |
| 5 | role | VARCHAR | 20 | 'admin' atau 'donatur', default 'donatur' |
| 6 | phone | VARCHAR | 20 | No. HP donatur (nullable) |
| 7 | address | TEXT | - | Alamat lengkap donatur (nullable) |
| 8 | nik | VARCHAR | 20 | NIK, khusus donatur (nullable) |
| 9 | avatar | VARCHAR | 255 | Path file foto profil (nullable) |
| 10 | password | VARCHAR | 255 | Hash Password (bcrypt) |
| 11 | remember_token | VARCHAR | 100 | Token remember login (nullable) |
| 12 | created_at | TIMESTAMP | - | Waktu dibuat |
| 13 | updated_at | TIMESTAMP | - | Waktu diperbarui |

### b. Spesifikasi file profil_yayasan

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | nama_yayasan | VARCHAR | 255 | Nama resmi yayasan |
| 3 | email | VARCHAR | 255 | Email kontak yayasan |
| 4 | no_telp | VARCHAR | 20 | Nomor telepon/WA yayasan |
| 5 | alamat | TEXT | - | Alamat lengkap yayasan |
| 6 | sejarah_yayasan | TEXT | - | Sejarah berdirinya yayasan (nullable) |
| 7 | visi | TEXT | - | Visi yayasan (nullable) |
| 8 | misi | TEXT | - | Misi yayasan (nullable) |
| 9 | logo | VARCHAR | 255 | Path file logo yayasan (nullable) |
| 10 | legalitas | TEXT | - | Deskripsi legalitas yayasan (nullable) |
| 11 | foto_legalitas | VARCHAR | 255 | Path file foto legalitas / SK (nullable) |
| 12 | foto_struktur | VARCHAR | 255 | Path file foto struktur organisasi (nullable) |
| 13 | created_at | TIMESTAMP | - | Waktu dibuat |
| 14 | updated_at | TIMESTAMP | - | Waktu diperbarui |

### c. Spesifikasi file pendiris (Pendiri Yayasan)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | nama | VARCHAR | 255 | Nama lengkap pengurus |
| 3 | jabatan | VARCHAR | 255 | Jabatan di yayasan |
| 4 | deskripsi | TEXT | - | Kata sambutan atau bio singkat (nullable) |
| 5 | foto | VARCHAR | 255 | Path file foto profil (nullable) |
| 6 | urutan | INTEGER | 11 | Urutan tampil di halaman publik, default 0 |
| 7 | created_at | TIMESTAMP | - | Waktu dibuat |
| 8 | updated_at | TIMESTAMP | - | Waktu diperbarui |

### d. Spesifikasi file news (Berita Kegiatan)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | judul | VARCHAR | 255 | Judul berita |
| 3 | slug | VARCHAR | 255 | Slug URL (Unique) |
| 4 | kategori | VARCHAR | 50 | Kategori kegiatan, default 'Kegiatan Umum' |
| 5 | tanggal_kegiatan | DATE | - | Tanggal pelaksanaan kegiatan |
| 6 | lokasi | VARCHAR | 100 | Tempat pelaksanaan (nullable) |
| 7 | penyelenggara | VARCHAR | 100 | Pihak penyelenggara (nullable) |
| 8 | ringkasan | TEXT | - | Cuplikan singkat berita, max 500 char (nullable) |
| 9 | konten | LONGTEXT | - | Isi berita lengkap |
| 10 | foto_utama | VARCHAR | 255 | Path file gambar sampul (nullable) |
| 11 | status | VARCHAR | 20 | 'draft' atau 'published', default 'draft' |
| 12 | created_at | TIMESTAMP | - | Waktu dibuat |
| 13 | updated_at | TIMESTAMP | - | Waktu diperbarui |

### e. Spesifikasi file campaigns (Campaign)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | title | VARCHAR | 255 | Judul campaign |
| 3 | slug | VARCHAR | 255 | Slug URL (Unique) |
| 4 | description | TEXT | - | Deskripsi lengkap campaign |
| 5 | target_amount | DECIMAL | 15,2 | Target nominal donasi |
| 6 | collected_amount | DECIMAL | 15,2 | Dana terkumpul, default 0 |
| 7 | image | VARCHAR | 255 | Path file gambar campaign (nullable) |
| 8 | status | ENUM | - | 'active' atau 'completed', default 'active' |
| 9 | created_at | TIMESTAMP | - | Waktu dibuat |
| 10 | updated_at | TIMESTAMP | - | Waktu diperbarui |

### f. Spesifikasi file donations (Transaksi Donasi)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | campaign_id | BIGINT | 20 | ID campaign tujuan (FK → campaigns.id, ON DELETE CASCADE) |
| 3 | user_id | BIGINT | 20 | ID donatur (FK → users.id, ON DELETE SET NULL) |
| 4 | order_id | VARCHAR | 100 | ID transaksi unik, prefix 'DONASI-' (Unique, nullable) |
| 5 | invoice_number | VARCHAR | 50 | No. invoice format INV-DN-{thn}{bln}-{urut} (Unique, nullable) |
| 6 | snap_token | VARCHAR | 255 | Token Snap Midtrans — legacy, tidak dipakai (nullable) |
| 7 | donor_name | VARCHAR | 255 | Nama lengkap donatur |
| 8 | donor_email | VARCHAR | 255 | Email donatur |
| 9 | donor_phone | VARCHAR | 255 | No. HP/WA donatur (nullable) |
| 10 | amount | BIGINT UNSIGNED | 20 | Nominal donasi (dalam rupiah, unsigned) |
| 11 | payment_method | VARCHAR | 255 | Metode pembayaran, default 'Transfer Bank' (nullable) |
| 12 | payment_proof | VARCHAR | 255 | Path file bukti transfer (nullable) |
| 13 | transfer_date | DATE | - | Tanggal transfer dilakukan (nullable) |
| 14 | status | VARCHAR | 20 | 'pending', 'success', atau 'failed', default 'pending' |
| 15 | rejection_reason | TEXT | - | Alasan jika ditolak admin (nullable) |
| 16 | created_at | TIMESTAMP | - | Waktu transaksi dibuat |
| 17 | updated_at | TIMESTAMP | - | Waktu transaksi diperbarui |

---

## 4. Tabel di Luar Modul Donasi

Tabel berikut digunakan oleh modul lain di luar Donasi:

| Tabel | Modul | Keterangan |
|-------|-------|------------|
| foster_children | Modul OTA | Data anak asuh |
| sponsorships | Modul OTA | Transaksi sponsorship |
| child_developments | Modul OTA | Laporan perkembangan anak |
