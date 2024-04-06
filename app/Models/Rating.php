<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'user_id', 'rating'];

    // Define relationship with the movie
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    // Define relationship with the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
