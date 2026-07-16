# Modul Donasi — Arsitektur Basis Data (ERD & LRS)

## Entity Relationship Diagram (ERD) — Konseptual

### Identifikasi Entitas

| No | Entitas | Keterangan |
|----|---------|------------|
| 1 | **Campaign** | Program penggalangan dana |
| 2 | **Donasi** | Transaksi donasi campaign via Midtrans |
| 3 | **Users** | User role donatur (melakukan donasi) + admin (mengelola campaign, profil, berita) |
| 4 | **Profil Yayasan** | Informasi profil yayasan — dikelola oleh admin (single row) |
| 5 | **Berita** | Berita kegiatan yayasan — ditulis oleh admin |

### Relasi Antar Entitas (Kardinalitas)

```
    ┌──────────────────────────────────────────────────────────────────┐
    │                                                                  │
    │  ┌──────────┐    1          M  ┌──────────┐                     │
    │  │ Campaign │──────────────────│  Donasi  │                     │
    │  └──────────┘  menerima        └────┬─────┘                     │
    │                                     │                           │
    │                                     │ M                         │
    │                                     │                           │
    │                              ┌──────┴──────┐                    │
    │                              │Users (Don.) │                    │
    │                              └─────────────┘                    │
    │                                                                  │
    │  ┌──────────────────────┐         1          ┌──────────────┐   │
    │  │   Profil Yayasan     │────────────────────│Users (Admin) │   │
    │  │(single row, dikelola │   mengelola        └──────┬───────┘   │
    │  │     oleh admin)      │                           │           │
    │  └──────────────────────┘                           │ 1         │
    │                                                      │           │
    │                                                      │ M         │
    │                                              ┌──────┴──────┐    │
    │                                              │Berita / News│    │
    │                                              │  (ditulis)  │    │
    │                                              └─────────────┘    │
    └──────────────────────────────────────────────────────────────────┘
```

| Entitas Asal | Nama Relasi | Entitas Tujuan | Kardinalitas |
|-------------|-------------|----------------|--------------|
| Campaign | Menerima | Donasi | 1 to M |
| Users (Donatur) | Melakukan | Donasi | 1 to M |
| Users (Admin) | Mengelola | Campaign | 1 to M |
| Users (Admin) | Mengelola | Profil Yayasan | 1 to 1 |
| Users (Admin) | Menulis | Berita | 1 to M |

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

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | bigint, PK, auto-increment | |
| title | varchar(255) | Judul campaign |
| slug | varchar(255), unique | Slug URL |
| description | text | Deskripsi campaign |
| target_amount | decimal(15,2) | Target donasi |
| collected_amount | decimal(15,2), default 0 | Dana terkumpul |
| image | varchar(255), nullable | Gambar campaign |
| status | enum('active','completed'), default 'active' | Status campaign |
| created_at | timestamp | |
| updated_at | timestamp | |

### 2. Donasi

Tabel: `donations`

| Kolom | Tipe Data | Keterangan | Foreign Key |
|-------|-----------|------------|-------------|
| id | bigint, PK, auto-increment | |
| campaign_id | bigint | Campaign tujuan | FK → campaigns(id) ON DELETE CASCADE |
| user_id | bigint, nullable | Donatur (null jika guest) | FK → users(id) ON DELETE SET NULL |
| order_id | varchar(255), unique | ID transaksi (prefix `DONASI-`) |
| snap_token | varchar(255), nullable | Token Snap Midtrans |
| donor_name | varchar(255) | Nama donatur |
| donor_email | varchar(255) | Email donatur |
| donor_phone | varchar(20) | No. HP donatur |
| amount | decimal(15,2) | Nominal donasi |
| payment_method | varchar(255), nullable | Metode bayar dari Midtrans |
| payment_proof | varchar(255), nullable | Tidak dipakai (Midtrans full) |
| status | enum('pending','success','failed'), default 'pending' | Status transaksi |
| created_at | timestamp | |
| updated_at | timestamp | |

### 3. Users (Donatur & Admin)

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

> **Catatan role:** User dengan role `admin` mengelola seluruh konten — campaign, profil yayasan, berita, serta validasi transaksi. User dengan role `donatur` hanya dapat melakukan donasi campaign (bisa sebagai guest tanpa login).

### 4. Profil Yayasan

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

### 5. Berita / News

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

> Berita ditulis oleh admin. Hanya berita dengan status `published` yang tampil di halaman publik yayasan.

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
