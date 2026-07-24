# Rencana Pengembangan — 5 Sprint / 65 Hari
## Yayasan Baitul Yatim Sukabumi — Modul Profil Yayasan & Berita Kegiatan
**Berjalan paralel dengan modul OTA (RENCANA_SPRINT.md) dan Donasi Kampanye (RENCANA_SPRINT_DONASI.md)**

---

## Sprint P1 (Hari 1–7): Fondasi Database Profil Yayasan
**Berjalan paralel dengan:** OTA Sprint 1, Donasi Sprint 1
**Sprint Goal:** Tabel profil yayasan dan sistem View Composer siap.

### 1. Sprint Planning
**PB-P01:** Sebagai Admin, saya ingin dapat menyimpan dan mengubah profil yayasan (nama, logo, alamat, kontak, sejarah, visi, misi) agar informasi yayasan tampil di seluruh halaman.

**Tugas Teknis:**
- Migration tabel `profil_yayasan`: id, nama_yayasan, email, no_telp, alamat, sejarah_yayasan (nullable text), visi (nullable text), misi (nullable text), logo (nullable string), legalitas (nullable text), foto_legalitas (nullable string), foto_struktur (nullable string), timestamps
- Migration tabel `pendiris`: id, nama, jabatan, deskripsi (nullable text), foto (nullable string), timestamps
- Membuat model `ProfilYayasan` dengan fillable semua kolom
- Membuat model `Pendiri` dengan fillable dan booted deleted (hapus foto saat dihapus)
- Membuat `ProfilYayasanComposer` — View Composer global yang inject `$profil` ke seluruh view
- Mendaftarkan composer di `AppServiceProvider::boot()`

### 2. Daily Scrum

**Hari 1 — Rancangan Database**
> **Raka (Developer):** "Kemarin saya menyelesaikan desain tabel profil_yayasan dan pendiris. Profil yayasan menyimpan data statis (nama, logo, alamat, sejarah, visi, misi, legalitas). Pendiri menyimpan data pengurus yayasan."
>
> **Raka:** "Hari ini membuat migration, model, factory, dan View Composer global."
>
> **Raka:** "View Composer harus global agar $profil bisa diakses di semua view tanpa manual passing data."

**Hari 4 — View Composer Global**
> **Raka:** "Migration dan model sudah selesai. Factory untuk ProfilYayasan dan Pendiri juga sudah siap."
>
> **Raka:** "Hari ini mendaftarkan ProfilYayasanComposer di AppServiceProvider — method boot() dengan View::composer('*', ...). Semua view sekarang punya akses $profil tanpa manual passing."
>
> **Raka:** "Tidak ada kendala. View Composer bekerja dengan baik — setiap render view, data profil otomatis tersedia."

**Hari 7 — Finalisasi Database**
> **Raka:** "View Composer global sudah terdaftar. Semua view bisa mengakses $profil->nama_yayasan, $profil->logo, dll."
>
> **Raka:** "Hari ini melakukan pengujian — memastikan factory berfungsi, model booted menghapus foto saat pendiri dihapus, dan View Composer menginjeksi data dengan benar."
>
> **Raka:** "Semua berfungsi. Siap memasuki Sprint P2."

### 3. Sprint Review

**Demonstrasi:**
Menjalankan `php artisan migrate:fresh --seed` — tabel profil_yayasan dan pendiris terbuat. Factory mengisi satu record profil yayasan dan 5 pendiri. Membuka halaman welcome → data `$profil->nama_yayasan` tampil. Semua view memiliki akses ke `$profil`.

**Umpan Balik:**
> **Pengurus Yayasan:** "View Composer global sangat membantu — data profil otomatis muncul tanpa perlu passing manual di setiap controller."

**Tindakan:**
- Menambahkan seeder untuk data profil yayasan default
- Memastikan factory menghasilkan data yang realistis untuk pengujian

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- View Composer global efisien untuk data yang dipakai di semua halaman
- Booted deleted pada model Pendiri memastikan file foto tidak mengotori storage

**Hal yang perlu diperbaiki:**
- Belum ada validasi input di model level — validasi hanya di controller
- Factory profil yayasan perlu data yang lebih mendekati asli

---

## Sprint P2 (Hari 8–18): CRUD Profil Yayasan & Pendiri (Admin)
**Berjalan paralel dengan:** OTA Sprint 2–3, Donasi Sprint 2
**Sprint Goal:** Admin dapat mengelola profil yayasan dan data pengurus.

### 1. Sprint Planning
**PB-P02:** Sebagai Admin, saya ingin dapat mengelola profil yayasan dan data pengurus (pendiri) melalui halaman admin.

