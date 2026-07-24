# Rencana Pengembangan — 8 Sprint / 92 Hari
## Yayasan Baitul Yatim Sukabumi — Modul Donasi Kampanye + Profil Yayasan & Berita Kegiatan

---

## Sprint 1 (Hari 1–12): Fondasi Database Campaign & Profil Yayasan

### Sub-sprint 1A — Database Campaign [Hari 1–5]

**Sprint Goal:** Tabel campaign dan donasi siap, skema database final.

#### 1. Sprint Planning
**PB-D01:** Sebagai Admin, saya ingin dapat menyimpan data kampanye donasi agar calon donatur mengetahui program donasi yang tersedia.

**Tugas Teknis:**
- Migration tabel `campaigns`: id, title, slug (unique), description, target_amount (decimal 15,2), collected_amount (default 0), image (nullable), status (enum: active/completed), timestamps
- Migration tabel `donations`: id, campaign_id (FK cascade), user_id (nullable FK nullOnDelete), order_id (unique nullable), snap_token (nullable), donor_name, donor_email, donor_phone, amount (unsignedBigInteger), payment_method, payment_proof, transfer_date, status (default: pending), timestamps
- Membuat model `Campaign` dengan relasi hasMany ke Donation dan booted (hapus image saat delete)
- Membuat model `Donation` dengan relasi belongsTo ke Campaign dan User
- Factory Campaign untuk data pengujian
- Migration tambahan: user_id ke donations, payment_method ke donations, donor_phone ke donations, payment_proof + transfer_date

#### 2. Daily Scrum

**Hari 1 — Rancangan Database**
> **Raka (Developer):** "Kemarin saya menyelesaikan desain skema database campaign dan donasi. Campaign punya status aktif/selesai, collected_amount progresif. Donasi menyimpan data donatur dan status pembayaran."
>
> **Raka:** "Hari ini membuat migration campaign dan donations beserta model dan factory."
>
> **Raka:** "Kendala? Status donasi perlu tiga nilai: pending (menunggu), success (lunas), failed (gagal). Tidak perlu enum karena bisa saja ada nilai lain di masa depan."

**Hari 3 — Tambahan Migrasi**
> **Raka:** "Campaign dan Donation Factory sudah siap. Model sudah memiliki relasi dan booted untuk hapus image."
>
> **Raka:** "Hari ini menambahkan kolom user_id (relasi ke donatur), payment_method, donor_phone, payment_proof, dan transfer_date melalui migrasi terpisah."
>
> **Raka:** "Perlu mempertimbangkan — payment_proof sempat di-drop kemudian ditambahkan lagi. Riwayat migrasi mencatat perubahan ini."

**Hari 5 — Finalisasi Skema**
> **Raka:** "Skema database final: 5 migrasi tambahan setelah create. Semua kolom siap untuk pengembangan fitur."
>
> **Raka:** "Hari ini pengujian akhir — memastikan factory berfungsi, relasi campaign-donation berjalan, dan booted trait menghapus image saat campaign dihapus."
>
> **Raka:** "Semua berfungsi dengan baik. Siap memasuki Sprint 2."

#### 3. Sprint Review

**Demonstrasi:**
Menjalankan `php artisan migrate:fresh --seed` — tabel campaigns dan donations terbuat dengan seluruh kolom. Factory menghasilkan 10 campaign dummy. Relasi campaign->donations berfungsi. Booted model menghapus image saat campaign dihapus.

**Umpan Balik:**
> **Pengurus Yayasan:** "Skema database sudah sesuai. Pastikan kolom nominal donasi dapat menampung jumlah hingga ratusan juta."

**Tindakan:**
- Menggunakan unsignedBigInteger untuk amount agar muat nominal besar
- collected_amount di campaign menggunakan decimal(15,2) untuk presisi

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Factory mempermudah pengujian data campaign
- Relasi campaign-donation sudah tepat dengan cascade delete

**Hal yang perlu diperbaiki:**
- Riwayat migrasi cukup panjang karena ada drop/add payment_proof — mestinya direncanakan lebih matang di awal
- Belum ada seeder untuk data donasi contoh

### Sub-sprint 1B — Database Profil Yayasan [Hari 6–12]

**Sprint Goal:** Tabel profil yayasan dan sistem View Composer siap.

#### 1. Sprint Planning
**PB-P01:** Sebagai Admin, saya ingin dapat menyimpan dan mengubah profil yayasan (nama, logo, alamat, kontak, sejarah, visi, misi) agar informasi yayasan tampil di seluruh halaman — termasuk halaman donasi dan invoice.

**Tugas Teknis:**
- Migration tabel `profil_yayasan`: id, nama_yayasan, email, no_telp, alamat, sejarah_yayasan (nullable text), visi (nullable text), misi (nullable text), logo (nullable string), legalitas (nullable text), foto_legalitas (nullable string), foto_struktur (nullable string), timestamps
- Migration tabel `pendiris`: id, nama, jabatan, deskripsi (nullable text), foto (nullable string), timestamps
- Membuat model `ProfilYayasan` dengan fillable semua kolom
- Membuat model `Pendiri` dengan fillable dan booted deleted (hapus foto saat dihapus)
- Membuat `ProfilYayasanComposer` — View Composer global yang inject `$profil` ke seluruh view
- Mendaftarkan composer di `AppServiceProvider::boot()`

#### 2. Daily Scrum

**Hari 6 — Rancangan Database**
> **Raka:** "Kemarin saya menyelesaikan desain tabel profil_yayasan dan pendiris. Profil yayasan menyimpan data statis (nama, logo, alamat, sejarah, visi, misi, legalitas). Pendiri menyimpan data pengurus yayasan."
>
> **Raka:** "Hari ini membuat migration, model, factory, dan View Composer global."
>
> **Raka:** "View Composer harus global agar $profil bisa diakses di semua view tanpa manual passing data — penting untuk halaman donasi dan invoice nantinya."

**Hari 9 — View Composer Global**
> **Raka:** "Migration dan model sudah selesai. Factory untuk ProfilYayasan dan Pendiri juga sudah siap."
>
> **Raka:** "Hari ini mendaftarkan ProfilYayasanComposer di AppServiceProvider — method boot() dengan View::composer('*', ...). Semua view sekarang punya akses $profil tanpa manual passing."
>
> **Raka:** "Tidak ada kendala. View Composer bekerja dengan baik — setiap render view, data profil otomatis tersedia."

**Hari 12 — Finalisasi Database**
> **Raka:** "View Composer global sudah terdaftar. Semua view bisa mengakses $profil->nama_yayasan, $profil->logo, dll."
>
> **Raka:** "Hari ini melakukan pengujian — memastikan factory berfungsi, model booted menghapus foto saat pendiri dihapus, dan View Composer menginjeksi data dengan benar."
>
> **Raka:** "Semua berfungsi. Siap memasuki Sprint 2."

#### 3. Sprint Review

**Demonstrasi:**
Menjalankan `php artisan migrate:fresh --seed` — tabel profil_yayasan dan pendiris terbuat. Factory mengisi satu record profil yayasan dan 5 pendiri. Membuka halaman welcome → data `$profil->nama_yayasan` tampil. Semua view memiliki akses ke `$profil`.

**Umpan Balik:**
> **Pengurus Yayasan:** "View Composer global sangat membantu — data profil otomatis muncul tanpa perlu passing manual di setiap controller."

**Tindakan:**
- Menambahkan seeder untuk data profil yayasan default
- Memastikan factory menghasilkan data yang realistis untuk pengujian

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- View Composer global efisien untuk data yang dipakai di semua halaman
- Booted deleted pada model Pendiri memastikan file foto tidak mengotori storage

**Hal yang perlu diperbaiki:**
- Belum ada validasi input di model level — validasi hanya di controller
- Factory profil yayasan perlu data yang lebih mendekati asli

---

## Sprint 2 (Hari 13–24): CRUD Campaign & CRUD Profil Pendiri

