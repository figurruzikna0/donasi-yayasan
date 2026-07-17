# Modul Orang Tua Asuh (OTA) — Arsitektur Basis Data (ERD & LRS)

## Entity Relationship Diagram (ERD) — Detail Atribut

### Entitas & Atribut

Berikut adalah diagram ERD **lengkap dengan atribut** (kolom) pada setiap tabel.  
Notasi:  **PK** = Primary Key,  **FK** = Foreign Key,  `nullable` = boleh kosong.

```
┌═══════════════════════════════════════════════════════════┐
║                    foster_children                        ║
║═══════════════════════════════════════════════════════════║
║  PK  id                bigint                             ║
║      name              varchar(255)                       ║
║      age               integer                            ║
║      jenis_kelamin     enum('Laki-laki','Perempuan')      ║
║      description       text (nullable)                    ║
║      photo             varchar(255) (nullable)             ║
║      status            enum('Tersedia','Diasuh')          ║
║      created_at        timestamp                          ║
║      updated_at        timestamp                          ║
╚═══════════════════════════════════════════════════════════╝
         │
         │ 1
         │
         │  (foster_child_id)
         ▼
┌══════════════════════════════════════════════════════════════════════════════╗
║                                 sponsorships                                ║
║══════════════════════════════════════════════════════════════════════════════║
║  PK  id                    bigint                                           ║
║  FK  foster_child_id       bigint        ────→ foster_children.id           ║
║  FK  user_id               bigint(null)  ────→ users.id                     ║
║      order_id              varchar(255) unique                              ║
║      snap_token            varchar(255) nullable                            ║
║      donor_name            varchar(255)                                     ║
║      donor_email           varchar(255)                                     ║
║      donor_phone           varchar(20)                                      ║
║      amount                decimal(15,2)                                    ║
║      package               varchar(255) nullable                            ║
║      package_description   text nullable                                    ║
║      payment_method        varchar(255) nullable                            ║
║      payment_proof         varchar(255) nullable (tdk dipakai)              ║
║      status                enum(pending/success/failed/expired)             ║
║      starts_at             date nullable                                    ║
║      expires_at            date nullable                                    ║
║      reminder_sent_at      timestamp nullable                               ║
║      created_at            timestamp                                        ║
║      updated_at            timestamp                                        ║
╚══════════════════════════════════════════════════════════════════════════════╝
         │                                              │
         │ 1                                            │ 1
         │                                              │
         │ (sponsorship_id)                             │ (user_id)
         ▼                                              ▼
┌══════════════════════════════════════════════┐  ┌══════════════════════════════════════════════════════╗
║              child_developments              ║  ║                        users                        ║
║══════════════════════════════════════════════║  ║══════════════════════════════════════════════════════║
║  PK  id                bigint                ║  ║  PK  id              bigint                         ║
║  FK  sponsorship_id    bigint                ║  ║      name            varchar(255)                   ║
║  FK  foster_child_id   bigint                ║  ║      email           varchar(255) unique            ║
║  FK  user_id           bigint (nullable)     ║  ║      password        varchar(255)                   ║
║      tanggal           date                  ║  ║      role            enum('admin','donatur')        ║
║      judul             varchar(255)          ║  ║      phone           varchar(20) nullable           ║
║      deskripsi         text                  ║  ║      address         text nullable                  ║
║      foto              varchar(255) nullable ║  ║      nik             varchar(20) nullable           ║
║      created_at        timestamp             ║  ║      avatar          varchar(255) nullable          ║
║      updated_at        timestamp             ║  ║      created_at      timestamp                      ║
╚══════════════════════════════════════════════╝  ║      updated_at      timestamp                      ║
          │                                       ╚══════════════════════════════════════════════════════╝
          │                                                 │
          │ 1                                               │ role = admin
          │                                                 ├──────────────────────────────┐
          │ (foster_child_id)                               │                              │
          ▼                                                 │ 1                            │ 1
          │ (repeated for clarity)                          │                              │
          │                                                 ▼                              ▼
          │                                    ┌══════════════════════════════════╗  ┌═══════════════════════════════════════╗
          │                                    ║         profil_yayasan          ║  ║               news                    ║
          │                                    ║══════════════════════════════════║  ║═══════════════════════════════════════║
          │                                    ║ PK id      bigint               ║  ║ PK id         bigint                  ║
          │                                    ║   nama_yayasan  varchar(255)    ║  ║   judul       varchar(255)            ║
          ▼                                    ║   logo          varchar(255)    ║  ║   slug        varchar(255) unique     ║
┌══════════════════════════════════════════┐  ║   alamat        text             ║  ║   kategori    varchar(255) nullable   ║
║     foster_children (sama seperti di     ║  ║   no_telp       varchar(20)      ║  ║   tgl_kegiatan date nullable          ║
║      atas, digambar ulang untuk          ║  ║   email         varchar(255)     ║  ║   lokasi      varchar(255) nullable   ║
║      menunjukkan relasi ke child_dev.)   ║  ║   sejarah       text             ║  ║   ringkasan   text nullable           ║
║══════════════════════════════════════════║  ║   visi          text             ║  ║   konten      text                    ║
║  PK  id                bigint            ║  ║   misi          text             ║  ║   foto_utama  varchar(255) nullable   ║
║  ... (lengkap lihat box paling atas)     ║  ║   legalitas     text nullable    ║  ║   status      enum(draft,published)   ║
╚══════════════════════════════════════════╝  ║   foto_legalitas varchar(255)   ║  ║   created_at  timestamp               ║
                                               ║   foto_struktur varchar(255)   ║  ║   updated_at  timestamp               ║
                                               ║   created_at    timestamp       ║  ╚═══════════════════════════════════════╝
                                               ║   updated_at    timestamp       ║
                                               ╚══════════════════════════════════╝
```

