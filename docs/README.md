# Dokumentasi Project Donasi Yayasan Baitul Yatim

> **Stack:** Laravel 13, Tailwind CSS v3 + daisyUI 4, Alpine.js, Midtrans, DomPDF, Fonnte WA, MySQL

---

## 1. FILE MAP — Struktur Folder

```
donasi-yayasan/
│
├── app/                          # 🧠 Otak aplikasi
│   ├── Console/Commands/         # Perintah artisan custom
│   │   ├── CheckSponsorshipDueDates.php     # Cron: cek masa berlaku sponsor
│   │   └── SendSponsorshipReminders.php     # Cron: kirim pengingat via email
│   │
│   ├── Exceptions/               # Penanganan error (pake bawaan Laravel)
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php           # Login/logout versi custom
│   │   │   ├── DonationController.php       # Donasi + sponsor (publik)
│   │   │   ├── DonorController.php          # Dashboard donatur
│   │   │   ├── InvoiceController.php        # Invoice + PDF
│   │   │   ├── ProfileController.php        # Edit profil user
│   │   │   └── Admin/                       # 👑 Semua controller admin
│   │   │       ├── CampaignController.php   # CRUD kampanye donasi
│   │   │       ├── ChildDevelopmentController.php  # Laporan perkembangan anak
│   │   │       ├── DashboardController.php  # Dashboard admin (statistik)
│   │   │       ├── FosterChildController.php # CRUD anak asuh
│   │   │       ├── NewsController.php       # CRUD berita
│   │   │       ├── PendiriController.php    # CRUD pendiri yayasan
│   │   │       ├── ProfilYayasanController.php     # Edit profil yayasan
│   │   │       ├── RekapController.php      # Laporan rekap + export PDF/CSV
│   │   │       ├── SponsorshipController.php # Kelola sponsorship
│   │   │       ├── TransactionController.php # Semua transaksi + approve/sync
│   │   │       └── UserController.php       # Kelola user
│   │   │
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php  # Cek role admin sebelum akses halaman
│   │   │
│   │   └── Requests/
│   │       ├── Auth/LoginRequest.php  # Validasi form login
│   │       └── ProfileUpdateRequest.php  # Validasi update profil
│   │
│   ├── Mail/                      # 📧 Email otomatis
│   │   ├── DonationSuccessMail.php      # Email donasi berhasil
│   │   ├── SponsorshipReminderMail.php  # Email pengingat sponsor
│   │   └── SponsorshipSuccessMail.php   # Email sponsor berhasil
│   │
│   ├── Models/                    # 📦 Model database (Eloquent)
│   │   ├── Campaign.php           # Kampanye donasi
│   │   ├── ChildDevelopment.php   # Perkembangan anak asuh
│   │   ├── Donation.php           # Donasi uang
│   │   ├── FosterChild.php        # Anak asuh
│   │   ├── News.php               # Berita
│   │   ├── Pendiri.php            # Pendiri yayasan
│   │   ├── ProfilYayasan.php      # Profil yayasan (1 baris)
│   │   ├── Sponsorship.php        # Program orang tua asuh
│   │   └── User.php               # User (admin + donatur)
│   │
│   ├── Providers/
│   │   └── AppServiceProvider.php # Registrasi composer, dll
│   │
│   ├── Services/
│   │   └── FonnteService.php      # Kirim WA via Fonnte
│   │
│   ├── Traits/
│   │   └── HandlesFileUpload.php  # Upload file (dipakai banyak controller)
│   │
│   └── View/
│       ├── Components/            # Layout class
│       │   ├── AdminLayout.php
│       │   ├── AppLayout.php
│       │   └── GuestLayout.php
│       └── Composers/
│           └── ProfilYayasanComposer.php  # Inject $profil ke semua view
│
├── bootstrap/                     # 🚀 Boot Laravel
│   ├── app.php
│   └── providers.php
│
├── config/                        # ⚙️ Pengaturan
│   ├── app.php, auth.php, database.php, ...
│   ├── midtrans.php               # Config Midtrans (server/client key)
│   └── queue.php, session.php, ...
│
├── database/
│   ├── factories/                 # Data palsu untuk testing
│   ├── migrations/                # 28 file migrasi (struktur tabel)
│   └── seeders/
│       └── DatabaseSeeder.php     # Seeder admin (baca dari .env)
│
├── public/
│   ├── build/                     # Hasil build Vite (CSS + JS)
│   ├── storage/                   # Link ke storage/app/public
│   └── index.php                  # Entry point (semua request masuk sini)
│
├── resources/
│   ├── css/app.css                # Source Tailwind CSS
│   ├── js/app.js                  # Source Alpine.js
│   └── views/                     # 🎨 Semua tampilan (Blade)
│       │
│       ├── welcome.blade.php           # Halaman utama (landing page)
│       ├── dashboard.blade.php         # Dashboard donatur
│       ├── profil.blade.php            # Profil yayasan (publik)
│       ├── pengurus.blade.php          # Struktur pengurus
│       ├── legalitas.blade.php         # Legalitas yayasan
│       │
│       ├── layouts/                    # Layout (template) halaman
│       │   ├── admin.blade.php         # Layout admin (sidebar + navbar)
│       │   ├── app.blade.php           # Layout user login
│       │   ├── guest.blade.php         # Layout pengunjung
│       │   └── navigation.blade.php    # Navigasi publik
│       │
│       ├── auth/                       # Halaman login/register
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   ├── forgot-password.blade.php, reset-password.blade.php, ...
│       │
│       ├── admin/                      # Semua halaman admin
│       │   ├── dashboard.blade.php
│       │   ├── campaigns/ (index, create, edit, show)
│       │   ├── child-developments/ (index, create, edit, show)
│       │   ├── foster_children/ (index, create, edit, show)
│       │   ├── news/ (index, create, edit, show, form)
│       │   ├── pendiri/index.blade.php
│       │   ├── profil/ (index, edit)
│       │   ├── rekap/ (donasi, donatur, orang_tua_asuh + PDF)
│       │   ├── sponsorships/ (index, contacts)
│       │   ├── transactions/index.blade.php
│       │   └── users/ (index, edit)
│       │
│       ├── components/                 # Komponen reusable
│       │   └── alert.blade.php         # Notifikasi toast
│       │
│       ├── donations/                  # Halaman donasi publik
│       │   ├── create.blade.php        # Form donasi
│       │   ├── payment.blade.php       # Pembayaran Midtrans
│       │   ├── sponsor.blade.php       # Form orang tua asuh
│       │   └── sponsor_payment.blade.php
│       │
│       ├── invoices/                   # Invoice & PDF
│       │   ├── donation.blade.php, donation_pdf.blade.php
│       │   ├── sponsorship.blade.php, sponsorship_pdf.blade.php
│       │   └── child_development_pdf.blade.php
│       │
│       ├── profile/                    # Edit profil user
│       │   └── edit.blade.php
│       │
│       ├── partials/                   # Potongan halaman
│       │   ├── footer.blade.php
│       │   └── public-navbar.blade.php
│       │
│       ├── errors/                     # Halaman error
│       │   ├── 403.blade.php
│       │   ├── 404.blade.php
│       │   └── 500.blade.php
│       │
│       ├── news/
│       │   └── show.blade.php          # Detail berita publik
│       │
│       └── emails/                     # Template email
│           ├── donations/success.blade.php
│           └── sponsorships/ (success.blade.php, reminder.blade.php)
│
├── routes/                        # 🛣️ Route (daftar URL)
│   ├── web.php                    # Route utama
│   ├── auth.php                   # Route login/register
│   ├── api.php                    # Route API (kosong?)
│   └── console.php                # Route perintah artisan
│
├── storage/
│   ├── app/public/                # File upload (logo, foto anak, dll)
│   └── logs/laravel.log           # Catatan error
│
├── tailwind.config.js             # Konfigurasi Tailwind + daisyUI
├── vite.config.js                 # Konfigurasi Vite
└── package.json                   # Dependency JS (Tailwind, Alpine, Vite)
```

