# Modul Orang Tua Asuh (OTA) — HIPO

## A. Kelola Anak Asuh

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Anak Asuh Publik | - | Query `FosterChild::all()` — tampil di dashboard donatur | Profil anak + status Tersedia/Diasuh |
| Buat Anak Asuh | Nama, usia, JK, deskripsi, foto | `FosterChildController@store()` — validasi → upload foto → insert | Anak asuh tersimpan |
| Edit Anak Asuh | ID + data baru | `FosterChildController@update()` — update + ganti foto opsional | Data terupdate |
| Hapus Anak Asuh | ID | `FosterChildController@destroy()` — hapus foto → cascade delete sponsorship + perkembangan | Anak + data terkait terhapus |

## B. Transaksi Sponsorship

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Form Sponsor | ID anak asuh | `DonationController@sponsorForm()` — query child | View form sponsorship + pilih paket |
| Submit Sponsor | Nama, email, no HP, nominal (100rb–500rb), paket, metode bayar | `DonationController@sponsorStore()` — validasi → `Sponsorship::create(pending)` → `initMidtrans()` → `Snap::getSnapToken()` → simpan snap_token | View payment Midtrans Snap |
| Callback Midtrans | Notifikasi JSON (`SPONSOR-{order_id}`) | `DonationController@callback()` — update status → `success` → set `starts_at`/`expires_at` (+1 bulan) → anak → `Diasuh` → kirim WA + Email | Status + anak terupdate |
| Invoice HTML | ID sponsorship | `InvoiceController@sponsorship()` — query + profil yayasan | View invoice |
| Invoice PDF | ID sponsorship | `InvoiceController@sponsorshipPdf()` — DomPDF | File PDF download |

## C. Perkembangan Anak

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Laporan | - | `ChildDevelopmentController@index()` — paginated + eager load | Tabel laporan |
| Buat Laporan | Anak asuh (hanya yg punya sponsorship aktif), tanggal, judul, deskripsi, foto | `ChildDevelopmentController@store()` — validasi → find active sponsorship → create → `kirimWaLaporan()` (WA + foto ke sponsor) | Laporan tersimpan + WA terkirim |
| Edit Laporan | ID + data baru | `ChildDevelopmentController@update()` — update + ganti foto | Laporan terupdate |
| Hapus Laporan | ID | `ChildDevelopmentController@destroy()` — hapus foto → delete | Laporan terhapus |
| PDF Laporan | ID laporan | `InvoiceController@childDevelopmentPdf()` — query + DomPDF | Download PDF |

## D. Manajemen Transaksi (Admin)

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Sponsor | - | `SponsorshipController@index()` — paginated 50 | Tabel sponsorship |
| Approve Sponsor | Order ID (`SPONSOR-...`) | `TransactionController@approve()` / `SponsorshipController@approve()` — status → `success` → set `starts_at/expires_at` → anak → `Diasuh` → WA + Email | Status berubah |
| Hapus Sponsor | Order ID | `TransactionController@destroy()` — delete | Sponsor terhapus |
| Daftar Kontak | - | `SponsorshipController@contacts()` — child + active sponsor info | View kontak |

## E. Otomatisasi (Cronjob)

| Modul | Input | Proses | Output |
|-------|-------|--------|--------|
| Reminder H-7 | - | `SendSponsorshipReminders` — cari sponsor akan expired dlm 7 hari → kirim email → set `reminder_sent_at` | Email reminder terkirim |
| Reminder H-3 | - | `CheckSponsorshipDueDates` — cari sponsor expires H-3 → kirim WA | WA reminder terkirim |
| Expired Otomatis | - | `CheckSponsorshipDueDates` — cari sponsor lewat `expires_at` → status `expired` → anak `Tersedia` (jika tdk ada sponsor aktif lain) | Status expired, anak siap disponsori lagi |
