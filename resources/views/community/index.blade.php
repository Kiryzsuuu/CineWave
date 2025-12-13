@extends('layouts.app')

@section('title', 'Community - CineWave')

@section('content')
<div class="px-4 md:px-12 py-8">
    <h1 class="text-3xl md:text-4xl font-bold mb-8">Community Discussions</h1>

    @if(session('success'))
        <div class="bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- New Discussion Form -->
    <div class="bg-gray-900 rounded-lg p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Start a Discussion</h2>
        <form action="{{ route('community.comment') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Select a Movie</label>
                <select name="movie_id" 
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                        required>
                    <option value="">Choose a movie...</option>
                    @php
                        $movies = \App\Models\Movie::orderBy('title', 'asc')->get();
                    @endphp
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Your Comment</label>
                <textarea name="content" 
                          rows="4" 
                          class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                          placeholder="Share your thoughts about the movie..."
                          required></textarea>
            </div>
            <button type="submit" class="px-6 py-2 bg-primary hover:bg-secondary rounded font-bold transition">
                Post Discussion
            </button>
        </form>
    </div>

    <!-- Discussions List -->
    <div class="space-y-6">
        @forelse($discussions as $discussion)
            <div class="bg-gray-900 rounded-lg p-6">
                <!-- Movie Header -->
                <div class="flex items-start gap-4 mb-4">
                    @if($discussion->movie)
                        <img src="{{ $discussion->movie->image }}" 
                             alt="{{ $discussion->movie->title }}" 
                             class="w-16 h-24 object-cover rounded">
                        <div class="flex-1">
                            <a href="{{ route('movie.show', $discussion->movie->id) }}" 
                               class="text-xl font-bold hover:text-primary transition">
                                {{ $discussion->movie->title }}
                            </a>
                            <p class="text-gray-400 text-sm mt-1">
                                Discussion by <span class="text-white font-semibold">{{ $discussion->user->name }}</span>
                                <span class="mx-2">•</span>
                                {{ $discussion->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @endif
                    @if(auth()->check() && (auth()->id() == $discussion->user_id || auth()->user()->is_admin))
                        <form action="{{ route('community.comment.delete', $discussion->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure? This will delete all replies too.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-400 text-sm">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Comment Content -->
                <p class="text-gray-300 mb-4">{{ $discussion->content }}</p>

                <!-- Reply Button -->
                <button onclick="toggleReply('{{ $discussion->id }}')" 
                        class="text-primary hover:text-secondary text-sm mb-3">
                    Reply ({{ $discussion->replies->count() }})
                </button>

                <!-- Reply Form -->
                <div id="reply-form-{{ $discussion->id }}" class="hidden mb-4">
                    <form action="{{ route('community.comment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="movie_id" value="{{ $discussion->movie_id }}">
                        <input type="hidden" name="parent_id" value="{{ $discussion->id }}">
                        <textarea name="content" 
                                  rows="2" 
                                  class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent mb-2"
                                  placeholder="Write a reply..."
                                  required></textarea>
                        <div class="flex gap-2">
                            <button type="submit" class="px-4 py-1 bg-primary hover:bg-secondary rounded text-sm">
                                Post Reply
                            </button>
                            <button type="button" 
                                    onclick="toggleReply('{{ $discussion->id }}')" 
                                    class="px-4 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Replies -->
                @if($discussion->replies->count() > 0)
                    <div class="ml-8 mt-4 space-y-3">
                        @foreach($discussion->replies as $reply)
                            <div class="bg-gray-800 rounded-lg p-4">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <span class="font-bold">{{ $reply->user->name }}</span>
                                        <span class="text-gray-400 text-sm ml-2">
                                            {{ $reply->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    @if(auth()->check() && (auth()->id() == $reply->user_id || auth()->user()->is_admin))
                                        <form action="{{ route('community.comment.delete', $reply->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400 text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p class="text-gray-300">{{ $reply->content }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-gray-900 rounded-lg p-8 text-center">
                <p class="text-gray-400">No discussions yet. Start the conversation!</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($discussions->hasPages())
        <div class="mt-8">
            {{ $discussions->links() }}
        </div>
    @endif
</div>

<script>
function toggleReply(discussionId) {
    const replyForm = document.getElementById('reply-form-' + discussionId);
    replyForm.classList.toggle('hidden');
}
</script>
@endsection
