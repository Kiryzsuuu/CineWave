<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Rating extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'ratings';

    protected $fillable = [
        'movie_id',
        'user_id',
        'rating', // 1-5 stars
        'review',
    ];

    protected $casts = [
        'rating' => 'integer'
    ];

    // Relationship to user who made the rating
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to movie
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
