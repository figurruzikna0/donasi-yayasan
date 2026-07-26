# Production Readiness — Yayasan Baitul Yatim Sukabumi

> Catatan perbaikan dan konfigurasi untuk deployment production.
> Update terakhir: 26 Juli 2026

---

## Daftar Perbaikan (Kritis → Ringan)

### 🔴 KRITIS — Error / Security / Data Loss

| # | Perbaikan | Detail |
|---|-----------|--------|
| 1 | **Session driver & table** | Migration `sessions` table dibuat, driver `database` supaya session tidak hilang saat server restart. Sebelumnya pakai file, riskan di production. |
| 2 | **SESSION_ENCRYPT=true** | Data session dienkripsi. Mencegah session hijacking lewat database direct read. |
| 3 | **SESSION_SECURE_COOKIE** | Hanya aktif via HTTPS (production). Dev tidak perlu. Mencegah cookie leak di jaringan publik. |
| 4 | **Timezone Asia/Jakarta** | Semua timestamp sekarang WIB. Sebelumnya UTC — selisih 7 jam, bikin laporan donasi dan jadwal kacau. |
| 5 | **MySQL user khusus** | User `donasi_yayasan`@`localhost` dengan hak akses terbatas (bukan root). Mencegah kebocoran database lain jika satu site ditembus. |
| 6 | **APP_DEBUG=false** (production) | Pastikan tidak ada stack trace yang bocor ke pengguna. |
| 7 | **Fonnte token revoke** | Token lama (`wq7ZjV3okd9ewmPdBYkt`) sudah di-revoke dari dashboard Fonnte. ✅ |

### 🟠 HIGH — Fungsionalitas Rusak / Salah

| # | Perbaikan | Detail |
|---|-----------|--------|
| 8 | **Reset password email Bahasa Indonesia** | Template notifikasi diubah dari Inggris ke Indonesia. |
| 9 | **Foto anak asuh tidak muncul** | Dashboard donatur hanya menampilkan initial huruf. Fix: `@if($child->photo)` ditambahkan. |
| 10 | **Duplicate notifications** | Dua element `x-auth-session-status` di login & forgot-password. Yang dobel dihapus. |
| 11 | **Menu dashboard arah ke publik** | Profil/Pengurus/Legalitas di dashboard donatur masih link ke route publik. Diubah ke route dashboard. |
| 12 | **Gmail SMTP App Password** | Password Gmail biasa tidak bisa buat SMTP. Diganti App Password. 2FA wajib aktif. |
| 13 | **Campaign detail tidak bisa diakses** | Sekarang ada halaman `/campaign/{id}` dengan info lengkap + gambar brosur. |

### 🟡 MEDIUM — UX / Navigasi

| # | Perbaikan | Detail |
|---|-----------|--------|
| 14 | **Back button blank page (bfcache)** | `pageshow` event listener di semua layout + cleanup overlay di `app.js`. |
| 15 | **Page transitions redesign** | Overlay gradient emerald + spinner ring + "BAITUL YATIM" logo + 3 pulse dots. Progress bar 3px gradient emerald di atas halaman. Entrance fade + slide-up + blur dengan cubic-bezier custom. |
| 16 | **Gambar campaign detail terlalu besar** | `max-h-[400px]` + klik perbesar. |
| 17 | **Profil Yayasan public redesign** | Hero putih bersih + header emerald solid + timeline vertikal + visi/misi. |
| 18 | **Legalitas page restyle** | Glassmorphism + hover effect, tanpa CDN eksternal. |
| 19 | **Button loading spinner** | Global submit listener — semua form (login, register, donasi, sponsor, dll) otomatis tampilkan spinner ring + "Memproses..." saat submit. |
| 20 | **Upload progress indicator** | Form donasi & sponsorship: progress bar gradient emerald + nama file + persentase simulasi real-time. |
| 21 | **Navigation dropdown restyle** | Trigger button avatar inisial + nama (sama persis style admin). Dropdown: grup "Akun" (Edit Profil, icon user) dan "Sesi" (Keluar, icon logout, text-error). |
| 22 | **Admin table staggered reveal** | Baris tabel transaksi & sponsorship muncul satu per satu dengan fade + slide-up. |

### 🟢 LOW — Dokumentasi & Kebersihan Kode

| # | Perbaikan | Detail |
|---|-----------|--------|
| 23 | **Komentar Bahasa Indonesia** | 57 file PHP diberi header block dan inline comments Bahasa Indonesia. |
| 24 | **Migration descriptions** | 36 file migration diberi deskripsi Bahasa Indonesia. |
| 25 | **Midtrans dead code dikomentari** | Route callback Midtrans + method controller di-comment (disimpan untuk aktivasi ulang). |
| 26 | **Skeleton CSS classes** | `.skeleton-text/avatar/card/row` + shimmer animation siap pakai. |

