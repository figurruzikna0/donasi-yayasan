# Modul Donasi — Arsitektur Basis Data (ERD & LRS)

## Entity Relationship Diagram (ERD) — Detail Atribut

### Entitas & Atribut

Berikut adalah diagram ERD **lengkap dengan atribut** (kolom) pada setiap tabel.
Notasi:  **PK** = Primary Key,  **FK** = Foreign Key,  `nullable` = boleh kosong.

```
┌═══════════════════════════════════════════════════════╗
║                      campaigns                        ║
║═══════════════════════════════════════════════════════║
║  PK  id                  bigint                       ║
║      title               varchar(255)                 ║
║      slug                varchar(255) unique          ║
║      description         text                         ║
║      target_amount       decimal(15,2)                ║
║      collected_amount    decimal(15,2) default 0      ║
║      image               varchar(255) nullable        ║
║      status              enum(active/completed)       ║
║      created_at          timestamp                    ║
║      updated_at          timestamp                    ║
╚═══════════════════════════════════════════════════════╝
         │
         │ 1
         │
         │  (campaign_id)
         ▼
┌════════════════════════════════════════════════════════════════════════╗
║                              donations                                ║
║════════════════════════════════════════════════════════════════════════║
║  PK  id                    bigint                                     ║
║  FK  campaign_id           bigint      ────→ campaigns.id             ║
║  FK  user_id               bigint(null)───→ users.id                  ║
║      order_id              varchar(255) unique                        ║
║      snap_token            varchar(255) nullable                      ║
║      donor_name            varchar(255)                               ║
║      donor_email           varchar(255)                               ║
║      donor_phone           varchar(20)                                ║
║      amount                decimal(15,2)                              ║
║      payment_method        varchar(255) nullable                      ║
║      payment_proof         varchar(255) nullable (tdk dipakai)        ║
║      status                enum(pending/success/failed)               ║
║      created_at            timestamp                                  ║
║      updated_at            timestamp                                  ║
╚════════════════════════════════════════════════════════════════════════╝
         │
         │ M
         │
         │  (user_id)
         ▼
┌════════════════════════════════════════════════════════════════════════╗
║                              users                                    ║
║════════════════════════════════════════════════════════════════════════║
║  PK  id              bigint                                           ║
║      name            varchar(255)                                     ║
║      email           varchar(255) unique                              ║
║      password        varchar(255)                                     ║
║      role            enum(admin/donatur)                              ║
║      phone           varchar(20) nullable                             ║
║      address         text nullable                                    ║
║      nik             varchar(20) nullable                             ║
║      avatar          varchar(255) nullable                            ║
║      created_at      timestamp                                        ║
║      updated_at      timestamp                                        ║
╚════════════════════════════════════════════════════════════════════════╝
         │
         │ role = admin
         ├──────────────────────────────────┐
         │                                  │
         │ 1                                │ 1
         │                                  │
         ▼                                  ▼
┌══════════════════════════════════════╗  ┌═══════════════════════════════════════╗
║           profil_yayasan             ║  ║              news                     ║
║══════════════════════════════════════║  ║═══════════════════════════════════════║
║ PK id     bigint                     ║  ║ PK id         bigint                  ║
║   nama_yayasan  varchar(255)         ║  ║   judul       varchar(255)            ║
║   logo          varchar(255) nullable║  ║   slug        varchar(255) unique     ║
║   alamat        text                 ║  ║   kategori    varchar(255) nullable   ║
║   no_telp       varchar(20)          ║  ║   tgl_kegiatan date nullable          ║
║   email         varchar(255)         ║  ║   lokasi      varchar(255) nullable   ║
║   sejarah       text                 ║  ║   ringkasan   text nullable           ║
║   visi          text                 ║  ║   konten      text                    ║
║   misi          text                 ║  ║   foto_utama  varchar(255) nullable   ║
║   legalitas     text nullable        ║  ║   status      enum(draft/published)   ║
║   foto_legalitas varchar(255) null   ║  ║   created_at  timestamp               ║
║   foto_struktur varchar(255) null    ║  ║   updated_at  timestamp               ║
║   created_at    timestamp            ║  ╚═══════════════════════════════════════╝
║   updated_at    timestamp            ║
╚══════════════════════════════════════╝
```

