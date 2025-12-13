<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class AdminMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|url',
            'backdrop' => 'required|url',
            'genre' => 'required|string',
            'rating' => 'required|numeric|min:0|max:10',
            'description' => 'required|string',
            'year' => 'required|integer',
            'duration' => 'required|string',
            'director' => 'nullable|string',
            'category' => 'required|string',
        ]);

        $validated['genre'] = array_map('trim', explode(',', $validated['genre']));
        
        Movie::create($validated);

        return redirect()->route('admin.movies.index')->with('success', 'Movie added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|url',
            'backdrop' => 'required|url',
            'genre' => 'required|string',
            'rating' => 'required|numeric|min:0|max:10',
            'description' => 'required|string',
            'year' => 'required|integer',
            'duration' => 'required|string',
            'director' => 'nullable|string',
            'category' => 'required|string',
        ]);

        $validated['genre'] = array_map('trim', explode(',', $validated['genre']));
        
        $movie->update($validated);

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully!');
    }
}