### Ringkasan Relasi (Kardinalitas)

| Entitas Asal | Key | Relasi | Entitas Tujuan | Key Lawan | Kardinalitas |
|-------------|-----|--------|----------------|-----------|--------------|
| users (admin) | id | mengelola → | foster_children | — (via panel) | 1 to M |
| foster_children | id | dipilih → | sponsorships | foster_child_id | 1 to M |
| sponsorships | user_id | dilakukan oleh → | users (donatur) | id | M to 1 |
| sponsorships | id | memiliki → | child_developments | sponsorship_id | 1 to M |
| foster_children | id | memiliki → | child_developments | foster_child_id | 1 to M |
| users (admin) | id | mengisi → | child_developments | user_id | 1 to M |
| users (admin) | id | mengelola → | profil_yayasan | — (single row) | 1 to 1 |
| users (admin) | id | menulis → | news | — (tanpa FK) | 1 to M |

### Aturan Bisnis Terkait Data

1. Admin dapat **mengelola banyak anak asuh** — create, read, update, delete data anak.
2. Satu anak asuh bisa **disponsori berkali-kali** sepanjang masa oleh OTA berbeda, namun **hanya 1 sponsorship aktif** dalam satu waktu. Jika anak masih dalam masa berlaku (`status = Diasuh`), anak tidak bisa dipilih untuk sponsorship baru sampai masa berlaku habis dan tidak diperpanjang.
3. Saat sponsorship sukses, `foster_children.status` berubah menjadi **"Diasuh"**.
4. Saat sponsorship expired via cronjob, `foster_children.status` kembali **"Tersedia"**.
5. Perkembangan anak terikat ke **satu sponsorship** dan **satu anak asuh**.
6. Donatur OTA **tidak wajib login** — `user_id` boleh null (guest).
7. Satu sponsorship memiliki **masa berlaku** (`starts_at` / `expires_at`) — otomatis diisi saat sukses.
8. `status` sponsorship: `pending` → `success` / `failed` / `expired`.
9. Cronjob H-7 & H-3 membaca `expires_at` untuk kirim notifikasi perpanjangan.

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
 │  └──────────────────────┘  │ Admin ──1:M──> foster_children      │             │
 │                            │ Admin ──1:M──> child_developments   │             │
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

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama anak |
| 3 | age | INT | 11 | Usia |
| 4 | jenis_kelamin | ENUM | 10 | 'Laki-laki' / 'Perempuan' |
| 5 | description | TEXT | 200 | Deskripsi / latar belakang (nullable) |
| 6 | photo | VARCHAR | 255 | Foto anak (nullable) |
| 7 | status | ENUM | 8 | 'Tersedia' / 'Diasuh', default 'Tersedia' |
| 8 | created_at | TIMESTAMP | 19 | |
| 9 | updated_at | TIMESTAMP | 19 | |

### 2. Sponsorship

Tabel: `sponsorships`

