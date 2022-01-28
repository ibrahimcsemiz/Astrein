<div class="w-full">
    <div class="lg:flex">
        <div class="w-full mr-1">
            <x-form.select wire:model.live="servicePlanId">
                <x-slot name="options">
                    <option value="">Please select service plan</option>
                    @foreach($servicePlans as $servicePlan)
                        <option value="{{ $servicePlan->id }}">{{ $servicePlan->name }}</option>
                    @endforeach
                </x-slot>
            </x-form.select>
        </div>
        <div class="w-full mr-1">
            <x-form.select wire:model.live="month">
                <x-slot name="options">
                    <option value="">Select month</option>
                    @foreach (Str::months() as $monthList)
                        <option value="{{ $monthList }}">{{ $monthList }}</option>
                    @endforeach
                </x-slot>
            </x-form.select>
        </div>
        <div class="w-full">
            <x-form.select wire:model.live="year">
                <x-slot name="options">
                    <option value="">Select year</option>
                    <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                    <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1  }}</option>
                </x-slot>
            </x-form.select>
        </div>
    </div>
    <div wire:loading.delay wire:target="servicePlanId, month, year">
        <div class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
            <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
            <h2 class="text-center text-white dark:text-fuchsia-600 text-xl font-semibold">Loading</h2>
        </div>
    </div>
    @if($servicePlanId)
    <div>
        <x-table>
            <x-slot name="thead">
                <x-table.th>
                    {{ __('language.employees') }}
                    <x-links.default wire:click="show" class="block">{{ $show['text'] }}</x-links.default>
                </x-table.th>
                @for($i = 1; $i <= $days; $i++)
                    <x-table.th class="px-1 text-center">{{ str_pad($i, 2, "0", STR_PAD_LEFT) }}</x-table.th>
                @endfor
            </x-slot>
            <x-slot name="tbody">
                @foreach($employees as $employee)
                <tr>
                    @if($show['status'] == true)
                        <x-table.td class="text-center bg-indigo-50 font-semibold px-0 py-0" rowspan="2">
                            {{ $employee->name }}
                        </x-table.td>
                    @else
                        <x-table.td class="text-center bg-indigo-50 font-semibold px-0 py-0">
                            {{ $employee->name }}
                        </x-table.td>
                    @endif
                    @foreach(range(1, $days) as $day)
                        @php
                            $day = str_pad($day, 2, "0", STR_PAD_LEFT);
                        @endphp
                        <x-table.td class="px-0 py-0">
                            <x-form.input class="p-1 rounded-none border-none" wire:keyup="storeInputs({{ $employee->id }}, '{{ $year . '-' . $month . '-' . $day }}', '{{ 'value' }}')" wire:model="inputs.{{ $employee->id . '_' . $servicePlanId . '_' . $year . '-' . $month . '-' . $day }}.value" type="text" />
                        </x-table.td>
                    @endforeach
                </tr>
                @if($show['status'] == true)
                <tr">
                    @foreach(range(1, $days) as $day)
                        @php
                            $day = str_pad($day, 2, "0", STR_PAD_LEFT);
                        @endphp
                        <x-table.td class="px-0 py-0 mr-1">
                            <x-form.input class="p-1 rounded-none border-none" wire:keyup="storeInputs({{ $employee->id }}, '{{ $year . '-' . $month . '-' . $day }}', '{{ 'value_2' }}')" wire:model="inputs.{{ $employee->id . '_' . $servicePlanId . '_' . $year . '-' . $month . '-' . $day }}.value_2" type="text" />
                        </x-table.td>
                    @endforeach
                </tr>
                @endif
                @endforeach
            </x-slot>
        </x-table>
    </div>
    @endif
</div>
