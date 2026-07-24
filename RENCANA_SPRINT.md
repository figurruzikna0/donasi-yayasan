# Rencana Pengembangan — 8 Sprint / 92 Hari
## Yayasan Baitul Yatim Sukabumi — Modul Orang Tua Asuh (OTA) + Profil Yayasan & Berita Kegiatan

---

## Sprint 1 (Hari 1–14): Manajemen Anak Asuh & Fondasi Database Profil Yayasan

### Sub-sprint 1A — Manajemen Anak Asuh (Admin) [Hari 1–7]

**Sprint Goal:** Admin yayasan dapat memasukkan dan mengelola data master anak asuh ke dalam sistem.

#### 1. Sprint Planning
**PB-04:** Sebagai Admin, saya ingin dapat menambahkan, mengubah, dan menghapus (CRUD) data profil anak asuh (nama, usia, jenjang pendidikan, kebutuhan biaya) agar informasi selalu terkini.

**Tugas Teknis:**
- Membuat migration tabel `foster_children` dengan kolom: name, age, jenis_kelamin, description, photo, status
- Membuat model `FosterChild` dengan relasi ke sponsorship
- Membuat `FosterChildController` dengan fungsi index, create, store, show, edit, update, destroy
- Membuat form input data anak dengan validasi (name wajib diisi, age bilangan bulat minimal 0, foto maksimal 2MB format jpg/png)
- Mengimplementasikan unggah foto dengan Storage Laravel
- Membuat tampilan daftar anak asuh untuk admin dengan DataTable

#### 2. Daily Scrum

**Hari 1 — Rancangan Database**
> **Raka (Developer):** "Kemarin saya menyelesaikan desain skema database untuk modul anak asuh. Relasi antar tabel sudah jelas — satu anak dapat memiliki banyak sponsorship, dengan status Tersedia atau Diasuh."
>
> **Raka:** "Hari ini saya akan membuat migration dan model FosterChild beserta factory untuk pengujian."
>
> **Raka:** "Kendala? Sejauh ini tidak ada. Hanya masih mempertimbangkan apakah kolom jenjang pendidikan menggunakan tipe enum atau string. Sementara akan menggunakan string agar lebih fleksibel."

**Hari 4 — CRUD dan Unggah Foto**
> **Raka:** "Kemarin fungsi CRUD dasar sudah selesai — create, read, update, delete semua berfungsi. Unggah foto menggunakan Storage::disk('public') juga sudah berjalan."
>
> **Raka:** "Hari ini saya akan merapikan tampilan daftar anak asuh menggunakan DataTable agar pencarian lebih mudah."
>
> **Raka:** "Terdapat kendala kecil — saat memperbarui foto, foto lama belum terhapus secara otomatis. Perlu menambahkan logic pada method booted deleted untuk membersihkan storage."

**Hari 6 — Finalisasi**
> **Raka:** "Kemarin DataTable sudah selesai dan validasi unggah file sudah berfungsi. Foto lama otomatis terhapus apabila diganti atau data dihapus."
>
> **Raka:** "Hari ini melakukan pengujian akhir — memeriksa seluruh skenario: unggah file yang bukan gambar, memperbarui tanpa mengganti foto, dan menghapus data."
>
> **Raka:** "Semua sudah berfungsi dengan baik. Tidak ada kendala berarti."

#### 3. Sprint Review

**Demonstrasi:**
Admin berhasil menambahkan data anak asuh baru melalui formulir — nama, usia, jenis kelamin, deskripsi, dan foto profil. Data tampil pada tabel daftar anak asuh dengan opsi edit dan hapus. Pencarian berfungsi. Unggah foto dengan pratinjau berhasil.

**Umpan Balik:**
> **Pengurus Yayasan:** "Bagus, datanya sudah muncul semua. Akan tetapi kolom jenjang pendidikan belum tersedia padahal dalam PB-04 disebutkan. Mohon ditambahkan."

**Tindakan:**
- Menambahkan kolom `education` pada tabel `foster_children` (enum: TK/SD/SMP/SMA atau string)
- Menyesuaikan formulir create dan edit

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Penggunaan Laravel Storage memudahkan pengelolaan file foto
- Factory dan seeder mempermudah pengujian
- Validasi input sudah mencakup tipe file dan ukuran

**Hal yang perlu diperbaiki:**
- Logika penghapusan foto lama saat pembaruan data perlu diterapkan sejak awal, tidak setelah ditinjau

### Sub-sprint 1B — Fondasi Database Profil Yayasan [Hari 8–14]

**Sprint Goal:** Tabel profil yayasan dan sistem View Composer siap — data ini akan digunakan di halaman publik OTA dan invoice sponsorship.

#### 1. Sprint Planning
**PB-P01:** Sebagai Admin, saya ingin dapat menyimpan dan mengubah profil yayasan (nama, logo, alamat, kontak, sejarah, visi, misi) agar informasi yayasan tampil di seluruh halaman — termasuk halaman sponsorship dan invoice.

**Tugas Teknis:**
- Migration tabel `profil_yayasan`: id, nama_yayasan, email, no_telp, alamat, sejarah_yayasan (nullable text), visi (nullable text), misi (nullable text), logo (nullable string), legalitas (nullable text), foto_legalitas (nullable string), foto_struktur (nullable string), timestamps
- Migration tabel `pendiris`: id, nama, jabatan, deskripsi (nullable text), foto (nullable string), timestamps
- Membuat model `ProfilYayasan` dengan fillable semua kolom
- Membuat model `Pendiri` dengan fillable dan booted deleted (hapus foto saat dihapus)
- Membuat `ProfilYayasanComposer` — View Composer global yang inject `$profil` ke seluruh view
- Mendaftarkan composer di `AppServiceProvider::boot()`

#### 2. Daily Scrum

**Hari 8 — Rancangan Database**
> **Raka:** "Kemarin saya menyelesaikan desain tabel profil_yayasan dan pendiris. Profil yayasan menyimpan data statis (nama, logo, alamat, sejarah, visi, misi, legalitas). Pendiri menyimpan data pengurus yayasan."
>
> **Raka:** "Hari ini membuat migration, model, factory, dan View Composer global."
>
> **Raka:** "View Composer harus global agar $profil bisa diakses di semua view tanpa manual passing data — penting untuk halaman sponsorship dan invoice nantinya."

**Hari 11 — View Composer Global**
> **Raka:** "Migration dan model sudah selesai. Factory untuk ProfilYayasan dan Pendiri juga sudah siap."
>
> **Raka:** "Hari ini mendaftarkan ProfilYayasanComposer di AppServiceProvider — method boot() dengan View::composer('*', ...). Semua view sekarang punya akses $profil tanpa manual passing."
>
> **Raka:** "Tidak ada kendala. View Composer bekerja dengan baik — setiap render view, data profil otomatis tersedia."

