<x-app-layout>
    <x-slot name="header">
        {{ __($hotel->name) }} Inputs
        <span class="float-right">
            <x-links.button href="{{ route('inputs', ['hotel' => $hotel->id]) }}" do="update">{{ __('language.inputs') }}</x-links.button>
            <x-links.button href="{{ route('hotels.show', ['hotel' => $hotel->id]) }}" do="list">{{ __('language.hotels') }}</x-links.button></span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <livewire:input-component :hotelId="$hotel->id" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
