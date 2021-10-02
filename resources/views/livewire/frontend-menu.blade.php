<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <!-- Primary Navigation Menu for guests or basic users -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-logo class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('front.dashboard') }}" :active="request()->routeIs('dashboard')">
                        @ucfirst(__('app.dashboard'))
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('front.museum.index') }}" :active="request()->routeIs('front.museum.*')">
                        @ucfirst(__('app.museums'))
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('front.exhibition.index') }}" :active="request()->routeIs('front.exhibition.index', 'front.exhibition.show')">
                        @ucfirst(__('app.exhibitions'))
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('front.exhibition.map') }}" :active="request()->routeIs('front.exhibition.map')">
                        @ucfirst(__('app.map'))
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('front.exhibition.timeline') }}" :active="request()->routeIs('front.exhibition.timeline')">
                        @ucfirst(__('app.timeline'))
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('front.tag.index') }}" :active="request()->routeIs('front.tag.*')">
                        @ucfirst(__('app.tags'))
                    </x-jet-nav-link>
                </div>
            </div>

            <div class="flex">
                <!-- Settings Dropdown -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('login') }}">
                        @ucfirst(__('auth.login'))
                    </x-jet-nav-link>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('front.dashboard') }}" :active="request()->routeIs('front.dashboard')">
                @ucfirst(__('app.dashboard'))
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('front.museum.index') }}" :active="request()->routeIs('front.museum.*')">
                @ucfirst(__('app.museums'))
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('front.exhibition.index') }}" :active="request()->routeIs('front.exhibition.*')">
                @ucfirst(__('app.exhibitions'))
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('front.exhibition.map') }}" :active="request()->routeIs('front.exhibition.map')">
                @ucfirst(__('app.map'))
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('front.exhibition.timeline') }}" :active="request()->routeIs('front.exhibition.timeline')">
                @ucfirst(__('app.timeline'))
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('front.tag.index') }}" :active="request()->routeIs('front.tag.*')">
                @ucfirst(__('app.tags'))
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <x-jet-nav-link href="{{ route('login') }}">
                    @ucfirst(__('auth.login'))
                </x-jet-nav-link>
            </div>
        </div>
    </div>
</nav>