**Hari 14 — Finalisasi Database**
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

## Sprint 2 (Hari 15–26): Manajemen Anak Asuh Publik & CRUD Profil Pendiri

### Sub-sprint 2A — Manajemen Anak Asuh (Publik) [Hari 15–21]

**Sprint Goal:** Calon orang tua asuh dapat melihat daftar dan detail profil anak asuh yang tersedia.

#### 1. Sprint Planning
**PB-05:** Sebagai Calon Orang Tua Asuh, saya ingin dapat melihat daftar profil anak asuh yang belum memiliki sponsor agar saya dapat memilih anak yang ingin saya bantu.

**Tugas Teknis:**
- Membuat route `/foster-children/{id}` untuk halaman detail anak (pengguna donatur)
- Membuat method `DonationController::childDetail` — menampilkan profil lengkap anak
- Membuat view `donations.child_detail` — foto besar, nama, usia, jenis kelamin, deskripsi, status
- Menambahkan filter usia dan jenis kelamin pada dashboard donatur (form GET dengan dropdown)
- Menambahkan tombol "Lihat Profil" dan "Asuh Sekarang" pada kartu anak di dashboard
- Memastikan anak dengan status "Diasuh" tidak menampilkan tombol "Asuh Sekarang"

#### 2. Daily Scrum

**Hari 15 — Daftar Anak di Dashboard**
> **Raka:** "Kemarin saya menambahkan route dan view untuk halaman detail anak — foto dibuat berukuran besar menggunakan ring avatar, terdapat deskripsi lengkap, status badge, dan tombol asuh."
>
> **Raka:** "Hari ini saya akan memasang filter usia dan jenis kelamin pada dashboard donatur di bagian Orang Tua Asuh agar calon OTA lebih mudah mencari anak."
>
> **Raka:** "Tidak ada kendala karena data sudah siap dari Sprint 1."

**Hari 17 — Filter dan Tombol Ganda**
> **Raka:** "Filter usia (rentang 0–5, 6–10, 11–15, 16–20) dan jenis kelamin sudah berfungsi. Tombol juga sudah dipisah menjadi dua — Lihat Profil (outline) dan Asuh Sekarang (primary)."
>
> **Raka:** "Hari ini saya akan meninjau kembali aspek UX — dikhawatirkan tombol terlalu kecil apabila diakses melalui perangkat seluler."
>
> **Raka:** "Dropdown filter menggunakan DaisyUI. Pada perangkat seluler terlihat agak sempit, perlu penyesuaian padding."

**Hari 20 — Perbaikan Responsif**
> **Raka:** "Kemarin saya memperbaiki tampilan responsif — tombol pada perangkat seluler kini menggunakan full width dengan flex-column. Filter juga menggunakan flex-wrap sehingga turun ke baris berikutnya."
>
> **Raka:** "Hari ini pengujian akhir — memeriksa seluruh kondisi filter: tanpa filter, filter usia saja, filter jenis kelamin saja, filter kombinasi, dan reset filter."
>
> **Raka:** "Semua berfungsi. Siap untuk ditinjau."

#### 3. Sprint Review

**Demonstrasi:**
Calon OTA membuka dashboard, menggulir ke bagian "Program Orang Tua Asuh". Tersedia filter Usia (dropdown rentang) dan Jenis Kelamin (dropdown). Kartu anak menampilkan avatar, nama, usia, jenis kelamin, deskripsi singkat, dan dua tombol: "Lihat Profil" dan "Asuh Sekarang". Klik "Lihat Profil" menuju halaman detail dengan foto besar, data lengkap, dan tombol "Asuh {nama} Sekarang" apabila masih tersedia.

**Umpan Balik:**
> **Pengurus Yayasan:** "Tampilannya sudah bagus. Akan tetapi foto anak pada halaman detail mohon diperbesar lagi agar calon OTA dapat melihat wajah anak dengan jelas."

**Tindakan:**
- Memperbesar ukuran foto pada halaman detail dari w-28 menjadi w-36
- Menambahkan lightbox atau zoom saat foto diklik (opsional)

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Filter usia dan jenis kelamin membantu calon OTA mempersempit pilihan
- Tata letak kartu dengan dua tombol tampak profesional
- Halaman detail informatif dengan status badge

**Hal yang perlu diperbaiki:**
- Ukuran foto profil pada halaman detail kurang besar sehingga perlu disesuaikan
- Belum ada indikator jumlah anak hasil filter, misalnya "menampilkan 3 dari 5 anak"

### Sub-sprint 2B — CRUD Profil & Pendiri (Admin) [Hari 22–26]

**Sprint Goal:** Admin dapat mengelola profil yayasan dan data pengurus — data ini akan muncul di footer, header invoice sponsorship, dan halaman publik OTA.

#### 1. Sprint Planning
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

#### 2. Daily Scrum

**Hari 22 — Controller dan Route**
> **Raka:** "Kemarin saya membuat ProfilYayasanController dan PendiriController dengan method dasar. Route sudah terdaftar di prefix admin."
>
> **Raka:** "Hari ini membuat view admin profil index dengan tab panel — Tab 1 berisi form edit profil (nama_yayasan, logo, alamat, no_telp, email, sejarah, visi, misi, legalitas, foto_legalitas, foto_struktur). Tab 2 berisi daftar pendiri."
>
> **Raka:** "Tidak ada kendala. Data profil hanya satu record — diambil dengan ProfilYayasan::first()."

**Hari 24 — Form Edit Profil**
> **Raka:** "View index dengan tab panel menggunakan AlpineJS x-data sudah selesai. Tab 1: form profil dengan preview logo, upload foto legalitas dan struktur. Tab 2: daftar pendiri sebagai card."
>
> **Raka:** "Hari ini membuat logika update — validasi input, upload file via HandlesFileUpload trait, hapus file lama jika diganti."
>
> **Raka:** "Logo disimpan di folder logo/, foto_legalitas di legalitas/, foto_struktur di struktur/ — masing-masing folder terpisah di storage publik."

**Hari 25 — Manajemen Pendiri**
> **Raka:** "Update profil berfungsi. Semua field tersimpan dengan benar. File lama otomatis terhapus saat diganti."
>
> **Raka:** "Hari ini membuat PendiriController — store (validasi + upload foto ke folder pendiri/), destroy (hapus foto + record). View tambah pendiri dalam bentuk card dengan form dan daftar tabel."
>
> **Raka:** "Foto pendiri disimpan di storage/app/public/pendiri/. Saat record dihapus, foto ikut terhapus via booted deleted."

