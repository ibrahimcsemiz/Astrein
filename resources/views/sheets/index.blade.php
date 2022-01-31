<x-app-layout>
    <x-slot name="header">
        {{ __('language.sheets') }}
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-1">
                            <a class="flex font-bold px-4 py-2 bg-indigo-300 hover:bg-orange-50" href="{{ route('sheets.daily-service-plan') }}"> Input Sheets by Employee</a>
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <a class="flex font-bold px-4 py-2 bg-orange-300 hover:bg-indigo-50" href="#"> Input Sheets by Service Plan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
