<x-app-layout>
    <x-slot name="header">
        {{ __('Add New Hotel') }}
        <span class="float-right">
            <x-links.button href="{{ route('hotels') }}" do="list">Hotels</x-links.button>
        </span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <x-notifications.validation />
                        <x-notifications.default />
                        <form action="{{ route('hotels.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('Name') }}</x-form.label>
                                            <x-form.input id="name" type="text" name="name" value="{{ old('name') }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('Email') }}</x-form.label>
                                            <x-form.input id="email" type="email" name="email" value="{{ old('email') }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label>{{ __('Image') }}</x-form.label>
                                            <x-form.input id="image" type="file" name="image" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('Manager') }}</x-form.label>
                                            <x-form.select id="manager_id" name="manager_id" data-placeholder="Select a manager" data-allow-clear="false" title="Select a manager" required>
                                                <x-slot name="options">
                                                    <option value=""></option>
                                                    @foreach($managers as $manager)
                                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                                    @endforeach
                                                </x-slot>
                                            </x-form.select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('Foreman') }}</x-form.label>
                                            <x-form.select id="foreman_id" name="foreman_id" data-placeholder="Select a foreman" data-allow-clear="false" title="Select a foreman" required>
                                                <x-slot name="options">
                                                    <option value=""></option>
                                                    @foreach($foremans as $foreman)
                                                        <option value="{{ $foreman->id }}">{{ $foreman->name }}</option>
                                                    @endforeach
                                                </x-slot>
                                            </x-form.select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('Region') }}</x-form.label>
                                            <x-form.select id="region_id" name="region_id" data-placeholder="Select a region" data-allow-clear="false" title="Select a region" required>
                                                <x-slot name="options">
                                                    <option value=""></option>
                                                    @foreach($regions as $region)
                                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                    @endforeach
                                                </x-slot>
                                            </x-form.select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                            <x-form.label required>{{ __('Telephone') }}</x-form.label>
                                            <x-form.input id="telephone" type="text" name="telephone" value="{{ old('telephone') }}" required />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                            <x-form.label>{{ __('City') }}</x-form.label>
                                            <x-form.input id="city" type="text" name="city" value="{{ old('city') }}" />
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
