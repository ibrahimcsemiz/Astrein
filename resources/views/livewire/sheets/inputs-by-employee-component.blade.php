<div class="w-full">
    <div class="lg:flex">
        <div class="w-full mr-1">
            <x-form.select wire:model.live="hotelId">
                <x-slot name="options">
                    <option value="">{{ __('language.select_hotel') }}</option>
                    @foreach($hotels as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                    @endforeach
                </x-slot>
            </x-form.select>
        </div>
        <div class="w-full mr-1">
            <x-form.select wire:model.live="employeeId">
                <x-slot name="options">
                    <option value="">{{ __('language.select_employee') }}</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
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
    <div>
        @if($employeeId)
        <x-table>
            <x-slot name="thead">
                <x-table.th>
                    Day
                </x-table.th>
                @foreach($servicePlans as $servicePlan)
                    <x-table.th class="text-center">{{ $servicePlan->name }}</x-table.th>
                @endforeach
                <x-table.th class="text-center">Hours</x-table.th>
            </x-slot>
            <x-slot name="tbody">
                @foreach(array_slice($rows, 0, -1) as $row)
                    <tr>
                        <x-table.td class="bg-indigo-50 font-semibold w-1/12">
                            {{ $row['date'] ?? '' }}
                        </x-table.td>
                        @foreach($row['sheet'] ?? [] as $value)
                            <x-table.td>
                                {{ $value['value'] ?? 0 }}
                            </x-table.td>
                        @endforeach
                        <x-table.td>
                            {{ \App\Helper\TimeHelper::convertMinToTime(($row['time'] ?? 0)) }}
                        </x-table.td>
                    </tr>
                @endforeach
                    <tr>
                        <x-table.td colspan="{{ count($servicePlans) + 1 }}"></x-table.td>
                        <x-table.td class="bg-indigo-50 font-semibold">
                            {{ \App\Helper\TimeHelper::convertMinToTime(($rows['total_time'] ?? 0)) }}
                        </x-table.td>
                    </tr>
            </x-slot>
        </x-table>
        @endif
    </div>
</div>
