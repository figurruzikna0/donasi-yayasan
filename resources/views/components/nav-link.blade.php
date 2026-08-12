<!-- ============================================ -->
<!-- components/nav-link.blade.php - TAUTAN NAVIGASI -->
<!-- ============================================ -->
<!-- Peran: komponen tautan menu navigasi desktop yang dipanggil sebagai x-nav-link, dipakai di navbar user (misal menu Dashboard). -->
<!-- Data: prop 'active' (boolean) menandai halaman yang sedang aktif; $attributes menampung atribut tautan (href dll.); $slot berisi teks menu. -->
<!-- Alur: kelas tombol aktif/non-aktif ditentukan di php, digabung dengan atribut pemanggil lewat $attributes->merge(), lalu dirender sebagai <a>. -->
@props(['active'])

@php
// Blok PHP: pilih kelas DaisyUI 'btn btn-ghost btn-sm' dengan variasi warna teks untuk item aktif
$classes = ($active ?? false)
            ? 'btn btn-ghost btn-sm text-base-content'
            : 'btn btn-ghost btn-sm text-base-content/60 hover:text-base-content';
@endphp

<!-- Tautan menu: merge() menggabungkan kelas hasil perhitungan dengan atribut pemanggil -->
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>