**Hari 26 — Pengujian CRUD**
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

## Sprint 3 (Hari 27–37): Autentikasi & Halaman Publik Profil

### Sub-sprint 3A — Autentikasi Pengguna [Hari 27–31]

**Sprint Goal:** Calon orang tua asuh dan admin dapat mendaftar dan masuk ke dalam sistem dengan aman.

#### 1. Sprint Planning
**PB-01:** Sebagai Calon Orang Tua Asuh, saya ingin dapat mendaftarkan akun baru agar dapat bergabung dalam program yayasan.
**PB-03:** Sebagai Orang Tua Asuh dan Admin, saya ingin dapat masuk dan keluar dengan aman agar data pribadi saya terlindungi.

**Tugas Teknis:**
- Migration tabel `users` — kolom name, email, password, phone, alamat, nik, role (default 'donatur'), email_verified_at, avatar
- Menginstal Laravel Breeze (Blade stack) sebagai kerangka autentikasi dasar (login, register, forgot/reset password)
- Menyesuaikan `RegisteredUserController` — validasi: name, email unique, password min 8 + konfirmasi, phone, address, nik
- Menyesuaikan view `auth.register` — input: nama, email, no HP, alamat, NIK, password, konfirmasi password
- Menyesuaikan view `auth.login` — styling sesuai tema yayasan
- Memasang throttle register: 10 percobaan per 30 menit
- Memasang throttle login: 10 percobaan per 60 detik
- `AuthenticatedSessionController` — redirect berdasarkan role: admin ke `/admin/dashboard`, donatur ke `/dashboard`
- `VerifyEmailController` — verifikasi via signed route tanpa perlu login sebelumnya (auto-login setelah klik tautan)
- `VerifyEmailNotification` — notifikasi verifikasi email berbahasa Indonesia
- Menu admin (sidebar) — hanya tampil untuk user dengan role 'admin'

#### 2. Daily Scrum

**Hari 27 — Migration dan Model User**
> **Raka:** "Kemarin saya membuat migration tabel users dengan role default 'donatur'. Kolom yang tersedia: name, email, password, phone, address, nik, avatar, dan role."
>
> **Raka:** "Hari ini saya menginstal Laravel Breeze Blade stack sebagai kerangka auth — dapat login, register, forgot/reset password langsung jadi. Setelah itu akan menyesuaikan RegisteredUserController dengan validasi name, email unique, password min 8, phone, address, dan nik."
>
> **Raka:** "Kendala? Tidak ada. Breeze langsung terintegrasi dengan mulus. Hanya validasi NIK belum menggunakan regex 16 digit — masih string biasa dengan max:20. Sesuai permintaan yayasan, validasi NIK tidak perlu terlalu ketat."

**Hari 29 — Throttle, Styling Login, dan Role Redirect**
> **Raka:** "Form registrasi sudah selesai — field yang tersedia: nama, email, no HP, alamat, NIK, password, dan konfirmasi password. Semua sudah tervalidasi."
>
> **Raka:** "Hari ini saya memasang throttle di route register (10x per 30 menit) dan login (10x per 60 detik), menyesuaikan styling halaman login agar sesuai tema yayasan, dan membuat AuthenticatedSessionController agar admin redirect ke /admin/dashboard dan donatur ke /dashboard."
>
> **Raka:** "Terdapat masalah kecil — saat registrasi, field role sudah memiliki default 'donatur' dari migration jadi tidak perlu diisi manual."

**Hari 31 — Verifikasi Email Custom**
> **Raka:** "Throttle dan role redirect sudah berfungsi. Admin login langsung ke /admin/dashboard, donatur ke /dashboard."
>
> **Raka:** "Hari ini saya membuat VerifyEmailController khusus — verifikasi via signed route tanpa perlu login. Setelah klik tautan, user auto-login. Juga VerifyEmailNotification dalam Bahasa Indonesia."
>
> **Raka:** "Semua berjalan lancar. Tautan verifikasi menggunakan komponen signed URL dari Laravel jadi aman dari manipulasi."

<!-- daily scrum hari 33 dst di skip karena digabung ke sprint 3A -->

#### 3. Sprint Review

**Demonstrasi:**
Calon OTA membuka halaman `/register` — tampil formulir dengan input: nama lengkap, email, nomor HP/WhatsApp, alamat lengkap, NIK, password (dengan tombol show/hide), dan konfirmasi password. Setelah dikirim, validasi berjalan — email harus unik, password min 8 karakter. Registrasi berhasil, user langsung login dan redirect ke `/dashboard`. Email verifikasi berbahasa Indonesia terkirim ke alamat email. Tautan verifikasi menggunakan signed URL — saat diklik, akun terverifikasi tanpa perlu login ulang. Admin login redirect ke `/admin/dashboard`, donatur ke `/dashboard`. Menu admin di sidebar hanya tampil untuk user dengan role admin.

**Umpan Balik:**
> **Pengurus Yayasan:** "Registrasinya sudah lengkap dan mudah diikuti. NIK tidak perlu divalidasi 16 digit karena tidak semua calon donatur memiliki KTP dengan format baku. Untuk upload KTP tidak diperlukan dulu — cukup data diri saja."

**Tindakan:**
- Mempertahankan validasi NIK sebagai string biasa (max 20 karakter) tanpa regex 16 digit
- Tidak menambahkan upload KTP — sesuai arahan yayasan, data diri sudah mencukupi

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Form registrasi bersih dengan field yang sesuai kebutuhan — tidak terlalu banyak, tidak terlalu sedikit
- Toggle show/hide password memberikan kenyamanan pengguna
- Verifikasi email menggunakan signed URL tanpa login ulang memudahkan pengguna
- Role redirect dan throttle berfungsi sesuai spesifikasi

**Hal yang perlu diperbaiki:**
- Tidak ada toast/notifikasi setelah registrasi bahwa email verifikasi sudah dikirim — pengguna hanya langsung redirect tanpa pemberitahuan eksplisit
- Validasi NIK bisa ditambahkan minimal 16 karakter sebagai pengaman dasar meskipun tanpa regex

### Sub-sprint 3B — Halaman Publik Profil, Pengurus, Legalitas [Hari 32–37]

**Sprint Goal:** Publik dapat melihat profil yayasan, daftar pengurus, dan informasi legalitas — data ini mendukung halaman publik OTA dan invoice sponsorship.

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