### Sub-sprint 2A — CRUD Campaign (Admin) [Hari 13–18]

**Sprint Goal:** Admin dapat membuat, mengubah, menampilkan, dan menghapus kampanye donasi.

#### 1. Sprint Planning
**PB-D02:** Sebagai Admin, saya ingin dapat mengelola kampanye donasi (tambah, edit, hapus, lihat detail) agar informasi program donasi selalu terkini.

**Tugas Teknis:**
- Membuat `CampaignController` (resource) dengan fungsi index, create, store, show, edit, update, destroy
- Mengimplementasikan upload gambar campaign via trait HandlesFileUpload ke folder `campaigns/`
- Membuat view admin index: tabel dengan gambar, title, target_amount, status badge, aksi
- Membuat view admin create: form title, description, target_amount, image upload
- Membuat view admin edit: form edit dengan preview image, hapus image lama saat diganti
- Membuat view admin show: detail card dengan progress bar collected vs target
- Slug auto-generate dari title menggunakan Str::slug
- Validasi store: title required + unique, description required, target_amount required numeric min:0, image required (jpeg/png/jpg/webp, max 2MB)
- Validasi update: title required + unique kecuali campaign saat ini, image nullable

#### 2. Daily Scrum

**Hari 13 — Controller dan Route**
> **Raka:** "Kemarin saya membuat CampaignController resource lengkap dengan 7 method. Route resource sudah terdaftar di prefix admin."
>
> **Raka:** "Hari ini membuat view index — tabel dengan avatar image, title, target, status badge (active=emerald, completed=slate), dan tombol aksi."
>
> **Raka:** "Tidak ada kendala. Data kampanye bisa diambil langsung dari database."

**Hari 15 — Form Create dan Image Upload**
> **Raka:** "View index selesai dengan tampilan tabel yang rapi dan pagination."
>
> **Raka:** "Hari ini membuat form create — title, description (textarea), target_amount (input number dengan format currency), image upload (file input dengan pratinjau). Image disimpan di storage/app/public/campaigns/."
>
> **Raka:** "Traits HandlesFileUpload membantu proses upload. Tinggal panggil uploadFile() selesai."

**Hari 17 — Edit, Show, dan Delete**
> **Raka:** "Form create sudah selesai. Validasi store berfungsi: title harus unik, target_amount minimal Rp1, image format jpeg/png/jpg/webp maksimal 2MB."
>
> **Raka:** "Hari ini membuat form edit (dengan preview image existing), view show (progress bar collected/target dengan persentase), dan logika hapus."
>
> **Raka:** "Saat edit, image lama otomatis terhapus di storage jika diganti. Saat hapus, image campaign ikut terhapus via booted model."

**Hari 18 — Pengujian CRUD**
> **Raka:** "Edit dan show selesai. Progress bar menampilkan collected_amount / target_amount dalam persen disertai teks nominal."
>
> **Raka:** "Hari ini pengujian menyeluruh CRUD: create dengan image, edit tanpa ganti image, edit ganti image, hapus, dan validasi error."
>
> **Raka:** "Semua skenario berjalan dengan baik. Tidak ada kendala."

#### 3. Sprint Review

**Demonstrasi:**
Admin membuka menu "Kelola Campaign". Menampilkan tabel daftar campaign dengan gambar thumbnail, judul, target, status. Klik "Tambah Baru" → form dengan input title, deskripsi, target, dan upload gambar. Setelah simpan, muncul di tabel. Klik "Detail" → card dengan progress bar Rp2.000.000 terkumpul dari Rp10.000.000 (20%). Klik "Edit" → form terisi data lama dengan preview gambar. Ganti gambar, simpan → gambar baru tampil. Klik "Hapus" → konfirmasi, data hilang dari tabel.

**Umpan Balik:**
> **Pengurus Yayasan:** "CRUD campaign sudah berfungsi. Progress bar membantu melihat pencapaian donasi. Mohon ditambahkan filter untuk melihat campaign aktif dan selesai secara terpisah."

**Tindakan:**
- Menambahkan tab filter "Aktif" / "Semua" / "Selesai" pada halaman index campaign admin
- Menambahkan indikator jumlah donasi pada halaman detail campaign

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- HandlesFileUpload trait mempermudah upload file di seluruh controller
- Progress bar pada detail campaign informatif
- Booted model memastikan file ikut terhapus saat data dihapus

**Hal yang perlu diperbaiki:**
- Filter status campaign pada halaman index belum tersedia — perlu ditambahkan
- Belum ada jumlah donasi per campaign — perlu eager loading count

### Sub-sprint 2B — CRUD Profil & Pendiri (Admin) [Hari 19–24]

**Sprint Goal:** Admin dapat mengelola profil yayasan dan data pengurus.

#### 1. Sprint Planning
**PB-P02:** Sebagai Admin, saya ingin dapat mengelola profil yayasan dan data pengurus (pendiri) melalui halaman admin — data ini akan muncul di footer, header invoice, dan halaman publik donasi.

**Tugas Teknis:**
- Membuat `ProfilYayasanController`: index (tab profil + pendiri), edit (form dedicated), update (validasi + upload file)
- Membuat `PendiriController`: index (daftar + tambah), store (validasi + upload foto), destroy (hapus + cleanup)
- View admin profil index: tab panel — Tab 1 (edit profil form), Tab 2 (daftar pendiri + tambah)
- View admin profil edit: form dedicated dengan semua field profil yayasan
- View admin pendiri index: form tambah di kiri, tabel daftar di kanan
- Upload file: logo (folder logo/), foto_legalitas, foto_struktur via trait HandlesFileUpload
- Validasi profil: nama_yayasan required, email required email, no_telp required, alamat required
- Validasi pendiri: nama required, jabatan required, foto required image max 2MB (jpg/png)

#### 2. Daily Scrum

**Hari 19 — Controller dan Route**
> **Raka:** "Kemarin saya membuat ProfilYayasanController dan PendiriController dengan method dasar. Route sudah terdaftar di prefix admin."
>
> **Raka:** "Hari ini membuat view admin profil index dengan tab panel — Tab 1 berisi form edit profil (nama_yayasan, logo, alamat, no_telp, email, sejarah, visi, misi, legalitas, foto_legalitas, foto_struktur). Tab 2 berisi daftar pendiri."
>
> **Raka:** "Tidak ada kendala. Data profil hanya satu record — diambil dengan ProfilYayasan::first()."

**Hari 21 — Form Edit Profil**
> **Raka:** "View index dengan tab panel menggunakan AlpineJS x-data sudah selesai. Tab 1: form profil dengan preview logo, upload foto legalitas dan struktur. Tab 2: daftar pendiri sebagai card."
>
> **Raka:** "Hari ini membuat logika update — validasi input, upload file via HandlesFileUpload trait, hapus file lama jika diganti."
>
> **Raka:** "Logo disimpan di folder logo/, foto_legalitas di legalitas/, foto_struktur di struktur/ — masing-masing folder terpisah di storage publik."

**Hari 23 — Manajemen Pendiri**
> **Raka:** "Update profil berfungsi. Semua field tersimpan dengan benar. File lama otomatis terhapus saat diganti."
>
> **Raka:** "Hari ini membuat PendiriController — store (validasi + upload foto ke folder pendiri/), destroy (hapus foto + record). View tambah pendiri dalam bentuk card dengan form dan daftar tabel."
>
> **Raka:** "Foto pendiri disimpan di storage/app/public/pendiri/. Saat record dihapus, foto ikut terhapus via booted deleted."

**Hari 24 — Pengujian CRUD**
> **Raka:** "CRUD pendiri selesai. Form tambah dengan upload foto, tabel daftar dengan avatar, tombol hapus dengan modal konfirmasi."
>
> **Raka:** "Hari ini melakukan pengujian: edit semua field profil, ganti logo, upload foto legalitas, tambah 3 pendiri, hapus pendiri."
>
> **Raka:** "Semua berfungsi. Siap untuk sprint publik."

