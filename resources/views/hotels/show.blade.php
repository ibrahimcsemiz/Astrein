<x-app-layout>
    <x-slot name="header">
        {{ __($hotel->name) }}
        <span class="float-right">
            <x-links.button href="{{ route('hotels') }}" do="list">{{ __('language.hotels') }}</x-links.button>
        </span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <x-table hv="vertical">
                            <x-slot name="rows">
                                <tr>
                                    <x-table.th class="bg-gray-50">{{ __('language.telephone') }}</x-table.th>
                                    <x-table.td border="border-b">{{ $hotel->telephone }}</x-table.td>
                                    <x-table.th class="bg-gray-50">{{ __('language.manager') }}</x-table.th>
                                    <x-table.td border="border-b">{{ $hotel->manager->name }}</x-table.td>
                                </tr>
                                <tr>
                                    <x-table.th class="bg-gray-50">{{ __('language.email') }}</x-table.th>
                                    <x-table.td border="border-b">{{ $hotel->email }}</x-table.td>
                                    <x-table.th class="bg-gray-50">{{ __('language.foreman') }}</x-table.th>
                                    <x-table.td border="border-b">{{ $hotel->foreman->name }}</x-table.td>
                                </tr>
                                <tr>
                                    <x-table.th class="bg-gray-50">{{ __('language.address') }}</x-table.th>
                                    <x-table.td border="border-b">{{ $hotel->address }}</x-table.td>
                                </tr>
                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 mt-1 flex">
            <livewire:workers-component :hotelId="$hotel->id" />
            <livewire:service-plan-component :hotelId="$hotel->id" />
        </div>
    </div>
</x-app-layout>
