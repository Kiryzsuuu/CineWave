@extends('layouts.app')

@section('title', 'Home - CineWave')

@section('content')
<div class="pb-12 md:pb-20">
    <!-- Hero Section -->
    @if($trending->isNotEmpty())
    <div class="relative h-[50vh] sm:h-[60vh] md:h-[70vh] lg:h-[80vh] mb-8 md:mb-12">
        @php $featuredMovie = $trending->first(); @endphp
        <img src="{{ $featuredMovie->backdrop }}" 
             alt="{{ $featuredMovie->title }}" 
             class="w-full h-full object-cover"
             loading="eager">
        <div class="absolute inset-0 gradient-overlay"></div>
        
        <div class="absolute bottom-0 left-0 p-4 sm:p-6 md:p-8 lg:p-12 max-w-full sm:max-w-xl md:max-w-2xl z-20">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-2 md:mb-4 line-clamp-2">{{ $featuredMovie->title }}</h1>
            <div class="flex flex-wrap items-center gap-2 md:gap-4 mb-3 md:mb-4 text-xs md:text-base">
                <span class="px-2 md:px-3 py-1 bg-primary rounded text-xs md:text-sm font-bold">{{ $featuredMovie->rating }}</span>
                <span class="hidden sm:inline">{{ $featuredMovie->year }}</span>
                <span class="hidden md:inline">{{ $featuredMovie->duration }}</span>
                @if(is_array($featuredMovie->genre))
                <span class="px-2 md:px-3 py-1 bg-gray-800 rounded text-xs md:text-sm">{{ implode(', ', array_slice($featuredMovie->genre, 0, 2)) }}</span>
                @endif
            </div>
            <p class="text-sm md:text-base lg:text-lg mb-4 md:mb-6 line-clamp-2 md:line-clamp-3 hidden sm:block">{{ $featuredMovie->description }}</p>
            <div class="flex gap-2 md:gap-4">
                <a href="{{ route('movie.play', $featuredMovie->id) }}" 
                   class="relative z-30 px-4 sm:px-6 md:px-8 py-2 md:py-3 bg-primary hover:bg-secondary rounded font-bold transition flex items-center gap-1 md:gap-2 text-sm md:text-base cursor-pointer">
                    <span class="hidden sm:inline">Play</span>
                </a>
                <a href="{{ route('movie.show', $featuredMovie->id) }}" 
                   class="relative z-30 px-4 sm:px-6 md:px-8 py-2 md:py-3 bg-gray-800/80 hover:bg-gray-700 rounded font-bold transition text-sm md:text-base cursor-pointer">
                    <span class="hidden sm:inline">More Info</span>
                    <span class="sm:hidden">Info</span>
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Movie Rows -->
    <div class="px-3 sm:px-4 md:px-6 space-y-6 md:space-y-12">
        @if($trending->isNotEmpty())
        <div>
            <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-3 md:mb-6">Trending Now</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 sm:gap-3 md:gap-4">
                @foreach($trending as $movie)
                    @include('components.movie-card', ['movie' => $movie])
                @endforeach
            </div>
        </div>
        @endif

        @if($popular->isNotEmpty())
        <div>
            <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-3 md:mb-6">Popular on CineWave</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 sm:gap-3 md:gap-4">
                @foreach($popular as $movie)
                    @include('components.movie-card', ['movie' => $movie])
                @endforeach
            </div>
        </div>
        @endif

        @if($newReleases->isNotEmpty())
        <div>
            <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-3 md:mb-6">New Releases</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 sm:gap-3 md:gap-4">
                @foreach($newReleases as $movie)
                    @include('components.movie-card', ['movie' => $movie])
                @endforeach
            </div>
        </div>
        @endif

        @if($action->isNotEmpty())
        <div>
            <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-3 md:mb-6">Action Movies</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2 sm:gap-3 md:gap-4">
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
