<nav x-data="{ isMenuOpen: false, isProfileOpen: false, isSwitcherOpen: false }" class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <x-navigation.button></x-navigation.button>
            </div>

            <x-navigation.menu>

                <x-slot name="logo">

                    <img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                    <img class="hidden lg:block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow">

                </x-slot>

                <x-slot name="links">
                    <x-navigation.link href="{{ route('dashboard') }}" active="{{ request()->routeIs('dashboard') }}">
                        {{ __('language.dashboard') }}
                    </x-navigation.link>
                    <x-navigation.link href="{{ route('users') }}" active="{{ request()->routeIs('users*') }}">
                        {{ __('language.users') }}
                    </x-navigation.link>
                    <x-navigation.link href="{{ route('employees') }}" active="{{ request()->routeIs('employees*') }}">
                        {{ __('language.employees') }}
                    </x-navigation.link>
                    <x-navigation.link href="{{ route('hotels') }}" active="{{ request()->routeIs('hotels*') }}">
                        {{ __('language.hotels') }}
                    </x-navigation.link>
                </x-slot>

            </x-navigation.menu>

            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                <x-navigation.language></x-navigation.language>

                <!-- Profile dropdown -->
                <x-navigation.profile.dropdown>

                    <x-slot name="trigger">
                        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="{{ Auth::user()->name ?? ''  }}">
                    </x-slot>

                    <x-slot name="links">
                        <x-navigation.profile.link href="{{ route('dashboard') }}" active="{{ request()->routeIs('dashboard') }}">
                            {{ __('language.change_password') }}
                        </x-navigation.profile.link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-navigation.profile.link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('language.logout') }}
                            </x-navigation.profile.link>
                        </form>
                    </x-slot>

                </x-navigation.profile.dropdown>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <x-navigation.responsive>

        <x-slot name="links">
            <x-navigation.link class="block text-base" href="{{ route('dashboard') }}" active="{{ request()->routeIs('dashboard') }}">
                {{ __('language.dashboard') }}
            </x-navigation.link>
            <x-navigation.link class="block text-base" href="{{ route('users') }}" active="{{ request()->routeIs('users*') }}">
                {{ __('language.users') }}
            </x-navigation.link>
            <x-navigation.link class="block text-base" href="{{ route('employees') }}" active="{{ request()->routeIs('employees*') }}">
                {{ __('language.employees') }}
            </x-navigation.link>
            <x-navigation.link class="block text-base" href="{{ route('hotels') }}" active="{{ request()->routeIs('hotels*') }}">
                {{ __('language.hotels') }}
            </x-navigation.link>
        </x-slot>

    </x-navigation.responsive>
</nav>
