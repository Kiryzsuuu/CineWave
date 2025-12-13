<header class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-b from-black/80 to-transparent backdrop-blur-sm" x-data="{ scrolled: false, mobileMenuOpen: false }" 
        @scroll.window="scrolled = window.pageYOffset > 50"
        :class="{ 'bg-black': scrolled }">
    <nav class="container mx-auto px-4 md:px-6 py-3 md:py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl md:text-3xl font-bold text-primary hover:text-secondary transition">
                CineWave
            </a>

            <!-- Main Navigation - Desktop -->
            <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                <a href="{{ route('home') }}" class="hover:text-primary transition text-sm xl:text-base">Home</a>
                <a href="{{ route('category', 'trending') }}" class="hover:text-primary transition text-sm xl:text-base">Trending</a>
                <a href="{{ route('category', 'newReleases') }}" class="hover:text-primary transition text-sm xl:text-base">New Releases</a>
                <a href="{{ route('mylist') }}" class="hover:text-primary transition text-sm xl:text-base">My List</a>
                <a href="{{ route('community') }}" class="hover:text-primary transition text-sm xl:text-base">Community</a>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-2 md:space-x-4">
                <!-- Search -->
                <button @click="$dispatch('open-search')" class="hover:text-primary transition hidden md:block">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                <!-- Notifications -->
                <button @click="$dispatch('open-notifications')" class="hover:text-primary transition hidden md:block">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>

                <!-- Mobile Menu Toggle -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative hidden md:block">
                    <button @click="open = !open" class="flex items-center space-x-2 hover:text-primary transition">
                        <div class="w-7 h-7 md:w-8 md:h-8 rounded-full bg-primary flex items-center justify-center text-sm md:text-base font-semibold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <svg class="w-4 h-4 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute right-0 mt-2 w-48 bg-gray-900 rounded-lg shadow-lg py-2 border border-gray-800">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-800 transition">Profile</a>
                        <a href="{{ route('mylist') }}" class="block px-4 py-2 hover:bg-gray-800 transition">My List</a>
                        @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-800 transition text-primary">Admin Dashboard</a>
                        @endif
                        <hr class="my-2 border-gray-800">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-800 transition">Sign Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4"
             class="lg:hidden mt-4 bg-black/95 backdrop-blur-lg rounded-lg border border-gray-800 overflow-hidden">
            <div class="flex flex-col space-y-1 p-2">
                <a href="{{ route('home') }}" class="px-4 py-3 hover:bg-gray-800 rounded transition">Home</a>
                <a href="{{ route('category', 'trending') }}" class="px-4 py-3 hover:bg-gray-800 rounded transition">Trending</a>
                <a href="{{ route('category', 'newReleases') }}" class="px-4 py-3 hover:bg-gray-800 rounded transition">New Releases</a>
                <a href="{{ route('mylist') }}" class="px-4 py-3 hover:bg-gray-800 rounded transition">My List</a>
                <a href="{{ route('community') }}" class="px-4 py-3 hover:bg-gray-800 rounded transition">Community</a>
                <hr class="border-gray-800 my-2">
                <a href="{{ route('profile') }}" class="px-4 py-3 hover:bg-gray-800 rounded transition flex items-center space-x-2">
                    <div class="w-6 h-6 rounded-full bg-primary flex items-center justify-center text-xs font-semibold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <span>Profile</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 hover:bg-gray-800 rounded transition text-red-400">Sign Out</button>
                </form>
            </div>
        </div>
    </nav>
</header>

<!-- Spacer for fixed header -->
<div class="h-16 md:h-20"></div>
