@props(['active'])

@php
$classes = ($active ?? false)
            ? 'btn btn-ghost btn-sm text-base-content'
            : 'btn btn-ghost btn-sm text-base-content/60 hover:text-base-content';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
