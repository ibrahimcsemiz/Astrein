@props(['color'])

@php
    $color = $color ?? false;
    if ($color) {
        $classes = 'inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-' . $color . '-600 hover:bg-' . $color . '-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-' . $color . '-500';
    } else {
        $classes = 'inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500';
    }
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
