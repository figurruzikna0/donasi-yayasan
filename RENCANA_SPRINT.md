# Rencana Pengembangan — 8 Sprint / 92 Hari
## Yayasan Baitul Yatim Sukabumi — Modul Orang Tua Asuh (OTA)

---

## Sprint 1 (Hari 1–7): Fondasi Database dan Manajemen Data Anak Asuh
**Sprint Goal:** Admin yayasan dapat memasukkan dan mengelola data master anak asuh ke dalam sistem.

### 1. Sprint Planning
**PB-04:** Sebagai Admin, saya ingin dapat menambahkan, mengubah, dan menghapus (CRUD) data profil anak asuh (nama, usia, jenjang pendidikan, kebutuhan biaya) agar informasi selalu terkini.

**Tugas Teknis:**
- Membuat migration tabel `foster_children` dengan kolom: name, age, jenis_kelamin, description, photo, status
- Membuat model `FosterChild` dengan relasi ke sponsorship
- Membuat `FosterChildController` dengan fungsi index, create, store, show, edit, update, destroy
- Membuat form input data anak dengan validasi (name wajib diisi, age bilangan bulat minimal 0, foto maksimal 2MB format jpg/png)
- Mengimplementasikan unggah foto dengan Storage Laravel
- Membuat tampilan daftar anak asuh untuk admin dengan DataTable

### 2. Daily Scrum

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

### 3. Sprint Review

**Demonstrasi:**
Admin berhasil menambahkan data anak asuh baru melalui formulir — nama, usia, jenis kelamin, deskripsi, dan foto profil. Data tampil pada tabel daftar anak asuh dengan opsi edit dan hapus. Pencarian berfungsi. Unggah foto dengan pratinjau berhasil.

**Umpan Balik:**
> **Pengurus Yayasan:** "Bagus, datanya sudah muncul semua. Akan tetapi kolom jenjang pendidikan belum tersedia padahal dalam PB-04 disebutkan. Mohon ditambahkan."

**Tindakan:**
- Menambahkan kolom `education` pada tabel `foster_children` (enum: TK/SD/SMP/SMA atau string)
- Menyesuaikan formulir create dan edit

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Penggunaan Laravel Storage memudahkan pengelolaan file foto
- Factory dan seeder mempermudah pengujian
- Validasi input sudah mencakup tipe file dan ukuran

**Hal yang perlu diperbaiki:**
- Logika penghapusan foto lama saat pembaruan data perlu diterapkan sejak awal, tidak setelah ditinjau

---

## Sprint 2 (Hari 8–14): Manajemen Profil Anak Asuh untuk Calon Orang Tua Asuh
**Sprint Goal:** Calon orang tua asuh dapat melihat daftar dan detail profil anak asuh yang tersedia.

### 1. Sprint Planning
**PB-05:** Sebagai Calon Orang Tua Asuh, saya ingin dapat melihat daftar profil anak asuh yang belum memiliki sponsor agar saya dapat memilih anak yang ingin saya bantu.

**Tugas Teknis:**
- Membuat route `/foster-children/{id}` untuk halaman detail anak (pengguna donatur)
- Membuat method `DonationController::childDetail` — menampilkan profil lengkap anak
- Membuat view `donations.child_detail` — foto besar, nama, usia, jenis kelamin, deskripsi, status
- Menambahkan filter usia dan jenis kelamin pada dashboard donatur (form GET dengan dropdown)
- Menambahkan tombol "Lihat Profil" dan "Asuh Sekarang" pada kartu anak di dashboard
- Memastikan anak dengan status "Diasuh" tidak menampilkan tombol "Asuh Sekarang"

### 2. Daily Scrum

**Hari 8 — Daftar Anak di Dashboard**
> **Raka:** "Kemarin saya menambahkan route dan view untuk halaman detail anak — foto dibuat berukuran besar menggunakan ring avatar, terdapat deskripsi lengkap, status badge, dan tombol asuh."
>
> **Raka:** "Hari ini saya akan memasang filter usia dan jenis kelamin pada dashboard donatur di bagian Orang Tua Asuh agar calon OTA lebih mudah mencari anak."
>
> **Raka:** "Tidak ada kendala karena data sudah siap dari Sprint 1."

**Hari 10 — Filter dan Tombol Ganda**
> **Raka:** "Filter usia (rentang 0–5, 6–10, 11–15, 16–20) dan jenis kelamin sudah berfungsi. Tombol juga sudah dipisah menjadi dua — Lihat Profil (outline) dan Asuh Sekarang (primary)."
>
> **Raka:** "Hari ini saya akan meninjau kembali aspek UX — dikhawatirkan tombol terlalu kecil apabila diakses melalui perangkat seluler."
>
> **Raka:** "Dropdown filter menggunakan DaisyUI. Pada perangkat seluler terlihat agak sempit, perlu penyesuaian padding."