#### 3. Sprint Review

**Demonstrasi:**
Admin membuka menu "Profil Yayasan". Tab 1: form edit dengan data profil terisi — ganti logo, edit sejarah, upload foto legalitas dan struktur organisasi. Tab 2: daftar pendiri (Ketua, Wakil, Sekretaris, dll) dengan foto. Klik "Tambah" → isi nama, jabatan, deskripsi, upload foto → tersimpan. Klik "Hapus" → konfirmasi → data hilang.

**Umpan Balik:**
> **Pengurus Yayasan:** "CRUD profil dan pendiri sudah bagus. Akan tetapi untuk pendiri, sebaiknya bisa diurutkan (urutan tampil) agar ketua berada di atas."

**Tindakan:**
- Menambahkan kolom `urutan` (integer, default 0) pada tabel pendiris
- Menambahkan input number pada form tambah pendiri
- Mengurutkan query pendiri berdasarkan kolom urutan

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Tab panel memudahkan admin mengakses profil dan pendiri dalam satu halaman
- Upload file dengan HandlesFileUpload trait bekerja dengan baik
- Booted deleted mencegah file sampah

**Hal yang perlu diperbaiki:**
- Urutan tampil pendiri belum bisa diatur — perlu field urutan
- Belum ada fitur edit pendiri — hanya tambah dan hapus

---

## Sprint 3 (Hari 25–36): Halaman Publik Profil & Halaman Depan Campaign

### Sub-sprint 3A — Halaman Publik Profil, Pengurus, Legalitas [Hari 25–30]

**Sprint Goal:** Publik dapat melihat profil yayasan, daftar pengurus, dan informasi legalitas — data ini mendukung halaman depan donasi dan invoice.

#### 1. Sprint Planning
**PB-P03:** Sebagai Pengunjung, saya ingin dapat melihat profil yayasan, daftar pengurus, dan dokumen legalitas yayasan.

**Tugas Teknis:**
- Membuat route `/profil` → view `profil.blade.php` — hero, sejarah, visi, misi, kontak
- Membuat route `/pengurus` → view `pengurus.blade.php` — grid pengurus dengan foto/avatar
- Membuat route `/legalitas` → view `legalitas.blade.php` — teks legalitas + foto legalitas + foto struktur dengan lightbox
- Menambahkan navigasi menu Footer dan Navbar ke halaman profil, pengurus, legalitas
- Menambahkan link cepat di dashboard donatur ke profil/pengurus/legalitas
- Menambahkan informasi yayasan di halaman depan (hero, footer)

#### 2. Daily Scrum

**Hari 25 — Halaman Profil**
> **Raka:** "Kemarin saya membuat route `/profil` yang merender view `profil.blade.php`. Data profil diambil dari `$profil` (View Composer global)."
>
> **Raka:** "Hari ini menata layout halaman profil: hero section dengan background gradient, logo yayasan besar, nama yayasan, alamat. Section sejarah — paragraf panjang. Section visi dan misi — dua kolom. Section kontak — no_telp dan email dengan ikon."
>
> **Raka:** "Data $profil sudah tersedia dari View Composer, jadi tidak perlu passing manual dari controller."

**Hari 27 — Halaman Pengurus**
> **Raka:** "Halaman profil selesai dengan desain yang rapi menggunakan card dan gradient."
>
> **Raka:** "Hari ini membuat halaman pengurus — route `/pengurus` menampilkan semua pendiri dalam grid card. Setiap card menampilkan avatar (inisial jika tidak ada foto), nama, jabatan, dan deskripsi (kata sambutan)."
>
> **Raka:** "Avatar inisial menggunakan komponen dengan background color berdasarkan hash nama — warna konsisten per orang."

**Hari 29 — Halaman Legalitas**
> **Raka:** "Halaman pengurus selesai dengan grid responsif (3 kolom desktop, 1 mobile). AOS animation untuk scroll effect."
>
> **Raka:** "Hari ini membuat halaman legalitas — route `/legalitas` menampilkan teks legalitas, foto legalitas (SK/Akta), dan foto struktur organisasi. Foto dapat diklik untuk lightbox menggunakan AlpineJS."
>
> **Raka:** "Lightbox menggunakan x-show dengan overlay gelap. Saat foto diklik, muncul modal besar dengan tombol close."

**Hari 30 — Navigasi dan Dashboard**
> **Raka:** "Legalitas lightbox selesai. Foto diperbesar hingga 90% viewport height dengan scroll jika diperlukan."
>
> **Raka:** "Hari ini menambahkan navigasi — link ke /profil, /pengurus, /legalitas di navbar, footer, dan dashboard donatur. Juga memastikan informasi yayasan (nama, alamat, kontak) tampil di footer semua halaman."
>
> **Raka:** "Semua link menggunakan route name yang sudah ada. Footer menggunakan komponen terpisah."

#### 3. Sprint Review

**Demonstrasi:**
Pengunjung membuka `/profil` — hero gradient dengan logo dan nama yayasan, section sejarah (paragraf), visi & misi (dua kolom), kontak (no_telp, email). Buka `/pengurus` — grid 3 kolom: foto/avatar inisial, nama "Ahmad Fauzi", jabatan "Ketua Yayasan", deskripsi kata sambutan. Buka `/legalitas` — teks legalitas, foto SK/Akta (klik → lightbox), foto struktur organisasi (klik → lightbox). Footer menampilkan nama, alamat, kontak yayasan.

**Umpan Balik:**
> **Pengurus Yayasan:** "Halaman profil, pengurus, dan legalitas sudah informatif. Lightbox legalitas membantu melihat dokumen dengan jelas."

**Tindakan:**
- Menambahkan AOS (Animate On Scroll) untuk animasi scroll pada section profil
- Menambahkan transisi halaman yang lebih halus

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- View Composer global membuat data profil selalu tersedia
- Lightbox legalitas dengan AlpineJS ringan tanpa library tambahan
- Avatar inisial dengan warna hash konsisten

**Hal yang perlu diperbaiki:**
- Animasi transisi halaman belum ada — perlu ditambahkan
- Halaman profil belum memiliki breadcrumb navigasi

### Sub-sprint 3B — Halaman Depan & Publikasi Campaign [Hari 31–36]

**Sprint Goal:** Calon donatur dapat melihat daftar campaign di halaman depan dan halaman publik — data profil yayasan sudah tersedia dari View Composer.

#### 1. Sprint Planning
**PB-D03:** Sebagai Calon Donatur, saya ingin dapat melihat daftar kampanye donasi yang tersedia agar saya dapat memilih program yang ingin saya dukung.

**Tugas Teknis:**
- Menampilkan campaign aktif di halaman depan (`/`) — card dengan image, title, description (truncated), progress bar, tombol "Donasi Sekarang"
- Menampilkan statistik: total campaign, total donasi sukses, total transaksi
- Membuat section kampanye di halaman depan dengan anchor #kampanye
- Memastikan hanya campaign dengan status 'active' yang tampil di publik
- Menambahkan link ke halaman depan dari berbagai tempat navigasi
- Button "Donasi Sekarang" mengarah ke route donations.create
- Data profil yayasan ($profil) sudah otomatis tersedia untuk hero, footer, dan header

#### 2. Daily Scrum

**Hari 31 — Halaman Depan dengan Campaign**
> **Raka:** "Kemarin saya memodifikasi halaman depan — menampilkan semua campaign aktif dalam bentuk card grid (3 kolom desktop, 1 kolom mobile)."
>
> **Raka:** "Hari ini menata ulang layout card: gambar cover di atas, title, deskripsi singkat (max 100 karakter), progress bar, nominal collected/target, dan tombol donasi."
>
> **Raka:** "Tantangan: progress bar harus akurat — collected_amount dibagi target_amount dikali 100. Jika belum ada donasi, progress bar 0%."