### Ringkasan Relasi (Kardinalitas)

| Entitas Asal | Key | Relasi | Entitas Tujuan | Key Lawan | Kardinalitas |
|-------------|-----|--------|----------------|-----------|--------------|
| campaigns | id | menerima → | donations | campaign_id | 1 to M |
| donations | user_id | dilakukan oleh → | users (donatur) | id | M to 1 |
| users (admin) | id | mengelola → | campaigns | — (via panel) | 1 to M |
| users (admin) | id | mengelola → | profil_yayasan | — (single row) | 1 to 1 |
| users (admin) | id | menulis → | news | — (tanpa FK) | 1 to M |

### Aturan Bisnis Terkait Data

1. Donasi mengacu ke **satu campaign** (`campaign_id` mandatory).
2. Donatur **tidak wajib login** — `user_id` boleh null (guest).
3. Saat donasi sukses, `campaigns.collected_amount` di-increment otomatis.
4. Satu campaign bisa memiliki banyak donasi (termasuk dari donatur yang sama).
5. `status` donasi hanya berubah via **Midtrans callback** atau **sync manual admin**.
6. Riwayat donasi tidak bisa dihapus jika sudah sukses (hanya admin yang bisa hapus via panel).
7. Admin adalah satu-satunya role yang dapat membuat/mengedit campaign, memperbarui profil yayasan, dan menulis berita.
8. Profil yayasan hanya berisi **1 baris data** — diedit langsung oleh admin; tidak ada operasi hapus.
9. Berita memiliki dua status (`draft` / `published`) — hanya yang `published` tampil di halaman publik.

---

## Logical Record Structure (LRS)

### Diagram Relasi LRS

```
┌────────────────────────────────────────────────────────────────────────────┐
│                                                                            │
│  ┌──────────────────────┐          ┌──────────────────────────┐           │
│  │      campaigns        │          │        donations         │           │
│  │──────────────────────│          │──────────────────────────│           │
│  │ PK id  bigint        │◄─────────│ FK campaign_id           │           │
│  │    title              │  1    M  │    user_id  (nullable)   │           │
│  │    slug (unique)      │          │    order_id  (unique)    │           │
│  │    description        │          │    snap_token            │           │
│  │    target_amount      │          │    donor_name            │           │
│  │    collected_amount   │          │    donor_email           │           │
│  │    image              │          │    donor_phone           │           │
│  │    status             │          │    amount                │           │
│  └──────────────────────┘          │    payment_method        │           │
│                                     │    status                │           │
│                                     └───────────┬──────────────┘           │
│                                                 │                          │
│                                                 │ M                        │
│                                                 │                          │
│                                     ┌───────────┴──────────────┐           │
│                                     │         users            │           │
│                                     │──────────────────────────│           │
│                                     │ PK id  bigint            │           │
│                                     │    name                  │           │
│                                     │    email (unique)        │           │
│                                     │    password              │           │
│                                     │    role                  │           │
│                                     │    phone                 │           │
│                                     │    address               │           │
│                                     │    nik                   │           │
│                                     │    avatar                │           │
│                                     └──────────────────────────┘           │
│                                                                            │
│  ┌──────────────────────┐  ┌──────────────────────┐                        │
│  │    profil_yayasan     │  │        news          │                        │
│  │──────────────────────│  │──────────────────────│                        │
│  │ PK id  bigint        │  │ PK id  bigint        │                        │
│  │    nama_yayasan      │  │    judul             │                        │
│  │    logo              │  │    slug (unique)     │                        │
│  │    alamat            │  │    kategori          │                        │
│  │    no_telp           │  │    konten            │                        │
│  │    email             │  │    status            │                        │
│  │    ...               │  └──────────────────────┘                        │
│  └──────────────────────┘                                                   │
│                                                                            │
│  ┌──────────────────────────────────────────────────────┐                  │
│  │  Admin ──1:1──> profil_yayasan                       │                  │
│  │  Admin ──1:M──> news                                 │                  │
│  │  Admin ──1:M──> campaigns                            │                  │
│  │  Donatur ──1:M──> donations                          │                  │
│  └──────────────────────────────────────────────────────┘                  │
└────────────────────────────────────────────────────────────────────────────┘
```