---

## Environment & Konfigurasi

### .env Production
```ini
APP_NAME="Yayasan Baitul Yatim Sukabumi"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://donasi.baitulyatim.or.id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=donasi_yayasan
DB_USERNAME=donasi_yayasan
DB_PASSWORD=baitulyatim12345

SESSION_DRIVER=database
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=figurruzikna7@gmail.com
MAIL_PASSWORD=uqtb aecl mapw sbun
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=figurruzikna7@gmail.com
MAIL_FROM_NAME="Yayasan Baitul Yatim Sukabumi"

FONNTE_TOKEN=P8yDo6jNZfvCV8w3zupN

APP_TIMEZONE=Asia/Jakarta
```

### Session Table Migration
```php
Schema::create('sessions', function (Blueprint $table) {
    $table->string('id')->primary();
    $table->foreignId('user_id')->nullable()->index();
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->longText('payload');
    $table->integer('last_activity')->index();
});
```

---

## CSS/JS Feature Summary

### Page Transition (`app.css` + `app.js`)
- **Top progress bar**: `#nprogress-bar` — 3px, gradient emerald, glow animation
- **Overlay**: `.page-transition-overlay` — gradient `#022c22`→`#059669`, decorative circles, spinner ring 56px, logo text + pulse dots
- **Entrance**: `@keyframes pageEntrance` — fade + translateY(20px) + blur(8px) → identity. Cubic-bezier `(0.16, 1, 0.3, 1)`, 550ms

### Button Loading
- Global `submit` listener di `app.js` — cari `button[type="submit"]`, ganti innerHTML dengan spinner ring + "Memproses..."
- Skip jika `data-no-loading` ada di button
- CSS `.btn-loading` + `.spinner-ring-sm` (18px, border-top color)

### Upload Progress
- `.upload-progress-container` + `.upload-progress-bar-bg` + `.upload-progress-bar-fill`
- Simulasi progress (random 0→90%, complete 100% on submit)
- Dipasang di form donasi (`create.blade.php`) & sponsorship (`sponsor.blade.php`)

### Staggered Reveal
- `.stagger-enter > *` — opacity 0 + translateY(12px), animasi bertahap (delay 50ms per child)
- Dipasang di tabel admin (transactions + sponsorships index)

---

## Halaman & Route

### Dashboard Donatur
| Halaman | Route | View |
|---------|-------|------|
| Dashboard | `GET /dashboard` | `dashboard.blade.php` |
| Rekap | `GET /dashboard/rekap` | `dashboard/rekap.blade.php` |
| Profil Yayasan | `GET /dashboard/profil-yayasan` | `dashboard/profil.blade.php` |
| Pengurus | `GET /dashboard/pengurus` | `dashboard/pengurus.blade.php` |
| Legalitas | `GET /dashboard/legalitas` | `dashboard/legalitas.blade.php` |

### Publik (tanpa login)
| Halaman | Route | View |
|---------|-------|------|
| Beranda | `GET /` | `welcome.blade.php` |
| Berita | `GET /berita` | Route closure |
| Detail Berita | `GET /berita/{slug}` | Route closure |
| Profil Yayasan | `GET /profil` | `profil.blade.php` |
| Pengurus | `GET /pengurus` | `pengurus.blade.php` |
| Legalitas | `GET /legalitas` | `legalitas.blade.php` |
| Detail Campaign | `GET /campaign/{campaign}` | `donations/campaign_detail.blade.php` |

### Donasi & Sponsorship (harus login)
| Halaman | Route | View |
|---------|-------|------|
| Form Donasi | `GET /campaign/{campaign}/donate` | `donations/create.blade.php` |
| Detail Anak Asuh | `GET /foster-children/{id}` | `donations/child_detail.blade.php` |
| Form Sponsorship | `GET /foster-children/{id}/sponsor` | `donations/sponsor.blade.php` |

---

## Catatan Deployment

### Checklist Sebelum Go-Live
- [ ] Domain & SSL (HTTPS) aktif
- [ ] APP_URL diisi domain production
- [ ] SESSION_SECURE_COOKIE=true
- [ ] APP_DEBUG=false
- [ ] APP_ENV=production
- [ ] Email test (reset password) berhasil
- [x] Fonnte token baru sudah diset, token lama sudah direvoke
- [ ] `php artisan optimize` sudah jalan
- [ ] `php artisan storage:link` aktif
- [ ] Cron job `php artisan schedule:run` terdaftar
- [ ] Backup database otomatis (harian)

### Command
```bash
# Sebelum deploy
php artisan down --secret="rahasia123"
git pull origin main
php artisan migrate --force
php artisan optimize
php artisan storage:link
php artisan up

# Backup
mysqldump -u donasi_yayasan -p donasi_yayasan > backup_$(date +%Y%m%d).sql
```

### Cron
```
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```
