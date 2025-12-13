<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Comment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comments';

    protected $fillable = [
        'movie_id',
        'user_id',
        'content',
        'parent_id', // For replies
    ];

    // Relationship to user who made the comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to movie
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    // Get replies to this comment
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Get parent comment if this is a reply
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
