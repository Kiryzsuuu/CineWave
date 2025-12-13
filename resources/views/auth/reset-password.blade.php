@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-gray-900 rounded-lg shadow-xl p-8">
        <h2 class="text-3xl font-bold text-center mb-6">Reset Password</h2>
        
        @if(session('error'))
            <div class="bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <p class="text-gray-400 text-center mb-6">
            Enter the verification code sent to your email and your new password.
        </p>

        <form method="POST" action="{{ route('reset.password.verify') }}">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                       required>
                @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="otp" class="block text-sm font-medium mb-2">Verification Code</label>
                <input type="text" 
                       id="otp" 
                       name="otp" 
                       maxlength="6"
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-center text-2xl tracking-widest"
                       placeholder="000000"
                       required>
                @error('otp')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">New Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                       required>
                @error('password')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirm Password</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                       required>
            </div>

            <button type="submit" 
                    class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 px-4 rounded-lg transition mb-4">
                Reset Password
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