**Hari 33 — Statistik Halaman Depan**
> **Raka:** "Layout card campaign sudah rapi dengan hover effect. Progress bar menggunakan DaisyUI dengan warna emerald gradient."
>
> **Raka:** "Hari ini menambahkan hero section statistik: total campaign, total donasi (formatted Rupiah), total transaksi. Data diambil dari database via route `/`."
>
> **Raka:** "Nominal donasi diformat dengan number_format agar mudah dibaca."

**Hari 35 — Navigasi dan Anchor**
> **Raka:** "Statistik hero sudah tampil dengan ikon yang menarik. Juga data profil yayasan ($profil->nama_yayasan) sudah tampil di hero dan footer."
>
> **Raka:** "Hari ini menambahkan navigasi — link ke #kampanye di hero section, menu navbar 'Program Donasi' mengarah ke section campaign, dan tombol 'Donasi Sekarang' di setiap card."
>
> **Raka:** "Tidak ada kendala. Tinggal pengujian responsif."

**Hari 36 — Pengujian Responsif**
> **Raka:** "Navigasi dan anchor sudah berfungsi. Tombol 'Donasi Sekarang' mengarah ke route donations.create dengan parameter campaign."
>
> **Raka:** "Hari ini melakukan pengujian — tampilan desktop (3 kolom), tablet (2 kolom), mobile (1 kolom), statistik di hero. Juga memastikan campaign status 'completed' tidak muncul."
>
> **Raka:** "Semua berfungsi. Siap untuk Sprint 4."

#### 3. Sprint Review

**Demonstrasi:**
Pengguna membuka halaman utama yayasan. Hero section menampilkan logo & nama yayasan, sambutan, dan 3 statistik: 5 Program Donasi, Rp150.000.000 Total Donasi, 320 Transaksi. Scroll ke bawah, tampil grid campaign: card dengan foto program, judul, deskripsi singkat, progress bar (75%), nominal terkumpul Rp7.500.000 dari Rp10.000.000, dan tombol "Donasi Sekarang". Footer menampilkan alamat dan kontak yayasan. Tampilan responsif: 3 kolom di desktop, 2 di tablet, 1 di mobile.

**Umpan Balik:**
> **Pengurus Yayasan:** "Halaman depan sudah informatif. Akan tetapi campaign yang sudah mencapai target sebaiknya tetap ditampilkan dengan label 'Tercapai' agar donatur tahu program sukses."

**Tindakan:**
- Menambahkan badge "Tercapai" pada campaign dengan collected_amount >= target_amount
- Tidak menyembunyikan campaign completed — tetap tampil dengan label

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Layout card campaign rapi dengan DaisyUI
- Statistik di hero memberikan gambaran cepat
- Responsif di berbagai ukuran layar

**Hal yang perlu diperbaiki:**
- Campaign yang sudah mencapai target perlu label khusus, tidak disembunyikan
- Belum ada loading skeleton saat data campaign sedang dimuat

---

## Sprint 4 (Hari 37–50): CRUD Berita Kegiatan (Admin)
**Sprint Goal:** Admin dapat membuat, mengedit, dan menghapus berita kegiatan — berita akan tampil di halaman depan dan dashboard donatur.

### 1. Sprint Planning
**PB-B01:** Sebagai Admin, saya ingin dapat mengelola berita kegiatan (tambah, edit, hapus, publish/draft) agar publik mengetahui aktivitas yayasan.

**Tugas Teknis:**
- Migration tabel `news`: id, judul, slug (unique), kategori (default 'Kegiatan Umum'), tanggal_kegiatan, lokasi (nullable), penyelenggara (nullable), ringkasan (nullable text), konten (longText), foto_utama (nullable string), status (default 'draft'), timestamps
- Membuat model `News` — fillable, casts (tanggal_kegiatan => date), booted deleted (hapus foto), scope published(), generateSlug()
- Membuat `NewsController` resource: index, create, store, show, edit, update, destroy
- View admin index: card summary (total, published, draft) + tabel daftar berita
- View admin form: judul, kategori (dropdown 8 pilihan), tanggal, lokasi, penyelenggara, ringkasan, konten (textarea besar), foto_utama upload, status (draft/published radio)
- Slug auto-generate dari judul dengan penanganan duplikat
- Upload foto_utama ke folder news/ via HandlesFileUpload trait

### 2. Daily Scrum

**Hari 37 — Migration dan Model**
> **Raka:** "Kemarin saya membuat migration tabel news dengan kolom lengkap — judul, slug (unique), kategori, tanggal_kegiatan, lokasi, penyelenggara, ringkasan, konten, foto_utama, status."
>
> **Raka:** "Hari ini membuat model News dengan fillable, cast tanggal_kegiatan ke date, scope published(), method generateSlug(), dan booted deleted untuk cleanup foto."
>
> **Raka:** "Booted deleted penting — saat berita dihapus, foto_utama ikut terhapus dari storage agar tidak menumpuk."

**Hari 40 — Controller dan View Index**
> **Raka:** "Model News selesai dengan auto-slug dan published scope. Factory juga sudah siap."
>
> **Raka:** "Hari ini membuat NewsController resource dan view index — card summary di atas (total berita, published, draft) dan tabel daftar dengan kolom: foto thumbnail, judul, kategori, tanggal, status badge (draft=warning, published=success), aksi."
>
> **Raka:** "Tabel menggunakan pagination 10 per halaman."

**Hari 44 — Form Create dan Edit**
> **Raka:** "View index selesai dengan summary card dan tabel yang rapi."
>
> **Raka:** "Hari ini membuat form create/edit — menggunakan satu file form.blade.php yang di-include oleh create.blade.php dan edit.blade.php. Field: judul, kategori (dropdown: Kegiatan Umum, Santunan, Pendidikan, Kesehatan, Ramadan, Hari Besar, Kunjungan, Lainnya), tanggal_kegiatan (date picker), lokasi, penyelenggara, ringkasan (textarea, max 500 chars), konten (longText), foto_utama (file input dengan preview), status (radio draft/published)."
>
> **Raka:** "Form create dan edit hampir identik — bedanya edit memiliki preview foto existing dan method PUT."

**Hari 48 — Pengujian CRUD**
> **Raka:** "Form create sudah selesai — validasi: judul required, kategori required, tanggal_kegiatan required date, foto_utama required image max 3MB (jpg/png/webp), status required. Slug auto-generate dengan penanganan duplikat."
>
> **Raka:** "Hari ini melakukan pengujian CRUD: create dengan foto + publish, edit judul (slug berubah), edit ganti foto, draft -> published, hapus (foto ikut terhapus)."
>
> **Raka:** "Semua berfungsi. Siap untuk sprint publik."

### 3. Sprint Review

**Demonstrasi:**
Admin membuka menu "Berita Kegiatan". Melihat summary: 15 Total, 10 Published, 5 Draft. Tabel menampilkan judul, kategori, tanggal, status badge. Klik "Tambah Baru" → isi judul "Santunan Anak Yatim 2026", pilih kategori "Santunan", tanggal 15 Mar 2026, lokasi "Gedung Yayasan", ringkasan, konten, upload foto, status "Published". Simpan → muncul di tabel. Klik "Edit" → ganti judul dan foto. Klik "Hapus" → konfirmasi → data hilang + foto terhapus.

**Umpan Balik:**
> **Pengurus Yayasan:** "CRUD berita sudah lengkap. Kategorinya sudah mencakup semua jenis kegiatan. Ringkasan membantu pengunjung melihat gambaran cepat sebelum membaca detail."

**Tindakan:**
- Menambahkan validasi karakter maksimal ringkasan (500 karakter)
- Menambahkan preview foto_utama pada form create (pratinjau sebelum upload)

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Form create dan edit menggunakan satu file include — DRY principle
- Summary card memberikan gambaran jumlah berita
- Slug auto-generate dengan penanganan duplikat

**Hal yang perlu diperbaiki:**
- Preview foto sebelum upload belum ada di form create
- Belum ada fitur search pada tabel index berita

