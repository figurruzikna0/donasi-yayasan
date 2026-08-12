<!-- ============================================ -->
<!-- components/modal.blade.php - MODAL DIALOG (ALPINE.JS) -->
<!-- ============================================ -->
<!-- Peran: komponen modal bawaan Breeze yang dipanggil sebagai x-modal, dipakai untuk dialog konfirmasi, form kecil, dll. -->
<!-- Data: prop 'name' (penanda unik modal), 'show' (default false), 'maxWidth' (sm/md/lg/xl/2xl). -->
<!-- Alur: modal dikendalikan Alpine.js; terbuka lewat event kustom 'open-modal' (di-dispatch dari tombol pemanggil dengan dispatch('open-modal')) dan tertutup lewat 'close-modal', klik di luar, atau tombol Escape. -->
@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
// Blok PHP: memetakan opsi maxWidth (sm/md/lg/xl/2xl) menjadi class Tailwind 'sm:max-w-...'
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<!-- State & perilaku modal (Alpine.js): x-data menyimpan status buka/tutup dan fungsi navigasi fokus; x-init mengunci scroll body serta memindahkan fokus ke elemen pertama saat modal terbuka -->
<div
    x-data="{
        show: @js($show),
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <!-- Lapisan backdrop (latar gelap): ditampilkan dengan animasi fade dan diklik untuk menutup modal -->
    <div
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-base-content/20"></div>
    </div>

    <!-- Panel modal: wadah konten utama, lebarnya mengikuti $maxWidth; tampil dengan animasi slide + scale -->
    <div
        x-show="show"
        class="mb-6 bg-base-100 rounded-box shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        <!-- $slot: isi modal (judul, teks, dan tombol aksi) yang dikirim pemanggil -->
        {{ $slot }}
    </div>
</div>