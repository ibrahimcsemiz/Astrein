<x-app-layout>
    <x-slot name="header">
        {{ __('Edit User') }}
        <span class="float-right flex">
            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                @method('DELETE')
                @csrf
                <x-button onclick="return confirm('Are you sure?')" class="mt-2 text-red-600">
                    {{ __('Delete') }}
                </x-button>
            </form>
            <x-a-button :href="url('users')" class="ml-1">Users</x-a-button>
        </span>
    </x-slot>
    <div class="py-12">
        <form action="{{ route('users.update', $user->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <x-crud-alerts class="mb-4" />
                        <div>
                            <div>
                                <x-input id="name" class="block mt-1 w-full required:border-red-300" type="text" name="name" value="{{ $user->name }}" placeholder="Name" required />
                            </div>
                            <div>
                                <x-input id="email" class="block mt-1 w-full required:border-red-300" type="email" name="email" value="{{ $user->email }}" placeholder="Email" required />
                            </div>
                            <div>
                                <x-select id="function" class="block mt-1 w-full required:border-red-300" name="function" required>
                                    <option value="">Please select user function</option>
                                    <option value="Admin" {{ $user->function == 'Admin' ? 'selected' : '' }}>&middot; Admin</option>
                                    <option value="Office" {{ $user->function == 'Office' ? 'selected' : '' }}>&middot; Office</option>
                                    <option value="Manager" {{ $user->function == 'Manager' ? 'selected' : '' }}>&middot; Manager</option>
                                    <option value="Foreman" {{ $user->function == 'Foreman' ? 'selected' : '' }}>&middot; Foreman</option>
                                </x-select>
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
                                <x-input id="telephone" class="block mt-1 w-full required:border-red-300" type="text" name="telephone" value="{{ $user->contact->telephone ?? '' }}" placeholder="Telephone" required />
                            </div>
                            <div>
                                <x-input id="city" class="block mt-1 w-full" type="text" name="city" value="{{ $user->contact->city ?? '' }}" placeholder="City" />
                            </div>
                            <div>
                                <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $user->contact->address ?? '' }}" placeholder="Address" />
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
                                <x-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" value="{{ $user->personal->birth_date ?? '' }}" placeholder="Birth Date" />
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
