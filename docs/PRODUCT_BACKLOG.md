# Product Backlog — Donasi Yayasan Baitul Yatim

## Aktor

| Aktor | Deskripsi |
|-------|-----------|
| **Admin** | Pengelola sistem yayasan (role `admin`) |
| **Donatur** | Pengguna terdaftar yang melakukan donasi/sponsorship (role `donatur`) |
| **Tamuu** | Pengunjung web tanpa login |
| **Sistem** | Proses otomatis (Midtrans callback, cronjob, notifikasi) |

## Backlog

### 🔐 Admin

| ID | User Story | Prioritas |
|----|-----------|-----------|
| PB-01 | Sebagai Admin, saya ingin login ke dashboard dengan aman untuk mengelola sistem. | Tinggi |
| PB-02 | Sebagai Admin, saya ingin melihat dashboard ringkasan (total dana, campaign aktif, statistik anak asuh, cashflow 12 bulan) untuk memantau kinerja yayasan. | Tinggi |
| PB-03 | Sebagai Admin, saya ingin mengelola profil yayasan (nama, logo, alamat, kontak, visi-misi, legalitas) agar informasi yayasan selalu terkini. | Tinggi |
| PB-04 | Sebagai Admin, saya ingin mengelola pendiri yayasan (tambah/hapus) untuk menampilkan struktur pengurus. | Tinggi |
| PB-05 | Sebagai Admin, saya ingin mengelola campaign donasi (CRUD + upload gambar) untuk menampilkan program penggalangan dana. | Tinggi |
| PB-06 | Sebagai Admin, saya ingin mengelola berita/kegiatan (CRUD + upload foto, draft/publish) untuk menginformasikan kegiatan yayasan. | Tinggi |
| PB-07 | Sebagai Admin, saya ingin mengelola data anak asuh (CRUD + foto, status Tersedia/Diasuh) untuk menampilkan profil calon anak asuh. | Tinggi |
| PB-08 | Sebagai Admin, saya ingin mengelola transaksi donasi & sponsorship (lihat, setujui, hapus, sinkronisasi massal dengan Midtrans) untuk mengkonfirmasi pembayaran. | Tinggi |
| PB-09 | Sebagai Admin, saya ingin menyetujui sponsorship secara manual agar anak asuh berstatus Diasuh. | Tinggi |
| PB-10 | Sebagai Admin, saya ingin mengelola laporan perkembangan anak asuh (CRUD + upload foto) untuk dikirim ke donatur OTA. | Tinggi |
| PB-11 | Sebagai Admin, saya ingin mengelola data pengguna (lihat, edit, hapus donatur) untuk memelihara data user. | Tinggi |
| PB-12 | Sebagai Admin, saya ingin melihat rekap donasi (filter, search, export CSV/PDF) untuk pelaporan keuangan. | Sedang |
| PB-13 | Sebagai Admin, saya ingin melihat rekap donatur (export CSV/PDF) untuk data supporter. | Sedang |
| PB-14 | Sebagai Admin, saya ingin melihat rekap orang tua asuh (filter status, export CSV/PDF) untuk memantau komitmen sponsorship. | Sedang |
| PB-15 | Sebagai Admin, saya ingin form laporan perkembangan anak terkunci jika donasi sponsor belum valid. | Sedang |
| PB-16 | Sebagai Admin, saya dapat mengisi perkembangan anak hanya jika status sponsorship Success. | Sedang |

### 💳 Donatur

| ID | User Story | Prioritas |
|----|-----------|-----------|
| PB-17 | Sebagai Donatur, saya ingin mendaftar akun (nama, email, password, no HP, alamat, NIK) untuk dapat berdonasi. | Tinggi |
| PB-18 | Sebagai Donatur, saya ingin login ke akun saya dengan aman. | Tinggi |
| PB-19 | Sebagai Donatur, saya ingin melihat dashboard berisi campaign, berita, anak asuh, dan riwayat donasi saya. | Tinggi |
| PB-20 | Sebagai Donatur, saya ingin melihat profil anak asuh sebelum melakukan sponsorship. | Tinggi |
| PB-21 | Sebagai Donatur, saya ingin melakukan donasi ke campaign dengan memilih nominal dan metode pembayaran (Midtrans: VA, QRIS, GoPay, ShopeePay, dll). | Tinggi |
| PB-22 | Sebagai Donatur, saya ingin menjadi Orang Tua Asuh (sponsorship) dengan memilih anak, paket komitmen, dan metode pembayaran. | Tinggi |
| PB-23 | Sebagai Donatur, saya ingin melihat invoice donasi/sponsorship (HTML + download PDF). | Tinggi |
| PB-24 | Sebagai Donatur, saya ingin melihat laporan perkembangan anak asuh yang saya sponsori (download PDF). | Tinggi |
| PB-25 | Sebagai Donatur, saya ingin melihat riwayat dan rekap donasi/sponsorship saya. | Sedang |
| PB-26 | Sebagai Donatur, saya ingin mengedit profil akun saya (termasuk upload avatar). | Sedang |
| PB-27 | Sebagai Donatur, saya ingin mengubah password akun saya. | Sedang |
| PB-28 | Sebagai Donatur, saya ingin menghapus akun saya sendiri. | Rendah |

### 👤 Tamuu (Public)

| ID | User Story | Prioritas |
|----|-----------|-----------|
| PB-29 | Sebagai Tamuu, saya ingin melihat halaman utama yayasan (campaign aktif, berita terbaru, statistik) untuk mengetahui program yayasan. | Tinggi |
| PB-30 | Sebagai Tamuu, saya ingin melihat profil yayasan (sejarah, visi-misi, legalitas). | Tinggi |
| PB-31 | Sebagai Tamuu, saya ingin melihat daftar pengurus/pendiri yayasan. | Tinggi |
| PB-32 | Sebagai Tamuu, saya ingin membaca berita/kegiatan yayasan. | Tinggi |
| PB-33 | Sebagai Tamuu, saya ingin mendaftar menjadi donatur. | Tinggi |
| PB-34 | Sebagai Tamuu, saya ingin mereset password jika lupa. | Sedang |

### ⚙️ Sistem (Otomatis)

| ID | User Story | Prioritas |
|----|-----------|-----------|
| PB-35 | Sebagai Sistem, saya menerima notifikasi pembayaran dari Midtrans (callback) dan memperbarui status transaksi secara otomatis. | Tinggi |
| PB-36 | Sebagai Sistem, saya mengirim email konfirmasi donasi/sponsorship berhasil ke donatur. | Tinggi |
| PB-37 | Sebagai Sistem, saya mengirim notifikasi WhatsApp ke donatur saat donasi/sponsorship berhasil dikonfirmasi. | Tinggi |
| PB-38 | Sebagai Sistem, saya mengirim notifikasi WhatsApp + foto ke donatur saat admin mengisi laporan perkembangan anak. | Tinggi |
| PB-39 | Sebagai Sistem, saya mengirim notifikasi WhatsApp H-3 sebelum masa sponsorship berakhir. | Sedang |
| PB-40 | Sebagai Sistem, saya mengirim email pengingat untuk sponsorship yang akan kadaluwarsa (H-7). | Sedang |
| PB-41 | Sebagai Sistem, saya memperbarui status sponsorship menjadi expired dan mengembalikan status anak menjadi Tersedia jika masa berlaku habis. | Sedang |