---

## Sprint 5 (Hari 51–62): Form Donasi & Upload Bukti Transfer
**Sprint Goal:** Donatur dapat mengisi formulir donasi, melihat info rekening tujuan (dari data profil yayasan), dan mengunggah bukti transfer.

### 1. Sprint Planning
**PB-D04:** Sebagai Calon Donatur, saya ingin dapat mengisi formulir donasi dan mengunggah bukti transfer agar donasi saya dapat diproses oleh yayasan.

**Tugas Teknis:**
- Membuat route GET `/campaign/{campaign}/donate` → form donasi
- Membuat route POST `/campaign/{campaign}/donate` → proses simpan donasi
- Form donasi: nama, email, no WhatsApp, nominal (pilihan Rp10k/20k/50k/100k + input manual), info rekening tujuan (BSI 7122-8023-98 a.n. Baitul Yatim Sukabumi), upload bukti transfer (JPG/PNG, max 2MB), tanggal transfer
- Validasi: donor_name required, donor_email required email, donor_phone required, amount required numeric min 1000, payment_proof required image, transfer_date required date
- Generate order_id 'DONASI-{uniqid}', simpan status 'pending'
- Payment_method otomatis 'Transfer Bank'
- Redirect ke dashboard dengan flash success
- Data profil yayasan ($profil) dari View Composer digunakan untuk menampilkan nama dan kontak yayasan di form

### 2. Daily Scrum

**Hari 51 — Form Donasi**
> **Raka:** "Kemarin saya membuat route dan view form donasi. Form terdiri dari: nama, email, no WhatsApp, nominal (dengan pilihan cepat 10k/20k/50k/100k + input manual), info rekening BSI, upload bukti transfer, dan tanggal transfer."
>
> **Raka:** "Hari ini memasang validasi dan logika penyimpanan — generate order_id, simpan ke tabel donations dengan status pending, payment_method otomatis 'Transfer Bank'."
>
> **Raka:** "Nominal pilihan cepat menggunakan JavaScript — saat diklik, mengisi input amount dan memberikan efek highlight."

**Hari 54 — Info Rekening Tujuan**
> **Raka:** "Validasi dan penyimpanan sudah selesai. File bukti transfer disimpan di storage/app/public/payment-proofs/."
>
> **Raka:** "Hari ini menambahkan info rekening tujuan di atas form upload — Bank BSI, No. Rekening 7122-8023-98, a.n. Baitul Yatim Sukabumi, ditampilkan dalam card dengan desain yang menonjol."
>
> **Raka:** "Tidak ada kendala. Hanya memastikan bahwa nomor rekening dan nama sesuai dengan data yayasan."

**Hari 57 — Pilihan Nominal Cepat**
> **Raka:** "Info rekening tampil dalam card terpisah dengan border emerald dan ikon bank. Donatur dapat melihat rekening tujuan sebelum upload bukti."
>
> **Raka:** "Hari ini menyempurnakan pilihan nominal cepat — tombol Rp10.000, Rp20.000, Rp50.000, Rp100.000 dengan efek toggle. Jika user mengklik salah satu, input amount terisi dan tombol aktif. Jika user mengetik manual, tombol reset."
>
> **Raka:** "JavaScript toggle memerlukan penanganan yang hati-hati agar tidak bentrok dengan input manual."

**Hari 60 — Pengujian Form**
> **Raka:** "Pilihan nominal cepat sudah selesai dengan JavaScript murni (tanpa library)."
>
> **Raka:** "Hari ini melakukan pengujian — semua validasi: nama kosong, email tidak valid, nominal kurang dari Rp1.000, file bukan gambar, file lebih dari 2MB, tanggal transfer tidak diisi."
>
> **Raka:** "Semua validasi berfungsi. Error ditampilkan menggunakan komponen alert."

### 3. Sprint Review

**Demonstrasi:**
Donatur membuka halaman campaign, klik "Donasi Sekarang". Form donasi muncul dengan header nama & logo yayasan: isi nama, email, WhatsApp. Pilih nominal Rp50.000 dari tombol cepat (atau ketik manual). Lihat informasi rekening BSI 7122-8023-98 a.n. Baitul Yatim Sukabumi. Upload foto bukti transfer. Isi tanggal transfer. Klik "Kirim Donasi". Redirect ke dashboard dengan pesan "Bukti transfer berhasil diupload! Donasi Anda sedang menunggu konfirmasi admin."

**Umpan Balik:**
> **Pengurus Yayasan:** "Form donasi sudah lengkap dan mudah diisi. Informasi rekening tujuan sangat membantu. Mohon ditambahkan konfirmasi ulang sebelum submit agar donatur tidak salah."

**Tindakan:**
- Menambahkan modal/alert konfirmasi sebelum form dikirim — menampilkan ringkasan: nominal, tanggal transfer
- Menambahkan preview gambar bukti transfer sebelum upload

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Pilihan nominal cepat mempercepat input donatur
- Info rekening tujuan tampil jelas dengan desain menonjol
- Validasi komprehensif mencakup semua field

**Hal yang perlu diperbaiki:**
- Belum ada konfirmasi ulang sebelum submit — perlu modal ringkasan
- Preview gambar bukti transfer belum ada — donatur tidak bisa melihat pratinjau file yang dipilih

---

## Sprint 6 (Hari 63–74): Halaman Berita Publik & Integrasi

### Sub-sprint 6A — Halaman Berita Publik & Integrasi [Hari 63–74]

**Sprint Goal:** Publik dapat melihat berita kegiatan di halaman depan, halaman detail, dan dashboard donatur.

#### 1. Sprint Planning
**PB-B02:** Sebagai Pengunjung, saya ingin dapat melihat berita dan kegiatan yayasan di halaman depan dan halaman detail berita.

**Tugas Teknis:**
- Membuat route `/berita/{slug}` → menampilkan detail berita publik
- View detail berita: breadcrumb, hero image, judul, meta (kategori, tanggal, lokasi, penyelenggara), ringkasan, konten, sidebar info, CTA donasi
- Menambahkan carousel berita di halaman depan (welcome.blade.php) — published, latest 9, auto-slide 4.5s
- Menambahkan grid berita di dashboard donatur — published, latest 6
- Scope published() untuk memfilter hanya berita dengan status 'published'
- Menambahkan link navigasi "Berita" di navbar dan footer

#### 2. Daily Scrum

**Hari 63 — Route Detail Berita**
> **Raka:** "Kemarin saya membuat route `/berita/{slug}` dengan closure di web.php. Query: News::where('slug',$slug)->published()->firstOrFail()."
>
> **Raka:** "Hari ini membuat view detail berita — layout: breadcrumb (Berita > {kategori} > {judul}), hero image full width, judul besar, meta info (kategori badge, tanggal, lokasi, penyelenggara), ringkasan (styling blockquote), konten, sidebar (info card + CTA donasi)."
>
> **Raka:** "Jika berita tidak ditemukan atau status draft, tampilkan 404."

**Hari 66 — Carousel Halaman Depan**
> **Raka:** "Detail berita selesai — layout dua kolom (konten utama + sidebar). Sidebar berisi info card (kategori, tanggal, lokasi, penyelenggara) dan CTA donasi."
>
> **Raka:** "Hari ini menambahkan carousel berita di halaman depan — section 'Berita & Kegiatan' menampilkan 9 berita terbaru dalam slider. Auto-slide setiap 4.5 detik dengan tombol navigasi prev/next."
>
> **Raka:** "Carousel menggunakan AlpineJS — x-data dengan interval timer, x-show untuk slide aktif, dan tombol navigasi."

