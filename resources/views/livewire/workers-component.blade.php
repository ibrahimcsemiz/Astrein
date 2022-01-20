
    <div class="w-1/3 mr-1">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <x-form.input wire:model.debounce.100ms="search" id="search" type="text" placeholder="{{ __('language.search_by_employee_name') }} {{ __('language.please_type_minimum_3_characters') }}" />
                    @if(strlen($search) >= 3)
                        <x-table hv="vertical" class="mt-0 py-0">
                            <x-slot name="rows">
                                @forelse($users as $user)
                                    <tr>
                                        <x-table.th class="bg-gray-50">
                                            <x-links.default wire:click="store({{ $user->id }})">
                                                {{ $user->name }}
                                            </x-links.default>
                                        </x-table.th>
                                    </tr>
                                @empty
                                    <tr>
                                        <x-table.th>
                                            <div class="flex justify-center items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                </svg>
                                                {{ __('language.no_results') }}
                                            </div>
                                        </x-table.th>
                                    </tr>
                                @endforelse
                            </x-slot>
                        </x-table>
                    @endif
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <x-table>
                        <x-slot name="thead">
                            <tr>
                                <x-table.th colspan="2" class="text-center text-lg bg-gray-100">{{ __('language.employees') }}</x-table.th>
                            </tr>
                            <x-table.th>{{ __('language.name') }}</x-table.th>
                            <x-table.th manage="1"></x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                        @forelse($employees as $employee)
                            <tr>
                                @if(count($employee->hotel->pluck('id')->toArray()) > 1)
                                    <x-table.td>
                                            <a class="text-orange-800 hover:text-indigo-600" href="{{ route('users.show', $employee->id) }}">{{ $employee->name }}</a>
                                    </x-table.td>
                                @else
                                    <x-table.td>
                                            <a class="text-orange-800 hover:text-indigo-600" href="{{ route('users.show', $employee->id) }}">{{ $employee->name }}</a>
                                    </x-table.td>
                                @endif
                                <x-table.td>
                                    <x-links.default wire:click="destroy({{ $employee->id }})" onclick="return confirm('{{ __('language.are_you_sure') }}') || event.stopImmediatePropagation()">{{ __('language.delete') }}</x-links.default>
                                </x-table.td>
                            </tr>
                        @empty
                           <tr>
                               <x-table.td>
                                   <div class="flex justify-center items-center text-md">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                       </svg>
                                       {{ __('language.employee_not_found') }}
                                   </div>
                               </x-table.td>
                           </tr>
                        @endforelse
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>