**Hari 32 — Halaman Profil**
> **Raka:** "Kemarin saya membuat route `/profil` yang merender view `profil.blade.php`. Data profil diambil dari `$profil` (View Composer global)."
>
> **Raka:** "Hari ini menata layout halaman profil: hero section dengan background gradient, logo yayasan besar, nama yayasan, alamat. Section sejarah — paragraf panjang. Section visi dan misi — dua kolom. Section kontak — no_telp dan email dengan ikon."
>
> **Raka:** "Data $profil sudah tersedia dari View Composer, jadi tidak perlu passing manual dari controller."

**Hari 34 — Halaman Pengurus**
> **Raka:** "Halaman profil selesai dengan desain yang rapi menggunakan card dan gradient."
>
> **Raka:** "Hari ini membuat halaman pengurus — route `/pengurus` menampilkan semua pendiri dalam grid card. Setiap card menampilkan avatar (inisial jika tidak ada foto), nama, jabatan, dan deskripsi (kata sambutan)."
>
> **Raka:** "Avatar inisial menggunakan komponen dengan background color berdasarkan hash nama — warna konsisten per orang."

**Hari 36 — Halaman Legalitas**
> **Raka:** "Halaman pengurus selesai dengan grid responsif (3 kolom desktop, 1 mobile). AOS animation untuk scroll effect."
>
> **Raka:** "Hari ini membuat halaman legalitas — route `/legalitas` menampilkan teks legalitas, foto legalitas (SK/Akta), dan foto struktur organisasi. Foto dapat diklik untuk lightbox menggunakan AlpineJS."
>
> **Raka:** "Lightbox menggunakan x-show dengan overlay gelap. Saat foto diklik, muncul modal besar dengan tombol close."

**Hari 37 — Navigasi dan Dashboard**
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

---

## Sprint 4 (Hari 38–50): Pemilihan Paket Bantuan dan Registrasi Sponsorship
**Sprint Goal:** OTA dapat memilih paket bantuan dan mendaftarkan sponsorship untuk anak asuh pilihan.

### 1. Sprint Planning
~~**PB-02:** Sebagai Admin, saya ingin dapat memverifikasi akun calon orang tua asuh (berdasarkan KTP/Identitas) agar data donatur terjamin validitasnya.~~ **TIDAK DIIMPLEMENTASIKAN** — sesuai arahan pengurus yayasan, upload KTP dan verifikasi identitas tidak diperlukan. Data diri yang dikumpulkan saat registrasi (nama, email, no HP, alamat, NIK) sudah dianggap mencukupi. Sistem hanya menggunakan verifikasi email standar Laravel (`email_verified_at`).
**PB-06:** Sebagai Orang Tua Asuh, saya ingin dapat memilih paket bantuan (misal: beasiswa pendidikan, biaya hidup, atau kesehatan) untuk anak asuh yang saya pilih.

**Tugas Teknis:**
- ~~Migration menambah kolom `is_verified` pada tabel users~~ — Tidak jadi (lihat catatan PB-02)
- ~~Halaman admin: daftar pengguna dengan status verifikasi, pratinjau KTP (modal), tombol "Verifikasi" / "Tolak"~~ — Tidak jadi
- Paket bantuan: Bronze (Rp100.000 — buku dan alat tulis), Silver (Rp250.000 — SPP dan uang saku), Gold (Rp500.000 — penuh)
- Halaman pilih paket: pilih anak, pilih paket, konfirmasi, isi data diri, upload bukti transfer
- Migration tabel `sponsorships`: user_id, foster_child_id, package, amount, status, payment_proof, transfer_date, expires_at

### 2. Daily Scrum

**Hari 38 — Penyesuaian Lingkup Sprint**
> **Raka:** "Berdasarkan arahan pengurus yayasan pada Sprint Review 3, fitur verifikasi KTP dibatalkan. Fokus Sprint 4 hanya pada pemilihan paket dan registrasi sponsorship."
>
> **Raka:** "Hari ini mulai mengerjakan halaman pilih paket bantuan — memilih anak terlebih dahulu, kemudian memilih paket."
>
> **Raka:** "Tidak ada kendala. Lingkup yang lebih sempit memudahkan fokus."

**Hari 42 — Paket Bantuan**
> **Raka:** "Paket bantuan Bronze/Silver/Gold sudah selesai — pilihan paket menggunakan kartu interaktif, nominal dan deskripsi muncul otomatis."
>
> **Raka:** "Hari ini membuat migration tabel sponsorships dengan kolom: user_id, foster_child_id, package, amount, status, payment_proof, transfer_date, expires_at."
>
> **Raka:** "Tidak ada kendala."

**Hari 46 — Formulir Sponsor**
> **Raka:** "Halaman sponsor sudah selesai — pengguna memilih anak, memilih paket (Bronze/Silver/Gold), mengisi data diri, dan upload bukti transfer. Pemilihan paket menggunakan kartu interaktif."
>
> **Raka:** "Hari ini akan mengintegrasikan tabel sponsorship — menyimpan data saat dikirim, status pending terlebih dahulu."
>
> **Raka:** "Validasi jumlah nominal perlu disesuaikan — nominal harus Rp100.000, Rp250.000, atau Rp500.000 sesuai paket."

**Hari 49 — Finalisasi**
> **Raka:** "Sponsorship sudah tersimpan dengan status pending. Pengguna dapat melihat riwayat permohonan sponsorship pada dashboard."
>
> **Raka:** "Hari ini melakukan pengujian alur lengkap: registrasi, verifikasi email, memilih anak, memilih paket, upload bukti transfer, mengirim sponsorship."
>
> **Raka:** "Tidak ada kendala. Semua alur sudah terhubung dengan baik."

### 3. Sprint Review

**Demonstrasi:**
OTA membuka halaman sponsor, memilih anak yang tersedia, memilih paket Bronze/Silver/Gold, mengisi data donor, melihat informasi rekening tujuan yayasan (BSI 7122-8023-98 a.n. Baitul Yatim Sukabumi), mengunggah bukti transfer, dan mengirim. Sponsorship tercatat dengan status "Menunggu Konfirmasi".

**Catatan:** Fitur verifikasi KTP/identitas oleh admin tidak diimplementasikan sesuai arahan yayasan. Verifikasi hanya sebatas email verification standar Laravel.

**Umpan Balik:**
> **Pengurus Yayasan:** "Alurnya sudah sesuai. Rekening tujuan sudah muncul pada halaman, sehingga OTA langsung mengetahui ke mana harus mentransfer."

**Tindakan:**
- Memastikan informasi rekening yayasan (BSI 7122-8023-98 a.n. Baitul Yatim Sukabumi) tampil jelas pada form donasi dan sponsorship
- Mengirim notifikasi WhatsApp ke OTA saat sponsorship berhasil dikonfirmasi admin

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Lingkup sprint lebih fokus tanpa fitur verifikasi KTP — pengerjaan lebih efisien
- Paket bantuan dengan kartu interaktif tampak menarik
- Sponsorship tersimpan dengan status pending, siap divalidasi admin