**Hari 13 — Perbaikan Responsif**
> **Raka:** "Kemarin saya memperbaiki tampilan responsif — tombol pada perangkat seluler kini menggunakan full width dengan flex-column. Filter juga menggunakan flex-wrap sehingga turun ke baris berikutnya."
>
> **Raka:** "Hari ini pengujian akhir — memeriksa seluruh kondisi filter: tanpa filter, filter usia saja, filter jenis kelamin saja, filter kombinasi, dan reset filter."
>
> **Raka:** "Semua berfungsi. Siap untuk ditinjau."

### 3. Sprint Review

**Demonstrasi:**
Calon OTA membuka dashboard, menggulir ke bagian "Program Orang Tua Asuh". Tersedia filter Usia (dropdown rentang) dan Jenis Kelamin (dropdown). Kartu anak menampilkan avatar, nama, usia, jenis kelamin, deskripsi singkat, dan dua tombol: "Lihat Profil" dan "Asuh Sekarang". Klik "Lihat Profil" menuju halaman detail dengan foto besar, data lengkap, dan tombol "Asuh {nama} Sekarang" apabila masih tersedia.

**Umpan Balik:**
> **Pengurus Yayasan:** "Tampilannya sudah bagus. Akan tetapi foto anak pada halaman detail mohon diperbesar lagi agar calon OTA dapat melihat wajah anak dengan jelas."

**Tindakan:**
- Memperbesar ukuran foto pada halaman detail dari w-28 menjadi w-36
- Menambahkan lightbox atau zoom saat foto diklik (opsional)

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Filter usia dan jenis kelamin membantu calon OTA mempersempit pilihan
- Tata letak kartu dengan dua tombol tampak profesional
- Halaman detail informatif dengan status badge

**Hal yang perlu diperbaiki:**
- Ukuran foto profil pada halaman detail kurang besar sehingga perlu disesuaikan
- Belum ada indikator jumlah anak hasil filter, misalnya "menampilkan 3 dari 5 anak"

---

## Sprint 3 (Hari 15–24): Pendaftaran Akun dan Autentikasi Pengguna
**Sprint Goal:** Calon orang tua asuh dan admin dapat mendaftar dan masuk ke dalam sistem dengan aman.

### 1. Sprint Planning
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

### 2. Daily Scrum

**Hari 15 — Migration dan Model User**
> **Raka:** "Kemarin saya membuat migration tabel users dengan role default 'donatur'. Kolom yang tersedia: name, email, password, phone, address, nik, avatar, dan role."
>
> **Raka:** "Hari ini saya menginstal Laravel Breeze Blade stack sebagai kerangka auth — dapat login, register, forgot/reset password langsung jadi. Setelah itu akan menyesuaikan RegisteredUserController dengan validasi name, email unique, password min 8, phone, address, dan nik."
>
> **Raka:** "Kendala? Tidak ada. Breeze langsung terintegrasi dengan mulus. Hanya validasi NIK belum menggunakan regex 16 digit — masih string biasa dengan max:20. Sesuai permintaan yayasan, validasi NIK tidak perlu terlalu ketat."

**Hari 18 — Throttle, Styling Login, dan Role Redirect**
> **Raka:** "Form registrasi sudah selesai — field yang tersedia: nama, email, no HP, alamat, NIK, password, dan konfirmasi password. Semua sudah tervalidasi."
>
> **Raka:** "Hari ini saya memasang throttle di route register (10x per 30 menit) dan login (10x per 60 detik), menyesuaikan styling halaman login agar sesuai tema yayasan, dan membuat AuthenticatedSessionController agar admin redirect ke /admin/dashboard dan donatur ke /dashboard."
>
> **Raka:** "Terdapat masalah kecil — saat registrasi, field role sudah memiliki default 'donatur' dari migration jadi tidak perlu diisi manual."

**Hari 22 — Verifikasi Email Custom**
> **Raka:** "Throttle dan role redirect sudah berfungsi. Admin login langsung ke /admin/dashboard, donatur ke /dashboard."
>
> **Raka:** "Hari ini saya membuat VerifyEmailController khusus — verifikasi via signed route tanpa perlu login. Setelah klik tautan, user auto-login. Juga VerifyEmailNotification dalam Bahasa Indonesia."
>
> **Raka:** "Semua berjalan lancar. Tautan verifikasi menggunakan komponen signed URL dari Laravel jadi aman dari manipulasi."

