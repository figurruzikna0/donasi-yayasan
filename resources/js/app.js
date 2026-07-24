

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('page-fade-in');
});

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

    const overlay = document.createElement('div');
    overlay.className = 'page-transition-overlay bg-base-100';
    document.body.appendChild(overlay);

    requestAnimationFrame(() => overlay.classList.add('active'));

    setTimeout(() => { window.location.href = href; }, 250);
});
