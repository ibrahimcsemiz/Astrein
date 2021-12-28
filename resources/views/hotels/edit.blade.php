<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Hotel') }}
            <span class="float-right flex">
                <form action="{{ route('hotels.destroy', $data[0]->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <x-button onclick="return confirm('Are you sure?')" class="mt-2 text-red-600">
                        {{ __('Delete') }}
                    </x-button>
                </form>
                <x-a-button :href="url('hotels')" class="ml-1">Hotels</x-a-button>
            </span>
        </h2>
    </x-slot>
    <div class="py-12">
        <form action="{{ route('hotels.update', $data[0]->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <x-crud-alerts class="mb-4" />
                        <div>
                            <div>
                                <x-input id="name" class="block mt-1 w-full required:border-red-300" type="text" name="name" value="{{ $data[0]->name }}" placeholder="Name" required />
                            </div>
                            <div>
                                <x-input id="email" class="block mt-1 w-full required:border-red-300" type="email" name="email" value="{{ $data[0]->email }}" placeholder="Email" required />
                            </div>
                            <div>
                                <x-select id="manager_id" name="manager_id" class="block mt-1 w-full required:border-red-300 select2picker"
                                          data-placeholder="Select a manager"
                                          data-allow-clear="false"
                                          title="Select a manager" required>
                                    <option value=""></option>
                                    @foreach($users->where('function', 'Manager') as $manager)
                                        <option value="{{ $manager->id }}" {{ $data[0]->manager_id == $manager->id ? 'selected' : '' }}>{{ $manager->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div>
                                <x-select id="foreman_id" name="foreman_id" class="block mt-1 w-full required:border-red-300 select2picker"
                                          data-placeholder="Select a foreman"
                                          data-allow-clear="false"
                                          title="Select a foreman" required>
                                    <option value=""></option>
                                    @foreach($users->where('function', 'Foreman') as $foreman)
                                        <option value="{{ $foreman->id }}" {{ $data[0]->foreman_id == $foreman->id ? 'selected' : '' }}>{{ $foreman->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div>
                                <x-select id="region_id" name="region_id" class="block mt-1 w-full required:border-red-300 select2picker"
                                          data-placeholder="Select a region"
                                          data-allow-clear="false"
                                          title="Select a region" required>
                                    <option value=""></option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ $data[0]->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div>
                            <div>
                                <x-input id="telephone" class="block mt-1 w-full required:border-red-300" type="text" name="telephone" value="{{ $data[0]->telephone }}" placeholder="Telephone" required />
                            </div>
                            <div>
                                <x-input id="city" class="block mt-1 w-full" type="text" name="city" value="{{ $data[0]->city ?? '' }}" placeholder="City" />
                            </div>
                            <div>
                                <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $data[0]->address ?? '' }}" placeholder="Address" />
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
