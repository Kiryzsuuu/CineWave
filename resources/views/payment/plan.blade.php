@extends('layouts.guest')

@section('title', 'Choose Your Plan - CineWave')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-black px-4 py-12">
    <div class="container mx-auto max-w-6xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Choose the plan that's right for you</h1>
            <p class="text-xl text-gray-400">Watch all you want. Cancel anytime.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <!-- Basic Plan -->
            <div class="bg-gray-900 rounded-lg p-8 hover:scale-105 transition transform">
                <h3 class="text-2xl font-bold mb-2">Basic</h3>
                <p class="text-4xl font-bold text-primary mb-6">$8.99<span class="text-sm text-gray-400">/month</span></p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>HD Quality (720p)</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Watch on 1 device</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Unlimited movies & shows</span>
                    </li>
                </ul>
                <form action="{{ route('payment.plan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" value="basic">
                    <button type="submit" class="relative z-10 w-full py-3 bg-gray-700 hover:bg-primary text-white font-semibold rounded transition cursor-pointer">
                        Select Basic
                    </button>
                </form>
            </div>

            <!-- Standard Plan (Popular) -->
            <div class="bg-gradient-to-br from-primary to-secondary rounded-lg p-8 transform scale-105 shadow-2xl relative">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-yellow-500 text-black px-4 py-1 rounded-full text-sm font-bold">
                    POPULAR
                </div>
                <h3 class="text-2xl font-bold mb-2">Standard</h3>
                <p class="text-4xl font-bold mb-6">$12.99<span class="text-sm text-gray-200">/month</span></p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Full HD Quality (1080p)</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Watch on 2 devices</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Unlimited movies & shows</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Download available</span>
                    </li>
                </ul>
                <form action="{{ route('payment.plan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" value="standard">
                    <button type="submit" class="relative z-10 w-full py-3 bg-white text-primary font-semibold rounded transition hover:bg-gray-100 cursor-pointer">
                        Select Standard
                    </button>
                </form>
            </div>

            <!-- Premium Plan -->
            <div class="bg-gray-900 rounded-lg p-8 hover:scale-105 transition transform">
                <h3 class="text-2xl font-bold mb-2">Premium</h3>
                <p class="text-4xl font-bold text-primary mb-6">$17.99<span class="text-sm text-gray-400">/month</span></p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>4K + HDR Quality</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Watch on 4 devices</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Unlimited movies & shows</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Download available</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-primary mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Early access to new content</span>
                    </li>
                </ul>
                <form action="{{ route('payment.plan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" value="premium">
                    <button type="submit" class="relative z-10 w-full py-3 bg-gray-700 hover:bg-primary text-white font-semibold rounded transition cursor-pointer">
                        Select Premium
                    </button>
                </form>
            </div>
        </div>

        <div class="text-center text-gray-400">
            <p>All plans include a 30-day free trial. Cancel anytime.</p>
        </div>
    </div>
</div>
@endsection
