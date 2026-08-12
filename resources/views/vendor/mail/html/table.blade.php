<!-- ====================================================================
     KOMPONEN TABEL - TEMPLATE MAIL BAWAAN LARAVEL (VERSI HTML)
     --------------------------------------------------------------------
     Merender tabel dari sintaks Markdown menjadi tabel HTML pada email,
     misalnya untuk laporan rincian donasi/sponsorship.
     Isi $slot diproses dengan Illuminate\Mail\Markdown::parse().
     ==================================================================== -->
<div class="table">
{{-- $slot: konten tabel dalam Markdown, diparsing menjadi HTML --}}
{{ Illuminate\Mail\Markdown::parse($slot) }}
</div>