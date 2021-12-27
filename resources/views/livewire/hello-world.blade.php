<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <input wire:model="name" type="text">
                    <input wire:model="loud" type="checkbox">
                    <select wire:model="greeting" multiple>
                        <option>Hello</option>
                        <option>Goodbye</option>
                        <option>Adios</option>
                    </select>
                    {{ implode(', ', $greeting) }} {{ $name }} @if ($loud) ! @endif
                    <button wire:click="resetName('Bingo')">Reset Name</button>
                </div>
            </div>
        </div>
    </div>
</div>
