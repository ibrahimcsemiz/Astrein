<x-app-layout>
    <x-slot name="header">
        {{ __('language.add_new_employee') }}
        <span class="float-right">
            <x-links.button href="{{ route('employees.index') }}" do="list">{{ __('language.employees') }}</x-links.button>
        </span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('employees.store') }}" method="post">
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <x-form.label required>{{ __('language.name') }}</x-form.label>
                                            <x-form.input id="name" type="text" name="name" value="{{ old('name') }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <x-form.label required>{{ __('language.email') }}</x-form.label>
                                            <x-form.input id="email" type="email" name="email" value="{{ old('email') }}" required />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label required>{{ __('language.telephone') }}</x-form.label>
                                            <x-form.input id="telephone" type="text" name="telephone" value="{{ old('telephone') }}" required />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label>{{ __('language.city') }}</x-form.label>
                                            <x-form.input id="city" type="text" name="city" value="{{ old('city') }}" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label>{{ __('language.birth_date') }}</x-form.label>
                                            <x-form.input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}" />
                                        </div>

                                        <div class="col-span-6">
                                            <x-form.label>{{ __('language.address') }}</x-form.label>
                                            <x-form.input id="address" type="text" name="address" value="{{ old('address') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <x-form.button type="submit" color="green">
                                        {{ __('language.save') }}
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
