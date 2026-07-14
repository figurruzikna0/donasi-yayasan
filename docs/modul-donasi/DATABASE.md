# Modul Donasi — Arsitektur Basis Data (ERD & LRS)

## Entity Relationship Diagram (ERD) — Konseptual

### Identifikasi Entitas

| No | Entitas | Keterangan |
|----|---------|------------|
| 1 | **Campaign** | Program penggalangan dana |
| 2 | **Donasi** | Transaksi donasi campaign via Midtrans |
| 3 | **Users (Donatur)** | User role donatur yang melakukan donasi (nullable jika guest) |
| 4 | **Profil Yayasan** | Informasi profil yayasan (single row, konteks global) |

### Relasi Antar Entitas (Kardinalitas)

```
    ┌─────────────────────────────────────────────────────────┐
    │                                                         │
    │  ┌──────────┐    1          M  ┌──────────┐            │
    │  │ Campaign │──────────────────│  Donasi  │            │
    │  └──────────┘  menerima        └────┬─────┘            │
    │                                     │                  │
    │                                     │ M                │
    │                                     │                  │
    │                              ┌──────┴──────┐           │
    │                              │ Users (Don.)│           │
    │                              └─────────────┘           │
    │                                                         │
    │  ┌──────────────────┐                                  │
    │  │ Profil Yayasan   │ (single row, 1 record)           │
    │  └──────────────────┘                                  │
    └─────────────────────────────────────────────────────────┘
```

| Entitas Asal | Nama Relasi | Entitas Tujuan | Kardinalitas |
|-------------|-------------|----------------|--------------|
| Campaign | Menerima | Donasi | 1 to M |
| Users (Donatur) | Melakukan | Donasi | 1 to M |
| Users (Admin) | Mengelola | Campaign | 1 to M |

### Aturan Bisnis Terkait Data

1. Donasi mengacu ke **satu campaign** (`campaign_id` mandatory).
2. Donatur **tidak wajib login** — `user_id` boleh null (guest).
3. Saat donasi sukses, `campaigns.collected_amount` di-increment otomatis.
4. Satu campaign bisa memiliki banyak donasi (termasuk dari donatur yang sama).
5. `status` donasi hanya berubah via **Midtrans callback** atau **sync manual admin**.
6. Riwayat donasi tidak bisa dihapus jika sudah sukses (hanya admin yang bisa hapus via panel).

---

## Logical Record Structure (LRS)

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

### 3. Users (Donatur)

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

---

## Ringkasan Tabel Modul Donasi

| No | Tabel | Peran dalam Modul |
|----|-------|-------------------|
| 1 | `campaigns` | Entitas utama — target & progress donasi |
| 2 | `donations` | Transaksi — mencatat setiap donasi masuk |
| 3 | `users` | Referensi — data donatur (jika login) |
| 4 | `profil_yayasan` | Konteks — informasi yayasan di halaman publik |

> Semua migrasi dan constraint foreign key sudah diimplementasikan di `database/migrations/`.