**Tugas Teknis:**
- Membuat `ProfilYayasanController`: index (tab profil + pendiri), edit (form dedicated), update (validasi + upload file)
- Membuat `PendiriController`: index (daftar + tambah), store (validasi + upload foto), destroy (hapus + cleanup)
- View admin profil index: tab panel — Tab 1 (edit profil form), Tab 2 (daftar pendiri + tambah)
- View admin profil edit: form dedicated dengan semua field profil yayasan
- View admin pendiri index: form tambah di kiri, tabel daftar di kanan
- Upload file: logo (folder logo/), foto_legalitas, foto_struktur via trait HandlesFileUpload
- Validasi profil: nama_yayasan required, email required email, no_telp required, alamat required
- Validasi pendiri: nama required, jabatan required, foto required image max 2MB (jpg/png)

### 2. Daily Scrum

**Hari 8 — Controller dan Route**
> **Raka:** "Kemarin saya membuat ProfilYayasanController dan PendiriController dengan method dasar. Route sudah terdaftar di prefix admin."
>
> **Raka:** "Hari ini membuat view admin profil index dengan tab panel — Tab 1 berisi form edit profil (nama_yayasan, logo, alamat, no_telp, email, sejarah, visi, misi, legalitas, foto_legalitas, foto_struktur). Tab 2 berisi daftar pendiri."
>
> **Raka:** "Tidak ada kendala. Data profil hanya satu record — diambil dengan ProfilYayasan::first()."

**Hari 12 — Form Edit Profil**
> **Raka:** "View index dengan tab panel menggunakan AlpineJS x-data sudah selesai. Tab 1: form profil dengan preview logo, upload foto legalitas dan struktur. Tab 2: daftar pendiri sebagai card."
>
> **Raka:** "Hari ini membuat logika update — validasi input, upload file via HandlesFileUpload trait, hapus file lama jika diganti."
>
> **Raka:** "Logo disimpan di folder logo/, foto_legalitas di legalitas/, foto_struktur di struktur/ — masing-masing folder terpisah di storage publik."

**Hari 15 — Manajemen Pendiri**
> **Raka:** "Update profil berfungsi. Semua field tersimpan dengan benar. File lama otomatis terhapus saat diganti."
>
> **Raka:** "Hari ini membuat PendiriController — store (validasi + upload foto ke folder pendiri/), destroy (hapus foto + record). View tambah pendiri dalam bentuk card dengan form dan daftar tabel."
>
> **Raka:** "Foto pendiri disimpan di storage/app/public/pendiri/. Saat record dihapus, foto ikut terhapus via booted deleted."

**Hari 18 — Pengujian CRUD**
> **Raka:** "CRUD pendiri selesai. Form tambah dengan upload foto, tabel daftar dengan avatar, tombol hapus dengan modal konfirmasi."
>
> **Raka:** "Hari ini melakukan pengujian: edit semua field profil, ganti logo, upload foto legalitas, tambah 3 pendiri, edit (tidak ada edit pendiri — hanya tambah dan hapus), hapus pendiri."
>
> **Raka:** "Semua berfungsi. Siap untuk sprint publik."

### 3. Sprint Review

**Demonstrasi:**
Admin membuka menu "Profil Yayasan". Tab 1: form edit dengan data profil terisi — ganti logo, edit sejarah, upload foto legalitas dan struktur organisasi. Tab 2: daftar pendiri (Ketua, Wakil, Sekretaris, dll) dengan foto. Klik "Tambah" → isi nama, jabatan, deskripsi, upload foto → tersimpan. Klik "Hapus" → konfirmasi → data hilang.

**Umpan Balik:**
> **Pengurus Yayasan:** "CRUD profil dan pendiri sudah bagus. Akan tetapi untuk pendiri, sebaiknya bisa diurutkan (urutan tampil) agar ketua berada di atas."

**Tindakan:**
- Menambahkan kolom `urutan` (integer, default 0) pada tabel pendiris
- Menambahkan input number pada form tambah pendiri
- Mengurutkan query pendiri berdasarkan kolom urutan

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Tab panel memudahkan admin mengakses profil dan pendiri dalam satu halaman
- Upload file dengan HandlesFileUpload trait bekerja dengan baik
- Booted deleted mencegah file sampah

**Hal yang perlu diperbaiki:**
- Urutan tampil pendiri belum bisa diatur — perlu field urutan
- Belum ada fitur edit pendiri — hanya tambah dan hapus

---