**Hari 24 — Menu Admin dan Pengujian Akhir**
> **Raka:** "Kemarin VerifyEmailNotification bahasa Indonesia sudah selesai. Email terkirim dengan Gmail SMTP."
>
> **Raka:** "Hari ini pengujian akhir: registrasi, verifikasi email, login, redirect sesuai role, throttle register (10x per 30 menit). Juga memastikan menu admin hanya tampil untuk role admin."
>
> **Raka:** "Verifikasi email berhasil, throttle berfungsi, menu admin tersembunyi untuk donatur. Semua berjalan dengan baik."

### 3. Sprint Review

**Demonstrasi:**
Calon OTA membuka halaman `/register` — tampil formulir dengan input: nama lengkap, email, nomor HP/WhatsApp, alamat lengkap, NIK, password (dengan tombol show/hide), dan konfirmasi password. Setelah dikirim, validasi berjalan — email harus unik, password min 8 karakter. Registrasi berhasil, user langsung login dan redirect ke `/dashboard`. Email verifikasi berbahasa Indonesia terkirim ke alamat email. Tautan verifikasi menggunakan signed URL — saat diklik, akun terverifikasi tanpa perlu login ulang. Admin login redirect ke `/admin/dashboard`, donatur ke `/dashboard`. Menu admin di sidebar hanya tampil untuk user dengan role admin.

**Umpan Balik:**
> **Pengurus Yayasan:** "Registrasinya sudah lengkap dan mudah diikuti. NIK tidak perlu divalidasi 16 digit karena tidak semua calon donatur memiliki KTP dengan format baku. Untuk upload KTP tidak diperlukan dulu — cukup data diri saja."

**Tindakan:**
- Mempertahankan validasi NIK sebagai string biasa (max 20 karakter) tanpa regex 16 digit
- Tidak menambahkan upload KTP — sesuai arahan yayasan, data diri sudah mencukupi

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Form registrasi bersih dengan field yang sesuai kebutuhan — tidak terlalu banyak, tidak terlalu sedikit
- Toggle show/hide password memberikan kenyamanan pengguna
- Verifikasi email menggunakan signed URL tanpa login ulang memudahkan pengguna
- Role redirect dan throttle berfungsi sesuai spesifikasi

**Hal yang perlu diperbaiki:**
- Tidak ada toast/notifikasi setelah registrasi bahwa email verifikasi sudah dikirim — pengguna hanya langsung redirect tanpa pemberitahuan eksplisit
- Validasi NIK bisa ditambahkan minimal 16 karakter sebagai pengaman dasar meskipun tanpa regex

---

## Sprint 4 (Hari 25–38): Verifikasi Akun dan Pemilihan Paket Bantuan
**Sprint Goal:** Admin memverifikasi akun calon OTA; OTA yang sudah terverifikasi dapat memilih paket bantuan.

### 1. Sprint Planning
**PB-02:** Sebagai Admin, saya ingin dapat memverifikasi akun calon orang tua asuh (berdasarkan KTP/Identitas) agar data donatur terjamin validitasnya.
**PB-06:** Sebagai Orang Tua Asuh, saya ingin dapat memilih paket bantuan (misal: beasiswa pendidikan, biaya hidup, atau kesehatan) untuk anak asuh yang saya pilih.

**Tugas Teknis:**
- Migration menambah kolom `is_verified` pada tabel users
- Halaman admin: daftar pengguna dengan status verifikasi, pratinjau KTP (modal), tombol "Verifikasi" / "Tolak"
- Paket bantuan: Bronze (Rp100.000 — buku dan alat tulis), Silver (Rp250.000 — SPP dan uang saku), Gold (Rp500.000 — penuh)
- Halaman pilih paket: pilih anak, pilih paket, konfirmasi, unggah bukti atau pilih metode bayar
- Migration tabel `sponsorships`: user_id, foster_child_id, package, amount, status, expires_at

### 2. Daily Scrum

**Hari 25 — Daftar Pengguna Menunggu Verifikasi**
> **Raka:** "Kemarin saya membuat migration untuk menambah kolom `is_verified` pada tabel users dan halaman daftar pengguna yang menunggu verifikasi untuk admin."
>
> **Raka:** "Hari ini saya akan membuat modal pratinjau KTP dan tombol verifikasi atau tolak."
>
> **Raka:** "KTP disimpan menggunakan Storage, sehingga saat pratinjau harus menggunakan asset(). Hal ini sudah dipastikan aman."

