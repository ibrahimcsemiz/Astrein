<x-app-layout>
    <x-slot name="header">
        {{ __('Add New Employee') }}
        <span class="float-right">
            <x-links.button href="{{ route('employees') }}" do="list">Employees</x-links.button>
        </span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <x-notifications.default />
                        <form action="{{ route('employees.store') }}" method="post">
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <x-form.label required>{{ __('Name') }}</x-form.label>
                                            <x-form.input id="name" type="text" name="name" value="{{ old('name') }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <x-form.label required>{{ __('Email') }}</x-form.label>
                                            <x-form.input id="email" type="email" name="email" value="{{ old('email') }}" required />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label required>{{ __('Telephone') }}</x-form.label>
                                            <x-form.input id="telephone" type="text" name="telephone" value="{{ old('telephone') }}" required />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label>{{ __('City') }}</x-form.label>
                                            <x-form.input id="city" type="text" name="city" value="{{ old('city') }}" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label>{{ __('Birth Date') }}</x-form.label>
                                            <x-form.input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}" />
                                        </div>

                                        <div class="col-span-6">
                                            <x-form.label>{{ __('Address') }}</x-form.label>
                                            <x-form.input id="address" type="text" name="address" value="{{ old('address') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <x-form.button type="submit" color="green">
                                        {{ __('Save') }}
                                    </x-form.button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
