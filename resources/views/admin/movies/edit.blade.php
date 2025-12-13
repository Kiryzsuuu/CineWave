@extends('layouts.app')

@section('title', 'Edit Movie')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold">Edit Movie</h1>
        <a href="{{ route('admin.movies.index') }}" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded font-bold transition">
            ← Back
        </a>
    </div>

    <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" class="bg-gray-900 rounded-lg p-8">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-bold mb-2">Title *</label>
                <input type="text" name="title" value="{{ old('title', $movie->title) }}" required
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Image URL *</label>
                <input type="url" name="image" value="{{ old('image', $movie->image) }}" required
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Backdrop URL *</label>
                <input type="url" name="backdrop" value="{{ old('backdrop', $movie->backdrop) }}" required
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('backdrop')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Genre (comma separated) *</label>
                <input type="text" name="genre" value="{{ old('genre', is_array($movie->genre) ? implode(', ', $movie->genre) : $movie->genre) }}" placeholder="Action, Sci-Fi, Adventure" required
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('genre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Rating (0-10) *</label>
                <input type="number" name="rating" value="{{ old('rating', $movie->rating) }}" step="0.1" min="0" max="10" required
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Year *</label>
                <input type="number" name="year" value="{{ old('year', $movie->year) }}" required
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('year')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Duration *</label>
                <input type="text" name="duration" value="{{ old('duration', $movie->duration) }}" placeholder="2h 30m" required
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('duration')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Director</label>
                <input type="text" name="director" value="{{ old('director', $movie->director) }}"
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('director')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Category *</label>
                <select name="category" required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                    <option value="">Select Category</option>
                    <option value="trending" {{ old('category', $movie->category) == 'trending' ? 'selected' : '' }}>Trending</option>
                    <option value="popular" {{ old('category', $movie->category) == 'popular' ? 'selected' : '' }}>Popular</option>
                    <option value="newReleases" {{ old('category', $movie->category) == 'newReleases' ? 'selected' : '' }}>New Releases</option>
                    <option value="action" {{ old('category', $movie->category) == 'action' ? 'selected' : '' }}>Action</option>
                    <option value="scifi" {{ old('category', $movie->category) == 'scifi' ? 'selected' : '' }}>Sci-Fi</option>
                </select>
                @error('category')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold mb-2">Description *</label>
                <textarea name="description" rows="4" required
                          class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">{{ old('description', $movie->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex gap-4 mt-8">
            <button type="submit" class="px-8 py-3 bg-primary hover:bg-secondary rounded font-bold transition">
                Update Movie
            </button>
            <a href="{{ route('admin.movies.index') }}" class="px-8 py-3 bg-gray-700 hover:bg-gray-600 rounded font-bold transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
