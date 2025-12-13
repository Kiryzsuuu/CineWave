@extends('layouts.guest')

@section('title', 'Verify Email')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-gray-900 rounded-lg shadow-xl p-8">
        <h2 class="text-3xl font-bold text-center mb-6">Verify Your Email</h2>
        
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
            We've sent a 6-digit verification code to<br>
            <strong class="text-white">{{ session('email') }}</strong>
        </p>

        <form method="POST" action="{{ route('verify.otp') }}">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            
            <div class="mb-6">
                <label for="otp" class="block text-sm font-medium mb-2">Verification Code</label>
                <input type="text" 
                       id="otp" 
                       name="otp" 
                       maxlength="6"
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-center text-2xl tracking-widest"
                       placeholder="000000"
                       required
                       autofocus>
                @error('otp')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 px-4 rounded-lg transition mb-4">
                Verify Email
            </button>
        </form>

        <form method="POST" action="{{ route('resend.otp') }}" class="text-center">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            <button type="submit" class="text-primary hover:text-secondary transition">
                Didn't receive code? Resend
            </button>
        </form>
    </div>
</div>
@endsection
