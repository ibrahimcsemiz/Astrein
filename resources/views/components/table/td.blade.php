@props(['border'])

@php
    $attr = $border ?? false;
    if ($attr) {
        $b = $border;
    } else {
        $b = 'border';
    }
@endphp

<td {{ $attributes->merge(['class' => 'px-2 py-4 whitespace-nowrap ' . $b]) }}>
    <div class="text-xs text-gray-600">
        {{ $slot }}
    </div>
</td>
