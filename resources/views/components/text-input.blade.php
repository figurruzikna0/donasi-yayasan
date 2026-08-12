<!-- ============================================ -->
<!-- components/text-input.blade.php - INPUT FORM -->
<!-- ============================================ -->
<!-- Peran: komponen input teks bawaan Breeze yang dipanggil sebagai x-text-input pada form (login, register, donasi, pengaturan profil, dll). -->
<!-- Data: prop 'disabled' (default false) untuk mengunci input; $attributes menampung semua atribut tambahan yang dikirim pemanggil. -->
<!-- Alur: atribut pemanggil (name, id, type, required, placeholder, dst.) digabung dengan class default DaisyUI lewat $attributes->merge(), lalu dirender sebagai elemen <input>. -->
@props(['disabled' => false])

<!-- $attributes->merge(): menggabungkan class bawaan dengan class/atribut dari pemanggil; atribut pemanggil menang jika ada konflik -->
<input @disabled($disabled) {{ $attributes->merge(['class' => 'input input-bordered w-full']) }}>