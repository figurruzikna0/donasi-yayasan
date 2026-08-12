<!-- ============================================ -->
<!-- components/primary-button.blade.php - TOMBOL PRIMER -->
<!-- ============================================ -->
<!-- Peran: komponen tombol utama berbasis Breeze yang dipanggil sebagai x-primary-button, dipakai untuk tombol submit form (login, register, donasi, dll). -->
<!-- Data: $attributes menampung atribut dari pemanggil; $slot berisi teks tombol. -->
<!-- Alur: atribut pemanggil digabung dengan tipe default 'submit' dan class 'btn btn-neutral' lewat $attributes->merge(), lalu $slot dirender di dalam tombol. -->
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-neutral']) }}>
    <!-- $slot: label tombol dari pemanggil -->
    {{ $slot }}
</button>