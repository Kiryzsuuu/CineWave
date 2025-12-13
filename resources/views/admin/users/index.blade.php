@extends('layouts.app')

@section('title', 'Admin - Manage Users')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold">Manage Users</h1>
        <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded font-bold transition">
            Back to Dashboard
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-600 text-white px-6 py-4 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-600 text-white px-6 py-4 rounded mb-6">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-gray-900 rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Role</th>
                    <th class="px-6 py-4 text-left">Registered</th>
                    <th class="px-6 py-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b border-gray-800 hover:bg-gray-800/50">
                    <td class="px-6 py-4 font-semibold">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @if($user->is_admin)
                        <span class="px-3 py-1 bg-primary rounded text-sm">Admin</span>
                        @else
                        <span class="px-3 py-1 bg-gray-700 rounded text-sm">User</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded text-sm transition">
                                Edit
                            </a>
                            @if($user->id != auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-sm transition">
                                    Delete
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
