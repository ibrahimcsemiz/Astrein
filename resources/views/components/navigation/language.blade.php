<div x-on:close.stop="isSwitcherOpen = !isSwitcherOpen" class="ml-3 relative">
    <div>
        <button x-on:click="isSwitcherOpen = !isSwitcherOpen"
                type="button"
                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                id="language-menu-button"
                aria-expanded="false"
                aria-haspopup="true">
            <span class="sr-only">Open language menu</span>
            <img class="h-8 w-8 rounded-full" src="{{ asset('flags/' . Config::get('languages')[App::getLocale()]['icon']) }}" alt="{{ Config::get('languages')[App::getLocale()]['display'] }}">
        </button>
    </div>
    <div x-show="isSwitcherOpen"
         x-on:click.away="isSwitcherOpen = false"
         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
         role="menu"
         aria-orientation="vertical"
         aria-labelledby="language-menu-button"
         tabindex="-1">
        @foreach(Config::get('languages') as $lang => $language)
            @if($lang != App::getLocale())
                <a class="flex px-4 py-2 text-sm text-gray-700" href="{{ route('language.switch', $lang) }}">
                    <img src="{{ asset('flags/' . $language['icon']) }}" alt="{{ $language['display'] }}" class="flex-shrink-0 mr-2 h-6 w-6 rounded-full">
                    {{ $language['display'] }}
                </a>
            @endif
        @endforeach
    </div>
</div>
