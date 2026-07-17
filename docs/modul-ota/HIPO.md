# Modul Orang Tua Asuh (OTA) — HIPO

## A. Modul Admin

### A.1 Kelola Anak Asuh

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Buat Anak Asuh | Nama, usia, JK, deskripsi, foto | FosterChildController@store() — validasi → upload foto → insert | Anak asuh tersimpan |
| Edit Anak Asuh | ID + data baru | FosterChildController@update() — update + ganti foto opsional | Data terupdate |
| Hapus Anak Asuh | ID | FosterChildController@destroy() — hapus foto → cascade delete sponsorship + perkembangan | Anak + data terkait terhapus |

### A.2 Manajemen Transaksi Sponsorship

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Sponsor | - | SponsorshipController@index() — paginated 50 | Tabel sponsorship |
| Approve Sponsor | Order ID (SPONSOR-...) | TransactionController@approve() / SponsorshipController@approve() — status → success → set starts_at/expires_at → anak → Diasuh → WA + Email | Status berubah |
| Hapus Sponsor | Order ID | TransactionController@destroy() — delete | Sponsor terhapus |
| Daftar Kontak | - | SponsorshipController@contacts() — child + active sponsor info | View kontak |

### A.3 Perkembangan Anak (Input Laporan)

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Laporan | - | ChildDevelopmentController@index() — paginated + eager load | Tabel laporan |
| Buat Laporan | Anak asuh (hanya yg punya sponsorship aktif), tanggal, judul, deskripsi, foto | ChildDevelopmentController@store() — validasi → find active sponsorship → create → kirimWaLaporan() (WA + foto ke sponsor) | Laporan tersimpan + WA terkirim |
| Edit Laporan | ID + data baru | ChildDevelopmentController@update() — update + ganti foto | Laporan terupdate |
| Hapus Laporan | ID | ChildDevelopmentController@destroy() — hapus foto → delete | Laporan terhapus |
| PDF Laporan | ID laporan | InvoiceController@childDevelopmentPdf() — query + DomPDF | Download PDF |

### A.4 Profil Yayasan

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Edit Profil | Logo, alamat, kontak, visi, misi, sejarah, legalitas, foto legalitas, foto struktur | ProfilYayasanController@update() — validasi → upload file → update row tunggal | Data profil tersimpan |
| Kelola Pendiri | Nama, jabatan, foto | PendiriController@store() / destroy() — validasi → upload foto → insert/delete | Pendiri tersimpan/dihapus |

### A.5 Berita / News

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Buat Berita | Judul, konten, foto, kategori, status (draft/publish) | NewsController@store() — validasi → upload foto → insert → generate slug | Berita tersimpan |
| Edit Berita | ID + data baru | NewsController@update() — update + ganti foto opsional | Berita terupdate |
| Hapus Berita | ID | NewsController@destroy() — hapus foto dari storage → delete | Berita terhapus |

## B. Modul Donatur

### B.1 Transaksi Sponsorship

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Anak Asuh Publik | - | Query FosterChild::all() — tampil di dashboard donatur | Profil anak + status Tersedia/Diasuh |
| Form Sponsor | ID anak asuh | DonationController@sponsorForm() — query child | View form sponsorship + pilih paket |
| Submit Sponsor | Nama, email, no HP, nominal (100rb–500rb), paket, metode bayar | DonationController@sponsorStore() — validasi → Sponsorship::create(pending) → initMidtrans() → Snap::getSnapToken() → simpan snap_token | View payment Midtrans Snap |
| Invoice HTML | ID sponsorship | InvoiceController@sponsorship() — query + profil yayasan | View invoice |
| Invoice PDF | ID sponsorship | InvoiceController@sponsorshipPdf() — DomPDF | File PDF download |

### B.2 Lihat Informasi Publik

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Profil Publik | - | Query ProfilYayasan::first() — tampilkan di halaman utama & footer | Informasi yayasan (nama, logo, alamat, kontak, visi-misi, legalitas) |
| Lihat Berita Publik | - | Query News::where('status','published') — paginated — tampil di halaman berita | List card berita |
| Lihat Detail Berita | Slug | NewsController@show() — query by slug | View detail berita |

## C. Modul Sistem (Otomatis)

### C.1 Callback & Sinkronisasi

| Modul | Input | Proses | Output |
|-------|-------|--------|--------|
| Callback Midtrans | Notifikasi JSON (SPONSOR-{order_id}) | DonationController@callback() — update status → success → set starts_at/expires_at (+1 bulan) → anak → Diasuh → kirim WA + Email | Status + anak terupdate |

### C.2 Notifikasi & Expired

| Modul | Input | Proses | Output |
|-------|-------|--------|--------|
| Reminder H-7 | - | SendSponsorshipReminders — cari sponsor akan expired dlm 7 hari → kirim email → set reminder_sent_at | Email reminder terkirim |
| Reminder H-3 | - | CheckSponsorshipDueDates — cari sponsor expires H-3 → kirim WA | WA reminder terkirim |
| Expired Otomatis | - | CheckSponsorshipDueDates — cari sponsor lewat expires_at → status expired → anak Tersedia (jika tdk ada sponsor aktif lain) | Status expired, anak siap disponsori lagi |
