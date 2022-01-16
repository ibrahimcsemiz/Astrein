<x-app-layout>
    <x-slot name="header">
        {{ __('language.edit_calculation_method') }}
        <span class="float-right">
            <x-links.button href="{{ route('calculation-methods.index') }}" do="list">{{ __('language.calculation_methods') }}</x-links.button>
        </span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('calculation-methods.update', $calculationMethod->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.name') }}</x-form.label>
                                            <x-form.input id="name" type="text" name="name" value="{{ $calculationMethod->name }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.calculation_per_minute') }}</x-form.label>
                                            <x-form.input id="calculation_per_minute" type="number" name="calculation_per_minute" value="{{ $calculationMethod->calculation_per_minute }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.editable') }}</x-form.label>
                                            <x-form.input id="editable" type="number" name="editable" value="{{ $calculationMethod->editable }}" required />
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
                        <form action="{{ route('calculation-methods.destroy', $calculationMethod->id) }}" method="post">
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
