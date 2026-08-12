<!-- ====================================================================
     KOMPONEN FOOTER - TEMPLATE MAIL BAWAAN LARAVEL (VERSI HTML)
     --------------------------------------------------------------------
     Merender bagian kaki email HTML. Isi $slot diproses terlebih dahulu
     dengan Illuminate\Mail\Markdown::parse() sehingga sintaks Markdown
     (seperti teks tebal/link) berubah menjadi HTML.
     ==================================================================== -->
<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">
{{-- $slot: isi footer, diparsing dari Markdown menjadi HTML --}}
{{ Illuminate\Mail\Markdown::parse($slot) }}
</td>
</tr>
</table>
</td>
</tr>