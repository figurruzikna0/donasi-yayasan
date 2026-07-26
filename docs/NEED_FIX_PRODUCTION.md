# Yang Perlu Diperbaiki — Production Readiness

> Update terakhir: 26 Juli 2026 (sesi maintenance ke-3)
> Status: **Semua kode sudah siap. Tinggal provisioning server.**

---

## 🔴 WAJIB — Harus Ada Sebelum Go-Live

### 1. Domain & SSL
APP_URL masih `http://127.0.0.1:8000`. Publik tidak bisa akses.

**To-do:**
- Beli domain (misal `donasi.baitulyatim.or.id`)
- Setup hosting (VPS / shared hosting support Laravel)
- Install SSL (Let's Encrypt gratis, atau auto-SSL dari hosting)
- Update `.env`:
  ```ini
  APP_URL=https://donasi.baitulyatim.or.id
  APP_ENV=production
  APP_DEBUG=false
  ```

---

### 2. SESSION_SECURE_COOKIE=true
Masih di-comment. Jangan aktifkan sebelum HTTPS jalan.

**To-do:**
- Setelah HTTPS aktif → hapus `#` di depan `SESSION_SECURE_COOKIE=true` di `.env`

---

### 3. Token Fonnte
Token lama (`wq7ZjV3okd9ewmPdBYkt`) sudah di-revoke dari dashboard Fonnte. ✅ Aman.

---

## 🟠 Server Setup — Jalanin di VPS/Hosting

### 4. Storage Link
```bash
php artisan storage:link
```
Biar foto logo, anak asuh, bukti transfer bisa diakses publik.

### 5. Optimize
```bash
php artisan optimize
```
Cache config, route, view — biar loading cepet.

### 6. Cron Job
```
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```
Buat expire campaign otomatis, dll.

### 7. Backup Database
Setup backup harian:
```bash
mysqldump -u donasi_yayasan -p donasi_yayasan > backup_$(date +%Y%m%d).sql
```

### 8. Queue Worker
Kalau ada job antrian (notifikasi WA, email massal):
```bash
php artisan queue:work --daemon &
```

---

## 🟡 Regression Test — Manual Check

| Fitur | Checklist |
|-------|-----------|
| Auth | Register, Login, Logout, Lupa Password (email terima?) |
| Donasi | Lihat campaign detail → login → form → upload bukti → loading spinner muncul? → sukses |
| Sponsorship | Lihat anak asuh → pilih → form → upload bukti → loading spinner muncul? → sukses |
| Notifikasi WA | Approve transaksi → donatur terima WA? |
| Page transition | Klik link internal → overlay gradient muncul + progress bar atas? → halaman baru fade-in smooth? |
| Dashboard donatur | Profil, Pengurus, Legalitas, Rekap muncul? Navbar dropdown match style admin? |
| Dashboard admin | Statistik, transaksi, kampanye, anak asuh akurat? |
| Publik | Welcome page (AOS animasi jalan?), berita, profil, legalitas muncul & responsive? |
| Mobile | Navbar, cards, tabel nggak pecah? Navigation dropdown rapi? |
| Upload file | Pilih file → progress bar muncul & jalan? Submit → loading spinner? |

---

## ✅ SUDAH DISELESAIKAN

### Keamanan & Konfigurasi Server
- [x] Session driver database + encrypt (migration + config)
- [x] Timezone Asia/Jakarta (config/app.php)
- [x] MySQL user khusus `donasi_yayasan`@`localhost` (bukan root)
- [x] Gmail SMTP App Password (`uqtb aecl mapw sbun`)
- [x] Email reset password Bahasa Indonesia (ResetPasswordNotification.php)
- [x] Fonnte token lama di-revoke dari dashboard ✅

### Bug Fixes
- [x] Foto anak asuh muncul di dashboard donatur (`@if($child->photo)`)
- [x] Duplicate notification di login & forgot-password dihapus
- [x] Menu dashboard arah ke publik → fix ke route dashboard
- [x] Campaign Detail Page baru (`/campaign/{id}`)
- [x] Back button blank page (bfcache) — `pageshow` event + `cleanupBfcache()`
- [x] 500 error `navigation.blade.php` — `Auth::user()->role` → `$navUser?->role`

### UI/UX Redesign — Wave 1
- [x] Profil Yayasan public (hero putih + emerald cards + timeline + visi/misi)
- [x] Legalitas page (glassmorphism, no CDN)
- [x] Admin dashboard redesign (5 gradient stat cards, Chart.js emerald theme)
- [x] Public navbar upgrade (Alpine.js mobile menu, dropdown smooth)
- [x] Admin Profil Yayasan redesign (tab switcher, pendiri cards, modal)
- [x] Dashboard Donatur redesign (header gradient, quick actions, carousel OTA)
- [x] Edit Profil redesign (avatar ring, label uppercase tracking-wider, password eye toggle)
- [x] Welcome page redesign (hero gradient, campaign cards, stats, OTA CTA, berita carousel)
- [x] Register redesign (2-col grid, eye toggle, konsisten slate/emerald)
- [x] Login redesign (konsisten dengan register)

### UI/UX Redesign — Wave 2 (Sesi Ini)
- [x] **Page transitions redesign** — overlay gradient emerald + spinner ring + "BAITUL YATIM" logo + pulse dots + progress bar top (3px gradient emerald)
- [x] **Page entrance animation** — fade + slide-up + blur reduction (cubic-bezier custom)
- [x] **Button loading spinner otomatis** — global `submit` listener, semua form auto-spinner "Memproses..."
- [x] **Upload progress indicator** — form donasi & sponsor: progress bar gradient + nama file + persentase
- [x] **Staggered reveal admin tables** — `stagger-enter` di tbody transaksi & sponsorship, rows muncul satu per satu
- [x] **Navigation dropdown restyle** — trigger button avatar inisial + nama (match admin), Edit Profil & Keluar dengan icon SVG, grup menu "Akun" & "Sesi"
- [x] **Skeleton CSS classes** — `.skeleton-text`, `.skeleton-avatar`, `.skeleton-card`, `.skeleton-row` ready pakai
- [x] **Sync All (Midtrans) button dihapus** dari transaksi admin

### Dokumentasi & Kebersihan
- [x] Komentar Bahasa Indonesia (57 file PHP di app/, config/, bootstrap/)
- [x] Migration descriptions (36 file, Bahasa Indonesia)
- [x] Midtrans dead code di-comment (route + controller disimpan)
- [x] Folder `lang/en/` dihapus (tidak dipakai, sistem pakai `lang/id/`)
