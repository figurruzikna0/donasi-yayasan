/* =====================================================================
   app.js - Entry point JavaScript aplikasi (Laravel 11 + Vite)
   ---------------------------------------------------------------------
   File ini adalah pintu masuk (entry point) bundling aset frontend
   sistem Yayasan Baitul Yatim Sukabumi. Dikompilasi oleh Vite dan
   dipanggil dari layout blade melalui direktif @vite(['resources/js/app.js']).
   Berisi: inisialisasi Alpine.js, progress bar atas, overlay transisi
   antar halaman, serta indikator "Memproses..." saat form disubmit.
   ===================================================================== */

// ---------------------------------------------------------------------
// Inisialisasi Alpine.js
// Alpine.js adalah framework JavaScript ringan untuk interaktivitas
// (dropdown, modal, tab, dll). Objek Alpine didaftarkan ke window
// agar dapat dipakai dari atribut x-data / x-on di dalam template blade.
// ---------------------------------------------------------------------
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

/* ===== Top Progress Bar ===== */
/* Progress bar: garis hijau di paling atas halaman yang tampil saat
   pengguna berpindah halaman, sebagai penanda halaman sedang dimuat. */
let progressBar = null;

/* Membuat elemen <div> progress bar lalu menambahkannya ke body.
   Hanya dieksekusi sekali (jika elemen belum pernah dibuat). */
function initProgressBar() {
    if (progressBar) return;
    progressBar = document.createElement('div');
    progressBar.id = 'nprogress-bar';
    document.body.appendChild(progressBar);
}

/* Menampilkan progress bar dan menggerakkannya hingga 55%
   (simulasi proses loading yang belum selesai). */
function showProgress() {
    initProgressBar();
    progressBar.style.display = 'block';
    progressBar.style.width = '0%';
    requestAnimationFrame(() => { progressBar.style.width = '55%'; });
}

/* Menyelesaikan progress bar ke 100% lalu menyembunyikannya
   setelah jeda 350 ms (menandakan halaman baru sudah siap). */
function finishProgress() {
    if (!progressBar) return;
    progressBar.style.width = '100%';
    setTimeout(() => {
        progressBar.style.display = 'none';
        progressBar.style.width = '0%';
    }, 350);
}

/* ===== Overlay Creator ===== */
/* Membuat overlay (lapisan penutup layar penuh) berisi logo yayasan
   dan animasi spinner yang tampil selama proses transisi halaman. */
function createOverlay() {
    const overlay = document.createElement('div');
    overlay.className = 'page-transition-overlay';
    overlay.innerHTML = `
        <div class="deco-circle deco-1"></div>
        <div class="deco-circle deco-2"></div>
        <div class="deco-circle deco-3"></div>
        <div class="center-content">
            <div class="spinner-ring"></div>
            <div class="logo-text">BAITUL YATIM</div>
            <div class="logo-sub">Yayasan Sosial &bull; Pendidikan &bull; Dakwah</div>
            <div style="margin-top:1rem; display:flex; justify-content:center; gap:2px;">
                <span class="pulse-dot"></span>
                <span class="pulse-dot"></span>
                <span class="pulse-dot"></span>
            </div>
        </div>
    `;
    document.body.appendChild(overlay);
    return overlay;
}

/* ===== Bfcache / Page Restore ===== */
/* Bfcache adalah fitur browser yang menyimpan salinan halaman yang
   sudah dikunjungi. Saat pengguna menekan tombol Back/Forward, event
   'pageshow' dengan properti persisted bernilai true akan terpicu,
   sehingga overlay transisi sisa harus dibersihkan kembali. */
function cleanupBfcache() {
    document.querySelector('.page-transition-overlay')?.remove();
    document.body.classList.add('page-fade-in');
    finishProgress();
}

/* Menangani halaman yang dipulihkan dari bfcache (navigasi back/forward). */
window.addEventListener('pageshow', (e) => {
    if (e.persisted) cleanupBfcache();
});

/* Saat DOM halaman selesai dimuat: terapkan animasi masuk halaman
   dan pastikan progress bar tidak tertinggal dalam keadaan tampil. */
document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('page-fade-in');
    finishProgress();
});

/* ===== Modern Page Transition ===== */
/* Menangkap klik pada semua link (<a>) untuk menampilkan overlay
   transisi sebelum berpindah halaman, sehingga navigasi terasa modern. */
document.addEventListener('click', (e) => {
    const link = e.target.closest('a');
    if (!link) return;

    const href = link.getAttribute('href');
    // Abaikan link yang tidak memerlukan transisi: anchor (#),
    // javascript:, target _blank, link unduhan, atau link yang
    // ditandai atribut data-no-transition.
    if (!href || href.startsWith('#') || href.startsWith('javascript:') ||
        link.target === '_blank' || link.hasAttribute('download') ||
        link.hasAttribute('data-no-transition')) return;

    // Abaikan link menuju domain lain; transisi hanya untuk halaman internal.
    try {
        const url = new URL(href, window.location.origin);
        if (url.origin !== window.location.origin) return;
    } catch {
        return;
    }

    // Abaikan klik dengan tombol modifikasi (Ctrl/Shift/CMD) atau klik non-kiri.
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;

    // Batalkan perilaku default browser, lalu tampilkan overlay + progress bar.
    e.preventDefault();

    showProgress();
    const overlay = createOverlay();

    // Tambahkan class 'active' pada frame berikutnya agar animasi opacity berjalan.
    requestAnimationFrame(() => overlay.classList.add('active'));

    // Setelah 380 ms (durasi animasi overlay), arahkan browser ke halaman tujuan.
    setTimeout(() => { window.location.href = href; }, 380);
});

/* ===== Global Form Loading State ===== */
/* Saat form disubmit, tombol submit otomatis berubah menjadi status
   "Memproses..." lengkap dengan spinner, untuk mencegah klik ganda.
   Per-tombol dapat dinonaktifkan dengan atribut data-no-loading. */
document.addEventListener('submit', (e) => {
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    if (!btn || btn.hasAttribute('data-no-loading')) return;

    // Simpan isi tombol asli agar bisa dipulihkan setelah proses selesai.
    const originalContent = btn.innerHTML;
    btn.classList.add('btn-loading');
    btn.setAttribute('data-original', originalContent);
    btn.innerHTML = '<span class="btn-spinner"><span class="spinner-ring-sm"></span> Memproses...</span>';
});
