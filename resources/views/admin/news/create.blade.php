@php
    $news       = null;
    $formAction = route('admin.news.store');
    $formMethod = 'POST';
    $pageTitle  = 'Buat Berita Baru / Artikel';
    $headerSub  = 'Tulis narasi, press release, atau laporan kegiatan baru';
@endphp

@include('admin.news.form')