@extends('layouts.app')

@section('title', $movie->title . ' - CineWave')

@section('content')
<div class="pb-20">
    <!-- Movie Backdrop Hero -->
    <div class="relative h-[70vh]">
        <img src="{{ $movie->backdrop }}" 
             alt="{{ $movie->title }}" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 gradient-overlay"></div>
        
        <div class="absolute bottom-0 left-0 p-12 max-w-4xl">
            <h1 class="text-5xl font-bold mb-4">{{ $movie->title }}</h1>
            <div class="flex items-center gap-4 mb-4 flex-wrap">
                <span class="px-3 py-1 bg-primary rounded text-sm font-bold">⭐ {{ $movie->rating }}</span>
                <span>{{ $movie->year }}</span>
                <span>{{ $movie->duration }}</span>
                @foreach($movie->genre as $genre)
                    <span class="px-3 py-1 bg-gray-800 rounded text-sm">{{ $genre }}</span>
                @endforeach
            </div>
            <div class="flex gap-4 mb-6">
                <a href="{{ route('movie.play', $movie->id) }}" 
                   class="px-8 py-3 bg-primary hover:bg-secondary rounded font-bold transition flex items-center gap-2">
                    ▶ Play
                </a>
                <button onclick="toggleWatchlist({{ $movie->id }})"
                        class="px-8 py-3 bg-gray-800/80 hover:bg-gray-700 rounded font-bold transition">
                    + My List
                </button>
            </div>
        </div>
    </div>

    <!-- Movie Details -->
    <div class="px-12 py-8">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="md:col-span-2">
                <h2 class="text-2xl font-bold mb-4">Description</h2>
                <p class="text-lg text-gray-300 mb-8">{{ $movie->description }}</p>

                @if($movie->cast)
                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-4">Cast</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($movie->cast as $actor)
                        <div class="flex items-center gap-3">
                            <img src="{{ $actor['photo'] }}" 
                                 alt="{{ $actor['name'] }}" 
                                 class="w-16 h-16 rounded-full object-cover">
                            <div>
                                <p class="font-semibold">{{ $actor['name'] }}</p>
                                <p class="text-sm text-gray-400">{{ $actor['character'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div>
                <div class="bg-gray-900 rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Details</h3>
                    <dl class="space-y-3">
                        @if($movie->director)
                        <div>
                            <dt class="text-gray-400 text-sm">Director</dt>
                            <dd class="font-semibold">{{ $movie->director }}</dd>
                        </div>
                        @endif
                        <div>
                            <dt class="text-gray-400 text-sm">Release Year</dt>
                            <dd class="font-semibold">{{ $movie->year }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-sm">Duration</dt>
                            <dd class="font-semibold">{{ $movie->duration }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-sm">Genres</dt>
                            <dd class="font-semibold">{{ implode(', ', $movie->genre) }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- More Like This -->
        @if($relatedMovies->isNotEmpty())
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">More Like This</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($relatedMovies as $relatedMovie)
                    @include('components.movie-card', ['movie' => $relatedMovie])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function toggleWatchlist(movieId) {
    fetch(`/movie/${movieId}/watchlist`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    });
}
</script>
@endsection
