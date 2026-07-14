# Sprint — Arsitektur Basis Data (ERD & LRS)

## Entity Relationship Diagram (ERD) — Konseptual

### Identifikasi Entitas Utama

| No | Entitas | Keterangan |
|----|---------|------------|
| 1 | **Users** | Admin & Donatur dalam satu tabel, dibedakan dengan kolom `role` |
| 2 | **Profil Yayasan** | Informasi profil yayasan (single row) |
| 3 | **Pendiri** | Daftar pengurus/pendiri yayasan |
| 4 | **Berita** | Berita kegiatan yayasan |
| 5 | **Campaign** | Program penggalangan dana |
| 6 | **Donasi** | Transaksi donasi campaign |
| 7 | **Anak Asuh** | Data anak asuh binaan |
| 8 | **Sponsorship** | Transaksi orang tua asuh (OTA) |
| 9 | **Perkembangan Anak** | Laporan perkembangan anak asuh |

### Relasi Antar Entitas (Kardinalitas)

| Entitas Asal | Nama Relasi | Entitas Tujuan | Kardinalitas |
|-------------|-------------|----------------|--------------|
| Users (Admin) | Mengelola | Profil Yayasan | 1 to 1 |
| Users (Admin) | Menulis | Berita | 1 to M |
| Users (Admin) | Mengelola | Campaign | 1 to M |
| Users (Admin) | Membuat | Perkembangan Anak | 1 to M |
| Users (Admin) | Memvalidasi | Donasi | 1 to M |
| Users (Admin) | Memvalidasi | Sponsorship | 1 to M |
| Users (Donatur) | Melakukan | Donasi | 1 to M |
| Users (Donatur) | Melakukan | Sponsorship | 1 to M |
| Campaign | Menerima | Donasi | 1 to M |
| Anak Asuh | Dipilih | Sponsorship | 1 to M |
| Sponsorship | Memiliki | Perkembangan Anak | 1 to M |
| Anak Asuh | Memiliki | Perkembangan Anak | 1 to M |

## Logical Record Structure (LRS)

### 1. Users

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | bigint, PK, auto-increment | |
| name | varchar(255) | Nama lengkap |
| email | varchar(255), unique | Email login |
| password | varchar(255) | Hash password |
| role | enum('admin','donatur') | Jenis user |
| phone | varchar(20), nullable | No. HP |
| address | text, nullable | Alamat |
| nik | varchar(20), nullable | NIK |
| avatar | varchar(255), nullable | Foto profil |

### 2. Profil Yayasan

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | bigint, PK, auto-increment | |
| nama_yayasan | varchar(255) | |
| logo | varchar(255), nullable | |
| alamat | text | |
| no_telp | varchar(20) | |
| email | varchar(255) | |
| sejarah_yayasan | text | |
| visi | text | |
| misi | text | |
| legalitas | text, nullable | |
| foto_legalitas | varchar(255), nullable | |
| foto_struktur | varchar(255), nullable | |

### 3. Pendiri

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | bigint, PK, auto-increment | |
| nama | varchar(255) | |
| jabatan | varchar(255) | |
| deskripsi | text, nullable | |
| foto | varchar(255), nullable | |

### 4. Berita / News

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | bigint, PK, auto-increment | |
| judul | varchar(255) | |
| slug | varchar(255), unique | |
| kategori | varchar(255), nullable | |
| tanggal_kegiatan | date, nullable | |
| lokasi | varchar(255), nullable | |
| penyelenggara | varchar(255), nullable | |
| ringkasan | text, nullable | |
| konten | text | |
| foto_utama | varchar(255), nullable | |
| status | enum('draft','published'), default 'draft' | |

### 5. Campaign

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | bigint, PK, auto-increment | |
| title | varchar(255) | Judul campaign |
| slug | varchar(255), unique | |
| description | text | Deskripsi |
| target_amount | decimal(15,2) | Target donasi |
| collected_amount | decimal(15,2), default 0 | Terkumpul |
| image | varchar(255), nullable | Gambar campaign |
| status | enum('active','completed'), default 'active' | |

### 6. Donasi / Donations