| No | Kolom | Tipe Data | Size | Keterangan | Foreign Key |
|----|-------|-----------|------|------------|-------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment | |
| 2 | foster_child_id | BIGINT | 20 | Anak asuh yang dipilih | FK → foster_children(id) ON DELETE CASCADE |
| 3 | user_id | BIGINT | 20 | Donatur OTA (null jika guest) | FK → users(id) ON DELETE SET NULL |
| 4 | order_id | VARCHAR | 255 | ID transaksi (prefix `SPONSOR-`) | unique |
| 5 | snap_token | VARCHAR | 255 | Token Snap Midtrans (nullable) | |
| 6 | donor_name | VARCHAR | 255 | Nama donatur | |
| 7 | donor_email | VARCHAR | 255 | Email donatur | |
| 8 | donor_phone | VARCHAR | 20 | No. HP donatur | |
| 9 | amount | DECIMAL | 15 | Nominal donasi | |
| 10 | package | VARCHAR | 100 | Paket komitmen (nullable) | |
| 11 | package_description | TEXT | 200 | Deskripsi paket (nullable) | |
| 12 | payment_method | VARCHAR | 50 | Metode bayar dari Midtrans (nullable) | |
| 13 | payment_proof | VARCHAR | 255 | Tidak dipakai (Midtrans full, nullable) | |
| 14 | status | ENUM | 12 | 'pending'/'success'/'failed'/'expired', default 'pending' | |
| 15 | starts_at | DATE | 10 | Tanggal mulai (terisi saat sukses, nullable) | |
| 16 | expires_at | DATE | 10 | Tanggal berakhir (+1 bulan, nullable) | |
| 17 | reminder_sent_at | TIMESTAMP | 19 | Waktu notifikasi dikirim (nullable) | |
| 18 | created_at | TIMESTAMP | 19 | | |
| 19 | updated_at | TIMESTAMP | 19 | | |

### 3. Perkembangan Anak

Tabel: `child_developments`

| No | Kolom | Tipe Data | Size | Keterangan | Foreign Key |
|----|-------|-----------|------|------------|-------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment | |
| 2 | sponsorship_id | BIGINT | 20 | Sponsorship terkait | FK → sponsorships(id) ON DELETE CASCADE |
| 3 | foster_child_id | BIGINT | 20 | Anak asuh | FK → foster_children(id) ON DELETE CASCADE |
| 4 | user_id | BIGINT | 20 | Admin pengisi laporan (nullable) | FK → users(id) ON DELETE SET NULL |
| 5 | tanggal | DATE | 10 | Tanggal laporan | |
| 6 | judul | VARCHAR | 255 | Judul laporan | |
| 7 | deskripsi | TEXT | 500 | Isi laporan | |
| 8 | foto | VARCHAR | 255 | Foto perkembangan (nullable) | |
| 9 | created_at | TIMESTAMP | 19 | | |
| 10 | updated_at | TIMESTAMP | 19 | | |

### 4. Users (Donatur & Admin)

Tabel: `users`

| No | Kolom | Tipe Data | Size | Keterangan |
|----|-------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama lengkap |
| 3 | email | VARCHAR | 255 | Email login (unique) |
| 4 | password | VARCHAR | 255 | Hash password |
| 5 | role | ENUM | 10 | 'admin' / 'donatur' |
| 6 | phone | VARCHAR | 20 | No. HP (nullable) |
| 7 | address | TEXT | 50 | Alamat (nullable) |
| 8 | nik | VARCHAR | 20 | NIK (nullable, khusus donatur) |
| 9 | avatar | VARCHAR | 255 | Foto profil (nullable) |
| 10 | created_at | TIMESTAMP | 19 | |
| 11 | updated_at | TIMESTAMP | 19 | |

> **Catatan role:** User dengan role `admin` memiliki akses penuh ke seluruh modul — termasuk mengelola profil yayasan, menulis berita kegiatan, mengelola campaign & donasi, memvalidasi sponsorship, dan mengisi laporan perkembangan anak. User dengan role `donatur` hanya dapat melakukan transaksi donasi/sponsorship. Kolom `nik` hanya berlaku untuk role `donatur`; admin tidak memiliki data NIK.

### 5. Profil Yayasan

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

### f. Spesifikasi File Berita / News

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

> **Catatan:** Berita ditulis oleh admin (tidak ada foreign key `user_id` di tabel ini karena admin adalah satu-satunya penulis, cukup tercatat di log aktivitas). Berita dengan status `published` tampil di halaman publik yayasan.

---

## Spesifikasi File

### a. Spesifikasi File Users (Admin & Donatur)

| | |
|---|---|
| Nama File Database | users |
| Akronim | users.myd |
| Fungsi | Menyimpan data kredensial akses admin dan donatur yayasan |
| Tipe File | File Master |
| Organisasi File | Index Sequential |
| Akses File | Random |
| Media | Harddisk |
| Panjang Record | 936 karakter |
| Kunci Field (PK) | id |

| No | Nama Field | Tipe Data | Size | Keterangan |
|----|-----------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama lengkap |
| 3 | email | VARCHAR | 255 | Email login (unique) |
| 4 | password | VARCHAR | 255 | Kata sandi (hash bcrypt) |
| 5 | role | ENUM | 10 | 'admin' / 'donatur' |
| 6 | phone | VARCHAR | 20 | No. HP (nullable) |
| 7 | address | TEXT | 50 | Alamat (nullable) |
| 8 | nik | VARCHAR | 20 | NIK (nullable, khusus donatur) |
| 9 | avatar | VARCHAR | 255 | Foto profil (nullable) |
| 10 | created_at | TIMESTAMP | 19 | |
| 11 | updated_at | TIMESTAMP | 19 | |

