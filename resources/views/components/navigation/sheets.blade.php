<div x-on:close.stop="isSheetsOpen = !isSheetsOpen" class="ml-3 relative">
    <div>
        <button x-on:click="isSheetsOpen = !isSheetsOpen"
                type="button"
                class="bg-gray-800 flex"
                id="sheets-menu-button"
                aria-expanded="false"
                aria-haspopup="true">
            <span class="sr-only">Open sheets menu</span>
            <span class="font-medium text-white flex items-center">
                {{ __('language.sheets') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>
    </div>
    <div x-show="isSheetsOpen"
         x-on:click.away="isSheetsOpen = false"
         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
         role="menu"
         aria-orientation="vertical"
         aria-labelledby="sheets-menu-button"
         tabindex="-1">
            <a class="flex px-4 py-2 text-sm text-gray-700" href="#"> Daily</a>
            <a class="flex px-4 py-2 text-sm text-gray-700" href="#"> Monthly</a>
            <a class="flex px-4 py-2 text-sm text-gray-700" href="#"> 1</a>
            <a class="flex px-4 py-2 text-sm text-gray-700" href="#"> 2</a>
            <a class="flex px-4 py-2 text-sm text-gray-700" href="#"> 3</a>
    </div>
</div>
