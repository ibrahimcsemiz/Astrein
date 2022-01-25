<x-modal.dialog wire:model.defer="showModal">
    <form wire:submit.prevent="{{ $model }}">
        <x-slot name="title">{{ $model == 'store' ? __('language.add') : __('language.edit') }}</x-slot>
        <x-slot name="content">
            <x-form.select wire:model.live="calculationMethodId">
                <x-slot name="options">
                    <option value="">{{ __('language.select_a_calculation_method') }}</option>
                    @foreach($availableMethods as $availableMethod)
                        <option value="{{ $availableMethod->id }}">{{ $availableMethod->name }}</option>
                    @endforeach
                </x-slot>
            </x-form.select>

            @if($calculationMethodId)
                <x-form.label class="text-center font-semibold p-4">{{ $method }}, €{{ $max }} per hour</x-form.label>
            @endif
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <x-form.label>{{ __('language.price') }}</x-form.label>
                    <x-form.input type="number" min="0" step="0.01" max="{{ $max }}" wire:model="price" placeholder="{{ __('language.price') }}" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form.label>{{ __('language.time') }}</x-form.label>
                    <x-form.input type="time" min="00:00:00" step="1" max="01:00:00" wire:model="time" placeholder="{{ __('language.time') }}" />
                </div>
            </div>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <x-form.label>{{ __('language.price_2') }}</x-form.label>
                    <x-form.input type="number" min="0" step="0.01" max="{{ $max }}" wire:model="price2" placeholder="{{ __('language.price_2') }}" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form.label>{{ __('language.time_2') }}</x-form.label>
                    <x-form.input type="time" min="00:00:00" step="1" max="01:00:00" wire:model="time2" placeholder="{{ __('language.time_2') }}" />
                </div>
            </div>

            <x-table>
                <x-slot name="thead">
                    <tr>
                        <x-table.th colspan="6" class="text-lg bg-gray-100">
                            {{ __('language.calculation_methods') }}
                        </x-table.th>
                    </tr>
                    <x-table.th>{{ __('language.name') }}</x-table.th>
                    <x-table.th>{{ __('language.price') }}</x-table.th>
                    <x-table.th>{{ __('language.time') }}</x-table.th>
                    <x-table.th>{{ __('language.price_2') }}</x-table.th>
                    <x-table.th>{{ __('language.time_2') }}</x-table.th>
                    <x-table.th manage="1"></x-table.th>
                </x-slot>
                <x-slot name="tbody">
                    @forelse($selectedMethods as $selectedMethod)
                        <tr>
                            <x-table.td>{{ $selectedMethod->name }}</x-table.td>
                            <x-table.td>€{{ Str::getPrice($selectedMethod->pivot->price) }}</x-table.td>
                            <x-table.td>{{ $selectedMethod->pivot->time }}</x-table.td>
                            <x-table.td>€{{ Str::getPrice($selectedMethod->pivot->price_2) }}</x-table.td>
                            <x-table.td>{{ $selectedMethod->pivot->time_2 }}</x-table.td>
                            <x-table.td>
                                <x-links.default wire:click="edit({{ $selectedMethod->pivot->calculation_method_id }})" class="border-r mr-1">{{ __('language.edit') }}</x-links.default>
                                <x-links.default wire:click="destroy({{ $selectedMethod->pivot->calculation_method_id }})" onclick="return confirm('{{ __('language.are_you_sure') }}') || event.stopImmediatePropagation()">{{ __('language.delete') }}</x-links.default>
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td>
                                <div class="flex justify-center items-center text-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    {{ __('language.calculation_method_not_found') }}
                                </div>
                            </x-table.td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>
        </x-slot>
        <x-slot name="footer">
            <x-form.button type="button" color="red" wire:click="$emit('closeModal')">
                {{ __('language.close') }}
            </x-form.button>
            <x-form.button color="green" type="submit">
                {{ __('language.save') }}
            </x-form.button>
        </x-slot>
    </form>
</x-modal.dialog>
