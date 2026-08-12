<!-- ============================================ -->
<!-- components/admin-form-card.blade.php - KARTU FORM ADMIN -->
<!-- ============================================ -->
<!-- Peran: komponen pembungkus form CRUD di panel admin yang dipanggil sebagai x-admin-form-card, memberi tampilan kartu yang konsisten pada semua halaman admin. -->
<!-- Data: prop 'icon' (HTML ikon, opsional), 'title' (judul kartu), 'subtitle' (deskripsi opsional), 'maxWidth' (2xl/3xl/4xl/5xl/full). -->
<!-- Alur: tampilkan latar gradasi hijau muda, kartu putih dengan header gradasi hijau (ikon + judul + subtitle), lalu body kartu berisi $slot (isi form dari halaman admin). -->
@props([
    'icon' => null,
    'title' => '',
    'subtitle' => '',
    'maxWidth' => '3xl',
])

@php
// Blok PHP: memetakan opsi maxWidth menjadi class lebar maksimum Tailwind
$maxWidthClass = match($maxWidth) {
    '2xl' => 'max-w-2xl',
    '4xl' => 'max-w-4xl',
    '5xl' => 'max-w-5xl',
    'full' => 'max-w-full',
    default => 'max-w-3xl',
};
@endphp

<!-- Latar halaman bergradasi hijau muda di sekeliling kartu -->
<div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
    <!-- Pembungkus konten: lebarnya mengikuti $maxWidthClass -->
    <div class="{{ $maxWidthClass }} mx-auto sm:px-6 lg:px-8">
        <!-- Kartu utama tempat form dirender -->
        <div class="card bg-base-100 shadow-lg border border-emerald-200">
            <!-- Header kartu bergradasi hijau: ikon opsional, judul, dan subtitle -->
            <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                <!-- if: ikon hanya dirender jika prop 'icon' diisi pemanggil -->
                @if($icon)
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                    {!! $icon !!}
                </div>
                @endif
                <div>
                    <h3 class="text-white font-bold text-lg">{{ $title }}</h3>
                    <!-- if: subtitle opsional di bawah judul -->
                    @if($subtitle)
                    <p class="text-white/80 text-sm">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
            <!-- Body kartu: $slot berisi seluruh isi form (input, tombol simpan, dll.) dari halaman admin -->
            <div class="card-body p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>