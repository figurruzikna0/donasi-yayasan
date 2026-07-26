# Modul Donasi — Product Backlog

Fitur-fitur khusus **Donasi Campaign**. Untuk backlog bersama (auth, profil, berita, user, dll) lihat `docs/bersama.md`.

| ID | User Story | Prioritas |
|----|-----------|-----------|
| PB-D-01 | Sebagai Admin, saya ingin mengelola campaign donasi (CRUD + upload gambar) untuk menampilkan program penggalangan dana. | Tinggi |
| PB-D-02 | Sebagai Admin, saya ingin melihat rekap donasi (filter, search, export CSV/PDF) untuk pelaporan keuangan. | Sedang |
| PB-D-03 | Sebagai Donatur, saya ingin melihat detail campaign sebelum melakukan donasi. | Tinggi |
| PB-D-04 | Sebagai Donatur, saya ingin melakukan donasi ke campaign dengan memilih nominal (min Rp 1.000) dan mengupload bukti transfer. | Tinggi |
| PB-D-05 | Sebagai Admin, saya ingin menyetujui atau menolak donasi yang masuk agar dana dapat diverifikasi. | Tinggi |
| PB-D-06 | Sebagai Donatur, saya ingin mendapat notifikasi WhatsApp saat donasi dikonfirmasi atau ditolak. | Sedang |
| PB-D-07 | Sebagai Donatur, saya ingin melihat invoice donasi (HTML + download PDF). | Tinggi |
| PB-D-08 | Sebagai Donatur, saya ingin melihat riwayat donasi pribadi di dashboard. | Sedang |
| PB-D-09 | Sebagai Admin, saya ingin mengexport data donasi ke CSV/PDF. | Sedang |

### Ringkasan

| Aspek | Detail |
|-------|--------|
| **Entitas Utama** | `campaigns`, `donations` |
| **Controller** | `CampaignController`, `DonationController`, `TransactionController` |
| **Metode Pembayaran** | Transfer Bank Manual (BSI) — upload bukti transfer, admin validasi |
| **Notifikasi** | WA via Fonnte saat approve/reject |
| **Output Digital** | Invoice HTML + PDF (DomPDF) |
