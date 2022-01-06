@props(['active'])

@php
    $classes = ($active ?? false)
            ? 'bg-gray-100 block px-4 py-2 text-sm text-gray-700'
            : 'block px-4 py-2 text-sm text-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
