<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        $relatedMovies = Movie::where('category', $movie->category)
            ->where('id', '!=', $id)
            ->limit(6)
            ->get();

        return view('movie.show', compact('movie', 'relatedMovies'));
    }

    public function play($id)
    {
        $movie = Movie::findOrFail($id);
        
        return view('movie.play', compact('movie'));
    }

    public function toggleWatchlist(Request $request, $id)
    {
        $watchlist = session('watchlist', []);
        
        if (in_array($id, $watchlist)) {
            // Remove from watchlist
            $watchlist = array_diff($watchlist, [$id]);
            $message = 'Removed from My List';
        } else {
            // Add to watchlist
            $watchlist[] = $id;
            $message = 'Added to My List';
        }
        
        session(['watchlist' => array_values($watchlist)]);
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'inWatchlist' => in_array($id, $watchlist)
        ]);
    }
}
