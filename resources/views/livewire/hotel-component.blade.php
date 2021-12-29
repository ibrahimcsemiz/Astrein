<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Hotels') }}
        <span class="float-right">
            <x-a-button :href="url('hotels/create')">Add New Hotel</x-a-button>
        </span>
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200" style="overflow-x: auto; width: 100%;">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <x-crud-alerts class="mb-4" />
                <div class="flex w-full items-center">
                    <x-input
                        wire:model.live="search"
                        id="name"
                        class="block w-full mb-2 mr-2 flex"
                        type="text"
                        placeholder="Search by name, telephone, email, region, city, foreman or manager" />
                </div>
                <x-table>
                    <x-slot name="thead">
                        <x-table-th>
                            <a class="flex underline items-center" style="cursor: pointer;" wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null">
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
                        </x-table-th>
                        <x-table-th>Telephone</x-table-th>
                        <x-table-th>Region</x-table-th>
                        <x-table-th>City</x-table-th>
                        <x-table-th>Foreman</x-table-th>
                        <x-table-th>Manager</x-table-th>
                        <x-table-th>Manage</x-table-th>
                    </x-slot>
                    @forelse($hotels as $hotel)
                        <tr>
                            <x-table-column><a class="text-orange-800 hover:text-indigo-600" href="{{ route('hotels.show', $hotel->id) }}">{{ $hotel->name }}</a></x-table-column>
                            <x-table-column>{{ $hotel->telephone ?? '-' }}</x-table-column>
                            <x-table-column>{{ $hotel->region->name }}</x-table-column>
                            <x-table-column>{{ $hotel->city }}</x-table-column>
                            <x-table-column>{{ $hotel->foreman->name }}</x-table-column>
                            <x-table-column>{{ $hotel->manager->name }}</x-table-column>
                            <x-table-column>
                                <a href="{{ route('hotels.edit', $hotel->id) }}" class="text-indigo-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </x-table-column>
                        </tr>
                    @empty
                        <tr>
                            <x-table-column colspan="7">
                                <div class="flex justify-center items-center">
                                    <span class="py-12 text-gray-500 text-xl flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        No results were found matching your search criteria.
                                    </span>
                                </div>
                            </x-table-column>
                        </tr>
                    @endforelse
                </x-table>
                <div class="mt-2">
                    {{ $hotels->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