## Sprint P3 (Hari 19–30): Halaman Publik Profil, Pengurus, Legalitas
**Berjalan paralel dengan:** OTA Sprint 3–4, Donasi Sprint 3
**Sprint Goal:** Publik dapat melihat profil yayasan, daftar pengurus, dan informasi legalitas.

### 1. Sprint Planning
**PB-P03:** Sebagai Pengunjung, saya ingin dapat melihat profil yayasan, daftar pengurus, dan dokumen legalitas yayasan.

**Tugas Teknis:**
- Membuat route `/profil` → view `profil.blade.php` — hero, sejarah, visi, misi, kontak
- Membuat route `/pengurus` → view `pengurus.blade.php` — grid pengurus dengan foto/avatar
- Membuat route `/legalitas` → view `legalitas.blade.php` — teks legalitas + foto legalitas + foto struktur dengan lightbox
- Menambahkan navigasi menu Footer dan Navbar ke halaman profil, pengurus, legalitas
- Menambahkan link cepat di dashboard donatur ke profil/pengurus/legalitas
- Menambahkan informasi yayasan di halaman depan (hero, footer)

### 2. Daily Scrum

**Hari 19 — Halaman Profil**
> **Raka:** "Kemarin saya membuat route `/profil` yang merender view `profil.blade.php`. Data profil diambil dari `$profil` (View Composer global)."
>
> **Raka:** "Hari ini menata layout halaman profil: hero section dengan background gradient, logo yayasan besar, nama yayasan, alamat. Section sejarah — paragraf panjang. Section visi dan misi — dua kolom. Section kontak — no_telp dan email dengan ikon."
>
> **Raka:** "Data $profil sudah tersedia dari View Composer, jadi tidak perlu passing manual dari controller."

**Hari 22 — Halaman Pengurus**
> **Raka:** "Halaman profil selesai dengan desain yang rapi menggunakan card dan gradient."
>
> **Raka:** "Hari ini membuat halaman pengurus — route `/pengurus` menampilkan semua pendiri dalam grid card. Setiap card menampilkan avatar (inisial jika tidak ada foto), nama, jabatan, dan deskripsi (kata sambutan)."
>
> **Raka:** "Avatar inisial menggunakan komponen dengan background color berdasarkan hash nama — warna konsisten per orang."

**Hari 26 — Halaman Legalitas**
> **Raka:** "Halaman pengurus selesai dengan grid responsif (3 kolom desktop, 1 mobile). AOS animation untuk scroll effect."
>
> **Raka:** "Hari ini membuat halaman legalitas — route `/legalitas` menampilkan teks legalitas, foto legalitas (SK/Akta), dan foto struktur organisasi. Foto dapat diklik untuk lightbox menggunakan AlpineJS."
>
> **Raka:** "Lightbox menggunakan x-show dengan overlay gelap. Saat foto diklik, muncul modal besar dengan tombol close."

**Hari 29 — Navigasi dan Dashboard**
> **Raka:** "Legalitas lightbox selesai. Foto diperbesar hingga 90% viewport height dengan scroll jika diperlukan."
>
> **Raka:** "Hari ini menambahkan navigasi — link ke /profil, /pengurus, /legalitas di navbar, footer, dan dashboard donatur. Juga memastikan informasi yayasan (nama, alamat, kontak) tampil di footer semua halaman."
>
> **Raka:** "Semua link menggunakan route name yang sudah ada. Footer menggunakan komponen terpisah."

**Hari 30 — Finalisasi**
> **Raka:** "Navigasi dan footer sudah terintegrasi. Semua halaman publik terkait profil yayasan sudah selesai."
>
> **Raka:** "Hari ini melakukan pengujian — semua halaman (profil, pengurus, legalitas) berfungsi, link navigasi bekerja, lightbox legalitas berjalan, data sesuai dengan yang diinput admin."
>
> **Raka:** "Tidak ada kendala. Modul Profil Yayasan siap."

### 3. Sprint Review

**Demonstrasi:**
Pengunjung membuka `/profil` — hero gradient dengan logo dan nama yayasan, section sejarah (paragraf), visi & misi (dua kolom), kontak (no_telp, email). Buka `/pengurus` — grid 3 kolom: foto/avatar inisial, nama "Ahmad Fauzi", jabatan "Ketua Yayasan", deskripsi kata sambutan. Buka `/legalitas` — teks legalitas, foto SK/Akta (klik → lightbox), foto struktur organisasi (klik → lightbox). Footer menampilkan nama, alamat, kontak yayasan.

**Umpan Balik:**
> **Pengurus Yayasan:** "Halaman profil, pengurus, dan legalitas sudah informatif. Lightbox legalitas membantu melihat dokumen dengan jelas. Mohon ditambahkan animasi yang lebih halus pada transisi halaman."

