<x-app-layout>
    <x-slot name="header">
        {{ __('language.edit_hotel') }}
        <span class="float-right">
            <x-links.button href="{{ route('hotels.index') }}" do="list">{{ __('language.hotels') }}</x-links.button>
        </span>
    </x-slot>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('hotels.update', $hotel->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.name') }}</x-form.label>
                                            <x-form.input id="name" type="text" name="name" value="{{ $hotel->name }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.email') }}</x-form.label>
                                            <x-form.input id="email" type="email" name="email" value="{{ $hotel->email }}" required />
                                        </div>
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label>{{ __('language.image') }}</x-form.label>
                                            <x-form.input id="image" type="file" name="image" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.manager') }}</x-form.label>
                                            <x-form.select id="manager_id" name="manager_id" required>
                                                <x-slot name="options">
                                                    <option value="">{{ __('language.select_a_manager') }}</option>
                                                    @foreach($managers as $manager)
                                                        <option value="{{ $manager->id }}"{{ $hotel->manager_id == $manager->id ? ' selected' : '' }}>{{ $manager->name }}</option>
                                                    @endforeach
                                                </x-slot>
                                            </x-form.select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.foreman') }}</x-form.label>
                                            <x-form.select id="foreman_id" name="foreman_id" required>
                                                <x-slot name="options">
                                                    <option value="">{{ __('language.select_a_foreman') }}</option>
                                                    @foreach($foremans as $foreman)
                                                        <option value="{{ $foreman->id }}"{{ $hotel->foreman_id == $foreman->id ? ' selected' : '' }}>{{ $foreman->name }}</option>
                                                    @endforeach
                                                </x-slot>
                                            </x-form.select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-2">
                                            <x-form.label required>{{ __('language.region') }}</x-form.label>
                                            <x-form.select id="region_id" name="region_id" required>
                                                <x-slot name="options">
                                                    <option value="">{{ __('language.select_a_region') }}</option>
                                                    @foreach($regions as $region)
                                                        <option value="{{ $region->id }}"{{ $hotel->region_id == $region->id ? ' selected' : '' }}>{{ $region->name }}</option>
                                                    @endforeach
                                                </x-slot>
                                            </x-form.select>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                            <x-form.label required>{{ __('language.telephone') }}</x-form.label>
                                            <x-form.input id="telephone" type="text" name="telephone" value="{{ $hotel->telephone }}" required />
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                            <x-form.label>{{ __('language.city') }}</x-form.label>
                                            <x-form.input id="city" type="text" name="city" value="{{ $hotel->city }}" />
                                        </div>

                                        <div class="col-span-6">
                                            <x-form.label>{{ __('language.address') }}</x-form.label>
                                            <x-form.input id="address" type="text" name="address" value="{{ $hotel->address }}" />
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
                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="post">
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
