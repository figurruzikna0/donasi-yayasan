@props(['active'])

@php
$classes = ($active ?? false)
            ? 'menu-item text-base-content font-medium'
            : 'menu-item text-base-content/60 hover:text-base-content';
@endphp

<a {{ $attributes->merge(['class' => $classes']) }}>
    {{ $slot }}
</a>