**Hari 70 — Grid Dashboard Donatur**
> **Raka:** "Carousel halaman depan selesai — setiap slide menampilkan 3 card berita (grid), auto-rotasi, dan dapat dinavigasi manual."
>
> **Raka:** "Hari ini menambahkan grid berita di dashboard donatur — section 'Berita & Kegiatan' menampilkan 6 berita terbaru dalam grid 3 kolom. Setiap card: foto thumbnail, judul, ringkasan singkat, tanggal, tombol 'Baca Selengkapnya'."
>
> **Raka:** "Data diambil dari DonorController — $newsList = News::published()->latest()->take(6)->get()."

**Hari 73 — Navigasi dan Link**
> **Raka:** "Grid dashboard donatur selesai. Link 'Baca Selengkapnya' mengarah ke route news.show."
>
> **Raka:** "Hari ini menambahkan navigasi — menu 'Berita' di navbar (mengarah ke section #berita di halaman depan) dan footer (mengarah ke halaman depan section berita). Juga menambahkan routing untuk halaman berita index publik."
>
> **Raka:** "Tidak ada kendala. Semua link navigasi sudah terintegrasi."

**Hari 74 — Pengujian Akhir**
> **Raka:** "Navigasi berita sudah terintegrasi di navbar, footer, dashboard, dan halaman depan."
>
> **Raka:** "Hari ini melakukan pengujian: create berita published → muncul di carousel halaman depan dan grid dashboard → klik 'Baca Selengkapnya' → detail berita lengkap. Create berita draft → tidak muncul di publik. Edit status draft→published → muncul."
>
> **Raka:** "Semua berfungsi. Modul Berita Kegiatan siap."

#### 3. Sprint Review

**Demonstrasi:**
Admin membuat berita "Kegiatan Belajar Mengajar TPQ" dengan status Published. Buka halaman depan → carousel Berita & Kegiatan menampilkan berita baru (auto-slide). Klik "Baca Selengkapnya" → halaman detail dengan breadcrumb, hero image, judul, meta (kategori Pendidikan, tgl 10 Mar 2026, Masjid Al-Falah), ringkasan, konten lengkap. Sidebar menampilkan info dan CTA "Donasi Sekarang". Buka dashboard donatur → grid berita menampilkan 6 berita terbaru.

**Umpan Balik:**
> **Pengurus Yayasan:** "Berita tampil dengan baik di halaman depan. Carouselnya menarik. Akan tetapi mohon ditambahkan halaman arsip berita (daftar semua berita) agar publik dapat melihat berita lama."

**Tindakan:**
- Menambahkan route `/berita` (index) — daftar semua berita published dengan pagination
- Menambahkan link "Lihat Semua Berita" di carousel halaman depan dan grid dashboard

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Carousel dengan AlpineJS ringan tanpa library eksternal
- Grid dashboard donatur memberikan informasi kegiatan terkini
- Detail berita dengan sidebar informatif

**Hal yang perlu diperbaiki:**
- Halaman arsip berita (index) belum ada — perlu route `/berita`
- Belum ada fitur search berita berdasarkan judul atau kategori

---

## Sprint 7 (Hari 75–84): Validasi Pembayaran & Invoice

### Sub-sprint 7A — Validasi Pembayaran & Notifikasi WhatsApp [Hari 75–80]

**Sprint Goal:** Admin dapat memvalidasi bukti transfer donasi; donatur mendapat notifikasi WhatsApp saat dikonfirmasi.

#### 1. Sprint Planning
**PB-D05:** Sebagai Admin, saya ingin dapat melihat daftar donasi yang menunggu konfirmasi dan menyetujui atau menolaknya.
**PB-D06 (Notifikasi):** Donatur menerima notifikasi WhatsApp saat donasinya berhasil dikonfirmasi.

**Tugas Teknis:**
- Membuat halaman admin Riwayat Transaksi: tabel donasi + sponsorship dengan tab, filter status
- Menampilkan bukti transfer sebagai link "Lihat Bukti" yang membuka di tab baru
- Tombol "Konfirmasi" untuk donasi pending — update status jadi success, increment collected_amount campaign
- Tombol "Hapus" untuk menghapus transaksi (dengan konfirmasi modal)
- Notifikasi WhatsApp via Fonnte: "Donasi Anda sebesar RpX untuk {campaign} telah dikonfirmasi. Terima kasih!"
- Membuat FonnteService untuk integrasi API WhatsApp
- Menampilkan statistik di header: total donasi, total sponsorship, total sukses, total tertunda

#### 2. Daily Scrum

**Hari 75 — Halaman Riwayat Transaksi Admin**
> **Raka:** "Kemarin saya membuat route dan controller TransactionController dengan method index. Halaman menampilkan dua tabel dalam tab: Donasi Kampanye dan Sponsorship."
>
> **Raka:** "Hari ini menambahkan statistik header: 4 card (total donasi, total sponsorship, total sukses, total tertunda) dengan ikon dan warna berbeda."
>
> **Raka:** "Data donasi diambil dengan pagination 10 per halaman. Sponsorship juga 10 per halaman dengan parameter page terpisah."

**Hari 77 — Bukti Transfer dan Tombol Aksi**
> **Raka:** "Statistik header sudah selesai. Juga menambahkan tab navigasi dengan jumlah badge."
>
> **Raka:** "Hari ini mengganti kolom 'Metode' menjadi 'Bukti' — menampilkan link 'Lihat Bukti' yang membuka gambar bukti transfer di tab baru. Juga tombol 'Konfirmasi' (hanya untuk status pending) dan 'Hapus' (dengan modal konfirmasi)."
>
> **Raka:** "Tombol Konfirmasi menggunakan route PATCH admin.transactions.approve dengan order_id."

**Hari 78 — Logika Approve**
> **Raka:** "Link bukti transfer dan tombol aksi sudah berfungsi. Modal konfirmasi hapus menggunakan komponen Blade."
>
> **Raka:** "Hari ini membuat logika approve: update status jadi success, increment collected_amount campaign (Donation::where status pending di-update, campaign terkait di-increment). Juga mengirim notifikasi WhatsApp via Fonnte."
>
> **Raka:** "Notifikasi WA menggunakan template: '✅ Donasi Berhasil Dikonfirmasi! Campaign: {judul}, Nominal: Rp{nominal}, Terima kasih!'"

**Hari 79 — Notifikasi WA**
> **Raka:** "Logika approve selesai. WA terkirim menggunakan FonnteService dengan token dari .env."
>
> **Raka:** "Hari ini menguji kirim WA — nomor tujuan dinormalisasi ke format 62xxx. Juga menambahkan penanganan error jika pengiriman gagal (di-catch dan di-log)."
>
> **Raka:** "Terdapat kendala: nomor WhatsApp harus sudah terdaftar di kontak Fonnte. Solusi: memastikan donatur menggunakan nomor aktif WhatsApp."

**Hari 80 — Pengujian Approve/Reject**
> **Raka:** "Pengiriman WA berhasil diuji ke nomor pengurus yayasan. Template WA sudah sesuai."
>
> **Raka:** "Hari ini melakukan pengujian: donasi pending dikonfirmasi → status success → campaign amount terakumulasi → WA terkirim. Juga skenario hapus transaksi."
>
> **Raka:** "Semua berfungsi. WA notifikasi juga berfungsi untuk sponsorship — alur approve-nya sama dengan donasi."

#### 3. Sprint Review

**Demonstrasi:**
Admin membuka menu "Riwayat Transaksi". Melihat 4 card statistik: 50 Total Donasi, 10 Sponsorship, 45 Sukses, 15 Tertunda. Tab "Donasi Kampanye" aktif — tabel menampilkan donatur, campaign, nominal, kode donasi, link bukti (klik → buka gambar), status badge, tanggal. Klik "Konfirmasi" pada donasi pending → status berubah jadi Sukses, collected_amount campaign bertambah. Donatur menerima WhatsApp: "✅ Donasi Berhasil Dikonfirmasi! Campaign: ${judul}, Nominal: Rp50.000, Terima kasih!"

**Umpan Balik:**
> **Pengurus Yayasan:** "Validasi pembayaran dan notifikasi sudah berfungsi dengan baik. Mohon ditambahkan tombol Sync All untuk menyinkronkan status dari Midtrans lama."

