<div class="w-1/3">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mt-5 md:mt-0 md:col-span-2">
                @if(count($servicePlans) > 0)
                    <x-table>
                        <x-slot name="thead">
                            <tr>
                                <x-table.th colspan="2" class="text-lg bg-gray-100">
                                    {{ __('language.service_plans') }}
                                    <x-links.default wire:click="create" class="inline-flex float-right">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -mr-5 -mt-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                        </svg>
                                    </x-links.default>
                                </x-table.th>
                            </tr>
                            <x-table.th>{{ __('language.name') }}</x-table.th>
                            <x-table.th manage="1"></x-table.th>
                        </x-slot>
                        <x-slot name="tbody">
                            @foreach($servicePlans as $servicePlan)
                                <tr>
                                    <x-table.td>{{ $servicePlan->name }}</x-table.td>
                                    <x-table.td>
                                        <x-links.default wire:click="edit({{ $servicePlan->id }})" class="border-r mr-1">{{ __('language.edit') }}</x-links.default>
                                        <x-links.default wire:click="destroy({{ $servicePlan->id }})" onclick="return confirm('{{ __('language.are_you_sure') }}') || event.stopImmediatePropagation()">{{ __('language.delete') }}</x-links.default>
                                    </x-table.td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                @else
                    {{ __('language.service_plan_not_found') }}
                @endif
            </div>
            <form wire:submit.prevent="{{ $model }}">
                <x-modal.dialog wire:model.defer="showEditModal">
                    <x-slot name="title">{{ __('language.edit') }}</x-slot>
                    <x-slot name="content">
                        <x-form.input id="name" type="text" wire:model="name" placeholder="{{ __('language.name') }}" />
                    </x-slot>
                    <x-slot name="footer">
                        <x-form.button color="red" wire:click="$set('showEditModal', false)">
                            {{ __('language.cancel') }}
                        </x-form.button>
                        <x-form.button color="green" type="submit">
                            {{ __('language.save') }}
                        </x-form.button>
                    </x-slot>
                </x-modal.dialog>
            </form>
        </div>
    </div>
    <x-notifications.livewire />
</div>