**Keterangan:**
- `PK` = Primary Key, `FK` = Foreign Key
- Tabel `users` menampung **dua role**: `admin` dan `donatur` (dibedakan kolom `role`)
- `donations.user_id` nullable → donatur boleh guest
- Semua foreign key menggunakan `ON DELETE CASCADE` / `ON DELETE SET NULL`

### 1. Campaign

Tabel: `campaigns`

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | title | VARCHAR | 255 | Judul campaign |
| 3 | slug | VARCHAR | 255 | Slug URL (unique) |
| 4 | description | TEXT | 100 | Deskripsi campaign |
| 5 | target_amount | DECIMAL | 15 | Target donasi |
| 6 | collected_amount | DECIMAL | 15 | Dana terkumpul (default 0) |
| 7 | image | VARCHAR | 255 | Gambar campaign (nullable) |
| 8 | status | ENUM | 10 | 'active' / 'completed', default 'active' |
| 9 | created_at | TIMESTAMP | 19 | |
| 10 | updated_at | TIMESTAMP | 19 | |

### 2. Donasi

Tabel: `donations`

| No | Kolom | Tipe Data | Size | Keterangan | Foreign Key |
|----|-------|-----------|------|------------|-------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment | |
| 2 | campaign_id | BIGINT | 20 | Campaign tujuan | FK → campaigns(id) ON DELETE CASCADE |
| 3 | user_id | BIGINT | 20 | Donatur (null jika guest) | FK → users(id) ON DELETE SET NULL |
| 4 | order_id | VARCHAR | 255 | ID transaksi (prefix `DONASI-`) | unique |
| 5 | snap_token | VARCHAR | 255 | Token Snap Midtrans (nullable) | |
| 6 | donor_name | VARCHAR | 255 | Nama donatur | |
| 7 | donor_email | VARCHAR | 255 | Email donatur | |
| 8 | donor_phone | VARCHAR | 20 | No. HP donatur | |
| 9 | amount | DECIMAL | 15 | Nominal donasi | |
| 10 | payment_method | VARCHAR | 50 | Metode bayar dari Midtrans (nullable) | |
| 11 | payment_proof | VARCHAR | 255 | Tidak dipakai (Midtrans full, nullable) | |
| 12 | status | ENUM | 10 | 'pending' / 'success' / 'failed', default 'pending' | |
| 13 | created_at | TIMESTAMP | 19 | | |
| 14 | updated_at | TIMESTAMP | 19 | | |

### 3a. Users — Role Admin

Tabel: `users` (filter `role = 'admin'`)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama lengkap admin |
| 3 | email | VARCHAR | 255 | Email login (unique) |
| 4 | password | VARCHAR | 255 | Hash password |
| 5 | role | ENUM | 10 | 'admin' |
| 6 | phone | VARCHAR | 20 | No. HP (nullable) |
| 7 | address | TEXT | 50 | Alamat (nullable) |
| 8 | avatar | VARCHAR | 255 | Foto profil (nullable) |
| 9 | created_at | TIMESTAMP | 19 | |
| 10 | updated_at | TIMESTAMP | 19 | |

> **Khusus Admin:** Mengelola seluruh konten — campaign, profil yayasan, berita, serta validasi transaksi. Tidak memiliki data `nik`.

### 3b. Users — Role Donatur