**Hal yang perlu diperbaiki:**
- Informasi rekening tujuan perlu ditambahkan pada halaman donasi kampanye juga, tidak hanya sponsorship
- Belum ada notifikasi WhatsApp saat sponsorship dikonfirmasi

---

## Sprint 5 (Hari 51–62): CRUD Berita Kegiatan (Admin)
**Sprint Goal:** Admin dapat membuat, mengedit, dan menghapus berita kegiatan — berita akan tampil di halaman depan dan dashboard OTA.

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

**Hari 51 — Migration dan Model**
> **Raka:** "Kemarin saya membuat migration tabel news dengan kolom lengkap — judul, slug (unique), kategori, tanggal_kegiatan, lokasi, penyelenggara, ringkasan, konten, foto_utama, status."
>
> **Raka:** "Hari ini membuat model News dengan fillable, cast tanggal_kegiatan ke date, scope published(), method generateSlug(), dan booted deleted untuk cleanup foto."
>
> **Raka:** "Booted deleted penting — saat berita dihapus, foto_utama ikut terhapus dari storage agar tidak menumpuk."

**Hari 54 — Controller dan View Index**
> **Raka:** "Model News selesai dengan auto-slug dan published scope. Factory juga sudah siap."
>
> **Raka:** "Hari ini membuat NewsController resource dan view index — card summary di atas (total berita, published, draft) dan tabel daftar dengan kolom: foto thumbnail, judul, kategori, tanggal, status badge (draft=warning, published=success), aksi."
>
> **Raka:** "Tabel menggunakan pagination 10 per halaman."

**Hari 58 — Form Create dan Edit**
> **Raka:** "View index selesai dengan summary card dan tabel yang rapi."
>
> **Raka:** "Hari ini membuat form create/edit — menggunakan satu file form.blade.php yang di-include oleh create.blade.php dan edit.blade.php. Field: judul, kategori (dropdown: Kegiatan Umum, Santunan, Pendidikan, Kesehatan, Ramadan, Hari Besar, Kunjungan, Lainnya), tanggal_kegiatan (date picker), lokasi, penyelenggara, ringkasan (textarea, max 500 chars), konten (longText), foto_utama (file input dengan preview), status (radio draft/published)."
>
> **Raka:** "Form create dan edit hampir identik — bedanya edit memiliki preview foto existing dan method PUT."

**Hari 61 — Pengujian CRUD**
> **Raka:** "Form create sudah selesai — validasi: judul required, kategori required, tanggal_kegiatan required date, foto_utama required image max 3MB (jpg/png/webp), status required. Slug auto-generate dengan penanganan duplikat."
>
> **Raka:** "Hari ini melakukan pengujian CRUD: create dengan foto + publish, edit judul (slug berubah), edit ganti foto, draft -> published, hapus (foto ikut terhapus)."
>
> **Raka:** "Semua berfungsi. Siap untuk sprint publik."

### 3. Sprint Review

**Demonstrasi:**
Admin membuka menu "Berita Kegiatan". Melihat summary: 15 Total, 10 Published, 5 Draft. Tabel menampilkan judul, kategori, tanggal, status badge. Klik "Tambah Baru" → isi judul "Santunan Anak Yatim 2026", pilih kategori "Santunan", tanggal, lokasi, ringkasan, konten, upload foto, status "Published". Simpan → muncul di tabel. Klik "Edit" → ganti judul dan foto. Klik "Hapus" → konfirmasi → data hilang + foto terhapus.

**Umpan Balik:**
> **Pengurus Yayasan:** "CRUD berita sudah lengkap. Kategorinya sudah mencakup semua jenis kegiatan."

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

## Sprint 6 (Hari 63–73): Pembayaran & Validasi + Halaman Berita Publik

### Sub-sprint 6A — Unggah Bukti Transfer dan Validasi Pembayaran [Hari 63–68]

**Sprint Goal:** OTA dapat mengunggah bukti transfer; admin dapat memvalidasi dan mengubah status pembayaran.

#### 1. Sprint Planning
**PB-07:** Sebagai Orang Tua Asuh, saya ingin dapat mengunggah bukti transfer donasi bulanan agar pihak yayasan dapat memprosesnya.
**PB-08:** Sebagai Admin, saya ingin dapat memvalidasi pembayaran donasi yang masuk dan mengubah statusnya menjadi "Lunas" atau "Berhasil".

**Tugas Teknis:**
- Migration menambah kolom `payment_proof` (string, nullable), `transfer_date` (date), dan `notes` (text) pada tabel sponsorship
- Halaman OTA: formulir unggah bukti transfer (file jpg/png/pdf maksimal 2MB), input tanggal transfer, pratinjau rekening tujuan
- Halaman admin: daftar sponsorship pending dengan pratinjau bukti, tombol Setujui/Tolak, dan catatan
- Logika setujui: memperbarui status sponsorship menjadi 'success', mengatur starts_at dan expires_at, mengubah status anak menjadi 'Diasuh'
- Mengirim notifikasi WhatsApp ke OTA saat status berubah

#### 2. Daily Scrum

**Hari 63 — Formulir Unggah Bukti**
> **Raka:** "Kemarin saya menambahkan migration untuk kolom payment_proof, transfer_date, dan notes pada tabel sponsorship. Formulir unggah bukti transfer sudah selesai."
>
> **Raka:** "Hari ini saya memasang validasi file — hanya jpg, png, pdf, maksimal 2MB. Juga menampilkan informasi rekening yayasan."
>
> **Raka:** "Ukuran maksimal 2MB sesuai saran pengurus yayasan."

**Hari 65 — Halaman Validasi Admin**
> **Raka:** "Informasi rekening yayasan sudah tampil. Formulir unggah dengan pratinjau file juga berfungsi."
>
> **Raka:** "Hari ini mulai membuat halaman admin — daftar sponsorship pending, pratinjau bukti dalam modal, tombol setujui atau tolak."
>
> **Raka:** "Diperlukan pop-up konfirmasi sebelum menyetujui agar admin tidak salah mengeklik."

**Hari 67 — Notifikasi WA dan Logika Setujui**
> **Raka:** "Modal pratinjau bukti dan konfirmasi setujui atau tolak sudah selesai. Logika menyetujui akan memperbarui status anak menjadi Diasuh."
>
> **Raka:** "Hari ini mengintegrasikan Fonnte — mengirim WhatsApp ke OTA saat sponsorship disetujui atau ditolak."
>
> **Raka:** "Token Fonnte harus dipastikan kebenarannya."

