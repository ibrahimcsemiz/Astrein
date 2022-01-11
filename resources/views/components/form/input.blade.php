@error($attributes['name'])
    <input {{ $attributes->merge(['class' => 'mt-1 sm:mb-1 lg:mr-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md']) }}>
@else
    <input {{ $attributes->merge(['class' => 'mt-1 sm:mb-1 lg:mr-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md']) }}>
@enderror
@error($attributes['name'])
    <x-form.error>{{ $message }}</x-form.error>
@enderror
