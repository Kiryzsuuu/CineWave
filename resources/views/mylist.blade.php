@extends('layouts.app')

@section('title', 'My List - CineWave')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8">My List</h1>

    @if($movies->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @foreach($movies as $movie)
            @include('components.movie-card', ['movie' => $movie])
        @endforeach
    </div>
    @else
    <div class="text-center py-20">
        <p class="text-xl text-gray-400">Your list is empty. Start adding movies!</p>
    </div>
    @endif
</div>
@endsection
