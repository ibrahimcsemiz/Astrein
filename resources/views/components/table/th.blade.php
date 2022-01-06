@props(['manage'])

@php
    $classes = ($manage ?? false)
            ? 'relative px-6 py-3'
            : 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider';
@endphp

<th scope="col" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot ?? '' }}
</th>
