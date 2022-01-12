<x-app-layout>
    <x-slot name="header">
        {{ __('language.edit_user') }}
        <span class="float-right">
            <x-links.button href="{{ route('users') }}" do="list">{{ __('language.users') }}</x-links.button>
        </span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <x-notifications.default />
                        <form action="{{ route('users.update', $user->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.name') }}</x-form.label>
                                            <x-form.input id="name" type="text" name="name" value="{{ $user->name }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.email') }}</x-form.label>
                                            <x-form.input id="email" type="email" name="email" value="{{ $user->email }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.function') }}</x-form.label>
                                            <x-form.select id="function" name="function" required>
                                                <x-slot name="options">
                                                    <option value="">{{ __('language.please_select_user_function') }}</option>
                                                    @foreach(App\Models\User::FUNCTIONS as $function)
                                                        <option value="{{ $function }}"{{ $user->function == $function ? ' selected' : '' }}>{{ $function }}</option>
                                                    @endforeach
                                                </x-slot>
                                            </x-form.select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label required>{{ __('language.telephone') }}</x-form.label>
                                            <x-form.input id="telephone" type="text" name="telephone" value="{{ $user->contact->telephone }}" required />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label>{{ __('language.city') }}</x-form.label>
                                            <x-form.input id="city" type="text" name="city" value="{{ $user->contact->city }}" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <x-form.label>{{ __('language.birth_date') }}</x-form.label>
                                            <x-form.input id="birth_date" type="date" name="birth_date" value="{{ $user->personal->birth_date }}" />
                                        </div>

                                        <div class="col-span-6">
                                            <x-form.label>{{ __('language.address') }}</x-form.label>
                                            <x-form.input id="address" type="text" name="address" value="{{ $user->contact->address }}" />
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
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
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