**Hari 29 — Paket Bantuan**
> **Raka:** "Modal pratinjau KTP serta tombol verifikasi atau tolak sudah selesai. Admin dapat melihat KTP, menyetujui, atau menolak dengan catatan."
>
> **Raka:** "Hari ini mulai mengerjakan halaman pilih paket bantuan — memilih anak terlebih dahulu, kemudian memilih paket."
>
> **Raka:** "Tidak ada kendala, hanya masih mempertimbangkan apakah paket akan di-hardcode pada view atau dibuat tabel tersendiri. Sementara menggunakan hardcode."

**Hari 34 — Formulir Sponsor**
> **Raka:** "Halaman sponsor sudah selesai — pengguna memilih anak, memilih paket (Bronze/Silver/Gold), mengisi data diri, dan metode pembayaran. Pemilihan paket menggunakan kartu interaktif."
>
> **Raka:** "Hari ini akan mengintegrasikan tabel sponsorship — menyimpan data saat dikirim, status pending terlebih dahulu."
>
> **Raka:** "Validasi jumlah nominal perlu disesuaikan — nominal harus Rp100.000, Rp250.000, atau Rp500.000 sesuai paket."

**Hari 37 — Finalisasi**
> **Raka:** "Sponsorship sudah tersimpan dengan status pending. Pengguna dapat melihat riwayat permohonan sponsorship pada dashboard."
>
> **Raka:** "Hari ini melakukan pengujian alur lengkap: registrasi, verifikasi email, menunggu verifikasi admin, memilih anak, memilih paket, mengirim sponsorship."
>
> **Raka:** "Tidak ada kendala. Semua alur sudah terhubung dengan baik."

### 3. Sprint Review

**Demonstrasi:**
Admin membuka menu "Verifikasi Donatur" — melihat daftar pengguna yang baru registrasi dengan status "Menunggu". Klik "Lihat KTP", muncul modal dengan foto KTP. Klik "Verifikasi" — status berubah menjadi "Terverifikasi". Dari sisi OTA: setelah akun diverifikasi, dapat membuka halaman sponsor, memilih anak yang tersedia, memilih paket Bronze/Silver/Gold, mengisi data donor, dan mengirim. Sponsorship tercatat dengan status "Menunggu".

**Umpan Balik:**
> **Pengurus Yayasan:** "Alurnya sudah sesuai. Akan tetapi setelah OTA memilih paket, sebaiknya langsung ditampilkan rekening tujuan yayasan agar mereka dapat mentransfer."

**Tindakan:**
- Menambahkan informasi rekening yayasan (nama bank, nomor rekening, atas nama) pada halaman setelah mengirim sponsorship
- Mengirim notifikasi WhatsApp ke OTA saat akun berhasil diverifikasi

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Modal pratinjau KTP memudahkan admin melakukan verifikasi tanpa membuka tab baru
- Paket bantuan dengan kartu interaktif tampak menarik
- Sponsorship tersimpan dengan status pending, siap divalidasi admin

**Hal yang perlu diperbaiki:**
- Rekening tujuan yayasan belum muncul setelah sponsorship dikirim — harus segera ditambahkan
- Belum ada notifikasi WhatsApp saat akun diverifikasi

---

## Sprint 5 (Hari 39–52): Unggah Bukti Transfer dan Validasi Pembayaran
**Sprint Goal:** OTA dapat mengunggah bukti transfer; admin dapat memvalidasi dan mengubah status pembayaran.

### 1. Sprint Planning
**PB-07:** Sebagai Orang Tua Asuh, saya ingin dapat mengunggah bukti transfer donasi bulanan agar pihak yayasan dapat memprosesnya.
**PB-08:** Sebagai Admin, saya ingin dapat memvalidasi pembayaran donasi yang masuk dan mengubah statusnya menjadi "Lunas" atau "Berhasil".

**Tugas Teknis:**
- Migration menambah kolom `payment_proof` (string, nullable), `transfer_date` (date), dan `notes` (text) pada tabel sponsorship
- Halaman OTA: formulir unggah bukti transfer (file jpg/png/pdf maksimal 2MB), input tanggal transfer, pratinjau rekening tujuan
- Halaman admin: daftar sponsorship pending dengan pratinjau bukti, tombol Setujui/Tolak, dan catatan
- Logika setujui: memperbarui status sponsorship menjadi 'success', mengatur starts_at dan expires_at, mengubah status anak menjadi 'Diasuh'
- Mengirim notifikasi WhatsApp ke OTA saat status berubah

### 2. Daily Scrum

