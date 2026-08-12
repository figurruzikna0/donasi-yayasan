<!-- ============================================ -->
<!-- components/secondary-button.blade.php - TOMBOL SEKUNDER -->
<!-- ============================================ -->
<!-- Peran: komponen tombol sekunder Breeze yang dipanggil sebagai x-secondary-button, dipakai untuk aksi batal/kembali pada form. -->
<!-- Data: $attributes menampung atribut tambahan dari pemanggil; $slot berisi teks/label tombol. -->
<!-- Alur: atribut pemanggil digabung dengan tipe default 'button' dan class 'btn btn-outline' lewat $attributes->merge(), lalu $slot dirender di dalam tombol. -->
<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-outline']) }}>
    <!-- $slot: konten tombol yang dikirim pemanggil (misal teks "Batal" atau ikon) -->
    {{ $slot }}
</button>