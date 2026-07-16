# Modul Orang Tua Asuh (OTA) — Arsitektur Basis Data (ERD & LRS)

## Entity Relationship Diagram (ERD) — Konseptual

### Identifikasi Entitas

| No | Entitas | Keterangan |
|----|---------|------------|
| 1 | **Anak Asuh** | Data anak asuh binaan yayasan |
| 2 | **Sponsorship** | Transaksi orang tua asuh (OTA) via Midtrans |
| 3 | **Perkembangan Anak** | Laporan perkembangan anak asuh |
| 4 | **Users** | User role donatur (melakukan sponsorship) + admin (mengelola seluruh data) |
| 5 | **Profil Yayasan** | Informasi profil yayasan — dikelola oleh admin (single row) |
| 6 | **Berita** | Berita kegiatan yayasan — ditulis oleh admin |

### Relasi Antar Entitas (Kardinalitas)

```
    ┌────────────────────────────────────────────────────────────────────────────┐
    │                                                                            │
    │  ┌──────────────┐    1          M  ┌──────────────┐                       │
    │  │  Anak Asuh   │──────────────────│ Sponsorship  │                       │
    │  └──────┬───────┘  dipilih         └──────┬───────┘                       │
    │         │                                  │                               │
    │         │ 1                                │ 1                             │
    │         │                                  │                               │
    │         │ M                                │ M                             │
    │         ▼                                  ▼                               │
    │  ┌──────────────────┐             ┌──────────────────┐                    │
    │  │ Perkembangan Anak│             │  Users (Donatur) │                    │
    │  └──────────────────┘             └──────────────────┘                    │
    │         │                                                                    │
    │         │ M                             ┌──────────────────────┐           │
    │         │                               │                      │           │
    │  ┌──────┴───────┐       1         1     │   Profil Yayasan     │           │
    │  │ Users (Admin) │──────────────────────│(single row, dikelola │           │
    │  └──────┬───────┘  mengelola            │     oleh admin)      │           │
    │         │                               └──────────────────────┘           │
    │         │ 1                                                                 │
    │         │                                                                   │
    │         │ M                       ┌──────────────────┐                     │
    │         └────────────────────────│  Berita / News    │                     │
    │             menulis              └──────────────────┘                     │
    └────────────────────────────────────────────────────────────────────────────┘
```

| Entitas Asal | Nama Relasi | Entitas Tujuan | Kardinalitas |
|-------------|-------------|----------------|--------------|
| Anak Asuh | Dipilih | Sponsorship | 1 to M |
| Users (Donatur) | Melakukan | Sponsorship | 1 to M |
| Sponsorship | Memiliki | Perkembangan Anak | 1 to M |
| Anak Asuh | Memiliki | Perkembangan Anak | 1 to M |
| Users (Admin) | Membuat | Perkembangan Anak | 1 to M |
| Users (Admin) | Mengelola | Profil Yayasan | 1 to 1 |
| Users (Admin) | Menulis | Berita | 1 to M |

### Aturan Bisnis Terkait Data

1. Satu anak asuh bisa **disponsori berkali-kali** oleh OTA berbeda sepanjang masa.
2. Saat sponsorship sukses, `foster_children.status` berubah menjadi **"Diasuh"**.
3. Saat sponsorship expired via cronjob, `foster_children.status` kembali **"Tersedia"**.
4. Perkembangan anak terikat ke **satu sponsorship** dan **satu anak asuh**.
5. Donatur OTA **tidak wajib login** — `user_id` boleh null (guest).
6. Satu sponsorship memiliki **masa berlaku** (`starts_at` / `expires_at`) — otomatis diisi saat sukses.
7. `status` sponsorship: `pending` → `success` / `failed` / `expired`.
8. Cronjob H-7 & H-3 membaca `expires_at` untuk kirim notifikasi perpanjangan.

---

## Logical Record Structure (LRS)