**Hari 40 — Formulir Unggah Bukti**
> **Raka:** "Kemarin saya menambahkan migration untuk kolom payment_proof, transfer_date, dan notes pada tabel sponsorship. Formulir unggah bukti transfer sudah selesai."
>
> **Raka:** "Hari ini saya memasang validasi file — hanya jpg, png, pdf, maksimal 2MB. Juga menampilkan informasi rekening yayasan."
>
> **Raka:** "Ukuran maksimal 2MB sesuai saran pengurus yayasan. Kapasitas tersebut cukup jelas untuk foto bukti transfer."

**Hari 44 — Halaman Validasi Admin**
> **Raka:** "Informasi rekening yayasan sudah tampil. Formulir unggah dengan pratinjau file juga berfungsi."
>
> **Raka:** "Hari ini mulai membuat halaman admin — daftar sponsorship pending, pratinjau bukti dalam modal, tombol setujui atau tolak."
>
> **Raka:** "Diperlukan pop-up konfirmasi sebelum menyetujui agar admin tidak salah mengeklik."

**Hari 48 — Notifikasi WA dan Logika Setujui**
> **Raka:** "Modal pratinjau bukti dan konfirmasi setujui atau tolak sudah selesai. Logika menyetujui akan memperbarui status anak menjadi Diasuh."
>
> **Raka:** "Hari ini mengintegrasikan Fonnte — mengirim WhatsApp ke OTA saat sponsorship disetujui atau ditolak."
>
> **Raka:** "Token Fonnte harus dipastikan kebenarannya. Masih menunggu konfigurasi .env dari tim infrastruktur."

**Hari 51 — Pengujian Akhir**
> **Raka:** "Notifikasi WhatsApp berhasil. OTA menerima pesan 'Selamat! Sponsorship Anda untuk {anak} telah disetujui' saat disetujui, dan pesan pemberitahuan saat ditolak."
>
> **Raka:** "Hari ini melakukan pengujian akhir seluruh skenario: unggah bukti, pending, setujui atau tolak, WhatsApp diterima."
>
> **Raka:** "Semua berjalan lancar. Hanya perlu memastikan nomor WhatsApp OTA benar saat pendaftaran."

### 3. Sprint Review

**Demonstrasi:**
OTA membuka halaman sponsorship pending, mengunggah bukti transfer format jpg/png/pdf dan mengisi tanggal transfer. Muncul notifikasi "Bukti transfer berhasil diunggah". Admin membuka menu "Validasi Pembayaran" — melihat daftar sponsorship pending. Mengeklik salah satu, muncul modal pratinjau bukti transfer. Admin mengeklik "Setujui" muncul pop-up konfirmasi. Setelah disetujui, status sponsorship berubah menjadi "Success", status anak berubah menjadi "Diasuh", dan OTA menerima pesan WhatsApp: "Sponsorship Anda untuk {nama anak} telah disetujui. Terima kasih!"

**Umpan Balik:**
> **Pengurus Yayasan:** "Proses validasinya sudah bagus dan notifikasi WhatsApp berfungsi. Mohon ditambahkan catatan penolakan agar OTA mengetahui alasan ditolak."

**Tindakan:**
- Menambahkan kolom `rejection_reason` pada formulir tolak admin — alasan dikirim melalui WhatsApp ke OTA
- Menampilkan alasan penolakan pada halaman riwayat OTA

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Pop-up konfirmasi sebelum menyetujui mencegah kesalahan manusia
- Notifikasi WhatsApp secara langsung meningkatkan kepercayaan OTA
- Pratinjau bukti dalam modal memudahkan admin tanpa membuka tab baru

**Hal yang perlu diperbaiki:**
- Alasan penolakan belum tersedia — perlu ditambahkan pada formulir tolak admin
- Ukuran file maksimal 2MB mungkin terlalu kecil untuk hasil pindaian PDF — perlu dievaluasi menjadi 5MB

---

## Sprint 6 (Hari 53–65): Laporan Perkembangan Anak
**Sprint Goal:** Admin dapat mengunggah laporan perkembangan anak; OTA dapat melihat laporan anak yang disponsori.

### 1. Sprint Planning
**PB-09:** Sebagai Admin, saya ingin dapat mengunggah laporan perkembangan anak (seperti nilai rapor, foto kegiatan, kondisi kesehatan) ke dalam sistem.
**PB-10:** Sebagai Orang Tua Asuh, saya ingin dapat melihat laporan perkembangan khusus untuk anak asuh yang saya sponsori agar saya mengetahui dampak bantuan yang saya berikan.

