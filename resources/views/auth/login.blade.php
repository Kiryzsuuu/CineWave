@extends('layouts.guest')

@section('title', 'Sign In - CineWave')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-black px-4">
    <div class="w-full max-w-md">
        <div class="bg-black/70 p-8 rounded-lg shadow-2xl backdrop-blur-sm">
            <h2 class="text-3xl font-bold text-center mb-6 text-primary">Sign In</h2>
            
            @if ($errors->any())
                <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:border-primary text-white"
                           placeholder="Enter your email"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Password</label>
                    <input type="password" 
                           name="password" 
                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:border-primary text-white"
                           placeholder="Enter your password"
                           required>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded bg-gray-800 border-gray-700 text-primary focus:ring-primary">
                        <span class="ml-2 text-sm">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-primary hover:underline">Forgot password?</a>
                </div>

                <button type="submit" 
                        class="w-full py-3 bg-primary hover:bg-secondary text-white font-semibold rounded transition transform hover:scale-105">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-primary hover:underline">Sign Up</a>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('landing') }}" class="text-sm text-gray-400 hover:text-primary">← Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
