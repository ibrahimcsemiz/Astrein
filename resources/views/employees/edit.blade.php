<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Employee') }}
        <span class="float-right flex">
            <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                @method('DELETE')
                @csrf
                <x-button onclick="return confirm('Are you sure?')" class="mt-2 text-red-600">
                    {{ __('Delete') }}
                </x-button>
            </form>
            <x-a-button :href="url('employees')" class="ml-1">Employees</x-a-button>
        </span>
    </x-slot>
    <div class="py-12">
        <form action="{{ route('employees.update', $employee->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <x-crud-alerts class="mb-4" />
                        <div>
                            <div>
                                <x-input id="name" class="block mt-1 w-full required:border-red-300" type="text" name="name" value="{{ $employee->name }}" placeholder="Name" required />
                            </div>
                            <div>
                                <x-input id="email" class="block mt-1 w-full required:border-red-300" type="email" name="email" value="{{ $employee->email }}" placeholder="Email" required />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h6 class="font-semibold text-xl text-gray-800 leading-tight ml-6 mt-2 -mb-4">&rightarrow; Contact Information</h6>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div>
                            <div>
                                <x-input id="telephone" class="block mt-1 w-full required:border-red-300" type="text" name="telephone" value="{{ $employee->contact->telephone ?? '' }}" placeholder="Telephone" required />
                            </div>
                            <div>
                                <x-input id="city" class="block mt-1 w-full" type="text" name="city" value="{{ $employee->contact->city ?? '' }}" placeholder="City" />
                            </div>
                            <div>
                                <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $employee->contact->address ?? '' }}" placeholder="Address" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h6 class="font-semibold text-xl text-gray-800 leading-tight ml-6 mt-2 -mb-4">&rightarrow; Personal Information</h6>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div>
                            <div>
                                <x-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" value="{{ $employee->personal->birth_date ?? '' }}" placeholder="Birth Date" />
                            </div>
                        </div>
                        <x-button class="mt-2">
                            {{ __('Update') }}
                        </x-button>
                        <span class="block float-right text-xs text-red-600 mt-2"><em>* Required fields are red.</em></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
