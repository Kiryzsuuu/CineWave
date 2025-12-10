@extends('layouts.guest')

@section('title', 'Sign Up - CineWave')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-black px-4 py-12">
    <div class="w-full max-w-md">
        <div class="bg-black/70 p-8 rounded-lg shadow-2xl backdrop-blur-sm">
            <h2 class="text-3xl font-bold text-center mb-6 text-primary">Create Account</h2>
            
            @if ($errors->any())
                <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium mb-2">Name</label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:border-primary text-white"
                           placeholder="Enter your name"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email', request('email')) }}"
                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:border-primary text-white"
                           placeholder="Enter your email"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Password</label>
                    <input type="password" 
                           name="password" 
                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:border-primary text-white"
                           placeholder="Enter your password (min. 8 characters)"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Confirm Password</label>
                    <input type="password" 
                           name="password_confirmation" 
                           class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:border-primary text-white"
                           placeholder="Confirm your password"
                           required>
                </div>

                <button type="submit" 
                        class="w-full py-3 bg-primary hover:bg-secondary text-white font-semibold rounded transition transform hover:scale-105">
                    Create Account
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-400">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-primary hover:underline">Sign In</a>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('landing') }}" class="text-sm text-gray-400 hover:text-primary">← Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
