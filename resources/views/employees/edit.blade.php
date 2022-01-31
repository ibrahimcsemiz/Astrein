<x-app-layout>
    <x-slot name="header">
        {{ __('language.edit_employee') }}
        <span class="float-right">
            <x-links.button href="{{ route('employees.index') }}" do="list">{{ __('language.employees') }}</x-links.button>
        </span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('employees.update', $employee->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <x-form.label required>{{ __('language.name') }}</x-form.label>
                                            <x-form.input id="name" type="text" name="name" value="{{ $employee->name }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <x-form.label required>{{ __('language.email') }}</x-form.label>
                                            <x-form.input id="email" type="email" name="email" value="{{ $employee->email }}" required />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label required>{{ __('language.telephone') }}</x-form.label>
                                            <x-form.input id="telephone" type="text" name="telephone" value="{{ $employee->contact->telephone }}" required />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label>{{ __('language.city') }}</x-form.label>
                                            <x-form.input id="city" type="text" name="city" value="{{ $employee->contact->city }}" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label>{{ __('language.birth_date') }}</x-form.label>
                                            <x-form.input id="birth_date" type="date" name="birth_date" value="{{ $employee->personal->birth_date ?? '' }}" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <x-form.label required>{{ __('language.calculation_methods') }}</x-form.label>
                                            <x-form.select id="calculation_method_id" name="calculation_method_id" required>
                                                <x-slot name="options">
                                                    <option value="">{{ __('language.select_a_calculation_method') }}</option>
                                                    @foreach($calculationMethods as $calculationMethod)
                                                        <option value="{{ $calculationMethod->id }}"{{ ($employee->personal->calculation_method_id ?? 0) === $calculationMethod->id ? ' selected' : '' }}>{{ $calculationMethod->name  }}</option>
                                                    @endforeach
                                                </x-slot>
                                            </x-form.select>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <x-form.label>{{ __('language.address') }}</x-form.label>
                                            <x-form.input id="address" type="text" name="address" value="{{ $employee->contact->address }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <x-form.button type="submit" color="orange">
                                        {{ __('language.save') }}
                                    </x-form.button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <x-form.button onclick="return confirm('{{ __('language.are_you_sure') }}')" color="red" class="mt-2">
                                {{ __('language.delete') }}
                            </x-form.button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