**Tindakan:**
- Menambahkan tombol "Sync All" yang mengecek status transaksi Midtrans (untuk data lama yang masih menggunakan snap_token)
- Menambahkan indikator loading saat tombol Konfirmasi diklik agar tidak double-click

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Tab navigasi dengan badge jumlah memudahkan admin beralih antara donasi dan sponsorship
- Link bukti transfer memudahkan verifikasi tanpa membuka menu lain
- Notifikasi WhatsApp memberikan kepastian kepada donatur

**Hal yang perlu diperbaiki:**
- Belum ada loading state pada tombol Konfirmasi — risiko double-click
- Sync Midtrans hanya untuk data lama — perlu dokumentasi bahwa Midtrans sudah non-aktif

### Sub-sprint 7B — Invoice & Riwayat Donasi (User) [Hari 81–84]

**Sprint Goal:** Donatur dapat melihat invoice donasi yang sudah dikonfirmasi dan riwayat donasi pribadi — invoice menggunakan logo dan nama dari profil yayasan.

#### 1. Sprint Planning
**PB-D07:** Sebagai Donatur, saya ingin dapat melihat invoice donasi yang sudah dikonfirmasi sebagai bukti pembayaran resmi.
**PB-D08:** Sebagai Donatur, saya ingin dapat melihat riwayat seluruh donasi yang pernah saya lakukan.

**Tugas Teknis:**
- Membuat InvoiceController: donation($id) — tampilkan invoice HTML, donationPdf($id) — download PDF via DomPDF
- Invoice hanya dapat diakses jika status 'success' dan kepemilikan sesuai (user_id) atau admin
- Halaman invoice: header logo yayasan (dari $profil->logo), invoice kepada (nama, email, WA), detail invoice (order_id, tanggal, status LUNAS), tabel deskripsi (nama campaign, nominal), total, footer
- Download PDF dengan layout yang sama menggunakan DomPDF
- Dashboard donatur: menampilkan riwayat donasi (campaign, nominal, status, tanggal)
- Halaman rekap donatur (/dashboard/rekap): tabel donasi + sponsorship dengan filter status
- Tombol "Lihat Invoice" pada setiap baris donasi success di riwayat

#### 2. Daily Scrum

**Hari 81 — Invoice HTML**
> **Raka:** "Kemarin saya membuat InvoiceController dengan method donation() — menampilkan halaman invoice dengan data donasi dan campaign."
>
> **Raka:** "Hari ini merancang layout invoice: header logo yayasan + nama (dari $profil), informasi donatur, detail invoice (order_id, tanggal, status badge), tabel (deskripsi campaign + nominal), total, footer ucapan terima kasih."
>
> **Raka:** "Cek kepemilikan: user_id donasi harus sama dengan Auth::id(), kecuali admin. Jika status bukan success, return 404."

**Hari 82 — Invoice PDF**
> **Raka:** "Invoice HTML sudah selesai dengan layout profesional. Menggunakan DaisyUI card dengan warna emerald tema yayasan."
>
> **Raka:** "Hari ini membuat invoice PDF menggunakan DomPDF — layout sama persis dengan HTML (header, body, footer). Juga menambahkan tombol Download PDF dan Kembali di halaman invoice HTML."
>
> **Raka:** "Profil yayasan diambil dari View Composer $profil untuk logo dan nama. Jika tidak ada, gunakan default 'Baitul Yatim'."

**Hari 83 — Dashboard Riwayat Donasi**
> **Raka:** "Invoice PDF sudah berhasil — download dengan nama file 'invoice-donasi-{order_id}.pdf'."
>
> **Raka:** "Hari ini menambahkan riwayat donasi di dashboard donatur — tabel menampilkan: campaign, nominal, payment_method, status badge, tanggal. Tombol 'Lihat Invoice' muncul hanya untuk status success."
>
> **Raka:** "Data donasi sudah difilter berdasarkan user_id yang login."

**Hari 84 — Halaman Rekap Donatur**
> **Raka:** "Riwayat donasi di dashboard selesai. Invoice link mengarah ke route invoice.donation."
>
> **Raka:** "Hari ini membuat halaman rekap donatur (/dashboard/rekap) — dua tab: Donasi dan Sponsorship, masing-masing dengan tabel + filter status (Semua/Berhasil/Menunggu/Gagal)."
>
> **Raka:** "Filter menggunakan AlpineJS x-data dengan tab pill. Data difilter secara client-side dari koleksi yang sudah ada."

#### 3. Sprint Review

**Demonstrasi:**
Donatur membuka dashboard → melihat riwayat donasi: "Donasi untuk Bangun Mushola" Rp500.000 Sukses 15 Mar 2026 [Invoice]. Klik Invoice → halaman invoice dengan header logo yayasan, invoice kepada (nama donatur), detail (ORDER-ID, tgl, LUNAS), tabel (deskripsi + nominal), total, footer. Klik Download PDF → file terunduh. Buka /dashboard/rekap → tab Donasi menampilkan semua donasi dengan filter Berhasil/Menunggu/Gagal.

**Umpan Balik:**
> **Pengurus Yayasan:** "Invoice sudah sesuai untuk bukti resmi. Mohon ditambahkan nomor invoice yang berurutan, tidak hanya order_id."

**Tindakan:**
- Menambahkan kolom invoice_number pada tabel donations — format INV-DN-{tahun}{bulan}-{nomor urut}
- Menampilkan invoice_number pada halaman invoice

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Invoice layout profesional dengan logo yayasan dari $profil
- PDF download berfungsi dengan DomPDF
- Filter status pada rekap donatur memudahkan pencarian

**Hal yang perlu diperbaiki:**
- Invoice_number belum ada — butuh migration tambahan
- Belum ada pagination pada riwayat donasi di dashboard (jika donasi sudah banyak)

---

## Sprint 8 (Hari 85–92): Rekap, Export, UAT & Serah Terima

### Sub-sprint 8A — Rekap & Export Data (Admin) [Hari 85–88]

**Sprint Goal:** Admin dapat melihat rekap donasi dan donatur, serta mengexport data ke CSV/PDF — kop surat menggunakan data profil yayasan.

#### 1. Sprint Planning
**PB-D09:** Sebagai Admin, saya ingin dapat melihat rekap donasi, data donatur, dan mengexportnya untuk kebutuhan pelaporan.

**Tugas Teknis:**
- Membuat `RekapController` dengan method donasi, donatur, orangTuaAsuh
- Halaman rekap donasi: tabel dengan filter tanggal (start/end), status, campaign, pagination
- Export CSV donasi: semua kolom (tanggal, donatur, campaign, nominal, status, metode)
- Export PDF donasi: layout raport dengan kop yayasan (logo, nama, alamat dari $profil)
- Halaman rekap donatur: tabel donatur dengan filter, export CSV/PDF
- Dashboard admin: statistik total donasi, campaign aktif, donasi terbaru, chart cashflow bulanan

#### 2. Daily Scrum

**Hari 85 — RekapController**
> **Raka:** "Kemarin saya membuat RekapController dengan method donasi() — menampilkan tabel donasi dengan filter status, campaign_id, dan rentang tanggal."
>
> **Raka:** "Hari ini membuat view rekap donasi dengan filter form (GET) — dropdown campaign, select status, date range start/end, tombol filter dan reset."
>
> **Raka:** "Filter menggunakan query scope — if($request->status) $query->where('status', ...), if($request->campaign_id) $query->where('campaign_id', ...)."

**Hari 86 — Export CSV**
> **Raka:** "View rekap donasi dengan filter sudah selesai. Tabel menampilkan: tanggal, donatur, email, campaign, nominal, metode, status. Total nominal di footer."
>
> **Raka:** "Hari ini membuat export CSV — method donasiExport() mengembalikan response stream dengan header Content-Type text/csv. Kolom: Tanggal, Order ID, Donatur, Email, Campaign, Nominal, Metode, Status."
>
> **Raka:** "CSV menggunakan fputcsv langsung dari PHP tanpa library tambahan."

