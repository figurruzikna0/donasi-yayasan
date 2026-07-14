# Modul Orang Tua Asuh (OTA) — Arsitektur Basis Data (ERD & LRS)

## Entity Relationship Diagram (ERD) — Konseptual

### Identifikasi Entitas

| No | Entitas | Keterangan |
|----|---------|------------|
| 1 | **Anak Asuh** | Data anak asuh binaan yayasan |
| 2 | **Sponsorship** | Transaksi orang tua asuh (OTA) via Midtrans |
| 3 | **Perkembangan Anak** | Laporan perkembangan anak asuh |
| 4 | **Users (Donatur/Admin)** | User role donatur (OTA) + admin (pengisi perkembangan) |

### Relasi Antar Entitas (Kardinalitas)

```
    ┌──────────────────────────────────────────────────────────────────┐
    │                                                                  │
    │  ┌──────────────┐    1          M  ┌──────────────┐             │
    │  │  Anak Asuh   │──────────────────│ Sponsorship  │             │
    │  └──────────────┘  dipilih         └──────┬───────┘             │
    │         │                                  │                     │
    │         │ 1                                │ 1                   │
    │         │                                  │                     │
    │         │ M                                │ M                   │
    │         ▼                                  ▼                     │
    │  ┌──────────────────┐             ┌──────────────────┐          │
    │  │ Perkembangan Anak│             │ Users (Donatur)  │          │
    │  └──────────────────┘             └──────────────────┘          │
    │         │                                                        │
    │         │ M                                                      │
    │         │                                                        │
    │  ┌──────┴───────┐                                               │
    │  │ Users (Admin)│ (pengisi laporan)                              │
    │  └──────────────┘                                               │
    └──────────────────────────────────────────────────────────────────┘
```

| Entitas Asal | Nama Relasi | Entitas Tujuan | Kardinalitas |
|-------------|-------------|----------------|--------------|
| Anak Asuh | Dipilih | Sponsorship | 1 to M |
| Users (Donatur) | Melakukan | Sponsorship | 1 to M |
| Sponsorship | Memiliki | Perkembangan Anak | 1 to M |
| Anak Asuh | Memiliki | Perkembangan Anak | 1 to M |
| Users (Admin) | Membuat | Perkembangan Anak | 1 to M |

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

---

## Ringkasan Tabel Modul OTA

| No | Tabel | Peran dalam Modul |
|----|-------|-------------------|
| 1 | `foster_children` | Entitas utama — data & status anak asuh |
| 2 | `sponsorships` | Transaksi — mencatat setiap sponsorship + masa berlaku |
| 3 | `child_developments` | Riwayat — laporan perkembangan anak |
| 4 | `users` | Referensi — data donatur OTA & admin pengisi laporan |

> Semua migrasi dan constraint foreign key sudah diimplementasikan di `database/migrations/`.
