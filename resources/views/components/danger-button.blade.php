<!-- ============================================ -->
<!-- components/danger-button.blade.php - TOMBOL BAHAYA (HAPUS) -->
<!-- ============================================ -->
<!-- Peran: komponen tombol berbahaya Breeze yang dipanggil sebagai x-danger-button, dipakai untuk aksi penghapusan data. -->
<!-- Data: $attributes menampung atribut dari pemanggil; $slot berisi teks tombol. -->
<!-- Alur: atribut pemanggil digabung dengan tipe default 'submit' dan class 'btn btn-error' lewat $attributes->merge(), lalu $slot dirender di dalam tombol. -->
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-error']) }}>
    <!-- $slot: teks tombol (misal "Hapus") -->
    {{ $slot }}
</button>