<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        // Get all top-level comments (movie discussions) with user and movie info
        $discussions = Comment::with(['user', 'movie', 'replies.user'])
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('community.index', compact('discussions'));
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|string',
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|string',
        ]);

        Comment::create([
            'movie_id' => $request->movie_id,
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