**Tugas Teknis:**
- Migration tabel `child_developments`: foster_child_id, sponsorship_id, title, description, photo, tanggal
- Halaman admin: formulir laporan dengan memilih anak (hanya yang berstatus Diasuh), input judul, deskripsi, foto, tanggal
- Halaman OTA: daftar laporan per anak yang disponsori, dengan galeri foto
- Filter: OTA hanya dapat melihat laporan untuk anak yang sedang atau pernah disponsori
- Notifikasi WhatsApp saat admin mengunggah laporan baru

### 2. Daily Scrum

**Hari 53 — Migration Child Developments**
> **Raka:** "Kemarin saya membuat migration child_developments — kolom title, description, photo, tanggal, serta foreign key ke foster_child_id dan sponsorship_id."
>
> **Raka:** "Hari ini membuat formulir admin — memilih anak (filter hanya yang berstatus Diasuh), mengisi judul, deskripsi, mengunggah foto, memilih tanggal."
>
> **Raka:** "Tidak ada kendala. Hanya nanti perlu data contoh untuk pengujian."

**Hari 58 — Halaman Laporan OTA**
> **Raka:** "Formulir admin sudah selesai — memilih anak dari dropdown, mengunggah foto, judul, deskripsi. Foto dapat lebih dari satu."
>
> **Raka:** "Hari ini membuat halaman OTA — daftar laporan per anak yang disponsori, menampilkan galeri foto."
>
> **Raka:** "Kendala: data masih kosong. Saya perlu membuat seeder agar terdapat data untuk menguji tampilan."

**Hari 61 — Seeder dan Notifikasi WA**
> **Raka:** "Halaman OTA sudah selesai — OTA dapat melihat laporan lengkap dengan galeri foto. Seeder sudah dibuat."
>
> **Raka:** "Hari ini memasang notifikasi WhatsApp — saat admin mengunggah laporan, OTA mendapatkan notifikasi 'Laporan perkembangan {anak} telah diunggah'."
>
> **Raka:** "Tidak ada kendala. Tinggal mengintegrasikan dengan Fonnte yang sudah terpasang dari Sprint 5."

**Hari 64 — Pengujian Akhir**
> **Raka:** "Notifikasi WhatsApp untuk laporan baru berhasil. OTA mendapatkan tautan langsung ke halaman laporan."
>
> **Raka:** "Hari ini melakukan pengujian seluruh skenario: mengunggah laporan, notifikasi WA, OTA membuka dan melihat galeri foto."
>
> **Raka:** "Semua berjalan dengan baik. Akan tetapi galeri foto masih sederhana — perlu lightbox agar dapat diklik dan diperbesar."

### 3. Sprint Review

**Demonstrasi:**
Admin membuka menu "Laporan Perkembangan", memilih anak yang sudah diasuh, mengisi judul "Perkembangan Bulan Ini", deskripsi nilai rapor dan foto kegiatan. Setelah disimpan, OTA menerima WhatsApp: "📋 Laporan perkembangan Ani (6 Thn) telah diunggah!". OTA membuka dashboard, melihat laporan dengan galeri foto dan deskripsi lengkap.

**Umpan Balik:**
> **Pengurus Yayasan:** "Fitur laporannya sangat membantu. Akan tetapi galeri foto mohon dapat diklik untuk diperbesar agar OTA dapat melihat foto lebih detail."

**Tindakan:**
- Menambahkan lightbox atau zoom pada foto di galeri laporan OTA
- Menambahkan tanggal laporan pada daftar ringkasan agar OTA mengetahui laporan terbaru

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Filter anak Diasuh pada dropdown admin mencegah laporan untuk anak yang belum disponsori
- Notifikasi WhatsApp membuat OTA langsung mengetahui adanya laporan baru
- Seeder membantu pengujian tampilan tanpa data manual

**Hal yang perlu diperbaiki:**
- Galeri foto memerlukan lightbox agar dapat diperbesar
- Daftar laporan OTA belum menampilkan tanggal — perlu ditambahkan

---

## Sprint 7 (Hari 66–75): Riwayat Donasi dan Notifikasi WhatsApp
**Sprint Goal:** OTA dapat melihat riwayat donasi; sistem mengirim notifikasi WhatsApp otomatis.

### 1. Sprint Planning
**PB-11:** Sebagai Orang Tua Asuh, saya ingin dapat melihat riwayat seluruh donasi yang pernah saya berikan.
**PB-12 (Notifikasi):** Sistem mengirim notifikasi WhatsApp saat transaksi dikonfirmasi dan saat laporan baru diunggah.

**Tugas Teknis:**
- Halaman riwayat donasi OTA: daftar semua donasi (donasi kampanye dan sponsorship) dengan status, filter (semua/success/pending/gagal)
- Tabel ringkasan: total donasi, total sponsorship aktif
- Filter status: tab Semua, Berhasil, Menunggu, Gagal
- Notifikasi WhatsApp pengingat H-3 sebelum sponsorship berakhir
- Notifikasi WhatsApp saat sponsorship otomatis kedaluwarsa

