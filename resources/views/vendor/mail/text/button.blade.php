<!-- ====================================================================
     KOMPONEN TOMBOL - TEMPLATE MAIL BAWAAN LARAVEL (VERSI TEKS)
     --------------------------------------------------------------------
     Bagian dari template mail bawaan Laravel (hasil "php artisan vendor:publish --tag=laravel-mail").
     Merender tombol sebagai teks polos: "Teks Tombol: URL".
     Dipakai pada email verifikasi/reset password; variabel $slot berisi
     teks tombol dan $url berisi tautan tujuan.
     ==================================================================== -->
{{ $slot }}: {{ $url }}
