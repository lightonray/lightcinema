<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'release_date',
        'duration',
        'image',
        'user_id',
        'category_id'
    ];



    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Define relationship with ratings
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Calculate average rating for the movie
    public function averageRating()
    {
        return $this->ratings()->average('rating');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
}