---

## 2. DATA FLOW — Alur Data dari Awal sampai Akhir

### 🟢 Donasi (Donasi Uang Sekali)

```
USER                           SERVER                        DATABASE
──                             ──────                        ────────
                                                               
[Lihat kampanye di welcome]                                     
    │                                                            
    ├── GET / → DonorController@dashboard                        
    │   → query Campaign::all()                                  
    │                                 ← campaigns table          
    │                                                             
[Klik "Donasi Sekarang"]                                          
    │                                                             
    ├── GET /campaign/{id}/donate                                 
    │   → auth? verified? throttle?                              
    │   → DonationController@create → view('donations.create')   
    │                                                             
[Isi form: nama, email, no hp, jumlah, metode bayar]              
    │                                                             
    ├── POST /campaign/{id}/donate                                
    │   → validasi:                                               
    │     • nama required, max 255                                
    │     • email required, valid format                          
    │     • no hp required                                        
    │     • amount required, numeric, min 1000                    
    │     • payment_method required                               
    │                                                             
    │   ❌ GAGAL VALIDASI                                         
    │   → balik ke form + tampil error di <x-alert>               
    │                                                             
    │   ✅ LOLOS VALIDASI                                         
    │   → Donation::create([...])                                 
    │     • order_id = "DONASI-" + uniqid()                     ← donations table
    │     • status = 'pending'                                    
    │     • user_id = auth user                                   
    │     • campaign_id = dari URL                                
    │                                                             
    │   → Cek Midtrans Snap token:                                  
    │     │                                                       
    │     └── Snap::getSnapToken($params)                           
    │         → view('donations.payment') + snap token            
    │         → user bayar lewat popup Midtrans                   
    │         → Midtrans kirim POST /midtrans/callback            
    │         → DonationController@callback                       
    │         → status = 'success'                                
    │         → campaign.collected_amount += amount               
    │         → kirim email + WA                                  
    │         → user liat invoice                                 
    │                                                             
[DONASI BERHASIL]                                                 
    │                                                             
    ├── User lihat:                                               
    │   • invoice (HTML) → /donations/{id}/invoice                
    │   • invoice (PDF) → /donations/{id}/invoice/pdf             
    │   • dashboard → /dashboard                                  
    │   • rekap → /dashboard/rekap                                
    │                                                             
    ├── Admin lihat:                                              
    │   • daftar transaksi → /admin/transactions                  
    │   • rekap donasi → /admin/rekap/donasi (CSV/PDF)            
    │   • dashboard admin → statistik total dana                  
```

