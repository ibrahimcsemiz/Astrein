<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="w-full p-2">
            <div class="flex w-full items-center">
                <x-input
                    wire:model.debounce.1500ms="search"
                    id="search"
                    class="block w-full mb-2 mr-2 flex"
                    type="text"
                    placeholder="Search by employee name (Please type minimum 3 characters)" />
            </div>
        </div>
        <div class="w-2/3 float-left flex">
            <div class="p-6 bg-white" style="overflow-x: auto; width: 100%;">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <x-crud-alerts class="mb-4" />
                @if(strlen($search) >= 3)
                    <x-table>
                        <x-slot name="thead">
                            <x-table-th>#</x-table-th>
                            <x-table-th>Name</x-table-th>
                            <x-table-th>Hotel</x-table-th>
                        </x-slot>
                        @forelse($users as $user)
                            <tr>
                                <x-table-column>
                                    @if(in_array($id, $user->hotel->pluck('id')->toArray()))
                                        <a wire:click="destroy({{ $user->id }})" class="text-red-600" style="cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @else
                                        <a wire:click="store({{ $user->id }})" class="text-green-600" style="cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    @endif
                                </x-table-column>
                                <x-table-column>
                                    <a class="text-orange-800 hover:text-indigo-600" href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                                </x-table-column>
                                <x-table-column>{{ $user->hotel->pluck('name')->implode(', ') }}</x-table-column>
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
                @endif
            </div>
        </div>
        <div class="w-1/3 float-right">
            <div class="p-6 bg-white border-b border-gray-200" style="overflow-x: auto; width: 100%;">
                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <x-table-th colspan="2">Employees</x-table-th>
                        </tr>
                        <tr>
                        <x-table-th>#</x-table-th>
                        <x-table-th>Name</x-table-th>
                        </tr>
                    </x-slot>
                    @forelse($employees as $employee)
                        <tr>
                            <x-table-column>
                                @if(in_array($id, $employee->hotel->pluck('id')->toArray()))
                                    <a wire:click="destroy({{ $employee->id }})" class="text-red-600" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    <a wire:click="store({{ $employee->id }})" class="text-green-600" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif
                            </x-table-column>
                            @if(count($employee->hotel->pluck('id')->toArray()) > 1)
                                <x-table-column class="bg-orange-300">
                                    <a class="text-orange-800 hover:text-indigo-600" href="{{ route('users.show', $employee->id) }}">{{ $employee->name }}</a>
                                </x-table-column>
                            @else
                                <x-table-column>
                                    <a class="text-orange-800 hover:text-indigo-600" href="{{ route('users.show', $employee->id) }}">{{ $employee->name }}</a>
                                </x-table-column>
                            @endif

                        </tr>
                    @empty
                        <tr>
                            <x-table-column colspan="7">
                                <div class="flex justify-center items-center">
                                    <span class="py-12 text-gray-500 text-xl flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        Empty
                                    </span>
                                </div>
                            </x-table-column>
                        </tr>
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
</div>
