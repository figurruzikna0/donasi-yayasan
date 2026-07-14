# Sprint — Pemodelan Logika Sistem (HIPO)

## Hierarchy Plus Input-Process-Output

### Modul 1: Autentikasi

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Registrasi | Nama, email, password, no HP, alamat, NIK | `RegisteredUserController@store()` — validasi → create user → auto-login | Redirect ke dashboard donatur |
| Login | Email & password | `AuthenticatedSessionController@store()` — autentikasi → cek role → redirect | Redirect ke `/admin/dashboard` (admin) atau `/dashboard` (donatur) |
| Logout | - | `AuthenticatedSessionController@destroy()` — invalidate session | Redirect ke halaman utama |
| Lupa Password | Email | `PasswordResetLinkController@store()` — kirim link reset via email | Email terkirim |
| Reset Password | Token, email, password baru | `NewPasswordController@store()` — validasi token → update password | Redirect ke login |
| Verifikasi Email | Signed URL | `VerifyEmailController@__invoke()` — tandai email terverifikasi | Redirect ke dashboard |

### Modul 2: Profil Yayasan

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Profil | - | `ProfilYayasanController@index()` — query `ProfilYayasan::first()` + `Pendiri::all()` | View profil + daftar pendiri |
| Edit Profil | Logo, alamat, kontak, visi-misi, legalitas, foto | `ProfilYayasanController@update()` — validasi → upload file → update row | Data profil tersimpan di DB |
| Tambah Pendiri | Nama, jabatan, deskripsi, foto | `PendiriController@store()` — validasi → upload foto → insert | Pendiri baru tersimpan |
| Hapus Pendiri | ID pendiri | `PendiriController@destroy()` — hapus foto dari storage → delete row | Pendiri terhapus |

### Modul 3: Berita / News

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Berita Publik | Slug berita | `NewsController@show()` — query news by slug (published only) | View detail berita |
| Kelola Berita | Judul, slug, kategori, konten, foto, status | `NewsController@index() / create() / store() / edit() / update() / destroy()` — CRUD penuh + upload foto | Berita tersimpan/dihapus di DB |

### Modul 4: Campaign

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Campaign Publik | - | Tampil di halaman utama (welcome) — query campaign active | Card campaign di landing page |
| Kelola Campaign | Judul, deskripsi, target, gambar, status | `CampaignController@index() / create() / store() / edit() / update() / destroy()` — CRUD penuh + upload gambar | Campaign tersimpan/dihapus di DB |

### Modul 5: Anak Asuh (Foster Children)

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Anak Asuh Publik | - | Tampil di halaman donatur dashboard | Profil anak asuh + status |
| Kelola Anak Asuh | Nama, usia, JK, deskripsi, foto, status | `FosterChildController@index() / create() / store() / edit() / update() / destroy()` — CRUD penuh + upload foto | Anak asuh tersimpan/dihapus di DB |

### Modul 6: Donasi Campaign

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Form Donasi | Campaign ID | `DonationController@create()` — query campaign | View form donasi |
| Submit Donasi | Nama, email, no HP, nominal, metode bayar | `DonationController@store()` — validasi → create Donation → init Midtrans → `Snap::getSnapToken()` | View payment Midtrans (Snap) |
| Pembayaran | Snap token | Midtrans Snap popup — donatur pilih channel bayar | Transaksi di Midtrans |
| Callback Midtrans | Notifikasi JSON dari Midtrans | `DonationController@callback()` — update status donation → increment campaign → kirim WA + email | Status transaksi terupdate di DB |
| Invoice | ID donasi | `InvoiceController@donation()` / `donationPdf()` — query donation + profil yayasan | View invoice HTML / PDF |

### Modul 7: Sponsorship (Orang Tua Asuh)

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Form Sponsor | ID anak asuh | `DonationController@sponsorForm()` — query foster child | View form sponsorship |
| Submit Sponsor | Nama, email, no HP, nominal, paket, metode bayar | `DonationController@sponsorStore()` — validasi → create Sponsorship → init Midtrans → `Snap::getSnapToken()` | View payment Midtrans (Snap) |
| Callback Midtrans | Notifikasi JSON | `DonationController@callback()` — update status sponsorship → set starts_at/expires_at → update anak Diasuh → kirim WA + email | Status sponsorship terupdate |
| Invoice | ID sponsorship | `InvoiceController@sponsorship()` / `sponsorshipPdf()` | View invoice HTML / PDF |

### Modul 8: Perkembangan Anak

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Laporan | - | `ChildDevelopmentController@index()` — paginated + eager load | Tabel laporan |
| Buat Laporan | Anak asuh, tanggal, judul, deskripsi, foto | `ChildDevelopmentController@store()` — validasi → find active sponsorship → create report → kirim WA + foto ke donatur | Laporan tersimpan + WA terkirim |
| Edit Laporan | ID laporan, data baru | `ChildDevelopmentController@update()` — update row + ganti foto opsional | Laporan terupdate |
| Hapus Laporan | ID laporan | `ChildDevelopmentController@destroy()` — hapus foto dari storage → delete row | Laporan terhapus |
| PDF Laporan | ID laporan | `InvoiceController@childDevelopmentPdf()` — query report + sponsorship + anak | Download PDF |

