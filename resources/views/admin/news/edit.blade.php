@php
    $formAction = route('admin.news.update', $news->id);
    $formMethod = 'PUT';
    $pageTitle  = 'Edit Berita Kegiatan';
    $headerSub  = 'Perbarui narasi atau informasi berita yang sudah ada';
@endphp

@include('admin.news.form')