<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Hotel') }}
            <span class="float-right flex">
                <x-a-button :href="url('hotels')" class="ml-1">Hotels</x-a-button>
            </span>
        </h2>
    </x-slot>
    <div class="py-12">
        <livewire:employee-component :hotelId="$data[0]->id" />
    </div>
</x-app-layout>