**Hari 68 — Pengujian Akhir**
> **Raka:** "Notifikasi WhatsApp berhasil. OTA menerima pesan 'Selamat! Sponsorship Anda untuk {anak} telah disetujui' saat disetujui."
>
> **Raka:** "Hari ini melakukan pengujian akhir seluruh skenario: unggah bukti, pending, setujui atau tolak, WhatsApp diterima."
>
> **Raka:** "Semua berjalan lancar."

#### 3. Sprint Review

**Demonstrasi:**
OTA membuka halaman sponsorship pending, mengunggah bukti transfer format jpg/png/pdf dan mengisi tanggal transfer. Admin membuka menu "Validasi Pembayaran" — melihat daftar sponsorship pending, pratinjau bukti dalam modal. Admin klik "Setujui" → status berubah menjadi Success, status anak menjadi Diasuh, OTA menerima WhatsApp.

**Umpan Balik:**
> **Pengurus Yayasan:** "Proses validasinya sudah bagus dan notifikasi WhatsApp berfungsi. Mohon ditambahkan catatan penolakan agar OTA mengetahui alasan ditolak."

**Tindakan:**
- Menambahkan kolom `rejection_reason` pada formulir tolak admin — alasan dikirim melalui WhatsApp ke OTA
- Menampilkan alasan penolakan pada halaman riwayat OTA

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Pop-up konfirmasi sebelum menyetujui mencegah kesalahan manusia
- Notifikasi WhatsApp secara langsung meningkatkan kepercayaan OTA
- Pratinjau bukti dalam modal memudahkan admin

**Hal yang perlu diperbaiki:**
- Alasan penolakan belum tersedia — perlu ditambahkan pada formulir tolak admin
- Ukuran file maksimal 2MB mungkin terlalu kecil untuk PDF — perlu dievaluasi menjadi 5MB

### Sub-sprint 6B — Halaman Berita Publik & Integrasi [Hari 69–73]

**Sprint Goal:** Publik dapat melihat berita kegiatan di halaman depan, halaman detail, dan dashboard OTA.

#### 1. Sprint Planning
**PB-B02:** Sebagai Pengunjung, saya ingin dapat melihat berita dan kegiatan yayasan di halaman depan dan halaman detail berita.

**Tugas Teknis:**
- Membuat route `/berita/{slug}` → menampilkan detail berita publik
- View detail berita: breadcrumb, hero image, judul, meta (kategori, tanggal, lokasi, penyelenggara), ringkasan, konten, sidebar info, CTA donasi
- Menambahkan carousel berita di halaman depan (welcome.blade.php) — published, latest 9, auto-slide 4.5s
- Menambahkan grid berita di dashboard OTA — published, latest 6
- Scope published() untuk memfilter hanya berita dengan status 'published'
- Menambahkan link navigasi "Berita" di navbar dan footer

#### 2. Daily Scrum

**Hari 69 — Route Detail Berita**
> **Raka:** "Kemarin saya membuat route `/berita/{slug}`. Query: News::where('slug',$slug)->published()->firstOrFail()."
>
> **Raka:** "Hari ini membuat view detail berita — layout: breadcrumb, hero image full width, judul besar, meta info, ringkasan, konten, sidebar (info card + CTA donasi)."
>
> **Raka:** "Jika berita tidak ditemukan atau status draft, tampilkan 404."

**Hari 70 — Carousel Halaman Depan**
> **Raka:** "Detail berita selesai — layout dua kolom (konten utama + sidebar)."
>
> **Raka:** "Hari ini menambahkan carousel berita di halaman depan — section 'Berita & Kegiatan' menampilkan 9 berita terbaru dalam slider. Auto-slide setiap 4.5 detik dengan tombol navigasi prev/next."
>
> **Raka:** "Carousel menggunakan AlpineJS — x-data dengan interval timer, x-show untuk slide aktif."

**Hari 72 — Grid Dashboard OTA**
> **Raka:** "Carousel halaman depan selesai — setiap slide menampilkan 3 card berita (grid), auto-rotasi."
>
> **Raka:** "Hari ini menambahkan grid berita di dashboard OTA — section 'Berita & Kegiatan' menampilkan 6 berita terbaru dalam grid 3 kolom. Setiap card: foto thumbnail, judul, ringkasan singkat, tanggal, tombol 'Baca Selengkapnya'."
>
> **Raka:** "Data diambil dari controller dashboard — News::published()->latest()->take(6)->get()."

**Hari 73 — Navigasi dan Link**
> **Raka:** "Grid dashboard OTA selesai. Link 'Baca Selengkapnya' mengarah ke route news.show."
>
> **Raka:** "Hari ini menambahkan navigasi — menu 'Berita' di navbar dan footer. Juga menambahkan routing untuk halaman berita index publik."
>
> **Raka:** "Tidak ada kendala. Semua link navigasi sudah terintegrasi."

<!-- hari 76-78 sprint review dsb diskip karena merged -->

#### 3. Sprint Review

**Demonstrasi:**
Admin membuat berita dengan status Published. Buka halaman depan → carousel Berita & Kegiatan menampilkan berita baru (auto-slide). Klik "Baca Selengkapnya" → halaman detail dengan breadcrumb, hero image, judul, meta, ringkasan, konten lengkap. Sidebar CTA donasi. Buka dashboard OTA → grid berita menampilkan 6 berita terbaru.

**Umpan Balik:**
> **Pengurus Yayasan:** "Berita tampil dengan baik di halaman depan. Carouselnya menarik. Mohon ditambahkan halaman arsip berita."

**Tindakan:**
- Menambahkan route `/berita` (index) — daftar semua berita published dengan pagination
- Menambahkan link "Lihat Semua Berita" di carousel dan grid dashboard

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Carousel dengan AlpineJS ringan tanpa library eksternal
- Grid dashboard OTA memberikan informasi kegiatan terkini
- Detail berita dengan sidebar informatif

**Hal yang perlu diperbaiki:**
- Halaman arsip berita (index) belum ada
- Belum ada fitur search berita berdasarkan judul atau kategori

---

## Sprint 7 (Hari 74–85): Perkembangan Anak & Riwayat Donasi

### Sub-sprint 7A — Laporan Perkembangan Anak [Hari 74–79]

**Sprint Goal:** Admin dapat mengunggah laporan perkembangan anak; OTA dapat melihat laporan anak yang disponsori.

