@php
    $news       = null;
    $formAction = route('admin.news.store');
    $formMethod = 'POST';
    $pageTitle  = 'Tambah Berita Kegiatan';
    $headerSub  = 'Tulis narasi, press release, atau laporan kegiatan baru';
@endphp

@include('admin.news.form')