Tabel: `users` (filter `role = 'donatur'`)

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama lengkap donatur |
| 3 | email | VARCHAR | 255 | Email login (unique) |
| 4 | password | VARCHAR | 255 | Hash password |
| 5 | role | ENUM | 10 | 'donatur' |
| 6 | phone | VARCHAR | 20 | No. HP (nullable) |
| 7 | address | TEXT | 50 | Alamat (nullable) |
| 8 | nik | VARCHAR | 20 | NIK (nullable) |
| 9 | avatar | VARCHAR | 255 | Foto profil (nullable) |
| 10 | created_at | TIMESTAMP | 19 | |
| 11 | updated_at | TIMESTAMP | 19 | |

> **Khusus Donatur:** Hanya dapat melakukan donasi campaign (bisa sebagai guest tanpa login). Memiliki data `nik` untuk keperluan administrasi dan pelaporan.

### 4. Profil Yayasan

Tabel: `profil_yayasan`

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | nama_yayasan | VARCHAR | 255 | |
| 3 | logo | VARCHAR | 255 | nullable |
| 4 | alamat | TEXT | 100 | |
| 5 | no_telp | VARCHAR | 20 | |
| 6 | email | VARCHAR | 255 | |
| 7 | sejarah_yayasan | TEXT | 200 | nullable |
| 8 | visi | TEXT | 100 | nullable |
| 9 | misi | TEXT | 100 | nullable |
| 10 | legalitas | TEXT | 100 | nullable |
| 11 | foto_legalitas | VARCHAR | 255 | nullable |
| 12 | foto_struktur | VARCHAR | 255 | nullable |
| 13 | created_at | TIMESTAMP | 19 | |
| 14 | updated_at | TIMESTAMP | 19 | |

### 5. Berita / News

Tabel: `news`

| No | Kolom | Tipe Data | Size | Keterangan | Foreign Key |
|----|-------|-----------|------|------------|-------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment | |
| 2 | judul | VARCHAR | 255 | Judul berita | |
| 3 | slug | VARCHAR | 255 | Slug URL | unique |
| 4 | kategori | VARCHAR | 50 | Kategori kegiatan (nullable) | |
| 5 | tanggal_kegiatan | DATE | 10 | Tanggal pelaksanaan (nullable) | |
| 6 | lokasi | VARCHAR | 100 | Tempat kegiatan (nullable) | |
| 7 | penyelenggara | VARCHAR | 100 | Pihak penyelenggara (nullable) | |
| 8 | ringkasan | TEXT | 200 | Cuplikan singkat (nullable) | |
| 9 | konten | TEXT | 1000 | Isi berita lengkap | |
| 10 | foto_utama | VARCHAR | 255 | Gambar sampul (nullable) | |
| 11 | status | ENUM | 10 | 'draft' / 'published', default 'draft' | |
| 12 | created_at | TIMESTAMP | 19 | | |
| 13 | updated_at | TIMESTAMP | 19 | | |

> Berita ditulis oleh admin. Hanya berita dengan status `published` yang tampil di halaman publik yayasan.

---

## Spesifikasi File

### a1. Spesifikasi File Users — Role Admin

| | |
|---|---|
| Nama File Database | users |
| Akronim | admin.myd |
| Fungsi | Menyimpan data kredensial akses admin yayasan |
| Tipe File | File Master |
| Organisasi File | Index Sequential |
| Akses File | Random |
| Media | Harddisk |
| Panjang Record | 916 karakter |
| Kunci Field (PK) | id |

| No | Nama Field | Tipe Data | Size | Keterangan |
|----|-----------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama lengkap admin |
| 3 | email | VARCHAR | 255 | Email login (unique) |
| 4 | password | VARCHAR | 255 | Kata sandi (hash bcrypt) |
| 5 | role | ENUM | 10 | 'admin' |
| 6 | phone | VARCHAR | 20 | No. HP (nullable) |
| 7 | address | TEXT | 50 | Alamat (nullable) |
| 8 | avatar | VARCHAR | 255 | Foto profil (nullable) |
| 9 | created_at | TIMESTAMP | 19 | |
| 10 | updated_at | TIMESTAMP | 19 | |

