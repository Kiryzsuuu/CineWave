<header class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-b from-black/80 to-transparent backdrop-blur-sm" x-data="{ scrolled: false }" 
        @scroll.window="scrolled = window.pageYOffset > 50"
        :class="{ 'bg-black': scrolled }">
    <nav class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-3xl font-bold text-primary hover:text-secondary transition">
                CineWave
            </a>

            <!-- Main Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="hover:text-primary transition">Home</a>
                <a href="{{ route('category', 'trending') }}" class="hover:text-primary transition">Trending</a>
                <a href="{{ route('category', 'newReleases') }}" class="hover:text-primary transition">New Releases</a>
                <a href="{{ route('mylist') }}" class="hover:text-primary transition">My List</a>
                <a href="{{ route('community') }}" class="hover:text-primary transition">Community</a>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <!-- Search -->
                <button @click="$dispatch('open-search')" class="hover:text-primary transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                <!-- Notifications -->
                <button @click="$dispatch('open-notifications')" class="hover:text-primary transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>

                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 hover:text-primary transition">
                        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition
                         class="absolute right-0 mt-2 w-48 bg-gray-900 rounded-lg shadow-lg py-2">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-800">Profile</a>
                        <a href="{{ route('mylist') }}" class="block px-4 py-2 hover:bg-gray-800">My List</a>
                        <hr class="my-2 border-gray-800">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-800">Sign Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Spacer for fixed header -->
<div class="h-20"></div>
