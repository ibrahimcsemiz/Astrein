<x-app-layout>
    <x-slot name="header">
        {{ __($hotel->name) }}
        <span class="float-right flex">
            <x-a-button :href="url('hotels')" class="ml-1">Hotels</x-a-button>
        </span>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="overflow-x: auto; width: 100%;">
                    <table style="text-align: left;">
                        <tr>
                            <th style="padding: 10px;">Phone</th>
                            <td>:</td>
                            <td style="padding: 10px;">{{ $hotel->telephone }}</td>
                            <th style="padding: 10px;">Manager</th>
                            <td>:</td>
                            <td style="padding: 10px;">{{ $hotel->manager->name }}</td>
                        </tr>
                        <tr>
                            <th style="padding: 10px;">Email</th>
                            <td>:</td>
                            <td style="padding: 10px;">{{ $hotel->email }}</td>
                            <th style="padding: 10px;">Foreman</th>
                            <td>:</td>
                            <td style="padding: 10px;">{{ $hotel->foreman->name }}</td>
                        </tr>
                        <tr>
                            <th style="padding: 10px;">Address</th>
                            <td>:</td>
                            <td style="padding: 10px;">{{ $hotel->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <livewire:workers-component :hotelId="$hotel->id" />
            <livewire:service-plan-component :hotelId="$hotel->id" />
        </div>
    </div>
</x-app-layout>
