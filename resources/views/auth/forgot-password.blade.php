@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-gray-900 rounded-lg shadow-xl p-8">
        <h2 class="text-3xl font-bold text-center mb-6">Forgot Password</h2>
        
        @if(session('error'))
            <div class="bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <p class="text-gray-400 text-center mb-6">
            Enter your email address and we'll send you a code to reset your password.
        </p>

        <form method="POST" action="{{ route('forgot.password.send') }}">
            @csrf
            
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                       placeholder="your@email.com"
                       required>
                @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 px-4 rounded-lg transition mb-4">
                Send Reset Code
            </button>
        </form>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-primary hover:text-secondary transition">
                Back to Login
            </a>
        </div>
    </div>
</div>
@endsection
