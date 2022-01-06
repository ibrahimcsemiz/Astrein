<x-slot name="header">
    {{ __('Employees') }}
    <span class="float-right">
        <x-links.button href="{{ route('employees.create') }}" button="create">
            {{ __('Add New Employee') }}
        </x-links.button>
    </span>
</x-slot>

<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <x-crud-alerts class="mb-4" />
                <div class="lg:flex">
                    <x-form.inline.input wire:model.live="search" id="name" type="text" placeholder="Search by name, telephone or hotels" />
                    <x-form.inline.select wire:model.live="status">
                        <x-slot name="options">
                            <option value="">Search by status</option>
                            <option value="1">Active</option>
                            <option value="0">Banned</option>
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
                        <x-table.th>
                            <a>Telephone</a>
                        </x-table.th>
                        <x-table.th>
                            Hotels
                        </x-table.th>
                        <x-table.th>
                            <a>Status</a>
                        </x-table.th>
                        <x-table.th manage="1"></x-table.th>
                    </x-slot>
                    <x-slot name="tbody">
                    @forelse($employees as $employee)
                        <tr>
                            <x-table.td>{{ $employee->name }}</x-table.td>
                            <x-table.td>{{ $employee->contact->telephone ?? '' }}</x-table.td>
                            <x-table.td>{{ $employee->hotel->pluck('name')->implode('<br>') }}</x-table.td>
                            <x-table.td>
                                <a style="cursor:pointer;" wire:click="updateStatus({{ $employee->id }})" class="flex items-center">
                                    @if($employee->status == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </a>
                            </x-table.td>
                            <x-table.td>
                                <x-links.default href="{{ route('employees.edit', $employee->id) }}">
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
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
