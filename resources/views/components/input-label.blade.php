@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-base-content/80']) }}>
    {{ $value ?? $slot }}
</label>
