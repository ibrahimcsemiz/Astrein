<div x-on:close.stop="isProfileOpen = !isProfileOpen" class="ml-3 relative">
    <div>
        <button x-on:click="isProfileOpen = !isProfileOpen"
                type="button"
                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                id="user-menu-button"
                aria-expanded="false"
                aria-haspopup="true">
            <span class="sr-only">Open user menu</span>
            {{ $trigger }}
        </button>
    </div>
    <div x-show="isProfileOpen"
         x-on:click.away="isProfileOpen = false"
         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
         role="menu"
         aria-orientation="vertical"
         aria-labelledby="user-menu-button"
         tabindex="-1">
        {{ $links }}
    </div>
</div>