### 2. Daily Scrum

**Hari 66 — Halaman Riwayat**
> **Raka:** "Kemarin saya membuat route dan view halaman riwayat donasi pada `/dashboard/rekap`. Menampilkan semua donasi dan sponsorship."
>
> **Raka:** "Hari ini menambahkan filter status menggunakan tab — Semua, Berhasil, Menunggu, Gagal. Juga menambahkan ringkasan total."
>
> **Raka:** "Sponsorship dan donasi berada pada tabel yang berbeda. Saya menggabungkannya menggunakan collection agar tampil dalam satu tabel."

**Hari 70 — Filter dan Ringkasan**
> **Raka:** "Filter status menggunakan tab pill sudah selesai. Ringkasan total donasi dan sponsorship aktif juga tampil."
>
> **Raka:** "Hari ini mulai memasang pengingat WhatsApp — menjadwalkan notifikasi H-3 sebelum masa sponsorship berakhir."
>
> **Raka:** "Pengingat otomatis menggunakan Laravel scheduler. Akan tetapi pada shared hosting, cron job perlu dikonfigurasi."

**Hari 73 — Scheduler dan Kedaluwarsa**
> **Raka:** "Command `sponsorship:remind` sudah siap — mengirim WhatsApp H-3. Juga command `sponsorship:expire` untuk memperbarui status menjadi kedaluwarsa."
>
> **Raka:** "Hari ini menguji scheduler secara manual — menjalankan command dan memeriksa apakah WhatsApp diterima."
>
> **Raka:** "Tidak ada kendala. Pengingat WhatsApp berhasil terkirim ke nomor pengujian."

**Hari 75 — Finalisasi**
> **Raka:** "Scheduler sudah siap. Tinggal konfigurasi cron pada server. Semua notifikasi WhatsApp sudah terintegrasi: setujui, tolak, laporan baru, pengingat H-3, dan kedaluwarsa."
>
> **Raka:** "Hari ini melakukan pengujian end-to-end: melihat riwayat, filter, notifikasi WhatsApp untuk setujui, tolak, dan pengingat."
>
> **Raka:** "Semua berfungsi. Siap memasuki Sprint 8."

### 3. Sprint Review

**Demonstrasi:**
OTA membuka menu "Rekap Donasi" — melihat ringkasan: total donasi Rp1.200.000, 2 sponsorship aktif. Tabel riwayat menampilkan semua transaksi (donasi dan sponsorship) dengan status badge. Filter tab: Semua, Berhasil, Menunggu, Gagal berfungsi. Untuk sponsorship yang akan kedaluwarsa H-3, OTA menerima WhatsApp: "⏰ Sponsorship Anda untuk {anak} akan berakhir 3 hari lagi. Silakan lakukan perpanjangan."

**Umpan Balik:**
> **Pengurus Yayasan:** "Riwayat donasi sudah informatif. Notifikasi pengingatnya juga sangat membantu. Mohon pada tabel riwayat ditambahkan tombol untuk melihat invoice."

**Tindakan:**
- Menambahkan tombol "Lihat Invoice" pada setiap baris riwayat donasi yang berstatus success
- Menambahkan tombol "Perpanjang" pada sponsorship yang mendekati kedaluwarsa

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Filter status dengan tab pill memudahkan OTA mencari transaksi tertentu
- Scheduler untuk pengingat H-3 dan kedaluwarsa berjalan otomatis
- Semua notifikasi WhatsApp terkonsolidasi dalam satu sistem

**Hal yang perlu diperbaiki:**
- Belum ada tautan invoice pada tabel riwayat — perlu ditambahkan
- Scheduler cron job memerlukan dokumentasi agar tim operasional dapat melakukan pengaturan di server

---

## Sprint 8 (Hari 76–92): Pengujian, UAT, dan Serah Terima
**Sprint Goal:** Sistem siap diimplementasikan — pengujian menyeluruh, UAT oleh yayasan, dan serah terima final.

### 1. Sprint Planning
**Tugas Teknis:**
- Menyusun skenario black-box testing per modul (Sprint 1–7)
- Regression testing setelah perbaikan berdasarkan umpan balik
- User Acceptance Test (UAT) oleh admin dan pengurus yayasan
- Dokumentasi teknis dan panduan penggunaan
- Berita Acara Serah Terima (BAST)

### 2. Daily Scrum