### 🟣 Sponsor (Orang Tua Asuh - Bulanan)

```
MIRIP donasi, tapi bedanya:

1. Form sponsor → POST /foster-children/{id}/sponsor              
   • Validasi amount: min 100.000, max 500.000                    
   • Ada field paket_komitmen (Bronze/Silver/Gold)                
                                                                  
2. Simpan di tabel SPONSORSHIPS (bukan donations)                 
   • order_id = "SPONSOR-" + uniqid()                             
   • Ada foster_child_id (siapa anaknya)                          
   • Ada starts_at, expires_at (1 bulan)                          
                                                                  
3. Pas disetujui/settlement:                                      
   • foster_child.status = 'Diasuh'                               
   • starts_at = hari ini                                         
   • expires_at = hari ini + 1 bulan                              
   • Kirim WA + email ke sponsor                                  
                                                                  
4. tiap bulan:                                                    
   • Cron job → CheckSponsorshipDueDates                          
   • Kirim reminder via SendSponsorshipReminders                   
   • Email dikirim ke donor_email via SponsorshipReminderMail     
                                                                  
5. Admin bisa liat kontak sponsor per anak:                       
   • /admin/sponsorships/contacts                                 
```

### 🟡 Berita (News)

```
ADMIN                                            PUBLIK
─────                                            ──────

[Login admin]                                    
  → /admin/news/create                           
  → isi judul, kategori, konten, foto            
  → POST /admin/news                             
  → validasi + save                              
  → redirect "Berhasil"                          
                                                  [Buka website]
                                                    → GET /berita/{slug}
                                                    → view('news.show')
                                                    → lihat konten berita
```