### Modul 9: Transaksi (Admin)

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Transaksi | - | `TransactionController@index()` — query donations + sponsorships → paginate + stat counts | View tabel + stat cards |
| Setujui Transaksi | Order ID | `TransactionController@approve()` — update status success → increment campaign (donasi) / set anak Diasuh (sponsor) → kirim WA + email | Status berubah, notifikasi terkirim |
| Hapus Transaksi | Order ID | `TransactionController@destroy()` — delete by order_id | Transaksi terhapus |
| Sync Satu Transaksi | Order ID | `TransactionController@sync()` — panggil Midtrans `Transaction::status()` → update sesuai response | Status tersinkron |
| Sync Semua | - | `TransactionController@syncAll()` — loop semua pending → panggil Midtrans → update massal | Semua transaksi pending tersinkron |

### Modul 10: Dashboard (Statistik)

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Dashboard Admin | - | `DashboardController@index()` — query total funds, active campaigns, top 5 campaign, stat anak asuh, cashflow 12 bulan (1 query GROUP BY) | View dashboard + chart data |
| Dashboard Donatur | - | `DonorController@dashboard()` — query campaigns, news, anak asuh, riwayat donasi/sponsor user | View dashboard donatur |
| Rekap Donatur | - | `DonorController@rekap()` — query donations + sponsorships + perkembangan milik user | View rekap pribadi |

### Modul 11: Rekap & Ekspor (Admin)

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Rekap Donasi | Filter status, date range, search | `RekapController@donasi()` — filter + paginate | Tabel rekap donasi |
| Ekspor CSV Donasi | Filter yang sama | `RekapController@donasiExport()` — query → generate CSV | File CSV download |
| Ekspor PDF Donasi | Filter yang sama | `RekapController@donasiExportPdf()` — query → DomPDF render | File PDF download |
| Rekap Donatur | Search, date filter | `RekapController@donatur()` / `donaturExport()` / `donaturExportPdf()` | Tabel / CSV / PDF |
| Rekap OTA | Filter status, date | `RekapController@orangTuaAsuh()` / exports | Tabel / CSV / PDF |

### Modul 12: Manajemen Pengguna

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Users | - | `UserController@index()` — paginate donaturs + list admins | Tabel users |
| Edit User | ID user, data baru | `UserController@update()` — validasi → update name, email, phone, role | Data user terupdate |
| Hapus User | ID user | `UserController@destroy()` — cegah hapus admin → delete donatur | User terhapus |

### Modul 13: Notifikasi Otomatis

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| WA Donasi Sukses | Data donasi + campaign | `DonationController@kirimWaDonasi()` — format pesan → `FonnteService::send()` | WA terkirim ke donatur |
| WA Sponsor Sukses | Data sponsorship + anak | `DonationController@kirimWaSponsor()` — format pesan → `FonnteService::send()` | WA terkirim ke donatur |
| WA Laporan Anak | Laporan + foto | `ChildDevelopmentController@kirimWaLaporan()` — format pesan → `FonnteService::sendWithMedia()` | WA + foto terkirim ke sponsor |
| WA Pengingat H-3 | Sponsorship akan expired | `CheckSponsorshipDueDates` command — cek H-3 → kirim WA | WA pengingat terkirim |
| Email Donasi Sukses | Data donasi | `DonationSuccessMail` — trigger dari callback/approve/sync | Email terkirim |
| Email Sponsor Sukses | Data sponsorship | `SponsorshipSuccessMail` — trigger dari callback/approve/sync | Email terkirim |
| Email Reminder H-7 | Sponsorship expired dlm 7 hari | `SendSponsorshipReminders` command — kirim email → set `reminder_sent_at` | Email reminder terkirim |

### Ringkasan Struktur HIPO

```
SISTEM DONASI YAYASAN BAITUL YATIM
│
├── Level 1: AUTENTIKASI
│   ├── Registrasi
│   ├── Login (role-based redirect)
│   ├── Logout
│   ├── Lupa / Reset Password
│   └── Verifikasi Email
│
├── Level 1: MASTER DATA
│   ├── Profil Yayasan (CRUD)
│   ├── Pendiri (CRUD)
│   ├── Berita (CRUD + draft/publish)
│   ├── Campaign (CRUD)
│   └── Anak Asuh (CRUD + status Tersedia/Diasuh)
│
├── Level 1: TRANSAKSI
│   ├── Donasi Campaign → Midtrans Snap → Callback → Invoice PDF
│   ├── Sponsorship OTA → Midtrans Snap → Callback → Invoice PDF
│   └── Perkembangan Anak (CRUD + WA ke sponsor + PDF)
│
├── Level 1: MANAGEMEN TRANSAKSI (Admin)
│   ├── Lihat + Setujui + Hapus
│   ├── Sync Satu / Sync Semua ke Midtrans
│   └── Rekap + Ekspor CSV/PDF
│
├── Level 1: DASHBOARD & LAPORAN
│   ├── Dashboard Admin (statistik + chart cashflow)
│   ├── Dashboard Donatur (riwayat + status)
│   └── Manajemen Pengguna (CRUD)
│
└── Level 1: NOTIFIKASI OTOMATIS
    ├── WhatsApp (sukses, laporan, reminder H-3)
    └── Email (sukses, reminder H-7)
```
