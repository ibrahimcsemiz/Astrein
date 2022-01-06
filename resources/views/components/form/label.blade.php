@props(['required'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700']) }}>
    {{ $slot ?? '' }} @if($required ?? '') {!! '<span class="text-red-400">(*)</span>' !!} @endif
</label>
