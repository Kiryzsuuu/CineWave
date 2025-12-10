@extends('layouts.app')

@section('title', 'Home - CineWave')

@section('content')
<div class="pb-20">
    <!-- Hero Section -->
    @if($trending->isNotEmpty())
    <div class="relative h-[80vh] mb-12">
        @php $featuredMovie = $trending->first(); @endphp
        <img src="{{ $featuredMovie->backdrop }}" 
             alt="{{ $featuredMovie->title }}" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 gradient-overlay"></div>
        
        <div class="absolute bottom-0 left-0 p-12 max-w-2xl">
            <h1 class="text-5xl font-bold mb-4">{{ $featuredMovie->title }}</h1>
            <div class="flex items-center gap-4 mb-4">
                <span class="px-3 py-1 bg-primary rounded text-sm font-bold">⭐ {{ $featuredMovie->rating }}</span>
                <span>{{ $featuredMovie->year }}</span>
                <span>{{ $featuredMovie->duration }}</span>
                <span class="px-3 py-1 bg-gray-800 rounded text-sm">{{ implode(', ', array_slice($featuredMovie->genre, 0, 2)) }}</span>
            </div>
            <p class="text-lg mb-6 line-clamp-3">{{ $featuredMovie->description }}</p>
            <div class="flex gap-4">
                <a href="{{ route('movie.play', $featuredMovie->id) }}" 
                   class="px-8 py-3 bg-primary hover:bg-secondary rounded font-bold transition flex items-center gap-2">
                    ▶ Play
                </a>
                <a href="{{ route('movie.show', $featuredMovie->id) }}" 
                   class="px-8 py-3 bg-gray-800/80 hover:bg-gray-700 rounded font-bold transition">
                    More Info
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Movie Rows -->
    <div class="px-6 space-y-12">
        @if($trending->isNotEmpty())
        <div>
            <h2 class="text-2xl font-bold mb-6">Trending Now</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($trending as $movie)
                    @include('components.movie-card', ['movie' => $movie])
                @endforeach
            </div>
        </div>
        @endif

        @if($popular->isNotEmpty())
        <div>
            <h2 class="text-2xl font-bold mb-6">Popular on CineWave</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($popular as $movie)
                    @include('components.movie-card', ['movie' => $movie])
                @endforeach
            </div>
        </div>
        @endif

        @if($newReleases->isNotEmpty())
        <div>
            <h2 class="text-2xl font-bold mb-6">New Releases</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($newReleases as $movie)
                    @include('components.movie-card', ['movie' => $movie])
                @endforeach
            </div>
        </div>
        @endif

        @if($action->isNotEmpty())
        <div>
            <h2 class="text-2xl font-bold mb-6">Action Movies</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($action as $movie)
                    @include('components.movie-card', ['movie' => $movie])
                @endforeach
            </div>
        </div>
        @endif

        @if($scifi->isNotEmpty())
        <div>
            <h2 class="text-2xl font-bold mb-6">Sci-Fi Adventures</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($scifi as $movie)
                    @include('components.movie-card', ['movie' => $movie])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
