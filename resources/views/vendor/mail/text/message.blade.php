<!-- ====================================================================
     MESSAGE - TEMPLATE MAIL BAWAAN LARAVEL (VERSI TEKS)
     --------------------------------------------------------------------
     Kerangka pesan email standar: menyusun header (nama aplikasi),
     isi pesan, subcopy (opsional), dan footer ke dalam layout.
     Dipakai untuk notifikasi sistem seperti verifikasi email dan
     reset password (class VerifyEmailNotification & ResetPasswordNotification).
     ==================================================================== -->
<x-mail::layout>
    {{-- Header: menampilkan nama aplikasi sebagai tautan ke situs --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">
            {{ config('app.name') }}
        </x-mail::header>
    </x-slot:header>

    {{-- Body: isi utama email --}}
    {{ $slot }}

    {{-- Subcopy: catatan tambahan kecil di bawah isi email (opsional) --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy>
                {{ $subcopy }}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer: baris penutup dengan tahun berjalan dan nama aplikasi --}}
    <x-slot:footer>
        <x-mail::footer>
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
