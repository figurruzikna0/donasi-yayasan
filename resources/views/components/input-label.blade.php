<!-- ============================================ -->
<!-- components/input-label.blade.php - LABEL INPUT -->
<!-- ============================================ -->
<!-- Peran: komponen label field form yang dipanggil sebagai x-input-label, menampilkan keterangan di atas input. -->
<!-- Data: prop 'value' (teks label, opsional) dan $slot sebagai alternatif; $attributes menampung atribut tambahan (for, dll.). -->
<!-- Alur: atribut pemanggil (misal atribut for yang menunjuk id input) digabung dengan class default lewat $attributes->merge(), lalu teks label dirender memakai 'value' atau isi $slot. -->
@props(['value'])

<!-- merge(): class default digabung dengan atribut tambahan pemanggil (misal atribut for terkait id input) -->
<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-base-content/80']) }}>
    <!-- Tampilkan prop 'value' jika diisi, jika tidak tampilkan isi $slot -->
    {{ $value ?? $slot }}
</label>