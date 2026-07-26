# Modul Donasi — HIPO (Hierarchy Plus Input-Process-Output)

## A. Modul Admin

### A.1 Kelola Campaign

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Buat Campaign | Judul, deskripsi, target, gambar | `CampaignController@store()` — validasi → upload image → insert | Campaign tersimpan, tampil di publik |
| Edit Campaign | ID + data baru | `CampaignController@update()` — update row + ganti gambar opsional | Campaign terupdate |
| Hapus Campaign | ID | `CampaignController@destroy()` — hapus gambar dari storage → delete (cascade donasi) | Campaign + donasi terkait terhapus |

### A.2 Manajemen Transaksi Donasi

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Transaksi | - | `TransactionController@index()` — query donations (paginate) + stat counts | Tabel + stat cards |
| Approve Donasi | Order ID (`DONASI-...`) | `TransactionController@approve()` — update status → `success` → generate `invoice_number` → increment `collected_amount` → kirim WA via Fonnte | Status berubah, notifikasi WA terkirim |
| Tolak Donasi | Order ID + alasan | `TransactionController@reject()` — update status → `failed` → isi `rejection_reason` → kirim WA tolak | Status berubah, notifikasi WA terkirim |
| Hapus Donasi | ID record | `TransactionController@destroy()` — delete record + hapus file bukti | Transaksi terhapus |
| Rekap Donasi | Filter status, search, date | `RekapController@donasi()` / `donasiExport()` / `donasiExportPdf()` | Tabel / CSV / PDF |

### A.3 Profil Yayasan

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Edit Profil | Logo, alamat, kontak, visi, misi, sejarah, legalitas, foto legalitas, foto struktur | `ProfilYayasanController@update()` — validasi → upload file → update row tunggal | Data profil tersimpan |
| Kelola Pendiri | Nama, jabatan, foto, urutan | `PendiriController@store()` / `update()` / `destroy()` — validasi → upload foto → insert/update/delete | Pendiri tersimpan/diupdate/dihapus |

### A.4 Berita / News

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Buat Berita | Judul, konten, foto, kategori, status (draft/publish) | `NewsController@store()` — validasi → upload foto → insert → generate slug | Berita tersimpan |
| Edit Berita | ID + data baru | `NewsController@update()` — update + ganti foto opsional | Berita terupdate |
| Hapus Berita | ID | `NewsController@destroy()` — hapus foto dari storage → delete | Berita terhapus |

## B. Modul Donatur

### B.1 Transaksi Donasi

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Campaign Publik | - | Query `Campaign::where('status','active')` — ditampilkan di halaman utama | Card campaign + progress bar |
| Form Donasi | Campaign ID | `DonationController@create()` — query campaign | View form donasi |
| Submit Donasi | Nama, email, no HP, nominal (min 1.000), bukti transfer (JPG/PNG/PDF, max 5MB), tanggal transfer | `DonationController@store()` — validasi → upload `payment_proof` → `Donation::create(status=pending, payment_method='Transfer Bank')` → redirect dashboard + flash success | Record pending, file tersimpan |
| Lihat Riwayat Donasi | - | `DonorController@dashboard()` — query donations by `user_id` | Tabel riwayat donasi |
| Invoice HTML | ID donasi | `InvoiceController@donation()` — cek status `success` + kepemilikan → query donation + profil yayasan | View invoice |
| Invoice PDF | ID donasi | `InvoiceController@donationPdf()` — DomPDF render | File PDF download |

### B.2 Lihat Informasi Publik

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Profil Publik | - | Query `ProfilYayasan::first()` — tampilkan di halaman utama & footer | Informasi yayasan (nama, logo, alamat, kontak, visi-misi, legalitas) |
| Lihat Berita Publik | - | Query `News::published()->latest()->paginate()` | List card berita + pagination |
| Lihat Detail Berita | Slug | Query `News::whereSlug($slug)->published()->firstOrFail()` | View detail berita |

## C. Modul Sistem (Otomatis)

### C.1 Notifikasi WhatsApp

| Modul | Input | Proses | Output |
|-------|-------|--------|--------|
| Notifikasi Approve Donasi | Data donasi + campaign | `FonnteService::send()` — kirim teks via API Fonnte ke nomor donatur | WA: "✓ Donasi RpX untuk {campaign} telah dikonfirmasi" |
| Notifikasi Tolak Donasi | Data donasi + alasan | `FonnteService::send()` — kirim teks via API Fonnte | WA: "✗ Donasi ditolak: {alasan}" |
| Notifikasi Approve Sponsorship | Data sponsorship | `SponsorshipController@approve()` → `FonnteService::send()` | WA konfirmasi sponsorship |
| Notifikasi Perkembangan Anak | Data child_development + foto | `ChildDevelopmentController@store()` → `FonnteService::sendWithMedia()` | WA + foto ke orang tua asuh |