**Tindakan:**
- Menambahkan AOS (Animate On Scroll) untuk animasi scroll pada section profil
- Menambahkan transisi halaman yang lebih halus

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- View Composer global membuat data profil selalu tersedia
- Lightbox legalitas dengan AlpineJS ringan tanpa library tambahan
- Avatar inisial dengan warna hash konsisten

**Hal yang perlu diperbaiki:**
- Animasi transisi halaman belum ada — perlu ditambahkan
- Halaman profil belum memiliki breadcrumb navigasi

---

## Sprint B1 (Hari 31–45): CRUD Berita Kegiatan (Admin)
**Berjalan paralel dengan:** OTA Sprint 4–5, Donasi Sprint 4
**Sprint Goal:** Admin dapat membuat, mengedit, dan menghapus berita kegiatan.

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

**Hari 31 — Migration dan Model**
> **Raka:** "Kemarin saya membuat migration tabel news dengan kolom lengkap — judul, slug (unique), kategori, tanggal_kegiatan, lokasi, penyelenggara, ringkasan, konten, foto_utama, status."
>
> **Raka:** "Hari ini membuat model News dengan fillable, cast tanggal_kegiatan ke date, scope published(), method generateSlug(), dan booted deleted untuk cleanup foto."
>
> **Raka:** "Booted deleted penting — saat berita dihapus, foto_utama ikut terhapus dari storage agar tidak menumpuk."

**Hari 35 — Controller dan View Index**
> **Raka:** "Model News selesai dengan auto-slug dan published scope. Factory juga sudah siap."
>
> **Raka:** "Hari ini membuat NewsController resource dan view index — card summary di atas (total berita, published, draft) dan tabel daftar dengan kolom: foto thumbnail, judul, kategori, tanggal, status badge (draft=warning, published=success), aksi."
>
> **Raka:** "Tabel menggunakan pagination 10 per halaman."

**Hari 40 — Form Create dan Edit**
> **Raka:** "View index selesai dengan summary card dan tabel yang rapi."
>
> **Raka:** "Hari ini membuat form create/edit — menggunakan satu file form.blade.php yang di-include oleh create.blade.php dan edit.blade.php. Field: judul, kategori (dropdown: Kegiatan Umum, Santunan, Pendidikan, Kesehatan, Ramadan, Hari Besar, Kunjungan, Lainnya), tanggal_kegiatan (date picker), lokasi, penyelenggara, ringkasan (textarea, max 500 chars), konten (longText), foto_utama (file input dengan preview), status (radio draft/published)."
>
> **Raka:** "Form create dan edit hampir identik — bedanya edit memiliki preview foto existing dan method PUT."

**Hari 44 — Pengujian CRUD**
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

## Sprint B2 (Hari 46–65): Halaman Berita Publik & Integrasi
**Berjalan paralel dengan:** OTA Sprint 5–7, Donasi Sprint 5–7
**Sprint Goal:** Publik dapat melihat berita kegiatan di halaman depan, halaman detail, dan dashboard donatur.

### 1. Sprint Planning
**PB-B02:** Sebagai Pengunjung, saya ingin dapat melihat berita dan kegiatan yayasan di halaman depan dan halaman detail berita.

**Tugas Teknis:**
- Membuat route `/berita/{slug}` → menampilkan detail berita publik
- View detail berita: breadcrumb, hero image, judul, meta (kategori, tanggal, lokasi, penyelenggara), ringkasan, konten, sidebar info, CTA donasi
- Menambahkan carousel berita di halaman depan (welcome.blade.php) — published, latest 9, auto-slide 4.5s
- Menambahkan grid berita di dashboard donatur — published, latest 6
- Scope published() untuk memfilter hanya berita dengan status 'published'
- Menambahkan link navigasi "Berita" di navbar dan footer

### 2. Daily Scrum

**Hari 46 — Route Detail Berita**
> **Raka:** "Kemarin saya membuat route `/berita/{slug}` dengan closure di web.php. Query: News::where('slug',$slug)->published()->firstOrFail()."
>
> **Raka:** "Hari ini membuat view detail berita — layout: breadcrumb (Berita > {kategori} > {judul}), hero image full width, judul besar, meta info (kategori badge, tanggal, lokasi, penyelenggara), ringkasan (styling blockquote), konten, sidebar (info card + CTA donasi)."
>
> **Raka:** "Jika berita tidak ditemukan atau status draft, tampilkan 404."

