@extends('layouts.guest')

@section('title', 'CineWave - Stream Your Favorite Movies & Series')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-black via-gray-900 to-black">
    <!-- Hero Section -->
    <div class="relative h-screen">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1590562177087-ca6af9bb82ea?w=1920&q=80" 
                 alt="Hero Background" 
                 class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 gradient-overlay"></div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-10 flex items-center justify-between p-6">
            <div class="text-3xl font-bold text-primary">CineWave</div>
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="px-6 py-2 text-white hover:text-primary transition">Sign In</a>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4 -mt-20">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Unlimited movies, TV <br>shows, and more
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-300">
                Watch anywhere. Cancel anytime.
            </p>
            <p class="text-lg mb-6">
                Ready to watch? Enter your email to create or restart your membership.
            </p>
            
            <form action="{{ route('register') }}" method="GET" class="flex flex-col md:flex-row gap-4 w-full max-w-2xl">
                <input type="email" 
                       name="email" 
                       placeholder="Email address" 
                       class="flex-1 px-6 py-4 rounded bg-white/10 border border-white/30 text-white placeholder-gray-400 focus:outline-none focus:border-primary"
                       required>
                <button type="submit" 
                        class="px-8 py-4 bg-primary hover:bg-secondary text-white font-semibold rounded transition transform hover:scale-105">
                    Get Started →
                </button>
            </form>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 px-4">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8">
            <div class="text-center p-8 bg-gray-900 rounded-lg">
                <div class="text-5xl mb-4">📺</div>
                <h3 class="text-2xl font-bold mb-2">Enjoy on your TV</h3>
                <p class="text-gray-400">Watch on Smart TVs, PlayStation, Xbox, Chromecast, Apple TV, and more.</p>
            </div>
            <div class="text-center p-8 bg-gray-900 rounded-lg">
                <div class="text-5xl mb-4">📱</div>
                <h3 class="text-2xl font-bold mb-2">Download your shows</h3>
                <p class="text-gray-400">Save your favorites easily and always have something to watch.</p>
            </div>
            <div class="text-center p-8 bg-gray-900 rounded-lg">
                <div class="text-5xl mb-4">🎬</div>
                <h3 class="text-2xl font-bold mb-2">Watch everywhere</h3>
                <p class="text-gray-400">Stream unlimited movies and TV shows on your phone, tablet, laptop, and TV.</p>
            </div>
        </div>
    </div>

    <!-- Frequently Asked Questions -->
    <div class="py-20 px-4 bg-black">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12">Frequently Asked Questions</h2>
            <div class="space-y-4" x-data="{ open: null }">
                <div class="bg-gray-900">
                    <button @click="open = open === 1 ? null : 1" 
                            class="w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-800 transition">
                        <span class="text-xl">What is CineWave?</span>
                        <span x-text="open === 1 ? '−' : '+'"></span>
                    </button>
                    <div x-show="open === 1" class="px-6 py-4 border-t border-gray-800">
                        <p class="text-gray-400">CineWave is a streaming service that offers a wide variety of award-winning TV shows, movies, anime, documentaries, and more on thousands of internet-connected devices.</p>
                    </div>
                </div>

                <div class="bg-gray-900">
                    <button @click="open = open === 2 ? null : 2" 
                            class="w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-800 transition">
                        <span class="text-xl">How much does CineWave cost?</span>
                        <span x-text="open === 2 ? '−' : '+'"></span>
                    </button>
                    <div x-show="open === 2" class="px-6 py-4 border-t border-gray-800">
                        <p class="text-gray-400">Watch CineWave on your smartphone, tablet, Smart TV, laptop, or streaming device, all for one fixed monthly fee. Plans range from $8.99 to $17.99 a month.</p>
                    </div>
                </div>

                <div class="bg-gray-900">
                    <button @click="open = open === 3 ? null : 3" 
                            class="w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-800 transition">
                        <span class="text-xl">Where can I watch?</span>
                        <span x-text="open === 3 ? '−' : '+'"></span>
                    </button>
                    <div x-show="open === 3" class="px-6 py-4 border-t border-gray-800">
                        <p class="text-gray-400">Watch anywhere, anytime. Sign in with your CineWave account to watch instantly on the web or on any internet-connected device.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="py-12 px-4 text-center text-gray-500">
        <p>&copy; 2024 CineWave. All rights reserved.</p>
    </div>
</div>
@endsection