#### 1. Sprint Planning
**PB-09:** Sebagai Admin, saya ingin dapat mengunggah laporan perkembangan anak (seperti nilai rapor, foto kegiatan, kondisi kesehatan) ke dalam sistem.
**PB-10:** Sebagai Orang Tua Asuh, saya ingin dapat melihat laporan perkembangan khusus untuk anak asuh yang saya sponsori agar saya mengetahui dampak bantuan yang saya berikan.

**Tugas Teknis:**
- Migration tabel `child_developments`: foster_child_id, sponsorship_id, title, description, photo, tanggal
- Halaman admin: formulir laporan dengan memilih anak (hanya yang berstatus Diasuh), input judul, deskripsi, foto, tanggal
- Halaman OTA: daftar laporan per anak yang disponsori, dengan galeri foto
- Filter: OTA hanya dapat melihat laporan untuk anak yang sedang atau pernah disponsori
- Notifikasi WhatsApp saat admin mengunggah laporan baru

#### 2. Daily Scrum

**Hari 74 — Migration Child Developments**
> **Raka:** "Kemarin saya membuat migration child_developments — kolom title, description, photo, tanggal, serta foreign key ke foster_child_id dan sponsorship_id."
>
> **Raka:** "Hari ini membuat formulir admin — memilih anak (filter hanya yang berstatus Diasuh), mengisi judul, deskripsi, mengunggah foto, memilih tanggal."
>
> **Raka:** "Tidak ada kendala. Hanya nanti perlu data contoh untuk pengujian."

**Hari 76 — Halaman Laporan OTA**
> **Raka:** "Formulir admin sudah selesai — memilih anak dari dropdown, mengunggah foto, judul, deskripsi."
>
> **Raka:** "Hari ini membuat halaman OTA — daftar laporan per anak yang disponsori, menampilkan galeri foto."
>
> **Raka:** "Kendala: data masih kosong. Saya perlu membuat seeder agar terdapat data untuk menguji tampilan."

**Hari 78 — Seeder dan Notifikasi WA**
> **Raka:** "Halaman OTA sudah selesai — OTA dapat melihat laporan lengkap dengan galeri foto. Seeder sudah dibuat."
>
> **Raka:** "Hari ini memasang notifikasi WhatsApp — saat admin mengunggah laporan, OTA mendapatkan notifikasi 'Laporan perkembangan {anak} telah diunggah'."
>
> **Raka:** "Tidak ada kendala."

**Hari 79 — Pengujian Akhir**
> **Raka:** "Notifikasi WhatsApp untuk laporan baru berhasil. OTA mendapatkan tautan langsung ke halaman laporan."
>
> **Raka:** "Hari ini melakukan pengujian seluruh skenario: mengunggah laporan, notifikasi WA, OTA membuka dan melihat galeri foto."
>
> **Raka:** "Semua berjalan dengan baik. Akan tetapi galeri foto masih sederhana — perlu lightbox agar dapat diklik dan diperbesar."

#### 3. Sprint Review

**Demonstrasi:**
Admin membuka menu "Laporan Perkembangan", memilih anak yang sudah diasuh, mengisi judul, deskripsi nilai rapor dan foto kegiatan. Setelah disimpan, OTA menerima WhatsApp notifikasi laporan baru. OTA membuka dashboard, melihat laporan dengan galeri foto.

**Umpan Balik:**
> **Pengurus Yayasan:** "Fitur laporannya sangat membantu. Akan tetapi galeri foto mohon dapat diklik untuk diperbesar agar OTA dapat melihat foto lebih detail."

**Tindakan:**
- Menambahkan lightbox atau zoom pada foto di galeri laporan OTA
- Menambahkan tanggal laporan pada daftar ringkasan

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Filter anak Diasuh pada dropdown admin mencegah laporan untuk anak yang belum disponsori
- Notifikasi WhatsApp membuat OTA langsung mengetahui adanya laporan baru
- Seeder membantu pengujian tampilan tanpa data manual

**Hal yang perlu diperbaiki:**
- Galeri foto memerlukan lightbox agar dapat diperbesar
- Daftar laporan OTA belum menampilkan tanggal — perlu ditambahkan

### Sub-sprint 7B — Riwayat Donasi dan Notifikasi WhatsApp [Hari 80–85]

**Sprint Goal:** OTA dapat melihat riwayat donasi; sistem mengirim notifikasi WhatsApp otomatis.

#### 1. Sprint Planning
**PB-11:** Sebagai Orang Tua Asuh, saya ingin dapat melihat riwayat seluruh donasi yang pernah saya berikan.
**PB-12 (Notifikasi):** Sistem mengirim notifikasi WhatsApp saat transaksi dikonfirmasi dan saat laporan baru diunggah.

**Tugas Teknis:**
- Halaman riwayat donasi OTA: daftar semua donasi (donasi kampanye dan sponsorship) dengan status, filter (semua/success/pending/gagal)
- Tabel ringkasan: total donasi, total sponsorship aktif
- Filter status: tab Semua, Berhasil, Menunggu, Gagal
- Notifikasi WhatsApp pengingat H-3 sebelum sponsorship berakhir
- Notifikasi WhatsApp saat sponsorship otomatis kedaluwarsa

#### 2. Daily Scrum

**Hari 80 — Halaman Riwayat**
> **Raka:** "Kemarin saya membuat route dan view halaman riwayat donasi pada `/dashboard/rekap`. Menampilkan semua donasi dan sponsorship."
>
> **Raka:** "Hari ini menambahkan filter status menggunakan tab — Semua, Berhasil, Menunggu, Gagal. Juga menambahkan ringkasan total."
>
> **Raka:** "Sponsorship dan donasi berada pada tabel yang berbeda. Saya menggabungkannya menggunakan collection agar tampil dalam satu tabel."

**Hari 82 — Filter dan Ringkasan**
> **Raka:** "Filter status menggunakan tab pill sudah selesai. Ringkasan total donasi dan sponsorship aktif juga tampil."
>
> **Raka:** "Hari ini mulai memasang pengingat WhatsApp — menjadwalkan notifikasi H-3 sebelum masa sponsorship berakhir."
>
> **Raka:** "Pengingat otomatis menggunakan Laravel scheduler."

**Hari 84 — Scheduler dan Kedaluwarsa**
> **Raka:** "Command `sponsorship:remind` sudah siap — mengirim WhatsApp H-3. Juga command `sponsorship:expire`."
>
> **Raka:** "Hari ini menguji scheduler secara manual — menjalankan command dan memeriksa apakah WhatsApp diterima."
>
> **Raka:** "Tidak ada kendala. Pengingat WhatsApp berhasil terkirim."

