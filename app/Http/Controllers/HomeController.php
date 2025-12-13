<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Watchlist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function index()
    {
        $trending = Movie::trending()->get();
        $popular = Movie::popular()->get();
        $newReleases = Movie::newReleases()->get();
        $action = Movie::action()->get();
        $scifi = Movie::scifi()->get();

        return view('home', compact('trending', 'popular', 'newReleases', 'action', 'scifi'));
    }

    public function paymentPlan()
    {
        return view('payment.plan');
    }

    public function selectPlan(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:basic,standard,premium'
        ]);

        session(['user_plan' => $request->plan]);
        
        return redirect()->route('home');
    }

    public function profile()
    {
        return view('profile');
    }

    public function myList()
    {
        // Get user's watchlist from database
        $watchlistIds = Watchlist::where('user_id', auth()->id())
            ->pluck('movie_id')
            ->toArray();
        
        $movies = Movie::whereIn('_id', $watchlistIds)->get();

        return view('mylist', compact('movies'));
    }

    public function category($type)
    {
        $movies = Movie::where('category', $type)->get();
        $categoryName = ucfirst($type);

        return view('category', compact('movies', 'categoryName'));
    }

    public function genre($genre)
    {
        $movies = Movie::byGenre($genre)->get();

        return view('genre', compact('movies', 'genre'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $movies = Movie::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return view('search', compact('movies', 'query'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function pricing()
    {
        return view('pages.pricing');
    }

    public function support()
    {
        return view('pages.support');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }
}

