<div class="group relative cursor-pointer" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
    <a href="{{ route('movie.show', $movie->id) }}">
        <div class="relative aspect-[2/3] overflow-hidden rounded-lg">
            <img src="{{ $movie->image }}" 
                 alt="{{ $movie->title }}" 
                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors"></div>
            
            <!-- Rating Badge -->
            <div class="absolute top-2 right-2 px-2 py-1 bg-black/80 rounded text-xs font-bold">
                ⭐ {{ $movie->rating }}
            </div>
        </div>
        
        <div class="mt-2">
            <h3 class="font-semibold truncate group-hover:text-primary transition">{{ $movie->title }}</h3>
            <p class="text-sm text-gray-400">{{ $movie->year }}</p>
        </div>
    </a>

    <!-- Hover Actions -->
    <div x-show="hover" 
         x-transition
         class="absolute top-2 left-2 flex gap-2 z-10">
        <button onclick="toggleWatchlist({{ $movie->id }})"
                class="p-2 bg-black/80 hover:bg-primary rounded-full transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </button>
    </div>
</div>

@once
@push('scripts')
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
@endpush
@endonce