**Hari 85 — Finalisasi**
> **Raka:** "Scheduler sudah siap. Tinggal konfigurasi cron pada server. Semua notifikasi WhatsApp sudah terintegrasi: setujui, tolak, laporan baru, pengingat H-3, kedaluwarsa."
>
> **Raka:** "Hari ini melakukan pengujian end-to-end: melihat riwayat, filter, notifikasi WhatsApp."
>
> **Raka:** "Semua berfungsi. Siap memasuki Sprint 8."

#### 3. Sprint Review

**Demonstrasi:**
OTA membuka menu "Rekap Donasi" — melihat ringkasan: total donasi Rp1.200.000, 2 sponsorship aktif. Tabel riwayat menampilkan semua transaksi dengan status badge. Filter tab berfungsi. Untuk sponsorship yang akan kedaluwarsa H-3, OTA menerima WhatsApp pengingat.

**Umpan Balik:**
> **Pengurus Yayasan:** "Riwayat donasi sudah informatif. Notifikasi pengingatnya juga sangat membantu. Mohon ditambahkan tombol untuk melihat invoice."

**Tindakan:**
- Menambahkan tombol "Lihat Invoice" pada setiap baris riwayat donasi yang berstatus success
- Menambahkan tombol "Perpanjang" pada sponsorship yang mendekati kedaluwarsa

#### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Filter status dengan tab pill memudahkan OTA mencari transaksi tertentu
- Scheduler untuk pengingat H-3 dan kedaluwarsa berjalan otomatis
- Semua notifikasi WhatsApp terkonsolidasi dalam satu sistem

**Hal yang perlu diperbaiki:**
- Belum ada tautan invoice pada tabel riwayat — perlu ditambahkan
- Scheduler cron job memerlukan dokumentasi untuk pengaturan di server

---

## Sprint 8 (Hari 86–92): Pengujian, UAT, dan Serah Terima
**Sprint Goal:** Sistem siap diimplementasikan — pengujian menyeluruh, UAT oleh yayasan, dan serah terima final.

### 1. Sprint Planning
**Tugas Teknis:**
- Menyusun skenario black-box testing per modul (Sprint 1–7)
- Regression testing setelah perbaikan berdasarkan umpan balik
- User Acceptance Test (UAT) oleh admin dan pengurus yayasan
- Dokumentasi teknis dan panduan penggunaan
- Berita Acara Serah Terima (BAST)

### 2. Daily Scrum

**Hari 87 — Black-box Testing**
> **Raka:** "Kemarin saya menyusun skenario pengujian — total 65 skenario untuk 7 sprint."
>
> **Raka:** "Hari ini melaksanakan pengujian modul 1–4: data anak, profil yayasan, filter, CRUD profil."
>
> **Raka:** "Ditemukan gangguan pada filter laporan perkembangan — dropdown anak tidak muncul. Langsung diperbaiki."

**Hari 89 — Regression dan Persiapan UAT**
> **Raka:** "Pengujian modul 1–4 selesai, tiga gangguan minor ditemukan dan sudah diperbaiki. Pengujian modul 5–8 juga sudah selesai."
>
> **Raka:** "Hari ini melakukan regression testing. Menyiapkan lingkungan UAT."
>
> **Raka:** "Tidak ada kendala. Regression aman."

**Hari 91 — Pelaksanaan UAT**
> **Raka:** "UAT bersama admin yayasan. Mereka mencoba semua fitur dari sisi admin: CRUD anak, profil yayasan, berita, validasi pembayaran, unggah laporan."
>
> **Raka:** "Hari ini UAT dari sisi OTA: registrasi, memilih paket, unggah bukti, melihat laporan, riwayat donasi, berita."
>
> **Raka:** "Tidak ada kendala berarti."

**Hari 92 — Finalisasi dan BAST**
> **Raka:** "Semua umpan balik UAT sudah diterapkan. Dokumentasi pengguna sudah disiapkan."
>
> **Raka:** "Hari ini menandatangani BAST bersama pengurus yayasan. Sistem resmi siap digunakan."
>
> **Raka:** "Selesai. 92 hari sesuai rencana. Lima belas Product Backlog seluruhnya selesai."

### 3. Sprint Review

**Demonstrasi:**
Skenario end-to-end dari registrasi OTA, verifikasi email, memilih anak, memilih paket, mengunggah bukti transfer, disetujui admin, status anak menjadi Diasuh, OTA melihat laporan perkembangan, menerima notifikasi WhatsApp, melihat berita di halaman depan dan dashboard. Semua fitur berjalan tanpa kesalahan.

**Umpan Balik:**
> **Pengurus Yayasan:** "Sistem sudah siap digunakan. Semua fitur yang direncanakan berfungsi dengan baik."

**Tindakan:**
- Menandatangani BAST sebagai tanda serah terima resmi
- Menyerahkan dokumentasi teknis dan panduan pengguna kepada admin yayasan
- Mencatat saran fitur tambahan untuk pengembangan selanjutnya

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Lima belas Product Backlog selesai tepat waktu dalam 92 hari
- UAT berjalan lancar tanpa perbaikan mayor
- Dokumentasi dan BAST lengkap

**Hal yang perlu diperbaiki:**
- Pengujian sebaiknya tidak hanya black-box — automated testing perlu ditambahkan
- Beberapa gangguan minor dapat dicegah dengan peninjauan kode yang lebih ketat
- Dokumentasi teknis sebaiknya dibuat bertahap per sprint

---

## Lampiran: Pemetaan Sprint

| Sprint | Hari | PB | Modul |
|--------|------|----|-------|
| 1A | 1–7 | PB-04 | Manajemen Anak Asuh (Admin) |
| 1B | 8–14 | PB-P01 | Fondasi Database Profil Yayasan |
| 2A | 15–21 | PB-05 | Manajemen Anak Asuh (Publik) |
| 2B | 22–26 | PB-P02 | CRUD Profil & Pendiri (Admin) |
| 3A | 27–31 | PB-01, PB-03 | Autentikasi |
| 3B | 32–37 | PB-P03 | Halaman Publik Profil, Pengurus, Legalitas |
| 4 | 38–50 | ~~PB-02~~, PB-06 | Paket & Sponsorship |
| 5 | 51–62 | PB-B01 | CRUD Berita Kegiatan (Admin) |
| 6A | 63–68 | PB-07, PB-08 | Pembayaran & Validasi |
| 6B | 69–73 | PB-B02 | Halaman Berita Publik & Integrasi |
| 7A | 74–79 | PB-09, PB-10 | Perkembangan Anak |
| 7B | 80–85 | PB-11 + Notifikasi | Riwayat & WA |
| 8 | 86–92 | — | Pengujian, UAT, BAST |

**Total: 92 hari — 15 Product Backlog — 7 Modul (OTA + Profil Yayasan + Berita Kegiatan)**