**Hari 78 — Black-box Testing**
> **Raka:** "Kemarin saya menyusun skenario pengujian — total 45 skenario untuk 7 sprint. Mulai dari registrasi sampai notifikasi WhatsApp."
>
> **Raka:** "Hari ini melaksanakan pengujian modul 1–4: data anak, filter, autentikasi, verifikasi, paket."
>
> **Raka:** "Ditemukan gangguan pada filter laporan perkembangan — dropdown anak tidak muncul. Langsung diperbaiki."

**Hari 83 — Regression dan Persiapan UAT**
> **Raka:** "Pengujian modul 1–4 selesai, tiga gangguan minor ditemukan dan sudah diperbaiki. Pengujian modul 5–7 juga sudah selesai — semua fungsi berjalan."
>
> **Raka:** "Hari ini melakukan regression testing untuk memastikan perbaikan gangguan tidak memengaruhi fitur lain. Juga menyiapkan lingkungan UAT."
>
> **Raka:** "Tidak ada kendala. Regression aman."

**Hari 87 — Pelaksanaan UAT**
> **Raka:** "Kemarin UAT bersama admin yayasan. Mereka mencoba semua fitur dari sisi admin: CRUD anak, verifikasi pengguna, validasi pembayaran, unggah laporan."
>
> **Raka:** "Hari ini UAT dari sisi OTA: registrasi, memilih paket, unggah bukti, melihat laporan, riwayat donasi."
>
> **Raka:** "Tidak ada kendala berarti. Hanya mereka meminta beberapa teks dibuat lebih ramah pengguna."

**Hari 91 — Finalisasi dan BAST**
> **Raka:** "Semua umpan balik UAT sudah diterapkan. Teks-teks yang diminta diperhalus sudah diganti. Dokumentasi pengguna juga sudah disiapkan."
>
> **Raka:** "Hari ini menandatangani BAST bersama pengurus yayasan. Sistem resmi siap digunakan."
>
> **Raka:** "Selesai. 92 hari sesuai rencana. Sebelas Product Backlog seluruhnya selesai."

### 3. Sprint Review

**Demonstrasi:**
Skenario end-to-end dari registrasi OTA, verifikasi email, verifikasi akun oleh admin, memilih anak, memilih paket, mengunggah bukti transfer, disetujui admin, status anak menjadi Diasuh, OTA melihat laporan perkembangan, dan menerima notifikasi WhatsApp. Semua fitur berjalan tanpa kesalahan.

**Umpan Balik:**
> **Pengurus Yayasan:** "Sistem sudah siap digunakan. Semua fitur yang direncanakan berfungsi dengan baik. Kami mengapresiasi kerja keras tim pengembang. Semoga ke depannya dapat ditambahkan fitur dashboard statistik yang lebih interaktif."

**Tindakan:**
- Menandatangani BAST sebagai tanda serah terima resmi
- Menyerahkan dokumentasi teknis dan panduan pengguna kepada admin yayasan
- Mencatat saran fitur dashboard statistik sebagai daftar tunggu pengembangan selanjutnya

### 4. Sprint Retrospective

**Hal yang sudah baik:**
- Sebelas Product Backlog selesai tepat waktu dalam 92 hari
- UAT berjalan lancar tanpa perbaikan mayor
- Dokumentasi dan BAST lengkap
- Kerja sama tim solid dengan komunikasi yang baik

**Hal yang perlu diperbaiki:**
- Pengujian sebaiknya tidak hanya black-box — automated testing perlu ditambahkan pada sprint berikutnya
- Beberapa gangguan minor dapat dicegah dengan peninjauan kode yang lebih ketat sebelum masuk sprint review
- Dokumentasi teknis sebaiknya dibuat bertahap per sprint, tidak menumpuk pada Sprint 8

---

## Lampiran: Pemetaan Sprint

| Sprint | Hari | PB | Modul |
|--------|------|----|-------|
| 1 | 1–7 | PB-04 | Manajemen Anak Asuh (Admin) |
| 2 | 8–14 | PB-05 | Manajemen Anak Asuh (Publik) |
| 3 | 15–24 | PB-01, PB-03 | Autentikasi |
| 4 | 25–38 | PB-02, PB-06 | Verifikasi & Paket |
| 5 | 39–52 | PB-07, PB-08 | Pembayaran & Validasi |
| 6 | 53–65 | PB-09, PB-10 | Perkembangan Anak |
| 7 | 66–75 | PB-11 + Notifikasi | Riwayat & WA |
| 8 | 76–92 | — | Pengujian, UAT, BAST |

**Total: 92 hari — 11 Product Backlog — 5 Modul**
