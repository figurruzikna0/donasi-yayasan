# Modul Donasi — Product Backlog

Fitur-fitur khusus **Donasi Campaign**. Untuk backlog bersama (auth, profil, berita, user, dll) lihat `docs/bersama.md`.

| ID | User Story | Prioritas |
|----|-----------|-----------|
| PB-D-01 | Sebagai Admin, saya ingin mengelola campaign donasi (CRUD + upload gambar) untuk menampilkan program penggalangan dana. | Tinggi |
| PB-D-02 | Sebagai Admin, saya ingin melihat rekap donasi (filter, search, export CSV/PDF) untuk pelaporan keuangan. | Sedang |
| PB-D-03 | Sebagai Donatur, saya ingin melihat detail campaign sebelum melakukan donasi. | Tinggi |
| PB-D-04 | Sebagai Donatur, saya ingin melakukan donasi ke campaign dengan memilih nominal (min Rp 1.000) dan metode pembayaran via Midtrans. | Tinggi |
| PB-D-05 | Sebagai Donatur, saya ingin melihat invoice donasi (HTML + download PDF). | Tinggi |

### Ringkasan

| Aspek | Detail |
|-------|--------|
| **Entitas Utama** | `campaigns`, `donations` |
| **Controller** | `CampaignController`, `DonationController@store()/callback()` |
| **Payment Gateway** | Midtrans Snap (semua channel: VA, QRIS, GoPay, ShopeePay, dll) |
| **Notifikasi** | WA + Email saat status → `success` |
| **Output Digital** | Invoice HTML + PDF (DomPDF) |
