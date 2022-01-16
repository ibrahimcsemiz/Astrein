<x-app-layout>
    <x-slot name="header">
        {{ __('language.calculation_methods') }}
        <span class="float-right">
            <x-links.button href="{{ route('calculation-methods.create') }}" do="create">{{ __('language.add_new_calculation_method') }}</x-links.button>
        </span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <livewire:calculation-method-component />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