| Kolom | Tipe Data | Keterangan | Foreign Key |
|-------|-----------|------------|-------------|
| id | bigint, PK, auto-increment | |
| campaign_id | bigint | Campaign tujuan | FK → campaigns(id) ON DELETE CASCADE |
| user_id | bigint, nullable | Donatur | FK → users(id) ON DELETE SET NULL |
| order_id | varchar(255), unique | ID dari sistem |
| snap_token | varchar(255), nullable | Token Midtrans |
| donor_name | varchar(255) | Nama donatur |
| donor_email | varchar(255) | Email donatur |
| donor_phone | varchar(20) | No. HP donatur |
| amount | decimal(15,2) | Nominal donasi |
| payment_method | varchar(255), nullable | Metode bayar |
| payment_proof | varchar(255), nullable | Bukti bayar |
| status | enum('pending','success','failed'), default 'pending' | |

### 7. Anak Asuh / Foster Children

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | bigint, PK, auto-increment | |
| name | varchar(255) | Nama |
| age | integer | Usia |
| jenis_kelamin | enum('Laki-laki','Perempuan') | |
| description | text, nullable | |
| photo | varchar(255), nullable | |
| status | enum('Tersedia','Diasuh'), default 'Tersedia' | |

### 8. Sponsorship (Orang Tua Asuh)

| Kolom | Tipe Data | Keterangan | Foreign Key |
|-------|-----------|------------|-------------|
| id | bigint, PK, auto-increment | |
| foster_child_id | bigint | Anak asuh | FK → foster_children(id) ON DELETE CASCADE |
| user_id | bigint, nullable | Donatur | FK → users(id) ON DELETE SET NULL |
| order_id | varchar(255), unique | ID dari sistem |
| snap_token | varchar(255), nullable | Token Midtrans |
| donor_name | varchar(255) | Nama donatur |
| donor_email | varchar(255) | Email donatur |
| donor_phone | varchar(20) | No. HP donatur |
| amount | decimal(15,2) | Nominal |
| package | varchar(255), nullable | Paket komitmen |
| package_description | text, nullable | |
| payment_method | varchar(255), nullable | |
| payment_proof | varchar(255), nullable | |
| status | enum('pending','success','failed','expired'), default 'pending' | |
| starts_at | date, nullable | Mulai sponsorship |
| expires_at | date, nullable | Berakhir sponsorship |
| reminder_sent_at | timestamp, nullable | |

### 9. Perkembangan Anak / Child Developments

| Kolom | Tipe Data | Keterangan | Foreign Key |
|-------|-----------|------------|-------------|
| id | bigint, PK, auto-increment | |
| sponsorship_id | bigint | Sponsorship terkait | FK → sponsorships(id) ON DELETE CASCADE |
| foster_child_id | bigint | Anak asuh | FK → foster_children(id) ON DELETE CASCADE |
| user_id | bigint, nullable | Admin pengisi | FK → users(id) ON DELETE SET NULL |
| tanggal | date | Tanggal laporan |
| judul | varchar(255) | Judul laporan |
| deskripsi | text | Deskripsi |
| foto | varchar(255), nullable | Foto perkembangan |

## Struktur Database (7 Tabel Utama)

Berdasarkan LRS di atas, sistem memiliki **9 tabel utama** (7 sesuai kerangka referensi ditambah 2 tabel tambahan):

| No | Tabel | Sesuai Referensi | Keterangan |
|----|-------|-----------------|------------|
| 1 | `users` | ✅ Admin + Donatur OTA | Digabung dalam satu tabel dengan kolom `role` |
| 2 | `profil_yayasan` | ✅ Profil Yayasan | Single row |
| 3 | `news` | ✅ Berita Kegiatan | |
| 4 | `campaigns` | ➕ Tambahan | Program penggalangan dana (tidak ada di referensi) |
| 5 | `donations` | ✅ Transaksi OTA (bagian donasi) | Transaksi donasi campaign |
| 6 | `foster_children` | ✅ Anak Asuh | |
| 7 | `sponsorships` | ✅ Transaksi OTA (bagian sponsorship) | Transaksi orang tua asuh |
| 8 | `child_developments` | ✅ Perkembangan Anak | |
| 9 | `pendiris` | ➕ Tambahan | Daftar pengurus yayasan |

> **Catatan:** Referensi awal menyatukan donasi & sponsorship dalam satu tabel `transaksi_ota`. Pada implementasi, keduanya dipisah menjadi `donations` dan `sponsorships` karena perbedaan struktur kolom (donasi memiliki `campaign_id`, sponsorship memiliki `foster_child_id` + `package` + masa berlaku). Tabel `campaigns` dan `pendiris` merupakan tambahan yang tidak ada di kerangka referensi.
