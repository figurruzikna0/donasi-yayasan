<!-- ====================================================================
     KOMPONEN PANEL - TEMPLATE MAIL BAWAAN LARAVEL (VERSI HTML)
     --------------------------------------------------------------------
     Merender kotak sorotan (panel) pada email HTML untuk menonjolkan
     informasi tertentu, misalnya detail transaksi donasi.
     Isi $slot diproses dengan Illuminate\Mail\Markdown::parse()
     sehingga sintaks Markdown berubah menjadi HTML.
     ==================================================================== -->
<table class="panel" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="panel-content">
<table width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="panel-item">
{{-- $slot: konten panel dalam Markdown, diparsing menjadi HTML --}}
{{ Illuminate\Mail\Markdown::parse($slot) }}
</td>
</tr>
</table>
</td>
</tr>
</table>