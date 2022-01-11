@props(['required'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700']) }}>
    {{ $slot ?? '' }} @if($required ?? '') {!! '*' !!} @endif
</label>
