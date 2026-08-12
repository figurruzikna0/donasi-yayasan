<!-- ====================================================================
     LAYOUT - TEMPLATE MAIL BAWAAN LARAVEL (VERSI HTML)
     --------------------------------------------------------------------
     Kerangka HTML lengkap email. Menggunakan layout berbasis <table>
     agar kompatibel dengan semua aplikasi email (Gmail, Outlook, dll).
     Variabel: $header (kepala email), $slot (isi pesan Markdown),
     $subcopy (catatan kecil opsional), $footer (kaki email),
     dan $head (HTML tambahan pada bagian <head>).
     ==================================================================== -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>{{ config('app.name') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
{{-- CSS responsif: menyesuaikan lebar konten pada layar sempit (ponsel) --}}
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>
{!! $head ?? '' !!}
</head>
<body>

{{-- Tabel pembungkus: latar email selebar penuh, isi ditempatkan di tengah --}}
<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
{{-- Tabel konten: memuat header, body, dan footer email --}}
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
{!! $header ?? '' !!}

<!-- Email Body -->
<tr>
<td class="body" width="100%" cellpadding="0" cellspacing="0" style="border: hidden !important;">
<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<!-- Body content -->
<tr>
<td class="content-cell">
{{-- $slot: isi utama email, diparsing dari Markdown menjadi HTML --}}
{!! Illuminate\Mail\Markdown::parse($slot) !!}

{{-- $subcopy: catatan kecil di bawah isi (opsional) --}}
{!! $subcopy ?? '' !!}
</td>
</tr>
</table>
</td>
</tr>

{!! $footer ?? '' !!}
</table>
</td>
</tr>
</table>
</body>
</html>