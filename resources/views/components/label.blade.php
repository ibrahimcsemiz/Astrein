@props(['value'])

<label {{ $attributes->merge(['class' => 'font-semi-bold text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
