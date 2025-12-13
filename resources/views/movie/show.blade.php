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
                <span class="px-3 py-1 bg-primary rounded text-sm font-bold">{{ $movie->rating }}</span>
                <span>{{ $movie->year }}</span>
                <span>{{ $movie->duration }}</span>
                @if(is_array($movie->genre))
                    @foreach($movie->genre as $genre)
                        <span class="px-3 py-1 bg-gray-800 rounded text-sm">{{ $genre }}</span>
                    @endforeach
                @endif
            </div>
            <div class="flex gap-4 mb-6">
                <a href="{{ route('movie.play', $movie->id) }}" 
                   class="px-8 py-3 bg-primary hover:bg-secondary rounded font-bold transition flex items-center gap-2">
                    Play
                </a>
                @auth
                <button onclick="toggleWatchlist('{{ $movie->id }}')" id="watchlist-btn"
                        class="px-8 py-3 bg-gray-800/80 hover:bg-gray-700 rounded font-bold transition">
                    <span id="watchlist-text">{{ $inWatchlist ? '- Remove from List' : '+ Add to My List' }}</span>
                </button>
                @else
                <a href="{{ route('login') }}" 
                   class="px-8 py-3 bg-gray-800/80 hover:bg-gray-700 rounded font-bold transition">
                    + Add to My List
                </a>
                @endauth
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

                @if($movie->cast && is_array($movie->cast))
                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-4">Cast</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($movie->cast as $actor)
                        <div class="flex items-center gap-3">
                            <img src="{{ $actor['photo'] ?? 'https://via.placeholder.com/64' }}" 
                                 alt="{{ $actor['name'] ?? 'Actor' }}" 
                                 class="w-16 h-16 rounded-full object-cover">
                            <div>
                                <p class="font-semibold">{{ $actor['name'] ?? 'Unknown' }}</p>
                                <p class="text-sm text-gray-400">{{ $actor['character'] ?? 'Character' }}</p>
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
                            <dd class="font-semibold">{{ is_array($movie->genre) ? implode(', ', $movie->genre) : $movie->genre }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Rating & Review Section -->
        <div class="mt-12 bg-gray-900 rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold">Ratings & Reviews</h2>
                    @if($totalRatings > 0)
                        <p class="text-gray-400 mt-1">
                            <span class="text-yellow-500 text-2xl font-bold">{{ number_format($averageRating, 1) }}</span>
                            <span class="text-gray-400">/5 from {{ $totalRatings }} {{ $totalRatings == 1 ? 'rating' : 'ratings' }}</span>
                        </p>
                    @endif
                </div>
            </div>

            @auth
            <!-- Rating Form -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">{{ $userRating ? 'Update Your Rating' : 'Rate This Movie' }}</h3>
                <form action="{{ route('movie.rating', $movie->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Your Rating</label>
                        <div class="flex gap-2" x-data="{ rating: {{ $userRating ? $userRating->rating : 0 }} }">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" 
                                        @click="rating = {{ $i }}"
                                        class="text-3xl transition"
                                        :class="rating >= {{ $i }} ? 'text-yellow-500' : 'text-gray-600'">
                                    ★
                                </button>
                            @endfor
                            <input type="hidden" name="rating" x-model="rating" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Review (Optional)</label>
                        <textarea name="review" 
                                  rows="3" 
                                  class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                  placeholder="Share your thoughts about this movie...">{{ $userRating ? $userRating->review : '' }}</textarea>
                    </div>
                    <button type="submit" class="px-6 py-2 bg-primary hover:bg-secondary rounded font-bold transition">
                        {{ $userRating ? 'Update Rating' : 'Submit Rating' }}
                    </button>
                </form>
            </div>
            @endauth

            @guest
            <div class="bg-gray-800 rounded-lg p-6 mb-6 text-center">
                <p class="text-gray-400 mb-4">Please login to rate and review this movie</p>
                <a href="{{ route('login') }}" class="px-6 py-2 bg-primary hover:bg-secondary rounded font-bold transition inline-block">
                    Sign In
                </a>
            </div>
            @endguest
        </div>

        <!-- Comments Section -->
        <div class="mt-12 bg-gray-900 rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Discussion ({{ $comments->count() }})</h2>

            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @auth
            <!-- Comment Form -->
            <form action="{{ route('movie.comment', $movie->id) }}" method="POST" class="mb-6">
                @csrf
                <textarea name="content" 
                          rows="3" 
                          class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent mb-3"
                          placeholder="Share your thoughts about this movie..."
                          required></textarea>
                <button type="submit" class="px-6 py-2 bg-primary hover:bg-secondary rounded font-bold transition">
                    Post Comment
                </button>
            </form>
            @endauth

            <!-- Comments List -->
            <div class="space-y-4">
                @forelse($comments as $comment)
                    <div class="bg-gray-800 rounded-lg p-4">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <span class="font-bold">{{ $comment->user->name }}</span>
                                <span class="text-gray-400 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            @if(auth()->check() && (auth()->id() == $comment->user_id || auth()->user()->is_admin))
                                <form action="{{ route('comment.delete', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400 text-sm">Delete</button>
                                </form>
                            @endif
                        </div>
                        <p class="text-gray-300 mb-3">{{ $comment->content }}</p>
                        
                        @auth
                        <!-- Reply Button -->
                        <button onclick="toggleReply('{{ $comment->id }}')" class="text-primary hover:text-secondary text-sm">
                            Reply
                        </button>

                        <!-- Reply Form (hidden by default) -->
                        <div id="reply-form-{{ $comment->id }}" class="hidden mt-3">
                            <form action="{{ route('movie.comment', $movie->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <textarea name="content" 
                                          rows="2" 
                                          class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent mb-2"
                                          placeholder="Write a reply..."
                                          required></textarea>
                                <div class="flex gap-2">
                                    <button type="submit" class="px-4 py-1 bg-primary hover:bg-secondary rounded text-sm">
                                        Post Reply
                                    </button>
                                    <button type="button" onclick="toggleReply('{{ $comment->id }}')" class="px-4 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        @endauth

                        <!-- Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="mt-4 ml-8 space-y-3">
                                @foreach($comment->replies as $reply)
                                    <div class="bg-gray-700/50 rounded-lg p-3">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <span class="font-bold">{{ $reply->user->name }}</span>
                                                <span class="text-gray-400 text-sm ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            @if(auth()->check() && (auth()->id() == $reply->user_id || auth()->user()->is_admin))
                                                <form action="{{ route('comment.delete', $reply->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-400 text-sm">Delete</button>
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
                    <p class="text-gray-400 text-center py-8">No comments yet. Be the first to share your thoughts!</p>
                @endforelse
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
    const btn = document.getElementById('watchlist-btn');
    const text = document.getElementById('watchlist-text');
    
    fetch(`/movie/${movieId}/watchlist`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            text.textContent = data.inWatchlist ? '- Remove from List' : '+ Add to My List';
            
            // Show notification
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-primary text-white px-6 py-3 rounded shadow-lg z-50';
            notification.textContent = data.message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update watchlist');
    });
}

function toggleReply(commentId) {
    const replyForm = document.getElementById('reply-form-' + commentId);
    replyForm.classList.toggle('hidden');
}
</script>
@endsection
