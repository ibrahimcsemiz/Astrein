<div class="w-1/3">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white" style="overflow-x: auto; width: 100%;">
            <div>
                <h4 class="font-semibold text-lg text-gray-800 leading-tight flex items-center">Service Plans
                    <a wire:click="create" style="cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </h4>
            </div>
            <div class="w-full mt-1 inline-flex">
            @if(count($servicePlans) > 0)
                <x-table>
                    <x-slot name="thead">
                        <x-table-th>#</x-table-th>
                        <x-table-th>Name</x-table-th>
                    </x-slot>
                    @foreach($servicePlans as $servicePlan)
                    <tr>
                        <x-table-column>
                            <a wire:click="destroy({{ $servicePlan->id }})" class="text-red-600" style="cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </x-table-column>
                        <x-table-column>
                            <a wire:click="edit({{ $servicePlan->id }})" style="cursor: pointer;" class="text-orange-800 hover:text-indigo-600">{{ $servicePlan->name }}</a>
                        </x-table-column>
                    </tr>
                    @endforeach
                </x-table>
            @else
                {{ 'Service Plan Not Found' }}
            @endif
            </div>
            <form wire:submit.prevent="{{ $model }}">
                <x-modal.dialog wire:model.defer="showEditModal">
                        <x-slot name="title">Edit Service Plan</x-slot>
                        <x-slot name="content">
                            <x-input id="name" class="block mt-1 w-full required:border-red-300" type="text" wire:model="name" placeholder="Name" />
                            @if($errors->first('name'))
                                {{ $errors->first('name') }}
                            @endif
                        </x-slot>
                        <x-slot name="footer">
                            <x-button class="mt-2 text-red-600" wire:click="$set('showEditModal', false)">
                                {{ __('Cancel') }}
                            </x-button>
                            <x-button class="mt-2 text-red-600" type="submit">
                                {{ __('Save') }}
                            </x-button>
                        </x-slot>
                </x-modal.dialog>
            </form>
        </div>
    </div>
</div>
