@extends('layouts.app')

@section('title', 'Admin Dashboard - CineWave')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8">Admin Dashboard</h1>

    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.movies.index') }}" class="bg-gray-900 rounded-lg p-6 hover:bg-gray-800 transition">
            <h3 class="text-2xl font-bold mb-2">Movies</h3>
            <p class="text-gray-400">Manage movie library</p>
        </a>

        <a href="{{ route('admin.users.index') }}" class="bg-gray-900 rounded-lg p-6 hover:bg-gray-800 transition">
            <h3 class="text-2xl font-bold mb-2">Users</h3>
            <p class="text-gray-400">Manage user accounts</p>
        </a>

        <a href="{{ route('home') }}" class="bg-gray-900 rounded-lg p-6 hover:bg-gray-800 transition">
            <h3 class="text-2xl font-bold mb-2">Back to Site</h3>
            <p class="text-gray-400">Return to main site</p>
        </a>
    </div>
</div>
@endsection