> **Catatan:** Admin tidak memiliki data `nik`. Kolom `nik` tidak tercantum karena tidak berlaku untuk role admin.

### a2. Spesifikasi File Users — Role Donatur

| | |
|---|---|
| Nama File Database | users |
| Akronim | donatur.myd |
| Fungsi | Menyimpan data kredensial akses donatur yayasan |
| Tipe File | File Master |
| Organisasi File | Index Sequential |
| Akses File | Random |
| Media | Harddisk |
| Panjang Record | 936 karakter |
| Kunci Field (PK) | id |

| No | Nama Field | Tipe Data | Size | Keterangan |
|----|-----------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama lengkap donatur |
| 3 | email | VARCHAR | 255 | Email login (unique) |
| 4 | password | VARCHAR | 255 | Kata sandi (hash bcrypt) |
| 5 | role | ENUM | 10 | 'donatur' |
| 6 | phone | VARCHAR | 20 | No. HP (nullable) |
| 7 | address | TEXT | 50 | Alamat (nullable) |
| 8 | nik | VARCHAR | 20 | NIK (nullable) |
| 9 | avatar | VARCHAR | 255 | Foto profil (nullable) |
| 10 | created_at | TIMESTAMP | 19 | |
| 11 | updated_at | TIMESTAMP | 19 | |

> **Catatan:** Donatur memiliki data `nik` untuk keperluan administrasi dan pelaporan.

### b. Spesifikasi File Campaign

| | |
|---|---|
| Nama File Database | campaigns |
| Akronim | campaigns.myd |
| Fungsi | Menyimpan data program penggalangan dana |
| Tipe File | File Master |
| Organisasi File | Index Sequential |
| Akses File | Random |
| Media | Harddisk |
| Panjang Record | 887 karakter |
| Kunci Field (PK) | id |

| No | Nama Field | Tipe Data | Size | Keterangan |
|----|-----------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | title | VARCHAR | 255 | Judul campaign |
| 3 | slug | VARCHAR | 255 | Slug URL (unique) |
| 4 | description | TEXT | 100 | Deskripsi campaign |
| 5 | target_amount | DECIMAL | 15 | Target donasi |
| 6 | collected_amount | DECIMAL | 15 | Dana terkumpul (default 0) |
| 7 | image | VARCHAR | 255 | Gambar campaign (nullable) |
| 8 | status | ENUM | 10 | 'active' / 'completed' |
| 9 | created_at | TIMESTAMP | 19 | |
| 10 | updated_at | TIMESTAMP | 19 | |

### c. Spesifikasi File Donasi

| | |
|---|---|
| Nama File Database | donations |
| Akronim | donations.myd |
| Fungsi | Menyimpan data transaksi donasi campaign |
| Tipe File | File Transaksi |
| Organisasi File | Index Sequential |
| Akses File | Random |
| Media | Harddisk |
| Panjang Record | 1251 karakter |
| Kunci Field (PK) | id |

| No | Nama Field | Tipe Data | Size | Keterangan |
|----|-----------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | campaign_id | BIGINT | 20 | Foreign Key → campaigns.id |
| 3 | user_id | BIGINT | 20 | Foreign Key → users.id (nullable) |
| 4 | order_id | VARCHAR | 255 | ID transaksi (unique) |
| 5 | snap_token | VARCHAR | 255 | Token Snap Midtrans (nullable) |
| 6 | donor_name | VARCHAR | 255 | Nama donatur |
| 7 | donor_email | VARCHAR | 255 | Email donatur |
| 8 | donor_phone | VARCHAR | 20 | No. HP donatur |
| 9 | amount | DECIMAL | 15 | Nominal donasi |
| 10 | payment_method | VARCHAR | 50 | Metode bayar (nullable) |
| 11 | payment_proof | VARCHAR | 255 | Tidak dipakai (nullable) |
| 12 | status | ENUM | 10 | 'pending' / 'success' / 'failed' |
| 13 | created_at | TIMESTAMP | 19 | |
| 14 | updated_at | TIMESTAMP | 19 | |

