<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Watchlist;
use App\Models\Rating;
use App\Models\Comment;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        $relatedMovies = Movie::where('category', $movie->category)
            ->where('_id', '!=', $id)
            ->limit(6)
            ->get();

        $inWatchlist = false;
        $userRating = null;
        
        if (auth()->check()) {
            $inWatchlist = Watchlist::where('user_id', auth()->id())
                ->where('movie_id', $id)
                ->exists();
            
            $userRating = Rating::where('user_id', auth()->id())
                ->where('movie_id', $id)
                ->first();
        }

        // Get average rating and total ratings
        $ratings = Rating::where('movie_id', $id)->get();
        $averageRating = $ratings->avg('rating');
        $totalRatings = $ratings->count();

        // Get comments for this movie
        $comments = Comment::with(['user', 'replies.user'])
            ->where('movie_id', $id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('movie.show', compact('movie', 'relatedMovies', 'inWatchlist', 'userRating', 'averageRating', 'totalRatings', 'comments'));
    }

    public function play($id)
    {
        $movie = Movie::findOrFail($id);
        
        return view('movie.play', compact('movie'));
    }

    public function toggleWatchlist(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first'
            ], 401);
        }

        $watchlist = Watchlist::where('user_id', auth()->id())
            ->where('movie_id', $id)
            ->first();
        
        if ($watchlist) {
            // Remove from watchlist
            $watchlist->delete();
            $message = 'Removed from My List';
            $inWatchlist = false;
        } else {
            // Add to watchlist
            Watchlist::create([
                'user_id' => auth()->id(),
                'movie_id' => $id,
            ]);
            $message = 'Added to My List';
            $inWatchlist = true;
        }
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'inWatchlist' => $inWatchlist
        ]);
    }

    public function storeRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
        ]);

        // Check if user already rated this movie
        $existingRating = Rating::where('user_id', auth()->id())
            ->where('movie_id', $id)
            ->first();

        if ($existingRating) {
            $existingRating->update([
                'rating' => $request->rating,
                'review' => $request->review,
            ]);
            $message = 'Rating updated successfully!';
        } else {
            Rating::create([
                'user_id' => auth()->id(),
                'movie_id' => $id,
                'rating' => $request->rating,
                'review' => $request->review,
            ]);
            $message = 'Rating submitted successfully!';
        }

        return back()->with('success', $message);
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|string',
        ]);

        Comment::create([
            'movie_id' => $id,
            'user_id' => auth()->id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        if ($request->parent_id) {
            return back()->with('success', 'Reply posted successfully!');
        }

        return back()->with('success', 'Comment posted successfully!');
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        
        // Only allow user to delete their own comments or admin
        if ($comment->user_id != auth()->id() && !auth()->user()->is_admin) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Delete all replies first
        Comment::where('parent_id', $id)->delete();
        
        // Delete the comment
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
