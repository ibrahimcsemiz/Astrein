<x-slot name="header">
    {{ __('Hotels') }}
    <span class="float-right">
        <x-links.button href="{{ route('hotels.create') }}" button="create">
            {{ __('Add New Hotel') }}
        </x-links.button>
    </span>
</x-slot>

<div class="py-6">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <x-crud-alerts class="mb-4" />
                <div class="lg:flex">
                    <x-form.inline.input wire:model.live="search" id="name" type="text" placeholder="Search by name, telephone, city, foreman or manager" />
                    <x-form.inline.select wire:model.live="region">
                        <x-slot name="options">
                            <option value="">Search by region</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </x-slot>
                    </x-form.inline.select>
                </div>
                <x-table>
                    <x-slot name="thead">
                        <x-table.th>
                            <a class="flex underline items-center" style="cursor: pointer;" wire:click="sortBy('name')" direction="{{ $sortField === 'name' ? $sortDirection : null }}">
                            Name
                            @if($sortDirection === 'desc' && $sortField === 'name')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                            @endif
                            </a>
                        </x-table.th>
                        <x-table.th>Telephone</x-table.th>
                        <x-table.th>Region</x-table.th>
                        <x-table.th>City</x-table.th>
                        <x-table.th>Foreman</x-table.th>
                        <x-table.th>Manager</x-table.th>
                        <x-table.th title="Total Employees">TE</x-table.th>
                        <x-table.th title="Total Service Plan">TSP</x-table.th>
                        <x-table.th manage="1"></x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                    @forelse($hotels as $hotel)
                        <tr>
                            <x-table.td>
                                <x-links.default href="{{ route('hotels.show', $hotel->id) }}">
                                    {{ $hotel->name }}
                                </x-links.default>
                            </x-table.td>
                            <x-table.td>{{ $hotel->telephone ?? '' }}</x-table.td>
                            <x-table.td>{{ $hotel->region->name }}</x-table.td>
                            <x-table.td>{{ $hotel->city }}</x-table.td>
                            <x-table.td>{{ $hotel->foreman->name }}</x-table.td>
                            <x-table.td>{{ $hotel->manager->name }}</x-table.td>
                            <x-table.td>{{ count($hotel->employees) }}</x-table.td>
                            <x-table.td>{{ count($hotel->servicePlans) }}</x-table.td>
                            <x-table.td>
                                <x-links.default href="{{ route('hotels.edit', $hotel->id) }}">
                                    {{ __('Edit') }}
                                </x-links.default>
                            </x-table.td>
                        </tr>
                        @empty
                        <tr>
                            <x-table.td>
                                <div class="flex justify-center items-center text-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    No results were found matching your search criteria.
                                </div>
                            </x-table.td>
                        </tr>
                        @endforelse
                    </x-slot>
                </x-table>
                <div class="mt-2">
                    {{ $hotels->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
