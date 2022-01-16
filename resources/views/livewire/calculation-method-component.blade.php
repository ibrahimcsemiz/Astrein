<div class="w-full">
    <div class="lg:flex">
        <div class="w-full mr-1">
            <x-form.input wire:model.live="search" id="name" type="text" placeholder="{{ __('language.search_by_name') }}" />
        </div>
        <div class="w-full">
            <x-form.select wire:model.live="limit">
                <x-slot name="options">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="100">100</option>
                    <option value="0">{{ __('language.all') }}</option>
                </x-slot>
            </x-form.select>
        </div>
    </div>
    <x-table>
        <x-slot name="thead">
            <x-table.th>
                <x-links.default class="items-center flex"  wire:click="sortBy('name')" direction="{{ $sortField === 'name' ? $sortDirection : null }}">
                    {{ __('language.name') }}
                    @if($sortField == 'created_at')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    @elseif($sortDirection === 'desc' && $sortField === 'name')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </x-links.default>
            </x-table.th>
            <x-table.th>
                {{ __('language.calculation_per_minute') }}
            </x-table.th>
            <x-table.th manage="1"></x-table.th>
        </x-slot>
        <x-slot name="tbody">
            @forelse($calculationMethods as $calculationMethod)
                <tr>
                    <x-table.td>{{ $calculationMethod->name }}</x-table.td>
                    <x-table.td>{{ $calculationMethod->calculation_per_minute }}</x-table.td>
                    <x-table.td>
                        <x-links.default href="{{ route('calculation-methods.edit', $calculationMethod->id) }}">
                            {{ __('language.edit') }}
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
                            {{ __('language.no_results_were_found_matching_your_search_criteria') }}
                        </div>
                    </x-table.td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>
    <div class="mt-2">
        {{ $calculationMethods->links() }}
    </div>
</div>
