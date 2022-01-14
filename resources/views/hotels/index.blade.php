<x-app-layout>
    <x-slot name="header">
        {{ __('language.add_new_hotel') }}
        <span class="float-right">
            <x-links.button href="{{ route('hotels.index') }}" do="list">{{ __('language.hotels') }}</x-links.button>
        </span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <livewire:hotel-component />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
