<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'image',
        'backdrop',
        'genre',
        'rating',
        'description',
        'year',
        'duration',
        'director',
        'cast',
        'category'
    ];

    protected $casts = [
        'genre' => 'array',
        'cast' => 'array',
        'rating' => 'float',
        'year' => 'integer'
    ];

    // Scope untuk category
    public function scopeTrending($query)
    {
        return $query->where('category', 'trending');
    }

    public function scopePopular($query)
    {
        return $query->where('category', 'popular');
    }

    public function scopeNewReleases($query)
    {
        return $query->where('category', 'newReleases');
    }

    public function scopeAction($query)
    {
        return $query->where('category', 'action');
    }

    public function scopeScifi($query)
    {
        return $query->where('category', 'scifi');
    }

    public function scopeByGenre($query, $genre)
    {
        return $query->whereJsonContains('genre', $genre);
    }
}

