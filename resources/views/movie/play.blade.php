@extends('layouts.app')

@section('title', 'Watch ' . $movie->title . ' - CineWave')

@section('content')
<div class="h-screen bg-black flex flex-col">
    <!-- Back Button -->
    <div class="absolute top-4 left-4 z-50">
        <a href="{{ route('movie.show', $movie->id) }}" 
           class="flex items-center gap-2 px-4 py-2 bg-black/80 hover:bg-black rounded-lg transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back</span>
        </a>
    </div>

    <!-- Video Player -->
    <div class="flex-1 flex items-center justify-center bg-black">
        <div class="w-full max-w-7xl aspect-video bg-gray-900 rounded-lg overflow-hidden">
            <!-- Placeholder for video player -->
            <div class="w-full h-full flex flex-col items-center justify-center text-center p-8">
                <div class="mb-8">
                    <svg class="w-24 h-24 text-primary mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                    </svg>
                    <h1 class="text-3xl font-bold mb-2">{{ $movie->title }}</h1>
                    <p class="text-gray-400">{{ $movie->year }} • {{ $movie->duration }}</p>
                </div>

                <!-- Video Player would go here -->
                <div class="w-full aspect-video bg-black rounded-lg flex items-center justify-center border-2 border-gray-700">
                    <div class="text-center">
                        <p class="text-xl text-gray-400 mb-4">Video Player</p>
                        <p class="text-sm text-gray-500">In production, this would be integrated with a video streaming service</p>
                        <div class="mt-8 flex gap-4 justify-center">
                            <button class="px-6 py-3 bg-primary hover:bg-secondary rounded transition flex items-center gap-2">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                                </svg>
                                Play Now
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-sm text-gray-500">
                    <p>Streaming quality: Full HD 1080p</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Movie Info Bar -->
    <div class="p-6 bg-gray-900 border-t border-gray-800">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-xl font-bold mb-2">{{ $movie->title }}</h2>
            <p class="text-gray-400 line-clamp-2">{{ $movie->description }}</p>
        </div>
    </div>
</div>
@endsection
