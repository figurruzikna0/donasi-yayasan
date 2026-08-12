<!-- ====================================================================
     KOMPONEN HEADER - TEMPLATE MAIL BAWAAN LARAVEL (VERSI HTML)
     --------------------------------------------------------------------
     Merender bagian kepala email HTML: nama aplikasi/yayasan sebagai
     tautan ($url). Bila $slot berupa teks 'Laravel', logo bawaan
     Laravel ditampilkan; selain itu isi $slot dirender apa adanya.
     ==================================================================== -->
@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
{{-- $slot: nama aplikasi; bila 'Laravel' gunakan logo resmi Laravel --}}
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo-v2.1.png" class="logo" alt="Laravel Logo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>