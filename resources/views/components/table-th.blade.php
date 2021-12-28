@props(['colspan' => ''])

<td {{ $colspan ? 'colspan=' . $colspan : '' }} class="border px-4 py-2 bg-gray-800 text-white {{ $colspan ? 'text-center text-xl bg-gray-600' : '' }}">
    <b>{{ $slot }}</b>
</td>