**Hari 50 — Carousel Halaman Depan**
> **Raka:** "Detail berita selesai — layout dua kolom (konten utama + sidebar). Sidebar berisi info card (kategori, tanggal, lokasi, penyelenggara) dan CTA donasi."
>
> **Raka:** "Hari ini menambahkan carousel berita di halaman depan — section 'Berita & Kegiatan' menampilkan 9 berita terbaru dalam slider. Auto-slide setiap 4.5 detik dengan tombol navigasi prev/next."
>
> **Raka:** "Carousel menggunakan AlpineJS — x-data dengan interval timer, x-show untuk slide aktif, dan tombol navigasi."

**Hari 56 — Grid Dashboard Donatur**
> **Raka:** "Carousel halaman depan selesai — setiap slide menampilkan 3 card berita (grid), auto-rotasi, dan dapat dinavigasi manual."
>
> **Raka:** "Hari ini menambahkan grid berita di dashboard donatur — section 'Berita & Kegiatan' menampilkan 6 berita terbaru dalam grid 3 kolom. Setiap card: foto thumbnail, judul, ringkasan singkat, tanggal, tombol 'Baca Selengkapnya'."
>
> **Raka:** "Data diambil dari DonorController — $newsList = News::published()->latest()->take(6)->get()."

**Hari 61 — Navigasi dan Link**
> **Raka:** "Grid dashboard donatur selesai. Link 'Baca Selengkapnya' mengarah ke route news.show."
>
> **Raka:** "Hari ini menambahkan navigasi — menu 'Berita' di navbar (mengarah ke section #berita di halaman depan) dan footer (mengarah ke halaman depan section berita). Juga menambahkan routing untuk halaman berita index publik jika diperlukan."
>
> **Raka:** "Tidak ada kendala. Semua link navigasi sudah terintegrasi."

**Hari 64 — Pengujian Akhir**
> **Raka:** "Navigasi berita sudah terintegrasi di navbar, footer, dashboard, dan halaman depan."
>
> **Raka:** "Hari ini melakukan pengujian: create berita published → muncul di carousel halaman depan dan grid dashboard → klik 'Baca Selengkapnya' → detail berita lengkap. Create berita draft → tidak muncul di publik. Edit status draft→published → muncul."
>
> **Raka:** "Semua berfungsi. Modul Berita Kegiatan siap."

### 3. Sprint Review

**Demonstrasi:**
Admin membuat berita "Kegiatan Belajar Mengajar TPQ" dengan status Published. Buka halaman depan → carousel Berita & Kegiatan menampilkan berita baru (auto-slide). Klik "Baca Selengkapnya" → halaman detail dengan breadcrumb, hero image, judul, meta (kategori Pendidikan, tgl 10 Mar 2026, Masjid Al-Falah), ringkasan, konten lengkap. Sidebar menampilkan info dan CTA "Donasi Sekarang". Buka dashboard donatur → grid berita menampilkan 6 berita terbaru.

**Umpan Balik:**
> **Pengurus Yayasan:** "Berita tampil dengan baik di halaman depan. Carouselnya menarik. Akan tetapi mohon ditambahkan halaman arsip berita (daftar semua berita) agar publik dapat melihat berita lama."

**Tindakan:**
- Menambahkan route `/berita` (index) — daftar semua berita published dengan pagination
- Menambahkan link "Lihat Semua Berita" di carousel halaman depan dan grid dashboard

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Carousel dengan AlpineJS ringan tanpa library eksternal
- Grid dashboard donatur memberikan informasi kegiatan terkini
- Detail berita dengan sidebar informatif

**Hal yang perlu diperbaiki:**
- Halaman arsip berita (index) belum ada — perlu route `/berita`
- Belum ada fitur search berita berdasarkan judul atau kategori

---

## Lampiran: Pemetaan Sprint

| Sprint | Hari | PB | Modul | Paralel dengan |
|--------|------|----|-------|----------------|
| P1 | 1–7 | PB-P01 | Fondasi Database Profil | OTA S1, Donasi S1 |
| P2 | 8–18 | PB-P02 | CRUD Profil & Pendiri (Admin) | OTA S2–S3, Donasi S2 |
| P3 | 19–30 | PB-P03 | Halaman Publik (Profil/Pengurus/Legalitas) | OTA S3–S4, Donasi S3 |
| B1 | 31–45 | PB-B01 | CRUD Berita Kegiatan (Admin) | OTA S4–S5, Donasi S4 |
| B2 | 46–65 | PB-B02 | Halaman Berita Publik & Integrasi | OTA S5–S7, Donasi S5–S7 |

**Total: 65 hari — 5 Product Backlog — 2 Modul (berjalan paralel dengan modul utama)**
