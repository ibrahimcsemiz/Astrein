<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200" style="overflow-x: auto; width: 100%;">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <x-crud-alerts class="mb-4" />
            <div class="flex w-full items-center">
                <x-input
                    wire:model="search"
                    id="search"
                    class="block w-full mb-2 mr-2 flex"
                    type="text"
                    placeholder="Search by name, telephone, email or city" />
            </div>
            <x-table>
                <x-slot name="thead">
                    <x-table-th>#</x-table-th>
                    <x-table-th>Name</x-table-th>
                    <x-table-th>Email</x-table-th>
                    <x-table-th>Telephone</x-table-th>
                    <x-table-th>City</x-table-th>
                    <x-table-th>Hotel</x-table-th>
                    <x-table-th>Manage</x-table-th>
                </x-slot>
                @forelse($idles as $idle)
                    <tr>
                        <x-table-column>
                            @if(isset($idle->hotel[0]) && $idle->hotel[0]->id == $id)
                                <a wire:click="destroy({{ $idle->id }})" class="text-red-600" style="cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <a wire:click="store({{ $idle->id }})" class="text-green-600" style="cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif
                        </x-table-column>
                        <x-table-column>{{ $idle->name }}</x-table-column>
                        <x-table-column>{{ $idle->email }}</x-table-column>
                        <x-table-column>{{ $idle->contact->telephone ?? '-' }}</x-table-column>
                        <x-table-column>{{ $idle->contact->city ?? '-' }}</x-table-column>
                        <x-table-column>{{ $idle->hotel[0]->name ?? '-' }}</x-table-column>
                        <x-table-column>
                            <a href="{{ route('users.edit', $idle->id) }}" class="text-indigo-700">
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
                {{ $idles->links() }}
            </div>
        </div>
    </div>
</div>
