<!-- ====================================================================
     LAYOUT - TEMPLATE MAIL BAWAAN LARAVEL (VERSI TEKS)
     --------------------------------------------------------------------
     Kerangka utama email versi teks polos. Menyusun urutan bagian:
     header, isi pesan ($slot), subcopy (jika ada), lalu footer.
     Tag HTML dihilangkan dengan strip_tags agar tampil sebagai teks
     biasa di aplikasi email tanpa format.
     ==================================================================== -->
{!! strip_tags($header ?? '') !!}

{!! strip_tags($slot) !!}
@isset($subcopy)
{{-- Subcopy: catatan kecil di bagian bawah isi email (opsional). --}}

{!! strip_tags($subcopy) !!}
@endisset

{!! strip_tags($footer ?? '') !!}
