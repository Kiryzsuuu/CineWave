<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Otp extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'otps';

    protected $fillable = [
        'email',
        'otp',
        'type',
        'expires_at',
        'verified'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified' => 'boolean'
    ];
}
