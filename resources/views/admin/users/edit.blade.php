@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold">Edit User</h1>
        <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded font-bold transition">
            Back
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-gray-900 rounded-lg p-8">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">New Password (leave empty to keep current)</label>
                <input type="password" name="password"
                       class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded focus:border-primary focus:outline-none">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                       class="w-4 h-4 text-primary bg-gray-800 border-gray-700 rounded focus:ring-primary">
                <label for="is_admin" class="ml-2 text-sm font-bold">Admin Access</label>
            </div>
        </div>

        <div class="flex gap-4 mt-8">
            <button type="submit" class="px-8 py-3 bg-primary hover:bg-secondary rounded font-bold transition">
                Update User
            </button>
            <a href="{{ route('admin.users.index') }}" class="px-8 py-3 bg-gray-700 hover:bg-gray-600 rounded font-bold transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