### Diagram Relasi LRS

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                                                                                  │
│  ┌──────────────────────┐          ┌──────────────────────────┐                 │
│  │    foster_children    │          │       sponsorships       │                 │
│  │──────────────────────│          │──────────────────────────│                 │
│  │ PK id  bigint        │◄─────────│ FK foster_child_id       │                 │
│  │    name              │  1    M  │    user_id  (nullable)   │                 │
│  │    age               │          │    order_id  (unique)    │                 │
│  │    jenis_kelamin     │          │    snap_token            │                 │
│  │    description       │          │    donor_name            │                 │
│  │    photo             │          │    donor_email           │                 │
│  │    status            │          │    donor_phone           │                 │
│  └──────────────────────┘          │    amount                │                 │
│         │                         │    package               │                 │
│         │ 1                       │    package_description   │                 │
│         │                         │    payment_method        │                 │
│         │                         │    status                │                 │
│         │                         │    starts_at (nullable)  │                 │
│         │                         │    expires_at (nullable) │                 │
│         ▼                         │    reminder_sent_at      │                 │
│  ┌──────────────────────┐         └────────────┬─────────────┘                 │
│  │  child_developments   │                      │                               │
│  │──────────────────────│                      │ 1                             │
│  │ PK id  bigint        │                      │                               │
│  │ FK sponsorship_id    │◄─────────────────────┘                               │
│  │ FK foster_child_id   │◄────────────────────┐                                │
│  │ FK user_id (nullable)│                     │ 1                              │
│  │    tanggal           │                     │                                │
│  │    judul             │                     │                                │
│  │    deskripsi         │                     │                                │
│  │    foto              │                     │                                │
│  └──────────────────────┘                     │                                │
│                                                │                                │
│  ┌──────────────────────┐     M               │                                │
│  │       users          │─────────────────────┘                                │
│  │──────────────────────│ (Admin mengisi laporan)                               │
│  │ PK id  bigint        │                                                       │
│  │    name              │                                                       │
│  │    email (unique)    │                                                       │
│  │    password          │                                                       │
│  │    role              │  ┌─────────────────────────────────────┐             │
│  │    phone             │  │  Hubungan Admin ke entitas lain:    │             │
│  │    address           │  ├─────────────────────────────────────┤             │
│  │    nik               │  │ Admin ──1:1──> profil_yayasan      │             │
│  │    avatar            │  │ Admin ──1:M──> news                 │             │
│  └──────────────────────┘  │ Admin ──1:M──> child_developments   │             │
│                            │ Donatur─1:M──> sponsorships         │             │
│  ┌──────────────────────┐  └─────────────────────────────────────┘             │
│  │    profil_yayasan     │                                                       │
│  │──────────────────────│                                                       │
│  │ PK id  bigint        │                                                       │
│  │    nama_yayasan      │                                                       │
│  │    logo              │                                                       │
│  │    alamat            │                                                       │
│  │    no_telp           │                                                       │
│  │    email             │                                                       │
│  │    ...               │                                                       │
│  └──────────────────────┘                                                       │
│                                                                                  │
│  ┌──────────────────────┐                                                       │
│  │        news          │                                                       │
│  │──────────────────────│                                                       │
│  │ PK id  bigint        │                                                       │
│  │    judul             │                                                       │
│  │    slug (unique)     │                                                       │
│  │    kategori          │                                                       │
│  │    konten            │                                                       │
│  │    status            │                                                       │
│  └──────────────────────┘                                                       │
└─────────────────────────────────────────────────────────────────────────────────┘
```

**Keterangan:**
- `PK` = Primary Key
- `FK` = Foreign Key
- `1`, `M` = kardinalitas one-to-many
- Tabel `users` menampung **dua role sekaligus**: `admin` dan `donatur`, dibedakan oleh kolom `role`
- Semua foreign key menggunakan `ON DELETE CASCADE` atau `ON DELETE SET NULL` sesuai aturan bisnis

### 1. Anak Asuh

Tabel: `foster_children`

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | bigint, PK, auto-increment | |
| name | varchar(255) | Nama anak |
| age | integer | Usia |
| jenis_kelamin | enum('Laki-laki','Perempuan') | |
| description | text, nullable | Deskripsi / latar belakang |
| photo | varchar(255), nullable | Foto anak |
| status | enum('Tersedia','Diasuh'), default 'Tersedia' | Status ketersediaan |
| created_at | timestamp | |
| updated_at | timestamp | |

### 2. Sponsorship

Tabel: `sponsorships`

| Kolom | Tipe Data | Keterangan | Foreign Key |
|-------|-----------|------------|-------------|
| id | bigint, PK, auto-increment | |
| foster_child_id | bigint | Anak asuh yang dipilih | FK → foster_children(id) ON DELETE CASCADE |
| user_id | bigint, nullable | Donatur OTA (null jika guest) | FK → users(id) ON DELETE SET NULL |
| order_id | varchar(255), unique | ID transaksi (prefix `SPONSOR-`) |
| snap_token | varchar(255), nullable | Token Snap Midtrans |
| donor_name | varchar(255) | Nama donatur |
| donor_email | varchar(255) | Email donatur |
| donor_phone | varchar(20) | No. HP donatur |
| amount | decimal(15,2) | Nominal donasi |
| package | varchar(255), nullable | Paket komitmen |
| package_description | text, nullable | Deskripsi paket |
| payment_method | varchar(255), nullable | Metode bayar dari Midtrans |
| payment_proof | varchar(255), nullable | Tidak dipakai (Midtrans full) |
| status | enum('pending','success','failed','expired'), default 'pending' | Status transaksi |
| starts_at | date, nullable | Tanggal mulai (terisi saat sukses) |
| expires_at | date, nullable | Tanggal berakhir (+1 bulan dari starts_at) |
| reminder_sent_at | timestamp, nullable | Waktu notifikasi dikirim |
| created_at | timestamp | |
| updated_at | timestamp | |

### 3. Perkembangan Anak

Tabel: `child_developments`

| Kolom | Tipe Data | Keterangan | Foreign Key |
|-------|-----------|------------|-------------|
| id | bigint, PK, auto-increment | |
| sponsorship_id | bigint | Sponsorship terkait | FK → sponsorships(id) ON DELETE CASCADE |
| foster_child_id | bigint | Anak asuh | FK → foster_children(id) ON DELETE CASCADE |
| user_id | bigint, nullable | Admin pengisi laporan | FK → users(id) ON DELETE SET NULL |
| tanggal | date | Tanggal laporan |
| judul | varchar(255) | Judul laporan |
| deskripsi | text | Isi laporan |
| foto | varchar(255), nullable | Foto perkembangan |
| created_at | timestamp | |
| updated_at | timestamp | |

### 4. Users (Donatur & Admin)

Tabel: `users`

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
| created_at | timestamp | |
| updated_at | timestamp | |

> **Catatan role:** User dengan role `admin` memiliki akses penuh ke seluruh modul — termasuk mengelola profil yayasan, menulis berita kegiatan, mengelola campaign & donasi, memvalidasi sponsorship, dan mengisi laporan perkembangan anak. User dengan role `donatur` hanya dapat melakukan transaksi donasi/sponsorship.

### 5. Profil Yayasan

Tabel: `profil_yayasan`

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
| created_at | timestamp | |
| updated_at | timestamp | |

> Hanya terdapat 1 (satu) baris data — dikelola oleh admin via panel administrasi. Seluruh halaman publik membaca data dari sini.

### 6. Berita / News

Tabel: `news`

| Kolom | Tipe Data | Keterangan | Foreign Key |
|-------|-----------|------------|-------------|
| id | bigint, PK, auto-increment | |
| judul | varchar(255) | Judul berita |
| slug | varchar(255), unique | Slug URL |
| kategori | varchar(255), nullable | Kategori kegiatan |
| tanggal_kegiatan | date, nullable | Tanggal pelaksanaan |
| lokasi | varchar(255), nullable | Tempat kegiatan |
| penyelenggara | varchar(255), nullable | Pihak penyelenggara |
| ringkasan | text, nullable | Cuplikan singkat |
| konten | text | Isi berita lengkap |
| foto_utama | varchar(255), nullable | Gambar sampul |
| status | enum('draft','published'), default 'draft' | Status publikasi |
| created_at | timestamp | |
| updated_at | timestamp | |

> **Catatan:** Berita ditulis oleh admin (tidak ada foreign key `user_id` di tabel ini karena admin adalah satu-satunya penulis, cukup tercatat di log aktivitas). Berita dengan status `published` tampil di halaman publik yayasan.

---

## Ringkasan Tabel Modul OTA (+ Konteks Sistem)

| No | Tabel | Peran dalam Modul |
|----|-------|-------------------|
| 1 | `foster_children` | Entitas utama — data & status anak asuh |
| 2 | `sponsorships` | Transaksi — mencatat setiap sponsorship + masa berlaku |
| 3 | `child_developments` | Riwayat — laporan perkembangan anak |
| 4 | `users` | Referensi — data donatur OTA & admin pengisi laporan |
| 5 | `profil_yayasan` | Konteks — identitas yayasan di halaman publik (dikelola admin) |
| 6 | `news` | Konteks — berita kegiatan yayasan (ditulis admin) |

> Semua migrasi dan constraint foreign key sudah diimplementasikan di `database/migrations/`.
