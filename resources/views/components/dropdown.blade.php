<!-- ============================================ -->
<!-- components/dropdown.blade.php - DROPDOWN MENU -->
<!-- ============================================ -->
<!-- Peran: komponen dropdown bawaan Breeze yang dipanggil sebagai x-dropdown, berisi $trigger (elemen pemicu) dan $content (isi menu). -->
<!-- Data: prop 'align' ('left'/'top'/'right'), 'width' ('48' atau kelas lain), 'contentClasses' untuk kelas tambahan panel menu. -->
<!-- Alur: dibuka/ditutup dengan klik pada $trigger (state Alpine 'open'); panel menu muncul dengan animasi transisi dan ditutup jika klik di luar area (@click.outside). -->
@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
// Blok PHP: memetakan arah dropdown menjadi kelas posisi Tailwind (kiri/tengah/kanan) sesuai arah teks (ltr/rtl)
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

// Blok PHP: memetakan ukuran lebar menu ('48' menjadi w-48; selain itu memakai kelas kustom pemanggil)
$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<!-- Pembungkus dropdown: state 'open' dikelola Alpine.js; menu tertutup saat klik di luar atau event close -->
<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <!-- $trigger: elemen pemicu (tombol/ikon/tautan) yang bila diklik membalik status buka-tutup -->
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <!-- Panel menu dropdown: tampil saat 'open' true dengan animasi transisi; diklik menu mana pun akan menutupnya -->
    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <!-- $content: isi daftar menu yang dikirim pemanggil (biasanya berisi x-dropdown-link) -->
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>