### 🔵 Anak Asuh + Perkembangan

```
ADMIN                                               SPONSOR (user)
─────                                               ──────────────

[Tambah anak asuh]                                  
  → /admin/foster-children/create                   
  → isi nama, umur, foto                           
  → POST /admin/foster-children                     
                                                    
[Buat laporan perkembangan]                         [Lihat di dashboard]
  → /admin/child-developments/create                  → /dashboard
  → pilih anak (yang punya sponsor aktif)             → lihat laporan
  → isi judul, deskripsi, foto                        
  → POST /admin/child-developments                   [Download PDF]
  → otomatis kirim WA ke sponsor                       → /child-developments/{id}/pdf
  → "Berhasil"
```

---

## 3. AUTH FLOW — Cara Login, Role, & Permission

### 👤 Role yang Ada

| Role | Bisa Ngapain? |
|------|---------------|
| `donatur` | Donasi, sponsor, liat invoice, edit profil sendiri |
| `admin` | Semua akses: CRUD apapun, rekap, export, approve transaksi, kelola user |

Tidak ada role lain. Cuma 2.

### 🔐 Cara Login

```
1. User buka /login
2. Isi email + password
3. POST /login (dibatasi 10 percobaan per menit)

4. Sistem cek:
   ├── Email terdaftar? ❌ → error "Email atau password salah"
   ├── Password cocok? ❌  → error "Email atau password salah"
   └── 🟢 Login sukses
       │
       ├── role = 'admin'   → redirect /admin/dashboard
       └── role = 'donatur' → redirect /dashboard
```

### 🛡️ Proteksi Halaman

