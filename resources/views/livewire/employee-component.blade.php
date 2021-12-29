<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
    <div class="w-1/3 mr-1">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white" style="overflow-x: auto; width: 100%;">
                <x-input
                    wire:model.debounce.100ms="search"
                    id="search"
                    class="block mb-2 w-full flex"
                    type="text"
                    placeholder="Search by employee name (Please type minimum 3 characters)" />
                @if(strlen($search) >= 3)
                    <div class="bg-gray-100">
                        <ul>
                        @forelse($users as $user)
                            <a wire:click="store({{ $user->id }})" class="text-green-800" style="cursor: pointer;">
                                <li class="p-2" style="list-style-type: none">
                                    {{ $user->name }}
                                </li>
                            </a>
                        @empty
                            <li class="p-2" style="list-style-type: none">Not Found</li>
                        @endforelse
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="w-1/3 mr-1">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white" style="overflow-x: auto; width: 100%;">
                <x-input
                    wire:model.debounce.100ms="search"
                    id="search"
                    class="block w-full mb-2 mr-2 flex"
                    type="text"
                    placeholder="Search by employee name (Please type minimum 3 characters)" />
            </div>
        </div>
    </div>

    <div class="w-1/3">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white" style="overflow-x: auto; width: 100%;">
                <h4 class="font-semibold text-lg text-gray-800 leading-tight">&middot; Employees</h4>
                <x-table>
                    <x-slot name="thead">
                        <x-table-th>#</x-table-th>
                        <x-table-th>Name</x-table-th>
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
