<!-- ====================================================================
     KOMPONEN SUBCOPY - TEMPLATE MAIL BAWAAN LARAVEL (VERSI HTML)
     --------------------------------------------------------------------
     Merender teks kecil di bagian bawah email HTML, biasanya berisi
     pesan penolong seperti "Jika tombol tidak berfungsi, salin dan
     tempel tautan berikut ke browser Anda.".
     Isi $slot diproses dengan Illuminate\Mail\Markdown::parse().
     ==================================================================== -->
<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
{{-- $slot: konten subcopy dalam Markdown, diparsing menjadi HTML --}}
{{ Illuminate\Mail\Markdown::parse($slot) }}
</td>
</tr>
</table>