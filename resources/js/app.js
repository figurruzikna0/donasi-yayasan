import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

/* ===== Top Progress Bar ===== */
let progressBar = null;

function initProgressBar() {
    if (progressBar) return;
    progressBar = document.createElement('div');
    progressBar.id = 'nprogress-bar';
    document.body.appendChild(progressBar);
}

function showProgress() {
    initProgressBar();
    progressBar.style.display = 'block';
    progressBar.style.width = '0%';
    requestAnimationFrame(() => { progressBar.style.width = '55%'; });
}

function finishProgress() {
    if (!progressBar) return;
    progressBar.style.width = '100%';
    setTimeout(() => {
        progressBar.style.display = 'none';
        progressBar.style.width = '0%';
    }, 350);
}

/* ===== Overlay Creator ===== */
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
function cleanupBfcache() {
    document.querySelector('.page-transition-overlay')?.remove();
    document.body.classList.add('page-fade-in');
    finishProgress();
}

window.addEventListener('pageshow', (e) => {
    if (e.persisted) cleanupBfcache();
});

document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('page-fade-in');
    finishProgress();
});

/* ===== Modern Page Transition ===== */
document.addEventListener('click', (e) => {
    const link = e.target.closest('a');
    if (!link) return;

    const href = link.getAttribute('href');
    if (!href || href.startsWith('#') || href.startsWith('javascript:') ||
        link.target === '_blank' || link.hasAttribute('download') ||
        link.hasAttribute('data-no-transition')) return;

    try {
        const url = new URL(href, window.location.origin);
        if (url.origin !== window.location.origin) return;
    } catch {
        return;
    }

    if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;

    e.preventDefault();

    showProgress();
    const overlay = createOverlay();

    requestAnimationFrame(() => overlay.classList.add('active'));

    setTimeout(() => { window.location.href = href; }, 380);
});

/* ===== Global Form Loading State ===== */
document.addEventListener('submit', (e) => {
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    if (!btn || btn.hasAttribute('data-no-loading')) return;

    const originalContent = btn.innerHTML;
    btn.classList.add('btn-loading');
    btn.setAttribute('data-original', originalContent);
    btn.innerHTML = '<span class="btn-spinner"><span class="spinner-ring-sm"></span> Memproses...</span>';
});
