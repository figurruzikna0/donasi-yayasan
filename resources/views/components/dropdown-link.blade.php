<!-- ============================================ -->
<!-- components/dropdown-link.blade.php - ITEM DROPDOWN -->
<!-- ============================================ -->
<!-- Peran: komponen item/tautan di dalam menu dropdown yang dipanggil sebagai x-dropdown-link, biasanya dikombinasikan dengan x-dropdown. -->
<!-- Data: $attributes menampung atribut tautan (href, dll.); $slot berisi teks menu. -->
<!-- Alur: class default item digabung dengan atribut pemanggil lewat $attributes->merge(), lalu dirender sebagai tautan satu baris. -->
<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-sm text-base-content/70 hover:bg-base-200']) }}>{{ $slot }}</a>