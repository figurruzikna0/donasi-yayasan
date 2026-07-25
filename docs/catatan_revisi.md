# Catatan Basis Data — Donasi Yayasan

## 1. Entity Relationship Diagram (ERD)

Berdasarkan rancangan ERD di atas, terdapat pemetaan kardinalitas relasi antar entitas yang dijabarkan pada tabel berikut:

| Entitas Asal | Nama Relasi | Entitas Tujuan | Kardinalitas |
|-------------|-------------|----------------|-------------|
| User (Admin) | Mengelola | Berita Kegiatan | 1 to M |
| User (Admin) | Mengelola | Profil Yayasan | 1 to 1 |
| User (Admin) | Mengelola | Pendiri Yayasan | 1 to M |
| User (Admin) | Mengisi | Perkembangan Anak | 1 to M |
| User (Donatur) | Melakukan | Transaksi Sponsorship | 1 to M |
| User (Donatur) | Melakukan | Donasi Campaign | 1 to M |
| Transaksi Sponsorship | Diterima | Anak Asuh | M to 1 |
| Anak Asuh | Memiliki | Perkembangan Anak | 1 to M |
| Campaign | Menerima | Donasi Campaign | 1 to M |

## 2. Logical Record Structure (LRS)

Struktur konseptual ERD tersebut kemudian diterjemahkan ke dalam bentuk struktur fisik relasi tabel melalui perancangan LRS berikut:

| No | Nama Tabel | Primary Key | Foreign Key | Foreign Key ke Tabel |
|----|-----------|-------------|-------------|----------------------|
| 1 | users | id | - | - |
| 2 | profil_yayasan | id | - | - |
| 3 | pendiris | id | - | - |
| 4 | foster_children | id | - | - |
| 5 | campaigns | id | - | - |
| 6 | sponsorships | id | foster_child_id, user_id | foster_children, users |
| 7 | donations | id | campaign_id, user_id | campaigns, users |
| 8 | child_developments | id | sponsorship_id, foster_child_id, user_id | sponsorships, foster_children, users |
| 9 | news | id | - | - |

## 3. Spesifikasi File Basis Data

Rancangan fisik LRS di atas diimplementasikan ke dalam basis data MySQL yang terdiri dari beberapa tabel entitas utama. Berikut adalah rincian spesifikasi file dari masing-masing tabel:

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
| 8 | nik | VARCHAR | 20 | NIK (nullable, untuk donatur) |
| 9 | avatar | VARCHAR | 255 | Foto Profil (nullable) |
| 10 | password | VARCHAR | 255 | Hash Password |
| 11 | remember_token | VARCHAR | 100 | Laravel remember token (nullable) |
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

### c. Spesifikasi file pendiris

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

### d. Spesifikasi file foster_children (Anak Asuh)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama Anak |
| 3 | age | VARCHAR | 10 | Usia (string, bisa diisi "0" atau "-" jika belum diketahui) |
| 4 | jenis_kelamin | ENUM | 10 | 'Laki-laki' atau 'Perempuan' |
| 5 | description | TEXT | - | Deskripsi (nullable) |
| 6 | photo | VARCHAR | 255 | Foto anak (nullable) |
| 7 | status | ENUM | 8 | 'Tersedia' atau 'Diasuh', default 'Tersedia' |
| 8 | created_at | TIMESTAMP | 19 | - |
| 9 | updated_at | TIMESTAMP | 19 | - |

### e. Spesifikasi file sponsorships (Transaksi Sponsorship)

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
| 15 | status | ENUM | 12 | 'pending', 'success', 'failed', atau 'expired', default 'pending' |
| 16 | starts_at | TIMESTAMP | 19 | Tanggal mulai (nullable, terisi saat sukses) |
| 17 | expires_at | TIMESTAMP | 19 | Tanggal berakhir (nullable, +1 bulan) |
| 18 | reminder_sent_at | TIMESTAMP | 19 | Waktu notifikasi H-3 dikirim (nullable) |
| 19 | rejection_reason | TEXT | - | Alasan penolakan (nullable) |
| 20 | created_at | TIMESTAMP | 19 | - |
| 21 | updated_at | TIMESTAMP | 19 | - |

### f. Spesifikasi file campaigns (Campaign Donasi)

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

### g. Spesifikasi file donations (Donasi Campaign)

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

### i. Spesifikasi file news (Berita)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | judul | VARCHAR | 255 | Judul berita |
| 3 | slug | VARCHAR | 255 | Slug URL (Unique) |
| 4 | kategori | VARCHAR | 50 | Kategori kegiatan, default 'Kegiatan Umum' |
| 5 | tanggal_kegiatan | DATE | 10 | Tanggal pelaksanaan |
| 6 | lokasi | VARCHAR | 100 | Tempat kegiatan (nullable) |
| 7 | penyelenggara | VARCHAR | 100 | Pihak penyelenggara (nullable) |
| 8 | ringkasan | TEXT | - | Cuplikan singkat (nullable) |
| 9 | konten | LONGTEXT | - | Isi berita lengkap |
| 10 | foto_utama | VARCHAR | 255 | Gambar sampul (nullable) |
| 11 | status | VARCHAR | 20 | 'draft' atau 'published', default 'draft' |
| 12 | created_at | TIMESTAMP | 19 | - |
| 13 | updated_at | TIMESTAMP | 19 | - |
