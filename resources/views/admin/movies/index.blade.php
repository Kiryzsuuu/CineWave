@extends('layouts.app')

@section('title', 'Admin - Manage Movies')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold">Manage Movies</h1>
        <a href="{{ route('admin.movies.create') }}" class="px-6 py-3 bg-primary hover:bg-secondary rounded font-bold transition">
            + Add New Movie
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-600 text-white px-6 py-4 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-gray-900 rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left">Image</th>
                    <th class="px-6 py-4 text-left">Title</th>
                    <th class="px-6 py-4 text-left">Year</th>
                    <th class="px-6 py-4 text-left">Rating</th>
                    <th class="px-6 py-4 text-left">Category</th>
                    <th class="px-6 py-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                <tr class="border-b border-gray-800 hover:bg-gray-800/50">
                    <td class="px-6 py-4">
                        <img src="{{ $movie->image }}" alt="{{ $movie->title }}" class="w-16 h-24 object-cover rounded">
                    </td>
                    <td class="px-6 py-4 font-semibold">{{ $movie->title }}</td>
                    <td class="px-6 py-4">{{ $movie->year }}</td>
                    <td class="px-6 py-4">Rating: {{ $movie->rating }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-primary rounded text-sm">{{ $movie->category }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.movies.edit', $movie->id) }}" 
                               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded text-sm transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this movie?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-sm transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $movies->links() }}
    </div>
</div>
@endsection