### b. Spesifikasi File Anak Asuh

| | |
|---|---|
| Nama File Database | foster_children |
| Akronim | foster_children.myd |
| Fungsi | Menyimpan data detail anak asuh binaan yayasan |
| Tipe File | File Master |
| Organisasi File | Index Sequential |
| Akses File | Random |
| Media | Harddisk |
| Panjang Record | 644 karakter |
| Kunci Field (PK) | id |

| No | Nama Field | Tipe Data | Size | Keterangan |
|----|-----------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | name | VARCHAR | 255 | Nama lengkap anak |
| 3 | age | INT | 11 | Usia anak |
| 4 | jenis_kelamin | ENUM | 15 | 'Laki-laki' / 'Perempuan' |
| 5 | description | TEXT | 200 | Deskripsi / latar belakang (nullable) |
| 6 | photo | VARCHAR | 255 | Foto anak (nullable) |
| 7 | status | ENUM | 10 | 'Tersedia' / 'Diasuh' |
| 8 | created_at | TIMESTAMP | 19 | |
| 9 | updated_at | TIMESTAMP | 19 | |

### c. Spesifikasi File Sponsorship

| | |
|---|---|
| Nama File Database | sponsorships |
| Akronim | sponsorships.myd |
| Fungsi | Menyimpan data transaksi orang tua asuh (OTA) via Midtrans |
| Tipe File | File Transaksi |
| Organisasi File | Index Sequential |
| Akses File | Random |
| Media | Harddisk |
| Panjang Record | 1931 karakter |
| Kunci Field (PK) | id |

| No | Nama Field | Tipe Data | Size | Keterangan |
|----|-----------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | foster_child_id | BIGINT | 20 | Foreign Key → foster_children.id |
| 3 | user_id | BIGINT | 20 | Foreign Key → users.id (nullable) |
| 4 | order_id | VARCHAR | 255 | ID transaksi (unique) |
| 5 | snap_token | VARCHAR | 255 | Token Snap Midtrans (nullable) |
| 6 | donor_name | VARCHAR | 255 | Nama donatur OTA |
| 7 | donor_email | VARCHAR | 255 | Email donatur OTA |
| 8 | donor_phone | VARCHAR | 20 | No. HP donatur OTA |
| 9 | amount | DECIMAL | 15 | Nominal sponsorship |
| 10 | package | VARCHAR | 100 | Paket komitmen (nullable) |
| 11 | package_description | TEXT | 200 | Deskripsi paket (nullable) |
| 12 | payment_method | VARCHAR | 50 | Metode bayar (nullable) |
| 13 | payment_proof | VARCHAR | 255 | Tidak dipakai (nullable) |
| 14 | status | ENUM | 15 | 'pending'/'success'/'failed'/'expired' |
| 15 | starts_at | DATE | 10 | Tanggal mulai (nullable) |
| 16 | expires_at | DATE | 10 | Tanggal berakhir (nullable) |
| 17 | reminder_sent_at | TIMESTAMP | 19 | Waktu notifikasi dikirim (nullable) |
| 18 | created_at | TIMESTAMP | 19 | |
| 19 | updated_at | TIMESTAMP | 19 | |

### d. Spesifikasi File Perkembangan Anak

| | |
|---|---|
| Nama File Database | child_developments |
| Akronim | child_developments.myd |
| Fungsi | Menyimpan data laporan perkembangan anak asuh |
| Tipe File | File Transaksi |
| Organisasi File | Index Sequential |
| Akses File | Random |
| Media | Harddisk |
| Panjang Record | 804 karakter |
| Kunci Field (PK) | id |

| No | Nama Field | Tipe Data | Size | Keterangan |
|----|-----------|-----------|------|------------|
| 1 | id | BIGINT | 20 | Primary Key, Auto Increment |
| 2 | sponsorship_id | BIGINT | 20 | Foreign Key → sponsorships.id |
| 3 | foster_child_id | BIGINT | 20 | Foreign Key → foster_children.id |
| 4 | user_id | BIGINT | 20 | Foreign Key → users.id (nullable) |
| 5 | tanggal | DATE | 10 | Tanggal laporan |
| 6 | judul | VARCHAR | 255 | Judul laporan |
| 7 | deskripsi | TEXT | 500 | Isi laporan |
| 8 | foto | VARCHAR | 255 | Foto perkembangan (nullable) |
| 9 | created_at | TIMESTAMP | 19 | |
| 10 | updated_at | TIMESTAMP | 19 | |

### e. Spesifikasi File Profil Yayasan

| | |
|---|---|
| Nama File Database | profil_yayasan |
| Akronim | profil_yayasan.myd |
| Fungsi | Menyimpan informasi profil yayasan (single row) |
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

### f. Spesifikasi File Berita / News

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