| Middleware | Artinya | Diterapkan ke |
|------------|---------|---------------|
| `guest` | Cuma bisa diakses KALAU BELUM login | Halaman login, register, lupa password |
| `auth` | WAJIB sudah login | Dashboard, profile, donasi, sponsor |
| `verified` | WAJIB sudah verifikasi email (dikirim pas register) | Dashboard, donasi, sponsor |
| `admin` | WAJIB role = admin | Semua route /admin/* |
| `throttle:10,1` | Maksimal 10 request per menit | Donasi, sponsor (cegah spam) |

### 📋 Cara Daftar Jadi Donatur

```
1. Buka /register
2. Isi: nama, email, password, no hp, alamat, NIK
3. Submit (dibatasi 5x per 30 menit)
4. ✅ Auto login + redirect ke /dashboard
5. 📧 Cek email untuk verifikasi (link dikirim otomatis)
6. Klik link verifikasi → baru bisa donasi
```

### 👑 Cara Jadi Admin

**TIDAK** bisa daftar jadi admin. Hanya lewat:
- Seeder: `php artisan db:seed` → baca `ADMIN_EMAIL` + `ADMIN_PASSWORD` dari `.env`
- Admin lain: `/admin/users/{id}/edit` → ubah role dari donatur ke admin

### 🔍 Cek Permission di Mana?

AdminMiddleware (`app/Http/Middleware/AdminMiddleware.php`):
```php
if (!auth()->check() || auth()->user()->role !== 'admin') {
    abort(403); // "Akses ditolak"
}
```

Middleware ini dipasang di semua route `/admin/*` lewat `routes/web.php`.

### 👀 Data User Dipisah Gimana?

- **Donatur cuma bisa liat data mereka sendiri:**
  - `Donation::where('user_id', Auth::id())` — donasi sendiri
  - `Sponsorship::where('user_id', Auth::id())` — sponsor sendiri
  - `ProfileController` — cuma bisa edit profil sendiri

- **Admin bisa liat semua data:**
  - `User::all()`, `Donation::with('user')`, dll — tanpa filter

- **Pemisahan di view:**
  - `navigation.blade.php` — navbar donatur disembunyiin dari admin (biar ga dobel)
  - `profile/edit.blade.php` — field phone/address/NIK disembunyiin untuk admin

---

## 4. RISK MAP — Bagian Paling Rawan

### 🚨 KRITIS: `.env` Tersimpan di Repo

File `.env` berisi **API KEY ASLI**:
- `MIDTRANS_SERVER_KEY` — bisa dipake transaksi atas nama yayasan
- `FONNTE_TOKEN` — bisa kirim WA atas nama yayasan
- `MAIL_PASSWORD` — password Gmail asli

> **Solusi:** Hapus `.env` dari git, regenerate key, putar ulang semua credentials.

### 🔴 HIGH RISK — Error Rawan

| No | Masalah | File | Dampak |
|----|---------|------|--------|
| 1 | `Snap::getSnapToken()` tanpa try-catch | `DonationController.php:78` | Kalo Midtrans down, user dapet 500 error |
| 2 | `FonnteService()` constructor throw | `FonnteService.php:18` | Kalo token salah, semua notifikasi WA gagal + 500 |
| 3 | Query DB langsung di Blade | `admin/dashboard.blade.php:131` | Sulit debug, rawan error kalo schema berubah |
| 4 | `get()` tanpa pagination | `TransactionController.php:20` | Kalo data 100rb+, server bisa kehabisan memory |
| 5 | `get()` user donations | `DonorController.php:41` | Donatur dengan 1000 transaksi lemot |

### 🟡 MEDIUM RISK

| No | Masalah | File | Dampak |
|----|---------|------|--------|
| 1 | File upload ga divalidasi di trait | `HandlesFileUpload.php` | Kalo ada controller lupa validasi, file berbahaya bisa masuk |
| 2 | Email password di `.env.example` | `.env.example:53` | Bocor ke sapa aja yang liat repo |
| 3 | `$request->only()` bukan `$validated` | `FosterChildController.php:37` | Mass assignment bypass |
| 4 | Kode WA notifikasi dobel | `DonationController.php:273` + `TransactionController.php:207` | Kalau diubah di satu tempat, satunya lupa |

### 🔵 YANG UDAH AMAN

| Area | Status |
|------|--------|
| Division by zero (progress bar) | ✅ Semua ada pengecekan `target_amount > 0` |
| Debug function (`dd`, `ray`, `dump`) | ✅ Bersih, ga ada |
| `APP_DEBUG=false` di production | ✅ Udah set |
| Error pages custom (403/404/500) | ✅ Ada branding yayasan |
| Throttle form publik | ✅ Login (10/mnt), register (5/30mnt), donasi (10/mnt) |
| Pagination index admin | ✅ Semua pake `paginate()` |
| Null guard campaign/show, news/show | ✅ Udah ditambah `@if(!$data)` |
| Midtrans callback idempotent | ✅ Update berdasarkan order_id, aman dari replay |

### 🟠 YANG BELUM ADA

| Yang Belum | Di Mana |
|------------|---------|
| Loading spinner / skeleton | Semua halaman — belum ada |
| Error state untuk network failure | Semua form pake submit biasa, ga ada handling |
| Rate limiting admin routes | `/admin/*` — ga dibatasi |
| Validasi format `paket_komitmen` | `sponsorStore()` — dicek string doang |

---

## 5. CHANGE GUIDE — Cara Aman Ubah Project

### 📁 File yang Sering Diubah

| Tujuan | File yang Diubah | Juga Cek |
|--------|------------------|----------|
| **Tambah campaign** | `CampaignController`, `admin/campaigns/` | `routes/web.php` kalo ada route baru |
| **Ubah form donasi** | `donations/create.blade.php` | `DonationController@store` (validasi) |
| **Tambah metode bayar** | `donations/create.blade.php`, `donations/sponsor.blade.php` | `admin/transactions/index.blade.php` |
| **Ubah notifikasi WA** | `FonnteService.php` | `DonationController`, `TransactionController`, `ChildDevelopmentController` |
| **Ubah tampilan admin** | `layouts/admin.blade.php` | `admin/dashboard.blade.php` |
| **Ubah halaman utama** | `welcome.blade.php` | `partials/public-navbar.blade.php`, `partials/footer.blade.php` |
| **Tambah role baru** | `User` model, `AdminMiddleware` | SEMUA pengecekan `role === 'admin'` |
| **Ubah database** | Buat migration baru | Model + Controller + View yang pake tabel itu |

### 🔄 Flow yang Terdampak kalau Ada Perubahan

| Kalau Ubah Ini... | ...Akan Dampak ke |
|-------------------|-------------------|
| **Struktur tabel `donations`** | DonationController, TransactionController, RekapController, semua view donasi, invoice, PDF |
| **Struktur tabel `sponsorships`** | SponsorshipController, DonationController, TransactionController, ChildDevelopmentController, semua view sponsor |
| **Struktur tabel `users`** | AuthController, UserController, ProfileController, DonorController, InvoiceController |
| **Role system** | AdminMiddleware, route groups, pengecekan role di 15+ file |
| **Payment method list** | 2 view (create, sponsor) + 1 view admin (transactions/index) |
| **Package list (Bronze/Silver/Gold)** | 1 view (sponsor.blade.php) — dobel (PHP + JS) |
| **Midtrans config** | `config/midtrans.php`, `DonationController@callback` |

### 🧪 Test yang Perlu Dicek

| Setelah Ubah... | Test Manual |
|-----------------|-------------|
| Form donasi | Submit donasi Midtrans, cek masuk db, cek status |
| Form sponsor | Submit sponsor, cek muncul di admin, cek approve |
| Login/register | Coba login gagal (salah password), register (email udah dipake) |
| Admin CRUD | Tambah/edit/hapus campaign, news, anak asuh |
| Approve transaksi | Approve donasi pending, cek email + WA terkirim |
| Rekap export | Download CSV + PDF, cek isinya |
| Error page | Akses `/admin` tanpa login, akses URL salah |
| Notifikasi | Cek email di Brevo (mailtrap), cek WA di Fonnette dashboard |

### 🚫 Bagian yang Jangan Disentuh

| File | Alasan |
|------|--------|
| `vendor/` | Dependency — diubah lewat composer aja |
| `node_modules/` | Dependency — diubah lewat npm aja |
| `bootstrap/cache/` | Cache sistem — jangan diedit manual |
| `storage/framework/views/` | Cache Blade — dibersihkan via `view:clear` |
| `public/build/` | Build Vite — dibangun via `npm run build` |
| `config/midtrans.php` | Kalo diganti manual, Midtrans error. Ubah lewat `.env` aja |
| `.env` | Jangan di-commit ke git. Isinya rahasia |

### ⏪ Rollback Plan (Kalo Gagal)

```
1. Git rollback:
   git log --oneline -5          # liat commit terakhir
   git reset --hard <hash>       # balik ke commit sebelumnya
   git clean -fd                 # hapus file baru

2. Cache clear:
   php artisan cache:clear
   php artisan view:clear
   php artisan config:clear

3. Database rollback (kalo ada migration baru):
   php artisan migrate:rollback  # balik 1 step
   # atau
   php artisan migrate:reset     # balik ke awal
   php artisan migrate           # jalanin ulang

4. Restore .env:
   git checkout -- .env          # balikin .env dari git
   # atau restore dari backup

5. Restore file upload:
   # Backup dulu storage/app/public/
   # Restore dari backup kalo perlu
```

### 💡 Tips Developer

1. **Sebelum ubah apa pun:**
   ```bash
   git checkout -b fitur-baru  # bikin branch dulu
   ```

2. **Selalu clear cache kalo ada perubahan view/route/config:**
   ```bash
   php artisan view:clear
   php artisan route:clear
   php artisan config:clear
   ```

3. **Cek log error:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

4. **Jalanin queue worker (kalo ada email terkirim):**
   ```bash
   php artisan queue:work
   ```

5. **Cek route list:**
   ```bash
   php artisan route:list
   ```

6. **Build frontend:**
   ```bash
   npm run build    # untuk production
   npm run dev      # untuk development (hot reload)
   ```
