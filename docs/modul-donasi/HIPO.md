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
| Approve Donasi | Order ID (`DONASI-...`) | `TransactionController@approve()` — update status → `success` → increment `collected_amount` → kirim WA + Email | Status berubah, notifikasi terkirim |
| Hapus Donasi | Order ID | `TransactionController@destroy()` — delete by order_id | Transaksi terhapus |
| Sync Donasi | - | `TransactionController@syncAll()` / `sync($id)` — panggil Midtrans → update massal | Status tersinkron |
| Rekap Donasi | Filter status, search, date | `RekapController@donasi()` / `donasiExport()` / `donasiExportPdf()` | Tabel / CSV / PDF |

### A.3 Profil Yayasan

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Edit Profil | Logo, alamat, kontak, visi, misi, sejarah, legalitas, foto legalitas, foto struktur | `ProfilYayasanController@update()` — validasi → upload file → update row tunggal | Data profil tersimpan |
| Kelola Pendiri | Nama, jabatan, foto | `PendiriController@store()` / `destroy()` — validasi → upload foto → insert/delete | Pendiri tersimpan/dihapus |

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
| Submit Donasi | Nama, email, no HP, nominal (min 1.000), metode bayar | `DonationController@store()` — validasi → `Donation::create(pending)` → `initMidtrans()` → `Snap::getSnapToken()` → simpan snap_token | View payment Midtrans Snap |
| Pembayaran | Snap token | Snap pop-up — donatur pilih channel & bayar di luar sistem | Transaksi di Midtrans |
| Invoice HTML | ID donasi | `InvoiceController@donation()` — query donation + profil yayasan | View invoice |
| Invoice PDF | ID donasi | `InvoiceController@donationPdf()` — DomPDF render | File PDF download |

### B.2 Lihat Informasi Publik

| Modul | Input | Proses (Fungsi Controller) | Output |
|-------|-------|---------------------------|--------|
| Lihat Profil Publik | - | Query `ProfilYayasan::first()` — tampilkan di halaman utama & footer | Informasi yayasan (nama, logo, alamat, kontak, visi-misi, legalitas) |
| Lihat Berita Publik | - | Query `News::where('status','published')` — paginated — tampil di halaman berita | List card berita |
| Lihat Detail Berita | Slug | `NewsController@show()` — query by slug | View detail berita |

## C. Modul Sistem (Otomatis)

### C.1 Callback & Sinkronisasi

| Modul | Input | Proses | Output |
|-------|-------|--------|--------|
| Callback Midtrans | Notifikasi JSON (`transaction_status`, `order_id`) | `DonationController@callback()` — update status → `success`/`failed` → increment `collected_amount` → kirim WA + Email | Status terupdate di DB |