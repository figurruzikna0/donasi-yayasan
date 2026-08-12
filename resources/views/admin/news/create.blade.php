<!-- ============================================ -->
<!-- admin\news\create.blade.php                  -->
<!-- Halaman form pembuatan berita baru           -->
<!-- Dipakai oleh Admin\NewsController@create     -->
<!-- Alur: menyiapkan variabel form (null, route  -->
<!-- store, method POST, judul halaman) lalu      -->
<!-- me-render form bersama via include          -->
<!-- ============================================ -->
@php
    $news       = null;
    $formAction = route('admin.news.store');
    $formMethod = 'POST';
    $pageTitle  = 'Buat Berita Baru / Artikel';
    $headerSub  = 'Tulis narasi, press release, atau laporan kegiatan baru';
@endphp

<!-- Memuat form berita yang sama dengan create/edit; -->
<!-- variabel $news = null menandakan mode tambah baru -->
@include('admin.news.form')