### d. Spesifikasi File Profil Yayasan

| | |
|---|---|
| Nama File Database | profil_yayasan |
| Akronim | profil_yayasan.myd |
| Fungsi | Menyimpan informasi profil yayasin (single row) |
| Tipe File | File Master |
| Organisasi File | Index Sequential |
| Akses File | Random |
| Media | Harddisk |
| Panjang Record | 1363 karakter |
| Kunci Field (PK) | id |

| No | Nama Field | Tipe Data | Size | Keterangan |
|----|-----------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | nama_yayasan | VARCHAR | 255 | Nama yayasan |
| 3 | logo | VARCHAR | 255 | File logo (nullable) |
| 4 | alamat | TEXT | 100 | Alamat yayasan |
| 5 | no_telp | VARCHAR | 20 | No. telepon |
| 6 | email | VARCHAR | 255 | Email yayasan |
| 7 | sejarah_yayasan | TEXT | 200 | Sejarah (nullable) |
| 8 | visi | TEXT | 100 | Visi (nullable) |
| 9 | misi | TEXT | 100 | Misi (nullable) |
| 10 | legalitas | TEXT | 100 | Legalitas (nullable) |
| 11 | foto_legalitas | VARCHAR | 255 | File legalitas (nullable) |
| 12 | foto_struktur | VARCHAR | 255 | File struktur (nullable) |
| 13 | created_at | TIMESTAMP | 19 | |
| 14 | updated_at | TIMESTAMP | 19 | |

### e. Spesifikasi File Berita / News

| | |
|---|---|
| Nama File Database | news |
| Akronim | news.myd |
| Fungsi | Menyimpan data berita kegiatan yayasan |
| Tipe File | File Master |
| Organisasi File | Index Sequential |
| Akses File | Random |
| Media | Harddisk |
| Panjang Record | 1416 karakter |
| Kunci Field (PK) | id |

| No | Nama Field | Tipe Data | Size | Keterangan |
|----|-----------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | judul | VARCHAR | 255 | Judul berita |
| 3 | slug | VARCHAR | 255 | Slug URL (unique) |
| 4 | kategori | VARCHAR | 50 | Kategori (nullable) |
| 5 | tanggal_kegiatan | DATE | 10 | Tanggal kegiatan (nullable) |
| 6 | lokasi | VARCHAR | 100 | Lokasi kegiatan (nullable) |
| 7 | penyelenggara | VARCHAR | 100 | Penyelenggara (nullable) |
| 8 | ringkasan | TEXT | 200 | Ringkasan berita (nullable) |
| 9 | konten | TEXT | 1000 | Isi berita |
| 10 | foto_utama | VARCHAR | 255 | Gambar sampul (nullable) |
| 11 | status | ENUM | 10 | 'draft' / 'published' |
| 12 | created_at | TIMESTAMP | 19 | |
| 13 | updated_at | TIMESTAMP | 19 | |

---

## Ringkasan Tabel Modul Donasi (+ Konteks Sistem)

| No | Tabel | Peran dalam Modul |
|----|-------|-------------------|
| 1 | `campaigns` | Entitas utama — target & progress donasi |
| 2 | `donations` | Transaksi — mencatat setiap donasi masuk |
| 3 | `users` | Referensi — data donatur (jika login) + admin pengelola sistem |
| 4 | `profil_yayasan` | Konteks — informasi yayasan di halaman publik (dikelola admin) |
| 5 | `news` | Konteks — berita kegiatan yayasan (ditulis admin) |

> Semua migrasi dan constraint foreign key sudah diimplementasikan di `database/migrations/`.
