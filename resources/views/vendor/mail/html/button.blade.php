<!-- ====================================================================
     KOMPONEN TOMBOL - TEMPLATE MAIL BAWAAN LARAVEL (VERSI HTML)
     --------------------------------------------------------------------
     Merender tombol aksi pada email HTML menggunakan tabel bertingkat
     agar tampil konsisten di berbagai aplikasi email.
     Atribut (props): $url (tautan tujuan), $color (warna tombol,
     default 'primary'), $align (posisi rata, default 'center').
     Dipakai pada email verifikasi/reset password.
     ==================================================================== -->
@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
{{-- Tabel luar: wadah aksi selebar penuh, rata sesuai $align --}}
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
{{-- Tabel terdalam: memuat link tombol berwarna $color ($slot = teks tombol) --}}
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button button-{{ $color }}" target="_blank" rel="noopener">{!! $slot !!}</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>