**Hari 87 — Export PDF**
> **Raka:** "Export CSV berfungsi — file terdownload dengan nama 'rekap-donasi-{date}.csv'."
>
> **Raka:** "Hari ini membuat export PDF — view rekap donasi_pdf dengan desain kop surat yayasan (logo dari $profil->logo, nama, alamat), tabel rekap, tanda tangan. Menggunakan DomPDF."
>
> **Raka:** "PDF di-render dengan orientation landscape agar kolom muat. Font menggunakan Google Sans."

**Hari 88 — Dashboard Admin & Final**
> **Raka:** "Export PDF berhasil dengan layout landscape. Tanda tangan untuk pengesahan kosong siap diisi manual."
>
> **Raka:** "Hari ini membuat dashboard admin: 4 card statistik (total dana terkumpul, campaign aktif, total donasi, total donatur), tabel donasi terbaru, dan chart cashflow (bulanan menggunakan canvas.js)."
>
> **Raka:** "Chart cashflow mengambil data dari donasi per bulan — sum amount where status success, group by month."

#### 3. Sprint Review

**Demonstrasi:**
Admin membuka "Rekap Donasi" — filter: status Berhasil, campaign "Bangun Mushola", Jan-Mar 2026. Tabel menampilkan 15 donasi. Klik Export CSV → file rekap-donasi-2026-03-15.csv terdownload. Klik Export PDF → PDF landscape dengan kop yayasan, tabel, dan kolom tanda tangan. Buka dashboard admin: total dana Rp250jt, 5 campaign aktif, 320 donasi, 150 donatur, tabel 5 donasi terbaru, chart cashflow batang per bulan.

**Umpan Balik:**
> **Pengurus Yayasan:** "Rekap dan export sangat membantu pelaporan bulanan. Mohon chart cashflow dapat difilter per tahun."

**Tindakan:**
- Menambahkan filter tahun pada chart cashflow dashboard admin
- Menambahkan total donasi per campaign pada halaman rekap

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Filter multiple pada rekap (status, campaign, tanggal) memberikan fleksibilitas
- Export CSV/PDF memudahkan pelaporan ke pengurus
- Chart cashflow memberikan visualisasi tren donasi

**Hal yang perlu diperbaiki:**
- Filter tahun pada chart cashflow belum ada — perlu ditambahkan
- Beberapa data donasi dari Midtrans lama masih ada — perlu dibersihkan

### Sub-sprint 8B — Pengujian, UAT, dan Serah Terima [Hari 89–92]

**Sprint Goal:** Sistem modul donasi kampanye + profil yayasan & berita siap diimplementasikan.

#### 1. Sprint Planning
**Tugas Teknis:**
- Menyusun skenario black-box testing per modul (Sprint 1–7)
- Regression testing setelah perbaikan berdasarkan umpan balik
- User Acceptance Test (UAT) oleh admin dan pengurus yayasan
- Dokumentasi teknis dan panduan penggunaan modul donasi, profil, dan berita
- Berita Acara Serah Terima (BAST)

#### 2. Daily Scrum

**Hari 89 — Black-box Testing**
> **Raka:** "Kemarin saya menyusun skenario pengujian — total 55 skenario untuk 7 sprint."
>
> **Raka:** "Hari ini melaksanakan pengujian modul 1–4: database campaign, profil yayasan, CRUD campaign, CRUD profil."
>
> **Raka:** "Ditemukan gangguan: slug tidak auto-update saat title diubah. Langsung diperbaiki."

**Hari 90 — Regression dan Persiapan UAT**
> **Raka:** "Pengujian modul 1–4 selesai, dua gangguan minor ditemukan. Pengujian modul 5–8 juga selesai."
>
> **Raka:** "Hari ini melakukan regression testing. Menyiapkan lingkungan UAT dengan data contoh."
>
> **Raka:** "Tidak ada kendala. Regression aman."

**Hari 91 — Pelaksanaan UAT**
> **Raka:** "UAT bersama admin yayasan. Mereka mencoba semua fitur: CRUD campaign, profil yayasan, berita, validasi pembayaran, rekap, export, dashboard."
>
> **Raka:** "Hari ini UAT dari sisi donatur: halaman depan, donasi, upload bukti, invoice, riwayat, berita."
>
> **Raka:** "Semua fitur berjalan."

**Hari 92 — Finalisasi dan BAST**
> **Raka:** "Semua umpan balik UAT sudah diterapkan. Dokumentasi pengguna sudah disiapkan."
>
> **Raka:** "Hari ini menandatangani BAST bersama pengurus yayasan. Modul Donasi Kampanye + Profil Yayasan & Berita resmi siap digunakan."
>
> **Raka:** "Selesai. 92 hari sesuai rencana. Empat belas Product Backlog seluruhnya selesai."

#### 3. Sprint Review

**Demonstrasi:**
Skenario end-to-end: admin membuat campaign baru → campaign tampil di halaman depan → donatur membuka form donasi (dengan logo yayasan) → melihat info rekening BSI → upload bukti transfer → admin membuka riwayat transaksi → melihat bukti → klik Konfirmasi → status success → WA notifikasi terkirim → donatur lihat invoice (dengan kop yayasan) → download PDF. Admin juga mengelola profil yayasan (logo, alamat, sejarah), data pengurus, dan berita kegiatan — semuanya tampil di halaman publik.

**Umpan Balik:**
> **Pengurus Yayasan:** "Modul donasi kampanye, profil yayasan, dan berita sudah siap digunakan. Alur dari halaman depan hingga invoice sangat jelas. Kami mengapresiasi penyelesaian modul ini."

**Tindakan:**
- Menandatangani BAST sebagai tanda serah terima resmi
- Menyerahkan dokumentasi teknis dan panduan penggunaan kepada admin yayasan
- Mencatat saran fitur tambahan untuk pengembangan selanjutnya

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Empat belas Product Backlog selesai tepat waktu dalam 92 hari
- UAT berjalan lancar tanpa perbaikan mayor
- Dokumentasi dan BAST lengkap

**Hal yang perlu diperbaiki:**
- Pengujian sebaiknya tidak hanya black-box — automated testing perlu ditambahkan
- Slug tidak sinkron saat edit — mestinya menggunakan event updating, bukan hanya creating
- Beberapa perbaikan kecil bisa dicegah dengan peninjauan kode yang lebih ketat

---

## Lampiran: Pemetaan Sprint

| Sprint | Hari | PB | Modul |
|--------|------|----|-------|
| 1A | 1–5 | PB-D01 | Fondasi Database Campaign & Donation |
| 1B | 6–12 | PB-P01 | Fondasi Database Profil Yayasan |
| 2A | 13–18 | PB-D02 | CRUD Campaign (Admin) |
| 2B | 19–24 | PB-P02 | CRUD Profil & Pendiri (Admin) |
| 3A | 25–30 | PB-P03 | Halaman Publik Profil, Pengurus, Legalitas |
| 3B | 31–36 | PB-D03 | Halaman Depan & Publikasi Campaign |
| 4 | 37–50 | PB-B01 | CRUD Berita Kegiatan (Admin) |
| 5 | 51–62 | PB-D04 | Form Donasi & Upload Bukti Transfer |
| 6 | 63–74 | PB-B02 | Halaman Berita Publik & Integrasi |
| 7A | 75–80 | PB-D05, PB-D06 | Validasi Pembayaran & Notifikasi WA |
| 7B | 81–84 | PB-D07, PB-D08 | Invoice & Riwayat Donasi (User) |
| 8A | 85–88 | PB-D09 | Rekap & Export Data (Admin) |
| 8B | 89–92 | — | Pengujian, UAT, BAST |

**Total: 92 hari — 14 Product Backlog — 6 Modul (Donasi Kampanye + Profil Yayasan + Berita Kegiatan)**
