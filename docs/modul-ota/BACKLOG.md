# Modul Orang Tua Asuh (OTA) — Product Backlog

Fitur-fitur khusus **Sponsorship & Perkembangan Anak Asuh**. Untuk backlog bersama (auth, profil, berita, user, dll) lihat `docs/bersama.md`.

| ID | User Story | Prioritas |
|----|-----------|-----------|
| PB-O-01 | Sebagai Admin, saya ingin mengelola data anak asuh (CRUD + foto, status Tersedia/Diasuh) untuk menampilkan profil calon anak asuh. | Tinggi |
| PB-O-02 | Sebagai Admin, saya ingin mengelola transaksi sponsorship (lihat, setujui, hapus, sinkronisasi massal) untuk mengkonfirmasi komitmen OTA. | Tinggi |
| PB-O-03 | Sebagai Admin, saya ingin menyetujui sponsorship secara manual agar anak asuh berstatus Diasuh. | Tinggi |
| PB-O-04 | Sebagai Admin, saya ingin mengelola laporan perkembangan anak asuh (CRUD + upload foto) untuk dikirim ke donatur OTA. | Tinggi |
| PB-O-05 | Sebagai Admin, saya ingin melihat rekap orang tua asuh (filter status, export CSV/PDF) untuk memantau komitmen sponsorship. | Sedang |
| PB-O-06 | Sebagai Admin, saya ingin form laporan perkembangan anak terkunci jika status sponsorship belum success. | Sedang |
| PB-O-07 | Sebagai Admin, saya dapat mengisi perkembangan anak hanya jika sponsorship berstatus Success. | Sedang |
| PB-O-08 | Sebagai Donatur, saya ingin melihat profil anak asuh sebelum melakukan sponsorship. | Tinggi |
| PB-O-09 | Sebagai Donatur, saya ingin menjadi Orang Tua Asuh dengan memilih anak, paket komitmen (min Rp 100rb, maks Rp 500rb), dan metode pembayaran via Midtrans. | Tinggi |
| PB-O-10 | Sebagai Donatur, saya ingin melihat invoice sponsorship (HTML + download PDF). | Tinggi |
| PB-O-11 | Sebagai Donatur, saya ingin melihat laporan perkembangan anak asuh yang saya sponsori (download PDF). | Tinggi |
| PB-O-12 | Sebagai Sistem, saya mengirim notifikasi WhatsApp + foto ke donatur saat admin mengisi laporan perkembangan anak. | Tinggi |
| PB-O-13 | Sebagai Sistem, saya mengirim notifikasi WhatsApp H-3 sebelum masa sponsorship berakhir. | Sedang |

### Ringkasan

| Aspek | Detail |
|-------|--------|
| **Entitas Utama** | `foster_children`, `sponsorships`, `child_developments` |
| **Controller** | `FosterChildController`, `DonationController@sponsorStore()/callback()`, `ChildDevelopmentController` |
| **Payment Gateway** | Midtrans Snap (sama seperti donasi) |
| **Notifikasi** | WA + Email saat status → `success`; WA + foto saat laporan perkembangan; WA reminder H-3; email reminder H-7 |
| **Masa Berlaku** | 1 bulan (dari `starts_at`), auto-expired via cronjob |
| **Output Digital** | Invoice HTML + PDF (DomPDF), Laporan perkembangan PDF |
