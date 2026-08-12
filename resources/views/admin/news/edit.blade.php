<!-- ============================================ -->
<!-- admin\news\edit.blade.php                    -->
<!-- Halaman form pengubahan berita yang ada      -->
<!-- Dipakai oleh Admin\NewsController@edit       -->
<!-- Alur: menyiapkan variabel form (route update, -->
<!-- method PUT, judul halaman) lalu me-render    -->
<!-- form bersama via include; data $news sudah  -->
<!-- dikirim controller dari database             -->
<!-- ============================================ -->
@php
    $formAction = route('admin.news.update', $news->id);
    $formMethod = 'PUT';
    $pageTitle  = 'Edit Berita / Artikel';
    $headerSub  = 'Perbarui narasi atau informasi berita yang sudah ada';
@endphp

<!-- Memuat form berita yang sama dengan create/edit; -->
<!-- method PUT menandakan mode perbarui data         -->
@include('admin.news.form')
