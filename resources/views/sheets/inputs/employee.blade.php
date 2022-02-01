<x-app-layout>
    <x-slot name="header">
        {{ __('language.sheets') }}
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <livewire:sheets.inputs-by-employee-component />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
