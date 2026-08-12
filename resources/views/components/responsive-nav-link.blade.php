<!-- ============================================ -->
<!-- components/responsive-nav-link.blade.php - TAUTAN NAVIGASI MOBILE -->
<!-- ============================================ -->
<!-- Peran: komponen tautan menu untuk layar mobile yang dipanggil sebagai x-responsive-nav-link, dipakai pada menu navigasi responsif. -->
<!-- Data: prop 'active' (boolean) menentukan gaya menu aktif; $attributes menampung atribut tautan (href, dst.); $slot berisi teks menu. -->
<!-- Alur: menentukan kelas menu aktif/tidak lewat blok php, lalu $attributes->merge() menggabung kelas tersebut dengan atribut pemanggil pada elemen <a>. -->
@props(['active'])

@php
// Blok PHP: memilih kelas CSS berdasarkan status aktif; menu aktif ditandai warna teks penuh
$classes = ($active ?? false)
            ? 'menu-item text-base-content font-medium'
            : 'menu-item text-base-content/60 hover:text-base-content';
@endphp

<!-- Tautan menu: class hasil perhitungan di atas digabung dengan atribut pemanggil lewat merge() -->
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>