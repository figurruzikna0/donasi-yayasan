{{-- COMPONENTS_INPUT_ERROR: menampilkan daftar error validasi untuk field tertentu dengan ikon peringatan --}}
@props(['messages'])

{{-- BAGIAN: menampilkan daftar pesan error validasi dengan ikon peringatan --}}
@if ($messages)
    <ul {{ $attributes->merge(['class' => 'mt-1.5 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-start gap-1.5 text-xs text-rose-600 dark:text-rose-400">
                <svg class="w-3.5 h-3.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif
